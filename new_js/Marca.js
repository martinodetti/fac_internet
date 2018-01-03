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
        "sAjaxSource": "VIEW/WBuscarMarca.php?",
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
            save_nom_marca: {
                required: true, 
                minlength: 2
            }
        }, 
        messages: { 
            save_nom_marca: "Ingrese la 	Marca del Producto"
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
                
        $('#dial_msg_close').click(function() {
			$('#dialg_msg').dialog('close');
			location.reload();
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
            url:"CONTROLLER/C_Marca_producto.php",
            data:frmMarca_producto,
            success:function(response){ 
                 $('#dialg_msg').dialog('open');
               $("#msg").text("Los datos se han guardado correctamente.");
                $("#frmMarca_producto_Add .form-field").val ("");
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
 


    //esconde el modal form
    $("#btn_Marca_producto_Cancel").click(function(){
        $('#dialg_form').dialog('close');
        
    });
    
     $("#btn_Marca_producto_New").click(function(){
        $("#frmMarca_producto_Add .form-field").val ("");
        
    });
    
    //cargo formulario modal con sus valores
     $(".clsMatrizModificar").livequery("click", function(e){
         var id=$(this).attr("id").replace("btn_update","");
         var txt_marca=$("#marca_"+id).val();        
         $("#update_id_marca").val(id);
         $("#update_nom_marca").val(txt_marca);
           $('#dialg_form').dialog('open');
     });
     
     
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

});
