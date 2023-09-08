$(document).ready(function () {
    let softwareForm = $('#softwareForm');
    if (softwareForm.length) {
        softwareForm.validate({
            rules: {
                name: {
                    required: true,
                },
                brand: {
                    required: true,
                },
                location: {
                    required: true,
                },
                price: {
                    required: true,
                    number: true
                },
                details: {
                    required: true,
                },
            },
        });
    }
});
