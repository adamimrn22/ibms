<div id="paperTable">
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
                    <td width="15%">
                        {{ $data->firstItem() + $index }}
                    </td>
                    <td width="60%">
                        <button type="button" class="btn btn-outline-primary waves-effect btn-show-image"
                            data-bs-toggle="modal" data-bs-target="#imageModal" data-item-id="{{ $paper->id }}">
                            {{ strtoupper($paper->name) }}
                        </button>
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
