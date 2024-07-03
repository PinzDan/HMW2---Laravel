document.getElementById('cercaFilm').addEventListener('change', () => {
    const title = document.getElementById('cercaFilm').value;

    fetch(`/api/omdb/` + title)
        .then(response => {
            if (!response.ok) {
                throw new Error('Errore nel response ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log('Success:', data);
            const html1 = `<h2>${data.Title} (${data.Year})</h2>
            <img src="${data.Poster}" alt="Poster del film">`
            const html2 = ` <p><strong>Rated:</strong> ${data.Rated}</p>
        <p><strong>Released:</strong> ${data.Released}</p>
        <p><strong>Runtime:</strong> ${data.Runtime}</p>
        <p><strong>Genre:</strong> ${data.Genre}</p>
        <p><strong>Director:</strong> ${data.Director}</p>
        <p><strong>Writer:</strong> ${data.Writer}</p>
        <p><strong>Actors:</strong> ${data.Actors}</p>
        <p><strong>Plot:</strong> ${data.Plot}</p>
        <p><strong>IMDb Rating:</strong> ${data.imdbRating}</p>
        <p><strong>Awards:</strong> ${data.Awards}</p>
        <p><strong>Box Office:</strong> ${data.BoxOffice}</p>`


            document.querySelector(".main").innerHTML = html1;
            document.querySelector(".secondary").innerHTML = html2;

            const addButton = document.getElementById("aggiungiFilm")
            if (addButton)
                addButton.addEventListener('click', () => {
                    addFilm(data);
                })
        })
        .catch(error => {
            console.error("C'è stato qualche problema con l'operazione", error);
        });
});

function addFilm(array) {
    const url = new URLSearchParams(array);
    console.log(`api/films/addFilm?${url.toString()}`)
    fetch(`api/films/addFilm?${url.toString()}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Errore nel response ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {

            console.log('Risposta dal server:', responseData);

            alert("Film Aggiunto!");
        })
        .catch(error => {
            console.error('Errore durante la richiesta:', error);

        });
}
function getTop() {
    fetch('api/getTop')
        .then(response => {
            if (!response.ok) {
                throw new Error('Errore nel response ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data);

            const positionElements = document.querySelectorAll(".position");


            let elements = data.map(rank => ({
                username: rank.username,
                image: rank.image
            }));

            const rankClass = {
                0: ["third", 2],
                1: ["second", 0],
                2: ["first", 1],
            };

            let elementIndex = 2;

            for (let index = 0; index < 3; index++) {
                setTimeout(() => {
                    const dataRankSelector = `[data-rank="${index}"]`;
                    console.log(dataRankSelector);

                    const dataElement = document.querySelector(dataRankSelector);
                    if (!dataElement) {
                        console.error('Elemento non trovato:', dataRankSelector);
                        return;
                    }

                    const [rankClassName, posIndex] = rankClass[index];

                    positionElements[posIndex].classList.toggle(rankClassName);
                    dataElement.querySelector("img").src = "./Images/profiles/" + elements[elementIndex].image;
                    positionElements[posIndex].classList.toggle("appear");
                    positionElements[posIndex].classList.toggle("fade-in");

                    const nameElement = positionElements[posIndex].querySelector(".name");
                    nameElement.textContent = elements[elementIndex--].username;

                }, index * 2000);
            }
        })
        .catch(error => {
            console.error('Errore fetch:', error);
        });
}


getTop();
