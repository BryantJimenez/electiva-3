(function($) {

	"use strict";

	$('[data-toggle="tooltip"]').tooltip();

 	// loader
 	var loader = function() {
 		setTimeout(function() { 
 			if($('#ftco-loader').length>0) {
 				$('#ftco-loader').removeClass('show');
 			}
 		}, 1);
 	};
 	loader();

 	$('.int').keypress(function() {
 		return event.charCode >= 48 && event.charCode <= 57;
 	});

 	// Lazy load
 	if($('.lazy').length) {
 		var lazyLoadInstance=new LazyLoad({
 			elements_selector: ".lazy"
 		});
 	}

	// Footer collapse
	if($('footer').length) {
		var headingFooter=$('footer h3');
		$(window).resize(function() {
			if($(window).width() <= 768) {
				headingFooter.attr("data-toggle","collapse");
			} else {
				headingFooter.removeAttr("data-toggle","collapse");
			}
		}).resize();
		headingFooter.on("click", function () {
			$(this).toggleClass('opened');
		});
	}

	// Opacity mask
	if($('.opacity-mask').length) {
		$('.opacity-mask').each(function(){
			$(this).css('background-color', $(this).attr('data-opacity-mask'));
		});
	}

	// Carousel categories
	if($('.categories_carousel').length) {
		$('.categories_carousel').owlCarousel({
			center: false,
			stagePadding: 50,
			items: 1,
			loop: false,
			margin: 20,
			dots: false,
			nav: true,
			lazyLoad: true,
			navText: ["<i class='arrow_left'></i>","<i class='arrow_right'></i>"],
			responsive: {
				0: {
					nav: false,
					dots: false,
					items: 2
				},
				600: {
					nav: false,
					dots: false,
					items: 2
				},
				768: {
					nav: false,
					dots: false,
					items: 4
				},
				1025: {
					nav: true,
					dots: false,
					items: 4
				},
				1340: {
					nav: true,
					dots: false,
					items: 5
				},
				1460: {
					nav: true,
					dots: false,
					items: 5
				}
			}
		});
	}

	// Secondary fixed
	if($('.sticky_horizontal').length) {
		$('.sticky_horizontal').stick_in_parent({
			offset_top: 0
		});
	}

	// Secondary scroll
	if($('.secondary_nav').length) {
		$('.secondary_nav').find('a').on('click', function(e) {
			e.preventDefault();
			var target = this.hash;
			var $target = $(target);
			$('html, body').animate({
				'scrollTop': $target.offset().top - 60
			}, 700, 'swing');
		});
	}

	// Sticky sidebar
	if($('#sidebar_fixed').length) {
		$('#sidebar_fixed').theiaStickySidebar({
			minWidth: 991,
			updateSidebarHeight: false,
			containerSelector: '',
			additionalMarginTop: 90
		});
	}

	// Drodown options prevent close
	if($('.dropdown-options').length) {
		$('.dropdown-options .dropdown-menu').on("click", function(e) { e.stopPropagation(); });
	}

	//touchspin
	if ($('.qty-max').length) {
		var max=$(".qty-max").attr('max');
		$(".qty-max").TouchSpin({
			min: 1,
			max: max,
			buttondown_class: 'btn desc button_inc',
			buttonup_class: 'btn inc button_inc'
		});
	}

	if ($('.min').length) {
		$('.min').TouchSpin({
			min: 0,
			max: 9999999,
			buttondown_class: 'btn btn-lg btn-danger px-2 py-1 rounded-0',
			buttonup_class: 'btn btn-lg btn-danger px-2 py-1 rounded-0'
		});
	}

	if ($('.max').length) {
		$('.max').TouchSpin({
			min: 0,
			max: 9999999,
			buttondown_class: 'btn btn-lg btn-danger px-2 py-1 rounded-0',
			buttonup_class: 'btn btn-lg btn-danger px-2 py-1 rounded-0'
		});
	}

	if ($('.qty').length) {
		$(".qty").each(function(){
			var max=$(this).attr('max');
			$(this).TouchSpin({
				min: 1,
				max: max,
				buttondown_class: 'btn btn-lg btn-danger px-2 py-1 rounded-0',
				buttonup_class: 'btn btn-lg btn-danger px-2 py-1 rounded-0'
			});
		});
	}

 	//Lightslider
 	if ($("#lightgallery-product").length) {
 		$('#lightgallery-product').lightSlider({
 			gallery: true,
 			item: 1,
 			thumbItem: 5,
 			vThumbWidth: 70,
 			vThumbHeight: 80,
 			slideMargin: 0,
 			enableDrag: false
 		});
 	}

	// Lightgallery
	if ($("#lightgallery-product").length) {
		$("#lightgallery-product").lightGallery();
	}

	//dropify para input file más personalizado
	if ($('.dropify').length) {
		$('.dropify').dropify({
			messages: {
				default: 'Arrastre y suelte una imagen o da click para seleccionarla',
				replace: 'Arrastre y suelte una imagen o haga click para reemplazar',
				remove: 'Remover',
				error: 'Lo sentimos, el archivo es demasiado grande'
			},
			error: {
				'fileSize': 'El tamaño del archivo es demasiado grande ({{ value }} máximo).',
				'minWidth': 'El ancho de la imagen es demasiado pequeño ({{ value }}}px mínimo).',
				'maxWidth': 'El ancho de la imagen es demasiado grande ({{ value }}}px máximo).',
				'minHeight': 'La altura de la imagen es demasiado pequeña ({{ value }}}px mínimo).',
				'maxHeight': 'La altura de la imagen es demasiado grande ({{ value }}px máximo).',
				'imageFormat': 'El formato de imagen no está permitido (Debe ser {{ value }}).'
			}
		});
	}
})(jQuery);

