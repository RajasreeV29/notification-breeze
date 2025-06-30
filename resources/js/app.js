import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;


// jQuery and jQuery Validate setup
import $ from 'jquery';
import 'jquery-validation';

// Make jQuery globally available (for external scripts or inline Blade)
window.$ = $;
window.jQuery = $;

// Optional: Log to verify
console.log('jQuery version (from app.js):', $.fn.jquery);
console.log('Validate plugin loaded:', typeof $.fn.validate !== "undefined");

Alpine.start();
