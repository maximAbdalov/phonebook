
var contactUrl = "/phonebook/users/ajax";
var newContactUrl = "/phonebook/users/new";
var waitMessage = "Пожалуйста подождите";
var partialBlock = $('.partial');
$(document).ready(function () {
    bindActions();
    select2Init();

    $('.new-item').click(function (e) {
        waitingDialog.show(waitMessage);
        e.preventDefault();
        var newForm = $('#new-form');
        var editModal = $('.neweditable');
        $(editModal).load(newContactUrl + ' #ajax-load', function () {
            waitingDialog.hide();
            $(newForm).modal('show');
            select2Init();
            $('form.new-form').on('submit', function (e) {
                $(newForm).modal('hide');
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: $(this).attr('action'),
                    data: $('form.new-form').serialize(),
                    success: function () {
                        updateContent();
                    }
                });

            });
        });
    });

});


function bindActions() {
    $('.remove').click(function (e) {
        e.preventDefault();
        if (confirm('Вы действительно хотите удалить контакт?')) {
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'GET',
                success: function (res) {
                    updateContent();
                }
            });
        }
    });
    $('.edit').click(function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var editModal = $('.editable');
        waitingDialog.show(waitMessage);
        $(editModal).load(url + ' #ajax-load', function () {
            waitingDialog.hide();
            $('#edit').modal('show');
            select2Init();
            $('form.edit-form').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: $(this).attr('action'),
                    data: $('form.edit-form').serialize(),
                    success: function () {
                        updateContent();
                        $('#edit').modal('hide');
                    }
                });

            });
        });
    });
}

function updateContent() {
    waitingDialog.show(waitMessage);
    $.ajax({
        url: contactUrl,
        type: 'GET',
        success: function (res) {
            $(partialBlock).html(res);
            waitingDialog.hide();
        }
    });
}

function select2Init() {
    $('.selector').select2({
        tags: true
    });
}
