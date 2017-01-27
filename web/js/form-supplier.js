App = typeof App !== 'undefined' ? App : {};
App.Suppliers = typeof App.Suppliers !== 'undefined' ? App.Suppliers : {};

App.Suppliers.Form = function() {
    var initControls = function() {
        App.Forms.initTelephoneControl($('form#supplier input[type=tel]'));

        $('form#supplier .collection-employees').on('item-added.app', function(event, data) {
            App.Forms.initTelephoneControl($(data.item).find('input[type=tel]'));
        });
        $('#supplier_form_employees').on('item-added.app', function() {
            $('input:hidden[name="employeeCounter"]').val($('#supplier_form_employees').find('.item').length);
        });
        $('#supplier_form_employees').on('item-removed.app', function() {
            $('input:hidden[name="employeeCounter"]').val($('#supplier_form_employees').find('.item').length);
        });
    }

    var initValidator = function() {
        $('#supplier').validate({
            errorPlacement: function(error, element) {
                if (element.is(':hidden')) {
                    element = element.closest(':visible');
                }
                if (!element.data('tooltipster-ns')) {
                    element.tooltipster({
                        trigger: 'custom',
                        onlyOne: false,
                        position: 'bottom-left',
                        positionTracker: true
                    });
                }
                element.tooltipster('update', $(error).text());
                element.tooltipster('show');
            },
            ignore: ':hidden:not(input:hidden[name="employeeCounter"])',
            messages: {
                "employeeCounter": {
                    min: 'No employees'
                }
            },
            rules: {
                "employeeCounter": {
                    min: 1
                }
            },
            success: function (label, element) {
                if ($(element).is(':hidden')) {
                    element = $(element).closest(':visible');
                }
                $(element).tooltipster('hide');
            }
        });
    }

    return {
        init: function() {
            initControls();
            initValidator();
        }
    }
}();
