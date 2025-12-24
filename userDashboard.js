const logoClicked = document.querySelector(".logo");

document.addEventListener('DOMContentLoaded',() =>{
    if(logoClicked){
        logoClicked.addEventListener('click', () =>{
            window.location.href = "home.php";
        })
    }




const EditBtn = document.querySelector(".editbtn");

document.addEventListener('DOMContentLoaded',() =>{
    if(EditBtn){
        EditBtn.addEventListener('click', () =>{
            window.location.href = "UserEditProfile.php";
        })
    }
});
