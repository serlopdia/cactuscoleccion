/**
 * @author usuario
 */





var e= document.getElementById("cPostal");
e.addEventListener("change",function (){
	var cp= e.value;

var ciudades={"28001":"Madrid", "28002":"Madrid", "08001":"Barcelona"};

var ciudad=ciudades[cp];
if(ciudad){
	var c= document.getElementById("ciudad");
	c.value = ciudad;
}
});


