<?php

namespace Amasty\ProductAttachment\Controller\Adminhtml\File;

use Amasty\ProductAttachment\Controller\Adminhtml\File;

class Create extends File
{
    /**
     * @return void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
