<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #F3F4F6;
            font-family: 'Open Sans', sans-serif;
        }

        .text-gray {
            color: #727580;
        }

        .containerSpacer {
            background: #7772F0;
            padding: auto;
        }

        .title-header {
            font-weight: 800;
            color: #7772F0;
        }

        .font-normal {
            font-weight: 400;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
        }

        .btn-primary {
            background-color: #7772F0;
        }

        .btn-primary:hover {
            background-color: #605bc2;
        }

        hr {
            margin: 0.25rem 0;
            border: solid 1px #7772F0;
        }

        .my-1 {
            margin: 1rem 0;
        }

        .mb-1 {
            margin-bottom: 1rem;
        }

        .background-card {
            background-color: white;
            margin: 1rem;
            box-shadow: 0px 10px 24px 4px rgba(0, 0, 0, 0.1);
            -webkit-box-shadow: 0px 10px 24px 4px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0px 10px 24px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .section {
            padding: 1rem;
        }

        .thin-line {
            height: 1px;
            background-color: #727580;
            margin: 10px 0;
        }

        /* Style the horizontal line */
        .line {
            width: 50px;
            height: 2px;
            background-color: #727580;
            display: inline-block;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="background-card">
        <table align="center" style="border-radius: 5px 5px 0 0;" height="100" width="100%" class="containerSpacer">
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>

        <div class="section">

            <table width="100%">
                <tr align="center">
                    <td>
                        <h1 class="title-header">
                            IBMS
                        </h1>
                    </td>
                </tr>
            </table>
            <hr>
            <table width="100%">
                <tr align="left">
                    <td>
                        <h2 class="font-normal text-gray my-1">
                            <b>
                                Terdapat Pesanan Baharu!
                            </b>
                        </h2>
                    </td>
                </tr>
            </table>

            <table class="my-1 text-gray">
                <tr>
                    <td>Kepada, ADMIN UKW</td>
                </tr>
            </table>
            <table style="margin-bottom: 1.5rem;" width="100%">
                <tr class="text-gray">
                    <td>
                        Terdapat pesanan baharu yang dibuat oleh staff. <br> Berikut adalah beberapa maklumat mengenai
                        pesanan tersebut
                    </td>
                </tr>
            </table>

            <table width="100%" class="my-1">
                <tr align="left">
                    <td class="text-gray">
                        <span>
                            ORDER:
                            <b>
                                {{ $orderID }}
                            </b>
                        </span>
                    </td>

                </tr>
                <tr align="left">
                    <td class="text-gray">
                        <b>
                            {{ $date }}
                        </b>
                    </td>
                </tr>
                <tr align="left">
                    <td class="text-gray">
                        STAFF ID: <b>{{ $user->username }}</b>
                    </td>
                </tr>
                <tr align="left">
                    <td class="text-gray">
                        NAMA STAFF: <b>{{ $user->first_name . ' ' . $user->last_name }}</b>
                    </td>
                </tr>
                <tr align="left">
                    <td class="text-gray">
                        UNIT: <b>{{ $user->unit->name }}</b>
                    </td>
                </tr>
                <tr align="left">
                    <td class="text-gray">
                        JAWATAN: <b>{{ $user->position->name }}</b>
                    </td>
                </tr>
            </table>

            <table border="1" cellspacing="0" width="100%"
                style="border-collapse: collapse; border: 2px solid gray;">
                <thead>
                    <tr>
                        <th style="padding: 8px; text-align: left; color: #727580;">PESANAN BARANG</th>
                        <th style="padding: 8px; text-align: left; color: #727580;">KUANTITI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td style="padding: 8px; text-align: left; color: #727580;">
                                {{ $booking->inventory->name }}
                            </td>
                            <td style="padding: 8px; text-align: left; color: #727580;">
                                {{ $booking->quantity }}x
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <p style="text-align: end;" class="text-gray my-1">Jumlah Keseluruhan:
                <span> {{ $totalQuantity }} </span>
            </p>


            <table width="100%">
                <tr>
                    <td align="right">
                        <a href="{{ route('ukw.BookingAlatTulis.edit', ['BookingAlatTuli' => Crypt::encryptString($bookings[0]->reference)]) }}"
                            class="btn btn-primary">
                            EDIT PERMOHONAN
                        </a>
                    </td>
                </tr>
            </table>

            <table class="my-1 text-gray">
                <tr>
                    <td>Daripada,</td>
                </tr>
                <tr>
                    <td>IBMS Support</td>
                </tr>
            </table>

            <div class="thin-line"></div>
            <table width="100%">
                <tr>
                    <p class="text-gray" style="font-size: 0.75rem; text-align: center;">
                        Anda menerima e-mel ini kerana anda telah membuat pesanan. Mohon untuk tidak membalas e-mel
                        ini kerana
                        ia
                        adalah e-mel automatik. Sekiranya anda tidak membuat pesanan, sila hubungi pentadbir.
                    </p>
                </tr>
            </table>

            <table width="100%">
                <tr align="center">
                    <p class="text-gray my-1" style="font-size: 0.75rem; text-align: center;">
                        KOLEJSPACE | IBMS
                    </p>
                </tr>
            </table>

        </div>

        <table align="center" style="border-radius: 0 0 5px 5px;" height="100" width="100%" class="containerSpacer">
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>

    </div>


</body>

</html>
