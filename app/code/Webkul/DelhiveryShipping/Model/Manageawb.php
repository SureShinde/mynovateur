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

use Webkul\DelhiveryShipping\Api\Data\ManageawbInterface;
use Magento\Framework\DataObject\IdentityInterface;

/**
 * DelhiveryShipping Manageawb Model
 *
 * @method \Webkul\DelhiveryShipping\Model\ResourceModel\Manageawb _getResource()
 */
class Manageawb extends \Magento\Framework\Model\AbstractModel implements ManageawbInterface, IdentityInterface
{
    /**
     * No route page id
     */
    const NOROUTE_ENTITY_ID = 'no-route';

    /**#@+
     * Pincode's Statuses
     */
    const STATUS_USED = 1;
    const STATUS_UNUSED = 2;
    /**#@-*/

    /**
     * DelhiveryShipping Payment cache tag
     */
    const CACHE_TAG = 'wk_delhivery_awb';

    /**
     * @var string
     */
    protected $_cacheTag = 'wk_delhivery_awb';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'wk_delhivery_awb';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Webkul\DelhiveryShipping\Model\ResourceModel\Manageawb');
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
     * Load No-Route Manageawb
     *
     * @return \Webkul\DelhiveryShipping\Model\Manageawb
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
     * @return \Webkul\DelhiveryShipping\Api\Data\ManageawbInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * Prepare Awb state.
     * Available event to customize statuses.
     *
     * @return array
     */
    public function getAvailableState()
    {
        return [
            self::STATUS_USED => __('Used'),
            self::STATUS_UNUSED => __('Unused')
        ];
    }
}
