$(document).ready(function () {

    let addPaperForm = $('#addPaperForm');
    if (addPaperForm.length) {
        addPaperForm.validate({
            rules: {
                name: {
                    required: true,
                },
                current_quantity: {
                    required: true,
                    number: true
                },
                current_quantity: {
                    required: true,
                    number: true
                },
                stock: {
                    required: true,
                },
            },
        });
    }
});
