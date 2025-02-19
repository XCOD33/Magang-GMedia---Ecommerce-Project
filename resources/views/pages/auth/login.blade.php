<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 9 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <meta charset="utf-8" />
    <title>Metronic | Login Page 6</title>
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="{{ asset('assets/css/pages/users/login-6.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed subheader-enabled aside-enabled aside-static page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-6 login-signin-on d-flex flex-column flex-lg-row flex-row-fluid bg-white" id="kt_login">
            <!--begin::Aside-->
            <div
                class="login-aside order-2 order-lg-1 d-flex flex-column-fluid flex-lg-row-auto bgi-size-cover bgi-no-repeat p-7 p-lg-10">
                <!--begin: Aside Container-->
                <div class="d-flex flex-row-fluid flex-column justify-content-between">
                    <!--begin::Aside body-->
                    <div class="d-flex flex-column-fluid flex-column flex-center mt-5 mt-lg-0">
                        <a href="#" class="mb-15 text-center">
                            <img src="{{ asset('assets/media/logos/logo-letter-1.png') }}" class="max-h-75px" alt="" />
                        </a>
                        <!--begin::Signin-->
                        <div class="login-form login-signin">
                            <div class="text-center mb-10 mb-lg-20">
                                <h2 class="font-weight-bold">Sign In</h2>
                                <p class="text-muted font-weight-bold">Enter your email and password</p>
                            </div>
                            <!--begin::Form-->
                            <form class="form" id="signin-form">
                                <div class="form-group py-3 m-0">
                                    <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Email"
                                        placeholder="Email" name="email" autocomplete="off" />
                                </div>
                                <div class="form-group py-3 border-top m-0">
                                    <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Password"
                                        placeholder="Password" name="password" />
                                </div>
                                <div
                                    class="form-group d-flex flex-wrap justify-content-between align-items-center mt-3">
                                    <label class="checkbox checkbox-outline m-0 text-muted">
                                        <input type="checkbox" name="remember" />Remember me
                                        <span></span></label>
                                    <a href="javascript:;" id="kt_login_forgot"
                                        class="text-muted text-hover-primary">Forgot Password ?</a>
                                </div>
                                <div
                                    class="form-group d-flex flex-wrap justify-content-between align-items-center mt-2">
                                    <div class="my-3 mr-2">
                                        <span class="text-muted mr-2">Don't have an account?</span>
                                        <a href="javascript:;" id="kt_login_signup" class="font-weight-bold">Signup</a>
                                    </div>
                                    <button id="kt_login_signin_submit"
                                        class="btn btn-primary font-weight-bold px-9 py-4 my-3">Sign In</button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Signin-->
                        <!--begin::Signup-->
                        <div class="login-form login-signup">
                            <div class="text-center mb-10 mb-lg-20">
                                <h3 class="">Sign Up</h3>
                                <p class="text-muted font-weight-bold">Enter your details to create your account</p>
                            </div>
                            <!--begin::Form-->
                            <form class="form" id="signup-form">
                                <div class="form-group py-3 m-0">
                                    <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text"
                                        placeholder="Fullname" name="fullname" autocomplete="off" />
                                </div>
                                <div class="form-group py-3 border-top m-0">
                                    <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="email"
                                        placeholder="Email" name="email" autocomplete="off" />
                                </div>
                                <div class="form-group py-3 border-top m-0">
                                    <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password"
                                        placeholder="Password" name="password" autocomplete="off" />
                                </div>
                                <div class="form-group py-3 border-top m-0">
                                    <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password"
                                        placeholder="Confirm password" name="rpassword" autocomplete="off" />
                                </div>
                                <div class="form-group py-3 border-top m-0">
                                    <select name="role" class="form-control h-auto border-0 px-0 placeholder-dark-75">
                                        <option selected disabled>Pilih Role</option>
                                        <option value="seller">Seller</option>
                                        <option value="buyer">Buyer</option>
                                    </select>
                                </div>
                                <div class="form-group mt-5">
                                    <label class="checkbox checkbox-outline">
                                        <input type="checkbox" name="agree" />I Agree the
                                        <a href="#">terms and conditions</a>.
                                        <span></span></label>
                                </div>
                                <div class="form-group d-flex flex-wrap flex-center">
                                    <button id="kt_login_signup_submit"
                                        class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Submit</button>
                                    <button id="kt_login_signup_cancel"
                                        class="btn btn-outline-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel</button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Signup-->
                        <!--begin::Forgot-->
                        <div class="login-form login-forgot">
                            <div class="text-center mb-10 mb-lg-20">
                                <h3 class="">Forgotten Password ?</h3>
                                <p class="text-muted font-weight-bold">Enter your email to reset your password</p>
                            </div>
                            <!--begin::Form-->
                            <form class="form" novalidate="novalidate">
                                <div class="form-group py-3 border-bottom mb-10">
                                    <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="email"
                                        placeholder="Email" name="email" autocomplete="off" />
                                </div>
                                <div class="form-group d-flex flex-wrap flex-center">
                                    <button id="kt_login_forgot_submit"
                                        class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Submit</button>
                                    <button id="kt_login_forgot_cancel"
                                        class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel</button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Forgot-->
                    </div>
                    <!--end::Aside body-->
                    <!--begin: Aside footer for desktop-->
                    <div class="d-flex flex-column-auto justify-content-between mt-15">
                        <div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">© 2020 Metronic</div>
                        <div class="d-flex order-1 order-sm-2 my-2">
                            <a href="#" class="text-muted text-hover-primary">Privacy</a>
                            <a href="#" class="text-muted text-hover-primary ml-4">Legal</a>
                            <a href="#" class="text-muted text-hover-primary ml-4">Contact</a>
                        </div>
                    </div>
                    <!--end: Aside footer for desktop-->
                </div>
                <!--end: Aside Container-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div class="order-1 order-lg-2 flex-column-auto flex-lg-row-fluid d-flex flex-column p-7"
                style="background-image: url({{ asset('assets/media/bg/bg-4.jpg') }});">
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-lg-center">
                    <div class="d-flex flex-column justify-content-center">
                        <h3 class="display-3 font-weight-bold my-7 text-white">Welcome to Metronic!</h3>
                        <p class="font-weight-bold font-size-lg text-white opacity-80">The ultimate Bootstrap, Angular
                            8, React &amp; VueJS admin theme
                            <br />framework for next generation web apps.
                        </p>
                    </div>
                </div>
                <!--end::Content body-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };
    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Scripts(used by this page)-->
    {{-- <script src="{{ asset('assets/js/pages/custom/login/login.js') }}"></script> --}}
    <!--end::Page Scripts-->
    <!--end::Body-->
    <script>
        toastr.options = {
            "positionClass": "toast-bottom-right",
        }

        $(document).ready(function() {
            $('#kt_login_signup').click(function(e) {
                e.preventDefault();
                $('.login-signin').hide();
                $('.login-signup').show();
            });

            $('#kt_login_signup_cancel').click(function(e) {
                e.preventDefault();
                $('.login-signup').hide();
                $('.login-signin').show();
            });

            $('#kt_login_signin_submit').click(function(e) {
                e.preventDefault();

                handleLogin()
            });

            $('#kt_login_signup_submit').click(function(e) {
                e.preventDefault();

                handleRegister()
            });
        });

        function handleLogin() {
            let formData = {
                email: $('#signin-form input[name=email]').val(),
                password: $('#signin-form input[name=password]').val(),
                remember: $('#signin-form input[name=remember]').val(),
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                url: "{{ route('login') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                        setTimeout(() => {
                            window.location.href = response.redirect;
                        }, 5000);
                    } else {
                        toastr.warning(response.message);
                    }
                },
                error: function(xhr) {
                    let error = xhr.responseJSON;
                    toastr.warning(error.message);
                }
            });
        }

        function handleRegister() {
            let formData = {
                name: $('#signup-form input[name=fullname]').val(),
                email: $('#signup-form input[name=email]').val(),
                password: $('#signup-form input[name=password]').val(),
                password_confirmation: $('#signup-form input[name=rpassword]').val(),
                role: $('#signup-form select[name=role]').val(),
                _token: "{{ csrf_token() }}"
            }

            $.ajax({
                url: "{{ route('register') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.warning(response.message);
                    }
                },
                error: function(xhr) {
                    let error = xhr.responseJSON;
                    toatstr.warning(error.message);
                }
            });
        }
    </script>

</html>