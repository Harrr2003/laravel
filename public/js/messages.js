let messages = document.getElementById('messages')


messages.addEventListener('click',()=>{
    let messagesModal = document.createElement('div')
    messagesModal.style.width = '100%'
    messagesModal.style.height = '100vh'
    messagesModal.style.backgroundColor = 'rgba(128, 128, 128, 0.514)'
    messagesModal.style.position = 'absolute'
    messagesModal.style.top = '0'
    messagesModal.style.zIndex = '9999'
    messagesModal.addEventListener('click',()=>{
        messagesModal.remove()
    })
    let messagesDiv = document.createElement('div')
    messagesDiv.style.width = '30%'
    messagesDiv.style.height = '100vh'
    messagesDiv.classList.add('messagesDiv')
    messagesDiv.style.zIndex = '999'
    messagesDiv.addEventListener('click',(e)=>{
        e.stopPropagation()
    })
    body.append(messagesModal)
    messagesModal.append(messagesDiv)

    fetch(`/chats`)
    .then(response => response.json())
    .then(request => {
        console.log(request);

    })
    .catch(error => {
        console.error(error);
    });
})