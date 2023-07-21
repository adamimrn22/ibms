$(document).ready(function () {

    let createMonitorForm = $('#createMonitorForm');
    if (createMonitorForm.length) {
        createMonitorForm.validate({
            rules: {
                monitorID: {
                    required: true,
                },
                monitorBrand: {
                    required: true,
                },
                monitorModel: {
                    required: true,
                },
                price: {
                    required: true,
                    number: true
                },
                location: {
                    required: true,
                },
                display: {
                    required: true,
                },
                dimension: {
                    required: true,
                },
                resolution: {
                    required: true,
                },
                DOP: {
                    required: true,
                },
            },
        });
    }
});
