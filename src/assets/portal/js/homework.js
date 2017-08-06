jQuery(document).ready(function($) {

    init();

    function init() {
        $('body').on('click', '.no-homework', enterNoHomework);

        $('form.weekly_homework')
            .find('textarea')
            .each(addNoHomeworkButton);
    }

    function addNoHomeworkButton() {
        var $this = $(this);

        $this.wrap('<div class="textarea-wrapper"></div>').parents('div').first().prepend('<button type="button" class="btn btn-sm btn-default no-homework single pull-right">No Homework</button>');
    }

    function enterNoHomework(event) {
        var $this = $(this);
        var parent = $this.hasClass('single') ? '.textarea-wrapper' : 'form';

        $this.parents(parent)
            .first()
            .find('textarea')
            .each(fillInNoHomework);
    }

    function fillInNoHomework() {
        var $this = $(this);

        $this.val('—');
    }
});