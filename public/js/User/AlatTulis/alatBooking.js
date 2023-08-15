$('#alatanBookingTable').hide();
$('#Pagination').hide();

$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');

    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };
    let searchTimer;

    // Spinner container
    const spinnerContainer = $('#roleSpinner');
    spinnerContainer.hide();

    $('#alatanBookingTable').show();
    $('#Pagination').show();

    // Event listener for pagination links
    $(document).on('click', '#Pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(page, recordsPerPage);
    });


    // Event listener for record filter
    $(document).on('change', '#recordFilter', function () {
        let recordsPerPage = $(this).val();
        fetch_data(1, recordsPerPage);
    });

    // Function to fetch data
    function fetch_data(page, recordsPerPage = '') {
        $.ajax({
            ...ajaxSettings,
            url: `${baseUrl}/test1`,
            type: "GET",
            data: {
                page: page,
                records: recordsPerPage
            },
            beforeSend: function () {
                $('#alatanBookingTable').hide();
                spinnerContainer.show();

            },
            success: function (data) {
                spinnerContainer.hide();
                $('#alatanBookingTable').html(data.table).show();
                $('#Pagination').html(data.pagination);
            },
            error: function (xhr) {
                spinnerContainer.hide();
            }
        });
    }

});
