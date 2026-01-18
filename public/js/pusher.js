// Enable pusher logging - don't include this in production
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

Pusher.logToConsole = true;

var pusher = new Pusher('3b71b09569a6ec10686e', {
  cluster: 'ap2',
  forceTLS: true,
  authEndpoint: '/broadcasting/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    }
});

let channel = pusher.subscribe('users');
channel.bind('pusher:subscription_succeeded', function(members) {
    console.log('you have now active session of members : ', members); // includes all users online
});

channel.bind('pusher:member_added', function (member) {
    console.log('User online:', member.info);
    alert('member',member.info)
    // updateUserStatus(member.info.id, true);
});

// channel.bind('pusher:member_removed', function (member) {
//     console.log('User offline:', member.info);
//     alert('member',member.info)
//     // updateUserStatus(member.info.id, false);
// });


// function updateUserStatus(userId, isOnline) {
//     let badge = document.getElementById(`status-${userId}`);

//     if (!badge) return;

//     badge.textContent = isOnline ? 'Online' : 'Offline';
//     badge.className = isOnline ? 'badge bg-success' : 'badge bg-danger';
// }

// function syncPresence(userId, isOnline) {
//     fetch('/presence/sync', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': csrfToken
//         },
//         body: JSON.stringify({
//             user_id: userId,
//             is_online: isOnline
//         })
//     });
// }

