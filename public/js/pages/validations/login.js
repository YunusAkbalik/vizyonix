/*!
 * dashmix - v5.4.0
 * @author pixelcave - https://pixelcave.com
 * Copyright (c) 2022
 */
Dashmix.onLoad((() => class {
    static initValidation() {
        Dashmix.helpers("jq-validation"), jQuery(".js-validation-signin").validate({
            rules: {
                "email": {
                    required: !0, email: !0
                }, "password": {required: !0}
            }, messages: {
                "email": {
                    required: "Lütfen email adresinizi girin",
                    email: "Lütfen geçerli bir email adresi girin"
                }, "password": {
                    required: "Lütfen şifrenizi girin",
                }
            }
        })
    }

    static init() {
        this.initValidation()
    }
}.init()));
