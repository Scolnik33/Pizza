const number = document.querySelectorAll('.btn-number');
const price = document.querySelectorAll('.pizza-price')
const sum = document.querySelector('.sum');

let totalAmount = 0;

for (let i = 0; i < price.length; i++) {
    let currentSum = price[i].innerHTML.slice(0, 3) * number[i].innerHTML;
    totalAmount += currentSum;
    sum.innerHTML = totalAmount;
}