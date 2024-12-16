import './bootstrap';
import '../css/app.css';

import { createApp } from 'vue';
import LoginComponent from './components/LoginComponent.vue';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';


document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        events: [
            // Example events
            { title: 'Event 1', start: '2024-12-12' },
            { title: 'Event 2', end: '2024-12-15' }
        ],
    });
    calendar.render();
});


const app = createApp({});
app.component('logincomponent', LoginComponent);
app.mount('#app');
