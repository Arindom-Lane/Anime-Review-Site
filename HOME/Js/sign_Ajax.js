  const emailInput = document.getElementById('email');
    const emailMsg = document.getElementById('email-msg');
    emailInput.addEventListener('input', function() {
        const emailVal = emailInput.value.trim();
        const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
        if (emailVal === '') {
            emailMsg.textContent = '';
        }
        else if (emailPattern.test(emailVal)) {
            emailMsg.textContent = 'Valid email format!';
            emailMsg.className = 'msg-success';
        } else {
            emailMsg.textContent = 'Invalid email address format.';
            emailMsg.className = 'msg-error';
        }
    });

    const passInput = document.getElementById('password');
    const confirmPassInput = document.getElementById('confirm_password');
    const passMsg = document.getElementById('pass-msg');

    function checkPasswordMatch() {
        if (confirmPassInput.value === '') {
            passMsg.textContent = '';
        }
        else if (passInput.value === confirmPassInput.value) {
            passMsg.textContent = 'Passwords match!';
            passMsg.className = 'msg-success';
        } else {
            passMsg.textContent = 'Passwords do not match.';
            passMsg.className = 'msg-error';
        }
    }

    passInput.addEventListener('input', checkPasswordMatch);
    confirmPassInput.addEventListener('input', checkPasswordMatch);


    const passwordInput = document.getElementById('password');
const passwordMsg = document.getElementById('password-msg');

passwordInput.addEventListener('input', function() {
    if (passwordInput.value.length === 0) {
        passwordMsg.textContent = '';
    }
    else if (passwordInput.value.length < 8) {
        passwordMsg.textContent = 'Password must be at least 8 characters.';
        passwordMsg.className = 'msg-error';
    } else {
        passwordMsg.textContent = 'Password length is valid.';
        passwordMsg.className = 'msg-success';
    }
});