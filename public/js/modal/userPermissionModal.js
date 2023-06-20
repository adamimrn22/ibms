$(document).ready(function () {
    const addPermissionForm = $('#addPermissionForm');
    const deleteUserRoleForm = $('#deleteUserRolePermissionForm');
    let userID;

    var baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function (xhr) {
            toastr.error('Error', xhr.response);
        }
    };

    // For User in role page adding their permission
    $(document).on('click', '.add-permission-user-modal', function () {
        let username = $('#userPermissionName');
        userID = $(this).data('user-id');
        let addModal = $('#addUserPermissionModal');

        let url = baseUrl + `/superadmin/permission/${userID}`

        $.ajax({
            ...ajaxSettings,
            type: 'GET',
            url: url,
            success: function (response) {

                let tableBody = $('#addUserPermissionTableBody');
                username.text(response.user.name)
                let permissionsHtml = '';
                for (const groupName in response.groupedPermissions) {
                    const permissions = response.groupedPermissions[groupName];
                    let permissionInputs = '';

                    for (const permission of permissions) {
                        const isChecked = response.user.permissions.some(
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
                addModal.modal('show');
            }
        })

    });

    addPermissionForm.submit(function (e) {
        e.preventDefault()

        let url = baseUrl + `/superadmin/userPermission/${userID}`
        let permissions = [];

        // check the permission checkbox
        $('.table-responsive input[type="checkbox"]:checked').each(function () {
            permissions.push($(this).attr('id'));
        });

        $.ajax({
            ...ajaxSettings,
            type: "POST",
            url: url,
            data: {
                permissions: permissions
            },
            success: function (response) {
                $('#addUserPermissionModal').modal('hide');
                toastr.success('User permission updated successfully.', 'Success');
                addPermissionForm.find('form')[0].reset();
            }
        });
    })

    $('.role-deleteUserPermission-modal').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var userId = button.data('user-id'); // Extract the data-user-id attribute value

        $('#deleteID').val(userId);
    });

    deleteUserRoleForm.submit(function (e) {
        e.preventDefault();

        let id = $('#deleteID').val();
        let url = baseUrl + `/superadmin/deleteUserPermission/${id}`

        $.ajax({
            ...ajaxSettings,
            type: "POST",
            url: url,
            success: function (response) {
                if (response.status === 'success') {
                    toastr.success(response.message, 'Success');
                    $('#userListRolesTable').html(response.table)
                    $('#roleUserDeleteModal').modal('hide');
                    deleteUserRoleForm[0].reset();
                } else {
                    toastr.error('An error occurred. Please try again later.', 'Error');
                }
            }
        });
    })
});