// Sticky nav
if($('.element_to_stick').length) {
	$(window).on('scroll', function () {
		if ($(this).scrollTop() > 1) {
			$('.element_to_stick').addClass("sticky");
		} else {
			$('.element_to_stick').removeClass("sticky");
		}
	});
	$(window).scroll();
}

// Menu
$('a.open_close').on("click", function () {
	$('.main-menu').toggleClass('show');
	$('.layer').toggleClass('layer-is-visible');
});
$('a.show-submenu').on("click", function () {
	$(this).next().toggleClass("show_normal");
});

// Scroll to top
if($('#toTop').length) {
	var pxShow = 800; // height on which the button will show
	var scrollSpeed = 500; // how slow / fast you want the button to scroll to top.
	$(window).scroll(function(){
		if($(window).scrollTop() >= pxShow){
			$("#toTop").addClass('visible');
		} else {
			$("#toTop").removeClass('visible');
		}
	});
	$('#toTop').on('click', function(){
		$('html, body').animate({scrollTop:0}, scrollSpeed);
		return false;
	});
}

// Reserve Fixed on mobile
if($('.btn_reserve_fixed').length) {
	$('.btn_reserve_fixed a').on('click', function() {
		$(".box_order").show();
	});
	$(".close_panel_mobile").on('click', function (event){
		event.stopPropagation();
		$(".box_order").hide();
	});
}

// Cambiar min y max de inputs touchspins en tienda
$('.min').change(function() {
	$('.max').trigger("touchspin.updatesettings", {min: $(this).val()});
});

$('.min').keyup(function() {
	$('.max').trigger("touchspin.updatesettings", {min: $(this).val()});
});

$('.max').change(function() {
	if ($('.min').val()!="" && $('.max').val()<$('.min').val()) {
		$('.max').val($('.min').val());
	}
	$('.min').trigger("touchspin.updatesettings", {max: $(this).val()});
});

$('.max').keyup(function() {
	if ($('.min').val()!="" && $('.max').val()<$('.min').val()) {
		$('.max').val($('.min').val());
	}
	$('.min').trigger("touchspin.updatesettings", {max: $(this).val()});
});

// Calcular precio al cambiar la cantidad del producto
$('#product-qty-cart').change(function() {
	priceFormat($(this));
});

$('#product-qty-cart').keyup(function() {
	priceFormat($(this));
});

function priceFormat(element) {
	var price=parseFloat(element.attr('price')), qty=element.val(), discount=element.attr('discount');
	var priceNew=parseFloat(price*qty);
	if (discount>0) {
		priceNew=(priceNew-((priceNew*discount)/100));
	}
	var total=new Intl.NumberFormat("de-DE", {style: 'decimal', minimumFractionDigits: 2}).format(priceNew);
	$('#price-product-add-cart').text("$"+total);
}

