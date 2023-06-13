$(document).ready(function () {
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function (xhr) {
            toastr.error('Error', xhr.response);
        }
    };

    const addRoleForm = $('#addRoleForm');
    const editRoleForm = $('#editRoleForm');
    const deleteModal = $('#deleteModal');

    $(document).on('click', '.role-add-modal', function () {
        var baseUrl = $('meta[name="base-url"]').attr('content');
        var url = baseUrl + '/superadmin/permission/create';
        let addModal = $('#addRoleModal');
        $.ajax({
            ...ajaxSettings,
            type: 'GET',
            url: url,
            success: function (response) {
                let tableBody = $('#addPermissionTableBody');

                let permissionsHtml = '';
                for (const groupName in response.groupedPermissions) {
                    const permissions = response.groupedPermissions[groupName];
                    let permissionInputs = '';

                    for (const permission of permissions) {
                        // Always set the checkbox to unchecked
                        permissionInputs += `
                      <div class="form-check me-3 me-lg-5">
                        <input class="form-check-input" type="checkbox" id="${permission.name}">
                        <label class="form-check-label" for="${permission.name}">${permission.name}</label>
                      </div>
                    `;
                    }

                    permissionsHtml += `
                    <tr>
                      <td class="text-nowrap fw-bolder">${groupName}</td>
                      <td>
                        <div class="d-flex">
                          ${permissionInputs}
                        </div>
                      </td>
                    </tr>
                  `;
                }

                tableBody.html(permissionsHtml);
                addModal.modal('show');
            }

        });
    });

    addRoleForm.submit(function (e) {
        e.preventDefault();
        let name = $('#name').val();
        let permissions = [];

        $('.table-responsive input[type="checkbox"]:checked').each(function () {
            permissions.push($(this).attr('id'));
        });

        $.ajax({
            ...ajaxSettings,
            type: 'POST',
            url: '/superadmin/roles',
            data: {
                name: name,
                permissions: permissions
            },
            success: function (response) {
                $('#roleContainer').html(response.roleSection);
                $('#addRoleModal').modal('hide');
                // Clear the form fields
                addModal.find('form')[0].reset();

                toastr.success('Role created successfully.', 'Success');
            },
            statusCode: {
                422: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let form = editRoleForm;
                    let toastrOptions = {
                        // Adjust toastr options as needed
                    };

                    form.find('.is-invalid').removeClass('is-invalid');
                    form.find('.invalid-feedback').empty();

                    $.each(errors, function (field, messages) {
                        let inputField = form.find(`input[name="${field}"]`);
                        let errorContainer = inputField.next('.invalid-feedback');
                        inputField.addClass('is-invalid');

                        $.each(messages, function (index, message) {
                            errorContainer.append('<div>' + message + '</div>');
                        });
                    });

                    toastr.error(
                        'Validation Error',
                        'Please fix the errors in the form.',
                        toastrOptions
                    );
                }
            }
        });
    });

    $(document).on('click', '.role-edit-modal', function () {
        let roleId = $(this).data('role-id');
        let editModal = $('#editRoleModal');
        $('#deleteRoleId').val(roleId);

        $.ajax({
            ...ajaxSettings,
            type: 'GET',
            url: '/superadmin/roles/' + roleId,
            success: function (response) {
                let editRoleId = $('#editRoleId');
                let editName = $('#editName');
                let tableBody = $('#permissionTableBody');

                editRoleId.val(roleId);
                editName.val(response.role.name);

                let permissionsHtml = '';
                for (const groupName in response.groupedPermissions) {
                    const permissions = response.groupedPermissions[groupName];
                    let permissionInputs = '';

                    for (const permission of permissions) {
                        const isChecked = response.role.permissions.some(
                            (p) => p.name === permission.name
                        );
                        permissionInputs += `
                <div class="form-check me-3 me-lg-5">
                  <input class="form-check-input" type="checkbox" id="${permission.name}" ${isChecked ? 'checked' : ''
                            }>
                  <label class="form-check-label" for="${permission.name}">${permission.name}</label>
                </div>
              `;
                    }

                    permissionsHtml += `
              <tr>
                <td class="text-nowrap fw-bolder">${groupName}</td>
                <td>
                  <div class="d-flex">
                    ${permissionInputs}
                  </div>
                </td>
              </tr>
            `;
                }

                tableBody.html(permissionsHtml);
                editModal.modal('show');
            }
        });
    });

    editRoleForm.submit(function (e) {
        e.preventDefault();

        let id = $('#editRoleId').val();
        let roleName = $('#editName').val();

        let permissions = [];

        $('.table-responsive input[type="checkbox"]:checked').each(function () {
            permissions.push($(this).attr('id'));
        });

        let data = {
            id: id,
            name: roleName,
            permissions: permissions
        };

        $.ajax({
            ...ajaxSettings,
            type: 'PATCH',
            url: `/superadmin/roles/${id}`,
            data: data,
            success: function (response) {
                $('#roleContainer').html(response.roleSection);
                $('#editRoleModal').modal('hide');

                toastr.success('Role updated successfully.', 'Success');
                editModal.find('form')[0].reset();
            },
            statusCode: {
                422: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let form = editRoleForm;
                    let toastrOptions = {
                        // Adjust toastr options as needed
                    };

                    form.find('.is-invalid').removeClass('is-invalid');
                    form.find('.invalid-feedback').empty();

                    $.each(errors, function (field, messages) {
                        let inputField = form.find(`input[name="${field}"]`);
                        let errorContainer = inputField.next('.invalid-feedback');
                        inputField.addClass('is-invalid');

                        $.each(messages, function (index, message) {
                            errorContainer.append('<div>' + message + '</div>');
                        });
                    });

                    toastr.error(
                        'Validation Error',
                        'Please fix the errors in the form.',
                        toastrOptions
                    );
                }
            }
        });
    });

    deleteModal.submit(function (e) {
        e.preventDefault();
        let id = $('#deleteRoleId').val();
        console.log(id)
        $.ajax({
            ...ajaxSettings,
            type: 'DELETE',
            url: `/superadmin/roles/${id}`,
            data: id,
            success: function (response) {
                $('#roleContainer').html(response.roleSection);
                $('#deleteRole').modal('hide');
                $('#editRoleModal').modal('hide');
                toastr.success('Role deleted successfully.', 'Success');
            }
        });
    });
});
