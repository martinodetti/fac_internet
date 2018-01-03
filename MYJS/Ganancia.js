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
		var validator = $("#frmGanancia_Add").validate({ 
        rules: { 
            save_porctj_ganancia: {
                required: true, 
                minlength: 2
            },
            save_descrip_ganancia: {
                required: true, 
                minlength: 2
            }
        }, 
        messages: { 
            save_porctj_ganancia: "Ingrese un porcentaje", 
            save_descrip_ganancia: "Ingrese descripción"
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
            Ganancia_Add();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    //validator busca
    var validator2 = $("#frmGanancia_Buscar").validate({ 
        rules: { 
            txt_Buscar_Modificar: {
                number:true,
                required: false
            }
        }, 
        messages: { 
            txt_Buscar_Modificar: "Ingrese un número"
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
    
     var validator3 = $("#frmGanancia_Update").validate({ 
        rules: { 
            update_porctj_ganancia: {
                required: true,
                minlength: 1
            },
            update_descrip_ganancia:{
                 required: true,
                 minlength: 5
            }
        }, 
        messages: { 
            update_porctj_ganancia: "Mínimo un número",
            update_descrip_ganancia:"Mínimo 5 caracteres"
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
            updateFormGanancia();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    
    //validacion para el eliminar buscar
    
      var validator4 = $("#frmGanancia_Buscar_Delete").validate({ 
        rules: { 
            txt_Buscar_Delete: {
                required: true,
                minlength: 1,
                number:true
            }
        }, 
        messages: { 
            txt_Buscar_Delete: "Mínimo un número"
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
    // save_id_ganancia
    // save_porctj_ganancia
    // save_descrip_ganancia

    function Ganancia_Add(){
        var frmGanancia=$("#frmGanancia_Add").serialize(); 
        frmGanancia=frmGanancia+"&opc=1"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_ganancia.php",
            data:frmGanancia,
            success:function(response){ 
               $('#dialg_msg').dialog('open');
               $("#msg").text("Los datos se han guardado correctamente.");
            } 
        }); 
    }
    
    function resultBusquedad(){
        var val_porctj=$("#txt_Buscar_Modificar").val();
        var frmGanancia="opc=5&show_porctj_ganancia="+val_porctj; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Ganancia.php",
            data:frmGanancia,
            success:function(response){ 
                $("#tabla_result").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
    function resultBusquedad_Delete(){
        var val_porctj=$("#txt_Buscar_Delete").val();
        var frmGanancia="opc=6&show_porctj_ganancia_delete="+val_porctj; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Ganancia.php",
            data:frmGanancia,
            success:function(response){ 
                $("#tabla_result_delete").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
    
    //cargo formulario modal con sus valores
     $(".clsMatrizModificar").livequery("click", function(e){
         var id=$(this).attr("id").replace("btn_update","");
         var txt_porctj=$("#porctj_"+id).val();
         var txt_descrip=$("#descrip_"+id).val();
         $("#update_id_ganancia").val(id);
         $("#update_porctj_ganancia").val(txt_porctj);
         $("#update_descrip_ganancia").val(txt_descrip);
           $('#dialg_form').dialog('open');
     });
     //Documentación: Nombres que debe tener la caja de texto para Delete.
    // delete_id_ganancia . 
     //elimnado registros
     
     $(".clsMatrizEliminar").livequery("click", function(e){
         var id=$(this).attr("id").replace("btn_delete","");
        var frmGanancia="delete_id_ganancia="+id+"&opc=3"; 
        $.ajax({ 
            type:"POST",
            url:"Controller/C_ganancia.php",
            data:frmGanancia,
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
    
   
    $("#btn_Ganancia_New").click(function(){
        //nombre del formulario: frmGanancia_Add 
        $("#frmGanancia_Add .form-field").val ("");
    });
    
    //cancela la actualziacion
    $("#btn_Ganancia_Cancelar").click(function(){
  
       $('#dialg_form').dialog('close');
    });

    //Documentación: Nombres que debe tener las cajas de texto para Actualizar.
    // update_id_ganancia . 
    // update_porctj_ganancia . 
    // update_descrip_ganancia . 
    
    function updateFormGanancia(){
        //nombre del formulario: frmGanancia_Update 
        var frmGanancia=$("#frmGanancia_Update").serialize(); 
        frmGanancia=frmGanancia+"&opc=2"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_ganancia.php",
            data:frmGanancia,
            success:function(response){ 
                $('#dialg_form').dialog('close');
                $('#dialg_msg').dialog('open');
                $("#msg").text("Los datos se han actualizado correctamente");
                $("#tabla_result").empty();
            } 
        }); 
    }

});