// Agregar producto del carrito
$('#product-add-cart').click(function(event) {
	var product=$(this).attr('slug'), qty=$('#product-qty-cart').val();
	$('#product-add-cart').attr('disabled', true);
	$.ajax({
		url: '/carrito',
		type: 'POST',
		dataType: 'json',
		data: {product: product, qty: qty},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	})
	.done(function(obj) {
		$('#product-add-cart').attr('disabled', false);
		if (obj.status) {
			Lobibox.notify('success', {
				title: 'Producto agregado',
				sound: true,
				msg: 'El producto a sido agregado al carrito exitosamente.'
			});
		} else {
			Lobibox.notify('error', {
				title: 'Error',
				sound: true,
				msg: 'Ha ocurrido un problema, intentelo nuevamente.'
			});
		}
	})
	.fail(function() {
		$('#product-add-cart').attr('disabled', false);
		Lobibox.notify('error', {
			title: 'Error',
			sound: true,
			msg: 'Ha ocurrido un problema, intentelo nuevamente.'
		});
	});
});

//Al cambiar la cantidad de un producto en el carrito cambia el total
$('.qty').change(function() {
	qtyCart($(this));
});

$('.qty').keyup(function() {
	qtyCart($(this));
});

function qtyCart(element) {
	var code=element.attr('code'), slug=element.attr('slug'), qty=element.val();
	$.ajax({
		url: '/carrito/cantidad',
		type: 'POST',
		dataType: 'json',
		data: {qty: qty, slug: slug, code: code},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	})
	.done(function(obj) {
		if (obj.status) {
			var price=new Intl.NumberFormat("de-DE", {style: 'decimal', minimumFractionDigits: 2}).format(obj.subtotal);
			$('.total[code="'+code+'"]').text("$"+price);
			var subtotal=0, discount=$('#discount-cart').attr('percentage'), total=0;
			$(".qty").each(function(){
				var price=parseFloat($(this).attr('price')), qty=$(this).val(), discount=$(this).attr('discount');
				var priceNew=parseFloat(price*qty);
				if (discount>0) {
					priceNew=(priceNew-((priceNew*discount)/100));
				}
				subtotal+=priceNew;
			});
			var subtotalFormat=new Intl.NumberFormat("de-DE", {style: 'decimal', minimumFractionDigits: 2}).format(subtotal);
			$('#subtotal-cart').text("$"+subtotalFormat);
			discount=parseFloat(((subtotal*discount)/100));
			var discountFormat=new Intl.NumberFormat("de-DE", {style: 'decimal', minimumFractionDigits: 2}).format(discount);
			$('#discount-cart').text("$"+discountFormat);
			total=subtotal-discount;
			var totalFormat=new Intl.NumberFormat("de-DE", {style: 'decimal', minimumFractionDigits: 2}).format(total);
			$('#total-cart').text("$"+totalFormat);
		} else {
			Lobibox.notify('error', {
				title: 'Error',
				sound: true,
				msg: 'Ha ocurrido un problema, intentelo nuevamente.'
			});
		}
	})
	.fail(function() {
		Lobibox.notify('error', {
			title: 'Error',
			sound: true,
			msg: 'Ha ocurrido un problema, intentelo nuevamente.'
		});
	});
}

//Quitar producto del carrito
$('.product-remove a').click(function() {
	var code=$(this).attr('code');
	$.ajax({
		url: '/carrito/quitar',
		type: 'POST',
		dataType: 'json',
		data: {code: code},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	}).done(function(obj) {
		if (obj.status) {
			$(".cart-product[code='"+code+"']").remove();
			var subtotal=0, discount=$('#discount-cart').attr('percentage'), total=0;
			$(".qty").each(function(){
				var price=parseFloat($(this).attr('price')), qty=$(this).val(), discount=$(this).attr('discount');
				var priceNew=parseFloat(price*qty);
				if (discount>0) {
					priceNew=(priceNew-((priceNew*discount)/100));
				}
				subtotal+=priceNew;
			});
			var subtotalFormat=new Intl.NumberFormat("de-DE", {style: 'decimal', minimumFractionDigits: 2}).format(subtotal);
			$('#subtotal-cart').text("$"+subtotalFormat);
			discount=parseFloat(((subtotal*discount)/100));
			var discountFormat=new Intl.NumberFormat("de-DE", {style: 'decimal', minimumFractionDigits: 2}).format(discount);
			$('#discount-cart').text("$"+discountFormat);
			total=subtotal-discount;
			var totalFormat=new Intl.NumberFormat("de-DE", {style: 'decimal', minimumFractionDigits: 2}).format(total);
			$('#total-cart').text("$"+totalFormat);
			Lobibox.notify('success', {
				title: 'Producto eliminado',
				sound: true,
				msg: 'El producto ha sido removido del carrito exitosamente.'
			});
		} else {
			Lobibox.notify('error', {
				title: 'Error',
				sound: true,
				msg: 'Ha ocurrido un problema, intentelo nuevamente.'
			});
		}
	})
	.fail(function() {
		Lobibox.notify('error', {
			title: 'Error',
			sound: true,
			msg: 'Ha ocurrido un problema, intentelo nuevamente.'
		});
	});
});

