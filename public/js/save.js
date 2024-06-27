function save(post_id) {
    let data = new URLSearchParams();
    let icon = document.getElementById(`saveIcon${post_id}`)
    let url = document.getElementById(`save${post_id}`).value;
    console.log(url);
    console.log(icon);

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
            if (icon.classList.contains('fa-bookmark-o')) {
                icon.classList.remove('fa-bookmark-o');
                icon.classList.add('fa-bookmark');
            } else {
                icon.classList.remove('fa-bookmark');
                icon.classList.add('fa-bookmark-o');
            }
        })
        .catch(error => {
            console.log(error);
        });
}