
    const fallList = document.querySelector(".fallList");
    const rightArrowFallList = document.querySelector(".right-arrowfallList"); 
    const leftArrowFallList = document.querySelector(".left-arrowfallList"); 

    const latestList = document.querySelector(".latestList");
    const rightArrowLatest = document.querySelector(".right-arrowlatest");
    const leftArrowLatest = document.querySelector(".left-arrowlatest");
    
    const scrollAmmountFall = 600;

    const goTOprofilePage = document.querySelector(".profile");


document.addEventListener('DOMContentLoaded', () => {

    if(rightArrowFallList){
        rightArrowFallList.addEventListener('click', () => { 
            fallList.scrollLeft += scrollAmmountFall;
        });
    }

    if (leftArrowFallList){
        leftArrowFallList.addEventListener('click', () => { 
            fallList.scrollLeft -= scrollAmmountFall;  
        })
    }


    const scrollAmmountLatest = 600;
    if(rightArrowLatest){
        rightArrowLatest.addEventListener('click', () => { 
            latestList.scrollLeft += scrollAmmountLatest;
        })
    }

    if (leftArrowLatest){
        leftArrowLatest.addEventListener('click', () => { 
            latestList.scrollLeft -= scrollAmmountLatest;  
        })
    }
})