//Quitar producto del pedido
$('#list-cart li a').click(function() {
	var code=$(this).parent().attr('code');
	removeProduct(code);
});

function removeProduct(code) {
	$.ajax({
		url: '/carrito/quitar',
		type: 'POST',
		dataType: 'json',
		data: {code: code},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	}).done(function(obj) {
		if (obj.status) {
			$("#list-cart li[code='"+code+"']").fadeOut('slow', function() {
				$("#list-cart li[code='"+code+"']").remove();

				if ($("#list-cart li[code]").length>0) {
					var discount=parseFloat($("#discount").attr('discount')), percentage=parseInt($("#discount").attr('percentage')), subtotal=0;
					$("#list-cart li[code]").each(function(){
						var price=$(this).attr('price')*$(this).attr('qty');
						subtotal+=price;
					});
				} else {
					$('#list-cart').append($('<li>', {
						class: "text-danger text-center font-weight-bold cart-empty my-2",
						text: "Pedido Vacio"
					}));
					var discount=0.00, percentage=0, subtotal=0;
					$("#discount").attr('discount', '0.00');
					$("#discount").text('- $0,00');
				}
				var discount=(subtotal*percentage)/100;
				var discountFormat=new Intl.NumberFormat("de-DE", {style: 'decimal', minimumFractionDigits: 2}).format(discount);
				var subtotalFormat=new Intl.NumberFormat("de-DE", {style: 'decimal', minimumFractionDigits: 2}).format(subtotal);
				$('#subtotal').attr('subtotal', subtotal);
				$('#subtotal').text("$"+subtotalFormat);
				var total=subtotal-discount;
				var totalFormat=new Intl.NumberFormat("de-DE", {style: 'decimal', minimumFractionDigits: 2}).format(total);
				$('#total').attr('total', total);
				$('#total').text("$"+totalFormat);
			});

			Lobibox.notify('success', {
				title: 'Producto eliminado',
				sound: true,
				msg: 'El producto ha sido removido del carrito exitosamente.'
			});
		} else {
			Lobibox.notify('error', {
				title: 'Error',
				sound: true,
				msg: 'Ha ocurrido un problema, intentelo nuevamente.'
			});
		}
	})
	.fail(function() {
		Lobibox.notify('error', {
			title: 'Error',
			sound: true,
			msg: 'Ha ocurrido un problema, intentelo nuevamente.'
		});
	});
}

// Abrir y cerrar agregar cupones
$('#btn-coupon').click(function(event) {
	toggleBtnCoupon();
});

function toggleBtnCoupon() {
	$("#card-add-coupon").toggle(800);
	if ($('#btn-coupon').hasClass('open')) {
		$('#btn-coupon').text('Agregar cupón de descuento');
		$('#btn-coupon').removeClass('open');
	} else {
		$('#btn-coupon').text('Cerrar cupón de descuento');
		$('#btn-coupon').addClass('open');
	}
}

// Agregar cupón
$('#btn-add-coupon').click(function() {
	addCoupon();
});

