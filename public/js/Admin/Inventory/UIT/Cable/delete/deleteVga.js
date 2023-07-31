$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#vgaTable').on('click', '.delete-vga-modal', function () {
        let id = $(this).data('vga-id');
        $('#deleteID').val(id);
    });

    let deleteVgaForm = $('#deleteVgaForm');

    deleteVgaForm.submit(function (e) {
        e.preventDefault();

        let deleteID = $('#deleteID').val()
        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/Inventory/UIT/Cable/Vga/${deleteID}`,
            success: function (response) {
                $('#vgaTable').html(response.table).show();
                $('#Pagination').html(response.pagination).show()

                // // Hide the modal
                $('#deleteVgaModal').modal('hide');

                // Handle the success response from the server
                toastr.success(response.success, 'Success');
            },
            error: function (xhr) {
                toastr.error(xhr, 'Error');
            }
        });
    });
});
