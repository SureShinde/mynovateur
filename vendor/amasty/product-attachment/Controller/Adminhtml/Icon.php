<?php

namespace Amasty\ProductAttachment\Controller\Adminhtml;

abstract class Icon extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Amasty_ProductAttachment::icon';
}
