<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="login-logo">
            <a href="{{ url('/home') }}"><b>{{ config('app.name') }}</b></a>
        </div>

        <div class="card">
            <ul class="nav nav-pills nav-fill mb-1" id="pills-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" id="pills-signin-tab" data-toggle="pill"
                        onclick="showlogin()" role="tab" aria-controls="pills-signin" aria-selected="true">Login</a>
                </li>
                <li class="nav-item"> <a class="nav-link" id="pills-signup-tab" data-toggle="pill"
                        onclick="showregister()" role="tab" aria-controls="pills-signup"
                        aria-selected="false">Registeration</a> </li>
            </ul>

            <div style="display: none;" class="tab-pane" id="pills-signup" role="tabpanel"
                aria-labelledby="pills-signup-tab">
                <div class="col-sm-12 border-primary shadow rounded pt-2">
                    <div class="container">
                        <p class="login-box-msg">Registeration</p>
                        <p class="text-center text-danger">{{ session('message') }} </p>
                        <form method="post" action="{{ url('/saveregister') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="name" placeholder="Name" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="email" placeholder="Email" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" maxlength="10" name="phone" placeholder="Phone" class="form-control number">
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input name="password" type="password" maxlength="20" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input name="plain_password" id="showpas" type="password" maxlength="20" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" onclick="myFunction()" id="showpas">
                                        <label for="remember">
                                            Show Password
                                        </label>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                </div>

                            </div>
                        </form>

                        <p class="mb-1">
                            <br>
                        </p>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-signin" role="tabpanel"
                    aria-labelledby="pills-signin-tab">
                    <div class="container">
                        <p class="login-box-msg">Login</p>
                        <p class="text-center text-danger">{{ session('message') }} </p>
                        <form method="post" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                            <div class="input-group mb-3">
                                <input type="text" name="email" value="{{ old('email') }}" placeholder="Email"
                                    class="form-control @error('email') is-invalid @enderror">
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-user"></span></div>
                                </div>
                                @error('email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" name="password" placeholder="Password"
                                    class="form-control @error('password') is-invalid @enderror">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script> --}}

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function(reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-messaging.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyDOCQyOUapH4HxLKZZS6Mk2La2EURl22Ak",
            authDomain: "aypt-b20e4.firebaseapp.com",
            projectId: "aypt-b20e4",
            storageBucket: "aypt-b20e4.appspot.com",
            messagingSenderId: "19421078519",
            appId: "1:19421078519:web:4eb17253f6cac1bd3344f2"
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        function IntitalizeFireBaseMessaging() {
            messaging
                .requestPermission()
                .then(function() {
                    console.log("Notification Permission");
                    return messaging.getToken();
                })
                .then(function(token) {
                    console.log("Token : " + token);
                    document.getElementById("deviceid").value = token;
                })
                .catch(function(reason) {
                    console.log(reason);
                });
        }

        messaging.onMessage(function(payload) {
            console.log(payload);
            const notificationOption = {
                body: payload.notification.body,
                icon: payload.notification.icon
            };

            if (Notification.permission === "granted") {
                var notification = new Notification(payload.notification.title, notificationOption);

                notification.onclick = function(ev) {
                    ev.preventDefault();
                    window.open(payload.notification.click_action, '_blank');
                    notification.close();
                }
            }

        });
        messaging.onTokenRefresh(function() {
            messaging.getToken()
                .then(function(newtoken) {
                    console.log("New Token : " + newtoken);
                })
                .catch(function(reason) {
                    console.log(reason);
                    alert(reason);
                })
        })
        IntitalizeFireBaseMessaging();


        function showlogin() {
            $("#pills-signup-tab").removeClass("active");
            $("#pills-signup").slideUp();
            $("#pills-signin-tab").addClass("active");
            $("#pills-signin").slideDown();
        }

        function showregister() {
            $("#pills-signin-tab").removeClass("active");
            $("#pills-signin").slideUp();
            $("#pills-signup-tab").addClass("active");
            $("#pills-signup").slideDown();
        }

        function myFunction() {
  var x = document.getElementById("showpas");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
    </script>
</body>

</html>
