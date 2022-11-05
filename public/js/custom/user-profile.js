$('document').ready(function () {
    $("#resend_otp").hide();
    $('.modal').modal();
    // $("#frmRegister").validate({
    //     rules: {
    //         name: "required",
    //     },
    //     messages: {
    //         name: "Please enter full name",
    //     }
    // })
})

$("#verify_email_btn").on("click", function () {
    // console.log('its loading..');
    var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var email = $('#email').val();

    if (pattern.test(email)) {
        sendEmailOtp();
        $("#resend_email_otp").hide();
    } else {
        console.log('Email is not valid');
    }
});
$("#resend_email_otp").on("click", function () {
    $("#resend_email_otp").hide();
    sendEmailOtp();
});

function sendEmailOtp() {
    console.log('send otp');
    // console.log($("#email").val());
    $.ajax({
        url: "sendEmailOtp",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            email: $("#email").val()
        },
        success: function success(res) {
            res = JSON.parse(res)
            console.log("result---", res);
            if (res.status) {
                setTimerCountDown();
                $('#verifyemailModel').modal('open');
                $(".countdown").show();
            } else {
                console.log(res.message)
                alert(res.message)
            }
        },
        error: function error(err) {// console.log("ajax err", err.responseText);
        }
    });
}

$("#submit_email_otp").on("click", function () {
    console.log("submit otp");
    $.ajax({
        url: "verifyEmailOtp",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            email_otp: $("#email_otp").val(),
            email: $("#email").val()
        },
        success: function success(res) {
            console.log("res", res);
            res = JSON.parse(res)

            if (res.status) {
                $('#verifyemailModel').modal('close');
                $("#verify_email_btn").html('verified');
                $("#email_verified").val(1);
                $("#verify_email_btn").css("background", "#03CBC9");
            } else {
                alert('Otp is invalid');
            }
        },
        error: function error(err) {// console.log("ajax err", err.responseText);
        }
    });
});

function setTimerCountDown() {
    var timer2 = "1:01";
    var interval = setInterval(function () {
        var timer = timer2.split(':'); //by parsing integer, I avoid all extra string processing

        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = seconds < 0 ? --minutes : minutes;

        if (minutes < 0) {
            $("#resend_email_otp").show();
            $(".countdown").hide();
            clearInterval(interval);
        }

        seconds = seconds < 0 ? 59 : seconds;
        seconds = seconds < 10 ? '0' + seconds : seconds; //minutes = (minutes < 10) ?  minutes : minutes;

        $('.countdown').html(minutes + ':' + seconds);
        timer2 = minutes + ':' + seconds;
    }, 1000);
}