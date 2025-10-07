//  Dark Mode Style
let styleMode = localStorage.getItem('styleMode'); // было 'stileMode' — исправляем опечатку
const styleToggle = document.querySelector('.header-mode-switcher');

if (styleMode === 'dark') {
    enableDarkStyle();
}

function enableDarkStyle() {
    document.body.classList.add('dark-mode-gamestore');
    localStorage.setItem('styleMode', 'dark');
}

function disableDarkStyle() {
    document.body.classList.remove('dark-mode-gamestore');
    localStorage.setItem('styleMode', 'light');
}

if (styleToggle) {
    styleToggle.addEventListener('click', () => {
        // Перечитываем текущее значение при каждом клике
        const currentMode = localStorage.getItem('styleMode');

        if (currentMode !== 'dark') {
            enableDarkStyle();
        } else {
            disableDarkStyle();
        }
    });
}
