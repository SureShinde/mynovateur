<?php
/**
 * Redstage OrderInstallation module purpose admin user can export order data predifined CSV only shipment created order data.
 *
 * @category: PHP
 * @package: Redstage/OrderInstallation
 * @copyright: Copyright © 2019 Magento, Inc. All rights reserved.
 * @author: Mohit Tyagi <mtyagi@redstage.com>
 * @project: Legrand & Numeric
 * @keywords: Module Redstage_OrderInstallation
 */
 
namespace Redstage\OrderInstallation\Controller\Adminhtml\Orders;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Redstage\OrderInstallation\Block\Adminhtml\Orders\Listing\Grid;
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
        $fileName   = "order-insallation.csv";
        return $this->fileFactory->create($fileName, $grid->getCsvFile(), DirectoryList::VAR_DIR);
    }
}