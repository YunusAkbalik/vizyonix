@extends('admin.layouts.backend')

@section('css')
    <link rel="stylesheet" href="{{asset("js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css")}}">
    <link rel="stylesheet" href="{{asset("js/plugins/ion-rangeslider/css/ion.rangeSlider.css")}}">
@endsection

@section('content')

    <!-- Page Content -->
    <div class=" content">
        <!-- Your Block -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Kupon Detayları
                </h3>
            </div>
            <div class="block-content">
                <form class="js-validation" method="POST" action="{{route('admin_coupon_store')}}">
                    @csrf
                    <div class="row g-0 justify-content-center">
                        <div class="col-sm-8 col-xl-6">
                            <div class="py-3">
                                <div class="mb-4">
                                    <label for="code" class="form-label">Kupon Kodu</label>
                                    <input type="text" class="form-control " id="code"
                                           name="code" placeholder="Kod">
                                </div>
                                <div class="mb-4">
                                    <label for="discount" class="form-label">İndirim Tutarı</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="any" class="form-control " id="discount"
                                               name="discount" placeholder="29.99">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="min_purchase" class="form-label">Minimum Sipariş Tutarı</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="any" class="form-control " id="min_purchase"
                                               name="min_purchase"
                                               placeholder="50.00">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="usage_limit" class="form-label">Maksimum Kullanım Limiti</label>
                                    <input type="number" class="form-control " id="usage_limit"
                                           name="usage_limit"
                                           placeholder="1">
                                </div>
                                <div class="mb-4">
                                    <label for="usage_date_start" class="form-label">Kullanım Tarih Aralığı</label>
                                    <div class="input-daterange input-group" data-date-format="yyyy-mm-dd"
                                         data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                        <input type="text" class="form-control" id="usage_date_start"
                                               name="usage_date_start" placeholder="Başlangıç Tarihi" data-week-start="1"
                                               data-autoclose="true" data-today-highlight="true"
                                        >
                                        <span class="input-group-text fw-semibold">
                                        <i class="fa fa-fw fa-arrow-right"></i>
                                    </span>
                                        <input type="text" class="form-control" id="usage_date_end"
                                               name="usage_date_end" placeholder="Bitiş Tarihi" data-week-start="1"
                                               data-autoclose="true" data-today-highlight="true"
                                        >
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <select name="status" class="form-control" id="status">
                                        <option value="" selected disabled>Seçiniz</option>
                                        @foreach($statuses as $status)
                                            <option value="{{$status->id}}">{{$status->status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4 d-grid gap-2">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Oluştur
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Your Block -->
    </div>
    <!-- END Page Content -->
@endsection
@section('js')
    <script src="{{asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('js/plugins/dropzone/min/dropzone.min.js')}}"></script>
    <script>Dashmix.helpersOnLoad(['jq-datepicker', 'jq-rangeslider']);</script>
    <script src="{{asset('js/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/plugins/jquery-validation/additional-methods.js')}}"></script>
    <script src="{{asset('js/pages/validations/coupon.js')}}"></script>
@endsection
