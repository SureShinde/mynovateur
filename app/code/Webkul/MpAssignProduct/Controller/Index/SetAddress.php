<?php
namespace Webkul\MpAssignProduct\Controller\Index;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\Stdlib\CookieManagerInterface;
use Magento\Framework\App\Http\Context as HttpContext;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Framework\Session\SessionManagerInterface;

class SetAddress extends \Magento\Framework\App\Action\Action
{
    public const COOKIE_NAME = 'zip_data';

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param JsonHelper $jsonHelper
     * @param HttpContext $httpContext
     * @param CheckoutSession $checkoutSession
     * @param CookieMetadataFactory $cookieMetadata
     * @param CookieManagerInterface $cookieManager
     * @param SessionManagerInterface $sessionManager
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        JsonHelper $jsonHelper,
        HttpContext $httpContext,
        CheckoutSession $checkoutSession,
        CookieMetadataFactory $cookieMetadata,
        CookieManagerInterface $cookieManager,
        SessionManagerInterface $sessionManager,
	    PageFactory $resultPageFactory
    ) {
	    $this->resultPageFactory = $resultPageFactory;
	    $this->jsonFactory = $jsonFactory;
        $this->cookieMetadata = $cookieMetadata;
        $this->cookieManager = $cookieManager;
        $this->jsonHelper = $jsonHelper;
        $this->httpContext = $httpContext;
        $this->sessionManager = $sessionManager;
        $this->checkoutSession = $checkoutSession;
        parent::__construct($context);
    }

    public function execute()
    {
        $jsonFactory = $this->jsonFactory->create();
        $data = $this->getRequest()->getPostValue();
        if (isset($data['address']) && $data['address']) {
            $addressData = $data['address'];
            $metadata = $this->cookieMetadata->createPublicCookieMetadata()
                ->setDuration(864000)
                ->setPath($this->sessionManager->getCookiePath())
                ->setDomain($this->sessionManager->getCookieDomain());
            $this->cookieManager->setPublicCookie(self::COOKIE_NAME, $addressData, $metadata);
            $this->httpContext->setValue(
                'zip_data',
                $addressData,
                false
            );
            $this->checkoutSession->getQuote()->delete();
            $result = ['status'=> 1, 'msg' => __('Successfully saved zip code.')];
        } else {
            $result = ['status'=> 0, 'msg' => __('Fill Correct Zip code.')];
        }
        return $jsonFactory->setData($result);
    }
}
