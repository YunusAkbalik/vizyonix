@extends('customer.layout')
@section('content')
    <main class="main__content_wrapper">
        <!-- Start login section  -->
        <div class="login__section section--padding mb-80">
            <div class="container">
                <div class="login__section--inner">
                    <div class="row row-cols-md-2 row-cols-1">
                        <div class="col">
                            <div class="account__login">
                                <div class="account__login--header mb-25">
                                    <h2 class="account__login--header__title h3 mb-10">Login</h2>
                                </div>
                                <form id="login-form" action="javascript:void(0)">
                                    @csrf
                                    <div class="account__login--inner">
                                        <label>
                                            <input class="account__login--input" required name="email" placeholder="Email Addres"
                                                   type="email">
                                        </label>
                                        <label>
                                            <input class="account__login--input" required name="password" placeholder="Password" type="password">
                                        </label>
                                        <div
                                            class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
                                            <div class="account__login--remember position__relative">
                                                <input class="checkout__checkbox--input" name="remember_me" checked type="checkbox">
                                                <span class="checkout__checkbox--checkmark"></span>
                                                <label class="checkout__checkbox--label login__remember--label"
                                                       for="check1">
                                                    Remember me</label>
                                            </div>
                                            <a class="account__login--forgot" href="javascript:void(0)">Forgot Your
                                                Password?
                                            </a>
                                        </div>
                                        <button class="account__login--btn btn" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col">
                            <div class="account__login register">
                                <div class="account__login--header mb-25">
                                    <h2 class="account__login--header__title h3 mb-10">Create an Account</h2>
                                </div>
                                <form id="register-form" action="javascript:void(0)">
                                    <div class="account__login--inner">
                                        <label>
                                            <input class="account__login--input" required placeholder="Name"
                                                   type="text">
                                        </label>
                                        <label>
                                            <input class="account__login--input" name="email" required placeholder="Email Addres"
                                                   type="email">
                                        </label>
                                        <label>
                                            <input class="account__login--input" name="password" required placeholder="Password"
                                                   type="password">
                                        </label>
                                        <button class="account__login--btn btn mb-10" type="submit">Register
                                        </button>
                                        <div class="account__login--remember position__relative">
                                            <input class="checkout__checkbox--input" required id="check2"
                                                   type="checkbox">
                                            <span class="checkout__checkbox--checkmark"></span>
                                            <label class="checkout__checkbox--label login__remember--label"
                                                   for="check2">
                                                I have read and agree to the terms & conditions</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End login section  -->

        <!-- Start shipping section -->
        <section class="shipping__section2 shipping__style3">
            <div class="container">
                <div class="shipping__section2--inner shipping__style3--inner d-flex justify-content-between">
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img class="display-block" src="assets/img/other/shipping1.png" alt="shipping img">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Shipping</h2>
                            <p class="shipping__items2--content__desc">From handpicked sellers</p>
                        </div>
                    </div>
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img class="display-block" src="assets/img/other/shipping2.png" alt="shipping img">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Payment</h2>
                            <p class="shipping__items2--content__desc">Visa, Paypal, Master</p>
                        </div>
                    </div>
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img class="display-block" src="assets/img/other/shipping3.png" alt="shipping img">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Return</h2>
                            <p class="shipping__items2--content__desc">30 day guarantee</p>
                        </div>
                    </div>
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img class="display-block" src="assets/img/other/shipping4.png" alt="shipping img">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Support</h2>
                            <p class="shipping__items2--content__desc">Support every time</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End shipping section -->

    </main>
@endsection
@section('js')
    <script src="{{asset('js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/plugins/jquery-validation/additional-methods.js')}}"></script>
    <script>
        $('#login-form').submit(function (e) {
            e.preventDefault()
            console.log($(this).valid())
            if ($(this).valid()) {
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{{route('login_post')}}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        location.href = "{{route('home')}}";
                        return;
                    },
                    error: function (data) {
                        Swal.fire(
                            'Error!',
                            data.responseJSON.message,
                            'error'
                        )
                        return;
                    }
                });
            }

        });
    </script>

@endsection
