$(document).ready(function(){
var tipo_proveedor=[];
var tipo_proveedor_update=[];

//BOX SORTABLE //
		$(".column.half").sortable({
			connectWith: '.column.half',
			handle: '.box-header'
		});
		$(".column.full").sortable({
			connectWith: '.column.full',
			handle: '.box-header'
		});
		$(".box").find(".box-header").prepend('<span class="close"></span>').end();
		$(".box-header .close ").click(function() {
			$(this).parents(".box .box-header").toggleClass("box-header closed").toggleClass("box-header");
			$(this).parents(".box:first").find(".box-content").toggle();
			$(this).parents(".box:first").find(".example").toggle();
		});
   
   //TABS - SORTABLE//
		$(".tabs").tabs();
		$(".tabs.sortable").tabs().find(".ui-tabs-nav").sortable({axis:'x'});
                
 //Tables

var oTable=  $('#table-example').dataTable({
        "bServerSide": true,
        "bFilter": true,
        "bJQueryUI": true,
        "sAjaxSource": "VIEW/WBuscarVehiculo.php?",
       "sPaginationType": "full_numbers",
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "xls", "pdf"                          
            ]
        }
    });



//end tables               
                
                
//AutoComplete plugin
//carga txt_update_tipo_provd conjson
    function loadAjaxJsonCliente(idvehi){
        $.getJSON("CONTROLLER/C_Vehiculo.php?opc=8&show_idvehi="+idvehi+"&callback=?", function(data){
            var lon=data.length;
           for(var i=0;i<lon;i++){           	
//               alert(data[i].nombre +" "+data[i].id); 
                var ret = $("<a>").addClass("remove").attr({
                    href: "javascript:",
                    title: "Remove " + data[i].nombre
                });
                var spanp = $("<span class='tag tag-silver' id='"+data[i].id+"'>").text(data[i].nombre).appendTo(ret);
                ret.insertBefore("#update_tipo_cliente");
           }
        });
   
//         $("#update_tipo_proveedor").text(tmp);
    }
//attach autocomplete
    $("#save_tipo_cliente").autocomplete({					
        //define callback to format results
        source: function(req, add){					
            $.getJSON("CONTROLLER/C_Vehiculo.php?opc=10&callback=?", req, function(data) {							
                var suggestions = [];		
                $.each(data, function(i, val){	
                    suggestions.push({
                        label: val.nombre,
                        value:val.id
                    });
                });				
                //pass array to callback
                add(suggestions);
            });
        },				
        //define select handler
        select: function(e, ui) {            
            if(verificarSpan(ui.item.value)){
            }else{
                var friend2 = ui.item.label,
                        ap = $("<a>").addClass("remove").attr({
                            href: "javascript:",
                            title: "Remove " + friend2
                        }),
                        spanp = $("<span class='tag tag-silver' id='"+ui.item.value+"'>").text(friend2).appendTo(ap);
                        ap.insertBefore("#save_tipo_cliente");
            }

        },			
        //define select handler
        change: function() {					
        //prevent 'to' field being updated and correct position
       $("#save_tipo_cliente").val("").css("top", 2);
        }
    });
    
  //segundo autosuggest  
      $("#update_tipo_cliente").autocomplete({	
        //define callback to format results
        source: function(req, add){					
            $.getJSON("CONTROLLER/C_Vehiculo.php?opc=10&callback=?", req, function(data) {							
                var suggestions = [];		
                $.each(data, function(i, val){	
                    suggestions.push({
                        label: val.nombre,
                        value:val.id
                    });
                });				
                //pass array to callback
                add(suggestions);
            });
        },				
        //define select handler
        select: function(e, ui) {            
            if(verificarSpanUpdate(ui.item.value)){
            }else{
                var friend2 = ui.item.label,
                        ap = $("<a>").addClass("remove").attr({
                            href: "javascript:",
                            title: "Remove " + friend2
                        }),
                        spanp = $("<span class='tag tag-silver' id='"+ui.item.value+"'>").text(friend2).appendTo(ap);
                        ap.insertBefore("#update_tipo_cliente");
            }

        },			
        //define select handler
        change: function() {					
        //prevent 'to' field being updated and correct position
       $("#update_tipo_cliente").val("").css("top", 2);
        }
    });
		
    
 //fin autosuggest
 //
