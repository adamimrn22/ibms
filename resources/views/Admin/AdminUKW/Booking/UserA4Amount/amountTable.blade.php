<form id="updateStaffAmount" action="{{ route('ukw.Amount.store') }}" method="POST">
    @csrf

    <table id="amountUserTable" class="table">
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
        <tbody id="amountUserTableBody">
            @include('Admin.AdminUKW.Booking.UserA4Amount.amount-table-body')
        </tbody>
    </table>
    <div class="  d-flex justify-content-end">
        <button class="btn btn-primary btn-sm ms-1" name="update" value="1">Update Staff Amount</button>
    </div>
</form>
