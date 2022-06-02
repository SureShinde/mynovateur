<?php
namespace Redstage\BoqConfigurator\Controller\Boq;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\Stdlib\DateTime;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Theme\Block\Html\Header\Logo;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;
 
class Pdf extends Action
{
    protected $fileFactory;

    /** @var string */
    private $file;

    /** @var DateTime */
    private $dateTime;

    /**
    * @var Logo
    */
    protected $_logo;
 
    public function __construct(
        Context $context,
        Filesystem $fileSystem,
        DateTime $dateTime,
        TimezoneInterface $timezoneInterface,
        Logo $logo,
        FileFactory $fileFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->fileFactory = $fileFactory;
        $this->dateTime = $dateTime;
        $this->timezoneInterface = $timezoneInterface;
        $this->_logo = $logo;
        $this->filesystem = $fileSystem;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }
 
    public function execute()
    {

        $imagesrc = $this->getRequest()->getParam('imagesrc');
        $imagesrc = base64_decode($imagesrc);

        $mediaPath = $this->filesystem->getDirectoryRead(DirectoryList::TMP)->getAbsolutePath();
        $media = $mediaPath . 'boq_order_review';
        if (file_put_contents($media . '.png', $imagesrc)) {

            /* start to generate pdf */
            $pdf = new \Zend_Pdf();
            $pdf->pages[] = $pdf->newPage(\Zend_Pdf_Page::SIZE_A4);
            $page = $pdf->pages[0]; // this will get reference to the first page.
            $style = new \Zend_Pdf_Style();
            $style->setLineColor(new \Zend_Pdf_Color_Rgb(0,0,0));
            $font = \Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_TIMES);
            
            /** @var \Magento\Framework\Filesystem\Directory\Write $directory */
            $directory = $this->filesystem->getDirectoryWrite(
                DirectoryList::TMP
            );

            $mediaDirectory = $this->filesystem->getDirectoryWrite(
                DirectoryList::MEDIA
            );
            
            $directory->create();
            $image = @imagecreatefromstring($imagesrc);
            $logoSrc = $this->_logo->getLogoSrc();
            //$image = $imagesrc;
            if (!$image) { 
                echo "Image not found.";
                return false;
            }
             
            imageinterlace($image, 0);
            $tmpFileName = $directory->getAbsolutePath(
                'boq_order_review.png'
            );

            $logoFileName = $mediaDirectory->getAbsolutePath(
                '/logo/stores/2/legrand_llogo_1_.jpg'
            );
            //echo $logoFileName;exit;
            $pdfImage = \Zend_Pdf_Image::imageWithPath($tmpFileName);
            $pdfImageLogo = \Zend_Pdf_Image::imageWithPath($logoFileName);

            $top         = 780; //top border of the page
            $widthLimit  = 550; //half of the page width
            $heightLimit = 350; //assuming the image is not a "skyscraper"
            $width       = $pdfImage->getPixelWidth();
            $height      = $pdfImage->getPixelHeight();

             //preserving aspect ratio (proportions)
                $ratio = $width / $height;
                if ($ratio > 1 && $width > $widthLimit) {
                    $width  = $widthLimit;
                    $height = $width / $ratio;
                } elseif ($ratio < 1 && $height > $heightLimit) {
                    $height = $heightLimit;
                    $width  = $height * $ratio;
                } elseif ($ratio == 1 && $height > $heightLimit) {
                    $height = $heightLimit;
                    $width  = $widthLimit;
                }

                
                $y1 = $top - $height;
                $y2 = $top;
                $x1 = 20;
                $x2 = $x1 + $width;
                
            $page->drawImage($pdfImageLogo, 10, 800, 100, 830);
            $page->drawImage($pdfImage, $x1, $y1, $x2, $y2);
            $directory->delete($directory->getRelativePath($tmpFileName));
            if (is_resource($image)) {
                imagedestroy($image);
            }


     
            $fileName = $this->getFilename();
            echo $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $fileName.";";
            $this->fileFactory->create(
               $fileName,
               $pdf->render(),
               \Magento\Framework\App\Filesystem\DirectoryList::MEDIA, // this pdf will be saved in media directory with the name boqlog_currentdate currenttime.pdf
               'application/pdf'
            );


        } else {
            return 'failed';
        }
        

    }   
    
    /**
     * Generate a log entry filename.
     *
     * @return string
     */
    private function getFilename(): string
    {
        return sprintf('boqlog_%s_%s.pdf', $this->timezoneInterface->date()->format('Y-m-d'), $this->timezoneInterface->date()->format('H:i:s'));
    }

    /**
     * Get logo image URL
     *
     * @return string
     */
    public function getLogoSrc()
    {    
        return $this->_logo->getLogoSrc();
    }
}