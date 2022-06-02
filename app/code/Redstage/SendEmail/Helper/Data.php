<?php
namespace Redstage\SendEmail\Helper;

use Psr\Log\LoggerInterface;
use Magento\Framework\App\Area;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\MailException;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Message\ManagerInterface;

class Data extends AbstractHelper
{
    const EMAIL_TEMPLATE = 'email_section/sendmail/email_template';

    const EMAIL_SERVICE_ENABLE = 'email_section/sendmail/enabled';

    /**
     * @var StateInterface
     */
    private $inlineTranslation;

    /**
     * @var TransportBuilder
     */
    private $transportBuilder;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var LoggerInterface
     */
    private $logger;

    private $messageManager;


    /**
     * Data constructor.
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param TransportBuilder $transportBuilder
     * @param StateInterface $inlineTranslation
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        LoggerInterface $logger,
        ManagerInterface $messageManager

    )
    {
        $this->storeManager = $storeManager;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->logger = $logger;
        $this->messageManager = $messageManager;

        parent::__construct($context);
    }

    /**
     * Send Mail
     *
     * @return $this
     *
     * @throws LocalizedException
     * @throws MailException
     */
    public function postEmail($name,$email,$mob)
    {
        $email = $email; //set receiver mail        

        $this->inlineTranslation->suspend();
        $storeId = $this->getStoreId();

        /* email template */
        $template = $this->scopeConfig->getValue(
            self::EMAIL_TEMPLATE,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );

        $vars = [
            'message_1' => $name,
            'message_2' => $mob,
            'store' => $this->getStore()
        ];

        $sender =[
            'email' => $email,
            'name' =>  $name
        ];
        // set from email
        /*$sender['email'] = 'bgoswami@redstage.com';
        $sender['name'] = 'admin';*/
        /*$sender =[
            'email' => 'bgoswami@redstage.com',
            'name' => 'admin'
        ];*/
        $receiverEmail = 'bgoswami@redstage.com';
        $receiverName = 'Admin';

        /*$this->scopeConfig->getValue(
            'email_section/sendmail/sender',
            ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );*/

        $transport = $this->transportBuilder->setTemplateIdentifier(
            $template
        )->setTemplateOptions(
            [
                'area' => Area::AREA_FRONTEND,
                'store' => $this->getStoreId()
            ]
        )->setTemplateVars(
            $vars
        )->setFromByScope(
            $sender
        )->addTo(
            $receiverEmail, $receiverName     
        )->getTransport();

        try {
            $transport->sendMessage();
            $this->messageManager->addSuccess(__("Email sent successfully"));           

        } catch (\Exception $exception) {
            $this->logger->critical($exception->getMessage());
            $this->messageManager->addError($exception->getMessage());

        }
        $this->inlineTranslation->resume();

        return $this;
    }

    /*
     * get Current store id
     */
    public function getStoreId()
    {
        return $this->storeManager->getStore()->getId();
    }

    /*
     * get Current store Info
     */
    public function getStore()
    {
        return $this->storeManager->getStore();
    }
}