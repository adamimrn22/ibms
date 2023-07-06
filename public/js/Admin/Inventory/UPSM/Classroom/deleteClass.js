$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#classroomTable').on('click', '.delete-classroom-modal', function () {
        let id = $(this).data('classroom-id');
        $('#deleteID').val(id);
        console.log(id)
    });

    let deleteRuangKelasForm = $('#deleteRuangKelasForm');

    deleteRuangKelasForm.submit(function (e) {
        e.preventDefault();

        let id = $('#deleteID').val();
        console.log(id)
        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/Inventory/UPSM/Classroom/${id}`,
            success: function (response) {
                console.log(response.table)
                $('#classroomTable').html(response.table).show();
                $('#Pagination').html(response.pagination).show()

                // Handle the success response from the server
                toastr.success(response.success, 'Success');

                // // Hide the modal
                $('#deleteRuangKelas').modal('hide');
            },
            error: function (xhr) {
                toastr.error(xhr, 'Error');
            }
        });



    });

})
