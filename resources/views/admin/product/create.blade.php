@extends('admin.layouts.backend')

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Ürün Ekle</h1>
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
                        <form class="js-validation" action="{{route('admin_product_store')}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="py-3">
                                <div class="mb-4">
                                    <input type="text" class="form-control form-control-lg form-control-alt"
                                           id="title" name="title" placeholder="Başlık">
                                </div>
                                <div class="mb-4">
                                    <textarea id="js-ckeditor" name="description"></textarea>
                                </div>
                                <div class="mb-4">
                                    <select name="category_id" id="category_id"
                                            class="form-control form-control-lg form-control-alt">
                                        <option value="" disabled selected>Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <input type="number" step="any" id="price" name="price"
                                           class="form-control form-control-lg form-control-alt"
                                           placeholder="Fiyat ($)">
                                </div>
                                <div class="mb-4">
                                    <label for="main_image[]" class="form-label">Ana Resim</label>
                                    <input class="form-control form-control-lg form-control-alt"
                                           accept="image/png,image/jpg,image/jpeg" type="file" name="main_image[]"
                                           id="main_image[]">
                                </div>
                                <div class="mb-4">
                                    <label for="files[]" class="form-label">Ürün Resimleri</label>
                                    <input class="form-control form-control-lg form-control-alt"
                                           accept="image/png,image/jpg,image/jpeg" type="file" name="files[]" multiple
                                           id="files[]">
                                </div>
                                <div class="mb4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="1" id="on_sale" name="on_sale" checked>
                                        <label class="form-check-label" for="on_sale">Satışta</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn w-100 btn-lg btn-hero btn-alt-success">
                                    <i class="fa fa-fw fa-plus opacity-50 me-1"></i> Oluştur
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
{{--    <script src="{{asset('js/pages/validations/product.js')}}"></script>--}}
    <script src="{{asset('js/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>Dashmix.helpersOnLoad(['js-ckeditor']);</script>

@endsection
