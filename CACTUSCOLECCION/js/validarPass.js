function validateForm() {
   var noValidar = document.getElementById("#altaCliente").novalidate;
   
   if (!noValidar){
      var error1 = passwordValidation();        
      var error2 = passwordConfirmation();
        
      return (error1.length==0) && (error2.length==0);
   }
   else 
      return true;
}

function passwordValidation(){
   var password = document.getElementById("contrasenya");
   var passVal = password.value;
   var correcto = true;

   var regexNum = /\d/;
   var regexMayus = /[A-Z]/;
   var regexMinus = /[a-z]/;

   correcto = correcto && (passVal.length>=8) && (regexNum.test(passVal)) && 
            (regexMayus.test(passVal)) && (regexMinus.test(passVal));
   
   if(!correcto){
      var error = "Introduzca una contraseña válida! Longitud mayor que 8, con mayúsculas, minúsculas y números.";
   }else{
      var error = "";
   }
        password.setCustomValidity(error);
   return error;
}

function passwordConfirmation(){
   var password = document.getElementById("contrasenya");
   var passVal = password.value;

   var passConfirm = document.getElementById("confirmpass");
   var confirmVal = passConfirm.value;

   if (passVal != confirmVal) {
      var error = "Las contraseñas no coinciden.";
   }else{
      var error = "";
   }

   passConfirm.setCustomValidity(error);

   return error;
}

function passwordStrength(contrasenya){ 
   /* Se calculará la fortaleza dividiendo el número de caracteres únicos por su longitud. */
       var caracteres = {};
       var long = contrasenya.length;

       for(x = 0, long; x < long; x++) {
           var l = contrasenya.charAt(x);
           caracteres[l] = (isNaN(caracteres[l])? 1 : caracteres[l] + 1);
       }

       return Object.keys(caracteres).length / long;
}

function passwordColor(){
   var fondoPass = document.getElementById("contrasenya");
   var fortaleza = passwordStrength(fondoPass.value);
   
   if(!isNaN(fortaleza)){
      var type = "weakpass";
      if(passwordValidation()!=""){
         type = "weakpass";
      }else if(fortaleza > 0.7){
         type = "strongpass";
      }else if(fortaleza > 0.4){
         type = "middlepass";
      }
   }else{
      type = "nanpass";
   }
   fondoPass.className = type;
   
   return type;
}