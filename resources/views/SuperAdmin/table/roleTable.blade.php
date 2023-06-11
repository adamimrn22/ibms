<div id="userListRolesTable">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Staff ID</th>
                <th>Name</th>
                <th>Email</th>
                <th class="text-center">Role</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $user)
                <tr>
                    <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->index + 1 }}</td>
                    <td>
                        {{ $user->username }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td class="text-center">
                        @foreach ($user->roles as $role)
                            @if ($role['name'] === 'Super Admin')
                                <span class="badge rounded-pill badge-light-warning">{{ $role['name'] }}</span>
                            @elseif (str_contains($role['name'], 'Admin '))
                                <span class="badge rounded-pill badge-light-primary">{{ $role['name'] }}</span>
                            @else
                                <span class="badge rounded-pill badge-light-info">{{ $role['name'] }}</span>
                            @endif
                        @endforeach
                    </td>
                    <td class="text-center">
                        @if ($user->isActive == 1)
                            <span class="badge rounded-pill badge-glow bg-success"> Active</span>
                        @else
                            <span class="badge rounded-pill badge-glow bg-secondary"> Not Active</span>
                        @endif
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
