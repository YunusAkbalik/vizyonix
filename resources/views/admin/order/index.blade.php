@php use Carbon\Carbon; @endphp
@extends('admin.layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}>
@endsection


@section('content')

    <div class=" content">
    <!-- Quick Overview -->
    <div class="row items-push">
        <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0"
               href="javascript:void(0)">
                <div class="block-content py-5">
                    <div class="fs-3 fw-semibold text-primary mb-1">{{$orders->where('order_status',1)->count()}}</div>
                    <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                        İşlemde
                    </p>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                <div class="block-content py-5">
                    <div class="fs-3 fw-semibold mb-1">
                        $@moneyFormat($orders->whereBetween('created_at',[today(),Carbon::tomorrow()])->sum('grand_total'))
                    </div>
                    <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                        Günlük Cüro
                    </p>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                <div class="block-content py-5">
                    <div class="fs-3 fw-semibold mb-1">
                        $@moneyFormat($orders->whereBetween('created_at',[now()->startOfWeek(),now()->endOfWeek()])->sum('grand_total'))

                    </div>
                    <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                        Haftalık Cüro
                    </p>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center h-100 mb-0" href="javascript:void(0)">
                <div class="block-content py-5">
                    <div class="fs-3 fw-semibold mb-1">
                        $@moneyFormat($orders->whereBetween('created_at',[now()->startOfMonth(),now()->endOfMonth()])->sum('grand_total'))

                    </div>
                    <p class="fw-semibold fs-sm text-muted text-uppercase mb-0">
                        Aylık Cüro
                    </p>
                </div>
            </a>
        </div>
    </div>
    <!-- END Quick Overview -->

    <!-- All Orders -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Tüm Siparişler</h3>
        </div>
        <div class="block-content">
            <!-- All Orders Table -->
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-vcenter fs-sm js-dataTable-responsive">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 100px;">ID</th>
                        <th class="d-none d-sm-table-cell text-center">Sipariş Tarihi</th>
                        <th>Sipariş Durumu</th>
                        <th class="d-none d-xl-table-cell">Müşteri</th>
                        <th class="d-none d-xl-table-cell text-center">Ürünler</th>
                        <th class="d-none d-sm-table-cell text-end">Genel Toplam</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="text-center">
                                <a class="fw-semibold" href="{{route('admin_order_show',$order->id)}}">
                                    <strong>#{{ $order->id }}</strong>
                                </a>
                            </td>
                            <td class="d-none d-sm-table-cell text-center">{{ $order->created_at->format('d/m/Y') }}</td>
                            <td class="fs-base">
                                <span
                                    class="badge rounded-pill bg-{{$order->status->color}}">{{$order->status->name}}</span>
                            </td>
                            <td class="d-none d-xl-table-cell">
                                <a class="fw-semibold" href="be_pages_ecom_customer.html">{{$order->name}}</a>
                            </td>
                            <td class="d-none d-xl-table-cell text-center">
                                <a class="fw-semibold" href="be_pages_ecom_order.html">{{$order->detail->count()}}</a>
                            </td>
                            <td class="d-none d-sm-table-cell text-end">
                                <strong>$@moneyFormat($order->grand_total)</strong>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END All Orders Table -->
        </div>
    </div>
    <!-- END All Orders -->
    </div>
@endsection
@section('js')
    <!-- Page JS Plugins -->
    <script src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('js/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>
    <script src="{{asset('js/plugins/datatables-buttons/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
    <script src="{{asset('js/plugins/datatables-buttons-jszip/jszip.min.js')}}"></script>
    <script src="{{asset('js/plugins/datatables-buttons-pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/plugins/datatables-buttons-pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('js/plugins/datatables-buttons/buttons.print.min.js')}}"></script>
    <script src="{{asset('js/plugins/datatables-buttons/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/pages/DataTable/Order.js')}}"></script>
@endsection
