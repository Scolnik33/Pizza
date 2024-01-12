const centimeter = document.querySelectorAll('.centimeter');

centimeter.forEach((item) => {
    if (item.innerHTML == '/ 0 см') {
        item.classList.add('invisible')
    }
})
