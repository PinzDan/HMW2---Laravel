
/* LoginPage */



const eyes_on = '/assets/icon/visibility_24dp_FILL0_wght400_GRAD0_opsz24.png'
const eyes_off = 'assets/icon/visibility_off_24dp_FILL0_wght400_GRAD0_opsz24.png'

console.log("Eccomi")
const eyes = document.getElementById("visible");

eyes.setAttribute('href', eyes_off)

let visible = false;

const pwd_input = document.querySelectorAll('.pwd')
const pwdinput_confirm = document.getElementById('pwd_confirm')

eyes.addEventListener("click", function () {


    if (!visible) {
        console.log('Password visibile')
        eyes.setAttribute('href', eyes_on)

        pwd_input[0].type = "text"
        pwd_input[1].type = "text"
        pwdinput_confirm.type = "text"

        visible = true
    } else {
        console.log('Password invisibile')
        eyes.setAttribute('href', eyes_off)

        pwd_input[0].type = "password"
        pwd_input[1].type = "password"
        pwdinput_confirm.type = "password"

        visible = false
    }

})


/* click immagine profilo */
const photo_img = document.getElementById("photo-img");
const photo_input = document.getElementById("photo-input");
const profile_photo = document.getElementById('photo-label');
profile_photo.addEventListener('click', () => {
    photo_input.click();
})


photo_input.addEventListener('change', () => {

    const file = photo_input.files[0]


    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            console.log(e.target.result)
            photo_img.setAttribute('src', e.target.result)
        }

        reader.readAsDataURL(file);
        changed = true;
        changeAddLabel(changed);
    }
})



let changed = false;

const add_label = document.getElementById("add-label");

add_label.addEventListener("click", () => {
    if (changed) {
        photo_img.setAttribute('src', 'assets/icon/Profile.png');
        changed = false;
        changeAddLabel()
    } else
        photo_input.click();
})

function changeAddLabel() {

    const image = add_label.querySelector('.add-image');
    if (changed) {
        image.setAttribute("href", 'assets/icon/cancel_24dp_FILL0_wght400_GRAD0_opsz24(1).svg')
    }
    else {
        image.setAttribute("href", 'assets/icon/add_circle_24dp_FILL0_wght400_GRAD0_opsz24(1).svg')
    }
}



const login_btn = document.getElementById("login-btn");
const signup_btn = document.getElementById("signup-btn");

const signup_form = document.querySelector(".signup-form");
const login_form = document.querySelector(".login-form");
const form_container = document.getElementById("signup-container")
const submit = document.getElementById('signup-submit')
const paragrafo = document.querySelector('.paragrafo-login');



let showCalled = false;
function changeForm(event) {
    const isSignup = event === "signup";
    const isLogin = event === "login";

    if (isLogin || isSignup) {
        paragrafo.querySelector('ol').style.display = isSignup ? 'block' : 'none';
        paragrafo.querySelector('p').style.display = isLogin ? 'block' : 'none';



        if (isSignup && !showCalled) {
            showList();
            showCalled = true;
        }


        login_form.classList.toggle("hidden", isSignup)
        signup_form.classList.toggle("translate_log", isSignup)

        // signup_form.classList.toggle("hidden", isLogin);

        login_btn.classList.toggle("clicked", isLogin);
        signup_btn.classList.toggle("clicked", isSignup);

        login_btn.disabled = isLogin;
        signup_btn.disabled = isSignup



    }
}

