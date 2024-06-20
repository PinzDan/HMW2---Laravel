export default function fetchComments() {
    const urlParams = new URLSearchParams(window.location.search);

    const filmID = urlParams.get('id');
    console.log(filmID);

    fetch(`/get-comments?film_id=${filmID}`)
        .then(response => {

            if (!response.ok) {
                throw new Error("Errore " + response.statusText);
            }

            return response.json();
        })
        .then(data => {
            const comments_container = document.querySelector(".container-commenti");

            if (data.length > 0) {
                data.forEach(element => {

                    const commentDiv = document.createElement('div');
                    commentDiv.className = 'user-comment';
                    const user = document.createElement('h3');
                    user.textContent = element.username;
                    const user_comment = document.createElement("p");
                    user_comment.textContent = element.testo;
                    const data = document.createElement('span');
                    data.textContent = element.data_commento;


                    commentDiv.appendChild(user);
                    commentDiv.appendChild(user_comment)
                    commentDiv.appendChild(data)
                    comments_container.appendChild(commentDiv);


                });
            } else {
                const h1 = document.createElement("h1");
                h1.textContent = "Nessun commento. ";
                comments_container.appendChild(h1);
            }
        })
        .catch(error => {
            console.error('Errore nel recupero dei commenti:', error);
        });
}


