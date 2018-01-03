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
    var validatorNuevo = $("#frmTiporetencion_Add").validate({ 
        rules: { 
            save_cod_codRetAir: {
                required: true, 
                minlength: 2,
                number:true
            },
            save_nom_codRetAir:{
                required: true, 
                minlength: 2,
                maxlength:100
            },
            save_porcentaje_codRetAir:{
                 required: true, 
                minlength: 1,
                number:true
            }
        }, 
        messages: { 
            save_cod_codRetAir: "Ingrese mínimo un número",
            save_nom_codRetAir:"Ingrese mínimo un caracter",
            save_porcentaje_codRetAir:"Ingrese mínimo un número"
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
          Tiporetencion_Add();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    //validator busca
    var validatorBuscar = $("#frmRetencion_Buscar").validate({ 
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
    
     var validatorUpdate = $("#frmTiporetencion_Update").validate({ 
        rules: { 
             save_cod_codRetAir: {
                required: true, 
                minlength: 2,
                number:true
            },
            save_nom_codRetAir:{
                required: true, 
                minlength: 2,
                maxlength:100
            },
            save_porcentaje_codRetAir:{
                 required: true, 
                minlength: 2,
                number:true
            }
        }, 
        messages: { 
            save_cod_codRetAir: "Ingrese mínimo un número",
            save_nom_codRetAir:"Ingrese mínimo un caracter",
            save_porcentaje_codRetAir:"Ingrese mínimo un número"
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
           Tiporetencion_Update();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    
    //validacion para el eliminar buscar
    
      var validatorDelete = $("#frmRetencion_Buscar_Delete").validate({ 
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
			width: 500,
			height: 300,
			modal: true
		});
                                          
                
                
                
                
                
                
                
                
                
                

    //Nota: Agregar un tiempo adicional, al recibir el return del response.1s es sugerido.
    //Documentación:Nombres que debe tener las cajas de texto para Guardar.
    // save_id_tiporeten
    // save_cod_codRetAir
    // save_nom_codRetAir
    // save_porcentaje_codRetAir
    function Tiporetencion_Add(){
        var frmTiporetencion=$("#frmTiporetencion_Add").serialize(); 
        frmTiporetencion=frmTiporetencion+"&opc=1"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Tiporetencion.php",
            data:frmTiporetencion,
            success:function(response){ 
                 $('#dialg_msg').dialog('open');
               $("#msg").text("Los datos se han guardado correctamente.");
                $("#frmTiporetencion_Add .form-field").val ("");
            } 
        }); 
    }
    
    $("#btn_Tiporetencion_New").click(function(){
        //nombre del formulario: frmTiporetencion_Add 
       $("#frmTiporetencion_Add .form-field").val ("");
    });
    $("#btn_Retencion_Cancel").click(function(){
        //nombre del formulario: frmTiporetencion_Add 
        $('#dialg_form').dialog('close');
    });


    //Documentación: Nombres que debe tener las cajas de texto para Actualizar.

    // update_id_tiporeten . 
    // update_cod_codRetAir . 
    // update_nom_codRetAir . 
    // update_porcentaje_codRetAir . 

    function Tiporetencion_Update(){  
        //nombre del formulario: frmTiporetencion_Update 
        var frmTiporetencion=$("#frmTiporetencion_Update").serialize(); 
        frmTiporetencion=frmTiporetencion+"&opc=2"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Tiporetencion.php",
            data:frmTiporetencion, 
            success:function(response){ 
                 $('#dialg_form').dialog('close');
                $('#dialg_msg').dialog('open');
                $("#msg").text("Los datos se han actualizado correctamente");
                $("#tabla_result").empty();
            } 
        }); 
    }
    
     //cargo formulario modal con sus valores
     $(".clsMatrizModificar").livequery("click", function(e){
         var id=$(this).attr("id").replace("btn_update","");
         var txt_cod=$("#cod_"+id).val();
         var reten=$("#reten_"+id).val();
         var porce=$("#porce_"+id).val(); 
         $("#update_id_tiporeten").val(id);
         $("#update_cod_codRetAir").val(txt_cod);
         $("#update_nom_codRetAir").val(reten);
         $("#update_porcentaje_codRetAir").val(porce);
           $('#dialg_form').dialog('open');
     });
     
    //Documentación: Nombres que debe tener la caja de texto para Delete.
    // delete_id_tiporeten . 
     $(".clsMatrizEliminar").livequery("click", function(e){
         var id=$(this).attr("id").replace("btn_delete","");
        var frmTiporetencion="delete_id_tiporeten="+id+"&opc=3"; 
        $.ajax({ 
            type:"POST",
            url:"Controller/C_Tiporetencion.php",
            data:frmTiporetencion,
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
        var frmRetencion="opc=5&show_retencion="+val_marca; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Tiporetencion.php",
            data:frmRetencion,
            success:function(response){ 
                $("#tabla_result").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
    
    function resultBusquedad_Delete(){
        var val_tipo=$("#txt_Buscar_Delete").val();
        var frmRetencion="opc=6&show_retencion_delete="+val_tipo; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Tiporetencion.php",
            data:frmRetencion,
            success:function(response){ 
                $("#tabla_result_delete").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
 

});
