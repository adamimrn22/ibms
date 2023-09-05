$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');

    $('.btn-update-quantity').on('click', function (e) {
        let id = $(this).data('item-id');
        $('#itemAlatTulisID').val(id);
        $('#updateQuantityModal').modal('show');
    });


    $('#updateQuantityModal').on('shown.bs.modal', function (event) {
        // Retrieve the value from the modal
        let id = $('#itemAlatTulisID').val();

        $.ajax({
            type: "GET",
            url: `${baseUrl}/UKW/Inventory/AlatTulisQuantityStock/${id}`,
            success: function (response) {
                $('#quantity').val(response.quantity);
                $('#subcategory').val(response.subcategory);
            },
            error: function (xhr) {
                alert('error occured');
            }
        });
    });

    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };
    let quantityModalForm = $('#updateQuantityModalForm');
    if (quantityModalForm.length) {
        quantityModalForm.validate({
            rules: {
                quantity: {
                    required: true,
                    number: true
                },
            },
        });

        quantityModalForm.on('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting

            let quantity = $('#quantity').val();
            let id = $('#itemAlatTulisID').val();
            let subcategory = $('#subcategory').val();

            console.log(subcategory);
            $.ajax({
                ...ajaxSettings,
                type: 'POST',
                url: `${baseUrl}/UKW/Inventory/AlatTulisQuantityStock/${id}`, // Replace with your actual route
                data: {
                    quantity: quantity,
                    subcategory: subcategory
                },
                success: function (response) {
                    // Handle the success response here
                    $('#paperTable').html(response.table).show();

                    // // Hide the modal
                    $('#updateQuantityModal').modal('hide');
                },
                error: function (xhr, status, error) {
                    // Handle errors here
                    console.error('Request failed', status, error);
                }
            });
        });
    }
});
