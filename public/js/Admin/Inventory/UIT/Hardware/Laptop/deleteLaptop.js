$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#laptopTable').on('click', '.delete-laptop-modal', function () {
        let id = $(this).data('laptop-id');
        $('#deleteID').val(id);
    });

    let deleteLaptopForm = $('#deleteLaptopForm');

    deleteLaptopForm.submit(function (e) {
        e.preventDefault();

        let deleteID = $('#deleteID').val()
        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/Inventory/UIT/Hardware/Laptop/${deleteID}`,
            success: function (response) {
                $('#laptopTable').html(response.table).show();
                $('#Pagination').html(response.pagination).show()

                // // Hide the modal
                $('#deleteLaptopModal').modal('hide');

                // Handle the success response from the server
                toastr.success(response.success, 'Success');
            },
            error: function (xhr) {
                toastr.error(xhr, 'Error');
            }
        });
    });
});
