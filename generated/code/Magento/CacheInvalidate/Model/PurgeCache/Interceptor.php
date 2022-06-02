<?php
namespace Magento\CacheInvalidate\Model\PurgeCache;

/**
 * Interceptor class for @see \Magento\CacheInvalidate\Model\PurgeCache
 */
class Interceptor extends \Magento\CacheInvalidate\Model\PurgeCache implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\PageCache\Model\Cache\Server $cacheServer, \Magento\CacheInvalidate\Model\SocketFactory $socketAdapterFactory, \Magento\Framework\Cache\InvalidateLogger $logger, int $maxHeaderSize = 7680)
    {
        $this->___init();
        parent::__construct($cacheServer, $socketAdapterFactory, $logger, $maxHeaderSize);
    }

    /**
     * {@inheritdoc}
     */
    public function sendPurgeRequest($tags)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'sendPurgeRequest');
        return $pluginInfo ? $this->___callPlugins('sendPurgeRequest', func_get_args(), $pluginInfo) : parent::sendPurgeRequest($tags);
    }
}
