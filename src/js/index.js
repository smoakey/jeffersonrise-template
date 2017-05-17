import '../scss/index.scss';
import _ from 'lodash';

const $ = jQuery;

$(document).ready(init);

function init() {


    $(window).on('scroll', _.debounce(handleWindowScroll, 100));
    $('.menu-trigger').on('click', toggleMenu);
    $('.menu a').on('click', toggleSubMenus);
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
    $('header .menu').slideToggle();
}

function toggleSubMenus(event) {
    event.preventDefault();
    var $this = $(this);
    var next = $this.next();
    var windowWidth = $(window).width();
    if (next.hasClass('sub-menu') && windowWidth <= 1080) {
        next.slideToggle();
    }
}