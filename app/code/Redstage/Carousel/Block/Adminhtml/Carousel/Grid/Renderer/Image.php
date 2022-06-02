<?php
namespace Redstage\Carousel\Block\Adminhtml\Carousel\Grid\Renderer;

class Image extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    protected $_storeManager;


    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
    }


    public function render(\Magento\Framework\DataObject $row)
    {
        $filename = $row->getData('image');
        if ($filename) {
            $mediaDirectory = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
            $src = $mediaDirectory.$filename;
            return '<img src="'.$src.'" id="image_thumbnail" title="'.$filename.'" alt="'.$filename.'" width="80" height="50" />';
        }
        return '';
    }
}
