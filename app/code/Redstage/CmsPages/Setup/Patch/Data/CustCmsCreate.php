<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
/**
 * Created By : Anjulata Gupta
 */
declare (strict_types = 1);
namespace Redstage\CmsPages\Setup\Patch\Data;
use Magento\Cms\Model\PageFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
class CustCmsCreate implements DataPatchInterface
{
    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var PageFactory
     */
    private $pageFactory;
    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param PageFactory $pageFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PageFactory $pageFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->pageFactory = $pageFactory;
    }
    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $pagesData[0] = [
            'title' => 'Our Purpose', // cms page title
            'page_layout' => '1column', // cms page layout
            'meta_keywords' => 'Our Purpose', // cms page meta keywords
            'meta_description' => 'Our Purpose', // cms page meta description
            'identifier' => 'ourpurpose', // cms page identifier
            'content_heading' => 'Our Purpose', // cms page content heading
            'content' => '<h1>Our Purpose Cms Page Content Here</h1>', // cms page content
            'layout_update_xml' => '', // cms page layout xml
            'url_key' => 'our-purpose', // cms page url key
            'is_active' => 1, // status enabled or disabled
            'stores' => [2], // You can set store id single or multiple values in array.
            'sort_order' => 0, // cms page sort order
        ];
        $pagesData[1] = [
            'title' => 'Sustainability', // cms page title
            'page_layout' => '1column', // cms page layout
            'meta_keywords' => 'Sustainability', // cms page meta keywords
            'meta_description' => 'Sustainability', // cms page meta description
            'identifier' => 'sustainability', // cms page identifier
            'content_heading' => 'Sustainability', // cms page content heading
            'content' => '<h1>Sustainability Cms Page Content Here</h1>', // cms page content
            'layout_update_xml' => '', // cms page layout xml
            'url_key' => 'sustainability', // cms page url key
            'is_active' => 1, // status enabled or disabled
            'stores' => [2], // You can set store id single or multiple values in array.
            'sort_order' => 0, // cms page sort order
        ];
        $pagesData[2] = [
            'title' => 'Innovation', // cms page title
            'page_layout' => '1column', // cms page layout
            'meta_keywords' => 'Innovation', // cms page meta keywords
            'meta_description' => 'Innovation', // cms page meta description
            'identifier' => 'innovation', // cms page identifier
            'content_heading' => 'Innovation', // cms page content heading
            'content' => '<h1>Innovation Cms Page Content Here</h1>', // cms page content
            'layout_update_xml' => '', // cms page layout xml
            'url_key' => 'innovation', // cms page url key
            'is_active' => 1, // status enabled or disabled
            'stores' => [2], // You can set store id single or multiple values in array.
            'sort_order' => 0, // cms page sort order
        ];
        $pagesData[3] = [
            'title' => 'FAQ', // cms page title
            'page_layout' => '1column', // cms page layout
            'meta_keywords' => 'FAQ', // cms page meta keywords
            'meta_description' => 'FAQ', // cms page meta description
            'identifier' => 'faq', // cms page identifier
            'content_heading' => 'FAQ', // cms page content heading
            'content' => '<h1>FAQ Cms Page Content Here</h1>', // cms page content
            'layout_update_xml' => '', // cms page layout xml
            'url_key' => 'faq', // cms page url key
            'is_active' => 1, // status enabled or disabled
            'stores' => [2], // You can set store id single or multiple values in array.
            'sort_order' => 0, // cms page sort order
        ];
        $pagesData[4] = [
            'title' => 'E-Catalogues', // cms page title
            'page_layout' => '1column', // cms page layout
            'meta_keywords' => 'E-Catalogues', // cms page meta keywords
            'meta_description' => 'E-Catalogues', // cms page meta description
            'identifier' => 'e-catalogues', // cms page identifier
            'content_heading' => 'E-Catalogues', // cms page content heading
            'content' => '<h1>E-Catalogues Cms Page Content Here</h1>', // cms page content
            'layout_update_xml' => '', // cms page layout xml
            'url_key' => 'e-catalogues', // cms page url key
            'is_active' => 1, // status enabled or disabled
            'stores' => [2], // You can set store id single or multiple values in array.
            'sort_order' => 0, // cms page sort order
        ];
        $pagesData[5] = [
            'title' => 'Order Status', // cms page title
            'page_layout' => '1column', // cms page layout
            'meta_keywords' => 'Order Status', // cms page meta keywords
            'meta_description' => 'Order Status', // cms page meta description
            'identifier' => 'order-status', // cms page identifier
            'content_heading' => 'Order Status', // cms page content heading
            'content' => '<h1>Order Status Cms Page Content Here</h1>', // cms page content
            'layout_update_xml' => '', // cms page layout xml
            'url_key' => 'order-status', // cms page url key
            'is_active' => 1, // status enabled or disabled
            'stores' => [2], // You can set store id single or multiple values in array.
            'sort_order' => 0, // cms page sort order
        ];
        $pagesData[6] = [
            'title' => 'Shipping/Delivery', // cms page title
            'page_layout' => '1column', // cms page layout
            'meta_keywords' => 'Shipping/Delivery', // cms page meta keywords
            'meta_description' => 'Shipping/Delivery', // cms page meta description
            'identifier' => 'shipping-delivery', // cms page identifier
            'content_heading' => 'Shipping/Delivery', // cms page content heading
            'content' => '<h1>Shipping/Delivery Cms Page Content Here</h1>', // cms page content
            'layout_update_xml' => '', // cms page layout xml
            'url_key' => 'shipping-delivery', // cms page url key
            'is_active' => 1, // status enabled or disabled
            'stores' => [2], // You can set store id single or multiple values in array.
            'sort_order' => 0, // cms page sort order
        ];
        $pagesData[7] = [
            'title' => 'Exchange & Returns', // cms page title
            'page_layout' => '1column', // cms page layout
            'meta_keywords' => 'Exchange and Returns', // cms page meta keywords
            'meta_description' => 'Exchange and Returns', // cms page meta description
            'identifier' => 'exchange-and-returns', // cms page identifier
            'content_heading' => 'Exchange & Returns', // cms page content heading
            'content' => '<h1>Exchange & Returns Cms Page Content Here</h1>', // cms page content
            'layout_update_xml' => '', // cms page layout xml
            'url_key' => 'exchange-and-returns', // cms page url key
            'is_active' => 1, // status enabled or disabled
            'stores' => [2], // You can set store id single or multiple values in array.
            'sort_order' => 0, // cms page sort order
        ];
        $pagesData[8] = [
            'title' => 'Innoval', // cms page title
            'page_layout' => '1column', // cms page layout
            'meta_keywords' => 'Innoval', // cms page meta keywords
            'meta_description' => 'Innoval', // cms page meta description
            'identifier' => 'innoval', // cms page identifier
            'content_heading' => 'Innoval', // cms page content heading
            'content' => '<h1>Innoval Cms Page Content Here</h1>', // cms page content
            'layout_update_xml' => '', // cms page layout xml
            'url_key' => 'innoval', // cms page url key
            'is_active' => 1, // status enabled or disabled
            'stores' => [2], // You can set store id single or multiple values in array.
            'sort_order' => 0, // cms page sort order
        ];
        $pagesData[9] = [
            'title' => 'Studios', // cms page title
            'page_layout' => '1column', // cms page layout
            'meta_keywords' => 'Studios', // cms page meta keywords
            'meta_description' => 'Studios', // cms page meta description
            'identifier' => 'studios', // cms page identifier
            'content_heading' => 'Studios', // cms page content heading
            'content' => '<h1>Studios Cms Page Content Here</h1>', // cms page content
            'layout_update_xml' => '', // cms page layout xml
            'url_key' => 'studios', // cms page url key
            'is_active' => 1, // status enabled or disabled
            'stores' => [2], // You can set store id single or multiple values in array.
            'sort_order' => 0, // cms page sort order
        ];
        $pagesData[10] = [
            'title' => 'Shop-in-shop', // cms page title
            'page_layout' => '1column', // cms page layout
            'meta_keywords' => 'Shop-in-shop', // cms page meta keywords
            'meta_description' => 'Shop-in-shop', // cms page meta description
            'identifier' => 'shop-in-shop', // cms page identifier
            'content_heading' => 'Shop-in-shop', // cms page content heading
            'content' => '<h1>Shop-in-shop Cms Page Content Here</h1>', // cms page content
            'layout_update_xml' => '', // cms page layout xml
            'url_key' => 'shop-in-shop', // cms page url key
            'is_active' => 1, // status enabled or disabled
            'stores' => [2], // You can set store id single or multiple values in array.
            'sort_order' => 0, // cms page sort order
        ];

        foreach ($pagesData as $pageData) {
            $this->moduleDataSetup->startSetup();
            $this->pageFactory->create()->setData($pageData)->save();        
            $this->moduleDataSetup->endSetup();
        }
        
    }
    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }
    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}