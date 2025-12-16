const logoClicked = document.querySelector(".logo");

document.addEventListener('DOMContentLoaded',() =>{
    if(logoClicked){
        logoClicked.addEventListener('click', () =>{
            window.location.href = "home.php";
        })
    }


})