function addCoupon() {
	$("#card-add-coupon .validate-coupon").addClass('d-none');
	$('#btn-add-coupon').attr('disabled', true);
	var coupon=$('#input-coupon').val();
	if (coupon!="") {
		$.ajax({
			url: '/cupon/agregar',
			type: 'POST',
			dataType: 'json',
			data: {coupon: coupon},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		})
		.done(function(obj) {
			if (obj.state) {
				$("#div-coupon div").remove();
				$("#div-coupon").html('<div class="alert alert-success">'+
					'<div>'+
					'<p class="mb-1">El cupón de descuendo ha sido agregado</p>'+
					'<a href="javascript:void(0);" id="remove-coupon">Quitar cupón</a>'+
					'</div>'+
					'<div>');

				// Quitar cupón
				$('#remove-coupon').on('click', function() {
					removeCoupon();
				});

				var subtotal=parseFloat($("#subtotal").attr('subtotal'));
				var discount=(subtotal*parseInt(obj.discount))/100;
				var discountFormat=new Intl.NumberFormat("de-DE", {style: 'decimal', minimumFractionDigits: 2}).format(discount);
				var total=subtotal-discount;
				var totalFormat=new Intl.NumberFormat("de-DE", {style: 'decimal', minimumFractionDigits: 2}).format(total);

				$("#discount").attr('discount', discount.toFixed(2));
				$("#discount").attr('percentage', obj.discount);
				$("#discount").text('- $'+discountFormat);
				$("#total").attr('total', total.toFixed(2));
				$("#total").text('$'+totalFormat);
				Lobibox.notify('success', {
					title: 'Cupón agregado',
					sound: true,
					msg: 'El cupón ha sido agregado exitosamente.'
				});
			} else {
				$('#btn-add-coupon').attr('disabled', false);
				Lobibox.notify('error', {
					title: obj.title,
					sound: true,
					msg: obj.message
				});
			}
		})
		.fail(function() {
			$('#btn-add-coupon').attr('disabled', false);
			Lobibox.notify('error', {
				title: 'Error',
				sound: true,
				msg: 'Ha ocurrido un problema, intentelo nuevamente.'
			});
		});
	} else {
		if (coupon=="") {
			$("#card-add-coupon .validate-coupon").removeClass('d-none');
		}
		$('#btn-add-coupon').attr('disabled', false);
	}
}

// Quitar cupón
$('#remove-coupon').click(function() {
	removeCoupon();
});

function removeCoupon() {
	$.ajax({
		url: '/cupon/quitar',
		type: 'POST',
		dataType: 'json',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	})
	.done(function(obj) {
		if (obj.state) {
			$("#div-coupon div").remove();
			$("#div-coupon").html('<a href="javascript:void(0);" id="btn-coupon">Agregar cupón de descuento</a>'+
				'<div class="row" style="display: none;" id="card-add-coupon">'+
				'<div class="form-group col-lg-8 col-md-8 col-12">'+
				'<input type="text" class="form-control" name="coupon" placeholder="Introduzca un coupon" id="input-coupon">'+
				'<p class="text-danger font-weight-bold validate-coupon d-none mb-0">Este campo es requerido</p>'+
				'</div>'+
				'<div class="form-group col-lg-4 col-md-4 col-12">'+
				'<button type="button" class="btn_1 gradient full-width mb_5" id="btn-add-coupon">Agregar</button>'+
				'</div>'+
				'</div>');

			// Abrir y cerrar agregar cupones
			$('#btn-coupon').on('click', function(event) {
				toggleBtnCoupon();
			});

			// Agregar cupón
			$('#btn-add-coupon').on('click', function() {
				addCoupon();
			});

			var subtotal=parseFloat($("#subtotal").attr('subtotal'));
			var total=subtotal;
			var totalFormat=new Intl.NumberFormat("de-DE", {style: 'decimal', minimumFractionDigits: 2}).format(total);
			$("#discount").attr('discount', '0.00');
			$("#discount").attr('percentage', '0');
			$("#discount").text('- $0,00');
			$("#total").attr('total', total);
			$("#total").text('$'+totalFormat);
			Lobibox.notify('success', {
				title: 'Cupón Removido',
				sound: true,
				msg: 'El cupón ha sido removido exitosamente.'
			});
		} else {
			Lobibox.notify('error', {
				title: 'Error',
				sound: true,
				msg: 'Ha ocurrido un problema, intentelo nuevamente.'
			});
		}
	})
	.fail(function() {
		Lobibox.notify('error', {
			title: 'Error',
			sound: true,
			msg: 'Ha ocurrido un problema, intentelo nuevamente.'
		});
	});
}

// Cambiar metodo de entrega
$("input[name='shipping']").click(function() {
	if ($('#list-cart .cart-empty').length==0) {
		$('button[action="checkout"]').attr('disabled', false);
	}
	if($(this).is(':checked')) {  
		if ($("input[name='shipping']:checked").val()=="3") {
			$('#address-checkout').removeClass('d-none');
			$('#address-checkout input').attr('disabled', false);
		} else {
			$('#address-checkout').addClass('d-none');
			$('#address-checkout input').attr('disabled', true);
		}
	} else {
		$('#address-checkout').addClass('d-none');
		$('#address-checkout input').attr('disabled', true);
		$('button[action="checkout"]').attr('disabled', true);
	}
});