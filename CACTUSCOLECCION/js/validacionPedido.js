/* VALIDACIÓN DE PEDIDO
 ========================================================================== */
 $(document).ready(function() {   
   var salida = false;
   
/* Valido la fecha */
   $('#FECHA').keyup(function() {   
      var fecha = $('#FECHA').val();
      var regexFecha= /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
      
      if (fecha == "" ) {
         $('#error1').text("Debe introducir una fecha.").css("color","red");
         salida = false;
      } else if (!(regexFecha.test(fecha))) {
         $('#error1').text("Formato de fecha no valido.").css("color","red");
         salida = false;
      } else {
         $('#error1').text("Fecha válida.").css("color","green");
         salida = true;
      }

      $("#formPedido").submit(function() {
         return salida;
      });

   });

/* Valido la dirección */
   $('#DIRECCION').keyup(function() {
      var direccion = $('#DIRECCION').val();
      var regexDir = /^[a-zA-ZÀ-ÖØ-öø-ÿ0-9\s]+$/;
      
      if (direccion == "" ) {
         $('#error2').text("Debe introducir una dirección.").css("color","red");
         salida = false;
      } else if (!(regexDir.test(direccion))) {
         $('#error2').text("Existen caracteres no válidos en el campo.").css("color","red");
         salida = false;
      } else if (direccion.length<10) {
         $('#error2').text("La dirección tiene que ser más larga.").css("color","red");
         salida = false;
      } else if (direccion.length>256) {
         $('#error2').text("La dirección es demasiado larga.").css("color","red");
         salida = false;
      } else {
         $('#error2').text("Dirección válida.").css("color","green");
         salida = true;
      }

      $("#formPedido").submit(function() {
         return salida;
      });

   });

/* Valido el país */
   $('#PAIS').keyup(function() {   
      var pais = $('#PAIS').val();

      if (pais == "" ) {
         $('#error3').text("Debe introducir un país.").css("color","red");
         salida = false;
      } else if (!(pais=='PORTUGAL') && !(pais=='ESPAÑA')) {
         $('#error3').text("El país tiene que ser 'PORTUGAL' o 'ESPAÑA'.").css("color","red");
         salida = false;
      } else {
         $('#error3').text("País válido.").css("color","green");
         salida = true;
      }
      
      $("#formPedido").submit(function() {
         return salida;
      });

   });

/* Valido la ciudad */
   $('#CIUDAD').keyup(function() {
      var ciudad = $('#CIUDAD').val();
      var regexCdad = /^[a-zA-ZÀ-ÖØ-öø-ÿ\s]+$/;
      
      if (ciudad == "" ) {
         $('#error4').text("Debe introducir una ciudad.").css("color","red");
         salida = false;
      } else if (!(regexCdad.test(ciudad))) {
         $('#error4').text("Existen caracteres no válidos en el campo.").css("color","red");
         salida = false;
      } else if (ciudad.length>50) {
         $('#error4').text("El nombre de la ciudad es demasiado largo.").css("color","red");
         salida = false;
      } else {
         $('#error4').text("Ciudad válida.").css("color","green");
         salida = true;
      }

      $("#formPedido").submit(function() {
         return salida;
      });

   });
   
/* Valido el precio total*/
   $('#PRECIO_TOTAL').keyup(function() {   
      var precio = $('#PRECIO_TOTAL').val();
      var regexPrecio= /^\d+(\d{3})*(\,\d{1,2})?$/;
      
      if (precio == "" ) {
         $('#error5').text("Debe introducir un precio.").css("color","red");
         salida = false;
      } else if (!(regexPrecio.test(precio))) {
         $('#error5').text("El precio tiene que ser un número (decimales con ',').").css("color","red");
         salida = false;
      } else if (precio==0) {
         $('#error5').text("El precio no puede ser 0.").css("color","red");
         salida = false;
      } else {
         $('#error5').text("Precio válido.").css("color","green");
         salida = true;
      }

      $("#formPedido").submit(function() {
         return salida;
      });

   });

/* Valido el código postal */
   $('#CODIGO_POSTAL').keyup(function() {   
      var cp = $('#CODIGO_POSTAL').val();
      var regexCp = /^(?:0?[1-9]|[1-4]\d|5[0-2])\d{3}$/;

      if (cp == "" ) {
         $('#error6').text("Debe introducir un código postal.").css("color","red");
         salida = false;
      } else if (!(regexCp.test(cp))) {
         $('#error6').text("El código postal no tiene un formato válido.").css("color","red");
         salida = false;
      } else {
         $('#error6').text("Código postal válido.").css("color","green");
         salida = true;
      }
      
      $("#formPedido").submit(function() {
         return salida;
      });

   });

/* Valido el estado */
   $('#ESTADO_PEDIDO').keyup(function() {   
      var estado = $('#ESTADO_PEDIDO').val();

      if (estado == "" ) {
         $('#error7').text("Debe introducir un estado.").css("color","red");
         salida = false;
      } else if (!(estado=='PENDIENTE') && !(estado=='REALIZADO') && !(estado=='CANCELADO')) {
         $('#error7').text("El estado tiene que ser 'PENDIENTE', 'REALIZADO' o 'CANCELADO'.").css("color","red");
         salida = false;
      } else {
         $('#error7').text("Estado válido.").css("color","green");
         salida = true;
      }
      
      $("#formPedido").submit(function() {
         return salida;
      });

   });

/* Valido el Id del cliente */
   $('#OID_CLIENTE').keyup(function() {   
      var idcliente = $('#OID_CLIENTE').val();
      var regexId = /^\d+$/;

      if (idcliente == "" ) {
         $('#error8').text("Debe introducir el Id de un cliente.").css("color","red");
         salida = false;
      } else if (!(regexId.test(idcliente))) {
         $('#error8').text("El Id cliente debe ser un número entero.").css("color","red");
         salida = false;
      } else if (idcliente==0) {
         $('#error8').text("El Id cliente no puede ser 0.").css("color","red");
         salida = false;
      } else {
         $('#error8').text("Id de cliente válido.").css("color","green");
         salida = true;
      }
      
      $("#formPedido").submit(function() {
         return salida;
      });

   });

});