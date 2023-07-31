$(document).ready(function () {
    let createProjectorForm = $('#createProjectorForm');
    if (createProjectorForm.length) {
        createProjectorForm.validate({
            rules: {
                projectorID: {
                    required: true,
                },
                projectorBrand: {
                    required: true,
                },
                projectorModel: {
                    required: true,
                },
                price: {
                    required: true,
                    number: true
                },
                location: {
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
