<?php

namespace Redstage\AmcConfigurator\Controller\NonAmc;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Redstage\AmcConfigurator\Model\NonamcListFactory;
use Redstage\AmcConfigurator\Model\Upload\FileUploader;

class Save extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \MaNonamcListFactorygento\Framework\App\Action\Context $context
     */
    public function __construct(
        Context $context,
        NonamcListFactory $nonamcListFactory,
        FileUploader $fileUploader
    ) {
        $this->nonamcListFactory = $nonamcListFactory;
        $this->fileUploader = $fileUploader;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getParams();
        if (isset($data)) {
            $id = $data['id'];
            $salesOrg = $data['sales_org'];
            try {
                $files = $this->getRequest()->getFiles();
                if (isset($files['nonamcimages'])) {
                    foreach ($files['nonamcimages'] as $key => $value) {
                        if (!empty($value['name'])) {
                            try {
                                $name = $value['name'];
                                $name = str_replace(" ", "_", $name);
                                $uploadImg = $this->fileUploader->saveImageToMediaFolder("nonamcimages[$key]");
                                $nonAmcRecord = $this->nonamcListFactory->create();
                                $nonAmcRecord->setImage($name);
                                $nonAmcRecord->setSalesOrg($salesOrg);
                                $nonAmcRecord->save();
                            } catch (\Exception $e) {
                                $this->messageManager->addErrorMessage($e->getMessage());
                            }
                        }
                    }
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $this->messageManager->addExceptionMessage($e, __('Something Went Wrong While Saving Non AMC.'));
                return $resultRedirect->setPath('*/amclist#nonamc_accordion');
            }
        }
        $this->messageManager->addSuccessMessage(__('Non AMC Image Upload Successfully'));
        return $resultRedirect->setPath('*/amclist#nonamc_accordion');
    }
}
