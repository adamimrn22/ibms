$(document).ready(function () {

    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    let editUserForm = $('#editUserForm');
    if (editUserForm.length) {
        editUserForm.validate({
            rules: {
                modalEditUserFirstName: {
                    required: true
                },
                modalEditUserLastName: {
                    required: true
                },
                modalEditUserPhone: {
                    required: true,
                },
                modalEditUserEmail: {
                    required: true,
                    email: true
                }
            },
            messages: {
                editUserID: {
                    required: "Please enter the staff ID",
                    minlength: "The staff ID must be at least 5 characters long",
                    maxlength: "The staff ID cannot exceed 10 characters"
                },
                modalEditUserFirstName: {
                    required: "Please enter the first name"
                },
                modalEditUserLastName: {
                    required: "Please enter the last name"
                },
                modalEditUserPhone: {
                    required: "Please enter a valid phone number"
                },
                modalEditUserEmail: {
                    required: "Please enter a valid email address",
                    email: "Please enter a valid email address"
                }
            },

            submitHandler: function (form, event) {
                event.preventDefault()
                // This function will be triggered when the form is valid
                // You can perform the AJAX request or other form handling logic here
                let userID = $('#userID').val();
                let editUserID = $('#editModalUserID').val();
                let modalEditUserFirstName = $('#editModalUserFirstName').val();
                let modalEditUserLastName = $('#editModalUserLastName').val();
                let modalUserPosition = $('#editModalUserPosition').val();
                let modalUserUnit = $('#editModalUserUnit').val();
                let modalEditUserEmail = $('#editModalUserEmail').val();
                let modalEditUserPhone = $('#editModalUserPhone').val();
                let modalEditUserStatus = $('#editModalUserStatus').val();


                // Perform your AJAX request using the updated requestData
                $.ajax({
                    ...ajaxSettings,
                    type: "PUT",
                    url: `/users/${userID}`,
                    data: {
                        isActive: modalEditUserStatus,
                        first_name: modalEditUserFirstName,
                        last_name: modalEditUserLastName,
                        position_id: modalUserPosition,
                        unit_id: modalUserUnit,
                        email: modalEditUserEmail,
                        phone_number: modalEditUserPhone
                    },
                    success: function (response) {
                        // Reset form validation
                        let editUserForm = $('#editUserForm');
                        editUserForm.validate().resetForm();
                        editUserForm.find('.is-invalid').removeClass('is-invalid');
                        editUserForm.find('.error').empty();

                        // Clear input values
                        editUserForm.find('input').val('');

                        $('#sectionUser').html(response.userTotal);
                        $('#userListTable').html(response.table).show();
                        $('#Pagination').html(response.pagination);

                        // Hide the modal
                        $('#editUserModal').modal('hide');

                        // Handle the success response from the server
                        toastr.success(response.success, 'Success');
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            // The server responded with validation errors
                            let response = xhr.responseJSON;
                            if (response && response.errors) {
                                toastr.error('Invalid Validation Error', 'error')
                                // Clear any previous error messages and remove the red border
                                $('#editUserModal .is-invalid').empty();
                                $('#editUserModal input').removeClass('is-invalid');

                                // Map the field names in the response to the corresponding input field ids
                                let fieldMap = {
                                    'username': 'editModalUserID',
                                    'first_name': 'editModalUserFirstName',
                                    'last_name': 'editModalUserLastName',
                                    'user_id': 'editModalUserPosition',
                                    'unit_id': 'editModalUserUnit',
                                    'email': 'editModalUserEmail',
                                    'phone_number': 'editModalUserPhone'
                                };


                                // Iterate over each error field and its messages
                                $.each(response.errors, function (field, messages) {

                                    let inputId = fieldMap[field];

                                    // Display each error message next to its corresponding input field
                                    let errorMessage = messages[0];
                                    $('#editUserModal .' + field + '-error').html('<p>' + errorMessage + '</p>');
                                    // Add red border to the input field
                                    // $('#addUserModal #modal' + field).addClass('error')


                                    // Add error border to the input field
                                    $('#editUserModal #' + inputId).addClass('is-invalid');
                                });
                            }
                        } else {
                            toastr.error(xhr.error, 'error')
                        }
                    }
                });
            }
        });

        // Format the contact input field with hyphens
        $('#modalEditUserPhone').on('input', function () {
            var value = $(this).val();
            var digitsOnly = value.replace(/\D/g, '');
            var formattedValue = digitsOnly.replace(/(\d{3})(\d{3})(\d+)/, '$1-$2-$3');
            $(this).val(formattedValue);
        });

    }
});
