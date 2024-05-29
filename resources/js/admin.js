import './bootstrap';
import 'flowbite';
import './swal2';

function toggleMainNav() {
    const mainNav = document.getElementById('mainNav');
    const ol = mainNav.querySelector('ol');

    if (ol) {
        ol.classList.toggle('hidden');
    }
    
    const currItems = this.querySelector('span').textContent;

    if (currItems === 'menu') {
        this.querySelector('span').textContent = 'menu_open';
    } else {
        this.querySelector('span').textContent = 'menu';
    }
}

document.getElementById('mainNavBurger').addEventListener('click', toggleMainNav);

document.addEventListener('click', function(event) {
    const mainNav = document.getElementById('mainNav');
    const ol = mainNav.querySelector('ol');

    if (ol && !ol.classList.contains('hidden')) {
        if (!mainNav.contains(event.target)) {
            ol.classList.add('hidden');
            document.getElementById('mainNavBurger').querySelector('span').textContent = 'menu';
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.btn-action');

    buttons.forEach(button => {
        button.addEventListener('click', function (event) {
            document.querySelectorAll('.action-menu').forEach(menu => {
                menu.classList.add('hidden');
            });

            const menu = this.nextElementSibling;
            menu.classList.toggle('hidden');
            event.stopPropagation();
        });
    });

    document.addEventListener('click', function (event) {
        buttons.forEach(button => {
            const menu = button.nextElementSibling;
            if (!menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    });
});