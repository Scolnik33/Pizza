const popupButton = document.querySelectorAll('#popup-button');
const popupContent = document.querySelector('.popup');

popupButton.forEach((item) => {
    item.addEventListener('click', () => {
        const toast = new bootstrap.Toast(popupContent);
        toast.show();
    })
})