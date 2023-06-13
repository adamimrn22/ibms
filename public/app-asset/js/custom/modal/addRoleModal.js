$(function () {
    'use strict';

    var addRoleModal = $('#addRoleModal');

    // jQuery Validation
    // --------------------------------------------------------------------
    if (addRoleModal.length) {
        $.validator.addMethod('lettersonly', function (value, element) {
            return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
        }, 'Please enter letters only.');

        addRoleModal.validate({
            /*
            * ? To enable validation onkeyup
            onkeyup: function (element) {
              $(element).valid();
            },*/
            /*
            * ? To enable validation on focusout
            onfocusout: function (element) {
              $(element).valid();
            }, */
            rules: {
                'name': {
                    required: true,
                    lettersonly: true,
                    max: 10
                },
            }
        });
    }
});
