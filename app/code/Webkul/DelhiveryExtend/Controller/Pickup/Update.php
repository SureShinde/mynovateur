<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryShipping
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Webkul\DelhiveryExtend\Controller\Pickup;

use Magento\Framework\App\Action\Action;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Webkul\DelhiveryExtend\Model\ResourceModel\Pickup\CollectionFactory;
use Webkul\Marketplace\Helper\Data as HelperData;
use Magento\Customer\Model\Url as CustomerUrl;

/**
 * Webkul DelhiveryExtend Pickup Update controller.
 */
class Update extends Action implements \Magento\Framework\App\CsrfAwareActionInterface
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;

    /**
     * @var CollectionFactory
     */
    protected $orderCollectionFactory;

    /**
     * @var HelperData
     */
    protected $helper;

    /**
     * @var CustomerUrl
     */
    private $customerUrl;

    /**
     * @var MpOrdersCollection
     */
    protected $mpOrdersCollection;


    /**
     * @param Context $context,
     * @param Filter $filter,
     * @param Session $customerSession,
     * @param CollectionFactory $orderCollectionFactory,
     * @param HelperData $helper,
     * @param CustomerUrl $customerUrl,
     * @param MpOrdersCollection $mpOrdersCollection,
     * @param \Webkul\DelhiveryShipping\Model\Manageawb $delhiveryModelAwb,
     */
    public function __construct(
        Context $context,
        Filter $filter,
        Session $customerSession,
        CollectionFactory $pickupFactory,
        HelperData $helper,
        CustomerUrl $customerUrl
    ) {
        $this->filter = $filter;
        $this->_customerSession = $customerSession;
        $this->pickupFactory = $pickupFactory;
        $this->helper = $helper;
        $this->customerUrl = $customerUrl;
        parent::__construct(
            $context
        );
    }

    /**
     * @inheritDoc
     */
    public function createCsrfValidationException(
        RequestInterface $request
    ): ?InvalidRequestException {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return true;
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
        $loginUrl = $this->customerUrl->getLoginUrl();

        if (!$this->_customerSession->authenticate($loginUrl)) {
            $this->_actionFlag->set('', self::FLAG_NO_DISPATCH, true);
        }

        return parent::dispatch($request);
    }

    /**
     * Mass delete seller products action.
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $isPartner = $this->helper->isSeller();
        $updatedStatus = 0;
        if ($isPartner == 1) {
            try {
                $sellerId = $this->helper->getCustomerId();
                $collection = $this->filter->getCollection($this->pickupFactory->create());
                $collection->addFieldToFilter('seller_id', ['eq' => $sellerId]);
                if (!empty($collection->getSize())) {
                    foreach ($collection as $pickup) {
                        $pickup->setPickupState(1)->save();
                    }
                    $this->messageManager->addSuccess(
                        __('%1 pickup(s) state Updated Successfully', $collection->getSize())
                    );
                } else {
                    $this->messageManager->addNotice(
                        __('There are no pickup for update related.')
                    );
                }
            } catch (\Exception $e) {
                $this->helper->logDataInLogger("Controller_Pickup_Update : ".$e->getMessage());
                $this->messageManager->addError($e->getMessage());
            }
            return $this->resultRedirectFactory->create()->setPath(
                'delhiveryextend/pickup/history',
                ['_secure' => $this->getRequest()->isSecure()]
            );
        } else {
            return $this->resultRedirectFactory->create()->setPath(
                'marketplace/account/becomeseller',
                ['_secure' => $this->getRequest()->isSecure()]
            );
        }
    }
}
