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
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td>
                            {{ $index + 1 }}
                        </td>
                        <td>
                            <input type="hidden" class="form-control" name="user[]" value="{{ $user->user_id }}">
                            {{ $user->user->username }}
                        </td>
                        <td>
                            {{ $user->user->first_name . ' ' . $user->user->last_name }}
                        </td>
                        <td>
                            {{ $user->user->unit->name }}
                        </td>
                        <td width="10%">
                            <input type="text" class="form-control" name="amount[]" value="{{ $user->amount }}">
                        </td>
                        <td width="10%">
                            <input type="text" class="form-control" name="default_amount[]"
                                value="{{ $user->default_amount }}">
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>
                            No Data
                        </td>

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
