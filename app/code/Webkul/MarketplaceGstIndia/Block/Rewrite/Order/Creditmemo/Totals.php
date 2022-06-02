<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_Marketplace
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MarketplaceGstIndia\Block\Rewrite\Order\Creditmemo;

use Webkul\Marketplace\Model\ResourceModel\Saleslist\Collection;

class Totals extends \Webkul\Marketplace\Block\Order\Creditmemo\Totals
{
    /**
     * @return array
     */
    public function getLabelProperties()
    {
        $paymentCode = '';
        if ($this->_order->getPayment()) {
            $paymentCode = $this->getOrder()->getPayment()->getMethod();
        }
        if ($paymentCode == 'mpcashondelivery') {
            return 'colspan="10" class="mark"';
        }
        return 'colspan="9" class="mark"';
    }
}
