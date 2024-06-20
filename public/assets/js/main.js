

console.log("main js avviato")


const leftContainer = document.querySelector('.left-container')
const rightContainer = document.querySelector('.right-container')
const description = document.querySelector('.description')




/* apre il container soggetto all'evento */
function openContainer(element) {

    /* selezione l'elemento corrente soggetto all'evento */
    const container = element.currentTarget

    const trailer = container.querySelector('.trailer') /* seleziono il trailer figlio del container attuale*/

    container.classList.toggle('description-hover')
    trailer.classList.toggle('show')
}

/* chiude il container soggetto all'evento */
function closeContainer(element) {

    /* selezione l'elemento corrente soggetto all'evento */
    const container = element.currentTarget

    const trailer = container.querySelector('.trailer') /* seleziono il trailer figlio del container attuale*/

    container.classList.remove('description-hover')
    trailer.classList.remove('show')
}

leftContainer.addEventListener('mouseenter', openContainer)
leftContainer.addEventListener('mouseleave', closeContainer)

rightContainer.addEventListener('mouseenter', openContainer)
rightContainer.addEventListener('mouseleave', closeContainer)

leftContainer.addEventListener('click', openContainer)
rightContainer.addEventListener('click', openContainer)


let slideIndex = 0;
showSlides();


function showSlides() {
    let i;
    let slides = document.getElementsByClassName("photo");
    const dots = document.getElementsByClassName("dot")
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;

    for (i = 0; i < dots.length; i++)
        dots[i].className = dots[i].className.replace("active", "");

    if (slideIndex > slides.length) { slideIndex = 1 }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    setTimeout(showSlides, 5000);


}





