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
                        // Reset form validation
                        var addRuangKelasForm = $('#addRuangKelasForm');


                        console.log(response.table)
                        // $('#sectionUser').html(response.userTotal);
                        $('#classroomTable').html(response.table).show();
                        // $('#Pagination').html(response.pagination);

                        // Clear input values
                        addRuangKelasForm.find('input').val('');
                        // // Hide the modal
                        $('#addRuangKelas').modal('hide');

                        // Handle the success response from the server
                        addRuangKelasForm.resetForm();
                        toastr.success(response.success, 'Success');
                    },
                    // error: function (xhr) {
                    //     if (xhr.status === 422) {
                    //         // The server responded with validation errors
                    //         let response = xhr.responseJSON;
                    //         if (response && response.errors) {
                    //             toastr.error('Invalid Validation Error', 'error')
                    //             // Clear any previous error messages and remove the red border
                    //             $('#addUserModal .is-invalid').empty();
                    //             $('#addUserModal input').removeClass('is-invalid');

                    //             // Map the field names in the response to the corresponding input field ids
                    //             let fieldMap = {
                    //                 'username': 'addUserID',
                    //                 'first_name': 'modalAddUserFirstName',
                    //                 'last_name': 'modalAddUserLastName',
                    //                 'user_id': 'modalUserPosition',
                    //                 'unit_id': 'modalUserUnit',
                    //                 'email': 'modalAddUserEmail',
                    //                 'phone_number': 'modalAddUserPhone'
                    //             };


                    //             // Iterate over each error field and its messages
                    //             $.each(response.errors, function (field, messages) {

                    //                 let inputId = fieldMap[field];

                    //                 // Display each error message next to its corresponding input field
                    //                 let errorMessage = messages[0];
                    //                 $('#addUserModal .' + field + '-error').html('<p>' + errorMessage + '</p>');

                    //                 // Add error border to the input field
                    //                 $('#addUserModal #' + inputId).addClass('is-invalid');
                    //             });
                    //         }
                    //     } else if (xhr.status === 403) {
                    //         toastr.error('You do not have the permission', 'Error 403')
                    //     } else {
                    //         toastr.error('Something went wrong', 'error')
                    //     }
                    // }
                });
            }
        });
    }
});
