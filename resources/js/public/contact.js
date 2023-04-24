/**
 * Contact Form
 * 
 * @returns boolean
 */
const contactForm = async () => {
	const VITE_ABSTRACTAIP_API_KEY = import.meta.env.VITE_ABSTRACTAIP_API_KEY;
	const VITE_GOOGLE_RECAPTCHA_KEY = import.meta.env.VITE_GOOGLE_RECAPTCHA_KEY;

	let gRecaptcha = document.getElementById('g-recaptcha');
	let uIp = document.getElementById('u-ip');

	if (!gRecaptcha || !uIp) {
		return false;
	}

	grecaptcha.enterprise.ready(() => {
		grecaptcha.enterprise.execute(VITE_GOOGLE_RECAPTCHA_KEY, {action: 'contact'})
		.then(async (token) =>{
			const abstractaUrl = 'https://ipgeolocation.abstractapi.com/v1/?api_key=' + VITE_ABSTRACTAIP_API_KEY;
			const userIp = await fetch(abstractaUrl).then(res => res.json());

			gRecaptcha.value = token;
			uIp.value = userIp?.ip_address;

			Livewire.first().set('contact.recaptcha', token);
			Livewire.first().set('contact.ip', userIp?.ip_address);
		})
		.catch((error) => {
			console.error('contactForm error:', error);
		});
	});
}

document.addEventListener('DOMContentLoaded', () => {
	let dataContact = contactForm();
});
