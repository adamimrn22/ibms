$(document).ready(function () {
    let createExtensionCordForm = $('#createExtensionCordForm');
    if (createExtensionCordForm.length) {
        createExtensionCordForm.validate({
            rules: {
                extensionCordID: {
                    required: true,
                },
                brand: {
                    required: true,
                },
                length: {
                    required: true,
                    number: true
                },
                price: {
                    required: true,
                    number: true
                },
                location: {
                    required: true,
                },
                DOP: {
                    required: true,
                },
            },
        });
    }
});
