$(document).ready(function(){
	//Usuarios login
	$("button[action='login']").on("click",function(){
		$("#formLogin").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='login']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Usuarios register
	$("button[action='register']").on("click",function(){
		$("#formRegister").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/usuarios/email",
						type: "get"
					}
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				terms: {
					required: true
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.',
					remote: "Este correo ya esta en uso."
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='register']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Recuperar Contraseña
	$("button[action='recovery']").on("click",function(){
		$("#formRecovery").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				recovery: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				}
			},
			messages:
			{
				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				recovery: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='recovery']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Restaurar Contraseña
	$("button[action='reset']").on("click",function(){
		$("#formReset").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='reset']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Perfil
	$("button[action='profile']").on("click",function(){
		$("#formProfile").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				phone: {
					required: false,
					minlength: 5,
					maxlength: 15
				},

				type: {
					required: true
				},

				password: {
					required: false,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				type: {
					required: 'Seleccione una opción.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='profile']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Usuarios
	$("button[action='user']").on("click",function(){
		$("#formUser").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/usuarios/email",
						type: "get"
					}
				},

				phone: {
					required: false,
					minlength: 5,
					maxlength: 15
				},

				type: {
					required: true
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.',
					remote: "Este correo ya esta en uso."
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				type: {
					required: 'Seleccione una opción.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='user']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Banners Create
	$("button[action='banner']").on("click",function(){
		$("#formBanner").validate({
			rules:
			{
				state: {
					required: true
				},				

				image: {
					required: true
				}
			},
			messages:
			{
				state: {
					required: 'Seleccione una opción.'
				},

				image: {
					required: 'Seleccione una imagen.'
				}
			},
			submitHandler: function(form) {
				$("button[action='banner']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Banners Edit
	$("button[action='banner']").on("click",function(){
		$("#formBannerEdit").validate({
			rules:
			{
				image: {
					required: false
				},
				
				state: {
					required: true
				}
			},
			messages:
			{
				state: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='banner']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Categorias
	$("button[action='category']").on("click",function(){
		$("#formCategory").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='category']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Productos
	$("button[action='product']").on("click",function(){
		$("#formProduct").validate({
			rules:
			{
				image: {
					required: false
				},

				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				category_id: {
					required: true
				},

				qty: {
					required: true,
					min: 0
				},

				discount: {
					required: true,
					min: 0,
					max: 100
				},

				description: {
					required: true,
					minlength: 2,
					maxlength: 65000
				},

				price: {
					required: true,
					min: 0
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				category_id: {
					required: 'Seleccione una opción.'
				},

				qty: {
					min: 'Escribe un valor mayor o igual a {0}.'
				},

				discount: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				price: {
					min: 'Escribe un valor mayor o igual a {0}.'
				}
			},
			submitHandler: function(form) {
				$("button[action='product']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Cupones
	$("button[action='coupon']").on("click",function(){
		$("#formCoupon").validate({
			rules:
			{
				discount: {
					required: true,
					min: 0,
					max: 100
				},

				limit: {
					required: true,
					min: 1
				}
			},
			messages:
			{
				discount: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				limit: {
					min: 'Escribe un valor mayor o igual a {0}.'
				}
			},
			submitHandler: function(form) {
				$("button[action='coupon']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Terminos y condiciones
	$("button[action='term']").on("click",function(){
		$("#formTerm").validate({
			rules:
			{
				terms: {
					required: false,
					minlength: 1,
					maxlength: 16770000
				}
			},
			messages:
			{
				terms: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='term']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Políticas
	$("button[action='politic']").on("click",function(){
		$("#formPolitic").validate({
			rules:
			{
				privacity: {
					required: false,
					minlength: 1,
					maxlength: 16770000
				}
			},
			messages:
			{
				privacity: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='politic']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Contactos
	$("button[action='contact']").on("click",function(){
		$("#formContact").validate({
			rules:
			{
				phone: {
					required: false,
					minlength: 5,
					maxlength: 20
				},

				email: {
					required: false,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				address: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				facebook: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				twitter: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				instagram: {
					required: false,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				address: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				facebook: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				twitter: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				instagram: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='contact']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Finalizar Compra
	$("button[action='checkout']").on("click",function(){
		$("#formCheckout").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				shipping: {
					required: true
				},

				address: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				payment: {
					required: true
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				shipping: {
					required: 'Seleccione un opción.'
				},

				address: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				payment: {
					required: 'Seleccione un opción.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='checkout']").attr('disabled', true);
				form.submit();
			}
		});
	});
});