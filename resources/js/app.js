import './bootstrap';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

// Only initialize Echo if keys are available
const reverbKey = import.meta.env.VITE_REVERB_APP_KEY;
const reverbHost = import.meta.env.VITE_REVERB_HOST || 'localhost';
const reverbPort = import.meta.env.VITE_REVERB_PORT || 8080;

if (reverbKey) {
    window.Echo = new Echo({
        broadcaster: 'reverb',
        key: reverbKey,
        wsHost: reverbHost,
        wsPort: reverbPort,
        wssPort: reverbPort,
        forceTLS: false,
        enabledTransports: ['ws', 'wss'],
    });
    console.log('Laravel Echo initialized with Reverb');
} else {
    console.warn('VITE_REVERB_APP_KEY not set. Echo not initialized.');
    console.warn('Please set VITE_REVERB_APP_KEY, VITE_REVERB_HOST, VITE_REVERB_PORT in .env');
}
