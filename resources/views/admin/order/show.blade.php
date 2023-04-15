@extends('admin.layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{asset('js/plugins/sweetalert2/sweetalert2.min.css')}}">
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Quick Overview -->
        <div class="row items-push">
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                    <div class="block-content py-5">
                        <div class="item rounded-circle bg-xeco-lighter mx-auto mb-3">
                            <i class="fa fa-star text-xeco-dark"></i>
                        </div>
                        <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                            #{{$order->id}}
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                    <div class="block-content py-5">
                        <div
                            class="item rounded-circle bg-{{$order->payment_status == 2 ? 'xeco':'xplay'}}-lighter mx-auto mb-3">
                            <i class="fa fa-money-bill text-{{$order->payment_status == 2 ? 'xeco':'xplay'}}-dark"></i>
                        </div>
                        <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                            Ödeme Durumu : {{$order->paymentStatus->name}} <br>
                        <hr>
                        {{$order->paymentStatus->description}}
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                    <div class="block-content py-5">
                        <div
                            class="item rounded-circle {{$order->order_status >= 2 ? 'bg-xeco-lighter':'bg-body'}} mx-auto mb-3">
                            <i class="fa fa-circle-question text-{{$order->order_status >= 2 ? 'xeco':'muted'}}-dark"></i>
                        </div>
                        <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                            Sipariş Durumu : {{$order->status->name}} <br>
                        <hr>
                        {{$order->status->description}}
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                    <div class="block-content py-5">
                        <div class="item rounded-circle bg-xeco-light mx-auto mb-3">
                            <i class="fa fa-comment-dollar text-xeco-dark"></i>
                        </div>
                        <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                            Ödeme Yöntemi : {{$order->payment_method}}
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <!-- END Quick Overview -->

        <!-- Products -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Ürünler</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-vcenter fs-sm">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">ID</th>
                            <th>Ürün</th>
                            <th class="text-center">İndirim</th>
                            <th class="text-center">Adet</th>
                            <th class="text-end" style="width: 10%;">Adet Fiyat</th>
                            <th class="text-end" style="width: 10%;">Fiyat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->detail as $detail)
                            <tr>
                                <td class="text-center"><a
                                        href="javascript:void(0)"><strong>#{{$detail->product->id}}</strong></a></td>
                                <td><a href="javascript:void(0)"><strong>{{$detail->product->title}}</strong></a></td>
                                <td class="text-center">$@moneyFormat($detail->discount)</td>
                                <td class="text-center"><strong>{{$detail->quantity}}</strong></td>
                                <td class="text-end">$@moneyFormat($detail->price)</td>
                                <td class="text-end">$@moneyFormat(($detail->total - $detail->discount) *
                                    $detail->quantity)
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="5" class="text-end"><strong>Toplam:</strong></td>
                            <td class="text-end">$@moneyFormat($order->total_price)</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-end"><strong>İndirim (Kupon):</strong></td>
                            <td class="text-end">$@moneyFormat($order->coupon_discount)</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-end"><strong>İndirim (Ürün):</strong></td>
                            <td class="text-end">$@moneyFormat($order->detail->sum('discount'))</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-end"><strong>Genel İndirim Toplam:</strong></td>
                            <td class="text-end">$@moneyFormat($order->detail->sum('discount') +
                                $order->coupon_discount)
                            </td>
                        </tr>
                        <tr class="table-active">
                            <td colspan="5" class="text-end text-uppercase"><strong>Genel Toplam:</strong></td>
                            <td class="text-end"><strong>$@moneyFormat($order->grand_total)</strong></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Products -->

        <!-- Customer -->
        <div class="row">
            <div class="col-sm-6">
                <!-- Billing Address -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Fatura Adresi</h3>
                    </div>
                    <div class="block-content">
                        <div class="fs-4 mb-1">{{$order->name}}</div>
                        <address class="fs-sm">
                            {{$order->address}}<br>
                            {{$order->city}}<br>
                            {{$order->country}}, {{$order->zip}}<br><br>
                            <i class="fa fa-phone"></i> {{$order->phone}}<br>
                            <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">{{$order->email}}</a>
                        </address>
                    </div>
                </div>
                <!-- END Billing Address -->
            </div>
            <div class="col-sm-6">
                <!-- Shipping Address -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Gönderim Adresi</h3>
                    </div>
                    <div class="block-content">
                        <div class="fs-4 mb-1">{{$order->name}}</div>
                        <address class="fs-sm">
                            {{$order->address}}<br>
                            {{$order->city}}<br>
                            {{$order->country}}, {{$order->zip}}<br><br>
                            <i class="fa fa-phone"></i> {{$order->phone}}<br>
                            <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">{{$order->email}}</a>
                        </address>
                    </div>
                </div>
                <!-- END Shipping Address -->
            </div>
        </div>
        <!-- END Customer -->


        <div class="row">
            <div class="col-md-6">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Durumları Değiştir</h3>
                    </div>
                    <div class="block-content">
                        <form id="statusChangeForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="order_status" class="form-label">Sipariş Durumu</label>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <select class="form-control" id="order_status" name="order_status">
                                        @foreach($statuses as $status)
                                            <option value="{{$status->id}}"
                                                    @if($status->id == $order->order_status) selected @endif>
                                                {{$status->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="order_status" class="form-label">Ödeme Durumu</label>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <select class="form-control" id="payment_status" name="payment_status">
                                        @foreach($paymentStatuses as $status)
                                            <option value="{{$status->id}}"
                                                    @if($status->id == $order->payment_status) selected @endif>
                                                {{$status->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="id" value="{{$order->id}}">
                                <div class="mb-4">
                                    <button class="btn btn-alt-success" type="submit">Güncelle</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Log Messages -->
        {{--        <div class="block block-rounded">--}}
        {{--            <div class="block-header block-header-default">--}}
        {{--                <h3 class="block-title">Log Messages</h3>--}}
        {{--            </div>--}}
        {{--            <div class="block-content">--}}
        {{--                <div class="table-responsive">--}}
        {{--                    <table class="table table-borderless table-striped table-vcenter fs-sm">--}}
        {{--                        <tbody>--}}
        {{--                        <tr>--}}
        {{--                            <td class="fs-base" style="width: 80px;">--}}
        {{--                                <span class="badge bg-primary">Order</span>--}}
        {{--                            </td>--}}
        {{--                            <td style="width: 220px;">--}}
        {{--                                <span class="fw-semibold">January 17, 2020 - 18:00</span>--}}
        {{--                            </td>--}}
        {{--                            <td>--}}
        {{--                                <a href="javascript:void(0)">Support</a>--}}
        {{--                            </td>--}}
        {{--                            <td class="text-success"><strong>Order Completed</strong></td>--}}
        {{--                        </tr>--}}
        {{--                        <tr>--}}
        {{--                            <td class="fs-base">--}}
        {{--                                <span class="badge bg-primary">Order</span>--}}
        {{--                            </td>--}}
        {{--                            <td>--}}
        {{--                                <span class="fw-semibold">January 17, 2020 - 17:36</span>--}}
        {{--                            </td>--}}
        {{--                            <td>--}}
        {{--                                <a href="javascript:void(0)">Support</a>--}}
        {{--                            </td>--}}
        {{--                            <td class="text-warning"><strong>Preparing Order</strong></td>--}}
        {{--                        </tr>--}}
        {{--                        <tr>--}}
        {{--                            <td class="fs-base">--}}
        {{--                                <span class="badge bg-success">Payment</span>--}}
        {{--                            </td>--}}
        {{--                            <td>--}}
        {{--                                <span class="fw-semibold">January 16, 2020 - 18:10</span>--}}
        {{--                            </td>--}}
        {{--                            <td>--}}
        {{--                                <a href="javascript:void(0)">John Parker</a>--}}
        {{--                            </td>--}}
        {{--                            <td class="text-success"><strong>Payment Completed</strong></td>--}}
        {{--                        </tr>--}}
        {{--                        <tr>--}}
        {{--                            <td class="fs-base">--}}
        {{--                                <span class="badge bg-danger">Email</span>--}}
        {{--                            </td>--}}
        {{--                            <td>--}}
        {{--                                <span class="fw-semibold">January 16, 2020 - 10:35</span>--}}
        {{--                            </td>--}}
        {{--                            <td>--}}
        {{--                                <a href="javascript:void(0)">Support</a>--}}
        {{--                            </td>--}}
        {{--                            <td class="text-danger"><strong>Missing payment details. Email was sent and awaiting for--}}
        {{--                                    payment before processing</strong></td>--}}
        {{--                        </tr>--}}
        {{--                        <tr>--}}
        {{--                            <td class="fs-base">--}}
        {{--                                <span class="badge bg-primary">Order</span>--}}
        {{--                            </td>--}}
        {{--                            <td>--}}
        {{--                                <span class="fw-semibold">January 15, 2020 - 14:59</span>--}}
        {{--                            </td>--}}
        {{--                            <td>--}}
        {{--                                <a href="javascript:void(0)">Support</a>--}}
        {{--                            </td>--}}
        {{--                            <td>All products are available</td>--}}
        {{--                        </tr>--}}
        {{--                        <tr>--}}
        {{--                            <td class="fs-base">--}}
        {{--                                <span class="badge bg-primary">Order</span>--}}
        {{--                            </td>--}}
        {{--                            <td>--}}
        {{--                                <span class="fw-semibold">January 15, 2020 - 14:29</span>--}}
        {{--                            </td>--}}
        {{--                            <td>--}}
        {{--                                <a href="javascript:void(0)">John Parker</a>--}}
        {{--                            </td>--}}
        {{--                            <td>Order Submitted</td>--}}
        {{--                        </tr>--}}
        {{--                        </tbody>--}}
        {{--                    </table>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <!-- END Log Messages -->
    </div>
    <!-- END Page Content -->
@endsection
@section('js')
    <script src="{{asset('js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#statusChangeForm').submit(function (e) {
                e.preventDefault();
                const data = $(this).serialize();
                console.log(data)
                sendRequest('{{route('admin_order_updateStatus')}}', 'POST', data)
                    .then(res => {
                        Swal.fire(
                            'Güncellendi',
                            res.data.message,
                            'success'
                        ).then(e => {
                            location.reload()
                        })
                    }).catch(err => {
                    Swal.fire(
                        'Hata',
                        err.response.data.message,
                        'error'
                    )
                })
            })
        })

    </script>
@endsection
