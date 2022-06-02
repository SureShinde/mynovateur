<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryShipping
 * @author    Webkul
 * @copyright Copyright (c) 2010-2016 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\DelhiveryShipping\Model;

use Webkul\DelhiveryShipping\Api\Data\ManagepincodeInterface;
use Magento\Framework\DataObject\IdentityInterface;

/**
 * DelhiveryShipping Managepincode Model
 *
 * @method \Webkul\DelhiveryShipping\Model\ResourceModel\Managepincode _getResource()
 */
class Managepincode extends \Magento\Framework\Model\AbstractModel implements ManagepincodeInterface, IdentityInterface
{
    /**
     * No route page id
     */
    const NOROUTE_ENTITY_ID = 'no-route';

    /**#@+
     * Pincode's Statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    /**#@-*/

    /**#@+
     * Pincode's Yes/No
     */
    const STATUS_YES = 'Y';
    const STATUS_NO = 'N';
    /**#@-*/

    /**
     * DelhiveryShipping Payment cache tag
     */
    const CACHE_TAG = 'wk_delhivery_pincode';

    /**
     * @var string
     */
    protected $_cacheTag = 'wk_delhivery_pincode';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'wk_delhivery_pincode';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Webkul\DelhiveryShipping\Model\ResourceModel\Managepincode');
    }

    /**
     * Load object data
     *
     * @param int|null $id
     * @param string $field
     * @return $this
     */
    public function load($id, $field = null)
    {
        if ($id === null) {
            return $this->noRoutePayment();
        }
        return parent::load($id, $field);
    }

    /**
     * Load No-Route Managepincode
     *
     * @return \Webkul\DelhiveryShipping\Model\Managepincode
     */
    public function noRoutePayment()
    {
        return $this->load(self::NOROUTE_ENTITY_ID, $this->getIdFieldName());
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get ID
     *
     * @return int
     */
    public function getId()
    {
        return parent::getData(self::ENTITY_ID);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return \Webkul\DelhiveryShipping\Api\Data\ManagepincodeInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * Prepare pincode's statuses.
     * Available event to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [
            self::STATUS_ENABLED => __('Enable'),
            self::STATUS_DISABLED => __('Disable')
        ];
    }

    /**
     * Prepare pincode's statuses.
     * Available event to customize statuses.
     *
     * @return array
     */
    public function getAvailableYesNo()
    {
        return [
            self::STATUS_YES => __('Y'),
            self::STATUS_NO => __('N')
        ];
    }
}
