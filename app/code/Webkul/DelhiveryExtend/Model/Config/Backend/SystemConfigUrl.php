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

use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;


class SystemConfigUrl implements \Magento\Config\Model\Config\CommentInterface
{

    public function __construct(
        \Webkul\DelhiveryExtend\Helper\Data $helper
    ) {
        $this->helper = $helper;
    }

    public function getCommentText($elementValue)
    {
        $filePath = 'Sample-Pincode-Seller-Mapping.csv';
        $url = $this->helper->getSampleFileUrl($filePath);
        return 'Sample file : <a href="' .$url.'" download>Click here to Download Sample file</a>';
    }
}
