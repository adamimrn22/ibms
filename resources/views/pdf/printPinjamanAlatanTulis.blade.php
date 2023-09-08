<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            /* Adjust as needed for top/bottom margins */
        }

        /* Other styles for your content */
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .text-underline {
            text-decoration: underline;
        }

        th,
        th,
        td {
            border: none;
            padding: 0;
        }

        /* ... */
    </style>
</head>

<body>
    <table>
        <tr>
            <td align="right">
                <span style="border: 1px solid black; padding: 4pt;">
                    <b>
                        USSB / K06
                    </b>
                </span>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td align="left">
                <img src="{{ asset('img/ussblogo.png') }}" alt="" height="58pt">
            </td>

            <td style="vertical-align: bottom;">
                <h1 style="font-size: 12pt; margin-bottom: 0">BORANG PENGELUARAN BARANG DARI STOR</h1>
            </td>
        </tr>
    </table>

    <table style="margin-top: 15pt; border: 1px  solid black;">
        <thead style="font-size: 12pt; ">
        </thead>
    </table>

    <table style="margin-top: 16pt">
        <thead>
            <tr style="background-color: #cccccc">
                <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center" width="5%">
                    Bil
                </td>
                <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                    Nama Barang
                </td>
                <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center" width="5%">
                    Jumlah Diperlukan
                </td>
                <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center" width="5%">
                    Jumlah Diluluskan
                </td>
                <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                    Ulasan
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach ($booking->inventories as $index => $inventory)
                <tr>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                        {{ $index + 1 }}
                    </td>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                        {{ $inventory->name }}
                    </td>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center" width="5%">
                        {{ $inventory->pivot->quantity }}
                    </td>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center" width="5%">
                        {{ $inventory->pivot->approved_quantity }}
                    </td>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                        {{ $inventory->pivot->remarkNotes }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="font-size:10pt; text-align:left; margin:5pt; margin-bottom:0pt padding: 0">Maklumat Pemohon:</p>
    <table style=" border-top: none;">
        <tr>
            <td style="padding: 5px; vertical-align: top; width: 50%;">
                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: left; font-size:10pt" width="35%">Tandatangan</td>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:8pt;border-bottom-style: dotted;"> </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size:10pt" width="35%">Nama</td>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:9pt;border-bottom-style: dotted;">
                            {{ $booking->user->first_name . ' ' . $booking->user->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size:10pt" width="35%">Jawatan</td>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:9pt;border-bottom-style: dotted;">
                            {{ $booking->user->position->name }}
                        </td>
                    </tr>
                </table>
            </td>

            <td style="padding: 5px; vertical-align: top; width: 50%;">
                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: left; font-size:10pt" width="35%">Tarikh</td>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:9pt; border-bottom-style: dotted;">

                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size:10pt" width="35%">Bahagian</td>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:8pt; border-bottom-style: dotted;">
                            {{ $booking->user->unit->name }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; font-size:10pt" width="35%">No. Tel</td>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:9pt; border-bottom-style: dotted;">
                            {{ $booking->user->phone_number }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="margin-top: 15pt; border: 1px  solid black; padding: 0 10pt;">
        <thead style="font-size: 12pt; ">
        </thead>
    </table>

    <p style="font-size: 9pt; text-align:center; margin: 0; padding:0">PENGESAHAN KETUA UNIT/PUSAT/JABATAN</p>

    <table style=" border-top: none;">
        <tr>
            <td style="padding: 5px; vertical-align: top; width: 50%;">
                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: left; font-size:10pt" width="35%">
                            <p style="font-size: 9pt; text-align:left">Permohonan : <span
                                    class="{{ $booking->status_id == 2 ? 'text-underline' : '' }}">disokong</span> /
                                <span class="{{ $booking->status_id == 3 ? 'text-underline' : '' }}">
                                    tidak disokong
                                </span>
                                *
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style=" border-top: none;">
        <tr>
            <td style="padding: 5px; vertical-align: top; width: 50%;">
                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: left; font-size:10pt" width="35%">Tandatangan/Cop</td>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:8pt;border-bottom-style: dotted;"> </td>
                    </tr>
                </table>
            </td>
            <td style="padding: 5px; vertical-align: top; width: 50%;">
                <table style="width: 50%;" align="right">
                    <tr>
                        <td style="text-align: left; font-size:10pt" width="35%">Tarikh</td>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:8pt;border-bottom-style: dotted;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="margin-top: 15pt; border: 1px  solid black; padding: 0 10pt;">
        <thead style="font-size: 12pt; ">
        </thead>
    </table>
    <p style="font-size: 9pt; text-align:center; margin: 0; padding:0">
        PENGESAHAN BAHAGIAN KEWANGAN (BKW) <br>
        Telah membekalkan barang seperti diatas
    </p>

    <table style=" border-top: none;">
        <tr>
            <td style="padding: 5px; vertical-align: top; width: 50%;">
                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: left; font-size:10pt" width="30%">Tandatangan/Cop</td>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:8pt;border-bottom-style: dotted;"> </td>
                    </tr>
                </table>
            </td>
            <td style="padding: 5px; vertical-align: top; width: 50%;">
                <table style="width: 70%;" align="right">
                    <tr>
                        <td style="text-align: left; font-size:10pt" width="30%">Tarikh</td>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:8pt;border-bottom-style: dotted;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="margin-top: 15pt; border: 1px  solid black; padding: 0 10pt;">
        <thead style="font-size: 12pt; ">
        </thead>
    </table>
    <p style="font-size: 9pt; text-align:center; margin: 0; padding:0">
        PENGESAHAN PENERIMAAN BARANG <br>
        Telah menerima barang seperti diatas
    </p>

    <table style=" border-top: none;">
        <tr>
            <td style="padding: 5px; vertical-align: top; width: 50%;">
                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: left; font-size:10pt" width="35%">Tandatangan/Nama Staff</td>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:8pt;border-bottom-style: dotted;"> </td>
                    </tr>
                </table>
            </td>
            <td style="padding: 5px; vertical-align: top; width: 50%;">
                <table style="width: 50%;" align="right">
                    <tr>
                        <td style="text-align: left; font-size:10pt" width="35%">Tarikh</td>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:8pt;border-bottom-style: dotted;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


</body>

</html>
