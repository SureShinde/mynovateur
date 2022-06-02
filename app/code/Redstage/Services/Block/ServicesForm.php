<?php
/**
 * Redstage Services module use for create service form in magento side and after take request send information to external url
 *
 * @category: PHP
 * @package: Redstage/Services
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Services
 */
 
namespace Redstage\Services\Block;

use Magento\Framework\View\Element\Template;
use Redstage\Services\Helper\Data;

class ServicesForm extends Template
{
    /**
    * @var Data
    */
    protected $dataHelper;

    /**
     * @param Template\Context $context
     * @param array $data
     * @param Data $dataHelper
     */
    public function __construct(
        Template\Context $context,
        Data $dataHelper, 
        array $data = []
    )
    {
        $this->dataHelper = $dataHelper;
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }

    /**
     * Returns action url for Service form
     *
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('services/index/post', ['_secure' => true]);
    }
    
    /**
     * Returns Call Type values for Service form
     *
     * @return array
     */
    public function getValueFromMultipleFields() {
        return $this->dataHelper->getValueFromMultipleFields();
    }
}
