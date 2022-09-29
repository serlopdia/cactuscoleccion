/* VALIDACIÓN DE PAGO
 ========================================================================== */
 $(document).ready(function() {
   
/* Valido la cantidad */
   $('#CANTIDAD').keyup(function() {   
      var cantidad = $('#CANTIDAD').val();
      var regexCant= /^\d+(\d{1,4})*(\,\d{1,2})?$/;
      
      if (cantidad == "" ) {
         $('#error1').text("Debe introducir una cantidad.").css("color","red");
         salida = false;
      } else if (!(regexCant.test(cantidad))) {
         $('#error1').text("La cantidad tiene que ser un número (decimales con ',').").css("color","red");
         salida = false;
      } else if (cantidad==0) {
         $('#error1').text("La cantidad no puede ser 0.").css("color","red");
         salida = false;
      } else {
         $('#error1').text("Cantidad válida.").css("color","green");
         salida = true;
      }

      $("#formPago").submit(function() {
         return salida;
      });

   });

/* Valido la fecha */
   $('#FECHA_PAGO').keyup(function() {   
      var fecha = $('#FECHA_PAGO').val();
      var regexFecha= /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
      
      if (fecha == "" ) {
         $('#error2').text("Debe introducir una fecha.").css("color","red");
         salida = false;
      } else if (!(regexFecha.test(fecha))) {
         $('#error2').text("Formato de fecha no valido.").css("color","red");
         salida = false;
      } else {
         $('#error2').text("Fecha válida.").css("color","green");
         salida = true;
      }

      $("#formPago").submit(function() {
         return salida;
      });

   });

/* Valido el estado */
   $('#ESTADO_PAGO').keyup(function() {   
      var estado = $('#ESTADO_PAGO').val();

      if (estado == "" ) {
         $('#error3').text("Debe introducir un estado.").css("color","red");
         salida = false;
      } else if (!(estado=='PENDIENTE') && !(estado=='REALIZADO')) {
         $('#error3').text("El estado tiene que ser 'PENDIENTE' o 'REALIZADO'.").css("color","red");
         salida = false;
      } else {
         $('#error3').text("Estado válido.").css("color","green");
         salida = true;
      }
      
      $("#formPago").submit(function() {
         return salida;
      });

   });

/* Valido el tipo */
   $('#TIPO_PAGO').keyup(function() {   
      var tipo = $('#TIPO_PAGO').val();

      if (tipo == "" ) {
         $('#error4').text("Debe introducir un tipo.").css("color","red");
         salida = false;
      } else if (!(tipo=='PAYPAL') && !(tipo=='TRANSFERENCIA') && !(tipo=='CONTRA REEMBOLSO')) {
         $('#error4').text("El tipo tiene que ser 'PAYPAL', 'TRANSFERENCIA' o 'CONTRA REEMBOLSO'.").css("color","red");
         salida = false;
      } else {
         $('#error4').text("Tipo válido.").css("color","green");
         salida = true;
      }
      
      $("#formPago").submit(function() {
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
      
      $("#formPago").submit(function() {
         return salida;
      });

   });

});