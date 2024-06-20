
let array_movie = [];

function fetchFilm() {
    fetch('/api/films')
        .then(response => {
            if (!response.ok) {
                throw new Error("Errore " + response.statusText);
            }

            return response.json();
        })
        .then(data => {
            console.log(data);
            const current_page = window.location.pathname;
            array_movie = data;

            switch (currentPage) {
                case 'home':
                    updateHomePage(data);
                    break;
                case 'archive':
                    updateArchive(data)
                    setupFilter()
                    setupGenere()
                    updateGenere()
                    setupResearch()
                    break;
            }

        })
        .catch(error => {
            console.error('Errore fetch', error)

        })
}


function updateHomePage(films) {
    let i = 0;
    const left_container = document.querySelector('.left-container');

    const right_container = document.querySelector('.right-container')
    if (films.length > 0) {
        /* gestione left e rigth container*/
        let film = films[i];
        /* left */
        left_container.querySelector(".left-poster").style.backgroundImage = "url(" + film.locandina + ")";

        let description = left_container.querySelector('.description');
        let h1 = description.querySelector('h1').textContent = film.title;
        let p = description.querySelector('p').textContent = film.trama;
        let trailer = left_container.querySelector('.trailer');
        trailer.innerHTML = film.trailer;


        i++;
        film = films[i];
        right_container.querySelector(".right-poster").style.backgroundImage = "url(" + film.locandina + ")";

        let description2 = right_container.querySelector('.description');
        let h1_rigth = description2.querySelector('h1').textContent = film.title;
        let p_rigth = description2.querySelector('p').textContent = film.trama;
        let trailer2 = right_container.querySelector('.trailer');
        trailer2.innerHTML = film.trailer;
    }
    else {
        console.error("nessun film trovato nel database");
    }
}

/* archives */
function updateArchive(films) {
    let deleted = [];
    let rand = -1;
    const film_scroll = document.querySelector('.film-scroll')
    const film_card = film_scroll.querySelectorAll('.film-card');
    film_card.forEach(element => {

        do {
            rand = Math.floor(Math.random() * films.length)
        } while (deleted.includes(rand));

        deleted.push(rand);

        element.querySelector("img").src = films[rand].locandina;
        const info_card = element.querySelector(".info-card");

        info_card.querySelector("h3").textContent = films[rand].title;
        info_card.querySelector("span").textContent = films[rand].rating;
        trama = films[rand].trama.slice(0, 128) + "...";
        info_card.querySelector("p").textContent = trama;
        const info = document.createElement("a");
        info.textContent = "Clicca per saperne di più."
        let params = new URLSearchParams(films[rand]);
        info.href = `/selected?${params.toString()}`

        info_card.appendChild(info)

    })

    const film_card_row = document.querySelectorAll(".film-card-row");
    let i = 0;
    film_card_row.forEach(element => {
        let film_card = element.querySelectorAll('.film-card');
        film_card.forEach(element => {
            const img = document.createElement("img");
            img.src = films[i++].locandina;
            element.appendChild(img);
        })
    })
}



function setupFilter() {
    const filter_year = document.getElementById("filter");

    const menu_filter = filter_year.querySelector('.filter-menu');
    const year = menu_filter.querySelector('option[value="anno"]');
    const rating = menu_filter.querySelector('option[value="rating"]');
    const durata = menu_filter.querySelector('option[value="durata"]');

    if (filter_year) {
        filter_year.addEventListener("click", () => {


            year.addEventListener("click", () => {
                array_movie.sort((a, b) => a.anno_di_rilascio - b.anno_di_rilascio);
                updateArchiveByValue(array_movie);
            })

            rating.addEventListener("click", () => {
                array_movie.sort((a, b) => {
                    if (a.rating === b.rating) {
                        a.title - b.title
                    }
                    else {
                        a.rating - b.rating
                    }
                });
                updateArchiveByValue(array_movie);
            })
            durata.addEventListener("click", () => {
                array_movie.sort((a, b) => a.durata - b.durata);
                updateArchiveByValue(array_movie);
            })

        });
    }
}


function setupGenere() {
    const genere_button = document.getElementById('select-genre');

    if (genere_button) {
        genere_button.addEventListener("click", () => {
            const menu = genere_button.querySelector('.menu-genere');

            if (menu) {
                menu.classList.toggle("dont-show");
                menu.classList.toggle("show-items");
            }
        });
    }
}

function updateGenere() {
    const menu_genere = document.querySelector('.menu-genere');

    const checkboxes = menu_genere.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", () => {
            const selected = Array.from(checkboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value.toLowerCase());

            const new_movie_array = array_movie.filter(movie => selected.includes(movie.genere.toLowerCase()));

            if (new_movie_array.length > 0)
                updateArchiveByValue(new_movie_array);
            else {
                updateArchiveByValue(array_movie)
                const h1 = document.getElementById("notfound");
                h1.style.display = "block";
            }

        })
    })
}


function updateArchiveByValue(array) {
    console.log("città2");
    const cards = document.querySelectorAll(".film-card-row > .film-card");
    let i = 0;


    cards.forEach((element) => { // Aggiunta la funzione di callback correttamente
        if (i < array.length) {
            if (element.style.display === "none")
                element.style.display = "block";

            let img = element.querySelector("img");
            img.src = array[i++].locandina;
        }
        else {
            element.style.display = "none";
        }
    });
}




function setupResearch() {
    const research = document.getElementById("research-film");

    if (research) {
        research.addEventListener("input", () => {
            const value = research.value.trim();
            const menu = document.querySelector(".menu-ricerca");
            const researchfilm = document.getElementById("input-research");

            if (value) {
                researchfilm.style.backgroundColor = "#222";
                const result = array_movie.filter(movie =>
                    movie.title.toLowerCase().substring(0, value.length) === value.toLowerCase()
                );

                if (result.length > 0) {
                    const card = menu.querySelector(".research-card");
                    const info = card.querySelector(".info");
                    const row = card.querySelector("img");

                    row.src = result[0].locandina;

                    const title = info.querySelector("h1");
                    title.textContent = result[0].title;

                    const descr = info.querySelector("p");
                    descr.textContent = result[0].trama;

                    menu.classList.replace("notactive", "active-research");
                } else {
                    menu.classList.replace("active-research", "notactive");
                }
            } else {
                researchfilm.style.backgroundColor = "";
                menu.classList.replace("active-research", "notactive");
            }
        });

        document.addEventListener("click", function (event) {
            const menu = document.querySelector(".menu-ricerca");
            if (!menu.contains(event.target) && event.target !== research) {
                menu.classList.replace("active-research", "notactive");
                const researchfilm = document.getElementById("input-research");
                researchfilm.style.backgroundColor = "";
            }
        });
    }
}




window.onload = fetchFilm;


