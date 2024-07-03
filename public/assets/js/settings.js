
let dati;
function fetchSetting() {
    return fetch(`/api/account`)
        .then(response => {

            if (!response.ok) {
                throw new Error("Errore " + response.statusText);
            }

            return response.json();
        })
        .then(data => {
            return dati = data;
        })
        .catch(error => {
            return console.error('Errore nel fetch:', error);
        });

}



function updateSetting() {

    console.log(dati)
    const image = document.querySelector(".image img");
    image.src = "Images/profiles/" + dati.image;

    document.querySelector('.username input').value = dati.username;
    document.querySelector('.email').textContent = dati.email;
    document.querySelector(".section-container span").textContent = dati.data_creazione;

}

const photo_input = document.getElementById("photo-input");
const photo_img = document.getElementById("photo-img");

photo_input.addEventListener('change', () => {

    const file = photo_input.files[0]


    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            console.log(e.target.result)
            photo_img.setAttribute('src', e.target.result)
        }

        reader.readAsDataURL(file);
        updateImage(file)
    }
})

function updateImage(file) {
    const formData = new FormData();
    formData.append('_token', document.getElementById("csrf_token").value);
    formData.append('image', file);

    fetch("/api/updateImage", {
        method: 'POST',
        body: formData
    })
        .then(response => {

            if (!response.ok) {
                throw new Error("Errore " + response.statusText);
            }

            return response.json();
        })
}


const edit = document.querySelectorAll(".edit");

edit.forEach(element => {
    element.addEventListener("click", () => {
        document.getElementById("photo-input").click();
    })
})

const editText = document.querySelector(".editText");
const value = document.querySelector(".notselected").value;
console.log(value);
editText.addEventListener("click", () => {
    const notSelectedElement = document.querySelector(".notselected");
    const selectedElement = document.querySelector(".selected");

    if (notSelectedElement) {
        notSelectedElement.disabled = false;
        notSelectedElement.classList.replace("notselected", "selected");
        notSelectedElement.click();
    } else if (selectedElement) {
        console.log(value);
        console.log(selectedElement.value)
        selectedElement.disabled = true;
        selectedElement.classList.replace("selected", "notselected");
        if (selectedElement.value != value) {
            console.log("effettuo il cambio");
            updateUsername(selectedElement.value);
        }
    }
})

function updateUsername(value) {
    const endpoint = "api/updateUsername/" + value;
    fetch(endpoint)
        .then(response => {

            if (!response.ok) {
                alert("Username non valido")
            }

            return response.json();
        })
}


/*section info */

function topVotes() {
    fetch('api/topVotes')
        .then(response => {

            if (!response.ok) {
                throw new Error("Errore " + response.statusText);
            }

            return response.json();
        })
        .then(data => {
            updateTop3(data);
        })


}

function updateTop3(votes) {

    let i = 1;
    console.log(votes);
    votes.forEach(element => {
        console.log(element)
        const url = 'api/getByID/' + element.filmID;
        console.log(url);
        fetch(url)
            .then(response => {

                if (!response.ok) {
                    throw new Error("Errore " + response.statusText);
                }

                return response.json();
            })
            .then(data => {
                const rank = ".rank" + i++;
                const item = document.querySelector(rank);

                item.querySelector('h2').textContent = data.title;
                item.querySelector('p').textContent = data.trama;
                item.querySelector('span').textContent = "Voto dato: " + element.rating;
            })
    })
}

document.getElementById("Elimina").addEventListener("click", () => {
    fetch("api/deleteAccount")
        .then(response => {
            if (!response.ok) {
                throw new Error("Errore " + response.statusText);
            }

            return response.json();

        })
        .then(data => {
            // Gestisci la risposta della prima fetch qui, se necessario
            alert("Account eliminato:", data);

            // Dopo aver eliminato l'account con successo, esegui il logout
            return fetch("/logout")
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Errore " + response.statusText);
                    }
                    // Non è necessario ritornare il JSON, basta reindirizzare
                    window.location.href = '/';
                })
        })
})

window.onload = function () {
    fetchSetting()
        .then(() => {
            updateSetting()
        })

    topVotes();


}