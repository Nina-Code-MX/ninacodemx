
/**
 * Request a Quote
 * 
 * @returns boolean
 */
import intlTelInput from 'intl-tel-input';

const VITE_GOOGLE_RECAPTCHA_KEY = import.meta.env.VITE_GOOGLE_RECAPTCHA_KEY;

window.VITE_GOOGLE_RECAPTCHA_KEY = VITE_GOOGLE_RECAPTCHA_KEY;
window.intlTelInput = intlTelInput;