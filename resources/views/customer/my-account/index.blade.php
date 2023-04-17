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
                            <li class="account__menu--list active"><a href="#" type="button" data-bs-toggle="collapse"  data-bs-target="#my-orders" aria-expanded="false" aria-controls="my-orders">My Orders</a></li>
                            <li class="account__menu--list"><a href="#" data-bs-toggle="collapse" data-bs-target="#my-addresses" aria-expanded="false" aria-controls="my-addresses">My Addresses</a></li>
                            <li class="account__menu--list"><a href="wishlist.html">Wishlist</a></li>
                            <li class="account__menu--list"><a href="login.html">Log Out</a></li>
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
                        <div id="my-addresses" data-bs-parent="#parentDiv" class="account__content collapse collapse-horizontal">
                            <h2 class="account__content--title h3 mb-20">My Adresses</h2>
                            <div class="account__table--area">
                                adresses
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
    </script>
@endsection
