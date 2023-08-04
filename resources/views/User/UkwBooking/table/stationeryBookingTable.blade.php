<div id="stationeryTable">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th rowspan="4">Name</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $paper)
                <tr>
                    <td>
                        {{ $data->firstItem() + $index }}
                    </td>
                    <td>
                        {{ strtoupper($paper->name) }}
                    </td>

                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button class="btn btn-sm btn-primary btn-book" data-item-id="{{ $paper->id }}">
                            Add To Cart
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        No Current Item
                    </td>

                </tr>
            @endforelse

        </tbody>
    </table>

</div>