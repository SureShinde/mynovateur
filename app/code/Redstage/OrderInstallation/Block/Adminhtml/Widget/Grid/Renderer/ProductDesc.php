<?php
/**
 * Redstage OrderInstallation module purpose admin user can export order data predifined CSV only shipment created order data.
 *
 * @category: PHP
 * @package: Redstage/OrderInstallation
 * @copyright: Copyright © 2019 Magento, Inc. All rights reserved.
 * @author: Mohit Tyagi <mtyagi@redstage.com>
 * @project: Legrand & Numeric
 * @keywords: Module Redstage_OrderInstallation
 */
namespace Redstage\OrderInstallation\Block\Adminhtml\Widget\Grid\Renderer;
use Magento\Framework\DataObject;
use Magento\Backend\Block\Context;
use Magento\Catalog\Api\ProductRepositoryInterface;

class ProductDesc extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Text
{
 
    /**
     * @var AttributeRepositoryInterface
     */
    protected $productRepository;

    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepository,
        array $data = []
    )
    {
        $this->productRepository = $productRepository;
        parent::__construct($context, $data);
    }

    public function _getValue(DataObject $row)
    {
        $value = parent::_getValue($row);
        if($value){
            try{
                $product = $this->getProduct($value);
                return $product->getShortDescription();
            }catch(\Exception $e){
                return '';
            }
        } 
        return '';
    }
    public function getProduct($productId){
        return $product = $this->productRepository->getById($productId);
    }
}