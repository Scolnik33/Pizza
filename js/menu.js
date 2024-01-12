const menu = document.querySelector('.menu');
const navs = document.querySelectorAll('.nav_item');

navs.forEach((item) => {
    item.addEventListener('click', () => {
        menu.classList.remove('show');
    })
})