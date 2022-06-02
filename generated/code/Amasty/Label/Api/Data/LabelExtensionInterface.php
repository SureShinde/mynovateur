<?php
namespace Amasty\Label\Api\Data;

/**
 * ExtensionInterface class for @see \Amasty\Label\Api\Data\LabelInterface
 */
interface LabelExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return \Amasty\Label\Api\Data\LabelFrontendSettingsInterface|null
     */
    public function getFrontendSettings();

    /**
     * @param \Amasty\Label\Api\Data\LabelFrontendSettingsInterface $frontendSettings
     * @return $this
     */
    public function setFrontendSettings(\Amasty\Label\Api\Data\LabelFrontendSettingsInterface $frontendSettings);

    /**
     * @return \Amasty\Label\Api\Data\RenderSettingsInterface|null
     */
    public function getRenderSettings();

    /**
     * @param \Amasty\Label\Api\Data\RenderSettingsInterface $renderSettings
     * @return $this
     */
    public function setRenderSettings(\Amasty\Label\Api\Data\RenderSettingsInterface $renderSettings);

    /**
     * @return \Amasty\Label\Api\Data\LabelTooltipInterface|null
     */
    public function getLabelTooltip();

    /**
     * @param \Amasty\Label\Api\Data\LabelTooltipInterface $labelTooltip
     * @return $this
     */
    public function setLabelTooltip(\Amasty\Label\Api\Data\LabelTooltipInterface $labelTooltip);
}
