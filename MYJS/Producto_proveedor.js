$(document).ready(function(){



Nota: Agregar un tiempo adicional, al recibir el return del response.1s es sugerido.

Documentación:Nombres que debe tener las cajas de texto para Guardar.

// save_id_prod_provd

// save_id_producto

// save_id_proveedor

$("#btn_Producto_proveedor_Add").click(function(){

//nombre del formulario: frmProducto_proveedor_Add 

var frmProducto_proveedor=$("#frmProducto_proveedor_Add").serialize(); 

frmProducto_proveedor=frmProducto_proveedor+"&opc=1"; 

 $.ajax({ 

type:"POST",

url:"CONTROLLER/C_producto_proveedor.php",

data:frmProducto_proveedor,

success:function(response){ 

$("#mydiv").html($(response).fadeIn('slow')); 

} 

}); 

}

 

Documentación: Nombres que debe tener las cajas de texto para Actualizar.

// update_id_prod_provd . 

// update_id_producto . 

// update_id_proveedor . 

$("#btn_Producto_proveedor_Update").click(function(){

//nombre del formulario: frmProducto_proveedor_Update 

var frmProducto_proveedor=$("#frmProducto_proveedor_Update").serialize(); 

frmProducto_proveedor=frmProducto_proveedor+"&opc=2"; 

 $.ajax({ 

type:"POST",

url:"CONTROLLER/C_producto_proveedor.php",

data:frmProducto_proveedor,

success:function(response){ 

$("#mydiv").html($(response).fadeIn('slow')); 

} 

}); 

}

Documentación: Nombres que debe tener la caja de texto para Delete.

// delete_id_prod_provd . 

$("#btn_Producto_proveedor_Delete").click(function(){

//nombre del formulario: frmProducto_proveedor_Delete 

var id_prod_provd=$("#delete_id_prod_provd").val()var frmProducto_proveedor="delete_id_prod_provd"=id_prod_provd+"&opc=3"; 

 $.ajax({ 

type:"POST",

url:"Controller/C_producto_proveedor.php",

data:frmProducto_proveedor,

success:function(response){ 

$("#mydiv").html($(response).fadeIn('slow')); 

} 

}); 

}

Documentación: Nombres que debe tener la caja de texto para Show.

// show_id_prod_provd . 

$("#btn_Producto_proveedor_Show").click(function(){

var id_prod_provd=$("#show_id_prod_provd").val()var frmProducto_proveedor="show_id_prod_provd"=id_prod_provd+"&opc=4"; 

 $.ajax({ 

type:"POST",

url:"CONTROLLER/C_producto_proveedor.php",

data:frmProducto_proveedor,

success:function(response){ 

$("#mydiv").html($(response).fadeIn('slow')); 

} 

}); 

}

$("#btn_Producto_proveedor_List").click(function(){

//nombre del formulario: frmProducto_proveedor_List 

var frmProducto_proveedor=$("#frmProducto_proveedor_List").serialize(); 

frmProducto_proveedor=frmProducto_proveedor+"&opc=5"; 

 $.ajax({ 

type:"POST",

url:"Controller/C_producto_proveedor.php",

data:frmProducto_proveedor,

success:function(response){ 

$(#mydiv).html($(response).fadeIn('slow')); 

} 

}); 

}

}
