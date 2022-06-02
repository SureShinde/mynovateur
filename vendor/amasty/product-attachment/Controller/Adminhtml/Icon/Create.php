<?php

namespace Amasty\ProductAttachment\Controller\Adminhtml\Icon;

use Amasty\ProductAttachment\Controller\Adminhtml\Icon;

class Create extends Icon
{
    /**
     * @return void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
