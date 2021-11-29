@include('front.common.header')
<?php
    $url = explode("/", $referer);
    $url1 = $url[0];
?>
<div class="screen-wrap">


    <header class="app-header bg-primary">
        <a href="javascript:history.go(-1)" class="btn-header"><i class="fa fa-arrow-left"></i></a>
        <div class="header-right">  </div>
    </header> <!-- section-header.// -->

    <main class="app-content">

        <div class="bg-primary padding-x padding-bottom">
            <h3 class="title-page text-white">Sign in</h3>
        </div>
        @include('snippets.flash')

        <section class="padding-around">
            <body>
                <div class="container mt-5" style="max-width: 550px">

                    <div class="alert alert-danger" id="error" style="display: none;"></div>

                    <h3>Add Phone Number</h3>

                    <div class="alert alert-success" id="successAuth" style="display: none;"></div>

                    <form>
                        <label>Phone Number:</label>

                        <input type="text" id="number" class="form-control" placeholder="+91 ********">

                        <div id="recaptcha-container"></div>

                        <button type="button" class="btn btn-primary mt-3" onclick="sendOTP();">Send OTP</button>
                    </form>


                    <div class="mb-5 mt-5">
                        <h3>Add verification code</h3>

                        <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>

                        <form>
                            <input type="text" id="verification" class="form-control" placeholder="Verification code">
                            <button type="button" class="btn btn-danger mt-3" onclick="verify()">Verify code</button>
                        </form>
                    </div>
                </div>



                <p class="text-center">
                    Don’t have account <br> <a href="{{url('/account/register?referer='.$referer)}}" class="btn-link">Create account</a>
                </p>


                <p class="text-center">
                    <a href="{{url($url1)}}" class="btn-link">Home</a>
                </p>

            </section>

        </main>
    </div>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
    <script type="text/javascript">
        $( document ).ready(function() {

        });
    </script>

    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyAxVM0vVHdBl8makYMa3oF0S36ZTuM2HLE",
            authDomain: "jeelink-aeee6.firebaseapp.com",
            databaseURL: "https://jeelink-aeee6-default-rtdb.firebaseio.com",
            projectId: "jeelink-aeee6",
            storageBucket: "jeelink-aeee6.appspot.com",
            messagingSenderId: "438325014866",
            appId: "1:438325014866:web:103e0fa7cb2448a81d4a8b",
            measurementId: "G-PTG891FHG9"
        };
        firebase.initializeApp(firebaseConfig);
    </script>
    <script type="text/javascript">
        window.onload = function () {
            render();
        };

        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            recaptchaVerifier.render();
        }

        function sendOTP() {
            var number = '+91'+$("#number").val();
            firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                console.log(coderesult);
                $("#successAuth").text("Message sent");
                $("#successAuth").show();
            }).catch(function (error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }

        function verify() {
            var code = $("#verification").val();
            coderesult.confirm(code).then(function (result) {
                var user = result.user;
                console.log(user);
                $("#successOtpAuth").text("Auth is successful");

                $("#successOtpAuth").show();
                var referer = '<?php echo $referer?>';
                var mobile = $("#number").val();
                var full_url = '{{url($url1)}}';
                

                var _token = '{{ csrf_token() }}';

                $.ajax({
                    url: "{{ url('/account/login') }}",
                    type: "POST",
                    data: {referer:referer , mobile:mobile},
                    dataType:"JSON",
                    headers:{'X-CSRF-TOKEN': _token},
                    

                    success: function(resp){
                    // alert(resp);
                     if(resp.success){
                         window.location.href = full_url;
                     }
                     else{
                      location.reload();

                  }

              }
          });     




                



            }).catch(function (error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }
    </script>

</body>

</html>