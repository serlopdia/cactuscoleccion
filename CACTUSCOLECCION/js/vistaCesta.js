/**
 * @author usuario
 */

var forms=document.getElementsByClassName("eliminar");
for(var i in forms){
	forms[i].addEventListener("submit",function(){
		if(!confirm("¿Quiere eliminar este producto?")){
			event.preventDefault();
			return false;
		}
		
	});
	
}

