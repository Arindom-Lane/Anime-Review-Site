document.addEventListener('DOMContentLoaded', () => {
    const fallList = document.querySelector(".fallList");
    const rightArrowFallList = document.querySelector(".right-arrowfallList"); // Changed to match CSS
    const leftArrowFallList = document.querySelector(".left-arrowfallList"); // Changed to match CSS

    const latestList = document.querySelector(".latestList");
    const rightArrowLatest = document.querySelector(".right-arrowlatest");
    const leftArrowLatest = document.querySelector(".left-arrowlatest");
    

    const scrollAmmountFall = 600;
    if(rightArrowFallList){
        rightArrowFallList.addEventListener('click', () => { // Fixed variable name
            fallList.scrollLeft += scrollAmmountFall;
        });
    }

    if (leftArrowFallList){
        leftArrowFallList.addEventListener('click', () => { // Fixed variable name
            fallList.scrollLeft -= scrollAmmountFall;  
        });
    }


    const scrollAmmountLatest = 600;
    if(rightArrowLatest){
        rightArrowLatest.addEventListener('click', () => { // Fixed variable name
            latestList.scrollLeft += scrollAmmountLatest;
        });
    }

    if (leftArrowLatest){
        leftArrowLatest.addEventListener('click', () => { // Fixed variable name
            latestList.scrollLeft -= scrollAmmountLatest;  
        });
    }
});