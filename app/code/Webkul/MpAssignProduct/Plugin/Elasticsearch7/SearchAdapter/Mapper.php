<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MpAssignProduct
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MpAssignProduct\Plugin\Elasticsearch7\SearchAdapter;

use Webkul\Marketplace\Helper\Data as MpHelper;
use Magento\Framework\Search\RequestInterface;
use Magento\Elasticsearch\SearchAdapter\Aggregation\Builder as AggregationBuilder;
use Magento\Elasticsearch\SearchAdapter\ConnectionManager;
use Magento\Elasticsearch\SearchAdapter\ResponseFactory;
use Magento\Elasticsearch\Elasticsearch5\SearchAdapter\Mapper as SearchMapper;
use Magento\Elasticsearch\SearchAdapter\QueryContainerFactory;

class Mapper
{

    /**
     * Response Factory
     *
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * @var ConnectionManager
     */
    private $connectionManager;

    /**
     * @var AggregationBuilder
     */
    private $aggregationBuilder;

    /**
     * @var \Webkul\Marketplace\Helper\Data
     */
    protected $helper;
    /**
     * Mapper instance
     *
     * @var Mapper
     */
    private $mapper;

    /**
     * @var QueryContainerFactory
     */
    private $queryContainerFactory;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * @var \Webkul\Marketplace\Model\ResourceModel\Product\Collection
     */
    protected $collection;

    /**
     * @param ConnectionManager $connectionManager
     * @param ResponseFactory $responseFactory
     * @param AggregationBuilder $aggregationBuilder
     * @param Mapper $mapper
     * @param \Webkul\Marketplace\Helper\Data $helper
     * @param QueryContainerFactory $queryContainerFactory
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Webkul\Marketplace\Model\ResourceModel\Product\Collection $collection
     */
    public function __construct(
        ConnectionManager $connectionManager,
        ResponseFactory $responseFactory,
        AggregationBuilder $aggregationBuilder,
        SearchMapper $mapper,
        QueryContainerFactory $queryContainerFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Webkul\Marketplace\Model\ResourceModel\Product\Collection $collection,
        \Webkul\MpAssignProduct\Helper\Data $helper,
        \Webkul\Marketplace\Helper\Data $mpHelper,
        \Webkul\MpAssignProduct\Model\AssociatesFactory $associatesFactory
    ) {
        $this->connectionManager = $connectionManager;
        $this->responseFactory = $responseFactory;
        $this->aggregationBuilder = $aggregationBuilder;
        $this->mapper = $mapper;
        $this->queryContainerFactory = $queryContainerFactory;
        $this->request = $request;
        $this->collection = $collection;
        $this->helper = $helper;
        $this->associatesFactory = $associatesFactory;
        $this->mpHelper = $mpHelper;
    }

    // public function aroundBuildQuery(
    //     \Magento\Elasticsearch7\SearchAdapter\Mapper $subject,
    //     callable $proceed,
    //     RequestInterface $request
    // ) {
       
    //     $assignProductsIds = $this->helper->getCollection()->getAllIds();
    //     $associateProductIds = $this->associatesFactory->create()->getCollection()->getAllIds();
    //     $assignProductsIds = array_merge($assignProductsIds, $associateProductIds);
    //     if (!empty($assignProductsIds)) {
    //         $client = $this->connectionManager->getConnection();
    //         $aggregationBuilder = $this->aggregationBuilder;
    //         $updatedQuery = $this->mapper->buildQuery($request);
            
    //         $updatedQuery['body']['query']['bool']['mustNot'] = ['ids' => ['values' => $assignProductsIds]];
            
    //         return $updatedQuery;
    //     }
    //     return $proceed($request);
    // }
}
