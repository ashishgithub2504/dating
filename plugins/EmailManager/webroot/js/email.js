
$("#quickStartForm").submit(function (event) {
    event.preventDefault();
    l = Ladda.create(document.querySelector('.l-button'));
    l.start();
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'none');
    var form = $(this);
    $.ajax({
        url: form.attr("action"),
        type: 'POST',
        data: form.serialize(),
        dataType: 'json',
        success: function (responce) {
            if (responce.status === true) {
                form[0].reset();
                $.alert({
                        title: 'Success!',
                        icon: 'fa fa-info',
                        content: responce.errors,
                        type: 'green',
                        theme: 'light',
                        buttons: {
                            Okay: function(){
                                window.location.reload(true);
                            }
                        }
                    });
                
            } else {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $(".print-error-msg").find("ul").append(printErrorMsg(responce.errors));
            }
            l.stop();

        }, error: function (data) {
            var errors = data.responseJSON;
            //console.log(errors);
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $(".print-error-msg").find("ul").append(printErrorMsg(errors));
            l.stop();
        }

    });
});

function printErrorMsg(msg) {
    var html = '';
    console.log(msg);
    $.each(msg, function (key, value) {
        if (typeof value == 'object') {
            $.each(value, function (key2, value2) {
                html += '<li>' + value2 + '</li>';
            });
        } else {
            html += '<li>' + value + '</li>';
        }
    });
    return html;
}

