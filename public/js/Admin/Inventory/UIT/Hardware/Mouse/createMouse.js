$(document).ready(function () {
    let createMouseForm = $('#createMouseForm');
    if (createMouseForm.length) {
        createMouseForm.validate({
            rules: {
                mouseID: {
                    required: true,
                },
                mouseBrand: {
                    required: true,
                },
                mouseModel: {
                    required: true,
                },
                price: {
                    required: true,
                    number: true
                },
                location: {
                    required: true,
                },
                mouseType: {
                    required: true,
                },
                connection: {
                    required: true,
                },
                dpi: {
                    required: true,
                    number: true
                },
                dimension: {
                    required: true,
                },
                weight: {
                    required: true,
                    number: true
                },
                color: {
                    required: true,
                },
                status: {
                    required: true,
                    number: true
                },
                DOP: {
                    required: true,
                },
            },
        });
    }
});
