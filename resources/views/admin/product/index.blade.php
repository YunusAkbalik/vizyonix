@extends('admin.layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}>
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Ürünler</h1>
                <a href="{{route('admin_product_create')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Ürün Ekle</a>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Ürün Listesi
                </h3>
            </div>
            <div class="block-content">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Medya</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Fiyat</th>
                        <th>Satış</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>#{{$product->id}}</td>
                            <td><img src="{{$product->main_image}}" alt="{{$product->title}}" width="150px"> </td>
                            <td>{{$product->title}}</td>
                            <td>{{$product->category->category->title}}</td>
                            <td>@moneyFormat($product->price) $</td>
                            <td class="text-{{$product->on_sale ? 'success':'danger'}}"><i class="fa-regular fa-circle-{{$product->on_sale ? 'check':'xmark'}}"></i></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
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
    <script src="{{asset('js/pages/datatable.js')}}"></script>
@endsection
