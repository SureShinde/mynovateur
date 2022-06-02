<?php

namespace Amasty\ProductAttachment\Model\File\FileScope;

interface SaveFileScopeInterface
{
    /**
     * @param array $params
     * @param string $saveProcessorName
     *
     * @return void
     */
    public function execute($params, $saveProcessorName);
}
