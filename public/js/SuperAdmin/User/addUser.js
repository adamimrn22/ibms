$(document).ready(function () {

    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    let AddUserForm = $('#AddUserForm');
    if (AddUserForm.length) {
        AddUserForm.validate({
            rules: {
                addUserID: {
                    required: true,
                    minlength: 5,
                    maxlength: 10
                },
                modalAddUserFirstName: {
                    required: true
                },
                modalAddUserLastName: {
                    required: true
                },
                modalAddUserPhone: {
                    required: true,
                },
                modalAddUserEmail: {
                    required: true,
                    email: true
                }
            },
            messages: {
                addUserID: {
                    required: "Please enter the staff ID",
                    minlength: "The staff ID must be at least 5 characters long",
                    maxlength: "The staff ID cannot exceed 10 characters"
                },
                modalAddUserFirstName: {
                    required: "Please enter the first name"
                },
                modalAddUserLastName: {
                    required: "Please enter the last name"
                },
                modalAddUserPhone: {
                    required: "Please enter a valid phone number"
                },
                modalAddUserEmail: {
                    required: "Please enter a valid email address",
                    email: "Please enter a valid email address"
                }
            },

            submitHandler: function (form, event) {
                event.preventDefault()
                // This function will be triggered when the form is valid
                // You can perform the AJAX request or other form handling logic here
                let addUserID = $('#addUserID').val();
                let modalAddUserFirstName = $('#modalAddUserFirstName').val();
                let modalAddUserLastName = $('#modalAddUserLastName').val();
                let modalUserPosition = $('#modalUserPosition').val();
                let modalUserUnit = $('#modalUserUnit').val();
                let modalAddUserEmail = $('#modalAddUserEmail').val();
                let modalAddUserPhone = $('#modalAddUserPhone').val();

                // Perform your AJAX request using the updated requestData
                $.ajax({
                    ...ajaxSettings,
                    type: "POST",
                    url: "/superadmin/users",
                    data: {
                        username: addUserID.toUpperCase(),
                        first_name: modalAddUserFirstName.toUpperCase(),
                        last_name: modalAddUserLastName.toUpperCase(),
                        position_id: modalUserPosition.toUpperCase(),
                        unit_id: modalUserUnit,
                        email: modalAddUserEmail,
                        phone_number: modalAddUserPhone
                    },
                    success: function (response) {
                        // Reset form validation
                        var addUserForm = $('#AddUserForm');
                        addUserForm.validate().resetForm();
                        addUserForm.find('.is-invalid').removeClass('is-invalid');
                        addUserForm.find('.error').empty();

                        // Clear input values
                        addUserForm.find('input').val('');

                        $('#sectionUser').html(response.userTotal);
                        $('#userListTable').html(response.table).show();
                        $('#Pagination').html(response.pagination);

                        // Hide the modal
                        $('#addUserModal').modal('hide');

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
                                $('#addUserModal .is-invalid').empty();
                                $('#addUserModal input').removeClass('is-invalid');

                                // Map the field names in the response to the corresponding input field ids
                                let fieldMap = {
                                    'username': 'addUserID',
                                    'first_name': 'modalAddUserFirstName',
                                    'last_name': 'modalAddUserLastName',
                                    'user_id': 'modalUserPosition',
                                    'unit_id': 'modalUserUnit',
                                    'email': 'modalAddUserEmail',
                                    'phone_number': 'modalAddUserPhone'
                                };


                                // Iterate over each error field and its messages
                                $.each(response.errors, function (field, messages) {

                                    let inputId = fieldMap[field];

                                    // Display each error message next to its corresponding input field
                                    let errorMessage = messages[0];
                                    $('#addUserModal .' + field + '-error').html('<p>' + errorMessage + '</p>');

                                    // Add error border to the input field
                                    $('#addUserModal #' + inputId).addClass('is-invalid');
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
        $('#modalAddUserPhone').on('input', function () {
            var value = $(this).val();
            var digitsOnly = value.replace(/\D/g, '');
            var formattedValue = digitsOnly.replace(/(\d{3})(\d{3})(\d+)/, '$1-$2-$3');
            $(this).val(formattedValue);
        });

    }
});
