const themeToggleBtn = document.getElementById('theme-toggle');
const body = document.body;

themeToggleBtn.addEventListener('click', () => {
    body.classList.toggle('dark-theme');

    if (body.classList.contains('dark-theme')) {
        localStorage.setItem('theme', 'dark');
    } else {
        localStorage.setItem('theme', 'light');
    }
});
if (localStorage.getItem('theme') == 'dark') {
    body.classList.add('dark-theme');
}
if (localStorage.getItem('theme') == 'light'){
    body.classList.remove('dark-theme');
}
