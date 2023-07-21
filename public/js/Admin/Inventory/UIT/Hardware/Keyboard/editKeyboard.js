$(document).ready(function () {
    let editKeyboardForm = $('#editKeyboardForm');
    if (editKeyboardForm.length) {
        editKeyboardForm.validate({
            rules: {
                keyboardID: {
                    required: true,
                },
                keyboardBrand: {
                    required: true,
                },
                keyboardModel: {
                    required: true,
                },
                price: {
                    required: true,
                    number: true
                },
                location: {
                    required: true,
                },
                keyboardType: {
                    required: true,
                },
                connection: {
                    required: true,
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
