<?php
namespace Redstage\OrderExport\Controller\Adminhtml\Export;

use Magento\Framework\App\Filesystem\DirectoryList;
use Redstage\OrderExport\Model\ExportFields;

class Export extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $fileFactory;

    /**
     * @var \Magento\Framework\Filesystem\Directory\WriteInterface
     */
    protected $directory;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    protected $_orderCollectionFactory;

    /**
     * @var \Redstage\OrderExport\Model\ExportOrders
     */
    protected $exportOrders;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     * @param ExportFields $exportFields
     * @param \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Redstage\OrderExport\Model\ExportOrders $exportOrders,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
    ) {
        $this->directory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        $this->fileFactory = $fileFactory;
        $this->exportOrders = $exportOrders;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        parent::__construct($context);

    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $params = $this->getRequest()->getParams();
         echo "<pre>"; print_r($params);die;
        $orders = $this->_orderCollectionFactory->create()
            ->addFieldToFilter('created_at', array('gteq' => $params['from']))
            ->addFieldToFilter('created_at', array('lteq' => $params['to']));
       // if($params[''])

        $fileName = 'orderExport_'.time().'.csv';
        $filepath = 'export/'.$fileName;
        $this->directory->create('export');
        $stream = $this->directory->openFile($filepath, 'w+');
        $stream->lock();
        $stream->writeCsv($this->exportOrders->getHeaders());

        foreach ($orders as $order){
            $stream->writeCsv($this->exportOrders->prepareOrder($order));
        }

        $content['type'] = 'filename';
        $content['value'] = $filepath;
        $content['rm'] = 1;
        return $this->fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }
}
