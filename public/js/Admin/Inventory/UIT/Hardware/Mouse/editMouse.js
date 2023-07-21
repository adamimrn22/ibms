$(document).ready(function () {
    let editMouseForm = $('#editMouseForm');
    if (editMouseForm.length) {
        editMouseForm.validate({
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
