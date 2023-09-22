<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jadual Ruang Tempahan</title>
    <!-- Include FullCalendar CSS and JavaScript -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.css" rel="stylesheet">
    <style>
        * {
            white-space: normal;
            overflow-wrap: break-word;
            font-family: 'Roboto', sans-serif;
        }

        .selectRoom {
            display: flex;
            flex-direction: row;
            margin-bottom: 15px;
        }

        :root {
            --fc-border-color: #2C3E50;
            --fc-daygrid-event-dot-width: 5px;
        }

        .fc-scroller {
            overflow: hidden !important;
        }


        .fc-day-header {
            font-size: 30px;
            /* Change this value to your desired font size */
        }

        .fc-event {
            font-size: 14px;
            padding: 5px;
            margin: 5px;
            background-color: #2C3E50;
            color: #fff;
        }
    </style>
</head>

<body>

    <form method="get" action="/jadualRuang">
        @csrf
        <div class="selectRoom">
            <select class="form-select" id="roomTypeFilter" name="room_type">
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}|{{ $room->name }}"
                        {{ $room->id == $roomSelectedID ? 'selected' : '' }}>{{ $room->name }}</option>
                @endforeach
            </select>
            <div class="ms-1">
                <button class="btn btn-outline-primary waves-effect" type="submit">
                    Lihat Jadual
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" height="12">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </button>
            </div>
        </div>
    </form>

    <h1 style="text-align: center; margin: 0; padding-top:0">Jadual Bilik: {{ $roomName }} </h1>

    <div id="calendar"></div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                contentHeight: "auto",
                initialView: 'dayGridMonth',
                initialDate: '{{ $dateFromRange ?? '' }}',
                validRange: {
                    start: '{{ $dateFromRange ?? '' }}',
                    end: '{{ $dateToRange ?? '' }}'
                },
                headerToolbar: {
                    start: 'dayGridMonth,timeGridWeek,timeGridDay',
                    center: 'title',
                    end: 'today,prev,next'
                },
                themeSystem: 'bootstrap5',
                events: [
                    @foreach ($bookData as $book)
                        {
                            title: '{{ $book->detail->objective }}',
                            start: '{{ $book->date_book_start }}T{{ $book->time_start }}', // Combine date and time
                            end: '{{ $book->date_book_end }}T{{ $book->time_end }}', // Combine date and time
                            customTitle: '{{ $book->room->name }}',

                        },
                    @endforeach
                ],
                eventColor: '#2C3E50',
                eventContent: function(info) {
                    var customTitle = info.event.extendedProps.customTitle;
                    return {
                        html: '<div class="fc-title">' + info.event.title + '<br>' + customTitle +
                            '</div>',
                    };
                },
            });
            calendar.render();
        });
    </script>
</body>

</html>
