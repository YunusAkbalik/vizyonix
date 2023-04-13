@extends('admin.layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Kategori Düzenle</h1>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <!-- Your Block -->
        <div class="block block-rounded">
            <div class="block-content">
                <div class="row g-0 justify-content-center">
                    <div class="col-sm-8 col-xl-6">
                        <form class="js-validation" action="{{route('admin_category_update')}}" method="POST">
                            @csrf
                            <div class="py-3">
                                <div class="mb-4">
                                    <input type="text" class="form-control form-control-lg form-control-alt"
                                           id="title" name="title" value="{{$category->title}}" placeholder="Başlık">
                                </div>
                            </div>
                            <input type="hidden" name="category_id" value="{{$category->id}}">
                            <div class="mb-4">
                                <button type="submit" class="btn w-100 btn-lg btn-hero btn-alt-success">
                                    <i class="fa fa-fw fa-plus opacity-50 me-1"></i> Düzenle
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection
@section('js')
    <script src="{{asset('js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/plugins/jquery-validation/additional-methods.js')}}"></script>
    <script src="{{asset('js/pages/validations/category.js')}}"></script>

@endsection
