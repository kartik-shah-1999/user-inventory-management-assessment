import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const syncUserData = {
            'id' : null,
            'is_online' : 0,
            'last_seen_at': null,
            'role' : null
        }

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '3b71b09569a6ec10686e',
    cluster: 'ap2',
    forceTLS: true,
    encrypted: true,
});

window.Echo.join('users')
    .here((users) => {
        console.log('Users currently online:', users);
        users.forEach((user) => {
            setUserOnline(user.user.id);
            syncUserData.id = user.user.id,
            syncUserData.is_online = 1
            syncUserData.role = user.role
            syncUserStatus('PUT', '/syncUserStatus', syncUserData)
        });
    })
    .joining((user) => {
        console.log('User joined:', user);
        setUserOnline(user.user.id);
        syncUserStatus('PUT', '/syncUserStatus', syncUserData)
    })
    .leaving((user) => {
        console.log('User left:', user);
        setUserOffline(user.user.id);
        syncUserData.id = user.user.id,
        syncUserData.is_online = 0,
        syncUserData.role = user.role
        syncUserStatus('PUT', '/syncUserStatus', syncUserData);
    })
    .error((e) => {
        console.log('Users online event:', e);
    });

    function setUserOnline(userId) {
        const row = document.querySelector(`tr[data-user-id="${userId}"]`);
        if (!row) return;
        row.querySelector('.status').innerHTML =
            `<span class="status-wrapper">
                <span class="status-dot online"></span>
                <span class="tooltip-right">Online</span>
            </span>
            `;
    }

    function setUserOffline(userId) {
        const row = document.querySelector(`tr[data-user-id="${userId}"]`);
        if (!row) return;
        row.querySelector('.status').innerHTML =
            `<span class="status-wrapper">
                <span class="status-dot offline"></span>
                <span class="tooltip-right">Offline</span>
            </span>
            `;
    }

    const syncUserStatus = (method, url, data) => {
        $.ajax({
            type: method,
            url: url,
            data: data,
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                console.log('status updated successfully:', response)
            },
            error: (response) => {
                console.error('error updating status', response.error)
            }
        });
    }