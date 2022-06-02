<?php
/**
 * Webkul Software
 *
 * @category  Webkul
 * @package   Webkul_MarketplaceGstIndia
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\MarketplaceGstIndia\Model\Order\Pdf\Items\Creditmemo;

/**
 * Sales Order Creditmemo Pdf default items renderer
 */
class DefaultCreditmemo extends \Magento\Sales\Model\Order\Pdf\Items\Creditmemo\DefaultCreditmemo
{
    /**
     * Draw process
     *
     * @return void
     */
    public function draw()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $mpGstHelper = $objectManager->get(\Webkul\MarketplaceGstIndia\Helper\Data::class);
        $order = $this->getOrder();
        $itemCreditMemo = $this->getItem();
        $pdf = $this->getPdf();
        $page = $this->getPage();
        $lines = [];

        $isEnabled = $mpGstHelper->getConfigValue('status');
        if ($mpGstHelper->getCountryFromOrder($order) != 'IN') {
            $isEnabled = false;
        }
        if (!$isEnabled) {
            parent::draw();
            return;
        }

        $sgst = $itemCreditMemo->getData('sgst');
        $cgst = $itemCreditMemo->getData('cgst');
        $igst = $itemCreditMemo->getData('igst');
        $utgst = $itemCreditMemo->getData('utgst');
        $hsnCode = $itemCreditMemo->getData('hsn');
        $sgstPercent = $itemCreditMemo->getOrderItem()->getData('sgst_percent');
        $cgstPercent = $itemCreditMemo->getOrderItem()->getData('cgst_percent');
        $igstPercent = $itemCreditMemo->getOrderItem()->getData('igst_percent');
        $utgstPercent = $itemCreditMemo->getOrderItem()->getData('utgst_percent');

        $taxPercent = $itemCreditMemo->getOrderItem()->getData('tax_percent');

        // draw Product name
        $name = $this->string->split($itemCreditMemo->getName(), 35, true, true);
        $sku = $this->string->split($this->getSku($itemCreditMemo), 35);
        $sku[0] = __('SKU').': '.$sku[0];
        $nameWithSku = array_merge($name, $sku);
        if ($hsnCode != '') {
            $hsn[0] = __('HSN').': '.$hsnCode;
            $nameWithSku = array_merge($nameWithSku, $hsn);
        }

        $lines[0] = [['text' => $nameWithSku, 'feed' => 35]];

        // draw Total (ex)
        $lines[0][] = [
            'text' => $order->formatPriceTxt($itemCreditMemo->getRowTotal()),
            'feed' => 220,
            'font' => 'bold',
            'align' => 'right',
        ];

        // draw Discount
        $lines[0][] = [
            'text' => $order->formatPriceTxt(-$itemCreditMemo->getDiscountAmount()),
            'feed' => 265,
            'font' => 'bold',
            'align' => 'right',
        ];

        // draw QTY
        $lines[0][] = ['text' => $itemCreditMemo->getQty() * 1, 'feed' => 300, 'font' => 'bold', 'align' => 'right'];

        // draw Tax
        $sgstArray[] = $order->formatPriceTxt($sgst);
        if ($sgst != 0) {
            $sgstArray[] = '('.(float)$sgstPercent.'%)';
        }
        $lines[0][] = [
            'text' => $sgstArray,
            'feed' => 340,
            'align' => 'right',
        ];

        $cgstArray[] = $order->formatPriceTxt($cgst);
        if ($cgst != 0) {
            $cgstArray[] = '('.(float)$cgstPercent.'%)';
        }
        $lines[0][] = [
            'text' => $cgstArray,
            'feed' => 380,
            'align' => 'right',
        ];

        $igstArray[] = $order->formatPriceTxt($igst);
        if ($igst != 0) {
            $igstArray[] = '('.(float)($igstPercent).'%)';
        }
        $lines[0][] = [
            'text' => $igstArray,
            'feed' => 420,
            'align' => 'right',
        ];

        $utgstArray[] = $order->formatPriceTxt($utgst);
        if ($utgst != 0) {
            $utgstArray[] = '('.(float)($utgstPercent).'%)';
        }
        $lines[0][] = [
            'text' => $utgstArray,
            'feed' => 460,
            'align' => 'right',
        ];

        $lines[0][] = [
            'text' => $order->formatPriceTxt($itemCreditMemo->getData('gst')),
            'feed' => 510,
            'font' => 'bold',
            'align' => 'right',
        ];

        // draw Total (inc)
        $subtotal = $itemCreditMemo->getRowTotal() +
            $itemCreditMemo->getTaxAmount() +
            $itemCreditMemo->getDiscountTaxCompensationAmount() -
            $itemCreditMemo->getDiscountAmount();
        $lines[0][] = [
            'text' => $order->formatPriceTxt($subtotal),
            'feed' => 565,
            'font' => 'bold',
            'align' => 'right',
        ];

        // draw options
        $optionsUpdated = $this->getItemOptions();
        if ($optionsUpdated) {
            foreach ($optionsUpdated as $optionUpdated) {
                // draw options label
                $lines[][] = [
                    'text' => $this->string->split(
                        $this->filterManager->stripTags($optionUpdated['label']),
                        40,
                        true,
                        true
                    ),
                    'font' => 'italic',
                    'feed' => 35,
                ];

                // draw options value
                $printValue = isset(
                    $optionUpdated['print_value']
                ) ? $optionUpdated['print_value'] : $this->filterManager->stripTags(
                    $optionUpdated['value']
                );
                $lines[][] = ['text' => $this->string->split($printValue, 30, true, true), 'feed' => 40];
            }
        }

        $lineBlock = ['lines' => $lines, 'height' => 20];

        $page = $pdf->drawLineBlocks($page, [$lineBlock], ['table_header' => true]);
        $this->setPage($page);
    }
}
