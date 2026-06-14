
const likeButtons = document.querySelectorAll('.like-btn');


likeButtons.forEach((button) => {

    button.addEventListener('click', async () => {

        
        const postId = button.dataset.id;

        const response = await fetch('/socialMedia/Public/like', {

            method: 'POST',

            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },

            body: `post_id=${postId}`
        });

        const data = await response.json();
        

        const likesSpan = document.querySelector(`#likes-${postId}`);

        likesSpan.innerText = data.likes + '  curtidas';

        button.innerText = data.liked ? 'Descurtir' : 'Curtir';

       

    });

});

const commentButtons = document.querySelectorAll('.comment-btn');

commentButtons.forEach((button) => {

    button.addEventListener('click', () => {

        const modal = button.parentElement.querySelector('.modal-overlay');

        modal.classList.remove('hidden');

    });

});

const modals = document.querySelectorAll('.modal-overlay');

modals.forEach((modal) => {

    modal.addEventListener('click', (event) => {

        if(event.target === modal){
            modal.classList.add('hidden');
        }

    });

});

const CURRENT_USER_ID = document
    .body
    .dataset
    .user;

async function loadMessages(){

    const messagesArea = document.querySelector('.messages-area');

    const receiverId = messagesArea.dataset.user;

    if(!receiverId){
        return;
    }

    try{

        const response = await fetch(
            `/socialMedia/Public/ajax?receiver_id=${receiverId}`
        );

        const messages = await response.json();

        messagesArea.innerHTML = '';

        messages.forEach((message) => {

            const isMyMessage = message.sender_id == CURRENT_USER_ID;

            messagesArea.innerHTML += `
            
                <div class="message ${
                    isMyMessage 
                    ? 'my-message' 
                    : 'other-message'
                }">

                    <p>${message.message}</p>

                    <span>
                        ${message.created_at}
                    </span>

                </div>
            
            `;
        });

    }catch(error){

        console.log(error);

    }
}

loadMessages();

setInterval(() => {

    loadMessages();

}, 2000);

