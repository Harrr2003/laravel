let notificationsBtn = document.getElementById('notificationsBtn');


notificationsBtn.addEventListener('click', () => {
    fetch('/notifications')
        .then(response => response.json())
        .then(notifications => {
            fetch('/notificationsLike')
                .then(response => response.json())
                .then(notificationsLike => {
                    if (notifications.requests.length > 0 || notificationsLike.requests.length > 0) {
                        let notificationsModal = createNotificationsModal(notifications, notificationsLike, notifications.my_id);

                        body.appendChild(notificationsModal);


                        notificationsModal.addEventListener('click', (event) => {
                            if (event.target === notificationsModal) {
                                notificationsModal.remove();
                            }
                        });
                    } else {

                        console.log('No notifications available');

                    }
                })
                .catch(error => {
                    console.error('Error fetching likes notifications:', error);
                });
        })
        .catch(error => {
            console.error('Error fetching follow requests notifications:', error);
        });
});

function createNotificationsModal(notifications, notificationsLike, my_id) {
    let notificationsModal = document.createElement('div');
    notificationsModal.classList.add('notifications-modal');


    let followRequestsContent = createFollowRequestsContent(notifications.requests, my_id);
    notificationsModal.appendChild(followRequestsContent);


    let likesContent = createLikesContent(notificationsLike.requests);
    notificationsModal.appendChild(likesContent);

    return notificationsModal;
}


function createFollowRequestsContent(requests, my_id) {
    let followRequestsDiv = document.createElement('div');
    followRequestsDiv.classList.add('notifications-content');

    let title = document.createElement('h2');
    title.textContent = 'Follow Requests';
    followRequestsDiv.appendChild(title);

    requests.forEach(notification => {
        console.log(my_id);
        console.log(notification.receiver_id);
        if (notification.receiver_id == my_id) {
            let notificationDiv = createFollowRequestNotification(notification);
            followRequestsDiv.appendChild(notificationDiv);
        }

    });

    return followRequestsDiv;
}


function createFollowRequestNotification(notification) {
    let notificationDiv = document.createElement('div');
    notificationDiv.classList.add('notification-item');

    let avatar = document.createElement('img');
    avatar.classList.add('avatar');
    avatar.src = '../' + notification.sender.avatar;
    avatar.alt = 'Avatar';
    notificationDiv.appendChild(avatar);

    let contentDiv = document.createElement('div');
    contentDiv.classList.add('notification-content');

    let name = document.createElement('span');
    name.classList.add('sender-name');
    name.textContent = notification.sender.name;
    contentDiv.appendChild(name);

    let message = document.createElement('span');
    message.classList.add('message');
    message.textContent = ' requested to follow you';
    contentDiv.appendChild(message);

    let buttonsDiv = document.createElement('div');
    buttonsDiv.classList.add('buttons');

    let confirmButton = document.createElement('button');
    confirmButton.classList.add('btn', 'btn-success', 'btn-sm');
    confirmButton.textContent = 'Confirm';
    confirmButton.addEventListener('click', () => {
        window.location.href = `/confirm/${notification.id}`;
    });
    buttonsDiv.appendChild(confirmButton);

    let deleteButton = document.createElement('button');
    deleteButton.classList.add('btn', 'btn-danger', 'btn-sm');
    deleteButton.textContent = 'Delete';
    deleteButton.addEventListener('click', () => {
        window.location.href = `/delete/${notification.id}`;
    });
    buttonsDiv.appendChild(deleteButton);

    contentDiv.appendChild(buttonsDiv);
    notificationDiv.appendChild(contentDiv);

    return notificationDiv;
}


function createLikesContent(requests) {
    let likesDiv = document.createElement('div');
    likesDiv.classList.add('notifications-content');

    let title = document.createElement('h2');
    title.textContent = 'Likes';
    likesDiv.appendChild(title);
    requests.forEach(request => {
        let likeDiv = createLikeNotification(request);
        likesDiv.appendChild(likeDiv);
    });

    return likesDiv;
}


function createLikeNotification(request) {
    let notificationDiv = document.createElement('div');
    notificationDiv.classList.add('notification-item');

    let avatar = document.createElement('img');
    avatar.classList.add('avatar');
    avatar.src = '../' + request.sender.avatar;
    avatar.alt = 'Avatar';
    notificationDiv.appendChild(avatar);

    let contentDiv = document.createElement('div');
    contentDiv.classList.add('notification-content');

    let name = document.createElement('span');
    name.classList.add('sender-name');
    name.textContent = request.sender.name;
    contentDiv.appendChild(name);

    let message = document.createElement('span');
    message.classList.add('message');
    if (request.url.endsWith('.mp4') || request.url.endsWith('.avi') || request.url.endsWith('.mpeg')) {
        message.textContent = ' liked your video';
    } else {
        message.textContent = ' liked your photo';
    }
    contentDiv.appendChild(message);

    let mediaElement;
    if (request.url.endsWith('.mp4') || request.url.endsWith('.avi') || request.url.endsWith('.mpeg')) {
        mediaElement = document.createElement('video');
        mediaElement.classList.add('media');
        mediaElement.controls = true;
        mediaElement.src = request.url;
    } else {
        mediaElement = document.createElement('img');
        mediaElement.classList.add('media');
        mediaElement.src = request.url;
    }
    contentDiv.appendChild(mediaElement);

    notificationDiv.appendChild(contentDiv);

    return notificationDiv;
}
