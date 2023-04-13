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
                "title": {required: !0, maxlength: 255},
            },
            messages: {
                "title": {
                    required: "Lütfen başlık giriniz",
                    maxlength: "Lütfen geçerli bir başlık giriniz"
                },
            }
        }), jQuery(".js-select2").on("change", (e => {
            jQuery(e.currentTarget).valid()
        }))
    }
    static init() {
        this.initValidation()
    }
}.init()));
