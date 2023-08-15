<div id="stationeryTable">
    <table class="table">
        <thead>
            <tr>
                <th width="15%">No.</th>
                <th width="60%">Name</th>
                <th width="25%"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $paper)
                <tr>
                    <td width="15%">
                        {{ $data->firstItem() + $index }}
                    </td>
                    <td width="60%">
                        {{ strtoupper($paper->name) }}
                    </td>
                    <td width="25%">
                        <button class="btn btn-sm btn-primary btn-book" data-item-id="{{ $paper->id }}">
                            Add To Cart
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td align="center" width="100%">
                        Tiada Alat Tulis dijumpai
                    </td>

                </tr>
            @endforelse

        </tbody>
    </table>

</div>
