$('#paperTable').hide();
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

    $('#paperTable').show();
    $('#Pagination').show();

    // Event listener for pagination links
    $(document).on('click', '#Pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let searchTerm = $('#searchPaper').val();
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(page, searchTerm, recordsPerPage);
    });

    // Event listener for search input (onkeyup event)
    $(document).on('keyup', '#searchPaper', function () {
        // Clear the previous timer
        clearTimeout(searchTimer);

        // Start a new timer to delay the AJAX request
        searchTimer = setTimeout(() => {
            let searchTerm = $(this).val();
            let recordsPerPage = $('#recordFilter').val();
            fetch_data(1, searchTerm, recordsPerPage);
        }, 500); // Specify the desired delay in milliseconds (e.g., 500ms)
    });

    // Event listener for record filter
    $(document).on('change', '#recordFilter', function () {
        let recordsPerPage = $(this).val();
        let searchTerm = $('#searchPaper').val();
        fetch_data(1, searchTerm, recordsPerPage);
    });

    // Function to fetch data
    function fetch_data(page, searchTerm = '', recordsPerPage = '') {
        $.ajax({
            ...ajaxSettings,
            url: `${baseUrl}/UKW/Inventory/A4 Paper`,
            type: "GET",
            data: {
                page: page,
                search: searchTerm,
                records: recordsPerPage
            },
            beforeSend: function () {
                $('#paperTable').hide();
                spinnerContainer.show();

            },
            success: function (data) {
                spinnerContainer.hide();
                $('#paperTable').html(data.table).show();
                $('#Pagination').html(data.pagination);
            },
            error: function (xhr) {
                spinnerContainer.hide();
            }
        });
    }

});
