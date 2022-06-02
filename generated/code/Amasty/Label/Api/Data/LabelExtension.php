<?php
namespace Amasty\Label\Api\Data;

/**
 * Extension class for @see \Amasty\Label\Api\Data\LabelInterface
 */
class LabelExtension extends \Magento\Framework\Api\AbstractSimpleObject implements LabelExtensionInterface
{
    /**
     * @return \Amasty\Label\Api\Data\LabelFrontendSettingsInterface|null
     */
    public function getFrontendSettings()
    {
        return $this->_get('frontend_settings');
    }

    /**
     * @param \Amasty\Label\Api\Data\LabelFrontendSettingsInterface $frontendSettings
     * @return $this
     */
    public function setFrontendSettings(\Amasty\Label\Api\Data\LabelFrontendSettingsInterface $frontendSettings)
    {
        $this->setData('frontend_settings', $frontendSettings);
        return $this;
    }

    /**
     * @return \Amasty\Label\Api\Data\RenderSettingsInterface|null
     */
    public function getRenderSettings()
    {
        return $this->_get('render_settings');
    }

    /**
     * @param \Amasty\Label\Api\Data\RenderSettingsInterface $renderSettings
     * @return $this
     */
    public function setRenderSettings(\Amasty\Label\Api\Data\RenderSettingsInterface $renderSettings)
    {
        $this->setData('render_settings', $renderSettings);
        return $this;
    }

    /**
     * @return \Amasty\Label\Api\Data\LabelTooltipInterface|null
     */
    public function getLabelTooltip()
    {
        return $this->_get('label_tooltip');
    }

    /**
     * @param \Amasty\Label\Api\Data\LabelTooltipInterface $labelTooltip
     * @return $this
     */
    public function setLabelTooltip(\Amasty\Label\Api\Data\LabelTooltipInterface $labelTooltip)
    {
        $this->setData('label_tooltip', $labelTooltip);
        return $this;
    }
}
