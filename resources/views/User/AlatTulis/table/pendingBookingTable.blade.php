<table id="alatanBookingTable" class="table">
    <thead>
        <th>ORDER ID</th>
        <th>Tarikh Pesanan</th>
        <th>Status</th>
    </thead>
    <tbody>

        @forelse ($data as $index => $booking)
            <tr>
                <td>
                    <a href="{{ route('AlatTulis.show', ['Booking' => Crypt::encryptString($booking->reference)]) }}">
                        {{ $booking->reference }}
                    </a>
                </td>
                <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('F j, Y H:i:s') }}</td>
                <td>
                    <span class="badge badge-light-primary">
                        {{ $booking->status->name }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td>Tiada Pesanan Pending</td>
            </tr>
        @endforelse

    </tbody>
</table>
