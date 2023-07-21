$(document).ready(function () {

    $("#addStorageBtn").click(function () {
        var newInput = '<div class="row d-flex align-items-center mb-1">' +
            '<div class="col-md-6 col-12">' +
            '<input type="text" class="form-control" name="storage[]" placeholder="HDD SEAGATE 1TB">' +
            '</div>' +
            '<div class="col-md-2 col-12 m-0 pl-2">' +
            '<button class="btn btn-outline-danger text-nowrap px-1 waves-effect deleteStorageBtn" type="button">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x me-25">' +
            '<line x1="18" y1="6" x2="6" y2="18"></line>' +
            '<line x1="6" y1="6" x2="18" y2="18"></line>' +
            '</svg>' +
            '<span>Delete</span>' +
            '</button>' +
            '</div>' +
            '</div>';

        $("#inputContainer").append(newInput);
        toggleDeleteButton();
    });


    // Event delegation for delete button
    $("#inputContainer").on("click", ".deleteStorageBtn", function () {
        $(this).closest(".row").remove();
        toggleDeleteButton();
    });

    // Function to toggle delete button visibility
    function toggleDeleteButton() {
        var inputCount = $("#inputContainer .row").length;
        $(".deleteStorageBtn").toggle(inputCount > 1);
    }

    $("#addMonitorBtn").click(function () {
        var newSelect =
            '<div class="row d-flex align-items-center mb-1">' +
            '<div class="col-md-6 col-12">' +
            '<select style="overflow:hidden" name="monitor[]" class="select2 form-select form-select ">' +
            '<option value="" disabled selected>Select Monitor</option>';

        // Loop through the monitors data and generate the option tags
        for (var i = 0; i < monitorsData.length; i++) {
            var monitor = monitorsData[i];
            if (!isMonitorSelected(monitor.id)) { // Check if the monitor is not selected before
                newSelect += '<option value="' + monitor.id + '">' + monitor.name + '</option>';
            }
        }

        newSelect += '</select>' +
            '</div>' +
            '<div class="col-md-2 col-12 m-0 pl-2">' +
            '<button class="btn btn-outline-danger text-nowrap px-1 waves-effect deleteMonitorBtn" type="button">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x me-25">' +
            '<line x1="18" y1="6" x2="6" y2="18"></line>' +
            '<line x1="6" y1="6" x2="18" y2="18"></line>' +
            '</svg>' +
            '<span>Delete</span>' +
            '</button>' +
            '</div>' +
            '</div>';

        $("#inputMonitorContainer").append(newSelect);
        toggleDeleteMonitorButton();
    });

    function isMonitorSelected(monitorId) {
        // Loop through the selected monitors to check if monitorId is present
        var selectedMonitors = [];
        $("#inputMonitorContainer select[name='monitor[]']").each(function () {
            var selectedValue = $(this).val();
            if (selectedValue !== '') {
                selectedMonitors.push(parseInt(selectedValue));
            }
        });
        return selectedMonitors.includes(monitorId);
    }

    $("#inputMonitorContainer").on("click", ".deleteMonitorBtn", function () {
        $(this).closest(".row").remove();
        toggleDeleteMonitorButton();
    });

    // Function to toggle delete button visibility
    function toggleDeleteMonitorButton() {
        var inputCount = $("#inputMonitorContainer .row").length;
        $(".deleteMonitorBtn").toggle(inputCount > 1);
    }

    // Initial toggle when the page loads
    toggleDeleteButton();
    toggleDeleteMonitorButton();

    let editDesktopForm = $('#editDesktopForm');
    if (editDesktopForm.length) {
        editDesktopForm.validate({
            rules: {
                desktopID: {
                    required: true,
                },
                desktopModel: {
                    required: true,
                },
                location: {
                    required: true,
                },
                processor: {
                    required: true,
                },
                ram: {
                    required: true,
                },
                OS: {
                    required: true,
                },
                gpu: {
                    required: true,
                },
                'storage[]': {
                    required: true,
                },
            },
        });
    }
});
