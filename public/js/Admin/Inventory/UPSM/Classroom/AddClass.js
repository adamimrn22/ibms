$(document).ready(function () {

    let addRuangKelasForm = $('#addRuangKelasForm');
    if (addRuangKelasForm.length) {
        addRuangKelasForm.validate({
            rules: {
                className: {
                    required: true,
                },
                classLocation: {
                    required: true,
                },
                classChair: {
                    required: true,
                    number: true
                },
                classFoldableChair: {
                    required: true,
                    number: true
                },
                classTable: {
                    required: true,
                    number: true
                },
                classWhiteboard: {
                    required: true,
                    number: true
                },
                classDuster: {
                    required: true,
                    number: true
                },
                image: {
                    required: true
                }
            },
        });
    }
});
