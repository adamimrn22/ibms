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
            <td align="center">
                <img src="{{ asset('img/ussblogo.png') }}" alt="" height="48pt">
            </td>

            <td align="right">
                <span style="border: 1px solid black; padding: 4pt;">
                    <b>
                        USSB / UPSM05
                    </b>
                </span>
            </td>
        </tr>
    </table>
    <table style="margin-top: 15pt; border: 1px  solid black;">
        <thead style="background-color: #cccccc; font-size: 12pt; ">
            <th style="padding: 10pt;">PERMOHONAN MENGGUNA KENDERAAN JABATAN / PEMANDU</th>
        </thead>
    </table>
    <table style="border: 1px  solid black; border-top: none;">
        <tr>
            <td style="font-size: 9pt; padding: 5pt;">
                Permohonan menggunakan kenderaan jabatan sebelum / semasa / selepas waktu pejabat hendaklah mengisi
                butir-butir di ruangan yang telah dikhaskan dalam borang ini.
                <ol>
                    <li>
                        Permohonan mestilah diserahkan ke Unit Pentadbiran, Bhg. Pengurusan selewat-lewatnya 24 JAM
                        sebelum tarikh penggunaan.
                    </li>
                    <li>
                        Semua permohonan HENDAKLAH diluluskan melalui Ketua Jabatan / Ketua Bahagian / Ketua Unit.
                    </li>
                    <li>
                        Permohonan akan dipertimbangkan tertakluk kepada kekosongan kenderaan dan juga pemandu.
                    </li>
                </ol>
            </td>
        </tr>
    </table>
    @php
        use Carbon\Carbon;
    @endphp
    <table style="border: 1px  solid black; border-top: none;">
        <tr>
            <td style="padding: 5pt; border-right: none; font-size: 10pt;"><b>TARIKH GUNA</b></td>
            <td style="border-left: none; border-right: none; padding: 5pt;">
                <p style="font-size: 8pt; margin: 2pt 0; padding: 0; font-size: 10pt;">(Pergi)</p>
                <p style="font-size: 11pt; margin: 0; padding-top: 5pt; font-size: 10pt;">
                    <b>
                        {{ Carbon::parse($booking->dateGo)->format('d F Y') }}
                    </b>
                </p>
            </td>
            <td style="padding: 3pt; border-left: none; border-right: none; font-size: 10pt;">
                <b>HINGGA</b>
            </td>
            <td style="border-left: none; border-right: none; padding: 5pt;" align="">
                <p style="font-size: 8pt; margin: 2pt 0; padding: 0;">(Balik)</p>
                <p style="font-size: 11pt; margin: 0; padding-top: 5pt; font-size: 10pt;">
                    <b>
                        {{ Carbon::parse($booking->Return)->format('d F Y') }}
                    </b>
                </p>
            </td>
            <td style="padding: 5pt; border-left: 1px solid black;">
                <div>
                    <table align="end" style=" border-collapse: collapse;  padding: 0;">
                        <thead>
                            <tr>
                                <td style="border: 1px solid black; padding: 5pt; font-size:9pt">KERETA</td>
                                <td style="border: 1px solid black; padding: 5pt; font-size:9pt">BAS</td>
                                <td style="border: 1px solid black; padding: 5pt; font-size:9pt">PEMANDU</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($booking->vehicle_type === 1)
                                <td style="border: 1px solid black; padding: 5pt; text-align: center;">/</td>
                                <td style="border: 1px solid black; padding: 5pt; text-align: center;"></td>
                            @elseif ($booking->vehicle_type === 0)
                                <td style="border: 1px solid black; padding: 5pt; text-align: center;">/e</td>
                                <td style="border: 1px solid black; padding: 5pt; text-align: center;"></td>
                            @endif
                            @if ($booking->driver)
                                <td style="border: 1px solid black; padding: 5pt; text-align: center;">/</td>
                            @else
                                <td style="border: 1px solid black; padding: 5pt; text-align: center;"></td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <table style="border: 1px  solid black; border-top: none; border-bottom: none;">
        <tr>
            <td style="padding: 5pt; border: 1px  solid black; border-top: none;" width="15%">
                <p style="padding: 0; margin: 0; font-size: 10pt;">
                    <b>DESTINASI</b>
                </p>
                <p style="padding: 0; margin: 3pt 0; font-size: 10pt;">{{ $booking->destination }}</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 5pt; border-right: none;" width="15%">
                <p style="padding: 0; margin: 0;">
                    <b style="font-size: 10pt;">TUJUAN</b>
                    <span style="display: block; font-size: 8pt;">(Lampirkan Surat Arahan)</span>
                </p>
                <p style="padding: 0; margin: 4pt 0; font-size: 10pt;">{{ $booking->objective }}</p>
            </td>
        </tr>
    </table>
    <table style="border: 1px  solid black; ">
        <thead style="background-color: #cccccc; font-size: 12pt; ">
            <th style="padding: 10pt;">PERAKUAN PEMOHON</th>
        </thead>
    </table>
    <table style="border: 1px  solid black; border-top: none; border-bottom: none;">
        <tr>
            <td style="padding: 5pt; font-size: 10pt;">
                Saya akui bahawa butir-butir yang dinyatakan di atas adalah benar dan memperakui bahawa perjalanan di
                atas adalah untuk tujuan rasmi dan bertanggungjawab sepenuhnya terhadap perjalanan tersebut.
            </td>
        </tr>
    </table>

    <table
        style="width: 100%; border-collapse: collapse;  border: 1px solid black; border-top:none; border-bottom:none">
        <tr>
            <td style="padding: 5px;vertical-align: top;">
                <table style="width: 100%;">
                    <tr>
                        <th style="text-align: left; font-size:10pt" width="30%">TANDATANGAN</th>
                        <td width="5%">:</td>
                    </tr>
                    <tr>
                        <th style="text-align: left; font-size:10pt" width="30%">NAMA / COP</th>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:10pt">
                            {{ $booking->staff[0]->first_name . ' ' . $booking->staff[0]->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: left; font-size:10pt" width="30%">JAWATAN</th>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:10pt">
                            {{ $booking->staff[0]->position->name }}
                        </td>
                    </tr>
                </table>
            </td>
            <td style="padding: 5px; vertical-align: top;">
                <table style="width: 100%;">
                    <tr>
                        <th style="text-align: left; font-size:10pt" width="30%">UNIT</th>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:10pt">
                            {{ $booking->staff[0]->unit->name }}
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: left; font-size:10pt" width="30%">NO TELEFON</th>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:10pt">
                            {{ $booking->staff[0]->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: left; font-size:10pt" width="30%">TARKH</th>
                        <td width="5%">:</td>
                        <td style="text-align: left; font-size:10pt">
                            {{ Carbon::parse($booking->updated_at)->format('d F Y') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="border: 1px  solid black; ">
        <thead style="background-color: #cccccc; font-size: 12pt; ">
            <th style="padding: 10pt;">UNTUK KEGUNAAN UNIT PENTADBIRAN </th>
        </thead>
    </table>

    <table style="border: 1px solid black; border-top: none;">
        <tr style="border: 1px solid black; border-top: none;">
            <td style="text-align: left; font-size:10pt; padding:5pt" width="40%">
                Permohonan menggunakan kenderaan / pemandu Jabatan
                <div style="margin: 15pt; disply:inline">
                    <input type="checkbox" {{ $booking->status_id === 2 ? 'checked' : '' }}>
                    <label>Lulus</label>
                    <input type="checkbox" {{ $booking->status_id === 3 ? 'checked' : '' }}>
                    <label>Tidak Lulus</label>
                </div>
            </td>
            <td style="text-align: left; font-size:10pt; padding:5pt" width="60%">
                Ulasan
                <p>
                    {{ $booking->remark }}
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding: 5px; vertical-align: top; width: 70%;">
                <table style="width: 100%;">
                    <tr>
                        <th style="text-align: left; font-size:10pt" width="45%">TANDATANGAN</th>
                        <td>:</td>
                    </tr>
                    <tr>
                        <th style="text-align: left; font-size:10pt" width="35%">NAMA / COP</th>
                        <td>:</td>
                    </tr>
                    <tr>
                        <th style="text-align: left; font-size:10pt" width="35%">JAWATAN</th>
                        <td>:</td>
                    </tr>
                </table>
                <p style="text-align: left; font-size:8pt">Nota : Pengguna <br> ./ Sila berada di Kenderaan pada waktu
                    yang
                    dimohon
                    <br> ./ Hubungi pemandu jika ada sebarang perubahan masa
                    <br>./ Perjalanan kenderaan adalah seperti yang dipohon sahaja
                </p>
            </td>
            <td style="padding: 5px; vertical-align: top; width: 30%;">
                <table style="border-collapse: collapse;  ">
                    <thead>
                        <tr>
                            <td style="border: 1px solid black; padding: 5pt; font-size:8pt">Bil</td>
                            <td style="border: 1px solid black; padding: 5pt; font-size:8pt">Nama Pemandu</td>
                            <td style="border: 1px solid black; padding: 5pt; font-size:8pt">No HP</td>
                            <td style="border: 1px solid black; padding: 5pt; font-size:8pt">No Kenderaan</td>
                        </tr>
                    </thead>
                    <tbody>
                        <td style="border: 1px solid black; padding: 5pt; text-align: center; font-size:8pt">1</td>
                        <td style="border: 1px solid black; padding: 5pt; text-align: center; font-size:8pt;">
                            <span>{{ $booking->driverBooking->first_name . ' ' . $booking->driverBooking->last_name }}
                            </span>
                        </td>
                        <td style="border: 1px solid black; padding: 5pt; text-align: center; font-size:8pt">
                            {{ $booking->driverBooking->phone_number }}
                        </td>
                        <td style="border: 1px solid black; padding: 5pt; text-align: center; font-size:8pt">
                            {{ $booking->vehicle->plateNumber }}
                        </td>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <p style="page-break-before: always">
    <table style="margin-bottom: 15pt">
        <tr>
            <td>
                <p style="text-align:start">
                    <b>
                        LAMPIRAN A <br>
                        SENARAI NAMA PENGGUNA/PENUMPANG KENDERAAN SYARIKAT
                    </b>
                </p>
            </td>
        </tr>
    </table>

    <table style="margin-top: 25pt">
        <tr>
            <td align="center">
                <img src="{{ asset('img/ussblogo.png') }}" alt="" height="48pt">
            </td>

            <td align="right">
                <span style="border: 1px solid black; padding: 4pt;">
                    <b>
                        USSB / UPSM05
                    </b>
                </span>
            </td>
        </tr>
    </table>

    <table style="margin-top: 25pt">
        <tr>
            <td style="padding: 5px;">
                <table style="width: 100%;">
                    <tr>
                        <th style="text-align: left; font-size:12pt" width="20%">TARIKH</th>
                        <td width="2%">:</td>
                        <td style="text-align: justify: ">
                            <p style="margin: 0; padding: 0; font-size:10pt">
                                {{ Carbon::parse($booking->dateGo)->format('d F Y') }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th style="text-align: left; font-size:12pt" width="20%">TUJUAN</th>
                        <td width="2%">:</td>
                        <td style="text-align: justify: ">
                            <p style="margin: 0; padding: 0; font-size:10pt">
                                {{ $booking->objective }}
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

    <table style="margin-top: 16pt">
        <thead>
            <tr>
                <th style="border: 1px solid black; padding: 5pt;">BIL</th>
                <th style="border: 1px solid black; padding: 5pt;">NAMA</th>
                <th style="border: 1px solid black; padding: 5pt;">JAWATAN</th>
                <th style="border: 1px solid black; padding: 5pt;">UNIT</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($booking->staff as $index => $staff)
                <tr>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                        {{ $index + 1 }}
                    </td>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                        {{ $staff->first_name . ' ' . $staff->last_name }}
                    </td>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt; text-align:center">
                        {{ $staff->position->name }}
                    </td>
                    <td style="border: 1px solid black; padding: 5pt; font-size:10pt;  text-align:center">
                        {{ $staff->unit->name }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
