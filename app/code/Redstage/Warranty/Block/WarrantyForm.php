<?php
/**
 * Redstage Warranty module use for create warranty form in magento side and after take request send information to external url
 *
 * @category: PHP
 * @package: Redstage/Warranty
 * @copyright: Copyright © 2020 Magento, Inc. All rights reserved.
 * @keywords: Module Redstage_Warranty
 */

namespace Redstage\Warranty\Block;

use Magento\Framework\View\Element\Template;

class WarrantyForm extends Template
{
    /**
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }

    /**
     * Returns action url for Warranty form
     *
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('warranty/index/post', ['_secure' => true]);
    }
}
