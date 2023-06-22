$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');

    const addPermissionForm = $('#addPermissionForm');
    const editPermissionForm = $('#editPermissionForm');
    const deletePermissionForm = $('#deletePermissionForm');

    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $(document).on('click', '.add-permission-modal', function () {
        let url = baseUrl + `/superadmin/permission/lists`;

        $.ajax({
            ...ajaxSettings,
            type: "GET",
            url: url,
            success: function (response) {
                // Clear previous options from the select dropdown
                $('#default-select-multi').empty();

                // Iterate over the roles array and create options
                response.roles.forEach(function (role) {
                    let option = $('<option></option>').attr('value', role.id).text(role.name);
                    $('#default-select-multi').append(option);
                });

                // Initialize select2 after populating the options
                $('#default-select-multi').select2();
            },

            error: function (xhr) {
                toastr.error('Error', xhr.response);
            }
        });
    });

    addPermissionForm.submit(function (e) {
        e.preventDefault();
        let form = $(this);
        let url = baseUrl + '/superadmin/permission';

        let roleValue = $('#default-select-multi').val();
        let permissionName = $('#permissionName').val(); //this one that i want the value to be required


        $.ajax({
            ...ajaxSettings,
            type: "POST",
            url: url,
            data: {
                permissions: permissionName,
                role: roleValue
            },
            success: function (response) {
                toastr.success('Permission updated successfully.', 'Success');

                $('#permissionTable').html(response.table);
                $('#Pagination a').html(response.pagination);

                $('#addPermissionModal').modal('hide');
                form.find('input').val('');

                form[0].reset();
                    // Clear input values
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    form[0].reset();
                    let errors = xhr.responseJSON.errors;
                    console.log('Errors:', errors);

                    form.find('.is-invalid').removeClass('is-invalid');

                    $.each(errors, function (field, messages) {
                        let inputField = form.find(`input[name="${field}"]`);

                        if (field === 'permissions') {
                            // Handle the case when field name is "permissions"
                            inputField = form.find(`input[name="permissionName"]`);
                        }

                        $.each(messages, function (index, message) {
                            inputField.addClass('is-invalid');
                            inputField.siblings('.invalid-feedback').text(message);
                        });
                    });

                    toastr.error('Validation Error', 'Please fix the errors in the form.');
                } else {
                    toastr.error('Error', 'An error occurred. Please try again later.');
                }
            }
        });
    });

    $('.editPermissionModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget); // Button that triggered the modal
        let permissionID = button.data('permission-id'); // Extract the data-user-id attribute value
        let url = baseUrl + `/superadmin/permission/${permissionID}/edit`;

        $('#permissionID').val(permissionID);
        let permissionName = $('#editPermissionName');
        let role = $('#edit-role-multi');

        $.ajax({
            ...ajaxSettings,
            type: "GET",
            url: url,
            success: function (response) {
                let permission = response.permission;
                let roles = permission.roles;
                let allRoles = response.allRoles
                let select2Data = [];

                // Populate selected roles
                roles.forEach(function (role) {
                    select2Data.push({
                        id: role.id,
                        text: role.name,
                        selected: true,
                    });
                });

                // Populate all roles
                allRoles.forEach(function (role) {
                    select2Data.push({
                        id: role.id,
                        text: role.name,
                        selected: false
                    });
                });

                // Clear any existing options and reinitialize the Select2 field
                role.empty();
                permissionName.val(permission.name)
                role.select2({ data: select2Data });
            }
        });
    });

    editPermissionForm.submit(function (e) {
        e.preventDefault()
        let permissionID = $('#permissionID').val();

        let url = baseUrl + `/superadmin/permission/${permissionID}`;
        let permissionName = $('#editPermissionName').val();
        let role = $('#edit-role-multi').val();
        let form = $(this);

        $.ajax({
            ...ajaxSettings,
            type: "PUT",
            url: url,
            data: {
                permissions: permissionName,
                role: role
            },
            success: function (response) {
                toastr.success(response.success, 'Success');
                $('#editPermissionModal').modal('hide');

                $('#permissionTable').html(response.table);

                form[0].reset();

            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    form.find('.is-invalid').removeClass('is-invalid');

                    $.each(errors, function (field, messages) {
                        let inputField = form.find(`input[name="${field}"]`);

                        if (field === 'permissions') {
                            // Handle the case when field name is "permissions"
                            inputField = form.find(`input[name="editPermissionName"]`);
                        }

                        $.each(messages, function (index, message) {
                            inputField.addClass('is-invalid');
                            inputField.siblings('.invalid-feedback').text(message);
                        });
                    });

                    toastr.error('Validation Error', 'Please fix the errors in the form.');
                } else {
                    toastr.error('Error', 'An error occurred. Please try again later.');
                }
            }
        });
    })

    $('#deletePermissionModal').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var userId = button.data('permission-id'); // Extract the data-user-id attribute value

        $('#deleteID').val(userId);
    });

    deletePermissionForm.submit(function (e) {
        e.preventDefault();

        let id = $('#deleteID').val();
        let url = baseUrl + `/superadmin/permission/${id}`

        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: url,
            success: function (response) {
                toastr.success(response.message, 'Success');
                $('#permissionTable').html(response.table);
                $('#Pagination').html(response.paginate);
                $('#deletePermissionModal').modal('hide');

                deletePermissionForm[0].reset();

            }
        });
    });

});
