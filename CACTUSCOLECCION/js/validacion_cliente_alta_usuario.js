/**
 * @author usuario
 */

var msg = document.getElementById("msg");
var form = document.getElementById("altaCliente");
form.addEventListener("submit", function(){
	var c1= document.getElementById("contrasenya");
	var c2=document.getElementById("confirmpass");
	var error= validarcontrasenya(c1.value,c2.value);
	var errores =[];
	if(error)
	errores.push(error);
	
	var n= document.getElementById("nombre");
	error=validarNombre(n.value);
	if(error)
	errores.push(error);
	
	var a= document.getElementById("apellidos");
	error=validarApellidos(a.value);
	if(error)
	errores.push(error);
	
	
	var t= document.getElementById("telefono");
	var error= validarTelefono(t.value);
	if(error)
	errores.push(error);
	
	var direccion =document.getElementById("direccion");
	var dni =document.getElementById("dni");
	var error=validarDirDni(direccion.value, dni.value);
	if(error)
	errores.push(error);
	
	
	
	msg.innerHTML = errores.join("<br>");
	if(errores.length>0){
		event.preventDefault();
	}
	
	
});



function validarDirDni(direccion, dni){
	
		
		var dni = dni.toUpperCase();
		var letrasVal = 'TRWAGMYFPDXBNJZSQVHLCKET';
		var regexNIF = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]$/i;
		var regexNIE = /^[XYZ][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKET]$/i;
		var regexNIFPT = /^[0-9]{9}$/;

		var letra = dni.substr(-1);
		var mod = parseInt(dni.substr(0, 8)) % 23;

		if (dni == "" ) {
			return "Debe introducir un DNI.";
		} else if (direccion.toLowerCase().includes('españa') && !(regexNIF.test(dni)) && !(regexNIE.test(dni))) {
			return "Formato de DNI no válido.";
			
		} else if (direccion.toLowerCase().includes('españa') && !(letrasVal.charAt(mod) == letra)) {
			return "El DNI no es válido.";
			
		} else if (direccion.toLowerCase().includes('portugal') && !(regexNIFPT.test(dni))) {
			return "El NIF portugués no es válido.";
		
		} 
	
	return false;
	}

function validarNombre(nombre){
	if(nombre.length ==0){
		return "¡Nombre! Debe introducir su nombre";
	}else if(nombre.length > 25){
		return "¡Nombre! El nombre no debe de superar los 25 caracteres";
	}
	return false;
}

function validarApellidos(apellidos){
	if(apellidos.length > 35){
		return "¡Apellidos! Los apellidos no pueden superar los 35 caracteres";
	}else if(apellidos.length == 0){
		return "¡Apellidos! Debe introducir sus apellidos";
	}
		return false;
}

function validarDireccion(direccion){
	if(direccion.length ==0){
		return "¡Dirección! Debe introducir su direccioón";
	}else if(direccion.length > 256){
		return "¡Dirección! La dirección no debe superar los 256 caracteres";
	}
}
function validarcontrasenya(contraseña, confirmpass){
	if (contraseña.length <8) {
		return "¡Contraseña! La contraseña debe contener al menos 8 caracteres";
	}else if(contraseña.length >20){
		return "¡Contraseña!La contraseña debe tener menos de 20 caracteres";
	}else if(contraseña != confirmpass){
		return "¡Contraseña! Las contraseñas no coinciden";
	}
	return false;
}

function validarTelefono(telefono){
	if(telefono.length !=9){
		return "¡Teléfono! Su teléfono debe contener 9 dígitos";
}
		return false;
}

function validarDNI(dni){
	
}
