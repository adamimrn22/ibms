<form action="{{ route('ukw.Amount.store') }}" method="POST">
    @csrf
    <div style="height: 400px; overflow: auto;">

        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Staff ID</th>
                    <th>Staff Name</th>
                    <th width="10%">Unit</th>
                    <th class="text-center">Current Amount</th>
                    <th class="text-center">Default Amount</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td>
                            {{ $index + 1 }}
                        </td>
                        <td>
                            <input type="hidden" class="form-control" name="user[]" value="{{ $user->id }}">
                            {{ $user->username }}
                        </td>
                        <td>
                            {{ $user->first_name . ' ' . $user->last_name }}
                        </td>
                        <td>
                            {{ $user->unit->name }}
                        </td>
                        @if ($user->amount === null)
                            <td width="10%">
                                <input type="text" class="form-control" name="amount[]" value="0">
                            </td>
                            <td width="10%">
                                <input type="text" class="form-control" name="default_amount[]"
                                    value="{{ $user->last_month_default_amount ?? 0 }}">
                            </td>
                            <td class="text-warning">Amount staff tidak dimasukkan pada bulan ini</td>
                        @else
                            <td width="10%">
                                <input type="text" class="form-control" name="amount[]" value="{{ $user->amount }}">
                            </td>
                            <td width="10%">
                                <input type="text" class="form-control" name="default_amount[]"
                                    value="{{ $user->default_amount }}">
                            </td>
                            <td></td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No Data</td>
                    </tr>
                @endforelse
            </tbody>


        </table>
    </div>
    <div class="m-1 d-flex justify-content-end">
        <button class="btn btn-outline-primary btn-sm " name="update" value="0">Update Amount Pensyarah</button>
        <button class="btn btn-primary btn-sm ms-1" name="update" value="1">Update Other Unit</button>
    </div>
</form>
