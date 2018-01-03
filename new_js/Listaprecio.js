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
        "sAjaxSource": "VIEW/WBuscarListaprecio.php?",
       "sPaginationType": "full_numbers",
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "xls", "pdf"                          
            ]
        }
    });
 //VALIDATION FORM//
		var validator = $("#frmListaprecio_Add").validate({ 
        rules: { 
            save_porcentaje_listaprecio: {
                required: true, 
                minlength: 2
            },
            save_nombre_listaprecio: {
                required: true, 
                minlength: 2
            }
        }, 
        messages: { 
            save_porcentaje_listaprecio: "Ingrese un porcentaje", 
            save_nombre_listaprecio: "Ingrese nombreción"
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
            Listaprecio_Add();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    //validator busca
    var validator2 = $("#frmListaprecio_Buscar").validate({ 
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
    
     var validator3 = $("#frmListaprecio_Update").validate({ 
        rules: { 
            update_porcentaje_listaprecio: {
                required: true,
                minlength: 1
            },
            update_nombre_listaprecio:{
                 required: true,
                 minlength: 2
            }
        }, 
        messages: { 
            update_porcentaje_listaprecio: "Mínimo un número",
            update_nombre_listaprecio:"Mínimo 2 caracteres"
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
            updateFormListaprecio();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    
    //validacion para el eliminar buscar
    
      var validator4 = $("#frmListaprecio_Buscar_Delete").validate({ 
        rules: { 
            txt_Buscar_Delete: {
                required: true,
                minlength: 1
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
			location.reload();
		});    
      //modal que actuliza          
		$('#dialg_form').dialog({
			autoOpen: false,
			width: 500,
			height: 260,
			modal: true
		});
                
 
      
    //Nota: Agregar un tiempo adicional, al recibir el return del response.1s es sugerido.
    //Documentación:Nombres que debe tener las cajas de texto para Guardar.
    // save_id_listaprecio
    // save_porcentaje_listaprecio
    // save_nombre_listaprecio

    function Listaprecio_Add(){
        var frmListaprecio=$("#frmListaprecio_Add").serialize(); 
        frmListaprecio=frmListaprecio+"&opc=1"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Listaprecio.php",
            data:frmListaprecio,
            success:function(response){ 
               $('#dialg_msg').dialog('open');
               $("#msg").text("Los datos se han guardado correctamente.");
            } 
        }); 
    }
    
    function resultBusquedad(){
        var val_porcentaje=$("#txt_Buscar_Modificar").val();
        var frmListaprecio="opc=5&show_porcentaje_listaprecio="+val_porcentaje; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Listaprecio.php",
            data:frmListaprecio,
            success:function(response){ 
                $("#tabla_result").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
    function resultBusquedad_Delete(){
        var val_porcentaje=$("#txt_Buscar_Delete").val();
        var frmListaprecio="opc=6&show_porcentaje_listaprecio_delete="+val_porcentaje; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Listaprecio.php",
            data:frmListaprecio,
            success:function(response){ 
                $("#tabla_result_delete").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
    
    //cargo formulario modal con sus valores
     $(".clsMatrizModificar").livequery("click", function(e){
         var id=$(this).attr("id").replace("btn_update","");
         var txt_porcentaje=$("#porcentaje_"+id).val();
         var txt_nombre=$("#nombre_"+id).val();
         $("#update_id_listaprecio").val(id);
         $("#update_porcentaje_listaprecio").val(txt_porcentaje);
         $("#update_nombre_listaprecio").val(txt_nombre);
           $('#dialg_form').dialog('open');
     });
     //Documentación: Nombres que debe tener la caja de texto para Delete.
    // delete_id_listaprecio . 
     //elimnado registros
     
     $(".clsMatrizEliminar").livequery("click", function(e){
         var id=$(this).attr("id").replace("btn_delete","");
        var frmListaprecio="delete_id_listaprecio="+id+"&opc=3"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Listaprecio.php",
            data:frmListaprecio,
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
    
   
    $("#btn_Listaprecio_New").click(function(){
        //nombre del formulario: frmListaprecio_Add 
        $("#frmListaprecio_Add .form-field").val ("");
    });
    
    //cancela la actualziacion
    $("#btn_Listaprecio_Cancelar").click(function(){
         $('#dialg_form').dialog('close');
    });

    //Documentación: Nombres que debe tener las cajas de texto para Actualizar.
    // update_id_listaprecio . 
    // update_porcentaje_listaprecio . 
    // update_nombre_listaprecio . 
    
    function updateFormListaprecio(){
        //nombre del formulario: frmListaprecio_Update 
        var frmListaprecio=$("#frmListaprecio_Update").serialize(); 
        frmListaprecio=frmListaprecio+"&opc=2"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Listaprecio.php",
            data:frmListaprecio,
            success:function(response){ 
                $('#dialg_form').dialog('close');
                $('#dialg_msg').dialog('open');
                $("#msg").text("Los datos se han actualizado correctamente");
                $("#tabla_result").empty();
            } 
        }); 
    }

});
