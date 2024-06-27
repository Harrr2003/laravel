let body = document.querySelector('body');
let inputSearch = document.getElementById('searchUser');


body.style.overflow = 'hidden';


let modal = document.createElement('div');
modal.style.display = 'none';
modal.style.position = 'fixed';
modal.style.zIndex = '1000';
modal.style.left = '0';
modal.style.top = '0';
modal.style.width = '100%';
modal.style.height = '100%';
modal.style.overflow = 'auto';
modal.style.backgroundColor = 'rgb(0,0,0)';
modal.style.backgroundColor = 'rgba(0,0,0,0.4)';


let modalContent = document.createElement('div');
modalContent.style.backgroundColor = '#fefefe';
modalContent.style.margin = '5% auto';
modalContent.style.padding = '20px';
modalContent.style.border = '1px solid #888';
modalContent.style.width = '80%';
modalContent.style.maxHeight = '80%';


let closeButton = document.createElement('span');
closeButton.innerHTML = '&times;';
closeButton.style.color = '#aaa';
closeButton.style.float = 'right';
closeButton.style.fontSize = '28px';
closeButton.style.fontWeight = 'bold';
closeButton.style.cursor = 'pointer';
closeButton.addEventListener('click', () => {
    modal.style.display = 'none';
    inputSearch.value = '';
    usersTable.innerHTML = '';
});


modalContent.appendChild(closeButton);
modal.appendChild(modalContent);
body.appendChild(modal);

let usersContainer = document.createElement('div');
usersContainer.style.overflow = 'auto';
usersContainer.style.maxHeight = '500px';
usersContainer.style.position = 'relative';
usersContainer.style.zIndex = '1000';

let usersTable = document.createElement('table');
usersTable.classList.add('user-table');

function updateTable(users, follows, my_id) {
    usersTable.innerHTML = '';

    let thead = document.createElement('thead');
    let headerRow = document.createElement('tr');

    let thAvatar = document.createElement('th');
    thAvatar.innerText = 'Avatar';

    let thName = document.createElement('th');
    thName.innerText = 'Name';

    let thFollow = document.createElement('th');
    thFollow.innerText = 'Follow';

    headerRow.appendChild(thAvatar);
    headerRow.appendChild(thName);
    headerRow.appendChild(thFollow);
    thead.appendChild(headerRow);
    usersTable.appendChild(thead);

    let tbody = document.createElement('tbody');

    users.forEach(function (user) {
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

        let tdFollow = document.createElement('td');

        let followIcon = document.createElement('i');
        followIcon.classList.add('bi', 'bi-person-check-fill');
        followIcon.style.color = 'grey';
        followIcon.setAttribute('title', 'Not Followed');

        follows.forEach(function (follow) {
            if (follow.sender_id == my_id && follow.receiver_id == user.id && follow.status == 2) {
                followIcon.style.color = 'green';
                followIcon.setAttribute('title', 'Following');
            }
        });

        tdFollow.appendChild(followIcon);

        row.appendChild(tdAvatar);
        row.appendChild(tdName);
        row.appendChild(tdFollow);
        tbody.appendChild(row);
    });

    usersTable.appendChild(tbody);
    usersContainer.appendChild(usersTable);
}

modalContent.appendChild(usersContainer);

inputSearch.addEventListener('keyup', () => {
    if (inputSearch.value.trim() !== '') {
        let data = new URLSearchParams();
        data.append("text", inputSearch.value.trim());

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/search', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token': csrfToken
            },
            body: data
        })
            .then(response => response.json())
            .then(result => {
                console.log(result.follow);
                updateTable(result.users, result.follow, result.my_id);
                modal.style.display = 'block';
            })
            .catch(error => {
                console.error('Error fetching users:', error);
            });
    } else {
        usersTable.innerHTML = '';
        modal.style.display = 'none';
    }
});

window.addEventListener('click', (event) => {
    if (event.target == modal) {
        modal.style.display = 'none';
        inputSearch.value = '';
        usersTable.innerHTML = ''; 
    }
});
