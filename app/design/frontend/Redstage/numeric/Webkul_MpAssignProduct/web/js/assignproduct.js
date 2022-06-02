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
    "mage/template",
    "mage/url",
    "jquery/ui",
    "mage/translate"
], function ($, _, utils, customerData, template, url) {
        'use strict';
        var self;
        $.widget('mpassignproduct.view', {
            options: {},
            _create: function () {
                self = this;
                $('#product_list').on('click', '.wk-ap-add-to-cart', function() {
                    var assignedId = $(this).data('id');
                    var qty = $(this).parent().prev('div.qty').find('.wk-ap-qty').val();
                    var baseAssignId = $('#assigned_id').val();
                    if (!$('#assigned_id').length) {
                        $('#product_addtocart_form').append('<input type="hidden" id="assigned_id" name="assigned_id" value=""/>')
                    }
                    $('#assigned_id').val(assignedId);
                    $('#qty').val(qty);
                    $('#product-addtocart-button').submit();
                    $('#assigned_id').val(baseAssignId);
                    window.scrollTo({top: 0, behavior: 'smooth'});
                });
                $('#product-options-wrapper .super-attribute-select').change(function () {
                    console.log("its fine");
                    //self.updateAsConfiguration();
                });
                $('#product-options-wrapper').on('click', '.swatch-option', function () {
                    var optionId = $(this).data('option-id');
                    var selected_options = {};
                    $('div.swatch-attribute').each(function (k,v) {
                        var attribute_id    = $(this).attr('data-attribute-id');
                        var option_selected = $(this).attr('data-option-selected');
                        if (!attribute_id || !option_selected) {
                            return;
                        }
                        selected_options[attribute_id] = option_selected;
                    });

                    var productIdIndex = jQuery('[data-role=swatch-options]').data('mageSwatchRenderer').options.jsonConfig.index;
                    var found_ids = [];
                    jQuery.each(productIdIndex, function (productId, attributes) {
                        if (self.productIsSelected(attributes, selected_options)) {
                            $('.wk-table-product-list tr.seller_info').remove();
                            self.getSellerList(productId);
                        }
                    });
                });
                
                $('#product-options-wrapper').on('change', '.product-custom-option', function () {
                 var optionsPrice = 0;
                 $('#product-options-wrapper .product-custom-option').each(function (inx, element){
                        var type = element.type;
                        switch (type) {
                            case 'select-one':
                                var selPri = parseFloat($(element).find(":selected").attr('price'));
                                optionsPrice = optionsPrice + selPri == NaN ? 0 : selPri ;
                                break;
                            case 'radio':
                                var radioPri = $(element).prop('checked') == true ? parseFloat($(element).attr('price')) : 0;
                                optionsPrice = optionsPrice + radioPri;
                                break;
                        }
                    });
                    console.log(optionsPrice);
                    $('.wk-ap-product-list .wk-ap-product-price.product').each(function (){
                        var sellerProPrice = optionsPrice + parseFloat($(this).attr('data-seller-price'));
                        $(this).find('.amount').text(utils.formatPrice(sellerProPrice));
                    });
                });
            },
            productIsSelected: function (attributes, selected_options) {
                return _.isEqual(attributes, selected_options);
            },
            getSellerList: function (produtId) {
                $.ajax({
                    type: 'POST',
                    url:self.options.sellerListUrl,
                    async: true,
                    dataType: 'json',
                    data : {form_key: window.FORM_KEY, 'proId':produtId},
                    beforeSend: function () {
                         $('body').trigger('processStart'); // start loader
                    },
                    success:function(data) {
                        if (data['sellerList'].length) {
                            var sellerTemplate = template('#seller-row-template');
                            $.each(data['sellerList'], function() {
                                var sellerRow = sellerTemplate({
                                    data: this
                                });
                                $('.wk-table-product-list').append(sellerRow);
                            });
                            if (!$('#assigned_id').length) {
                                $('#product_addtocart_form').append('<input type="hidden" id="assigned_id" name="assigned_id" value=""/>')
                            }
                            $('#assigned_id').val(data['sellerList'][0]['assign_pro_id']);
                        }
                    }
                }).done(function (data) {
                    $('body').trigger('processStop');   // stop loader
                    return true;
              });

            }/*,
            updateAsConfiguration: function () {
                //resetData(symbol);
                var flag = 1;
                setTimeout(function () {
                    $("#product_addtocart_form input[type='hidden']").each(function () {
                        $('#product-options-wrapper .super-attribute-select').each(function () {
                            if ($(this).val() == "") {
                                flag = 0;
                            }
                        });
                        var name = $(this).attr("name");
                        if (name == "selected_configurable_option") {
                            var productId = $(this).val();

                            if (productId != "" && flag ==1) {
                                if (typeof jsonResult[productId] != "undefined") {
                                    $(".wk-table-product-list tbody tr").each(function () {
                                        var id = $(this).attr("data-id");
                                        var productUrl = $(this).attr("product-url");
                                        if (id) {
                                            if (typeof jsonResult[productId][id] != "undefined") {
                                                $(this).find(".wk-ap-product-price").html(symbol+jsonResult[productId][id]['price']);
                                                var qty = jsonResult[productId][id]['qty'];
                                                if (qty <= 0) {
                                                    var avl = $.mage.__("OUT OF STOCK");
                                                } else {
                                                    var avl = $.mage.__("IN STOCK");
                                                    $(this).find(".wk-ap-action-col").html(btnHtml);
                                                    $(this).find(".wk-ap-add-to-cart").attr('data-id', id);
                                                    $(this).find(".wk-ap-add-to-cart").attr('addtocart-url', productUrl);
                                                    $(this).find(".wk-ap-add-to-cart").attr('data-associate-id', jsonResult[productId][id]['id']);
                                                }
                                                $(this).find(".wk-ap-product-avl").html(avl);
                                            }
                                        } else {
                                            var configChild = getConfigChild(mainConfigChilds, productId, 'getRow');

                                            $(this).find(".wk-ap-product-price").html(utils.formatPrice(configChild.price));
                                            var qty = configChild.stock;
                                            if (qty <= 0) {
                                                var avl = $.mage.__("OUT OF STOCK");
                                            } else {
                                                var avl = $.mage.__("IN STOCK");
                                                $(this).find(".wk-ap-action-col").html(btnHtml);
                                                $(this).find(".wk-ap-add-to-cart").attr('data-id', '');
                                                $(this).find(".wk-ap-add-to-cart").attr('data-associate-id', '');
                                            }
                                            $(this).find(".wk-ap-product-avl").html(avl);
                                        }
                                    });
                                }
                            }
                        }
                    });
                }, 0);
            }*/
        });
        return $.mpassignproduct.view;
    });
