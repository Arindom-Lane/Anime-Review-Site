document.addEventListener('DOMContentLoaded', () => {
    const fallList = document.querySelector(".fallList");
    const rightArrow = document.querySelector(".right-arrow");
    const leftArrow = document.querySelector(".left-arrow");

    const scrollAmmount = 600;
    if(rightArrow){
    rightArrow.addEventListener('click', () => {
        fallList.scrollLeft += scrollAmmount;
    });
}

    if (leftArrow){
    leftArrow.addEventListener('click', () => {
        fallList.scrollLeft += scrollAmmount;  
    });
}
});