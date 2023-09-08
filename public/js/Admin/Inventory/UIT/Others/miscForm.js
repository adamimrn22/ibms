$(document).ready(function () {
    let miscellaneousForm = $('#miscellaneousForm');
    if (miscellaneousForm.length) {
        miscellaneousForm.validate({
            rules: {
                name: {
                    required: true,
                },
                id: {
                    required: true,
                },
                brand: {
                    required: true,
                },
                model: {
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
