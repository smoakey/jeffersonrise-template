jQuery(document).ready(function($) {

    init();

    function init() {
        $('.announcements-wrapper').on('click', '.close', closeAnnouncement);
    }

    function closeAnnouncement(event) {
        event.preventDefault();
        var $this = $(this);
        var id = $this.data('announcement-id');
        createCookie('announcement-' + id + '-closed', 1);
    }

    function createCookie(name, value) {
        document.cookie = name + "=" + value;
    }
});