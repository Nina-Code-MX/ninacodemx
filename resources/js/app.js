import './bootstrap';
import 'flowbite';
import './swal2'

let navBar = document.getElementById('mainNavBar');
let navBarBrand = document.getElementById('mainNavBarBrand');

function stickyNav(scrollY) {
	if (scrollY >= 64) {
		navBar.classList.add('bg-navbar');
		navBar.classList.remove('bg-navbar-off');
	} else {
		navBar.classList.add('bg-navbar-off');
		navBar.classList.remove('bg-navbar');
	}
}

window.onscroll = function() {
	stickyNav(window.scrollY);
};

stickyNav(window.scrollY);
