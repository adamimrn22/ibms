<div id="permissionTable">
    <table class="table">
        <thead>
            <tr>
                <th>Permission Name</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $permission)
                <tr>
                    <td>
                        {{ $permission->name }}
                    </td>
                    <td>
                        {{ $permission->created_at }}
                    </td>
                    <td>
                        {{ $permission->updated_at }}
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
