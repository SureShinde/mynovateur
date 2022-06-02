<?php
namespace Redstage\Carousel\Block\Adminhtml\Slide;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Redstage\Carousel\Model\slideFactory
     */
    protected $_slideFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Redstage\Carousel\Model\SlideFactory $SlideFactory,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_slideFactory = $SlideFactory;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('slide_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_slideFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();
        return $this;
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'slide_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'slide_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );

        $this->addColumn('image',
            array(
                'header' => __('Image'),
                'width' => '150px',
                'sortable' => false,
                'filter' => false,
               // 'renderer'  => 'carousel/adminhtml_slide_grid_renderer_image'
                'renderer'  => '\Redstage\Carousel\Block\Adminhtml\Carousel\Grid\Renderer\Image'
            )
        );

        $this->addColumn(
            'name',
            [
                'header' => __('Name'),
                'index' => 'name',
            ]
        );
        $this->addColumn(
            'link',
            [
                'header' => __('Link URL'),
                'index' => 'link',
            ]
        );
        $this->addColumn(
            'sort_order',
            [
                'header' => __('Sort Order'),
                'index' => 'sort_order',
            ]
        );
        $this->addColumn(
            'store_id',
            [
                'header' => __('Store'),
                'index' => 'store_id',
                'type'      => 'store',
            ]
        );
        $this->addColumn(
            'active',
            [
                'header' => __('Active'),
                'index' => 'active',
                'type' => 'options',
                'options' => array(
                    '0' => 'No',
                    '1' => 'Yes'
                )
            ]
        );
        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

    public function getGridUrl()
    {
        return $this->getUrl('redstage_carousel/*/index', ['_current' => true]);
    }

    public function getRowUrl($row)
    {

        return $this->getUrl(
            'redstage_carousel/*/edit',
            ['slide_id' => $row->getId()]
        );
    }

}