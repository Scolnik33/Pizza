window.addEventListener('unload', () => localStorage.setItem('scrollY', window.scrollY));
window.scroll(0, localStorage.getItem('scrollY'));

const scrollTop = (mainItem, removeItemFirst, removeItemSecond) => {
    window.addEventListener('DOMContentLoaded', () => {
        localStorage.setItem(mainItem, 'loaded');
    })
    if (!localStorage.getItem(mainItem)) {
        window.scroll(0, 0);
    }
    localStorage.removeItem(removeItemFirst);
    localStorage.removeItem(removeItemSecond)
}   

if (window.location.pathname == '/recyclebin.php') {
    scrollTop('statusRecycleBin', 'statusMainPage', 'statusOnePizza');
} else if (window.location.pathname == '/index.php') {
    scrollTop('statusMainPage', 'statusOnePizza', 'statusRecycleBin');
} else if (window.location.pathname == '/onePizza.php') {
    scrollTop('statusOnePizza', 'statusRecycleBin', 'statusMainPage');
}