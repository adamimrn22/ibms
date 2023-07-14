$(document).ready(function () {
    $("#addStorageBtn").click(function () {
        var newInput =
            '<div class="row d-flex align-items-center mb-1">' +
            '<div class="col-md-6 col-12">' +
            '<input type="text" class="form-control" name="storage[]" placeholder="HDD SEAGATE 1TB">' +
            '</div>' +
            '<div class="col-md-2 col-12 m-0 pl-2">' +
            '<button class="btn me-1 waves-effect btn-outline-danger text-nowrap deleteStorageBtn" type="button">' +
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

    // Initial toggle when the page loads
    toggleDeleteButton();

    let createLaptopForm = $('#createLaptopForm');

    $.validator.addMethod('stepMultiple', function (value, element, param) {
        if (this.optional(element)) {
            return true;
        }

        var num = parseFloat(value);
        return /^\d+(\.\d{2})?$/.test(value) && num % param === 0;
    }, 'Please enter a price with a decimal of two eg: 100.20 .');

    if (createLaptopForm.length) {
        createLaptopForm.validate({
            rules: {
                laptopID: {
                    required: true,
                },
                laptopBrand: {
                    required: true,
                },
                laptopModel: {
                    required: true,
                },
                price: {
                    stepMultiple: 0.01
                },
                location: {
                    required: true,
                },
                display: {
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
                DOP: {
                    required: true,
                },
            },
        });
    }
});
