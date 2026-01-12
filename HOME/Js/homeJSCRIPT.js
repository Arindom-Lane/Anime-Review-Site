(function applyThemeEarly() {
    const theme = localStorage.getItem('theme');

    if (theme === 'dark') {
        document.documentElement.classList.add('dark-theme');
    } else {
        document.documentElement.classList.remove('dark-theme');
    }
})();


const fallList = document.querySelector(".fallList");
const rightArrowFallList = document.querySelector(".right-arrowfallList");
const leftArrowFallList = document.querySelector(".left-arrowfallList");

const latestList = document.querySelector(".latestList");
const rightArrowLatest = document.querySelector(".right-arrowlatest");
const leftArrowLatest = document.querySelector(".left-arrowlatest");

const trailersList = document.querySelector(".TrailersList");
const rightArrowTrailers = document.querySelector(".right-arrowTrailers");
const leftArrowTrailers = document.querySelector(".left-arrowTrailers");

const scrollAmount = 600;


const goTOprofilePage = document.querySelector(".profile");





document.addEventListener('DOMContentLoaded', () => {

    if (rightArrowFallList) {
        rightArrowFallList.addEventListener('click', () => {
            fallList.scrollLeft += scrollAmount;
        });
    }

    if (leftArrowFallList) {
        leftArrowFallList.addEventListener('click', () => {
            fallList.scrollLeft -= scrollAmount;
        })
    }



    if (rightArrowLatest) {
        rightArrowLatest.addEventListener('click', () => {
            latestList.scrollLeft += scrollAmount;
        })
    }

    if (leftArrowLatest) {
        leftArrowLatest.addEventListener('click', () => {
            latestList.scrollLeft -= scrollAmount;
        })
    }



    
    if (leftArrowTrailers) {
        leftArrowTrailers.addEventListener('click', () => {
            trailersList.scrollLeft -= scrollAmount;
        })
    }

    if (rightArrowTrailers) {
        rightArrowTrailers.addEventListener('click', () => {
            trailersList.scrollLeft += scrollAmount;
        })
    }
});



