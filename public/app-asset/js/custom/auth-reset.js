$(function () {
    'use strict';

    var pageResetForm = $('.auth-reset-password-form');

    // jQuery Validation
    // --------------------------------------------------------------------
    if (pageResetForm.length) {
        pageResetForm.validate({
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
                'password': {
                    required: true,
                    minlength: 8,
                    maxlength: 16
                },
                'password_confirmation': {
                    required: true,
                    minlength: 8,
                    maxlength: 16,
                    equalTo: '#password'
                }
            }
        });
    }
});
