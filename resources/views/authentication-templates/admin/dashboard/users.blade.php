<x-header />

<x-dashboard.header />

<div class="fluid-container">
    <table class="table table-bordered text-center" id="users-table">
        <thead>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Last Seen</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr data-user-id="{{ $user->uuid }}">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td class="status">
                        <span class="status-wrapper">
                            <span class="status-dot {{ $user->is_online ? 'online' : 'offline' }}"></span>
                            <span class="tooltip-right">{{ $user->is_online ? 'Online' : 'Offline' }}</span>
                        </span>
                    </td>
                    <td>{{ $user->last_seen_at ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<x-footer />