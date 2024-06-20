import fetchComments from './get_comments.js';

const urlParams = new URLSearchParams(window.location.search);
const filmId = urlParams.get('id');
const registaId = urlParams.get('regista_id');
const rating = urlParams.get('rating');

function fetchRegista() {

    // Effettua la richiesta fetch utilizzando il registaId ottenuto
    fetch(`/fetch-regista?regista_id=${registaId}`)
        .then(response => {

            if (!response.ok) {
                throw new Error("Errore " + response.statusText);
            }

            return response.json();
        })
        .then(data => {
            if (data.length > 0) {
                const regista = data[0];
                document.getElementById('regista-nome').textContent = regista.nome + " " + regista.cognome;
                document.getElementById('regista-biografia').textContent = regista.biografia;
                document.querySelector('.regista-photo').querySelector("img").src = regista.foto;

            }
        })
        .catch(error => console.error('Errore:', error));
}


function countAwardsByFilmId() {


    // Esegui la chiamata per ottenere il conteggio dei premi raggruppati per nome del premio per il film con filmId
    fetch(`/api/films/awards-count?id=${filmId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error("Errore " + response.statusText);
            }

            return response.json();
        })
        .then(data => {

            console.log('Conteggio premi per il film:', data);

            updateRewards(data);
        })
        .catch(error => console.error('Errore nel conteggio premi:', error));
}


function updateRewards(rewards) {
    const reward = document.getElementById('reward');

    rewards.forEach(element => {


        const container = document.createElement('div');
        container.classList.toggle('reward-details');
        const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");

        // Impostazione degli attributi SVG
        svg.setAttribute("width", "36");
        svg.setAttribute("height", "36");


        const iconUrl = "assets/icon/" + element.nome + ".svg";
        const image = document.createElementNS("http://www.w3.org/2000/svg", "image");
        image.setAttribute("href", iconUrl);
        image.setAttribute("width", "36");
        image.setAttribute("height", "36");



        const text = document.createElement('span');
        text.textContent = "X" + element.total + " - " + element.nome;

        svg.appendChild(image);
        container.appendChild(svg);
        container.appendChild(text);

        reward.appendChild(container);

    });
}

function updateRating() {


    const container = document.querySelector(".star");
    const star = "/assets/icon/star.svg";
    const half_star = "/assets/icon/half_star.svg";
    const empty_star = "/assets/icon/empty_star.svg";



    const intera = Math.floor(rating);
    const decimale = rating - intera;

    console.log(rating)
    console.log(intera);
    const half = false;
    if (decimale == 5) {
        half = true;
    }

    for (let i = 0; i < 5; i++) {
        const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
        const image = document.createElementNS("http://www.w3.org/2000/svg", "image");
        // Impostazione degli attributi SVG
        svg.setAttribute("width", "36");
        svg.setAttribute("height", "36");

        image.setAttribute("width", "36");
        image.setAttribute("height", "36");
        if (i < intera) {
            image.setAttribute("href", star);
        }
        else if (half) {
            image.setAttribute("href", half_star);
            half = false;
        }
        else
            image.setAttribute("href", empty_star);


        image.setAttribute("data-index", i);
        image.classList.toggle("star-svg");
        svg.appendChild(image)

        container.appendChild(svg);
    }


}



function fillStar() {
    const starClass = document.querySelectorAll(".star-svg");
    const star = "/assets/icon/star.svg";
    const empty_star = "/assets/icon/empty_star.svg";

    starClass.forEach(element => {
        element.addEventListener("mouseenter", () => {
            const index = parseInt(element.getAttribute("data-index"), 10);

            // Riporta tutte le stelle allo stato vuoto
            starClass.forEach((starElement, starIndex) => {
                if (starIndex <= index) {
                    starElement.setAttribute("href", star);
                } else {
                    starElement.setAttribute("href", empty_star);
                }
            });
        });
    });
}


let clicked = false;
function clickStar() {
    const starClass = document.querySelectorAll(".star-svg");
    starClass.forEach(element => {
        element.addEventListener("click", () => {
            if (!clicked) {
                const index = parseInt(element.getAttribute("data-index"), 10) + 1;


                fetch(`/api/vote?filmID=${filmId}&rating=${index}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Errore " + response.statusText);
                        }

                        return response.json();
                    })

            }

        });
    });
}




window.onload = function () {
    fetchRegista()
    fetchComments()
    countAwardsByFilmId()
    updateRating()

    console.log(logged)
    if (logged) {
        fillStar()
        clickStar()
    }

} 