<?php

namespace Redstage\CustomCreditmemo\Model\ResourceModel\Reference;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Redstage\CustomCreditmemo\Model\Reference;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Redstage\CustomCreditmemo\Model\Reference::class, Redstage\CustomCreditmemo\Model\ResourceModel\Reference::class);
    }
}
