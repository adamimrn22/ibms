$(document).ready(function () {
    let permohonanKereta = $('#permohonanKereta');
    if (permohonanKereta.length) {
        permohonanKereta.validate({
            rules: {
                'dateGo': {
                    required: true,
                },
                'dateReturn': {
                    required: true,
                },
                timeGo: {
                    required: true,
                },
                timeReturn: {
                    required: true,
                },
                destination: {
                    required: true,
                },
                objective: {
                    required: true,
                },
                vehicle: {
                    required: true,
                },
            },
            messages: {
                dateGO: {
                    required: "Sila masukkan tarikh pergi.",
                },
                dateReturn: {
                    required: "Sila masukkan tarikh balik.",
                },
                timeGo: {
                    required: "Sila masukkan tarikh pergerakan.",
                },
                timeReturn: {
                    required: "Sila masukkan tarikh pergerakan balik.",
                },
                destination: {
                    required: "Sila masukkan destinasi anda.",
                },
                objective: {
                    required: "Sila masukkan tujuan destinasi anda.",
                },
                vehicle: {
                    required: "Sila pilih jenis kenderaan.",
                },
            },
        });
    }
});
