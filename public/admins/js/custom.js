/*
=========================================
|                                       |
|           Scroll To Top               |
|                                       |
=========================================
*/ 
$('.scrollTop').click(function() {
  $("html, body").animate({scrollTop: 0});
});


$('.navbar .dropdown.notification-dropdown > .dropdown-menu, .navbar .dropdown.message-dropdown > .dropdown-menu ').click(function(e) {
  e.stopPropagation();
});

/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

  var checker = $('#' + clickchk);
  var multichk = $('.' + relChkbox);


  checker.click(function () {
    multichk.prop('checked', $(this).prop('checked'));
  });    
}


/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
    */

    function multiCheck(tb_var) {
      tb_var.on("change", ".chk-parent", function() {
        var e=$(this).closest("table").find("td:first-child .child-chk"), a=$(this).is(":checked");
        $(e).each(function() {
          a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
      }),
      tb_var.on("change", "tbody tr .new-control", function() {
        $(this).parents("tr").toggleClass("active")
      })
    }

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

  var checker = $('#' + clickchk);
  var multichk = $('.' + relChkbox);


  checker.click(function () {
    multichk.prop('checked', $(this).prop('checked'));
  });    
}

/*
=========================================
|                                       |
|               Tooltips                |
|                                       |
=========================================
*/

$('.bs-tooltip').tooltip();

/*
=========================================
|                                       |
|               Popovers                |
|                                       |
=========================================
*/

$('.bs-popover').popover();


/*
================================================
|                                              |
|               Rounded Tooltip                |
|                                              |
================================================
*/

$('.t-dot').tooltip({
  template: '<div class="tooltip status rounded-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
})


/*
================================================
|            IE VERSION Dector                 |
================================================
*/

function GetIEVersion() {
  var sAgent = window.navigator.userAgent;
  var Idx = sAgent.indexOf("MSIE");

  // If IE, return version number.
  if (Idx > 0) 
    return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

  // If IE 11 then look for Updated user agent string.
  else if (!!navigator.userAgent.match(/Trident\/7\./)) 
    return 11;

  else
    return 0; //It is not IE
}

//////// Scripts ////////
$(document).ready(function() {
  //Validación para introducir solo números
  $('.dni, .int, .number, #phone').keypress(function() {
    return event.charCode >= 48 && event.charCode <= 57;
  });
  //Validación para introducir solo letras y espacios
  $('#name, #lastname, .only-letters').keypress(function() {
    return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32;
  });
  //Validación para solo presionar enter y borrar
  $('.date').keypress(function() {
    return event.charCode == 32 || event.charCode == 127;
  });

  //select2
  if ($('.select2').length) {
    $('.select2').select2({
      language: "es",
      placeholder: "Seleccione",
      tags: true
    });
  }

  //Datatables normal
  if ($('.table-normal').length) {
    $('.table-normal').DataTable({
      "oLanguage": {
        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
        "sInfo": "Resultados del _START_ al _END_ de un total de _TOTAL_ registros",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Buscar...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sProcessing":     "Procesando...",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún resultado disponible en esta tabla",
        "sInfoEmpty":      "No hay resultados",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      },
      "stripeClasses": [],
      "lengthMenu": [10, 20, 50, 100, 200, 500],
      "pageLength": 10
    });
  }

  if ($('.table-export').length) {
    $('.table-export').DataTable({
      dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
      buttons: {
        buttons: [
        { extend: 'copy', className: 'btn' },
        { extend: 'csv', className: 'btn' },
        { extend: 'excel', className: 'btn' },
        { extend: 'print', className: 'btn' }
        ]
      },
      "oLanguage": {
        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
        "sInfo": "Resultados del _START_ al _END_ de un total de _TOTAL_ registros",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Buscar...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sProcessing":     "Procesando...",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún resultado disponible en esta tabla",
        "sInfoEmpty":      "No hay resultados",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
          "copy": "Copiar",
          "print": "Imprimir"
        }
      },
      "stripeClasses": [],
      "lengthMenu": [10, 20, 50, 100, 200, 500],
      "pageLength": 10
    });
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

  //datepicker material
  if ($('.dateMaterial').length) {
    $('.dateMaterial').bootstrapMaterialDatePicker({
      lang : 'es',
      time: false,
      cancelText: 'Cancelar',
      clearText: 'Limpiar',
      format: 'DD-MM-YYYY',
      maxDate : new Date()
    });
  }

  // flatpickr
  if ($('#flatpickr').length) {
    flatpickr(document.getElementById('flatpickr'), {
      locale: 'es',
      enableTime: false,
      dateFormat: "d-m-Y",
      maxDate : "today"
    });
  }

  //touchspin
  if ($('.number').length) {
    $(".number").TouchSpin({
      min: 0,
      max: 999999999,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  if ($('.int').length) {
    $(".int").TouchSpin({
      min: 1,
      max: 999999999,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  if ($('.decimal').length) {
    $(".decimal").TouchSpin({
      min: 0,
      max: 999999999,
      step: 0.50,
      decimals: 2,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  if ($('.discount').length) {
    $(".discount").TouchSpin({
      min: 0,
      max: 100,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  // CKeditor plugin
  if ($('#content-term').length) {
    CKEDITOR.config.height=400;
    CKEDITOR.config.width='auto';
    CKEDITOR.replace('content-term');
  }

  if ($('#content-privacity').length) {
    CKEDITOR.config.height=400;
    CKEDITOR.config.width='auto';
    CKEDITOR.replace('content-privacity');
  }

  if ($('#content-schedule').length) {
    CKEDITOR.config.height=150;
    CKEDITOR.config.width='auto';
    CKEDITOR.replace('content-schedule');
  }

  // Función para habilitar o deshabilitar opciones de los selects si ya estan seleccionadas
  if ($('#product-variants').length) {
    validateProductVariant();
  }
});

// funcion para cambiar el input hidden al cambiar el switch de estado
$('#stateCheckbox').change(function(event) {
  if ($(this).is(':checked')) {
    $('#stateHidden').val(1);
  } else {
    $('#stateHidden').val(0);
  }
});

//funciones para desactivar, activar y esperar
function deactiveUser(slug) {
  $("#deactiveUser").modal();
  $('#formDeactiveUser').attr('action', '/admin/usuarios/' + slug + '/desactivar');
}

function activeUser(slug) {
  $("#activeUser").modal();
  $('#formActiveUser').attr('action', '/admin/usuarios/' + slug + '/activar');
}

function deactiveBanner(slug) {
  $("#deactiveBanner").modal();
  $('#formDeactiveBanner').attr('action', '/admin/banners/' + slug + '/desactivar');
}

function activeBanner(slug) {
  $("#activeBanner").modal();
  $('#formActiveBanner').attr('action', '/admin/banners/' + slug + '/activar');
}

function deactiveCategory(slug) {
  $("#deactiveCategory").modal();
  $('#formDeactiveCategory').attr('action', '/admin/categorias/' + slug + '/desactivar');
}

function activeCategory(slug) {
  $("#activeCategory").modal();
  $('#formActiveCategory').attr('action', '/admin/categorias/' + slug + '/activar');
}

function deactiveProduct(slug) {
  $("#deactiveProduct").modal();
  $('#formDeactiveProduct').attr('action', '/admin/productos/' + slug + '/desactivar');
}

function activeProduct(slug) {
  $("#activeProduct").modal();
  $('#formActiveProduct').attr('action', '/admin/productos/' + slug + '/activar');
}

function deactiveOrder(slug) {
  $("#deactiveOrder").modal();
  $('#formDeactiveOrder').attr('action', '/admin/pedidos/' + slug + '/desactivar');
}

function activeOrder(slug) {
  $("#activeOrder").modal();
  $('#formActiveOrder').attr('action', '/admin/pedidos/' + slug + '/activar');
}

function deactivePayment(slug) {
  $("#deactivePayment").modal();
  $('#formDeactivePayment').attr('action', '/admin/pagos/' + slug + '/desactivar');
}

function activePayment(slug) {
  $("#activePayment").modal();
  $('#formActivePayment').attr('action', '/admin/pagos/' + slug + '/activar');
}

function deactiveGroup(slug) {
  $("#deactiveGroup").modal();
  $('#formDeactiveGroup').attr('action', '/admin/grupos/' + slug + '/desactivar');
}

function activeGroup(slug) {
  $("#activeGroup").modal();
  $('#formActiveGroup').attr('action', '/admin/grupos/' + slug + '/activar');
}

function deactiveDepartment(slug) {
  $("#deactiveDepartment").modal();
  $('#formDeactiveDepartment').attr('action', '/admin/departamentos/' + slug + '/desactivar');
}

function activeDepartment(slug) {
  $("#activeDepartment").modal();
  $('#formActiveDepartment').attr('action', '/admin/departamentos/' + slug + '/activar');
}

function waitItem(slug, id) {
  $("#waitItem").modal();
  $('#formWaitItem').attr('action', '/admin/departamentos/' + slug + '/detalles/' + id + '/esperar');
}

function activeItem(slug, id) {
  $("#activeItem").modal();
  $('#formActiveItem').attr('action', '/admin/departamentos/' + slug + '/detalles/' + id + '/activar');
}

function deactiveTable(slug) {
  $("#deactiveTable").modal();
  $('#formDeactiveTable').attr('action', '/admin/mesas/' + slug + '/desactivar');
}

function activeTable(slug) {
  $("#activeTable").modal();
  $('#formActiveTable').attr('action', '/admin/mesas/' + slug + '/activar');
}

//funciones para preguntar al eliminar
function deleteUser(slug) {
  $("#deleteUser").modal();
  $('#formDeleteUser').attr('action', '/admin/usuarios/' + slug);
}

function deleteBanner(slug) {
  $("#deleteBanner").modal();
  $('#formDeleteBanner').attr('action', '/admin/banners/' + slug);
}

function deleteCategory(slug) {
  $("#deleteCategory").modal();
  $('#formDeleteCategory').attr('action', '/admin/categorias/' + slug);
}

function deleteProduct(slug) {
  $("#deleteProduct").modal();
  $('#formDeleteProduct').attr('action', '/admin/productos/' + slug);
}

function deleteGroup(slug) {
  $("#deleteGroup").modal();
  $('#formDeleteGroup').attr('action', '/admin/grupos/' + slug);
}

function deleteCoupon(slug) {
  $("#deleteCoupon").modal();
  $('#formDeleteCoupon').attr('action', '/admin/cupones/' + slug);
}

function deleteSize(slug) {
  $("#deleteSize").modal();
  $('#formDeleteSize').attr('action', '/admin/tamanos/' + slug);
}

function deleteDepartment(slug) {
  $("#deleteDepartment").modal();
  $('#formDeleteDepartment').attr('action', '/admin/departamentos/' + slug);
}

function deleteTable(slug) {
  $("#deleteTable").modal();
  $('#formDeleteTable').attr('action', '/admin/mesas/' + slug);
}

// Agregar Variantes de Productos
$('#add-variants').click(function(event) {
  var count=parseInt($('#product-variants div[variant]:last-child').attr('variant'))+1;

  $('#product-variants').append($('<div>', {
    class: 'row',
    variant: count
  }));
  $('#product-variants div[variant="'+count+'"]').html('<div class="col-12">'+
    '<hr class="my-2">'+
    '</div>'+
    '<div class="form-group col-xl-4 col-lg-4 col-md-4 col-12">'+
    '<label class="col-form-label">Tamaño<b class="text-danger">*</b></label>'+
    '<select class="form-control" name="size_id[]" required  id="size_id_'+count+'">'+
    '<option value="">Seleccione</option>'+
    '</select>'+
    '</div>'+
    '<div class="form-group col-xl-4 col-lg-4 col-md-4 col-12">'+
    '<label class="col-form-label">Precio<b class="text-danger">*</b></label>'+
    '<input class="form-control decimal" type="text" name="price[]" required placeholder="Introduzca el precio" value="0.00" id="price_'+count+'">'+
    '</div>'+
    '<div class="form-group col-xl-3 col-lg-3 col-md-3 col-10">'+
    '<label class="col-form-label">Estado<b class="text-danger">*</b></label>'+
    '<select class="form-control" name="state[]" required id="state_'+count+'">'+
    '<option value="1">Disponible</option>'+
    '<option value="0">No Disponible</option>'+
    '</select>'+
    '</div>'+
    '<div class="form-group col-xl-1 col-lg-1 col-md-1 col-2 d-flex align-items-end">'+
    '<a href="javascript:void(0);" class="text-danger variant-remove mb-3" variant="'+count+'">'+
    '<i class="fa fa-trash"></i>'+
    '</a>'+
    '</div>');

  $('#size_id_0 option[value!=""]').each(function(index, el) {
    $("#size_id_"+count).append($('<option>', {
      value: el.value,
      text: el.text
    }));
  });

  $("select[name='size_id[]']").each(function(index, el) {
    if (el.value!="") {
      $("#size_id_"+count+" option[value='"+el.value+"']").attr('disabled', true);
    }
  });

  if ($('.decimal').length) {
    $(".decimal").TouchSpin({
      min: 0,
      max: 999999999,
      step: 0.50,
      decimals: 2,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  // Función para remover variantes
  $('.variant-remove[variant="'+count+'"]').on('click', function(event) {
    $('#product-variants div[variant="'+$(this).attr('variant')+'"]').remove();
    validateProductVariant();
  });

  // Función para habilitar o deshabilitar opciones de los selects si ya estan seleccionadas
  $("#product-variants div[variant='"+count+"'] select[name='size_id[]']").on('change', function(event) {
    validateProductVariant();
  });
});

// Función para remover variantes
$('.variant-remove').click(function(event) {
  $('#product-variants div[variant="'+$(this).attr('variant')+'"]').remove();
  validateProductVariant();
});

// Función para habilitar o deshabilitar opciones de los selects si ya estan seleccionadas
$("select[name='size_id[]']").change(function(event) {
  validateProductVariant();
});

// Función para habilitar o deshabilitar opciones de los selects si ya estan seleccionadas
function validateProductVariant() {
  $("select[name='size_id[]']").each(function(index, el) {
    var select=$(this);
    $("select[id='"+$(this).attr('id')+"'] option").attr('disabled', false);
    
    $("select[name='size_id[]'][id!='"+$(this).attr('id')+"']").each(function(index, el) {
      if (el.value!="") {
        $("#"+select.attr('id')+" option[value='"+el.value+"']").attr('disabled', true);
      }
    });
  });
}

// Agregar Complementos a un Grupo
$('#add-complements').click(function(event) {
  var count=parseInt($('#group-complements div[complement]:last-child').attr('complement'))+1;

  $('#group-complements').append($('<div>', {
    class: 'row',
    complement: count
  }));
  $('#group-complements div[complement="'+count+'"]').html('<div class="col-12">'+
    '<hr class="my-2">'+
    '</div>'+
    '<div class="form-group col-xl-4 col-lg-4 col-md-4 col-12">'+
    '<label class="col-form-label">Nombre<b class="text-danger">*</b></label>'+
    '<input class="form-control" type="text" name="name[]" required placeholder="Introduzca un nombre" id="name_'+count+'">'+
    '</div>'+
    '<div class="form-group col-xl-4 col-lg-4 col-md-4 col-12">'+
    '<label class="col-form-label">Precio<b class="text-danger">*</b></label>'+
    '<input class="form-control decimal" type="text" name="price[]" required placeholder="Introduzca el precio" value="0.00" id="price_'+count+'">'+
    '</div>'+
    '<div class="form-group col-xl-3 col-lg-3 col-md-3 col-10">'+
    '<label class="col-form-label">Estado<b class="text-danger">*</b></label>'+
    '<select class="form-control" name="state[]" required id="state_'+count+'">'+
    '<option value="1">Disponible</option>'+
    '<option value="0">No Disponible</option>'+
    '</select>'+
    '</div>'+
    '<div class="form-group col-xl-1 col-lg-1 col-md-1 col-2 d-flex align-items-end">'+
    '<a href="javascript:void(0);" class="text-danger complement-remove mb-3" complement="'+count+'">'+
    '<i class="fa fa-trash"></i>'+
    '</a>'+
    '</div>');

  if ($('.decimal').length) {
    $(".decimal").TouchSpin({
      min: 0,
      max: 999999999,
      step: 0.50,
      decimals: 2,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  // Función para remover complementos
  $('.complement-remove[complement="'+count+'"]').on('click', function(event) {
    $('#group-complements div[complement="'+$(this).attr('complement')+'"]').remove();
  });
});

// Función para remover complementos
$('.complement-remove').click(function(event) {
  $('#group-complements div[complement="'+$(this).attr('complement')+'"]').remove();
});

// Funcion para abrir modal para asignar productos a un grupo
function assignGroup(slug, name=null) {
  $('#formAssignGroup .select2').val('');
  $('#formAssignGroup .select2').val('').trigger('change');
  $('#formAssignGroup').attr('action', '/admin/grupos/'+slug+'/asignar');
  if (name!=null) {
    $('#titleAssignGroup').val(name);
  }
  $.ajax({
    url: '/grupos/'+slug+'/productos',
    type: 'POST',
    dataType: 'json',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })
  .done(function(obj) {
    if (obj.status) {
      $('#formAssignGroup .select2').val(obj.products).trigger("change");
      $("#assignGroup").modal();
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