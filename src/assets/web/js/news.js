import _ from 'lodash';
import Pikaday from 'pikaday';
import Tippy from 'tippy.js';

const $ = jQuery;
var newsDates = [];

$(document).ready(createCalendar);

function createCalendar() {
    if (!$('#calendar').length) {
        return;
    }

    var picker = new Pikaday({
        field: $('#calendar-input').get(0),
        bound: false,
        container: $('#calendar').get(0),
        onDraw: () => renderDatesInCalendar(newsDates),
        onSelect: () => searchNewsPostsByDate(picker.toString('YYYY-MM-DD'))
    });

    $.get('/wp-json/wp/v2/news')
        .then(processNewsPosts)
        .then(filterWebNewsPosts)
        .then(setNewsDates)
        .then(renderDatesInCalendar);
}

function processNewsPosts(newsItem) {
    return _.map(newsItem, item => {
        return {
            title: _.get(item, 'title.rendered'),
            date: _.get(item, 'meta.date'),
            location: _.get(item, 'meta.location')
        };
    });
}

function filterWebNewsPosts(newsItems) {
    return _.filter(newsItems, item => {
        return item.location != 'Portal';
    });
}

function setNewsDates(dates) {
    newsDates = dates;
    return dates;
}

function renderDatesInCalendar(dates) {
    if (!dates.length) {
        return
    }

    var calendar = $('#calendar').find('.pika-table');
    var cells = calendar.find('td');
    _.each(cells, cell => {
        var $cell = $(cell)
        var $button = $cell.find('button');
        var data = $button.data();
        if (!data) return;

        // add today tooltip
        if ($cell.hasClass('is-today')) {
            $button.addClass('tooltip').attr('title', 'Today');
        }

        // fix zero indexed months in pikaday
        data.pikaMonth++

        // build date string based on pikaday data attrs
        var year = data.pikaYear;
        var month = _.padStart(data.pikaMonth, 2, '0');
        var day = _.padStart(data.pikaDay, 2, '0');
        var cellDate = `${year}-${month}-${day}`;

        var eventsForCellDate = _.chain(dates)
            .filter({ date: cellDate })
            .map('title')
            .value();

        if (eventsForCellDate.length) {
            var title = `${eventsForCellDate.length} Event(s): ${eventsForCellDate.join(', ')}`;

            $cell.addClass('has-event');
            $button.addClass('tooltip').attr('title', title);
            setTimeout(createTooltips, 1000);
        }
    });
}

function searchNewsPostsByDate(date) {
    window.location.href = `${window.location.origin}${window.location.pathname}?date=${date}`;
}

function createTooltips() {
    new Tippy('.tooltip', {
        arrow: true,
        appendTo: document.body
    });
}