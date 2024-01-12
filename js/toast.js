const toastButton = document.querySelectorAll('#toast-button');
const toastContent = document.querySelector('.warning');

const toast = new bootstrap.Toast(toastContent);

toastButton.forEach((item) => {
    item.addEventListener('click', () => {
        localStorage.setItem('toast', 'yes');
    })
})

if (localStorage.getItem('toast')) {
    toast.show();
    localStorage.removeItem('toast');
}