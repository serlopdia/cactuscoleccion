/**
 * @author usuario
 */
function validarNombre(direccion){
	if(direccion.length ==0){
		return "¡Dirección! Debe introducir su direccion";
	}else if(nombre.length > 25){
		return "¡Nombre! El nombre no debe de superar los 25 caracteres";
	}
	return false;
}