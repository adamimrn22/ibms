$('#roleSpinner').show();
$('#desktopTable').hide();
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
    $('#desktopTable').show();
    $('#Pagination').show();

    // Event listener for pagination links
    $(document).on('click', '#Pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let searchTerm = $('#searchDesktop').val();
        let status = $('#statusFilter').val();
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(page, searchTerm, status, recordsPerPage);
    });

    // Event listener for search input (onkeyup event)
    $(document).on('keyup', '#searchDesktop', function () {
        // Clear the previous timer
        clearTimeout(searchTimer);

        // Start a new timer to delay the AJAX request
        searchTimer = setTimeout(() => {
            let searchTerm = $(this).val();
            let status = $('#statusFilter').val();
            let recordsPerPage = $('#recordFilter').val();
            fetch_data(1, searchTerm, status, recordsPerPage);
        }, 600); // Specify the desired delay in milliseconds (e.g., 500ms)
    });

    // Event listener for active filter
    $(document).on('change', '#statusFilter', function (e) {
        let status = $(this).val();
        let searchTerm = $('#searchDesktop').val();
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(1, searchTerm, status, recordsPerPage);
    });

    // Event listener for record filter
    $(document).on('change', '#recordFilter', function () {
        let recordsPerPage = $(this).val();
        let searchTerm = $('#searchDesktop').val();
        let status = $('#statusFilter').val();
        fetch_data(1, searchTerm, status, recordsPerPage);
    });

    // Function to fetch data
    function fetch_data(page, searchTerm = '', status = '', recordsPerPage = '') {
        $.ajax({
            ...ajaxSettings,
            url: `${baseUrl}/Inventory/UIT/Hardware/Desktop`,
            type: "GET",
            data: {
                page: page,
                search: searchTerm,
                status: status,
                records: recordsPerPage
            },
            beforeSend: function () {
                $('#desktopTable').hide();
                spinnerContainer.show();

            },
            success: function (data) {
                spinnerContainer.hide();
                $('#desktopTable').html(data.table).show();
                $('#Pagination').html(data.pagination);
            },
            error: function (xhr) {
                spinnerContainer.hide();
            }
        });
    }

});
