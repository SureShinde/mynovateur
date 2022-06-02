<?php
namespace Redstage\Carousel\Controller\Adminhtml\Slide;

class Save extends \Redstage\Carousel\Controller\Adminhtml\Slide
{
    /**
    * Backend session
    * 
    * @var \Magento\Backend\Model\Session
    */
    protected $_backendSession;
    /**
    * @var \Magento\Framework\Image\AdapterFactory
    */
    protected $adapterFactory;
    /**
    * @var \Magento\MediaStorage\Model\File\UploaderFactory
    */
    protected $uploader;
    /**
    * @var \Magento\Framework\Filesystem
    */
    protected $filesystem;
    /**
    * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
    */
    /**
     * constructor
     * 
     * @param \Magento\Backend\Model\Session $backendSession
     * @param \Redstage\Carousel\Model\SlideFactory $slideFactory
     * @param \Magento\Framework\Image\AdapterFactory $adapterFactory
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $uploader
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\Model\Session $backendSession,
        \Redstage\Carousel\Model\SlideFactory $slideFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploader,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_backendSession = $backendSession;
        $this->adapterFactory = $adapterFactory;
        $this->uploader = $uploader;
        $this->filesystem = $filesystem;
        parent::__construct($slideFactory, $registry, $resultRedirectFactory, $context);
    }

    /**
     * run the action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPost('slide');

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
          
            $slide = $this->_initslide();
            
            if (isset($_FILES['image']['name']) && file_exists($_FILES['image']['tmp_name']) && $_FILES['image']['name'] != '') {

                //Save image upload
                try {
                    $mediaPath = 'carousel-images/';
                    $uploader = $this->uploader->create(['fileId' => 'image']);
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(false);
                    $mediaDirectory = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                    $result = $uploader->save($mediaDirectory->getAbsolutePath($mediaPath));
                    $data['image'] = $mediaPath.$result['file'];
                } catch (Exception $e) {
                    $this->messageManager->addException($e, __('Error occurred while saving image file.'));
                     $this->_getSession()->setRedstageCarosuelSlideData($data);
                     $resultRedirect->setPath(
                        'redstage_carousel/*/edit',
                        ['slide_id' => $slide->getId(),'_current' => true]);
                    return $resultRedirect;
                }
            } else {

                    if (isset($data['image']) && isset($data['image']['value'])) {
                        if (isset($data['image']['delete'])) {
                            $data['image'] = '';
                            $data['delete_image'] = true;
                        } elseif (isset($data['image']['value'])) {
                            $data['image'] = $data['image']['value'];
                        } else {
                            $data['image'] = '';
                        }
                    }
            }    

            try {

                $slide->setData($data);
                $slide->save();
                $this->messageManager->addSuccess(__('Slide saved.'));
                $this->_backendSession->setRedstageCarosuelSlideData(false);
                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath(
                        'redstage_carousel/*/edit',
                        [
                            'slide_id' => $slide->getId(),
                            '_current' => true
                        ]
                    );
                    return $resultRedirect;
                }
                $resultRedirect->setPath('redstage_carousel/*/');
                return $resultRedirect;

            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Could not save slide.'));
            }
            $this->_getSession()->setRedstageCarosuelSlideData($data);
            $resultRedirect->setPath(
                'redstage_carousel/*/edit',
                [
                    'slide_id' => $slide->getId(),
                    '_current' => true
                ]
            );
            return $resultRedirect;
        }
        $resultRedirect->setPath('redstage_carousel/*/');
        return $resultRedirect;
    }

    

}
