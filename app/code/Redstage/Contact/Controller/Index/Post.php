<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Redstage\Contact\Controller\Index;

use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Contact\Model\ConfigInterface;
use Magento\Contact\Model\MailInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\DataObject;
use Redstage\Contact\Model\ContactFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\HTTP\Client\CurlFactory;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\App\Config\ScopeConfigInterface;


class Post extends \Magento\Contact\Controller\Index implements HttpPostActionInterface
{
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var Context
     */
    private $context;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var MailInterface
     */
    private $mail;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ContactFactory
     */
    private $contactFactory;

    /**
     * @var CurlFactory
     */
    private $curlFactory;

    /**
     * @var RemoteAddress
     */
    private $remoteAddress;

    /**
     * @var Json
     */
    private $json;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @param Context $context
     * @param ConfigInterface $contactsConfig
     * @param MailInterface $mail
     * @param DataPersistorInterface $dataPersistor
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        ConfigInterface $contactsConfig,
        MailInterface $mail,
        DataPersistorInterface $dataPersistor,
        ContactFactory $contactFactory,
        StoreManagerInterface $storeManager,
        RemoteAddress $remoteAddress,
        ScopeConfigInterface $scopeConfig,
        CurlFactory $curlFactory,
        Json $json,
        LoggerInterface $logger = null
    ) {
        parent::__construct($context, $contactsConfig);
        $this->context = $context;
        $this->mail = $mail;
        $this->dataPersistor = $dataPersistor;
        $this->contactFactory = $contactFactory;
        $this->storeManager = $storeManager;
        $this->curlFactory = $curlFactory;
        $this->remoteAddress = $remoteAddress;
        $this->json = $json;
        $this->scopeConfig = $scopeConfig;
        $this->logger = $logger ?: ObjectManager::getInstance()->get(LoggerInterface::class);
    }

    /**
     * Post user question
     *
     * @return Redirect
     */
    public function execute()
    {
        $param = $this->getRequest()->getParams();
        if(isset($param['g-recaptcha-response'])){

            $curl = $this->curlFactory->create();

            $curl->addHeader('Content-Type', 'application/x-www-form-urlencoded');
            $curl->addHeader('cache-control', 'no-cache');

            $curl->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret' => $this->getSecretKey(),
                    'response' => $param['g-recaptcha-response'],
                    'remoteip' => $this->remoteAddress->getRemoteAddress()
                ]
            );
            $response = $this->json->unserialize($curl->getBody());
            if(!isset($response['success']) || !$response['success']){
                $this->messageManager->addErrorMessage("Invalid reCaptcha");
                return $this->resultRedirectFactory->create()->setPath('contact/index');
            }

        }

        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        try {

            $this->sendEmail($this->validatedParams());
            $this->contactFactory->create()
                ->addData($param)
                ->setData('store_id', $this->storeManager->getStore()->getId())
                ->save();
            $this->messageManager->addSuccessMessage(
                __('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.')
            );
            $this->dataPersistor->clear('contact_us');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->dataPersistor->set('contact_us', $this->getRequest()->getParams());
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
            $this->dataPersistor->set('contact_us', $this->getRequest()->getParams());
        }
        return $this->resultRedirectFactory->create()->setPath('contact/index');
    }

    /**
     * @param array $post Post data from contact form
     * @return void
     */
    private function sendEmail($post)
    {
        $this->mail->send(
            $post['email'],
            ['data' => new DataObject($post)]
        );
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function validatedParams()
    {
        $request = $this->getRequest();
        if (trim($request->getParam('name')) === '') {
            throw new LocalizedException(__('Enter the Name and try again.'));
        }
        if (trim($request->getParam('comment')) === '') {
            throw new LocalizedException(__('Enter the comment and try again.'));
        }
        if (false === \strpos($request->getParam('email'), '@')) {
            throw new LocalizedException(__('The email address is invalid. Verify the email address and try again.'));
        }
        if (trim($request->getParam('hideit')) !== '') {
            throw new \Exception();
        }

        return $request->getParams();
    }

    /**
     * get site key for goole recaptcha
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->scopeConfig->getValue(
            'google_recaptcha/config/secret_key',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
