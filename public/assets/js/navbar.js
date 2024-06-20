const menu_button = document.getElementById('menu-button')
const menu_item = document.getElementById('menu-items')
const image_button = document.getElementById('image-button')
const navbar = document.getElementById('navbar')
const logo = document.getElementById('logo')




function dropdown() {
    console.log("dropdown")

    image_button.classList.toggle("clicked-button")
    menu_item.classList.toggle('show')
    navbar.classList.toggle('show')
    logo.classList.toggle('show')


}
menu_button.addEventListener('mouseenter', dropdown)

window.onclick = function (event) {
    if (!event.target.matches('#menu-button')) { // Verifica se l'elemento è button-menu
        menu_button.classList.remove('show')

    }
}