$(document).ready(function () {
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    let addUnitForm = $('#addUnitForm');
    if (addUnitForm.length) {
        addUnitForm.validate({
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
                let modalAddUnitName = $('#modalAddUnitName').val();

                // Perform your AJAX request using the updated requestData
                $.ajax({
                    ...ajaxSettings,
                    type: "POST",
                    url: "/superadmin/unit",
                    data: {
                        name: modalAddUnitName
                    },
                    success: function (response) {
                        // Reset form validation
                        let addUnitForm = $('#addUnitForm');
                        addUnitForm.validate().resetForm();
                        addUnitForm.find('.is-invalid').removeClass('is-invalid');
                        addUnitForm.find('.error').empty();

                        // Clear input values
                        addUnitForm.find('input').val('');

                        $('#unitTable').html(response.table).show();
                        console.log(response)
                        $('#Pagination').html(response.pagination);

                        // Hide the modal
                        $('#addUnitModal').modal('hide');

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
                                $('#addUnitModal .is-invalid').empty();
                                $('#addUnitModal input').removeClass('is-invalid');

                                // Map the field names in the response to the corresponding input field ids
                                let fieldMap = {
                                    'name': 'name',
                                };


                                // Iterate over each error field and its messages
                                $.each(response.errors, function (field, messages) {

                                    let inputId = fieldMap[field];

                                    // Display each error message next to its corresponding input field
                                    let errorMessage = messages[0];
                                    $('#addUnitModal .' + field + '-error').html('<p>' + errorMessage + '</p>');

                                    // Add error border to the input field
                                    $('#addUnitModal #' + inputId).addClass('is-invalid');
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
