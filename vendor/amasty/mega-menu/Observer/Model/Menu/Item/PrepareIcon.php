<?php

declare(strict_types = 1);

namespace Amasty\MegaMenu\Observer\Model\Menu\Item;

use Amasty\MegaMenu\Model\DataProvider\GetIconFromRequest;
use Amasty\MegaMenu\Model\Menu\GetImagePath;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class PrepareIcon implements ObserverInterface
{
    /**
     * @var GetImagePath
     */
    private $getImagePath;

    /**
     * @var GetIconFromRequest
     */
    private $getIconFromRequest;

    public function __construct(
        GetImagePath $getImagePath,
        GetIconFromRequest $getIconFromRequest
    ) {
        $this->getImagePath = $getImagePath;
        $this->getIconFromRequest = $getIconFromRequest;
    }

    public function execute(Observer $observer): void
    {
        $entity = $observer->getDataObject();
        $iconData = $this->getIconFromRequest->execute();
        if ($iconData) {
            $entity->setIcon($this->getImagePath->execute($iconData));
        }
    }
}
