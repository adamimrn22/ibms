<div style="overflow: auto">
    <table class="table table-striped" id="ruangTempahTable">
        <thead>
            <tr>
                <th>Bil</th>
                <th>ID Tempahan</th>
                <th>Tujuan</th>
                <th>Bilik</th>
                <th>Tarikh Tempah</th>
                <th class="text-center">Waktu Mula</th>
                <th class="text-center">Waktu Akhir</th>
                <th class=" text-center">Status</th>
            </tr>
        </thead>
        @php
            Carbon\Carbon::setLocale('ms');
        @endphp
        <tbody>
            @forelse ($data as $index => $booking)
                <tr>
                    <td> {{ $data->firstItem() + $index }}</td>
                    <td>
                        <span class="fw-bold">{{ $booking->reference }}</span>
                    </td>
                    <td>{{ $booking->detail->objective }}</td>
                    <td>{{ $booking->room->name }}</td>
                    <td>
                        {{ Carbon\Carbon::parse($booking->date_book)->isoFormat('dddd, MMMM DD, YYYY') }}
                    </td>
                    <td class="text-center">
                        {{ strtoupper(Carbon\Carbon::parse($booking->time_start)->translatedFormat('g:i A')) }}</td>
                    <td class="text-center">
                        {{ strtoupper(Carbon\Carbon::parse($booking->time_end)->translatedFormat('g:i A')) }}</td>

                    <td class="text-center">
                        <span
                            class="badge rounded-pill
                            {{ $booking->status_id === 2 ? 'bg-primary' : ($booking->status_id === 3 ? 'bg-danger' : ($booking->status_id === 1 ? 'bg-dark' : '')) }}">
                            {{ $booking->status->name }}
                        </span>
                    </td>

                </tr>
            @empty
                <tr>
                    <td>Tiada tempahan ruang dibuat</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
