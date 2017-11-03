jQuery(document).ready(function($) {

    init();

    function init() {
        $('body').on('click', '.no-homework', enterNoHomework);

        $('form.weekly_homework')
            .find('textarea')
            .each(addNoHomeworkButton);

        $('body').on('click', '.homework-delete', confirmHomeworkDeletion);

        $('body').on('click', '.homework-notes-delete', removeHomeworkNotes);
        $('form.weekly_homework').on('change', 'input[type="file"]', removeHomeworkNotes);

        $('#homework-add-edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var homework = button.data('homework');
            var modal = $(this);

            // only apply on edit
            if (!homework) {
                return;
            }

            modal.find('.modal-title').text('Edit Homework');

            $.each(homework, function (key, value) {
                if (key.indexOf('notes') < 1) {
                    var fixedValue = value.replace(/\\'/g, "'");
                    modal.find('[name="' + key + '"]').val(fixedValue);
                } else if (value) {
                    var notes = value.split(',');
                    var links = [];

                    $.each(notes, function (note) {
                        var name = value.split('/').splice(-1,1);
                        links.push('<div class="homework-notes">' + name + ' <a class="homework-notes-delete" href="#">Remove</a><input type="hidden" name="' + key + '" value="' + value + '" /></div>');
                    });

                    modal.find('[name="' + key + '[]"]').parents('.notes').find('.current-notes')
                        .html(links.join(''));
                }
            });
        });
    }

    function removeHomeworkNotes() {
        var $this = $(this);
        $this.parents('.homework-notes').remove();
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

    function confirmHomeworkDeletion(event) {
        if (!confirm('Are you sure you want to delete the homework? The action is not reversible.')) {
            event.preventDefault();
        }
    }
});