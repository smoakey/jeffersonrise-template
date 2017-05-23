import _ from 'lodash';
import Pikaday from 'pikaday';
import moment from 'moment';

import '../scss/index.scss';

const $ = jQuery;
var newsDates = [];

$(document).ready(init);

function init() {
    $(window).on('resize', _.debounce(setMainMargin, 500)).trigger('resize');
    $(window).on('scroll', _.throttle(handleWindowScroll, 500));
    $('.menu-trigger').on('click', toggleMenu);
    $('.menu a').on('click', toggleSubMenus);

    createCalendar();
}

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
        .then(setNewsDates)
        .then(renderDatesInCalendar);
}

function processNewsPosts(newsItem) {
    return _.map(newsItem, item => {
        return {
            title: _.get(item, 'title.rendered'),
            date: _.get(item, 'meta.date')
        };
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
            $button.attr('title', 'Today');
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
            $button.attr('title', title);
        }
    });
}

function searchNewsPostsByDate(date) {
    window.location.href = `${window.location.origin}/news/?date=${date}`;
}

function setMainMargin() {
    const body = $('body');
    const header = $('header');
    const main = $('main');

    if (body.hasClass('home')) return;

    main.css('padding-top', header.outerHeight());
}

function handleWindowScroll() {
    const header = $('header');
    const body = $('body');

    if (body.scrollTop() > 0) {
        header.addClass('scrolled');
    } else {
        header.removeClass('scrolled')
    }
}

function toggleMenu(event) {
    event.preventDefault();

    if ($(this).hasClass('active') && $('body').scrollTop() == 0) {
        $('header').removeClass('scrolled');
    } else {
        $('header').addClass('scrolled');
    }

    $(this).toggleClass('active');
    $('header .menu').toggle();
}

function toggleSubMenus(event) {
    var $this = $(this);
    var next = $this.next();
    var windowWidth = $(window).width();
    if (next.hasClass('sub-menu') && windowWidth <= 1080) {
        event.preventDefault();
        $this.toggleClass('active')
        next.slideToggle();
    }
}