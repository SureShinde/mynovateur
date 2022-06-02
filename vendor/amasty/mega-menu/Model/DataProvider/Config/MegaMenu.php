<?php

declare(strict_types=1);

namespace Amasty\MegaMenu\Model\DataProvider\Config;

use Amasty\MegaMenu\Model\ConfigProvider;
use Amasty\MegaMenu\Model\OptionSource\IconStatus;
use Amasty\MegaMenuLite\Model\Detection\MobileDetect;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class MegaMenu implements ArgumentInterface
{
    /**
     * @var ConfigProvider
     */
    private $configProvider;

    /**
     * @var MobileDetect
     */
    private $mobileDetect;

    public function __construct(
        ConfigProvider $configProvider,
        MobileDetect $mobileDetect
    ) {
        $this->configProvider = $configProvider;
        $this->mobileDetect = $mobileDetect;
    }

    public function modifyConfig(array &$config): void
    {
        $config['is_sticky'] = $this->configProvider->getStickyEnabled();
        $config['mobile_class'] = $this->configProvider->getMobileTemplateClass();
        $config['is_icons_available'] = $this->getIsIconsAvailable();
    }

    private function getIsIconsAvailable(): bool
    {
        $iconsStatus = $this->configProvider->getIconsStatus();
        $isMobile = $this->mobileDetect->isMobile();

        return ($isMobile && $iconsStatus != IconStatus::DESKTOP)
            || (!$isMobile && $iconsStatus != IconStatus::MOBILE);
    }
}
