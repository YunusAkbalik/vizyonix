@extends('customer.layout')
@section('content')
    <main class="main__content_wrapper">
        <!-- my account section start -->
        <section class="my__account--section section--padding">
            <div class="container">
                <p class="account__welcome--text">{{ Auth::user()->name }}</p>
                <div class="my__account--section__inner border-radius-10 d-flex">
                    <div class="account__left--sidebar">
                        <h2 class="account__content--title h3 mb-20">My Profile</h2>
                        <ul class="account__menu">
                            <li class="account__menu--list active"><a href="#" type="button" data-bs-toggle="collapse"
                                                                      data-bs-target="#my-orders" aria-expanded="false"
                                                                      aria-controls="my-orders">My Orders</a></li>
                            <li class="account__menu--list"><a href="#" data-bs-toggle="collapse"
                                                               data-bs-target="#my-addresses" aria-expanded="false"
                                                               aria-controls="my-addresses">My Addresses</a></li>
                            <li class="account__menu--list"><a href="wishlist.html">Wishlist</a></li>
                            <li class="account__menu--list"><a href="javascript:void(0)" onclick="logout()">Log Out</a>
                            </li>
                        </ul>
                    </div>
                    <div class="account__wrapper" id="parentDiv">
                        <div id="my-orders" data-bs-parent="#parentDiv" class="account__content collapse show">
                            <h2 class="account__content--title h3 mb-20">Orders History</h2>
                            <div class="account__table--area">
                                <table id="ordersTable" class="account__table">
                                    <thead class="account__table--header">
                                    <tr class="account__table--header__child">
                                        <th class="account__table--header__child--items">Order</th>
                                        <th class="account__table--header__child--items">Date</th>
                                        <th class="account__table--header__child--items">Payment Status</th>
                                        <th class="account__table--header__child--items">Order Status</th>
                                        <th class="account__table--header__child--items">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody class="account__table--body">
                                    @foreach($orders as $order)
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">
                                                <strong class="d-block d-md-none">Order</strong>
                                                <span>#{{$order->id}}</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong class="d-block d-md-none">Date</strong>
                                                <span>{{$order->created_at}}</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong class="d-block d-md-none">Payment Status</strong>
                                                <span>{{$order->paymentStatus->name}}</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong class="d-block d-md-none">Order Status</strong>
                                                <span>{{$order->status->name}}</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong class="d-block d-md-none">Total</strong>
                                                <span>$@moneyFormat($order->grand_total) USD</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="my-addresses" data-bs-parent="#parentDiv"
                             class="account__content collapse collapse-horizontal">
                            <h2 class="account__content--title h3 mb-20">Addresses</h2>
                            <button class="new__address--btn btn mb-25" data-bs-toggle="collapse"
                                    data-bs-target="#new-addresses" aria-expanded="false"
                                    aria-controls="new-addresses">Add a new address
                            </button>
                            <div class="row">
                                @foreach($user_addresses as $address)
                                    <div class="col-md-6 mb-4">
                                        <div class="account__details two">
                                            <h3 class="account__details--title h4">{{$address->address->name}}</h3>
                                            <p class="account__details--desc">{{$address->address->username}}
                                                <br> {{$address->address->address}}
                                                <br> {{$address->address->city}} {{$address->address->state}} {{$address->address->zip}}
                                                <br>
                                                {{$address->address->country}}</p>
                                        </div>
                                        <div class="account__details--footer d-flex">
                                            <button class="account__details--footer__btn" type="button">Edit</button>
                                            <button onclick="deleteAddress({{$address->id}})" class="account__details--footer__btn" type="button">Delete</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="new-addresses" data-bs-parent="#parentDiv"
                             class="account__content collapse collapse-horizontal">
                            <h2 class="account__content--title h3 mb-20">Add New Address</h2>
                            <div class="row">
                                <form id="new_address">
                                    @csrf
                                    <label>
                                        <input class="account__login--input" required name="name"
                                               placeholder="Address name etc. (Home)"
                                               type="text">
                                    </label>
                                    <label>
                                        <input class="account__login--input" required name="username"
                                               placeholder="Your Name etc. (John Doe)"
                                               type="text">
                                    </label>
                                    <label>
                                        <textarea required name="address" class="account__login--input"
                                                  placeholder="Address"
                                                  cols="30" rows="3"></textarea>
                                    </label>
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <input class="account__login--input" required name="city"
                                                   placeholder="City etc. (New York)"
                                                   type="text">
                                        </div>
                                        <div class="col-md-2 mb-4">
                                            <input class="account__login--input" required name="zip"
                                                   placeholder="Zip"
                                                   type="number">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <select required name="country" class="account__login--input" id="">
                                                <option value="" selected disabled>Select Country</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <input class="account__login--input" required name="email"
                                                   placeholder="E-mail"
                                                   type="email">
                                        </div>

                                        <div class="col-md-6 mb-4">
                                            <input class="account__login--input" required name="phone"
                                                   placeholder="Phone"
                                                   type="text">
                                        </div>
                                    </div>
                                    <button class="account__login--btn btn" type="submit">Save My Address</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- my account section end -->

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
    <script>
        $(document).ready(function () {
            $('#ordersTable').DataTable({
                order: [1, 'desc'],
            });
        });
        $('.account__menu--list').click(function () {
            $('.account__menu--list').removeClass('active')
            $(this).addClass('active')
        })
        $('#new_address').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{route('new_address')}}",
                type: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    Swal.fire(
                        'Succuess',
                        response.message,
                        'success'
                    ).then(() => {
                        location.reload()
                    })
                },
                error: function (response) {
                    Swal.fire(
                        'Error',
                        response.responseJSON.message,
                        'error'
                    )
                }
            })
        });

        function logout() {
            $.ajax({
                url: "{{route('logout')}}",
                type: "GET",
                data: {},
                success: function (response) {
                    Swal.fire(
                        'Succuess',
                        response.message,
                        'success'
                    ).then(() => {
                        location.reload()
                    })
                },
                error: function (response) {
                    Swal.fire(
                        'Error',
                        response.responseJSON.message,
                        'error'
                    )
                }
            })
        }

        function deleteAddress(id) {
            $.ajax({
                url: "{{route('delete_address')}}",
                type: "POST",
                data: {
                    id: id,
                    '_token': '{{csrf_token()}}'
                },
                success: function (response) {
                    Swal.fire(
                        'Success',
                        response.message,
                        'success'
                    ).then(() => {
                        location.reload()
                    })
                },
                error: function (response) {
                    Swal.fire(
                        'Error',
                        response.responseJSON.message,
                        'error'
                    )
                }
            })
        }
    </script>
@endsection
