jQuery(document).ready(function ($) {
    $('form#login').on('submit', function (e) {
        $('form#login p.status').show().text(ajax_login_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: {
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login #username').val(),
                'password': $('form#login #password').val(),
                'remember': $('form#login #remember-me').val(),
                'security': $('form#login #security').val()},
            success: function (data) {
                $('form#login p.status').text(data.message);
                if (data.loggedin == true) {
                    window.location.reload();
                }
            }
        });
        e.preventDefault();
    });
});
jQuery(document).ready(function ($) {
    $('form#register').on('submit', function (e) {
        $('form#register p.status').show().text(ajax_register_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_register_object.ajaxurl,
            data: {
                'action': 'ajaxregister', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#register #signup-username').val(),
                'email': $('form#register #signup-email').val(),
                'password': $('form#register #signup-password').val(),
                'cpassword': $('form#register #signup-password-confirm').val(),
                'security': $('form#register #security-register').val()},
            success: function (data) {
                $('form#register p.status').text(data.message);
                if (data.register == true) {
                    window.location.reload();
                }
            }
        });
        e.preventDefault();
    });
});