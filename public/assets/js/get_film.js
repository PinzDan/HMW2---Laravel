
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
            array_movie = data;

            switch (currentPage) {
                case 'home':
                    updateSlideshow(data);
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

function updateSlideshow(films) {
    const photo_div = document.querySelectorAll(".photo");
    rand = Math.floor(Math.random() * (films.length - 6));


    photo_div.forEach(element => {
        console.log(rand)
        let params = new URLSearchParams(films[rand]);
        element.querySelector(".caption").textContent = films[rand].title
        element.querySelector("img").src = films[rand++].slideshow;
        element.querySelector("a").setAttribute("href", `/selected?${params.toString()}`)
    })
}





/* archives */
let i = 0;
function updateArchive(films) {

    let deleted = [];
    let rand = -1;
    const film_scroll = document.querySelector('.film-scroll')
    const film_card = film_scroll.querySelectorAll('.film-card');
    const nextpage = document.getElementById("next");
    const backpage = document.getElementById("back");

    const archive = document.getElementById("archivio-film")

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

    /* archivio */

    const film_card_row = document.querySelectorAll(".film-card-row");
    film_card_row.forEach(element => {
        let film_card = element.querySelectorAll('.film-card');

        film_card.forEach(element => {

            if (i < films.length) {
                element.setAttribute('data-index', films[i].id);
                let a = createFilmCard(i, films);
                element.appendChild(a);
                i++;
            }
        });
    });
    createHiddenCard()




    function createHiddenCard() {
        let j = 0;
        let row = createRow();

        archive.appendChild(row);
        while (i < films.length) {
            if (j === 5) {
                j = 0;
                row = createRow();

                archive.appendChild(row);

            }
            id = films[i].id;
            const newfilm = createFilmCard(i++, films);
            const newCard = document.createElement("div");
            newCard.className = "film-card";

            newCard.setAttribute("data-index", id);

            newCard.appendChild(newfilm);

            row.appendChild(newCard);

            j++;
        }
    }

    nextpage.addEventListener("click", () => {
        changeCard(true)
        backpage.style.display = "flex"
    })
    backpage.addEventListener("click", () => {
        changeCard();

    })

}


function changeCard(isNext = false) {
    const row = document.querySelectorAll(".film-card-row")
    isNext ? next(row) : back(row);
}

function next(row) {

    let lastShow = 0;
    let nrow = 4
    let count = 0;
    row.forEach((element, index) => {


        if (element.classList.contains("obscure") && lastShow >= nrow) {
            if (count < nrow) {
                console.log(lastShow)
                element.classList.replace("obscure", "show");
                count++;
            }
        }


        else {
            element.classList.replace("show", "obscure");
            lastShow++
        }


    })

}

function back(row) {
    let indice = -1;
    for (let index = 0; index < row.length; index++) {
        const element = row[index];
        if (element.classList.contains("show")) {
            indice = index;
            break;
        }
    }

    const estremoSinistro = indice - 4;
    let estremoDestro = indice + 4;

    for (let index = estremoSinistro; index <= estremoDestro; index++) {
        if (index >= 0 && index < row.length) {
            if (index < estremoSinistro + 4) {
                row[index].classList.replace("obscure", "show");
            } else {
                row[index].classList.replace("show", "obscure");
            }
        }
    }

    /* versione vecchia */
    // row.forEach((element, index) => {
    //     if (index >= estremoSinistro && index < estremoDestro)
    //         element.classList.replace("obscure", "show");
    //     else //if (index >= indice - 4)
    //         element.classList.replace("show", "obscure");
    // })

}




function createFilmCard(index, films) {
    const a = document.createElement('a');
    let params = new URLSearchParams(films[index]);
    a.setAttribute("href", `/selected?${params.toString()}`);


    const img = document.createElement("img");
    img.src = films[index].locandina;
    img.alt = films[index].title;

    a.appendChild(img);

    return a;
}


function createRow() {
    const newrow = document.createElement("div");
    newrow.className = "film-card-row obscure";

    return newrow;
}

/* +-+-+-+-+-+- */




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
                sortCard()
            })

            rating.addEventListener("click", () => {
                array_movie.sort((a, b) => {
                    if (a.rating === b.rating) {
                        return a.title.localeCompare(b.title);
                    }
                    else {
                        return b.rating - a.rating
                    }
                });
                sortCard()
            })
            durata.addEventListener("click", () => {
                array_movie.sort((a, b) => a.durata - b.durata);
                sortCard()
            })

        });
    }
}

function sortCard() {
    const cards = document.querySelectorAll(".film-card-row >.film-card");

    console.log(array_movie)
    cards.forEach((element, index) => {
        if (index < array_movie.length) {
            element.setAttribute('data-index', array_movie[index].id);
            const a = element.querySelector("a")
            let params = new URLSearchParams(array_movie[index]);
            a.setAttribute("href", `/selected?${params.toString()}`);


            element.querySelector("img").src = array_movie[index].locandina;
        } else
            return "errore"
    })
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

            if (new_movie_array.length > 0 && selected.length > 0) {
                updateArchiveByValue(new_movie_array);
            }
            else if (selected.length > 0 && new_movie_array < 0) {
                const h1 = document.getElementById("notfound");
                h1.style.display = "block";

            }
            else {
                updateArchiveByValue(array_movie)
            }
        })

    })

}


function updateArchiveByValue(array) {
    console.log("città2");
    const cards = document.querySelectorAll(".film-card-row > .film-card");
    console.log(array)
    cards.forEach(element => {
        const dataIndex = element.getAttribute("data-index");
        const found = array.find(item => item.id.toString() === dataIndex);
        if (found) {
            element.style.display = "flex";
        } else {
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


