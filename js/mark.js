const btnPlus = document.querySelectorAll('.btn-plus');
const btnMinus = document.querySelectorAll('.btn-minus');
const mark = document.getElementsByName('mark');

btnPlus.forEach((item) => {
    item.addEventListener('click', () => {
        mark.forEach((item) => {
            item.value = '+';
        })
    })
})

btnMinus.forEach((item) => {
    item.addEventListener('click', () => {
        mark.forEach((item) => {
            item.value = '-';
        })
    })
})