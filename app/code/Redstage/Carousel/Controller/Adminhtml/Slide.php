<?php

namespace Redstage\Carousel\Controller\Adminhtml;

abstract class Slide extends \Magento\Backend\App\Action
{
   

    protected $_slideFactory;
    protected $_coreRegistry;
    protected $_resultRedirectFactory;

    public function __construct(
        \Redstage\Carousel\Model\SlideFactory $slideFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_slideFactory           = $slideFactory;
        $this->_coreRegistry          = $coreRegistry;
        $this->_resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    protected function _initSlide()
    {
        $slideId  = (int) $this->getRequest()->getParam('slide_id');
        
        $sample    = $this->_slideFactory->create();
        if ($slideId) {
            $sample->load($slideId);
        }
        $this->_coreRegistry->register('redstage_carousel_slide', $sample);
        return $sample;
    }
}
