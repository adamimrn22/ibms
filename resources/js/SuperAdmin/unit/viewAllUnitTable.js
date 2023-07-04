$(document).ready(function () {
    // Spinner container
    const spinnerContainer = $('#roleSpinner');
    spinnerContainer.hide();

    let baseUrl = $('meta[name="base-url"]').attr('content');

    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    // Event listener for pagination links
    $(document).on('click', '#Pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let searchTerm = $('#searchUnit').val();
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(page, searchTerm, recordsPerPage);
    });

    // Event listener for search input (onkeyup event)
    $(document).on('keyup', '#searchUnit', function () {
        let searchTerm = $(this).val();
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(1, searchTerm, recordsPerPage);
    });


    // Event listener for record filter
    $(document).on('change', '#recordFilter', function () {
        let recordsPerPage = $(this).val();
        let searchTerm = $('#searchUnit').val();
        fetch_data(1, searchTerm, recordsPerPage);
    });

    // Function to fetch data
    function fetch_data(page, searchTerm = '', recordsPerPage = '') {
        $.ajax({
            url: `${baseUrl}/unit`,
            type: "GET",
            data: {
                page: page,
                search: searchTerm,
                records: recordsPerPage
            },
            beforeSend: function () {
                $('#unitTable').hide();
                spinnerContainer.show();

            },
            success: function (data) {
                spinnerContainer.hide();
                $('#unitTable').html(data.table).show();
                $('#Pagination').html(data.pagination);
            },
            error: function (xhr) {
                spinnerContainer.hide();
            }
        });
    }

    $('#unitTable').on('click', '.edit-unit-modal', function () {
        let id = $(this).data('unit-id');
        $('#unitID').val(id);
        let name = $('#modalEditUnitName');

        $.ajax({
            ...ajaxSettings,
            type: "GET",
            url: `${baseUrl}/unit/${id}`,
            success: function (response) {
                name.val(response.unit)
            }
        });
    });
});
