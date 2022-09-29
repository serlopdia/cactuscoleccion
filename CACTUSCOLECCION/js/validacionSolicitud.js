/* VALIDACIÓN DE SOLICITUD
 ========================================================================== */
 $(document).ready(function() {
	var salida = true;
	
/* Valido la dirección */
	$('#DIRECCION').keyup(function() {
		var direccion = $('#DIRECCION').val();
      var regexDir = /^[a-zA-ZÀ-ÖØ-öø-ÿ0-9\s]+$/;
		
		if (direccion == "" ) {
			$('#error1').text("Debe introducir una dirección.").css("color","red");
			salida = false;
		} else if (!(regexDir.test(direccion))) {
         $('#error3').text("Existen caracteres no válidos en el campo.").css("color","red");
         salida = false;
      } else if (direccion.length<10) {
			$('#error1').text("La dirección tiene que ser más larga.").css("color","red");
			salida = false;
		} else if (!direccion.toLowerCase().includes('españa') && !direccion.toLowerCase().includes('portugal')) {
			$('#error1').text("Tiene que introducir un país válido (Portugal/España).").css("color","red");
			salida = false;
		} else if (direccion.length>256) {
			$('#error1').text("La dirección es demasiado larga.").css("color","red");
			salida = false;
		} else {
			$('#error1').text("Dirección válida.").css("color","green");
			salida = true;
		}

		$("#formSolicitud").submit(function() {
			return salida;
		});

	});

/* Valido el nombre */
	$('#NOMBRE_DESTINATARIO').keyup(function() {
		var nombre = $('#NOMBRE_DESTINATARIO').val();
		var regexNom = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/;
		
		if (nombre == "" ) {
			$('#error2').text("Debe introducir un nombre.").css("color","red");
			salida = false;
		} else if (!(regexNom.test(nombre))) {
			$('#error2').text("Existen caracteres no válidos en el campo.").css("color","red");
			salida = false;
		} else if (nombre.length<3) {
			$('#error2').text("El nombre tiene que ser más largo.").css("color","red");
			salida = false;
		} else if (nombre.length>15) {
			$('#error2').text("El nombre es demasiado largo.").css("color","red");
			salida = false;
		} else {
			$('#error2').text("Nombre válido.").css("color","green");
			salida = true;
		}

		$("#formSolicitud").submit(function() {
			return salida;
		});

	});

/* Valido el teléfono y su relación con la dirección */
	$('#DIRECCION,#TELEFONO').keyup(function() {
		var direccion = $('#DIRECCION').val();
		var telefono = $('#TELEFONO').val();
		var regexES = /^([9,7,6]{1})+([0-9]{8})$/;
		var regexPT = /^([9,2]{1})+([0-9]{8})$/;

		if (telefono.toString() == "" ) {
			$('#error3').text("Debe introducir un teléfono.").css("color","red");
			salida = false;
		} else if ((direccion.toLowerCase().includes('españa')) && (direccion.toLowerCase().includes('portugal'))) {
			if ((direccion.toLowerCase().indexOf('españa') > direccion.toLowerCase().indexOf('portugal')) && !(regexES.test(telefono))){
				$('#error3').text("Número de teléfono no permitido para el país indicado (El país es tomado como el último, España).").css("color","red");
				salida = false;
			} else if ((direccion.toLowerCase().indexOf('españa') < direccion.toLowerCase().indexOf('portugal')) && !(regexPT.test(telefono))){
				$('#error3').text("Número de teléfono no permitido para el país indicado (El país es tomado como el último, Portugal).").css("color","red");
				salida = false;
				
			}  else {
				$('#error3').text("Teléfono válido.").css("color","green");
				salida = true;
			}
		} else if (direccion.toLowerCase().includes('españa') && !(regexES.test(telefono)) ) {
			$('#error3').text("Ese número de teléfono no está permitido para la dirección indicada.").css("color","red");
			salida = false;
		} else if (direccion.toLowerCase().includes('portugal') && !(regexPT.test(telefono))) {
			$('#error3').text("Ese número de teléfono no está permitido para la dirección indicada.").css("color","red");
			salida = false;
		} else if (telefono.length != 9 ) {
			$('#error3').text("El teléfono tiene que tener 9 dígitos.").css("color","red");
			salida = false;
		} else {
			$('#error3').text("Teléfono válido.").css("color","green");
			salida = true;
		}
		
		$("#formSolicitud").submit(function() {
			return salida;
		});

	});

/* Valido el tipo */
	$('#TIPO').keyup(function() {
		var tipo = $('#TIPO').val();

		if (tipo == "" ) {
			$('#error4').text("Debe introducir un tipo.").css("color","red");
			salida = false;
		} else if (!(tipo=='CERTIFICADA') && !(tipo=='ORDINARIA')) {
			$('#error4').text("El tipo tiene que ser 'CERTIFICADA' u 'ORDINARIA'.").css("color","red");
			salida = false;
		} else {
			$('#error4').text("Tipo válido.").css("color","green");
			salida = true;
		}
		
		$("#formSolicitud").submit(function() {
			return salida;
		});

	});

/* Valido el Id del pedido */
	$('#OID_PEDIDO').keyup(function() {
		var idpedido = $('#OID_PEDIDO').val();
		var regexId = /^\d+$/;

		if (idpedido == "" ) {
			$('#error5').text("Debe introducir el Id de un pedido.").css("color","red");
			salida = false;
		} else if (!(regexId.test(idpedido))) {
			$('#error5').text("El Id pedido debe ser un número entero.").css("color","red");
			salida = false;
		} else if (idpedido==0) {
			$('#error5').text("El Id pedido no puede ser 0.").css("color","red");
			salida = false;
		} else {
			$('#error5').text("Id de pedido válido.").css("color","green");
			salida = true;
		}
		
		$("#formSolicitud").submit(function() {
			return salida;
		});

	});

/* Valido el Id del empleado */
	$('#OID_EMPLEADO').keyup(function() {
		var idempleado = $('#OID_EMPLEADO').val();
		var regexId = /^\d+$/;

		if (idempleado == "" ) {
			$('#error6').text("Debe introducir el Id de un empleado.").css("color","red");
			salida = false;
		} else if (!(regexId.test(idempleado))) {
			$('#error6').text("El Id empleado debe ser un número entero.").css("color","red");
			salida = false;
		} else if (idempleado==0) {
			$('#error6').text("El Id empleado no puede ser 0.").css("color","red");
			salida = false;
		} else {
			$('#error6').text("Id de empleado válido.").css("color","green");
			salida = true;
		}
		
		$("#formSolicitud").submit(function() {
			return salida;
		});

	});

});