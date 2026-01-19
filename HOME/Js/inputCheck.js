const name = document.getElementById('username');
const emailValue = document.getElementById('email').value;
const passwordValue = document.getElementById('password').value;
const confirm_passwordValue = document.getElementById('confirm_password').value;

const email_msg = document.getElementById('email-msg');
const name_msg = document.getElementById('name-msg');
const password_msg = document.getElementById('password-msg');
const pass_msg = document.getElementById('pass-msg');
const ajax_msg = document.getElementById('ajax-msg');



name.addEventListener('input', function () {
    const nameValue = document.getElementById('username').value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (nameValue.length < 4) {
                name_msg.style.removeProperty("color");
                name_msg.style.color = "#c5c5c5";
                name_msg.innerHTML = "Username should be at least 4 characters long.";
            } else {
                name_msg.style.removeProperty("color");
                name_msg.style.color = "#90EE90";
                name_msg.innerHTML = "perfect!";
            }

        }
    };
    xhttp.open("POST", "signUp.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username=" + encodeURIComponent(nameValue));
});
email.addEventListener('input', function () {
    const emailValue = document.getElementById('email').value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            if(emailValue.length === 0){
                email_msg.innerHTML = "";}
            else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue)) {
                email_msg.style.removeProperty("color");
                email_msg.style.color = "#c5c5c5";
                email_msg.innerHTML = "Please enter a valid email address.";
            }
             
            else {
                email_msg.style.removeProperty("color");
                email_msg.style.color = "#90EE90";
                email_msg.innerHTML = "perfect!";
            }

        }
    };
    xhttp.open("POST", "signUp.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("email=" + encodeURIComponent(emailValue));
});
password.addEventListener('input', function () {
    const passwordValue = document.getElementById('password').value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (passwordValue.length > 6) {
                if (!/[A-Z]/.test(passwordValue)) {
                    password_msg.style.removeProperty("color");
                    password_msg.style.color = "#c5c5c5";
                    password_msg.innerHTML = "Password should contain at least one uppercase letter.";
                }
                else if (!/[a-z]/.test(passwordValue)) {
                    password_msg.style.removeProperty("color");
                    password_msg.style.color = "#c5c5c5";
                    password_msg.innerHTML = "Password should contain at least one lowercase letter.";
                }
                else if (!/[0-9]/.test(passwordValue)) {
                    password_msg.style.removeProperty("color");
                    password_msg.style.color = "#c5c5c5";
                    password_msg.innerHTML = "Password should contain at least one digit.";
                }
                else {
                    password_msg.style.removeProperty("color");
                    password_msg.style.color = "#90EE90";
                    password_msg.innerHTML = "perfect!";
                }

            }
            else {
                password_msg.innerHTML = "";
            }

        }
    };
    xhttp.open("POST", "signUp.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("password=" + encodeURIComponent(passwordValue));
});
confirm_password.addEventListener('input', function () {
    const passwordValue = document.getElementById('password').value;
    const confirm_passwordValue = document.getElementById('confirm_password').value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            if (passwordValue !== confirm_passwordValue) {
                pass_msg.style.removeProperty("color");
                pass_msg.style.color = "#c5c5c5";
                pass_msg.innerHTML = "Passwords do not match.";
            }else if(confirm_passwordValue.length === 0){
                pass_msg.innerHTML = "";
            } 
            else {
                pass_msg.style.removeProperty("color");
                pass_msg.style.color = "#90EE90";
                pass_msg.innerHTML = "perfect!";
            }

        }
    };
    xhttp.open("POST", "signUp.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("confirm_password=" + encodeURIComponent(confirm_passwordValue));
});