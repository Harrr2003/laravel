function createModal() {
    let modal = document.createElement('div');
    modal.style.display = 'none';
    modal.style.position = 'fixed';
    modal.style.zIndex = '1000';
    modal.style.left = '0';
    modal.style.top = '0';
    modal.style.width = '100%';
    modal.style.height = '100%';
    modal.style.overflow = 'auto';
    modal.style.backgroundColor = 'rgba(0,0,0,0.4)';
    return modal;
}

function createModalContent() {
    let modalContent = document.createElement('div');
    modalContent.style.backgroundColor = '#fefefe';
    modalContent.style.margin = '5% auto';
    modalContent.style.padding = '20px';
    modalContent.style.border = '1px solid #888';
    modalContent.style.width = '80%';
    modalContent.style.maxHeight = '80%';
    return modalContent;
}

function createCloseButton(modal) {
    let closeButton = document.createElement('span');
    closeButton.innerHTML = '&times;';
    closeButton.style.color = '#aaa';
    closeButton.style.float = 'right';
    closeButton.style.fontSize = '28px';
    closeButton.style.fontWeight = 'bold';
    closeButton.style.cursor = 'pointer';
    closeButton.addEventListener('click', () => {
        modal.style.display = 'none';
    });
    return closeButton;
}

function createUsersContainer() {
    let usersContainer = document.createElement('div');
    usersContainer.style.overflow = 'auto';
    usersContainer.style.maxHeight = '500px';
    usersContainer.style.position = 'relative';
    usersContainer.style.zIndex = '1000';
    return usersContainer;
}

function updateFollowersTable(users, container) {
    let usersTable = document.createElement('table');
    usersTable.classList.add('user-table');

    let thead = document.createElement('thead');
    let headerRow = document.createElement('tr');

    let thAvatar = document.createElement('th');
    thAvatar.innerText = 'Avatar';

    let thName = document.createElement('th');
    thName.innerText = 'Name';

    headerRow.appendChild(thAvatar);
    headerRow.appendChild(thName);
    thead.appendChild(headerRow);
    usersTable.appendChild(thead);

    let tbody = document.createElement('tbody');
    users.forEach(function(user) {
        let row = document.createElement('tr');
        row.addEventListener('click', () => {
            window.location.href = `/userProfile/${user.id}`;
        });

        let tdAvatar = document.createElement('td');
        let avatar = document.createElement('img');
        avatar.classList.add('avatar');
        avatar.src = "../" + user.avatar;
        avatar.alt = "Avatar";
        tdAvatar.appendChild(avatar);

        let tdName = document.createElement('td');
        tdName.innerText = user.name;

        row.appendChild(tdAvatar);
        row.appendChild(tdName);
        tbody.appendChild(row);
    });

    usersTable.appendChild(tbody);
    container.innerHTML = '';
    container.appendChild(usersTable);
}

function showFollowers(id) {
    let modal = createModal();
    let modalContent = createModalContent();
    let closeButton = createCloseButton(modal);
    let usersContainer = createUsersContainer();

    modalContent.appendChild(closeButton);
    modalContent.appendChild(usersContainer);
    modal.appendChild(modalContent);
    document.body.appendChild(modal);

    fetch(`/followersList/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.senders.length > 0) {
                updateFollowersTable(data.senders, usersContainer);
                modal.style.display = 'block';
            } else {
                console.log('No followers found.');
                
            }
        })
        .catch(error => {
            console.error('Error fetching followers:', error);
        });
}

function showFollowing(id) {
    let modal = createModal();
    let modalContent = createModalContent();
    let closeButton = createCloseButton(modal);
    let usersContainer = createUsersContainer();

    modalContent.appendChild(closeButton);
    modalContent.appendChild(usersContainer);
    modal.appendChild(modalContent);
    document.body.appendChild(modal);

    fetch(`/followingList/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                updateFollowersTable(data, usersContainer);
                modal.style.display = 'block';
            } else {
                console.log('Not following anyone.');
                
            }
        })
        .catch(error => {
            console.error('Error fetching following:', error);
        });
}

function showFollowersForProfile() {
    let modal = createModal();
    let modalContent = createModalContent();
    let closeButton = createCloseButton(modal);
    let usersContainer = createUsersContainer();

    modalContent.appendChild(closeButton);
    modalContent.appendChild(usersContainer);
    modal.appendChild(modalContent);
    document.body.appendChild(modal);

    fetch(`/followersListforProfile`)
        .then(response => response.json())
        .then(data => {
            if (data.senders.length > 0) {
                updateFollowersTable(data.senders, usersContainer);
                modal.style.display = 'block';
            } else {
                console.log('No followers found for profile.');
                
            }
        })
        .catch(error => {
            console.error('Error fetching followers for profile:', error);
        });
}

function showFollowingForProfile() {
    let modal = createModal();
    let modalContent = createModalContent();
    let closeButton = createCloseButton(modal);
    let usersContainer = createUsersContainer();

    modalContent.appendChild(closeButton);
    modalContent.appendChild(usersContainer);
    modal.appendChild(modalContent);
    document.body.appendChild(modal);

    fetch(`/followingListforProfile`)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                updateFollowersTable(data, usersContainer);
                modal.style.display = 'block';
            } else {
                console.log('Not following anyone for profile.');
                
            }
        })
        .catch(error => {
            console.error('Error fetching following for profile:', error);
        });
}
