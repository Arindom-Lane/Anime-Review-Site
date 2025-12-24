document.addEventListener('DOMContentLoaded', () => {
    const logoClicked = document.querySelector(".logo");
    const editBtn = document.querySelector(".editbtn");

    if (logoClicked) {
        logoClicked.addEventListener('click', () => {
            window.location.href = "home.php";
        });
    }

    if (editBtn) {
        editBtn.addEventListener('click', () => {
            window.location.href = "UserEditProfile.php";
        });
    }
});