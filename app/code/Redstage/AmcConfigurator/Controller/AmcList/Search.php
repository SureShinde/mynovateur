<?php

namespace Redstage\AmcConfigurator\Controller\AmcList;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Data\Form\FormKey;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Checkout\Model\Cart;

class Search extends \Magento\Framework\App\Action\Action
{

     /**
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $resultJsonFactory; 

    /**
     * @param Context     $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        \Magento\Catalog\Model\ProductFactory $_productloader,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        FormKey $formKey,
        CheckoutSession $checkoutSession,
        Cart $cart
        )
    {
        $this->_productloader = $_productloader;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory; 
        $this->formKey = $formKey;
        $this->checkoutSession = $checkoutSession;
        $this->cart = $cart;
        parent::__construct($context);
    }


    public function execute()
    {
        $data = $this->getRequest()->getParam('inv_no');
        $result = $this->resultJsonFactory->create();
        $resultPage = $this->resultPageFactory->create();

        $block = $resultPage->getLayout()
                ->createBlock('Redstage\AmcConfigurator\Block\AmcSearch')
                ->setTemplate('Redstage_AmcConfigurator::amc_search.phtml')
                ->setData('inv_no',$data)
                ->toHtml();

        $result->setData(['output' => $block]);
        $_productloader = $this->_productloader->create();
        $params = array(
                'form_key' => $this->formKey->getFormKey(),
                'product' => "454", 
                'qty'   => "1"
            );
        $product = $_productloader->load("454");
        /*if (isset($buyRequest['assigned_id']) && $buyRequest['assigned_id'] && $product->getTypeId() != 'virtual') {
            $params['assigned_id'] = $buyRequest['assigned_id'];
        }*/

        $this->cart->addProduct($product, $params);
        $this->cart->save();
        return $result;
    } 
}