import Tippy from 'tippy.js';
const $ = jQuery;

$(document).ready(createTooltips);

function createTooltips() {
    new Tippy('.tooltip', {
        position: 'right',
        animation: 'scale',
        duration: 1000,
        arrow: true
    });
}