/*!
 * dashmix - v5.4.0
 * @author pixelcave - https://pixelcave.com
 * Copyright (c) 2022
 */
Dashmix.onLoad((() => class {
    static initValidation() {
        Dashmix.helpers("jq-validation"), jQuery(".js-validation").validate({
            ignore: [],
            rules: {
                "code": {required: !0, maxlength: 255},
                "discount": {required: !0, number: !0},
                "min_purchase": {required: !0, number: !0},
                "usage_limit": {required: !0, number: !0},
                "usage_date_start": {required: !0},
                "usage_date_end": {required: !0},
                "status": {required: !0},
            },
            messages: {
                "code": {
                    required: "Lütfen kupon kodu giriniz",
                    maxlength: "Lütfen geçerli bir kupon kodu giriniz"
                },
                "discount": {
                    required: "Lütfen indirim tutarı giriniz",
                    numeric: "Lütfen geçerli bir indirim tutarı giriniz"
                },
                "min_purchase": {
                    required: "Lütfen minimum sipariş tutarı giriniz",
                    numeric: "Lütfen geçerli bir minimum sipariş tutarı giriniz"
                },
                "usage_limit": {
                    required: "Lütfen maksimum kullanım limiti giriniz",
                    numeric: "Lütfen geçerli bir maksimum kullanım limiti giriniz"
                },
                "usage_date_start": "Lütfen geçerli bir kullanım tarih aralığı seçiniz",
                "usage_date_end": "Lütfen geçerli bir kullanım tarih aralığı seçiniz",
                "status": "Lütfen kupon durumunu seçiniz"
            }
        }), jQuery(".js-select2").on("change", (e => {
            jQuery(e.currentTarget).valid()
        }))
    }

    static init() {
        this.initValidation()
    }
}.init()));
