@extends('admin.layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css')}}>
@endsection

@section('content')
    <!-- Hero -->
    <div class=" bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Kategoriler</h1>
            <a href="{{route('admin_category_create')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i>
                Kategori Ekle</a>
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
                    Kategori Listesi
                </h3>
            </div>
            <div class="block-content">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Başlık</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                <a href="{{route('admin_category_edit',['id' => $category->id])}}">#{{$category->id}}</a>
                            </td>
                            <td>{{$category->title}}</td>
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
