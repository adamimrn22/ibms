$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');

    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    let editPositionForm = $('#editPositionForm');
    if (editPositionForm.length) {
        editPositionForm.validate({
            rules: {
                name: {
                    required: true,
                    minlength: 5
                },
            },
            messages: {
                name: {
                    required: "Please enter the unit name",
                    minlength: "The unit name must be at least 5 characters long"
                },
            },

            submitHandler: function (form, event) {
                // This function will be triggered when the form is valid
                // You can perform the AJAX request or other form handling logic here
                let modalEditPositionName = $('#modalEditPositionName').val();
                let positionID = $('#positionID').val()

                // Perform your AJAX request using the updated requestData
                $.ajax({
                    ...ajaxSettings,
                    type: "PUT",
                    url: `${baseUrl}/position/${positionID}`,
                    data: {
                        name: modalEditPositionName
                    },
                    success: function (response) {
                        // Reset form validation
                        let editPositionForm = $('#editPositionForm');
                        editPositionForm.validate().resetForm();
                        editPositionForm.find('.is-invalid').removeClass('is-invalid');
                        editPositionForm.find('.error').empty();

                        // Clear input values
                        editPositionForm.find('input').val('');

                        $('#positionTable').html(response.table).show();
                        $('#Pagination').html(response.pagination);

                        // Hide the modal
                        $('#editPositionModal').modal('hide');

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
                                $('#editPositionForm .is-invalid').empty();
                                $('#editPositionForm input').removeClass('is-invalid');

                                // Map the field names in the response to the corresponding input field ids
                                let fieldMap = {
                                    'name': 'name',
                                };

                                // Iterate over each error field and its messages
                                $.each(response.errors, function (field, messages) {

                                    let inputId = fieldMap[field];

                                    // Display each error message next to its corresponding input field
                                    let errorMessage = messages[0];
                                    $('#editPositionForm .' + field + '-error').html('<p>' + errorMessage + '</p>');

                                    // Add error border to the input field
                                    $('#editPositionForm #' + inputId).addClass('is-invalid');
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
