@forelse ($users as $index => $user)
    <tr>
        <td>
            {{ $index + 1 }}
        </td>
        <td>
            <input type="hidden" class="form-control" name="user[{{ $user->id }}]" value="{{ $user->id }}">
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
                <input type="text" class="form-control" name="amount[{{ $user->id }}]" value="0">
            </td>
            <td width="10%">
                <input type="text" class="form-control" name="default_amount[{{ $user->id }}]"
                    value="{{ $user->last_month_default_amount ?? 0 }}">
            </td>
            <td class="text-warning">Amount staff tidak dimasukkan pada bulan ini</td>
        @else
            <td width="10%">
                <input type="number" class="form-control" name="amount[{{ $user->id }}]"
                    value="{{ $user->amount }}">
            </td>
            <td width="10%">
                <input type="number" class="form-control" name="default_amount[{{ $user->id }}]"
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
