
$(document).ready(function(){

	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();

	$('select').select2();

	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#password_validate").validate({
		rules:{
			pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			pwd2:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
    });

    // Validate save product form
    $("#edit_product , #add_product").validate({
        rules: {
            product_code: {
                required: true,
                maxlength: 191,
                remote: "/admin/check-product?id=" + $('#product_id').val()
            }
        },
        messages: {
            product_code: {
                required: "Моля въведете Код на продукта",
                maxlength: "Максималната дължина на полето е 191 символа",
                remote: "Вече има регистриран друг продукт с този код! Не можете да го използвате отново!"
            }
        },
        errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	// Validate save firm form
    $("#edit_firm").validate({
        rules: {
            firm_name: {
                required: true,
                maxlength: 191
			},
			firm_phone: {
                required: true,
                maxlength: 191
			},
			firm_address: {
                required: true,
                maxlength: 191
			}
        },
        messages: {
            firm_name: {
                required: "Моля въведете Име на фирмата",
                maxlength: "Максималната дължина на полето е 191 символа"
			},
			firm_phone: {
                required: "Моля въведете телефон на фирмата",
                maxlength: "Максималната дължина на полето е 191 символа"
			},
			firm_address: {
                required: "Моля въведете адрес на фирмата",
                maxlength: "Максималната дължина на полето е 191 символа"
			}
        },
        errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
    });

	// Validate save user form
    $("#edit_user").validate({
        rules: {
            user_name: {
                required: true,
                maxlength: 191
			},
			user_phone: {
                required: true,
                maxlength: 191
			},
			user_address: {
                required: true,
                maxlength: 191
			}
        },
        messages: {
            user_name: {
                required: "Моля въведете Име на клиента",
                maxlength: "Максималната дължина на полето е 191 символа"
			},
			user_phone: {
                required: "Моля въведете телефон на клиента",
                maxlength: "Максималната дължина на полето е 191 символа"
			},
			user_address: {
                required: "Моля въведете адрес на клиента",
                maxlength: "Максималната дължина на полето е 191 символа"
			}
        },
        errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
    });

	// Validate save add firm form
    $("#add_firm").validate({
        rules: {
            firm_name: {
                required: true,
                maxlength: 191
			},
			register_email: {
                required: true,
                email: true,
                remote: "/check-email"
			},
			firm_phone: {
                required: true,
                maxlength: 191
			},
			firm_address: {
                required: true,
                maxlength: 191
            },
            password:{
				required: true,
				minlength: 6,
				maxlength: 20
			},
			password_again:{
				required: true,
				minlength: 6,
				maxlength: 20,
				equalTo: "#password"
			}
        },
        messages: {
            firm_name: {
                required: "Моля въведете Име на фирмата",
                maxlength: "Максималната дължина на полето е 191 символа"
			},
			register_email: {
                required: "Моля въведете E-Mail на фирмата",
                email: "Невалиден email формат",
                remote: "Вече има регистриран потребител с този e-mail адрес!"
			},
			firm_phone: {
                required: "Моля въведете телефон на фирмата",
                maxlength: "Максималната дължина на полето е 191 символа"
			},
			firm_address: {
                required: "Моля въведете адрес на фирмата",
                maxlength: "Максималната дължина на полето е 191 символа"
            },
            password: {
                required: "Моля въведете вашата парола",
                minlength: "Вашата парола трябва да бъде най-малко 6 символа",
                maxlength: "Вашата парола трябва да бъде най-много 20 символа"
            },
            password_again: {
                required: "Моля въведете вашата парола",
                minlength: "Вашата парола трябва да бъде най-малко 6 символа",
                maxlength: "Вашата парола трябва да бъде най-много 20 символа",
                equalTo: "Въведената от Вас парола не съответства на първата въведена"
            }
        },
        errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
    });

	// Validate save add user form
    $("#add_user").validate({
        rules: {
            user_name: {
                required: true,
                maxlength: 191
			},
			register_email: {
                required: true,
                email: true,
                remote: "/check-email"
			},
			user_phone: {
                required: true,
                maxlength: 191
			},
			user_address: {
                required: true,
                maxlength: 191
            },
            password:{
				required: true,
				minlength: 6,
				maxlength: 20
			},
			password_again:{
				required: true,
				minlength: 6,
				maxlength: 20,
				equalTo: "#password"
			}
        },
        messages: {
            user_name: {
                required: "Моля въведете Име на клиента",
                maxlength: "Максималната дължина на полето е 191 символа"
			},
			register_email: {
                required: "Моля въведете E-Mail на клиента",
                email: "Невалиден email формат",
                remote: "Вече има регистриран потребител с този e-mail адрес!"
			},
			user_phone: {
                required: "Моля въведете телефон на клиента",
                maxlength: "Максималната дължина на полето е 191 символа"
			},
			user_address: {
                required: "Моля въведете адрес на клиента",
                maxlength: "Максималната дължина на полето е 191 символа"
            },
            password: {
                required: "Моля въведете вашата парола",
                minlength: "Вашата парола трябва да бъде най-малко 6 символа",
                maxlength: "Вашата парола трябва да бъде най-много 20 символа"
            },
            password_again: {
                required: "Моля въведете вашата парола",
                minlength: "Вашата парола трябва да бъде най-малко 6 символа",
                maxlength: "Вашата парола трябва да бъде най-много 20 символа",
                equalTo: "Въведената от Вас парола не съответства на първата въведена"
            }
        },
        errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
    });

    $("#edit_price_page").validate({
		rules:{
			paket_standart:{
				required: true,
				number:true
			},
			paket_reklama_1:{
				required:true,
				number:true
			},
			paket_reklama_2:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	// Validate add post form
    $("#add_blog_post").validate({
        rules: {
            title: {
                required: true,
                maxlength: 128
			},
			meta_title: {
                required: true,
                maxlength: 60
			},
			meta_description: {
                required: true,
                maxlength: 160
            },
            meta_keywords:{
				required: meta_keywords
			}
        },
        messages: {
            title: {
                required: "Моля въведете заглавие",
                maxlength: "Максималната дължина на полето е 128 символа"
			},
			meta_title: {
                required: "Моля въведете мета заглавие",
                maxlength: "Максималната дължина на полето е 60"
			},
			meta_description: {
                required: "Моля въведете мета описание",
                maxlength: "Максималната дължина на полето е 160 символа"
            },
            meta_keywords: {
                required: "Моля въведете мета ключови думи"
            }
        },
        errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
		// Validate edit post form
		$("#edit_post").validate({
			rules: {
				title: {
					required: true,
					maxlength: 128
				},
				meta_title: {
					required: true,
					maxlength: 60
				},
				meta_description: {
					required: true,
					maxlength: 160
				},
				meta_keywords:{
					required: meta_keywords
				}
			},
			messages: {
				title: {
					required: "Моля въведете заглавие",
					maxlength: "Максималната дължина на полето е 128 символа"
				},
				meta_title: {
					required: "Моля въведете мета заглавие",
					maxlength: "Максималната дължина на полето е 60"
				},
				meta_description: {
					required: "Моля въведете мета описание",
					maxlength: "Максималната дължина на полето е 160 символа"
				},
				meta_keywords: {
					required: "Моля въведете мета ключови думи"
				}
			},
			errorClass: "help-inline",
			errorElement: "span",
			highlight:function(element, errorClass, validClass) {
				$(element).parents('.control-group').addClass('error');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).parents('.control-group').removeClass('error');
				$(element).parents('.control-group').addClass('success');
			}
		});

});
