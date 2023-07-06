$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

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
                },
                classFoldableChair: {
                    required: true,
                },
                classTable: {
                    required: true,
                },
                classWhiteboard: {
                    required: true,
                },
                classDuster: {
                    required: true,
                },
            },

            submitHandler: function (form, event) {
                event.preventDefault()
                // This function will be triggered when the form is valid
                // You can perform the AJAX request or other form handling logic here
                let className = $('#className').val();
                let classLocation = $('#classLocation').val();
                let classChair = $('#classChair').val();
                let classFoldableChair = $('#classFoldableChair').val();
                let classTable = $('#classTable').val();
                let classWhiteboard = $('#classWhiteboard').val();
                let classDuster = $('#classDuster').val();

                // Perform your AJAX request using the updated requestData
                $.ajax({
                    ...ajaxSettings,
                    type: "POST",
                    url: `${baseUrl}/Inventory/UPSM/Classroom`,
                    data: {
                        classname: className.toUpperCase(),
                        classLocation: classLocation,
                        classChair: classChair,
                        classFoldableChair: classFoldableChair,
                        classTable: classTable,
                        classWhiteboard: classWhiteboard,
                        classDuster: classDuster
                    },

                    success: function (response) {

                        console.log(response.table)
                        $('#classroomTable').html(response.table).show();
                        $('#Pagination').html(response.pagination);

                        addRuangKelasForm.find('input').val('');

                        // Handle the success response from the server
                        toastr.success(response.success, 'Success');

                        // // Hide the modal
                        $('#addRuangKelas').modal('hide');
                    },
                    error: function (xhr) {
                        toastr.error('Something went wrong', 'error')
                    }
                });
            }
        });
    }
});