//add click handler to friends div
$("#div_cliente").click(function(){
    $("#save_tipo_cliente").focus();
});
$("#div_cliente2").click(function(){
    $("#update_tipo_cliente").focus();
});



  $(".tag").livequery("click", function(e){
        $(this).parent().remove();
        return false;
  });	
  
    function verificarSpan(valor){
        var cont=0;
        $("#div_proveedor").find("span").each(function(){
            var val_id=$(this).attr("id");
            if(parseInt(val_id)==parseInt(valor)){
                cont++;
            }
        });
        if(cont>=1)
            return true;
        else
            return false;
    }  
    function verificarSpanUpdate(valor){
        var cont=0;
        $("#div_cliente2").find("span").each(function(){
            var val_id=$(this).attr("id");
            if(parseInt(val_id)==parseInt(valor)){
                cont++;
            }
        });
        if(cont>=1)
            return true;
        else
            return false;
    }  
 

//$(".remove", document.getElementById("friends")).live("click", function(){
//    //remove current friend
////    $(this).parent().remove();
//    $(this).parent().css("background", "yellow");
//    //correct 'to' field position
//    if($("#friends span").length === 0) {
//        $("#to").css("top", 0);
//    }				
//});	

//fin autocomplete

//VALIDATION FORM//
    var validatorNuevo = $("#frmVehiculo_Add").validate({ 
        rules: { 
            save_dominio_vehiculo: {
                required: true, 
                minlength: 6
            }, 
            save_marca_vehiculo:{
                 required: false
            },
            save_modelo_vehiculo:{
                required: false
            },
            save_anio_vehiculo:{
               required: false,
               minlength: 4,
               maxlength: 4,
               number: true
            },
            save_observacion_vehiculo:{
                required: false
            }
            
        }, 
        messages: { 
            save_dominio_vehiculo: "Debe ingresar una patente válida (AAA111)",
            save_marca_vehiculo:"Ingrese la marca del vehículo",
            save_modelo_vehiculo:"Ingrese el modelo del vehículo",
            save_anio_vehiculo:"Ingrese el año del vehículo",
            save_observacion_vehiculo:"Ingrese una observación"
        }, 
        errorPlacement: function(error, element) { 
            if ( element.is(":radio") ) 
                error.appendTo( element.parent().prev() ); 
            else if ( element.is(":checkbox") ) 
                error.appendTo ( element.parent().prev() ); 
            else 
                error.appendTo( element.prev() ); 
        }, 
        submitHandler: function() {   
           frmVehiculo_Add();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    //validator busca
    var validatorBuscar = $("#frmVehiculo_Buscar").validate({ 
        rules: { 
            txt_Buscar_Modificar: {
                required: true,
                minlength: 1
            }
        }, 
        messages: { 
            txt_Buscar_Modificar: "Ingrese mínimo un caracter"
        }, 
        errorPlacement: function(error, element) {    
             if ( element.is(":radio") ) 
                error.appendTo( element.parent().prev() ); 
            else if ( element.is(":checkbox") ) 
                error.appendTo ( element.parent().prev() ); 
            else 
                error.appendTo( element.prev() ); 
        }, 
        submitHandler: function() { 
            //llamo a esta función
            resultBusquedad();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    
    //valida el update
    
     var validatorUpdate = $("#frmVehiculo_Update").validate({ 
        rules: { 
            update_dominio_vehiculo: {
                required: true, 
                minlength: 6
            }, 
            update_marca_vehiculo:{
                 required: false
            },
            update_modelo_vehiculo:{
                required: false
            },
            update_anio_vehiculo:{
               required: false,
               minlength: 4,
               maxlength: 4,
               number: true
            },
            update_observacion_vehiculo:{
                required: false
            }
            
        }, 
        messages: { 
            save_dominio_vehiculo: "Debe ingresar una patente válida (AAA111)",
            save_marca_vehiculo:"Ingrese la marca del vehículo",
            save_modelo_vehiculo:"Ingrese el modelo del vehículo",
            save_anio_vehiculo:"Ingrese el año del vehículo",
            save_observacion_vehiculo:"Ingrese una observación"
            
        }, 
        errorPlacement: function(error, element) {    
             if ( element.is(":radio") ) 
                error.appendTo( element.parent().prev() ); 
            else if ( element.is(":checkbox") ) 
                error.appendTo ( element.parent().prev() ); 
            else 
                error.appendTo( element.prev() ); 
        }, 
        submitHandler: function() { 
            //llamo a función update
           frmVehiculo_Update();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    
    //validacion para el eliminar buscar
    
      var validatorDelete = $("#frmVehiculo_Buscar_Delete").validate({ 
        rules: { 
            txt_Buscar_Delete: {
                required: true,
                minlength: 1
            }
        }, 
        messages: { 
            txt_Buscar_Delete: "Mínimo un caracter"
        }, 
        errorPlacement: function(error, element) {    
             if ( element.is(":radio") ) 
                error.appendTo( element.parent().prev() ); 
            else if ( element.is(":checkbox") ) 
                error.appendTo ( element.parent().prev() ); 
            else 
                error.appendTo( element.prev() ); 
        }, 
        submitHandler: function() { 
            //llamo a función buscar_delete_de la vista
          resultBusquedad_Delete();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    

//DIALOG//
		$('#dialg_msg').dialog({
			autoOpen: false,
			width: 460,
			height: 160,
			modal: true
		});
                
        $('#dial_msg_close').click(function() {
			$('#dialg_msg').dialog('close');
		});    
      //modal que actuliza          
		$('#dialg_form').dialog({
			autoOpen: false,
			width: 700,
			height: 400,
			modal: true
		}); 
		
		$('#dialg_error').dialog({
			autoOpen: false,
			width: 460,
			height: 160,
			modal: true
		});
		
		 
		$('#dialg_error_close').click(function() {
			$('#dialg_error').dialog('close');
		});
 
 /**
  * Devuelve un array listo para enviar a php
  */
 function array_post(){
     tipo_cliente=[];
     //ajax-> ({info:data,persona:personal})
        $("#div_cliente").find("span").each(function(){
            var id_tipo_tmp=$(this).attr("id");
//            var tmp_data=[id_tipo_tmp];
           	tipo_cliente.push(id_tipo_tmp);
        });
    } 
 function array_postpdate(){
     tipo_cliente_update=[];
     //ajax-> ({info:data,persona:personal})
        $("#div_cliente2").find("span").each(function(){
            var id_tipo_tmp=$(this).attr("id");
//            var tmp_data=[id_tipo_tmp];
            tipo_cliente_update.push(id_tipo_tmp);
        });
    } 
 
    //Nota: Agregar un tiempo adicional, al recibir el return del response.1s es sugerido.
    //Documentación:Nombres que debe tener las cajas de texto para Guardar.
    // save_id_producto 1
    // save_id_tiporeten    1
    // save_id_marca    1
    // save_id_unimedida    1
    // save_id_ganancia     1
    // save_codbarra_producto   1
    // save_nom_producto    1
    // save_descrip_producto    1
    // save_costo_producto  1
    // save_pvp1_producto   1
    // save_stock_producto  1 =0 no envia post
    // save_stkmin_producto 1
    // save_stkmax_producto 1
    // save_img_producto    1
    // save_fecing_producto 1
    // save_fecvenci_producto   1
    // save_estado_producto 1

    function frmVehiculo_Add(){
        array_post();
        var frmVehiculo=$("#frmVehiculo_Add").serialize();
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Vehiculo.php?opc=1&"+frmVehiculo,
            data:({Cliente:tipo_cliente}),
            success:function(response){ 
               $('#dialg_msg').dialog('open');
               $("#msg").text("Los datos se han guardado correctamente.");
               location.reload();
            } 
        });
    }
    
   
$("#btn_Vehiculo_New").click(function(){
    $("#frmVehiculo_Add .form-field").val (""); 
    $(".tag").remove();
});
$(".clsMatrizModificar").livequery("click", function(e){
  	$(".tag").remove();
  	var id_vehi=$(this).attr("id").replace("btn_update","");
  	loadAjaxJsonCliente(id_vehi);

  	$("#update_id_vehiculo").val(id_vehi);
  	var frmVehiculo="show_id_vehiculo="+id_vehi+"&opc=12";
   	$.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Vehiculo.php",
            data:frmVehiculo,
            dataType:'json',
            success:function(response){ 
					$('#update_dominio_vehiculo').val(response._dominio);
					$('#update_marca_vehiculo').val(response._marca);
					$('#update_modelo_vehiculo').val(response._modelo);
					$('#update_anio_vehiculo').val(response._anio);
					$('#update_observacion_vehiculo').val(response._observacion);
					$('#update_id_tipovehiculo').val(response._id_tipovehiculo);
            } 
        }); 
 
 	$('#dialg_form').dialog('open');
});

$(".clsMatrizEliminar").livequery("click", function(e){
     var id=$(this).attr("id").replace("btn_delete","");
     var frmVehiculo="delete_id_vehiculo="+id+"&opc=3"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Vehiculo.php",
            data:frmVehiculo,
            success:function(response){ 
                $('#dialg_msg').dialog('open');
                $("#msg").text("Registro eliminado sactisfactoriamente.");
                $("#tabla_result_delete").empty();
            } 
        }); 
});


$("#btn_Vehiculo_Cancel").click(function(){
//nombre del formulario: frmProducto_Update 
 	$('#dialg_form').dialog('close');
});

 function resultBusquedad(){
        var val_vehiculo=$("#txt_Buscar_Modificar").val();
        var frmVehiculo="opc=5&show_vehiculo="+val_vehiculo; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Vehiculo.php",
            data:frmVehiculo,
            success:function(response){ 
                $("#tabla_result").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
    
   function resultBusquedad_Delete(){
        var val_vehiculo=$("#txt_Buscar_Delete").val();
        var frmVehiculo="opc=7&show_vehiculo_delete="+val_vehiculo; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Vehiculo.php",
            data:frmVehiculo,
            success:function(response){ 
                $("#tabla_result_delete").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
  
 function frmVehiculo_Update(){//FALTA EL ARRAY DE PROVEDORES
     array_postpdate();
        var frmVehiculo=$("#frmVehiculo_Update").serialize();
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Vehiculo.php?opc=2&"+frmVehiculo,
            data:({Cliente:tipo_cliente_update}),
            success:function(response){ 
                 $('#dialg_form').dialog('close');
                $('#dialg_msg').dialog('open');
                $("#msg").text("Los datos se han actualizado correctamente");
//                $("#tabla_result").empty();
                
               location.reload();
            } 
        }); 
    }
    
    $("#update_dominio_vehiculo").change(function(){
    	validarExistenciaPatente($("#update_dominio_vehiculo").val());
    });
    
    $("#save_dominio_vehiculo").change(function(){
    	validarExistenciaPatente($("#save_dominio_vehiculo").val());
    });
    
    function validarExistenciaPatente(dominio){
    	$.ajax({
			type:"POST",
			data: "&dominio=" + dominio,
			url: "CONTROLLER/C_Vehiculo.php?opc=14",
			success:function(response){
				if(response != 0){
					$("#save_dominio_vehiculo").val("");
					$("#update_dominio_vehiculo").val("");
					$("#dialg_error").dialog('open');
				}
			}
		});
    }
   
});
