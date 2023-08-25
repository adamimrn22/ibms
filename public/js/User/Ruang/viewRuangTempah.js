$('#ruangTempahTable').hide();
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

    $('#ruangTempahTable').show();
    $('#Pagination').show();

    // Event listener for pagination links
    $(document).on('click', '#Pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let searchTerm = $('#searchTujuan').val();
        fetch_data(page, searchTerm);
    });

    // Event listener for search input (onkeyup event)
    $(document).on('keyup', '#searchTujuan', function () {
        // Clear the previous timer
        clearTimeout(searchTimer);

        // Start a new timer to delay the AJAX request
        searchTimer = setTimeout(() => {
            let searchTerm = $(this).val();
            fetch_data(1, searchTerm);
        }, 500); // Specify the desired delay in milliseconds (e.g., 500ms)
    });

    // Function to fetch data
    function fetch_data(page, searchTerm = '') {
        $.ajax({
            ...ajaxSettings,
            url: `${baseUrl}/User/Booking/UPSM/Ruang/ViewTempahan`,
            type: "GET",
            data: {
                page: page,
                search: searchTerm,
            },
            beforeSend: function () {
                $('#ruangTempahTable').hide();
                spinnerContainer.show();

            },
            success: function (data) {
                spinnerContainer.hide();
                $('#ruangTempahTable').html(data.table).show();
                $('#Pagination').html(data.pagination);
            },
            error: function (xhr) {
                spinnerContainer.hide();
            }
        });
    }

});
