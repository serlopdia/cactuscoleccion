/* VALIDACIÓN DE CATEGORIA
 ========================================================================== */
 $(document).ready(function() {    
   var salida = false;
   
   /* Valido el nombre */
      $('#NOMBRE_CAT').keyup(function() {
         var nombre = $('#NOMBRE_CAT').val();
         var regexNom = /^[a-zA-ZÀ-ÖØ-öø-ÿ0-9\s]+$/;
         
         if (nombre == "" ) {
            $('#error1').text("El campo no puede estar vacio.").css("color","red");
            salida = false;
         } else if (!(regexNom.test(nombre))) {
            $('#error1').text("Existen caracteres no válidos en el campo.").css("color","red");
            salida = false;
         } else if (nombre.length>40) {
            $('#error1').text("La categoria es demasiado larga.").css("color","red");
            salida = false;
         }  else if (nombre.length<3) {
            $('#error1').text("La categoria es demasiado corta.").css("color","red");
            salida = false;
         }else {
            $('#error1').text("Categoria válido.").css("color","green");
            salida = true;
         }
   
         $("#formCategoria").submit(function() {
            return salida;
         });
   
      });
   
   });