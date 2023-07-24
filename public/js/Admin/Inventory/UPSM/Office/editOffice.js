$(document).ready(function () {

    let editRuangOfficeForm = $('#editRuangOfficeForm');
    if (editRuangOfficeForm.length) {
        editRuangOfficeForm.validate({
            rules: {
                officeName: {
                    required: true,
                },
                officeLocation: {
                    required: true,
                },
                Sofa: {
                    required: true,
                    number: true
                },
                Drawer: {
                    required: true,
                    number: true
                },
                Chair: {
                    required: true,
                    number: true
                },
                FoldableChair: {
                    required: true,
                    number: true
                },
                Table: {
                    required: true,
                    number: true
                },
                Whiteboard: {
                    required: true,
                    number: true
                },
                Duster: {
                    required: true,
                    number: true
                },
            },
        });
    }
});
