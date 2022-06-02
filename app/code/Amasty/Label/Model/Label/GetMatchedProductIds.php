<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2021 Amasty (https://www.amasty.com)
 * @package Amasty_Label
 */


declare(strict_types=1);

namespace Amasty\Label\Model\Label;

use Amasty\Label\Api\Data\LabelInterface;
use Amasty\Label\Model\ResourceModel\Label\GetRelatedEntitiesIds as GetStoreIdsByLabelId;
use Amasty\Label\Model\RuleFactory;
use Magento\Framework\App\Area;
use Magento\Framework\App\State;
use Magento\Store\Model\Store;

class GetMatchedProductIds implements GetMatchedProductIdsInterface
{
    /**
     * @var GetStoreIdsByLabelId
     */
    private $getStoreIdsByLabelId;

    /**
     * @var RuleFactory
     */
    private $ruleFactory;

    /**
     * @var State
     */
    private $appState;

    public function __construct(
        GetStoreIdsByLabelId $getStoreIdsByLabelId,
        RuleFactory $ruleFactory,
        State $appState
    ) {
        $this->getStoreIdsByLabelId = $getStoreIdsByLabelId;
        $this->ruleFactory = $ruleFactory;
        $this->appState = $appState;
    }
    
    public function executeWrapper(LabelInterface $label, ?array $productIds): array
    {
        return $this->appState->emulateAreaCode(
            Area::AREA_FRONTEND,
            [$this, 'execute'],
            [$label, $productIds]
        );
    }

    /**
     * @param LabelInterface $label
     * @param array|null $productIds
     *
     * @return int[]
     */
    public function execute(LabelInterface $label, ?array $productIds): array
    {
        $labelStores = $this->getLabelStoreIds($label->getLabelId());
        $result = [];

        if ($labelStores !== '') {
            $ruleModel = $this->ruleFactory->create();
            $ruleModel->setConditions([]);
            $ruleModel->setStores($labelStores);
            $ruleModel->setConditionsSerialized($label->getConditionSerialized());

            if (!empty($productIds)) {
                $ruleModel->setProductFilter($productIds);
            }

            $result = $ruleModel->getMatchingProductIdsByLabel($label);
        }

        return $result;
    }

    private function getLabelStoreIds(int $labelId): string
    {
        $storeIds = $this->getStoreIdsByLabelId->execute($labelId);

        if (in_array(Store::DEFAULT_STORE_ID, $storeIds)) {
            $storeIds = [Store::DEFAULT_STORE_ID];
        }

        return join(',', $storeIds);
    }
}
