

jQuery(document).ready(function($) {

const { apertura,cierre,tiempo} = restaurante;


jQuery('#fecha-de-nacimiento').datepicker({
	  format    : 'dd-mm-yyyy',
	  autoHide  : true,
	  Date 		: new Date(),
	  endDate : new Date(),
	  language: 'es-ES', 
	  months : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	  daysMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
});


  jQuery('#fecha').mask('0000/00/00');
  jQuery('#hora').mask('00:00');
  jQuery('#adultos').mask('00');
  jQuery('#ninos').mask('00');

jQuery('#fecha').datepicker({
	  language	: 'es-ES',
	  months : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	  daysMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	  format    : 'yyyy-mm-dd',
	  autoHide  : true,
	  Date 		: new Date(),
	  startDate : new Date()
});


$('#hora').keypress(function(e) {
    e.preventDefault();
});



jQuery('#fecha').change(function(event) {

	var date = new Date(jQuery(this).val()),
		date = moment(date).tz("America/Lima"), 
		abre = apertura.split(':');
		date = moment(date).add('1','day');
		date = moment(date).hour(abre[0]);
		date = moment(date).minutes(abre[1]);
		date = moment(date).format();
		
	jQuery('#hora').val('');
	jQuery('#hora').timepicker('destroy');

	jQuery('#hora').timepicker({
	    timeFormat: 'HH:mm',
	    interval: tiempo,
	    minTime:   ( moment().tz("America/Lima").isSameOrAfter(date) ) ? moment().tz("America/Lima").add('1', 'hour').minutes('00').format('HH:mm') : apertura,
	    maxTime: cierre,
	    startTime: ( moment().tz("America/Lima").isSameOrAfter(date) ) ? moment().tz("America/Lima").add('1', 'hour').minutes('00').format('HH:mm') : apertura,
	    dynamic: false,
	    scrollbar: true
	});

});



jQuery('input.required').change(function(event) {
	
	if (jQuery(this).val().length >= 3){
			jQuery(this).removeClass('invalid');
		}
});


jQuery('#adultos').change(function(event) {
	
	if (jQuery(this).val().length >= 1){
			jQuery(this).removeClass('invalid');
		}
});


jQuery('#booking-restaurant-form').submit(function(event) {
event.preventDefault();

	var errors = 0;
	
	jQuery('input.required').each(function(index, el) {
		if (jQuery(el).val().length <= 3){
			errors++;
			console.log(jQuery(el));

			jQuery(el).addClass('invalid');
		}else{

		}
	});

	if (jQuery('#adultos').val() <= 0 ){
		errors++;
		jQuery('#adultos').addClass('invalid');
	}

	if (errors >= 1){
			return swal({
				text: "Por favor completa los campos requeridos",
			}); 

	}


var restaurant 			= jQuery('#restaurant').val(),
	nombre 	   			= jQuery('#nombre').val(),
	dni 	   			= jQuery('#dni').val(),
	genero 	   			= jQuery('#genero').val(),
	fecha_de_nacimiento = jQuery('#fecha-de-nacimiento').val(),
	correo 				= jQuery('#correo').val(),
	telefono 			= jQuery('#telefono').val(),
	direccion 			= jQuery('#direccion').val(),
	motivo 				= jQuery('#motivo').children('option:selected').val(),
	fecha 				= jQuery('#fecha').val(),
	hora 				= jQuery('#hora').val(),
	adultos 		    = jQuery('#adultos').val(),
	ninos 				= jQuery('#ninos').val(),
	comentarios 		= jQuery('#comentarios').val(),
	terms_conditions    = jQuery('#terms_conditions').is(':checked') ? 'si' : 'no';

	if (terms_conditions == 'no'){

		return swal({
				text: "Debes aceptar nuestros términos y condiciones.",
				icon: "warning",
			}); 
	}


	jQuery('#booking-restaurant-form').css('opacity','.6');

	jQuery.ajax({
		url: geekshat.ajax_url,
		type: 'POST',
		data:
				{action: 'reservar',
				restaurant,
				nombre,
				dni,
				genero,
				fecha_de_nacimiento,
				correo,
				telefono,
				direccion,
				motivo,
				fecha,
				hora,
				adultos,
				ninos,
				comentarios
				},
	})
	.done(function(response) {

		switch (response){
			case 'successfull':

			return swal({
				title: "Reservación agendada con éxito",
				text: "Te estaremos contactando previamente para confirmar tu reservación.",
				icon: "success",
			}); 

			break;

			case 'exist':

			return swal({
				title: "Ya tienes una reservación para este restaurant el mismo día",
				text: "Si deseas actualizar tus datos, te invitamos a contactarnos.",
				icon: "warning",
			}); 

			break;

			case 'data_invalid':
				return swal({
					title: "Uuups",
					text: "los datos suministrados, son incorrectos, por favor verifícalos e intenta de nuevo.",
					icon: "warning",
				}); 
			break;

			case 'error':
				return swal({
					title: "Uuups",
					text: "Ha ocurrido un error, por favor intentalo nuevamente o comunicate con nosotros.",
					icon: "danger",
				}); 
			break;

		}


	})
	.fail(function() {

		return swal({
					title: "Uuups",
					text: "Ha ocurrido un error, por favor intentalo nuevamente o comunicate con nosotros.",
					icon: "danger",
				}); 
	})
	.always(function() {
	jQuery('#booking-restaurant-form').removeAttr('style');
	});
	
});
 	
 }); 
