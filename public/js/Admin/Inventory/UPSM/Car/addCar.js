$(document).ready(function () {

    let addCarForm = $('#addCarForm');
    if (addCarForm.length) {
        addCarForm.validate({
            rules: {
                name: {
                    required: true,
                },
                seat: {
                    required: true,
                    number: true
                },
                status: {
                    required: true,
                },
                DOP: {
                    required: true,
                },
            },
        });
    }
});
