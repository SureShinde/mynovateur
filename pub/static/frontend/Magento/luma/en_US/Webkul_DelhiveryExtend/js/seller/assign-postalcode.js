/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_DelhiveryExtend
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

/* global $, $H */

define([
    'mage/adminhtml/grid'
], function () {
    'use strict';
    return function (config) {
        var selectedPostalCode = config.selectedPostalCode,
            assignedPostalCode = $H(selectedPostalCode),
            gridJsObject = window[config.gridJsObjectName],
            trRowIndex;
        $('in_adminassign_postal').value = Object.toJSON(assignedPostalCode);

        /**
         * Register
         *
         * @param {Object} grid
         * @param {Object} element
         * @param {Boolean} checked
         */
        function registerAssignedPostalCode(grid, element, checked)
        {
            if (element.className != "admin__control-checkbox") {
                var trElement = jQuery('#' + element.id).parents('tr');
                trRowIndex = trElement.index();
                var length = assignedPostalCode.keys().length;
                if (checked) {
                    assignedPostalCode.set(element.value, length+1);
                } else {
                    assignedPostalCode.unset(element.value);
                }
                //console.log(assignedPostalCode);
                $('in_adminassign_postal').value = Object.toJSON(assignedPostalCode);
                grid.reloadParams = {
                    'selected_postalcode[]': assignedPostalCode.keys()
                };
            }
        }

        /**
         * Click on Postal row
         *
         * @param {Object} grid
         * @param {String} event
         */
        function assignedPostalRowClick(grid, event)
        {
            var trElement = Event.findElement(event, 'tr'),
                isInput = Event.element(event).tagName === 'INPUT',
                checked = false,
                checkbox = null;
            trRowIndex = trElement.rowIndex-2;
            if (trElement) {
                checkbox = Element.getElementsBySelector(trElement, 'input');
                if (checkbox[0]) {
                    checked = isInput ? checkbox[0].checked : !checkbox[0].checked;
                    gridJsObject.setCheckboxChecked(checkbox[0], checked);
                }
            }
        }
        gridJsObject.rowClickCallback = assignedPostalRowClick;
        gridJsObject.checkboxCheckCallback = registerAssignedPostalCode;
    };
});
