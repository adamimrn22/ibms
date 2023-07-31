$(document).ready(function () {
    let createCableForm = $('#createCableForm');
    if (createCableForm.length) {
        createCableForm.validate({
            rules: {
                cableID: {
                    required: true,
                },
                cableName: {
                    required: true,
                },
                price: {
                    required: true,
                    number: true
                },
                location: {
                    required: true,
                },
                meter: {
                    required: true,
                    number: true
                },
                subcategory_id: {
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
