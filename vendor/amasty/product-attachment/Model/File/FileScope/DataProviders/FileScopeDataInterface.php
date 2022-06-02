<?php

namespace Amasty\ProductAttachment\Model\File\FileScope\DataProviders;

interface FileScopeDataInterface
{
    /**
     * @param array $params
     *
     * @return \Amasty\ProductAttachment\Api\Data\FileInterface|\Amasty\ProductAttachment\Api\Data\FileInterface[]|array
     */
    public function execute($params);
}
