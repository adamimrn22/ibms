$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');

    let deleteUnitForm = $('#deleteUserForm ');

    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#userListTable').on('click', '.delete-user-modal', function () {
        let id = $(this).data('user-id')
        $('#deleteID').val(id);
        console.log(id)
    });

    deleteUnitForm.submit(function (e) {
        e.preventDefault();
        let id = $('#deleteID').val();

        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/users/${id}`,
            success: function (response) {
                $('#userSection').html(response.userTotal);
                $('#userListTable').html(response.table);
                $('#Pagination').html(response.pagination);
                // Hide the modal
                $('#deleteUserModal').modal('hide');

                // Handle the success response from the server
                toastr.success(response.success, 'Success');
            }
        });
    });
});
