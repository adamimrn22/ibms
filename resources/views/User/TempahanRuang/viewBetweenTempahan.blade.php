<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .td-bg {
            background-color: turquoise;
        }

        td,
        th {
            padding: 15px;
            white-space: nowrap;
            text-align: center;
            vertical-align: center;
        }

        th {
            background-color: #cccccc;
        }

        .outer-table {
            margin: 5px;
            overflow: auto;
        }
    </style>
</head>

<body>
    <div class="outer-table">
        @php
            $maxColumns = 7;
            $columnCount = 0;
            $tableStarted = false;
        @endphp

        @foreach ($rooms as $index => $room)
            @if ($columnCount === 0)
                @if ($tableStarted)
                    </tbody>
                    </table>
                    <br><br>
                @endif

                <table border="1" style="margin-bottom: 25px">
                    <thead>
                        <tr>
                            <th>Nama Ruang</th>
                            @foreach ($uniqueDates as $date)
                                <th>{{ \Carbon\Carbon::parse($date)->isoFormat('dddd, MMMM DD, YYYY') }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $tableStarted = true;
                        @endphp
            @endif

            <tr>
                <td style="background-color:azure">{{ $room->name }}</td>
                @foreach ($uniqueDates as $date)
                    <td>
                        @foreach ($bookings as $booking)
                            @if ($booking->room->name === $room->name && $booking->date_book === $date)
                                <div>
                                    {{ \Carbon\Carbon::parse($booking->time_start)->translatedFormat('g:i A') }}
                                    -
                                    {{ \Carbon\Carbon::parse($booking->time_end)->translatedFormat('g:i A') }}
                                </div>
                                <br>
                            @endif
                        @endforeach
                    </td>
                @endforeach
            </tr>

            @php
                $columnCount++;
                if ($columnCount >= $maxColumns) {
                    $columnCount = 0;
                    // echo '<p style="page-break-after: always"></p>';
                }
            @endphp
        @endforeach

        @if ($tableStarted)
            </tbody>
            </table>
        @endif

    </div>
</body>

</html>
