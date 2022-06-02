<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MpRmaSystem
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MpRmaSystem\Block\Adminhtml\Rma\View\Tab;

use Magento\Backend\Block\Widget\Tab\TabInterface;
use Webkul\MpRmaSystem\Helper\Data as mpRmaHelper;
use Webkul\MpRmaSystem\Model\ResourceModel\Conversation\CollectionFactory;

class Details extends \Magento\Backend\Block\Widget implements TabInterface
{
    
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        mpRmaHelper $mpRmaHelper,
        CollectionFactory $conversationCollection,
        array $data = []
    ) {
        $this->mpRmaHelper = $mpRmaHelper;
        $this->conversationCollection = $conversationCollection;
        parent::__construct($context, $data);
    }
    
    /**
     * Set template
     */
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('rma/view/tab/details.phtml');
    }

    public function getAllConversations()
    {
        $rmaId = $this->getRequest()->getParam('id');
        $collection = $this->conversationCollection
                            ->create()
                            ->addFieldToFilter("rma_id", $rmaId);
        return $collection;
    }
    
    /**
     * @return array|null
     */
    public function getRma()
    {
        return $this->coreRegistry->registry('mprmasystem_rma');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Information');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('RMA Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    public function helper()
    {
        return $this->mpRmaHelper;
    }
}
