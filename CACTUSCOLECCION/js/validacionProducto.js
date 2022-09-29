/* VALIDACIÓN DE PRODUCTO
 ========================================================================== */
 $(document).ready(function() {    
   var salida = false;
   
   /* Valido el nombre */
      $('#NOMBRE').keyup(function() {
         var nombre = $('#NOMBRE').val();
         var regexNom = /^[a-zA-ZÀ-ÖØ-öø-ÿ0-9\s]+$/;
         
         if (nombre == "" ) {
            $('#error1').text("Debe introducir un nombre.").css("color","red");
            salida = false;
         } else if (!(regexNom.test(nombre))) {
            $('#error1').text("Existen caracteres no válidos en el campo.").css("color","red");
            salida = false;
          }else if(nombre.length <4){
          	$('#error1').text("Debe introducir un nombre más largo.").css("color","red");
            salida = false;
         } else if (nombre.length>40) {
            $('#error1').text("El nombre es demasiado largo.").css("color","red");
            salida = false;
         } else {
            $('#error1').text("Nombre válido.").css("color","green");
            salida = true;
         }
   
         $("#formProducto").submit(function() {
            return salida;
         });
   
      });
   
   /* Valido el tamaño */
      $('#TAMAÑO').keyup(function() {   
         var tamaño = $('#TAMAÑO').val();
         var regexTam= /^\d+(\d{3})*(\.\d{1,2})*([a-z]{2})?$/;
         
         if (tamaño == "" ) {
            $('#error2').text("Debe introducir un tamaño.").css("color","red");
            salida = false;
         } else if (!(regexTam.test(tamaño))) {
            $('#error2').text("El tamaño tiene que ser un número (decimales con '.').").css("color","red");
            salida = false;
         } else if(tamaño.length>9){
         	$('#error2').text("El tamaño no puede tener más de 9 caracteres.").css("color","red");
            salida = false;
         } else {
            $('#error2').text("Tamaño válido.").css("color","green");
            salida = true;
         }
   
         $("#formProducto").submit(function() {
            return salida;
         });
   
      });
   
   /* Valido la descripcion */
      $('#DESCRIPCION').keyup(function() {
         var descripcion = $('#DESCRIPCION').val();
         var regexDes = /^[a-zA-ZÀ-ÖØ-öø-ÿ0-9\s]+$/;
         
         if(descripcion ==""){
          	$('#error3').text("Debe introducir una descripción.").css("color","red");
            salida = false;
          }else if (!(regexDes.test(descripcion))) {
            $('#error3').text("Existen caracteres no válidos en el campo.").css("color","red");
            salida = false;
         } else if (descripcion.length>100) {
            $('#error3').text("La descripción es demasiado larga.").css("color","red");
            salida = false;
         } else {
            $('#error3').text("Descripción válida.").css("color","green");
            salida = true;
         }
   
         $("#formProducto").submit(function() {
            return salida;
         });
   
      });

/* Valido el stock */
      $('#STOCK,#OID_CATEGORIA').keyup(function() {
   
         var categoria = $('#OID_CATEGORIA').val();
         var stock = $('#STOCK').val();
         var regexStock = /^\d+$/;
   
         if ( stock == "" ) {
            $('#error4').text("Debe introducir un stock para el producto.").css("color","red");
         } else if (!(regexStock.test(stock))) {
            $('#error4').text("El stock debe ser un número entero.").css("color","red");
            salida = false;
         } else if (stock==0) {
            $('#error4').text("El stock no puede ser 0.").css("color","red");
            salida = false;
         } else if (categoria == 1 && (stock<10 || stock>15)) {
            $('#error4').text("Ese stock no está permitido para la categoría Echeveria (10-15).").css("color","red");
         } else if (categoria == 2 && (stock<15 || stock>20)) {
            $('#error4').text("Ese stock no está permitido para la categoría Anacampseros (15-20).").css("color","red");
         } else if (categoria == 3 && (stock<20 || stock>25)) {
            $('#error4').text("Ese stock no está permitido para la categoría Rebutia (20-25).").css("color","red");
         } else if (categoria == 4 && (stock<25 || stock>30)) {
            $('#error4').text("Ese stock no está permitido para la categoría Cereus (25-30).").css("color","red");
         } else if (categoria == 5 && (stock<30 || stock>35)) {
            $('#error4').text("Ese stock no está permitido para la categoría Euphorbia (30-35).").css("color","red");
         } else if (categoria == 6 && (stock<35 || stock>40)) {
            $('#error4').text("Ese stock no está permitido para la categoría Hoya (35-40).").css("color","red");
         } else if (categoria == 7 && (stock<40 || stock>45)) {
            $('#error4').text("Ese stock no está permitido para la categoría Opuntia (40-45).").css("color","red");
         } else if (categoria == 8 && (stock<45 || stock>50)) {
            $('#error4').text("Ese stock no está permitido para la categoría Lobivia (45-50).").css("color","red");
         } else if (categoria == 9 && (stock<50 || stock>55)) {
            $('#error4').text("Ese stock no está permitido para la categoría Crassula (50-55).").css("color","red");
         } else if (categoria == 10 && (stock<55 || stock>60)) {
            $('#error4').text("Ese stock no está permitido para la categoría Delosperma (55-60).").css("color","red");
         } else if (categoria == 11 && (stock<60 || stock>65)) {
            $('#error4').text("Ese stock no está permitido para la categoría Gymnocalycium (60-65).").css("color","red");
         } else if (categoria == 12 && (stock<65 || stock>70)) {
            $('#error4').text("Ese stock no está permitido para la categoría Ariocarpus (65-70).").css("color","red");
        }else if(categoria >12 && (stock <50 || stock>100)){
        	$('#error4').text("Ese stock no está permitido para esa categoría. Stock (50 - 100).").css("color","red");
        
           } else{
            	$('#error4').text("El stock es correcto.").css("color","green");
         }
         
         $("#formProducto").submit(function() {
            return salida;
         });
   
      });
   
   /* Valido el precio */
          $('#PRECIO').keyup(function() {   
         var precio = $('#PRECIO').val();
         var regexPrecio= /^(\d{0,4})*(,\d{1,2})?$/;
         
         if (precio == "" ) {
            $('#error5').text("Debe introducir un precio.").css("color","red");
            salida = false;
         } else if (!(regexPrecio.test(precio))) {
            $('#error5').text("El precio tiene que ser un número (decimales con 'aaaa,dd').").css("color","red");
            salida = false;
          }else if(precio.length >6){
          	$('#error5').text("El precio es demasiado grande.").css("color","red");
            salida = false;
          }else if( (regexPrecio.test(precio) && precio.length >6)){
           $('#error5').text("El precio es demasiado grande.").css("color","red");
            salida = false;
         } else {
            $('#error5').text("Precio válido.").css("color","green");
            salida = true;
         }
   
         $("#formProducto").submit(function() {
            return salida;
         });
   
      });
   
   /* Valido la imagen */
      $('#IMAGEN').keyup(function() {
         var imagen = $('#IMAGEN').val();
         var regexImg = /\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i;
         
         if (imagen == "" ) {
            $('#error6').text("Debe introducir una url de imagen.").css("color","red");
            salida = false;
         } else if (imagen.length<15) {
            $('#error6').text("La url de la imagen tiene que ser más larga.").css("color","red");
            salida = false;
         } else if (!(regexImg.test(imagen))) {
            $('#error6').text("Formato de url no válido.").css("color","red");
            salida = false;
          }else if(imagen.length >300){
          	 $('#error6').text("URL demasiado grande.").css("color","red");
            salida = false;
         } else {
            $('#error6').text("Imagen válida.").css("color","green");
            salida = true;
         }
   
         $("#formProducto").submit(function() {
            return salida;
         });
   
      });
   
   /* Valido la categoria */
      $('#OID_CATEGORIA').keyup(function() {   
         var categoria = $('#OID_CATEGORIA').val();
         var regexCat = /^\d+$/;

         if (categoria == "" ) {
            $('#error7').text("Debe introducir una categoría.").css("color","red");
            salida = false;
         } else if (!(regexCat.test(categoria))) {
            $('#error7').text("La categoría debe ser un número entero.").css("color","red");
            salida = false;
		}else if (categoria.length >7){
			 $('#error7').text("La categoría no debe superar los 7 dígitos.").css("color","red");
            salida = false;
         } else {
            $('#error7').text("Categoría aparentemente válida.").css("color","green");
            salida = true;
         }
         
         $("#formProducto").submit(function() {
            return salida;
         });
   
      });
   
   });