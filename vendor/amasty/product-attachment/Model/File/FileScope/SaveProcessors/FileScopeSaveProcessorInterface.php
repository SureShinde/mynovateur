<?php

namespace Amasty\ProductAttachment\Model\File\FileScope\SaveProcessors;

interface FileScopeSaveProcessorInterface
{
    /**
     * @param array $params
     *
     * @return array
     */
    public function execute($params);
}
