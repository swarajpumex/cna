
(function ($, window, document, undefined) {
    'use strict';
    // Contact Form
    var $form = $('#contact_form');

    $form.submit(function (e) {
        // remove the error class
        $('.form_group').removeClass('has-error');
        $('.help-block').remove();

        // get the form data
        var formData = {
            'name' : $('input[name="t_name"]').val(),
            'email' : $('input[name="t_email"]').val(),
            'weblink' : $('input[name="web_link"]').val(),
            'message' : $('textarea[name="t_massage"]').val()
        };

        // process the form
        $.ajax({
            type : 'POST',
            url  : 'process.php',
            data : formData,
            dataType : 'json',
            encode : true
        }).done(function (data) {
            // handle errors
            if (!data.success) {
                if (data.errors.name) {
                    $('#name_field').addClass('has-error');
                    $('#name_field').find('.input_field').append('<span class="help-block">' + data.errors.name + '</span>');
                }
                if (data.errors.email) {
                    $('#eamil_field').addClass('has-error');
                    $('#eamil_field').find('.input_field').append('<span class="help-block">' + data.errors.email + '</span>');
                }
                 if (data.errors.email) {
                    $('#link_field').addClass('has-error');
                    $('#link_field').find('.input_field').append('<span class="help-block">' + data.errors.email + '</span>');
                }
                if (data.errors.message) {
                    $('#massage_field').addClass('has-error');
                    $('#massage_field').find('.input_field').append('<span class="help-block">' + data.errors.message + '</span>');
                }
            } else {
                // display success message
                $form.html('<div class="alert alert-success">' + data.message + '</div>');
            }
        }).fail(function (data) {
            // for debug
            console.log(data)
        });

        e.preventDefault();
    });
}(jQuery, window, document));
