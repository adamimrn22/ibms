$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');

    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    let editUnitForm = $('#editUnitForm');
    if (editUnitForm.length) {
        editUnitForm.validate({
            rules: {
                name: {
                    required: true,
                    minlength: 5
                },
            },
            messages: {
                modalEditUnitName: {
                    required: "Please enter the unit name",
                    minlength: "The unit name must be at least 5 characters long"
                },
            },

            submitHandler: function (form, event) {
                // This function will be triggered when the form is valid
                // You can perform the AJAX request or other form handling logic here
                let modalEditUnitName = $('#modalEditUnitName').val();
                let unitID = $('#unitID').val()

                // Perform your AJAX request using the updated requestData
                $.ajax({
                    ...ajaxSettings,
                    type: "PUT",
                    url: `${baseUrl}/unit/${unitID}`,
                    data: {
                        name: modalEditUnitName
                    },
                    success: function (response) {
                        // Reset form validation
                        let editUnitForm = $('#editUnitForm');
                        editUnitForm.validate().resetForm();
                        editUnitForm.find('.is-invalid').removeClass('is-invalid');
                        editUnitForm.find('.error').empty();

                        // Clear input values
                        editUnitForm.find('input').val('');

                        $('#unitTable').html(response.table).show();
                        $('#Pagination').html(response.pagination);

                        // Hide the modal
                        $('#editUnitModal').modal('hide');

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
                                $('#editUnitForm .is-invalid').empty();
                                $('#editUnitForm input').removeClass('is-invalid');

                                // Map the field names in the response to the corresponding input field ids
                                let fieldMap = {
                                    'name': 'name',
                                };


                                // Iterate over each error field and its messages
                                $.each(response.errors, function (field, messages) {

                                    let inputId = fieldMap[field];

                                    // Display each error message next to its corresponding input field
                                    let errorMessage = messages[0];
                                    $('#editUnitForm .' + field + '-error').html('<p>' + errorMessage + '</p>');

                                    // Add error border to the input field
                                    $('#editUnitForm #' + inputId).addClass('is-invalid');
                                });
                            }
                        } else {
                            toastr.error(xhr.error, 'error')
                        }
                    }
                });
            }
        });
    }
});
