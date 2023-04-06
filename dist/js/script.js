function start_loader() {
    $('body').append(
        '<div class="page-preloader d-flex justify-content-center"><div class="spinner-border text-primary" style="width: 4rem; height: 4rem; border-width:0.48rem;" role="status"><span class="visually-hidden"></span></div></div>'
    );
}
function end_loader() {
    $('.page-preloader').fadeOut('fast', function () {
        $('.page-preloader').remove();
    });
}

function alert_toast($msg = 'Test', $icon = 'success') {
    Swal.fire({
        position: 'top',
        icon: $icon,
        title: $msg,
        showConfirmButton: false,
        timer: 1500,
        backdrop: false,
        customClass: {
            title: 'sweet-alert-title',
            icon: 'sweet-alert-icon',
        },
    });
}

$(document).ready(function () {
    $('#login-form').submit(function (e) {
        e.preventDefault();
        start_loader();
        if ($('.error_msg').length > 0) $('.error_msg').remove();
        $.ajax({
            url: _base_url_ + 'classes/Login.php?f=login',
            method: 'POST',
            data: $(this).serialize(),
            error: (err) => {
                console.log(err);
            },
            success: function (resp) {
                if (resp) {
                    resp = JSON.parse(resp);
                    if (resp.status === 'success') {
                        location.replace(_base_url_ + 'admin');
                    } else if (resp.status === 'incorrect') {
                        var _form = $('#login-form');
                        var _msg =
                            '<div class="mx-2 alert alert-danger error_msg" role="alert"><i class="fa-solid fa-triangle-exclamation fa-lg"></i> Incorrect username or password!</div>';
                        _form.prepend(_msg);
                        $('input').addClass('error');
                    }
                    end_loader();
                }
            },
        });
    });

    window.uni_modal = function ($title = '', $url = '') {
        $.ajax({
            url: $url,
            error: (err) => {
                alert('An error occurred' + err);
            },
            success: function (resp) {
                if (resp) {
                    $('#uni_modal .modal-title').html($title);
                    $('#uni_modal .modal-body').html(resp);

                    var modal = new bootstrap.Modal(
                        document.getElementById('uni_modal'),
                        {}
                    );
                    modal.show();
                }
            },
        });
    };
    window.delete_modal = function ($msg = '', $func = '', $id = '') {
        // $('#delete-modal #delete-btn').attr('onclick', $func + '(' + $id + ')');
        // $('#delete-modal .modal-body').html($msg);

        $('#delete-modal #delete-btn').attr('onclick', $func + '(' + $id + ')');
        $('#delete-modal .modal-body').html($msg);
        var modal = new bootstrap.Modal(
            document.getElementById('delete-modal'),
            {}
        );
        modal.show();
    };
});
