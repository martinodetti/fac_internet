$(document).ready(function(){



//Nota: Agregar un tiempo adicional, al recibir el return del response.1s es sugerido.

//Documentación:Nombres que debe tener las cajas de texto para Guardar.

// save_id_acsmod

// save_id_persona

// save_id_modulo

$("#btn_Acceso_modulo_Add").click(function(){

//nombre del formulario: frmAcceso_modulo_Add 

var frmAcceso_modulo=$("#frmAcceso_modulo_Add").serialize(); 

frmAcceso_modulo=frmAcceso_modulo+"&opc=1"; 

 $.ajax({ 

type:"POST",

url:"CONTROLLER/C_acceso_modulo.php",

data:frmAcceso_modulo,

success:function(response){ 

$("#mydiv").html($(response).fadeIn('slow')); 

} 

}); 

}

 

Documentación: Nombres que debe tener las cajas de texto para Actualizar.

// update_id_acsmod . 

// update_id_persona . 

// update_id_modulo . 

$("#btn_Acceso_modulo_Update").click(function(){

//nombre del formulario: frmAcceso_modulo_Update 

var frmAcceso_modulo=$("#frmAcceso_modulo_Update").serialize(); 

frmAcceso_modulo=frmAcceso_modulo+"&opc=2"; 

 $.ajax({ 

type:"POST",

url:"CONTROLLER/C_acceso_modulo.php",

data:frmAcceso_modulo,

success:function(response){ 

$("#mydiv").html($(response).fadeIn('slow')); 

} 

}); 

}

Documentación: Nombres que debe tener la caja de texto para Delete.

// delete_id_acsmod . 

$("#btn_Acceso_modulo_Delete").click(function(){

//nombre del formulario: frmAcceso_modulo_Delete 

var id_acsmod=$("#delete_id_acsmod").val()var frmAcceso_modulo="delete_id_acsmod"=id_acsmod+"&opc=3"; 

 $.ajax({ 

type:"POST",

url:"Controller/C_acceso_modulo.php",

data:frmAcceso_modulo,

success:function(response){ 

$("#mydiv").html($(response).fadeIn('slow')); 

} 

}); 

}

Documentación: Nombres que debe tener la caja de texto para Show.

// show_id_acsmod . 

$("#btn_Acceso_modulo_Show").click(function(){

var id_acsmod=$("#show_id_acsmod").val()var frmAcceso_modulo="show_id_acsmod"=id_acsmod+"&opc=4"; 

 $.ajax({ 

type:"POST",

url:"CONTROLLER/C_acceso_modulo.php",

data:frmAcceso_modulo,

success:function(response){ 

$("#mydiv").html($(response).fadeIn('slow')); 

} 

}); 

}

$("#btn_Acceso_modulo_List").click(function(){

//nombre del formulario: frmAcceso_modulo_List 

var frmAcceso_modulo=$("#frmAcceso_modulo_List").serialize(); 

frmAcceso_modulo=frmAcceso_modulo+"&opc=5"; 

 $.ajax({ 

type:"POST",

url:"Controller/C_acceso_modulo.php",

data:frmAcceso_modulo,

success:function(response){ 

$(#mydiv).html($(response).fadeIn('slow')); 

} 

}); 

}

}
