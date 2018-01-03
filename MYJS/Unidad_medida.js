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
    
 //VALIDATION FORM//
		var validatorNuevo = $("#frmUnidad_medida_Add").validate({ 
        rules: { 
            save_nom_unimedida: {
                required: true, 
                minlength: 2
            }
        }, 
        messages: { 
            save_nom_unimedida: "Ingrese la Unidad de Medida"
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
            Unidad_medida_Add();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    //validator busca
    var validatorBuscar = $("#frmUnidadMedida_Buscar").validate({ 
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
    
    //valida la actualización
    
     var validatorUpdate = $("#frmUnidadMedida_Update").validate({ 
        rules: { 
            update_nom_unimedida: {
                required: true,
                minlength: 2
            }   
        }, 
        messages: { 
            update_nom_unimedida: "Mínimo dos caracteres"
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
            UnidadMedida_Update();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    
    //validacion para el eliminar buscar
    
      var validatorDelete = $("#frmMedida_Buscar_Delete").validate({ 
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
                
        $('#dial_msg_close').click(function() {
			$('#dialg_msg').dialog('close');
		});    
      //modal que actuliza          
		$('#dialg_form').dialog({
			autoOpen: false,
			width: 500,
			height: 240,
			modal: true
		});
                










    //Nota: Agregar un tiempo adicional, al recibir el return del response.1s es sugerido.
    //Documentación:Nombres que debe tener las cajas de texto para Guardar.

    // save_id_unimedida
    // save_nom_unimedida

    function Unidad_medida_Add(){
        var frmUnidad_medida=$("#frmUnidad_medida_Add").serialize(); 
        frmUnidad_medida=frmUnidad_medida+"&opc=1"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Unidad_medida.php",
            data:frmUnidad_medida,
            success:function(response){ 
               $('#dialg_msg').dialog('open');
               $("#msg").text("Los datos se han guardado correctamente.");
            } 
        }); 
    }
    
     function resultBusquedad(){
        var val_medida=$("#txt_Buscar_Modificar").val();
        var frmMedida="opc=5&show_unidad_medida="+val_medida; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Unidad_medida.php",
            data:frmMedida,
            success:function(response){ 
                $("#tabla_result").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
    
    function resultBusquedad_Delete(){
        var val_medida=$("#txt_Buscar_Delete").val();
        var frmMedida="opc=6&show_medida_delete="+val_medida; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Unidad_medida.php",
            data:frmMedida,
            success:function(response){ 
                $("#tabla_result_delete").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
    
    //Documentación: Nombres que debe tener las cajas de texto para Actualizar.
    // update_id_unimedida . 
    // update_nom_unimedida . 
    function UnidadMedida_Update(){
        var frmUnidad_medida=$("#frmUnidadMedida_Update").serialize(); 
        frmUnidad_medida=frmUnidad_medida+"&opc=2"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Unidad_medida.php",
            data:frmUnidad_medida,
            success:function(response){ 
                $('#dialg_form').dialog('close');
                $('#dialg_msg').dialog('open');
                $("#msg").text("Los datos se han actualizado correctamente");
                $("#tabla_result").empty();
            } 
        }); 
        
    }
    
    $("#btn_Unidad_medida_New").click(function(){
        //nombre del formulario: frmGanancia_Add 
        $("#frmUnidad_medida_Add .form-field").val ("");
    });

    $("#btn_UnidadMedida_Cancelar").click(function(){
       $('#dialg_form').dialog('close');
    });
   
    //cargo formulario modal con sus valores
     $(".clsMatrizModificar").livequery("click", function(e){
         var id=$(this).attr("id").replace("btn_update","");
         var txt_medida=$("#medida_"+id).val();
         $("#update_id_unimedida").val(id);
         $("#update_nom_unimedida").val(txt_medida);
           $('#dialg_form').dialog('open');
     });
   

    //Documentación: Nombres que debe tener la caja de texto para Delete.
    // delete_id_unimedida . 
    
      $(".clsMatrizEliminar").livequery("click", function(e){
         var id=$(this).attr("id").replace("btn_delete","");
        var frmUnidad_medida="delete_id_unimedida="+id+"&opc=3"; 
        $.ajax({ 
            type:"POST",
            url:"Controller/C_unidad_medida.php",
            data:frmUnidad_medida,
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
    
  

});
