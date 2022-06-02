/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MpAssignProduct
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
 define([
    "jquery",
    "underscore",
    "Magento_Catalog/js/price-utils",
    'Magento_Customer/js/customer-data',
    "jquery/ui",
    "mage/translate"
    ], function ($, _, utils, customerData) {
        'use strict';
        $.widget('mpassignproductUpdate.view', {
            options: {},
            _create: function () {
                var self = this;

                $('.wk-ap-update-cart').on('click', function() {
                    var assignedId = $(this).data('id');
                    var qty = $(this).closest('td').find('.wk-ap-qty').val();
                    if (!$('#assigned_id').length) {
                        $('#product_addtocart_form').append('<input type="hidden" id="assigned_id" name="assigned_id" value=""/>')
                    }
                    $('#assigned_id').val(assignedId);
                    $('#qty').val(qty);
                    $('#product_addtocart_form').trigger('submit');
                    window.scrollTo({top: 0, behavior: 'smooth'});
                });
            }
        });
        return $.mpassignproductUpdate.view;
    });
