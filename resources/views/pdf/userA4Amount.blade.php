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
            <td align="left">
                <img src="{{ asset('img/ussblogo.png') }}" alt="" height="58pt">
            </td>

            <td style="vertical-align: bottom;">
                <h1 style="font-size: 12pt; margin-bottom: 0">Jumlah Bilangan Pinjaman A4 Staff</h1>
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
                    Nama Staff
                </td>
                <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center" width="5%">
                    Nombor Staff
                </td>
                <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center" width="5%">
                    Unit Staff
                </td>
                <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                    Jawatan Staff
                </td>
                <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                    Jumlah Sekarang
                </td>
                <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                    Jumlah Tetap
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach ($amounts as $index => $amount)
                <tr>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                        {{ $index + 1 }}
                    </td>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                        {{ $amount->user->first_name . ' ' . $amount->user->last_name }}
                    </td>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                        {{ $amount->user->username }}
                    </td>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                        {{ $amount->user->unit->name }}
                    </td>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                        {{ $amount->user->position->name }}
                    </td>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center" width="5%">
                        {{ $amount->amount }}
                    </td>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center" width="5%">
                        {{ $amount->default_amount }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
