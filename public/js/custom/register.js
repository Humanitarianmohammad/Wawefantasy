$('document').ready(function () {
    $("#resend_otp").hide();
    $("#frmRegister").validate({
        rules: {
            // simple rule, converted to {required:true}
            name: "required",
            // compound rule
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            },
        },
        messages: {
            name: "Please enter full name",
            mobile: {
                required: "Please enter Mobile no",
                minlength: "Please enter valid mobile no",
                maxlength: "Please enter valid mobile no"
            },
            password: {
                required: "Please enter password",
                minlength: "your password must be 8 char long"
            },
            password_confirmation: {
                required: "Please enter password",
                minlength: "your password must be 8 char long",
                equalTo: "Enter same password"
            }
        },
        submitHandler: function submitHandler(form) {
            var otp_isthere = $("#email_verified").val();

            if (otp_isthere != 1) {
                alert('please verify Mobile number..!');
                return false;
            } else {
                return true;
            }
        }
    })
})

$("#verify_email_btn").on("click", function () {
    // console.log('its loading..');
    var pattern = /^\d{10}$/;
    var mobile = $('#mobile').val();

    if (pattern.test(mobile)) {
        sendMobileOtp();
        $("#resend_mobile_otp").hide();
    } else {
        console.log('Mobile is not valid');
    }
});
$("#resend_mobile_otp").on("click", function () {
    $("#resend_mobile_otp").hide();
    sendMobileOtp();
});

function sendMobileOtp() {
    console.log('send otp');
    // console.log($("#mobile").val());
    $.ajax({
        url: "sendMobileOtp",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            name: $("#name").val(),
            mobile: $("#mobile").val()
        },
        success: function success(res) {
            res = JSON.parse(res)
            console.log("res", res);
            if(res.status){
                setTimerCountDown();
                $('#verifyemailModel').modal('show');
                $(".countdown").show();
            }else{
                console.log(res.message)
                alert(res.message)
            }
            
        },
        error: function error(err) {// console.log("ajax err", err.responseText);
        }
    });
}

$("#submit_mobile_otp").on("click", function () {
    console.log("submit otp");
    $.ajax({
        url: "verifyMobileOtp",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            mobile_otp: $("#mobile_otp").val(),
            mobile: $("#mobile").val()
        },
        success: function success(res) {
            console.log("res", res);
            res = JSON.parse(res);

            if (res.status) {
                $('#verifyemailModel').modal('hide');
                $("#verify_email_btn").html('verified');
                $("#email_verified").val(1);
                $("#verify_email_btn").css("background", "#03CBC9");
                $("#verify_email_btn").removeClass("not_verified_btn");
                $("#verify_email_btn").addClass("verified_btn");
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
            $("#resend_mobile_otp").show();
            $(".countdown").hide();
            clearInterval(interval);
        }

        seconds = seconds < 0 ? 59 : seconds;
        seconds = seconds < 10 ? '0' + seconds : seconds; //minutes = (minutes < 10) ?  minutes : minutes;

        $('.countdown').html(minutes + ':' + seconds);
        timer2 = minutes + ':' + seconds;
    }, 1000);
}