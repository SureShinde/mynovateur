<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Redstage\BoqConfigurator\Controller\Product;

use Magento\Framework\App\Action\Context;

class SaveQuote extends \Magento\Framework\App\Action\Action
{
   
    /**
      * @var \Redstage\BoqConfigurator\Model\BoqGrouproomlinkFactory $_productGroupsLinks
      */
    protected $_boqQuote; 

    /**
    * @param Redstage\BoqConfigurator\Model\BoqquoteFactory $boqQuote
    */
    public function __construct(
        Context $context,
        \Redstage\BoqConfigurator\Model\BoqquoteFactory $boqQuote
    ) {
        $this->_boqQuote = $boqQuote;
        parent::__construct($context);
    }

    public function execute()
    {
        
        // print_r(json_decode($data, true) );exit;
        /*print_r($title);
        print_r($customerId);
        print_r($data);exit;*/

        try {
            $title = $this->getRequest()->getParam('title');
            $customerId = $this->getRequest()->getParam('customer_id');
            $data = $this->getRequest()->getParam('data');
            
            $boqQuoteModel = $this->_boqQuote->create();

            $boqQuoteModel->setData('customer_id', $customerId);
            $boqQuoteModel->setData('data', $data);
            $boqQuoteModel->setData('title', $title);
            $boqQuoteModel->save();
            echo "1";
            
        } catch (\Exception $e) {
            //echo "We can\'t submit your request, Please try again.";
            echo "0";
        }
        
    }


}