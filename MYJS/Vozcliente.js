$(document).ready(function(){

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

 $('#table-example').dataTable({
        "bServerSide": true,
        "bFilter": true,
        "bJQueryUI": true,
        "sAjaxSource": "VIEW/WBuscarVozcliente.php?",
       "sPaginationType": "full_numbers",
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "xls", "pdf"                          
            ]
        }
    });
 //VALIDATION FORM//
    var validatorNuevo = $("#frmMarca_producto_Add").validate({ 
        rules: { 
            save_patente: {
                required: true, 
                minlength: 6
            }
        }, 
        messages: { 
            save_patente: "Ingrese la Marca del Producto"
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
          Marca_producto_Add();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    //validator busca
    var validatorBuscar = $("#frmMarca_producto_Buscar").validate({ 
        rules: { 
            txt_Buscar_Modificar: {
                required: true,
                minlength: 1
            }
        }, 
        messages: { 
            txt_Buscar_Modificar: "Ingrese un caracter"
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
    
     var validatorUpdate = $("#frmMarca_producto_Update").validate({ 
        rules: { 
            update_nom_marca: {
                required: true,
                minlength: 2
            }   
        }, 
        messages: { 
            update_nom_marca: "Mínimo dos caracteres"
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
           Marca_producto_Update();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    
    //validacion para el eliminar buscar
    
      var validatorDelete = $("#frmMarca_producto_Buscar_Delete").validate({ 
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
			height: 140,
			modal: true
		});
                
        $('#dialg_vozcliente_close').click(function() {
			$('#dialg_vervozcliente').dialog('close');
		});    
		
		$('#dial_msg_close').click(function() {
			$('#dialg_msg').dialog('close');
		});   
		
		
      //modal que actuliza          
		$('#dialg_form').dialog({
			autoOpen: false,
			width: 400,
			height: 200,
			modal: true
		});
                                          
                

  // save_nom_marca              
 function Marca_producto_Add(){
        var frmMarca_producto=$("#frmMarca_producto_Add").serialize(); 
        frmMarca_producto=frmMarca_producto+"&opc=1"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Vozcliente.php?",
            data:frmMarca_producto,
            success:function(response){ 
               $('#dialg_msg').dialog('open');
               $("#msg").text("Los datos se han guardado correctamente.");
               $("#frmMarca_producto_Add .form-field").val ("");
               location.reload();
            } 
        }); 
    }
    
  //Documentación: Nombres que debe tener las cajas de texto para Actualizar.
    // update_id_marca . 
    // update_nom_marca .   
 function Marca_producto_Update(){
        var frmMarca_producto=$("#frmMarca_producto_Update").serialize(); 
        frmMarca_producto=frmMarca_producto+"&opc=2"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Marca_producto.php",
            data:frmMarca_producto,
            success:function(response){ 
                 $('#dialg_form').dialog('close');
                $('#dialg_msg').dialog('open');
                $("#msg").text("Los datos se han actualizado correctamente");
                $("#tabla_result").empty();
            }
        });   
    }
 

     
    //Documentación: Nombres que debe tener la caja de texto para Delete.
    // delete_id_marca . 
      $(".clsMatrizEliminar").livequery("click", function(e){
         var id=$(this).attr("id").replace("btn_delete","");
        var frmMarca="delete_id_marca="+id+"&opc=3"; 
        $.ajax({ 
            type:"POST",
            url:"Controller/C_Marca_producto.php",
            data:frmMarca,
            dataType:'json',
            success:function(response){ 
                $('#dialg_msg').dialog('open');
                if(response.estado=="1"){
                    $("#msg").text(response.txt);
                     $("#tabla_result_delete").empty();
                }else{ //si 0 porque no se pudo elimnar
                     $("#msg").text(response.txt);
                }
               
            } 
        }); 
           
     });

    
     function resultBusquedad(){
        var val_marca=$("#txt_Buscar_Modificar").val();
        var frmMarca_producto="opc=5&show_marca="+val_marca; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Marca_producto.php",
            data:frmMarca_producto,
            success:function(response){ 
                $("#tabla_result").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
    
    function resultBusquedad_Delete(){
        var val_marca=$("#txt_Buscar_Delete").val();
        var frmMarca_producto="opc=6&show_marca_delete="+val_marca; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Marca_producto.php",
            data:frmMarca_producto,
            success:function(response){ 
                $("#tabla_result_delete").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
    
    //VOZ DE CLIENTE
	//valida el update
    
     var validatorUpdate = $("#frmVozcliente_Update").validate({ 
        rules: { 
            update_detalle_vozcliente: {
                required: true, 
                minlength: 1
            }, 
            update_patente_vozcliente:{
                 required: true, 
                minlength: 6
            },
            update_contacto_vozcliente:{
                required: true, 
                minlength: 1
            }
        }, 
        messages: { 
            update_detalle_vozcliente: "Debe ingresar un detalle",
            update_contacto_vozcliente:"Debe ingresar datos de contacto",
            update_patente_vozcliente:"Debe ingresar una patente válida (AAA111)"
            
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
           frmVozcliente_Update();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });
    
    $("#btn_vozcliente_Update").click(function(){
        var frmVozcliente= "opc=2&" + $("#frmVozcliente_Update").serialize(); 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Vozcliente.php?opc=2&",
            data:frmVozcliente,
            success:function(response){ 
				$('#dialg_vervozcliente').dialog('close');
                $('#dialg_msg').dialog('open');
                $("#msg").text("Los datos se han actualizado correctamente");
                
                location.reload();
            } 
        }); 
    });
    

	
	//ver detalle de voz de cliente
	$('#dialg_vervozcliente').dialog({
		autoOpen: false,
		width: 530,
		height: 500,
		modal: true
	});
    
    
    $(".clsMatrizModificar").livequery("click", function(e){
	  	$(".tag").remove();
	  	var id_vozcliente=$(this).attr("id").replace("btn_modificar","");

	  	$("#update_id_vozcliente").val(id_vozcliente);
	  	var frmVehiculo="show_id_vozcliente="+id_vozcliente+"&opc=4";
	   	$.ajax({ 
		        type:"POST",
		        url:"CONTROLLER/C_Vozcliente.php",
		        data:frmVehiculo,
		        dataType:'json',
		        success:function(response){ 
						$('#update_contacto_vozcliente').val(response._contacto);
						$('#update_detalle_vozcliente').val(response._detalle);
						$('#update_patente_vozcliente').val(response._patente);
						$('#update_id_vozcliente').val(response._id_vozcliente);
		        } 
		    }); 
	 
	 	$('#dialg_vervozcliente').dialog('open');
	});
    
    
    $("#btn_vozcliente_Print").click(function(){
    	var patente = $("#update_patente_vozcliente").val();
    	var detalle	= $("#update_detalle_vozcliente").val();
    	var contacto= $("#update_contacto_vozcliente").val();
    	
    	
    	var windowSizeArray = [ "width=200,height=200","width=800,height=600,scrollbars=yes" ];
    	var url		= "vozcliente_print.php";
    	var windowName 	= "popUp";//$(this).attr("name");
        var windowSize 	= windowSizeArray;
        var param		= "?&patente="+patente+"&detalle="+detalle+"&contacto="+contacto;
        var win			= window.open(url+param, windowName, windowSize);
    });


});
