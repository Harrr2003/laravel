function like(post_id) {
    let data = new URLSearchParams();
    let icon = document.getElementById(`likesIcon${post_id}`);
    let url = document.getElementById(`likes${post_id}`).value;
    let url2 = document.getElementById(`reqLikes${post_id}`).value;
    console.log(url2);
    console.log(url);
    let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    fetch(url, {
        method: "POST",
        body: data,
        headers: {
            "Content-Type": 'application/x-www-form-urlencoded',
            "X-CSRF-TOKEN": csrfToken
        }
    })
        .then(response => response.json())
        .then(result => {
            console.log(result);
            let likes_count = document.getElementById(`likesCount${post_id}`);
            if (icon.classList.contains('bi-heart-fill')) {
                icon.classList.remove('bi-heart-fill');
                icon.classList.add('bi-heart');
                likes_count.innerHTML = Number(likes_count.innerHTML) - 1;
            } else {
                icon.classList.remove('bi-heart');
                icon.classList.add('bi-heart-fill');
                likes_count.innerHTML = Number(likes_count.innerHTML) + 1;
            }
        })
        .catch(error => {
            console.log(error);
        });

    fetch(url2, {
        method: "POST",
        body: data,
        headers: {
            "Content-Type": 'application/x-www-form-urlencoded',
            "X-CSRF-TOKEN": csrfToken
        }
    })
        .then(response => response.json())
        .then(result => {
            console.log(result);

        })
        .catch(error => {
            console.log(error);
        });
}