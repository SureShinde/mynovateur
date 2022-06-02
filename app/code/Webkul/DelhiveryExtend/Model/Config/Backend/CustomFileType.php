<?php
 /**
  * Webkul Software.
  *
  * @category  Webkul_DelhiveryExtend
  *
  * @author    Webkul
  * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
  * @license   https://store.webkul.com/license.html
  */

namespace  Webkul\DelhiveryExtend\Model\Config\Backend;

class CustomFileType extends \Magento\Config\Model\Config\Backend\File
{
    /**
     * @return string[]
     */
    public function _getAllowedExtensions() {
        return ['csv'];
    }
}
