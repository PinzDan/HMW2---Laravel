

const leftContainer = document.querySelector('.left-container')
const rightContainer = document.querySelector('.right-container')
const description = document.querySelector('.description')




/* apre il container soggetto all'evento */
function toggleContainer(element) {


    const container = element.currentTarget

    const trailer = container.querySelector('.trailer')

    container.classList.toggle('description-hover')
    trailer.classList.toggle('show')
}

leftContainer.addEventListener('mouseenter', toggleContainer)
leftContainer.addEventListener('mouseleave', toggleContainer)

rightContainer.addEventListener('mouseenter', toggleContainer)
rightContainer.addEventListener('mouseleave', toggleContainer)



const backClass = document.querySelector(".back");
const forward = document.querySelector(".next");
const slides = document.getElementsByClassName("photo");
const dots = document.getElementsByClassName("dot");
let slideIndex = 1;

backClass.addEventListener("click", () => {
    slideIndex--;
    if (slideIndex < 1) {
        slideIndex = slides.length;
    }
    showSlides();
});

forward.addEventListener("click", () => {
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    showSlides();
});

showSlides();

function autoslides() {
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }
    showSlides();
    slideTimer = setTimeout(autoslides, 5000);
}


autoslides();

function showSlides() {
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (let i = 0; i < dots.length; i++) {
        dots[i].classList.remove("active");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].classList.add("active");
}




