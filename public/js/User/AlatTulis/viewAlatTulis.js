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

    $('#productCol').show();
    $('#Pagination').show();

    // Event listener for pagination links
    $(document).on('click', '#Pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let searchTerm = $('#searchItem').val();
        let recordsPerPage = $('#recordFilter').val();
        let subcategory = getCheckedCheckbox();
        fetch_data(page, searchTerm, recordsPerPage, subcategory);
    });

    $(document).on('keyup', '#searchItem', function () {
        // Clear the previous timer
        clearTimeout(searchTimer);

        searchTimer = setTimeout(() => {
            let searchTerm = $(this).val();
            let recordsPerPage = $('#recordFilter').val();
            let subcategory = getCheckedCheckbox();
            fetch_data(1, searchTerm, recordsPerPage, subcategory);
        }, 500);
    });

    // Event listener for record filter
    $(document).on('change', '#recordFilter', function () {
        let recordsPerPage = $(this).val();
        let searchTerm = $('#searchItem').val();
        let subcategory = getCheckedCheckbox();
        fetch_data(1, searchTerm, recordsPerPage, subcategory);
    });

    $('.category-checkbox').on('change', function () {
        // Uncheck all other checkboxes except the one that triggered the change event
        $('.category-checkbox').not(this).prop('checked', false);

        let searchTerm = $('#searchItem').val();
        let recordsPerPage = $('#recordFilter').val();
        let subcategory = getCheckedCheckbox();
        fetch_data(1, searchTerm, recordsPerPage, subcategory);
    });

    // Function to get the value of the checked checkbox
    function getCheckedCheckbox() {
        let k = $('.category-checkbox:checked').val()
        console.log(k)
        return $('.category-checkbox:checked').val() || ''; // Return the value of the checked checkbox or an empty string
    }

    // Function to fetch data
    function fetch_data(page, searchTerm = '', recordsPerPage = '', subcategory = '') {
        $.ajax({
            ...ajaxSettings,
            url: `${baseUrl}/User/Booking/UKW/ViewAlatTulis`,
            type: "GET",
            data: {
                page: page,
                search: searchTerm,
                records: recordsPerPage,
                subcategory: subcategory,
            },
            beforeSend: function () {
                $('#productCol').hide();
                spinnerContainer.show();
            },
            success: function (data) {
                spinnerContainer.hide();
                $('#productCol').html(data.grid).show();
                $('#Pagination').html(data.pagination);
            },
            error: function (xhr) {
                spinnerContainer.hide();
            }
        });
    }
});
