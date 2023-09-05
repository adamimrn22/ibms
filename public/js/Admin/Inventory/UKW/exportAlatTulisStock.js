$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');

    $("#expandButton").on('click', function () {
        $("#cardBodyContent").collapse('toggle');
    });

    $("#exportLink").click(function (event) {
        event.preventDefault();

        let exportType = $('#exportType').val();

        // Generate the export URL with the selected values
        let exportUrl = `${baseUrl}/UKW/ExportStockAlatTulis?exportType=${exportType}`;

        // Navigate to the generated URL
        window.open(exportUrl, '_blank');
    });
});
