<?php
namespace Fastly\Cdn\Model\Config;

/**
 * Interceptor class for @see \Fastly\Cdn\Model\Config
 */
class Interceptor extends \Fastly\Cdn\Model\Config implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Filesystem\Directory\ReadFactory $readFactory, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Framework\App\Cache\StateInterface $cacheState, \Magento\Framework\Module\Dir\Reader $reader, \Magento\PageCache\Model\Varnish\VclGeneratorFactory $vclGeneratorFactory, ?\Magento\Framework\Serialize\Serializer\Json $serializer = null)
    {
        $this->___init();
        parent::__construct($readFactory, $scopeConfig, $cacheState, $reader, $vclGeneratorFactory, $serializer);
    }

    /**
     * {@inheritdoc}
     */
    public function isFastlyEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isFastlyEnabled');
        return $pluginInfo ? $this->___callPlugins('isFastlyEnabled', func_get_args(), $pluginInfo) : parent::isFastlyEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function getFastlyVersion()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFastlyVersion');
        return $pluginInfo ? $this->___callPlugins('getFastlyVersion', func_get_args(), $pluginInfo) : parent::getFastlyVersion();
    }

    /**
     * {@inheritdoc}
     */
    public function getCID()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCID');
        return $pluginInfo ? $this->___callPlugins('getCID', func_get_args(), $pluginInfo) : parent::getCID();
    }

    /**
     * {@inheritdoc}
     */
    public function getApiEndpoint()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getApiEndpoint');
        return $pluginInfo ? $this->___callPlugins('getApiEndpoint', func_get_args(), $pluginInfo) : parent::getApiEndpoint();
    }

    /**
     * {@inheritdoc}
     */
    public function getServiceId()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getServiceId');
        return $pluginInfo ? $this->___callPlugins('getServiceId', func_get_args(), $pluginInfo) : parent::getServiceId();
    }

    /**
     * {@inheritdoc}
     */
    public function getApiKey()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getApiKey');
        return $pluginInfo ? $this->___callPlugins('getApiKey', func_get_args(), $pluginInfo) : parent::getApiKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getTtl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getTtl');
        return $pluginInfo ? $this->___callPlugins('getTtl', func_get_args(), $pluginInfo) : parent::getTtl();
    }

    /**
     * {@inheritdoc}
     */
    public function getStaleTtl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getStaleTtl');
        return $pluginInfo ? $this->___callPlugins('getStaleTtl', func_get_args(), $pluginInfo) : parent::getStaleTtl();
    }

    /**
     * {@inheritdoc}
     */
    public function getStaleErrorTtl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getStaleErrorTtl');
        return $pluginInfo ? $this->___callPlugins('getStaleErrorTtl', func_get_args(), $pluginInfo) : parent::getStaleErrorTtl();
    }

    /**
     * {@inheritdoc}
     */
    public function getAdminPathTimeout()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAdminPathTimeout');
        return $pluginInfo ? $this->___callPlugins('getAdminPathTimeout', func_get_args(), $pluginInfo) : parent::getAdminPathTimeout();
    }

    /**
     * {@inheritdoc}
     */
    public function getXMagentoTagsSize()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getXMagentoTagsSize');
        return $pluginInfo ? $this->___callPlugins('getXMagentoTagsSize', func_get_args(), $pluginInfo) : parent::getXMagentoTagsSize();
    }

    /**
     * {@inheritdoc}
     */
    public function getIgnoredUrlParameters()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIgnoredUrlParameters');
        return $pluginInfo ? $this->___callPlugins('getIgnoredUrlParameters', func_get_args(), $pluginInfo) : parent::getIgnoredUrlParameters();
    }

    /**
     * {@inheritdoc}
     */
    public function getBasicAuthenticationStatus()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getBasicAuthenticationStatus');
        return $pluginInfo ? $this->___callPlugins('getBasicAuthenticationStatus', func_get_args(), $pluginInfo) : parent::getBasicAuthenticationStatus();
    }

    /**
     * {@inheritdoc}
     */
    public function canPurgeCatalogCategory()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canPurgeCatalogCategory');
        return $pluginInfo ? $this->___callPlugins('canPurgeCatalogCategory', func_get_args(), $pluginInfo) : parent::canPurgeCatalogCategory();
    }

    /**
     * {@inheritdoc}
     */
    public function canPurgeCatalogProduct()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canPurgeCatalogProduct');
        return $pluginInfo ? $this->___callPlugins('canPurgeCatalogProduct', func_get_args(), $pluginInfo) : parent::canPurgeCatalogProduct();
    }

    /**
     * {@inheritdoc}
     */
    public function canPurgeCmsPage()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canPurgeCmsPage');
        return $pluginInfo ? $this->___callPlugins('canPurgeCmsPage', func_get_args(), $pluginInfo) : parent::canPurgeCmsPage();
    }

    /**
     * {@inheritdoc}
     */
    public function canPreserveStatic()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canPreserveStatic');
        return $pluginInfo ? $this->___callPlugins('canPreserveStatic', func_get_args(), $pluginInfo) : parent::canPreserveStatic();
    }

    /**
     * {@inheritdoc}
     */
    public function canUseSoftPurge()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canUseSoftPurge');
        return $pluginInfo ? $this->___callPlugins('canUseSoftPurge', func_get_args(), $pluginInfo) : parent::canUseSoftPurge();
    }

    /**
     * {@inheritdoc}
     */
    public function isGeoIpEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isGeoIpEnabled');
        return $pluginInfo ? $this->___callPlugins('isGeoIpEnabled', func_get_args(), $pluginInfo) : parent::isGeoIpEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function getGeoIpAction()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getGeoIpAction');
        return $pluginInfo ? $this->___callPlugins('getGeoIpAction', func_get_args(), $pluginInfo) : parent::getGeoIpAction();
    }

    /**
     * {@inheritdoc}
     */
    public function getGeoIpRedirectMapping()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getGeoIpRedirectMapping');
        return $pluginInfo ? $this->___callPlugins('getGeoIpRedirectMapping', func_get_args(), $pluginInfo) : parent::getGeoIpRedirectMapping();
    }

    /**
     * {@inheritdoc}
     */
    public function isImageOptimizationEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isImageOptimizationEnabled');
        return $pluginInfo ? $this->___callPlugins('isImageOptimizationEnabled', func_get_args(), $pluginInfo) : parent::isImageOptimizationEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function isImageOptimizationPixelRatioEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isImageOptimizationPixelRatioEnabled');
        return $pluginInfo ? $this->___callPlugins('isImageOptimizationPixelRatioEnabled', func_get_args(), $pluginInfo) : parent::isImageOptimizationPixelRatioEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function isForceLossyEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isForceLossyEnabled');
        return $pluginInfo ? $this->___callPlugins('isForceLossyEnabled', func_get_args(), $pluginInfo) : parent::isForceLossyEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function isImageOptimizationBgColorEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isImageOptimizationBgColorEnabled');
        return $pluginInfo ? $this->___callPlugins('isImageOptimizationBgColorEnabled', func_get_args(), $pluginInfo) : parent::isImageOptimizationBgColorEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function getImageOptimizationRatios()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getImageOptimizationRatios');
        return $pluginInfo ? $this->___callPlugins('getImageOptimizationRatios', func_get_args(), $pluginInfo) : parent::getImageOptimizationRatios();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockByCountry()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getBlockByCountry');
        return $pluginInfo ? $this->___callPlugins('getBlockByCountry', func_get_args(), $pluginInfo) : parent::getBlockByCountry();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockByAcl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getBlockByAcl');
        return $pluginInfo ? $this->___callPlugins('getBlockByAcl', func_get_args(), $pluginInfo) : parent::getBlockByAcl();
    }

    /**
     * {@inheritdoc}
     */
    public function getWafAllowByAcl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getWafAllowByAcl');
        return $pluginInfo ? $this->___callPlugins('getWafAllowByAcl', func_get_args(), $pluginInfo) : parent::getWafAllowByAcl();
    }

    /**
     * {@inheritdoc}
     */
    public function areWebHooksEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'areWebHooksEnabled');
        return $pluginInfo ? $this->___callPlugins('areWebHooksEnabled', func_get_args(), $pluginInfo) : parent::areWebHooksEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function getIncomingWebhookURL()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getIncomingWebhookURL');
        return $pluginInfo ? $this->___callPlugins('getIncomingWebhookURL', func_get_args(), $pluginInfo) : parent::getIncomingWebhookURL();
    }

    /**
     * {@inheritdoc}
     */
    public function getWebhookUsername()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getWebhookUsername');
        return $pluginInfo ? $this->___callPlugins('getWebhookUsername', func_get_args(), $pluginInfo) : parent::getWebhookUsername();
    }

    /**
     * {@inheritdoc}
     */
    public function canPublishKeyUrlChanges()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canPublishKeyUrlChanges');
        return $pluginInfo ? $this->___callPlugins('canPublishKeyUrlChanges', func_get_args(), $pluginInfo) : parent::canPublishKeyUrlChanges();
    }

    /**
     * {@inheritdoc}
     */
    public function canPublishPurgeAllChanges()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canPublishPurgeAllChanges');
        return $pluginInfo ? $this->___callPlugins('canPublishPurgeAllChanges', func_get_args(), $pluginInfo) : parent::canPublishPurgeAllChanges();
    }

    /**
     * {@inheritdoc}
     */
    public function canPublishPurgeChanges()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canPublishPurgeChanges');
        return $pluginInfo ? $this->___callPlugins('canPublishPurgeChanges', func_get_args(), $pluginInfo) : parent::canPublishPurgeChanges();
    }

    /**
     * {@inheritdoc}
     */
    public function canPublishPurgeAllDebugBacktrace()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canPublishPurgeAllDebugBacktrace');
        return $pluginInfo ? $this->___callPlugins('canPublishPurgeAllDebugBacktrace', func_get_args(), $pluginInfo) : parent::canPublishPurgeAllDebugBacktrace();
    }

    /**
     * {@inheritdoc}
     */
    public function canPublishPurgeByKeyDebugBacktrace()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canPublishPurgeByKeyDebugBacktrace');
        return $pluginInfo ? $this->___callPlugins('canPublishPurgeByKeyDebugBacktrace', func_get_args(), $pluginInfo) : parent::canPublishPurgeByKeyDebugBacktrace();
    }

    /**
     * {@inheritdoc}
     */
    public function canPublishPurgeDebugBacktrace()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canPublishPurgeDebugBacktrace');
        return $pluginInfo ? $this->___callPlugins('canPublishPurgeDebugBacktrace', func_get_args(), $pluginInfo) : parent::canPublishPurgeDebugBacktrace();
    }

    /**
     * {@inheritdoc}
     */
    public function canPublishConfigChanges()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canPublishConfigChanges');
        return $pluginInfo ? $this->___callPlugins('canPublishConfigChanges', func_get_args(), $pluginInfo) : parent::canPublishConfigChanges();
    }

    /**
     * {@inheritdoc}
     */
    public function getWebhookMessagePrefix()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getWebhookMessagePrefix');
        return $pluginInfo ? $this->___callPlugins('getWebhookMessagePrefix', func_get_args(), $pluginInfo) : parent::getWebhookMessagePrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getLastCheckedIssuedVersion()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getLastCheckedIssuedVersion');
        return $pluginInfo ? $this->___callPlugins('getLastCheckedIssuedVersion', func_get_args(), $pluginInfo) : parent::getLastCheckedIssuedVersion();
    }

    /**
     * {@inheritdoc}
     */
    public function isRateLimitingEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isRateLimitingEnabled');
        return $pluginInfo ? $this->___callPlugins('isRateLimitingEnabled', func_get_args(), $pluginInfo) : parent::isRateLimitingEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function isRateLimitingMasterEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isRateLimitingMasterEnabled');
        return $pluginInfo ? $this->___callPlugins('isRateLimitingMasterEnabled', func_get_args(), $pluginInfo) : parent::isRateLimitingMasterEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function isRateLimitingLoggingEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isRateLimitingLoggingEnabled');
        return $pluginInfo ? $this->___callPlugins('isRateLimitingLoggingEnabled', func_get_args(), $pluginInfo) : parent::isRateLimitingLoggingEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function getRateLimitingLimit()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRateLimitingLimit');
        return $pluginInfo ? $this->___callPlugins('getRateLimitingLimit', func_get_args(), $pluginInfo) : parent::getRateLimitingLimit();
    }

    /**
     * {@inheritdoc}
     */
    public function getRateLimitingTtl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRateLimitingTtl');
        return $pluginInfo ? $this->___callPlugins('getRateLimitingTtl', func_get_args(), $pluginInfo) : parent::getRateLimitingTtl();
    }

    /**
     * {@inheritdoc}
     */
    public function isCrawlerProtectionEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isCrawlerProtectionEnabled');
        return $pluginInfo ? $this->___callPlugins('isCrawlerProtectionEnabled', func_get_args(), $pluginInfo) : parent::isCrawlerProtectionEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function getCrawlerRateLimitingLimit()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCrawlerRateLimitingLimit');
        return $pluginInfo ? $this->___callPlugins('getCrawlerRateLimitingLimit', func_get_args(), $pluginInfo) : parent::getCrawlerRateLimitingLimit();
    }

    /**
     * {@inheritdoc}
     */
    public function getCrawlerRateLimitingTtl()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCrawlerRateLimitingTtl');
        return $pluginInfo ? $this->___callPlugins('getCrawlerRateLimitingTtl', func_get_args(), $pluginInfo) : parent::getCrawlerRateLimitingTtl();
    }

    /**
     * {@inheritdoc}
     */
    public function isExemptGoodBotsEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isExemptGoodBotsEnabled');
        return $pluginInfo ? $this->___callPlugins('isExemptGoodBotsEnabled', func_get_args(), $pluginInfo) : parent::isExemptGoodBotsEnabled();
    }

    /**
     * {@inheritdoc}
     */
    public function getGeoIpMappingForCountry($countryCode)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getGeoIpMappingForCountry');
        return $pluginInfo ? $this->___callPlugins('getGeoIpMappingForCountry', func_get_args(), $pluginInfo) : parent::getGeoIpMappingForCountry($countryCode);
    }

    /**
     * {@inheritdoc}
     */
    public function getRateLimitPaths()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getRateLimitPaths');
        return $pluginInfo ? $this->___callPlugins('getRateLimitPaths', func_get_args(), $pluginInfo) : parent::getRateLimitPaths();
    }

    /**
     * {@inheritdoc}
     */
    public function getVclFile($vclTemplatePath)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getVclFile');
        return $pluginInfo ? $this->___callPlugins('getVclFile', func_get_args(), $pluginInfo) : parent::getVclFile($vclTemplatePath);
    }

    /**
     * {@inheritdoc}
     */
    public function getVclSnippets($path = '/vcl_snippets', $specificFile = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getVclSnippets');
        return $pluginInfo ? $this->___callPlugins('getVclSnippets', func_get_args(), $pluginInfo) : parent::getVclSnippets($path, $specificFile);
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomSnippets($path, $specificFile = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCustomSnippets');
        return $pluginInfo ? $this->___callPlugins('getCustomSnippets', func_get_args(), $pluginInfo) : parent::getCustomSnippets($path, $specificFile);
    }

    /**
     * {@inheritdoc}
     */
    public function getFastlyEdgeModules($path = '/fastly_edge_modules', $specificFile = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getFastlyEdgeModules');
        return $pluginInfo ? $this->___callPlugins('getFastlyEdgeModules', func_get_args(), $pluginInfo) : parent::getFastlyEdgeModules($path, $specificFile);
    }

    /**
     * {@inheritdoc}
     */
    public function validateCustomSnippet($name, $type, $priority)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'validateCustomSnippet');
        return $pluginInfo ? $this->___callPlugins('validateCustomSnippet', func_get_args(), $pluginInfo) : parent::validateCustomSnippet($name, $type, $priority);
    }

    /**
     * {@inheritdoc}
     */
    public function processBlockedItems($strippedBlockedItems, $blockingType = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'processBlockedItems');
        return $pluginInfo ? $this->___callPlugins('processBlockedItems', func_get_args(), $pluginInfo) : parent::processBlockedItems($strippedBlockedItems, $blockingType);
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getType');
        return $pluginInfo ? $this->___callPlugins('getType', func_get_args(), $pluginInfo) : parent::getType();
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isEnabled');
        return $pluginInfo ? $this->___callPlugins('isEnabled', func_get_args(), $pluginInfo) : parent::isEnabled();
    }
}
