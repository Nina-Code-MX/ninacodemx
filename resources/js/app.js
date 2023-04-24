import './bootstrap';
import 'flowbite';
import './swal2'

document.addEventListener('DOMContentLoaded', () => {
	document.querySelectorAll('[data-lang-switcher]').forEach((el) => {
		el.addEventListener('click', (e) => {
			e.preventDefault();
			e.stopPropagation();

			document.getElementById('lang_switcher_value').value = el.dataset.langValue || 'es';
			document.getElementById('lang_switcher_form').submit();
		});
	});
});

let navBar = document.getElementById('mainNavBar');

function stickyNav(scrollY) {
	if (window.innerWidth > 1024) {
		if (scrollY >= 64) {
			navBar.classList.add('bg-navbar');
			navBar.classList.remove('bg-navbar-off');
		} else {
			navBar.classList.add('bg-navbar-off');
			navBar.classList.remove('bg-navbar');
		}
	}
}

window.onscroll = function() {
	stickyNav(window.scrollY);
};

stickyNav(window.scrollY);
