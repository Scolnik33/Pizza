let size = document.querySelectorAll('.btn-price');
const price = document.querySelector('.pizza-price');
const plus = document.querySelector('.btn-plus');
const minus = document.querySelector('.btn-minus');
const numberString = document.querySelector('.btn-number');
const btn = document.querySelector('.btn-recyclebin-one-pizza');
let number = Number(numberString.innerHTML);
let priceNumber = Number(price.innerHTML.slice(0, 3));

const fieldToPost = document.querySelectorAll('.post');
let f = true;

btn.addEventListener('click', () => {
    fieldToPost.forEach((item) => {
        if (item.name == 'size') {
            item.value = size;
        } else if (item.name == 'price') {
            item.value = priceNumber;
        } else {
            item.value = number;
        }
    })
})

size.forEach((item) => {
    if (f) {
        size = item.innerHTML.slice(0, 3);
        f = false;
    }
    item.addEventListener('click', (e) => {
        size = item.innerHTML.slice(0, 3);
        price.innerHTML = e.target.dataset.price * number + " P";
        priceNumber = e.target.dataset.price;
    })
})

plus.addEventListener('click', () => {
    number += 1;
    numberString.innerHTML = number;
    price.innerHTML = priceNumber * number + " P";
})

minus.addEventListener('click', () => {
    if (number > 1) {
        number -= 1;
        numberString.innerHTML = number;
        price.innerHTML = priceNumber * number + " P";
    }
})