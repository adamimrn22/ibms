$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#classroomTable').on('click', '.edit-classroom-modal', function () {
        let id = $(this).data('classroom-id');
        $('#classID').val(id)
        let className = $('#editClassName');
        let classLocation = $('#editClassLocation');
        let classChair = $('#editClassChair');
        let classFoldableChair = $('#editClassFoldableChair');
        let classTable = $('#editClassTable');
        let classWhiteboard = $('#editClassWhiteboard');
        let classDuster = $('#editClassDuster');

        $.ajax({
            ...ajaxSettings,
            type: "GET",
            url: `${baseUrl}/Inventory/UPSM/Classroom/${id}`,
            success: function (response) {
                const classroom = response.classroom;
                className.val(classroom.name);
                classLocation.val(classroom.location);
                classChair.val(classroom.attribute.Chair);
                classFoldableChair.val(classroom.attribute.Foldable_Chair);
                classTable.val(classroom.attribute.Table);
                classWhiteboard.val(classroom.attribute.Whiteboard);
                classDuster.val(classroom.attribute.Duster);
            }
        });
    });


    let editRuangKelasForm = $('#editRuangKelasForm');
    if (editRuangKelasForm.length) {
        editRuangKelasForm.validate({
            rules: {
                editClassName: {
                    required: true,
                },
                editClassLocation: {
                    required: true,
                },
                editClassChair: {
                    required: true,
                },
                editClassFoldableChair: {
                    required: true,
                },
                editClassTable: {
                    required: true,
                },
                editClassWhiteboard: {
                    required: true,
                },
                editClassDuster: {
                    required: true,
                },
            },

            submitHandler: function (form, event) {
                event.preventDefault()
                // You can perform the AJAX request or other form handling logic here
                let editClassName = $('#editClassName');
                let editClassLocation = $('#editClassLocation');
                let editClassChair = $('#editClassChair');
                let editClassFoldableChair = $('#editClassFoldableChair');
                let editClassTable = $('#editClassTable');
                let editClassWhiteboard = $('#editClassWhiteboard');
                let editClassDuster = $('#editClassDuster');
                let id = $('#classID').val();
                // Perform your AJAX request using the updated requestData
                $.ajax({
                    ...ajaxSettings,
                    type: "PUT",
                    url: `${baseUrl}/Inventory/UPSM/Classroom/${id}`,
                    data: {
                        classname: editClassName.val(),
                        classLocation: editClassLocation.val(),
                        classChair: editClassChair.val(),
                        classFoldableChair: editClassFoldableChair.val(),
                        classTable: editClassTable.val(),
                        classWhiteboard: editClassWhiteboard.val(),
                        classDuster: editClassDuster.val()
                    },

                    success: function (response) {
                        $('#classroomTable').html(response.table).show();
                        $('Pagination').html(response.pagination).show()

                        // Handle the success response from the server
                        toastr.success(response.success, 'Success');

                        // // Hide the modal
                        $('#editRuangKelas').modal('hide');
                    },
                    error: function (xhr) {
                        toastr.error('Something went wrong', 'error')
                    }
                });
            }
        });
    }
});
