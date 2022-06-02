<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MpAssignProduct
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MpAssignProduct\Controller\Product;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Registry;

class Delete extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Customer\Model\Url
     */
    protected $_url;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_session;

    /**
     * @var \Webkul\MpAssignProduct\Helper\Data
     */
    protected $_assignHelper;

    /**
     * @var \Webkul\MpAssignProduct\Model\ItemsFactory
     */
    protected $_items;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * Core registry.
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * @param Context $context
     * @param \Magento\Customer\Model\Url $url
     * @param \Magento\Customer\Model\Session $session
     * @param \Webkul\MpAssignProduct\Helper\Data $helper
     * @param \Webkul\MpAssignProduct\Model\ItemsFactory $itemsFactory
     * @param ProductRepositoryInterface $productRepository
     * @param Registry $coreRegistry
     */
    public function __construct(
        Context $context,
        \Magento\Customer\Model\Url $url,
        \Magento\Customer\Model\Session $session,
        \Webkul\MpAssignProduct\Helper\Data $helper,
        \Webkul\MpAssignProduct\Model\ItemsFactory $itemsFactory,
        Registry $coreRegistry,
        \Webkul\Marketplace\Helper\Data $mpHelper,
        ProductRepositoryInterface $productRepository = null
    ) {
        $this->_url = $url;
        $this->_session = $session;
        $this->_assignHelper = $helper;
        $this->itemsFactory = $itemsFactory;
        $this->coreRegistry = $coreRegistry;
        $this->mpHelper = $mpHelper;
        $this->productRepository = $productRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->create(ProductRepositoryInterface::class);
        parent::__construct($context);
    }

    /**
     * Check customer authentication.
     *
     * @param RequestInterface $request
     *
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function dispatch(RequestInterface $request)
    {
        $loginUrl = $this->_url->getLoginUrl();
        if (!$this->_session->authenticate($loginUrl)) {
            $this->_actionFlag->set('', self::FLAG_NO_DISPATCH, true);
        }
        return parent::dispatch($request);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $helper = $this->_assignHelper;
        $data = $this->getRequest()->getParams();
        $assignId = (int) $data['id'];
        if ($assignId) {
            $sellerId = $this->mpHelper->getCustomerId();
            $size = $this->itemsFactory->create()
                            ->getCollection()
                            ->addFieldToFilter('entity_id', $assignId)
                            ->addFieldToFilter('seller_id', $sellerId)
                            ->getSize();
            if ($size) {
                $item = $this->itemsFactory->create()->load($assignId);
                $item->delete();
                $this->messageManager->addSuccess(__('Product deleted successfully.'));
            } else {
                $this->messageManager->addError(__('Something went wrong.'));
            }
        } else {
            $this->messageManager->addError(__('Something went wrong.'));
        }
        return $this->resultRedirectFactory->create()->setPath('*/*/productlist');
    }
}
