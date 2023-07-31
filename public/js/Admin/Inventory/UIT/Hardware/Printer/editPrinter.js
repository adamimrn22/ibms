$(document).ready(function () {
    let editPrinterForm = $('#editPrinterForm');
    if (editPrinterForm.length) {
        editPrinterForm.validate({
            rules: {
                printerID: {
                    required: true,
                },
                printerBrand: {
                    required: true,
                },
                printerModel: {
                    required: true,
                },
                price: {
                    required: true,
                    number: true
                },
                location: {
                    required: true,
                },
                tonerBlack: {
                    required: true,
                },
                tonerColor: {
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
