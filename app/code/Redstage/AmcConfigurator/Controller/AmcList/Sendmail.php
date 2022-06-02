<?php

namespace Redstage\AmcConfigurator\Controller\AmcList;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Redstage\SendEmail\Helper\Data;

class Sendmail extends \Magento\Framework\App\Action\Action
{

     /**
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $resultJsonFactory; 

    protected $helperData;

    /**
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        Data $helperData
        )
    {

        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory; 
        $this->helperData = $helperData;
        parent::__construct($context);
    }


    public function execute()
    {
        $name = $this->getRequest()->getPost('userName'); 
        $email = $this->getRequest()->getPost('userEmail');
        $mob = $this->getRequest()->getPost('userMob');
        $this->helperData->postEmail($name,$email,$mob);
        print "<p class='success'>Your AMC Enquiry has been submitted successfully.</p>";
        return;        
        /*$name = $this->getRequest()->getPost('userName'); 
        $email = $this->getRequest()->getPost('userEmail');
        $mob = $this->getRequest()->getPost('userMob');        
        $toEmail = "admin@phppot_samples.com";
        $subject = "My Enquiry";
        $mailHeaders = "From: " . $name . "<". $email .">\r\n";
        if(mail($toEmail, $subject, $mob, $mailHeaders)) {
            print "<p class='success'>Mail Sent.</p>";
        } else {
            print "<p class='Error'>Problem in Sending Mail.</p>";
        }*/

    } 
}