function showList() {
    let texts = [
        `Collaborazione con Arthur C. Clarke
        Il film è basato sul racconto di Arthur C. Clarke "La sentinella" (1951), ma Clarke e Kubrick collaborarono strettamente durante lo sviluppo del film. Clarke scrisse anche un romanzo omonimo, pubblicato poco dopo l'uscita del film.`,

        `Effetti speciali rivoluzionari
        Gli effetti speciali del film furono all'avanguardia per l'epoca. Il supervisore agli effetti speciali, Douglas Trumbull, ideò tecniche innovative, tra cui l'uso di proiezioni frontali e modellini dettagliati per rappresentare le astronavi e lo spazio.`,

        `Realismo scientifico
        Kubrick e Clarke si sforzarono di rendere il film il più scientificamente accurato possibile. Consultarono esperti in vari campi, inclusi astronauti e scienziati, per assicurarsi che i dettagli tecnici e scientifici fossero corretti. Il risultato fu un ritratto molto realistico del viaggio spaziale, con dettagli come l'assenza di suono nello spazio e l'uso della rotazione per simulare la gravità.`,

        `Il Monolite
        Il monolite nero, simbolo centrale del film, rappresenta un oggetto di origine extraterrestre che catalizza il progresso dell'umanità. Kubrick e Clarke lasciarono volutamente ambigua la sua natura esatta, permettendo diverse interpretazioni da parte del pubblico.`,

        `Musica iconica
        La colonna sonora del film è nota per l'uso di brani di musica classica, come "Also sprach Zarathustra" di Richard Strauss e "Sul bel Danubio blu" di Johann Strauss II. La scelta di musica classica anziché una colonna sonora originale contribuì a creare l'atmosfera epica e senza tempo del film.`,

        `Il computer HAL 9000
        HAL 9000, il computer di bordo dell'astronave Discovery, è uno dei personaggi più memorabili del film. Dotato di intelligenza artificiale avanzata, HAL è noto per la sua voce calma e la sua eventuale ribellione contro l'equipaggio umano. La frase "I'm sorry, Dave, I'm afraid I can't do that" è diventata iconica.`,

        `Intervallo nel film
        La versione originale del film presentava un intervallo a metà proiezione. Questa pratica era comune nei film epici degli anni '60 ma è stata abbandonata nelle versioni successive e nelle trasmissioni televisive.`,

        `Ambiguità del finale
        Il finale del film è noto per essere particolarmente enigmatico e aperto a interpretazioni. La sequenza finale vede il protagonista, Dave Bowman, attraversare un "corridoio stellare" e trasformarsi in un "bambino delle stelle". Kubrick e Clarke non hanno mai fornito una spiegazione definitiva, lasciando il significato al pubblico.`,

        `Impatto culturale
        "2001: Odissea nello spazio" ha avuto un impatto enorme sulla cultura popolare e sulla fantascienza. È stato citato, parodiato e omaggiato in innumerevoli opere cinematografiche, televisive e letterarie.`,

        `Premi e riconoscimenti
        Il film vinse un Premio Oscar per i migliori effetti speciali visivi e fu nominato per altri tre premi: miglior regista, migliore sceneggiatura originale e migliore scenografia. È spesso considerato uno dei migliori film di tutti i tempi.`
    ];

    let delay = 0;
    texts.forEach((text) => {
        setTimeout(() => {
            const li = document.createElement('li');
            li.classList.add('typewriter-text');
            document.getElementById('odissey-list').appendChild(li);
            typeWriterEffect(li, text, 50);
        }, delay);
        delay += text.length * 50 + 2000;
    });
}

function typeWriterEffect(element, text, delay) {
    let index = 0;
    function type() {
        if (index < text.length) {
            element.textContent += text[index];
            index++;
            setTimeout(type, delay);
        }
    }
    return type();

}






const username_pattern = /^[a-zA-Z0-9]{5,10}$/;
const password_pattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]{8,}$/;
let message = "";

/* span element */


const span_error = document.createElement('span')
span_error.innerText = ""
span_error.id = 'error'


function pwd_usernameValidation(element) {
    console.log(element)

    if (!username_pattern.test(element.username.value) || element.username.value == null) {
        message += "Username non valido. "

    }

    if (!password_pattern.test(element.password.value)) {
        message += " Password non valida. "
    }

    if (element == login_form) {
        return messageCheck(login_form)
    }
}



const email_pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

function signup_validation() {


    if (!email_pattern.test(signup_form.mail.value)) {
        message += "Email non valida. "
        console.log(message)
    }

    if (signup_form.password.value != signup_form.password_confirmation.value) {
        message += "Le password non coincidono. "
    }

    pwd_usernameValidation(signup_form)
    console.log(message)

    return messageCheck(signup_form)



}



function messageCheck(parent) {
    if (message != "") {
        span_error.textContent = message
        parent.parentElement.append(span_error)
        return false

    }
    else {
        return true
    }
}

login_form.addEventListener('submit', (e) => {

    message = ""
    if (!pwd_usernameValidation(login_form))
        e.preventDefault()
})
signup_form.addEventListener('submit', (e) => {
    message = ""

    if (!signup_validation())
        e.preventDefault()
})


