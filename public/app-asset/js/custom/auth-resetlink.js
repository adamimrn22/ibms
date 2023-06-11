$(function () {
    'use strict';

    var pageResetForm = $('.auth-forgot-password-form');

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
                'email': {
                    required: true,
                    email: true
                },
            }
        });
    }
});
