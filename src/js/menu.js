import _ from 'lodash';

const $ = jQuery;

$(document).ready(init);

function init() {
    $(window).on('resize', _.debounce(setMainMargin, 500)).trigger('resize');
    $(window).on('scroll', _.throttle(handleWindowScroll, 500));
    $('.menu-trigger').on('click', toggleMenu);
    $('.menu a').on('click', toggleSubMenus);
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
