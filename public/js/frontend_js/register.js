(function ($) {
    // Validate register user form
    $("#register_form").validate({
        rules: {
            register_name: {
                required: true,
                minlength: 2
            },
            register_email: {
                required: true,
                email: true,
                remote: "/check-email"
            },
            register_password:{
				required: true,
				minlength: 6,
				maxlength: 20
			},
			register_password_again:{
				required: true,
				minlength: 6,
				maxlength: 20,
				equalTo: "#register_password"
			}
        },
        messages: {
            register_name: {
                required: "Моля въведете Вашите имена",
                minlength: "Минималната дължина на полето е 2 символа"
            },
            register_email: {
                required: "Моля въведете Вашия e-mail адрес",
                email: "Моля въвдете валиден e-mail адрес",
                remote: "Вече има регистриран потребител с този e-mail адрес!"
            },
            register_password: {
                required: "Моля въведете вашата парола",
                minlength: "Вашата парола трябва да бъде най-малко 6 символа",
                maxlength: "Вашата парола трябва да бъде най-много 20 символа"
            },
            register_password_again: {
                required: "Моля въведете вашата парола",
                minlength: "Вашата парола трябва да бъде най-малко 6 символа",
                maxlength: "Вашата парола трябва да бъде най-много 20 символа",
                equalTo: "Въведената от Вас парола не съответства на първата въведена"
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('error');
            $(element).addClass('success');
        }
    });

    // Validate register user form
    $("#home_settings").validate({
        rules: {
            user_name: {
                required: true
            },
            user_phone: {
                required: true
            },
            user_agrrement: {
                required: true
            }
        },
        messages: {
            user_name: {
                required: "Моля въведете Вашите имена"
            },
            user_phone: {
                required: "Моля въведете Вашия телефон за връзка"
            },
            user_agrrement: {
                required: "Необходимо е да се съгласите с Общите ни условия"
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('error');
            $(element).addClass('success');
        }
    });

    // Validate register order form
    $("#order_products").validate({
        rules: {
            user_email: {
                required: true,
                email: true
            }
        },
        messages: {
            user_email: {
                required: "Моля въведете Вашия email адрес",
                email: "Моля въвдете валиден e-mail адрес"
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('error');
            $(element).addClass('success');
        }
    });

    // Validate register product form
    $("#home_firm_product_edit").validate({
        rules: {
            product_name: {
                required: true
            },
            product_code: {
                required: true,
                maxlength: 191,
                remote: "/admin/check-product?id=" + $('#product_id').val()
            },
            price:{
				required:true,
				number:true
			}
        },
        messages: {
            product_name: {
                required: "Моля въведете име на продукта!"
            },
            product_code: {
                required: "Моля въведете код на продукта!",
                maxlength: "Максималната дължина на полето е 191 символа",
                remote: "Вече има регистриран друг продукт с този код! Не можете да го използвате отново!"
            },
            price: {
                required: "Моля въведете цена на продукта!",
                number: "Можете да въвеждате само числа!"
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('error');
            $(element).addClass('success');
        }
    });

})(jQuery);
