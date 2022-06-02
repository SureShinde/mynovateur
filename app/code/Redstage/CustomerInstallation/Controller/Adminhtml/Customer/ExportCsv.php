<?php
namespace Redstage\CustomerInstallation\Controller\Adminhtml\Customer;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Redstage\CustomerInstallation\Block\Adminhtml\Customer\Listing\Grid;
use Magento\Framework\View\Result\PageFactory;

class ExportCsv extends Action
{
    /**
     * @var FileFactory
     */
    private $fileFactory;

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * ExportCsv constructor.
     * @param Context $context
     * @param FileFactory $fileFactory
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        FileFactory $fileFactory,
        PageFactory $resultPageFactory
    ) {
        $this->fileFactory = $fileFactory;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $grid = $resultPage->getLayout()->createBlock(Grid::class);
        $fileName   = "customer-master-in-sap.csv";
        return $this->fileFactory->create($fileName, $grid->getCsvFile(), DirectoryList::VAR_DIR);
    }
}