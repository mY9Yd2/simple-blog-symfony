import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import './styles/app.css';
import { formatTimeElements } from './js/timeFormatter.js';

document.addEventListener('DOMContentLoaded', () => {
    formatTimeElements();
});
