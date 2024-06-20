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


const login_btn = document.getElementById("login-btn");
const signup_btn = document.getElementById("signup-btn");

const signup_form = document.querySelector(".signup-form");
const login_form = document.querySelector(".login-form");
const form_container = document.getElementById("signup-container")
const submit = document.getElementById('signup-submit')


let message = "";

function changeForm(event) {


    if (event == "login") {
        login_form.classList.remove("translate_sign")
        signup_form.classList.remove("translate_log")
        signup_form.classList.toggle("hidden")
        login_btn.classList.toggle("clicked")
        login_btn.disabled = 'disabled'
        signup_btn.disabled = ''
        signup_btn.classList.remove("clicked")

        message = ""
        span_error.innerText = ""

    }
    else if (event == 'signup') {
        login_form.classList.toggle("translate_sign")
        signup_form.classList.remove("hidden")
        signup_form.classList.toggle("translate_log")
        signup_btn.classList.toggle("clicked")
        signup_btn.disabled = 'disabled'
        login_btn.disabled = ''

        message = ""
        span_error.innerText = ""

        login_btn.classList.remove("clicked")
    }
}


const username_pattern = /^[a-zA-Z0-9]{5,10}$/;
const password_pattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]{8,}$/;

/* span element */

const username_input = document.getElementById('Username')


const span_error = document.createElement('span')
span_error.id = 'error'


function pwd_usernameValidation(element) {
    console.log(element)

    if (!username_pattern.test(element.username.value) || login_form.username.value == null) {
        message += "Username non valido. "

    }

    if (!password_pattern.test(element.pwd.value)) {
        message += " Password non valida. "
    }

    if (element == login_form) {
        return messageCheck("Login", login_form)
    }
}



const email_pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

function signup_validation() {


    if (!email_pattern.test(signup_form.mail.value)) {
        message += "Email non valida. "
        console.log(message)
    }

    if (signup_form.pwd.value != signup_form.pwd_confirm.value) {
        message += "Le password non coincidono. "
    }

    pwd_usernameValidation(signup_form)
    console.log(message)

    return messageCheck("Sign Up", signup_form)



}



function messageCheck(event, parent) {
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
