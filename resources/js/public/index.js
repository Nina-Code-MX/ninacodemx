
/**
 * Register for Newsletter
 * 
 * @returns boolean
 */
const registerNewsletter = () => {
	const VITE_ABSTRACTAIP_API_KEY = import.meta.env.VITE_ABSTRACTAIP_API_KEY;
	const VITE_GOOGLE_RECAPTCHA_KEY = import.meta.env.VITE_GOOGLE_RECAPTCHA_KEY;
	const email = document.getElementById('newsltter-email').value;
	const submit = document.getElementById('newsltter-submit');
	const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

	submit.disabled = true;

	if (!email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)) {
		Swal.fire({
			title: 'Correo electrónico inválido',
			text: 'El correo electrónico <' + email + '> es inválido.',
			icon: 'warning',
			confirmButtonText: 'Aceptar',
		});

		submit.disabled = false;

		return false;
	}

	grecaptcha.enterprise.ready(function() {
		grecaptcha.enterprise.execute(VITE_GOOGLE_RECAPTCHA_KEY, {action: 'subscribe'}).then(async function(token) {
			const abstractaUrl = 'https://ipgeolocation.abstractapi.com/v1/?api_key=' + VITE_ABSTRACTAIP_API_KEY;
			const userIp = await fetch(abstractaUrl)
				.then(res => res.json());

			const response = await fetch('/api/v1/mailchimp/newsltetter', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({reCaptcha: token, userIp: userIp?.ip_address, email: email, _token: csrfToken}),
			})
			.then(res => res.json())
			.then(data => {
				Swal.fire({
					title: data.title,
					text: data.text,
					icon: data.icon,
					confirmButtonText: 'Aceptar',
				});

				submit.disabled = false;
			})
			.catch(error => {
				console.error('Error:', error);
				submit.disabled = false;
			});
		});
	});

	return false;
};

/**
 * Init Google Maps
 * 
 * @returns void
 */
const initMap = () => {
	let windowSize = window.outerWidth;
	let zoom = 10;

	if (windowSize < 768) {
		zoom = 8;
	} else if (windowSize < 1400) {
		zoom = 9;
	}

	// For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
	let mapOptions = {
		zoom: zoom,
		center: new google.maps.LatLng(20.671282, -104.375625),
		styles: [
			{ "featureType": "all", "elementType": "geometry.fill", "stylers": [{"weight": "2.00"}] },
			{ "featureType": "all", "elementType": "geometry.stroke", "stylers": [{"color": "#9c9c9c"}] },
			{ "featureType": "all", "elementType": "labels.text", "stylers": [{"visibility": "on"}] },
			{ "featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"}] },
			{ "featureType": "landscape", "elementType": "geometry.fill", "stylers": [{"color": "#ffffff"}] },
			{ "featureType": "landscape.man_made", "elementType": "geometry.fill", "stylers": [{"color": "#ffffff"}] },
			{ "featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"}] },
			{ "featureType": "road", "elementType": "all", "stylers": [{"saturation": -100},{"lightness": 45}] },
			{ "featureType": "road", "elementType": "geometry.fill", "stylers": [{"color": "#eeeeee"}] },
			{ "featureType": "road", "elementType": "labels.text.fill", "stylers": [{"color": "#7b7b7b"}] },
			{ "featureType": "road", "elementType": "labels.text.stroke", "stylers": [{"color": "#ffffff"}] },
			{ "featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"}] },
			{ "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"}] },
			{ "featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"}] },
			{ "featureType": "water", "elementType": "all", "stylers": [{"color": "#46bcec"},{"visibility": "on"}] },
			{ "featureType": "water", "elementType": "geometry.fill", "stylers": [{"color": "#c8d7d4"}] },
			{ "featureType": "water", "elementType": "labels.text.fill", "stylers": [{"color": "#070707"}] },
			{ "featureType": "water", "elementType": "labels.text.stroke", "stylers": [{"color": "#ffffff"}] }
		]
	};

	let mapElement = document.getElementById('map');
	let map = new google.maps.Map(mapElement, mapOptions);
	let customMarker = 'https://www.ninacode.mx/public/images/map-marker.png';
	let marker = new google.maps.Marker({
		position: new google.maps.LatLng(20.676989, -105.230116),
		map: map,
		icon: customMarker, 
		title: 'Puerto Vallarta'
	});
	let marker2 = new google.maps.Marker({
		position: new google.maps.LatLng(20.691071, -103.387020),
		map: map,
		icon: customMarker, 
		title: 'Guadalajara'
	});
}

document.addEventListener('DOMContentLoaded', function() {
	initMap();
});

window.registerNewsletter = registerNewsletter
