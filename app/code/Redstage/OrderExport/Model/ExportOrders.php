<?php
namespace Redstage\OrderExport\Model;

class ExportOrders
{
    /**
     * filedsets for csv
     * @return void
     */
    public function getHeaders()
    {
        $header[] = [
            'Order Type','Sales Organization','Distribution Channel','Division','PO NUMBER','PO DATE','Sold-to party','SHIP-TO-PARTY',
            'Req. deliv.date(format)','Req. deliv.date','Delivery Block','Payment term','Metiral NO','Qty','Item category','Plant',
            '','','','','','','','','','','','','','','','',
            'Alt.tax classific','All Incluse Price','Paymt guarant. proc.','All Incluse +Sale Tax','Gross Price','Inst.Comm','UPS back up',
            'Display Range','ZR Order Recepient','Bill_To_Party','Payer','UPS Wrty','Bat.Wrty','Invtr','Payment Terms',
            '','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',
            'AMC AGREE','LD%','Advance Bank Details','','','','Amc Agreement','Sales Pat 1 %','Sales Pt 2','Sales Pat 2 %','Sales Pt 3','Sales Pat 3 %','Sales Pt 4','Sales Pat 4 %',
            'Sale Office','Sales Group','Order origin','End Cust Group','Rcvd','Web order No.','Web BilltoCust code','Web ShiptoCust Code (Delivery)',
            'Web PayerCust code',
        ];

        $header[] = [
            '','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',
            'ZINC','','Battery','Battery','Battery','ZINC','','','','','','','',
            'Advance','On Sub POD','On Sub IC','30DFrmDOI','On Dely','On Sub BG','On Sub INV','Others','On Instlln','On SubS/D','45 D Frm DOI',
            'Forms','Forms','Forms Rcd Date','ED Exempt','Road Perm','Cust.Date','R/P Valid','Oct / Ent'
        ];

    }

    public function prepareOrder($order)
    {

    }

    /**
     * prepare order ralated fields
     * @return void
     */
    protected function getOrderFileds()
    {

    }

    /**
     * prepare product related fields
     * @return void
     */
    protected function getProductFields()
    {

    }

    /**
     * prepare customer fields
     * @return void
     */
    protected function getCudtomerFileds()
    {

    }

}
