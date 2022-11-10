
<div>

        <input {{ $attributes }} class="form-control mb-0 firstStep" data-verification_phone="1" name="user_firebase[phone]">
        <input type="hidden" id="user_firebase_uid" name="user_firebase[uid]" value="">
        <input type="hidden" id="user_firebase_created_at" name="user_firebase[created_at]" value="">
    <div class="alert alert-danger invalid-feedback" id="error_phone_verify" style="display: none;"></div>

    <div class="alert alert-success" id="successAuth" style="display: none;"></div>

        @isset($label)
            <label for="register-phone" class="firstStep">{!! $label !!}</label>
        @endisset
        <div class="options" style="display: none">
            <div id="recaptcha-container" class="firstStep"></div>
            <button type="button" class="button btn-primary btn-block my-4 text-uppercase rounded firstStep" id="sendOTP">{{__('messages.auth.get_verify_code')}}</button>
        </div>
    <div class="mb-5 mt-5 verification_code" style="display: none">

        <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>
            <input type="text" id="verification" class="form-control" placeholder="Verification code">
            <button type="button" class="button btn-primary btn-block my-4 text-uppercase rounded" id="verify_code">{{__('messages.auth.send_verify_code')}}</button>
    </div>

        @push('component_scripts')

            <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
            <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

            <script>

                var firebaseConfig = {
                    apiKey: "AIzaSyDOBuAiEnXJCC2JdlcEvc5WfwdA1h-OPYU",
                    authDomain:   "sms.armada.kz",
                    databaseURL: "https://armada-33636-default-rtdb.firebaseio.com",
                    projectId: "armada-33636",
                    storageBucket: "armada-33636.appspot.com",
                    messagingSenderId: "280055244654",
                    appId: "1:280055244654:web:e5ed62f71a6ddaa4a9837f",
                    measurementId: "G-LCN9767ZHF"
                };

                firebase.initializeApp(firebaseConfig);
            </script>
            <script type="text/javascript">
                $( document ).ready(function() {

                    window.onload = function () {
                        render();
                    };

                    function render() {
                            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
                        recaptchaVerifier.render();
                    }

                    $('*[data-verification_phone="1"]').focus(function () {
                        $(".options").css('display', 'block');
                    });

                    $("#sendOTP").click(function () {
                        var number = $('*[data-verification_phone="1"]').val();
                        number = number.replace(/\s+/g, '');
                        number = number.replace(/-/g, '');
                        number = number.replace(/[{()}]/g, '');

                        firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {

                            window.confirmationResult = confirmationResult;
                            coderesult = confirmationResult;
                            console.log(coderesult);
                            $("#successAuth").text("{{__('messages.auth.otp_success_sent')}}");
                            $("#successAuth").show();
                            $('.firstStep').css('display', 'none');
                            $("#error_phone_verify").css('display', 'none');
                            $('.verification_code').css('display', 'block');
                        }).catch(function (error_phone_verify) {
                            $("#error_phone_verify").text(error_phone_verify.message);
                            $("#error_phone_verify").show();
                        });
                    });


                    $("#verify_code").click(function () {
                        var code = $("#verification").val();
                        coderesult.confirm(code).then(function (result) {
                            var user = result.user;
                            console.log(user.metadata.a);
                            console.log(user.uid);

                            $("#successAuth").text("{{__('messages.auth.otp_success')}}");
                            $("#successAuth").show();

                            $("#user_firebase_uid").val(user.uid);
                            $("#user_firebase_created_at").val(user.metadata.a);
                            $('.otp_form').submit();

                            $("#error_phone_verify").css('display', 'none');
                            $('.verification_code').css('display', 'none');
                            $('.options').css('display', 'none')
                        }).catch(function (error_phone_verify) {
                            // error_phone_verify.message
                            $("#error_phone_verify").text("{{__('messages.auth.otp_error')}}");
                            $("#error_phone_verify").show();
                        });
                    });
                });

            </script>
        @endpush

</div>
