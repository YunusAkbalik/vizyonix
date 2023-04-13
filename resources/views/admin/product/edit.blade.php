@extends('admin.layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{asset('js/plugins/sweetalert2/sweetalert2.min.css')}}">
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Ürün Düzenle</h1>
                <button onclick="deleteProduct({{$product->id}})" class="btn btn-danger"><i class="fa fa-trash"></i>
                    Ürünü Sil
                </button>
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
                        <form class="js-validation" action="{{route('admin_product_update')}}"
                              enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="py-3">
                                <div class="mb-4">
                                    <input type="text" class="form-control form-control-lg form-control-alt"
                                           id="title" name="title" value="{{$product->title}}" placeholder="Başlık">
                                </div>
                                <div class="mb-4">
                                    <textarea id="js-ckeditor" name="description">{{$product->description}}</textarea>
                                </div>
                                <div class="mb-4">
                                    <select name="category_id" id="category_id"
                                            class="form-control form-control-lg form-control-alt">
                                        <option value="" disabled selected>Kategori</option>
                                        @foreach($categories as $category)
                                            <option
                                                {{$product->category->category_id == $category->id ? "selected":""}} value="{{$category->id}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <input type="number" step="any" id="price" name="price"
                                           class="form-control form-control-lg form-control-alt"
                                           value="{{$product->price}}" placeholder="Fiyat ($)">
                                </div>
                                <div class="mb-4">
                                    <label for="main_image[]" class="form-label">Ana Resim</label>
                                    <input class="form-control form-control-lg form-control-alt"
                                           accept="image/png,image/jpg,image/jpeg" type="file" name="main_image[]"
                                           id="main_image[]">
                                    <span class="text-danger">Değiştirmek istemiyorsanız dosya yüklemeyin</span>
                                </div>
                                <div class="mb-4">
                                    <label for="files[]" class="form-label">Ürün Resimleri</label>
                                    <input class="form-control form-control-lg form-control-alt"
                                           accept="image/png,image/jpg,image/jpeg" type="file" name="files[]" multiple
                                           id="files[]">
                                </div>
                                <div class="row">
                                    @foreach($product->image as $image)
                                        <div class="col-md-4 text-center mb-4">
                                            <img src="{{asset($image->path)}}" width="100%" alt="product">
                                            <button onclick="deleteProductImage({{$image->id}} , this)"
                                                    type="button" class="mt-2 btn btn-danger"><i
                                                    class="fa fa-trash"></i> Sil
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mb-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="1" id="on_sale"
                                               name="on_sale" {{$product->on_sale ? "checked":""}}>
                                        <label class="form-check-label" for="on_sale">Satışta</label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <input type="text" class="form-control form-control-lg form-control-alt"
                                           id="link" name="link" value="{{$product->link}}" placeholder="Ürün Linki">
                                </div>
                                @if($product->link)
                                    <div class="mb-4">
                                        <a href="{{$product->link}}" target="_blank">Linke Git</a>
                                    </div>
                                @endif

                            </div>
                            <input type="hidden" name="product_id" value="{{$product->id}}">
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
    <script src="{{asset('js/pages/validations/product_edit.js')}}"></script>
    <script src="{{asset('js/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>Dashmix.helpersOnLoad(['js-ckeditor']);</script>
    <script>
        function deleteProductImage(id, e) {
            Swal.fire({
                title: 'Emin misiniz',
                text: "Bu silme işlemini geri alamazsınız!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, sil!',
                cancelButtonText: "İptal"
            }).then((result) => {
                if (result.isConfirmed) {
                    sendRequest('{{route('admin_product_delete_image')}}', 'POST', {id: id})
                        .then((res) => {
                            $(e).parent().remove()
                            Swal.fire(
                                'Başarılı',
                                res.data.message,
                                'success'
                            )
                        })
                        .catch((e) => {
                            console.log(e)
                            Swal.fire(
                                'Başarısız',
                                e.response.data.message,
                                'error'
                            )
                        })
                }
            })

        }

        function deleteProduct(id) {
            Swal.fire({
                title: 'Emin misiniz',
                text: "Bu silme işlemini geri alamazsınız!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, sil!',
                cancelButtonText: "İptal"
            }).then((result) => {
                if (result.isConfirmed) {
                    sendRequest('{{route('admin_product_destroy')}}', 'POST', {id: id})
                        .then((res) => {
                            Swal.fire(
                                'Başarılı',
                                res.data.message,
                                'success'
                            ).then(() => {
                                location.href = "{{route('admin_product_index')}}"
                            })
                        })
                        .catch((e) => {
                            console.log(e)
                            Swal.fire(
                                'Başarısız',
                                e.response.data.message,
                                'error'
                            )
                        })
                }
            })
        }
    </script>
@endsection
