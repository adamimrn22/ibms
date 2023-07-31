$(document).ready(function () {

    let updateCarForm = $('#updateCarForm');
    if (updateCarForm.length) {
        updateCarForm.validate({
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
