<?php

namespace Amasty\ProductAttachment\Model\File\FileScope;

interface FileScopeDataProviderInterface
{
    /**
     * @param array $params
     * @param string $dataProviderName
     *
     * @return mixed
     */
    public function execute($params, $dataProviderName);
}
