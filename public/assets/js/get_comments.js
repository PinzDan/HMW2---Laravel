export default function fetchComments() {
    const urlParams = new URLSearchParams(window.location.search);

    const filmID = urlParams.get('id');
    console.log(filmID);

    fetch(`api/get-comments?film_id=${filmID}`)
        .then(response => {

            if (!response.ok) {
                throw new Error("Errore " + response.statusText);
            }

            return response.json();
        })
        .then(data => {
            const comments_container = document.querySelector(".container-commenti");

            if (data.length > 0) {
                const fragment = document.createDocumentFragment();
                data.forEach(element => {

                    const commentDiv = document.createElement('div');
                    commentDiv.className = 'user-comment';

                    const image = document.createElement('img');
                    image.setAttribute('src', "Images/profiles/" + element.image)
                    image.className = "profile-image";

                    const user = document.createElement('h3');
                    user.textContent = element.username;

                    const user_comment = document.createElement("p");
                    user_comment.textContent = element.testo;

                    const data = document.createElement('span');
                    data.textContent = element.data_commento;

                    commentDiv.append(image, user, user_comment, data);
                    fragment.appendChild(commentDiv);
                });
                comments_container.appendChild(fragment);
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


