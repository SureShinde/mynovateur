<?php
namespace Webkul\MpAssignProduct\Rewrite\Controller\Cart;

use Magento\Checkout\Model\Cart\RequestQuantityProcessor;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Checkout\Model\Cart as CustomerCart;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Add extends \Magento\Checkout\Controller\Cart\Add
{
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var RequestQuantityProcessor
     */
    private $quantityProcessor;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     * @param CustomerCart $cart
     * @param ProductRepositoryInterface $productRepository
     * @param RequestQuantityProcessor|null $quantityProcessor
     * @codeCoverageIgnore
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        CustomerCart $cart,
        ProductRepositoryInterface $productRepository,
        \Magento\ConfigurableProduct\Model\Product\Type\Configurable $configurableProTypeModel,
        \Webkul\MpAssignProduct\Model\ItemsFactory $itemsFactory,
        \Webkul\MpAssignProduct\Model\AssociatesFactory $associatesFactory,
        \Webkul\MpAssignProduct\Model\QuoteFactory $assignedQuoteFactory,
        ?RequestQuantityProcessor $quantityProcessor = null
    ) {
        $this->productRepository = $productRepository;
        $this->quantityProcessor = $quantityProcessor
            ?? ObjectManager::getInstance()->get(RequestQuantityProcessor::class);
        $this->configurableProTypeModel = $configurableProTypeModel;
        $this->itemsFactory = $itemsFactory;
        $this->associatesFactory = $associatesFactory;
        $this->assignedQuoteFactory = $assignedQuoteFactory;
        parent::__construct(
            $context,
            $scopeConfig,
            $checkoutSession,
            $storeManager,
            $formKeyValidator,
            $cart,
            $productRepository,
            $this->quantityProcessor
        );
    }

    /**
     * Add product to shopping cart action
     *
     * @return ResponseInterface|ResultInterface
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function execute()
    {
        if (!$this->_formKeyValidator->validate($this->getRequest())) {
            $this->messageManager->addErrorMessage(
                __('Your session has expired')
            );
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }

        $params = $this->getRequest()->getParams();
        try {
            $productId = $params['product'];
            if (isset($params['qty'])) {
                $filter = new \Zend_Filter_LocalizedToNormalized(
                    ['locale' => $this->_objectManager->get(
                        \Magento\Framework\Locale\ResolverInterface::class
                    )->getLocale()]
                );
                // $params['qty'] = $this->quantityProcessor->prepareQuantity($params['qty']);
                $params['qty'] = $filter->filter($params['qty']);
            }

            $product = $this->_initProduct();
            $related = $this->getRequest()->getParam('related_product');

            /** Check product availability */
            if (!$product) {
                return $this->goBack();
            }

            if (!isset($params['assigned_id'])) {
                return $this->resultRedirectFactory->create()->setPath('catalog/product/view/id/'.$productId);
            }
            
            $assignedItem = $this->itemsFactory->create()
                                    ->getCollection()
                                    ->addFieldToFilter('id', $params['assigned_id'])
                                    ->addFieldToFilter('product_id', $productId)
                                    ->getFirstItem();
            $assignedItemId = $assignedItem->getId();
            if (!$assignedItemId) {
                $this->messageManager->addErrorMessage(__('Requested quantity of this product is not available from this seller.'));
                return $this->goBack(null, $product);
            }
            $sellerId = $assignedItem->getSellerId();
            $assignedAssociateItemId = 0;
            if ($product->getTypeId()=='configurable') {
                $attributesInfo = $params['super_attribute'];
                $associateProduct = $this->configurableProTypeModel->getProductByAttributes($attributesInfo, $product);
                $associateProductId = $associateProduct->getId();
                $assignedAssociateItem = $this->associatesFactory->create()
                                                ->getCollection()
                                                ->addFieldToFilter('parent_id', $assignedItemId)
                                                ->addFieldToFilter('product_id', $associateProductId)
                                                ->getFirstItem();
                $assignedAssociateItemId = $assignedAssociateItem->getId();
                if (!$assignedAssociateItem->getId()) {
                    $this->messageManager->addErrorMessage(__('Requested quantity of this product is not available from this seller.'));
                    return $this->goBack(null, $product);
                }
                if ($assignedAssociateItem->getQty()<$params['qty']) {
                    $this->messageManager->addErrorMessage(__('Requested quantity of this product is not available from this seller.'));
                    return $this->goBack(null, $product);
                }
            } else {
                if ($assignedItem->getQty()<$params['qty']) {
                    $this->messageManager->addErrorMessage(__('Requested quantity of this product is not available from this seller.'));
                    return $this->goBack(null, $product);
                }
            }

            $this->cart->addProduct($product, $params);
            if (!empty($related)) {
                $this->cart->addProductsByIds(explode(',', $related));
            }
            $this->cart->save();

            /**
             * @todo remove wishlist observer \Magento\Wishlist\Observer\AddToCart
             */
            $this->_eventManager->dispatch(
                'checkout_cart_add_product_complete',
                ['product' => $product, 'request' => $this->getRequest(), 'response' => $this->getResponse()]
            );

            if (!$this->_checkoutSession->getNoCartRedirect(true)) {
                if ($this->shouldRedirectToCart()) {
                    $message = __(
                        'You added %1 to your shopping cart.',
                        $product->getName()
                    );
                    $this->messageManager->addSuccessMessage($message);
                } else {
                    $this->messageManager->addComplexSuccessMessage(
                        'addCartSuccessMessage',
                        [
                            'product_name' => $product->getName(),
                            'cart_url' => $this->getCartUrl(),
                        ]
                    );
                }
                if ($this->cart->getQuote()->getHasError()) {
                    $errors = $this->cart->getQuote()->getErrors();
                    foreach ($errors as $error) {
                        $this->messageManager->addErrorMessage($error->getText());
                    }
                }

                $cartItems = $this->cart->getQuote()->getAllItems();
                $max = 0;
                $lastItem = null;
                foreach ($cartItems as $item){
                    if ($item->getId() > $max) {
                        $max = $item->getId();
                        $lastItem = $item;
                    }
                }
                if ($lastItem){
                    $itemId = $lastItem->getId();
                    $parentItemId = $lastItem->getParentItemId();
                    $quoteId = $lastItem->getQuoteId();
                    $collection = $this->assignedQuoteFactory->create()
                                            ->getCollection()
                                            ->addFieldToFilter('seller_id', $sellerId)
                                            ->addFieldToFilter('item_id', $itemId)
                                            ->addFieldToFilter('quote_id', $quoteId)
                                            ->addFieldToFilter('product_id', $productId)
                                            ->addFieldToFilter('assign_id', $assignedItemId);
                    if ($collection->getSize()) {
                        foreach ($collection as $model) {
                            $model->setQty($params['qty'])->save();
                        }
                    } else {
                        $model = $this->assignedQuoteFactory->create();
                        $model->setData('seller_id', $sellerId)
                            ->setData('item_id', $itemId)
                            ->setData('parent_item_id', $parentItemId)
                            ->setData('quote_id', $quoteId)
                            ->setData('product_id', $productId)
                            ->setData('assign_id', $assignedItemId)
                            ->setData('child_assign_id', $assignedAssociateItemId)
                            ->setData('qty', $params['qty']);
                        $model->save();
                    }
                }
                return $this->goBack(null, $product);
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            if ($this->_checkoutSession->getUseNotice(true)) {
                $this->messageManager->addNoticeMessage(
                    $this->_objectManager->get(\Magento\Framework\Escaper::class)->escapeHtml($e->getMessage())
                );
            } else {
                $messages = array_unique(explode("\n", $e->getMessage()));
                foreach ($messages as $message) {
                    $this->messageManager->addErrorMessage(
                        $this->_objectManager->get(\Magento\Framework\Escaper::class)->escapeHtml($message)
                    );
                }
            }

            $url = $this->_checkoutSession->getRedirectUrl(true);
            if (!$url) {
                $url = $this->_redirect->getRedirectUrl($this->getCartUrl());
            }
            return $this->goBack($url);
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage(
                $e,
                __('We can\'t add this item to your shopping cart right now.')
            );
            $this->_objectManager->get(\Psr\Log\LoggerInterface::class)->critical($e);
            return $this->goBack();
        }

        return $this->getResponse();
    }

    /**
     * Returns cart url
     *
     * @return string
     */
    private function getCartUrl()
    {
        return $this->_url->getUrl('checkout/cart', ['_secure' => true]);
    }

    /**
     * Is redirect should be performed after the product was added to cart.
     *
     * @return bool
     */
    private function shouldRedirectToCart()
    {
        return $this->_scopeConfig->isSetFlag(
            'checkout/cart/redirect_to_cart',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}