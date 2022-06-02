<?php
namespace Redstage\LayeredNavigation\Block;
class Categorybanner extends \Magento\Framework\View\Element\Template
{
  protected $_registry;
  protected  $_storeManager;
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    )
    {
        $this->_registry = $registry;
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getCurrentCategory()
    {
        return $this->_registry->registry('current_category');
    }

    public function getBaseUrl()
    {
       return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB);
    }
}
