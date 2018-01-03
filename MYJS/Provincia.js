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
		
		//TABLES
	var oTable=  $('#table-example').dataTable({
        "bServerSide": true,
        "bFilter": true,
        "bJQueryUI": true,
        "sAjaxSource": "VIEW/WBuscarProvincia.php?",
       "sPaginationType": "full_numbers",
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "xls", "pdf"                          
            ]
        }
    });
	
	var oTable1=  $('#table-example_loc').dataTable({
        "bServerSide": true,
        "bFilter": true,
        "bJQueryUI": true,
        "sAjaxSource": "VIEW/WBuscarCiudades.php?",
       "sPaginationType": "full_numbers",
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "xls", "pdf"                          
            ]
        }
    });
                
   //VALIDATION FORM//
		var validatorNuevo = $("#frmProvincia_Add").validate({ 
        rules: { 
            save_nom_provincia: {
                required: true, 
                minlength: 2
            }
        }, 
        messages: { 
            save_nom_provincia: "Ingrese el nombre de la provincia"
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
          Provincia_Add();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    //validator busca
    var validatorBuscar = $("#frmProvincia_Buscar").validate({ 
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
    
     var validatorUpdate = $("#frmProvincia_Update").validate({ 
        rules: { 
            update_nom_provincia: {
                required: true,
                minlength: 2
            }   
        }, 
        messages: { 
            update_nom_provincia: "Mínimo dos caracteres"
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
           Provincia_Update();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });   
	
	var validatorUpdateCiudad = $("#frmCiudad_Update").validate({ 
        rules: { 
            update_nom_ciudad_edit: {
                required: true,
                minlength: 2
            }   
        }, 
        messages: { 
            update_nom_ciudad_edit: "Mínimo dos caracteres"
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
           Ciudad_Update_Edit();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });    
    
    
    $("#btn_Ciudad_new").click(function(){
	    $('#dialg_form_2').dialog('open');
    });
    
    
    //validacion para el eliminar buscar
    
      var validatorDelete = $("#frmProvincia_Buscar_Delete").validate({ 
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
			width: 500,
			height: 140,
			modal: true
		});
                
        $('#dial_msg_close').click(function() {
			$('#dialg_msg').dialog('close');
		});    
      //modal que actuliza          
		$('#dialg_form').dialog({
			autoOpen: false,
			width: 600,
			height: 400,
			modal: true
		});
		
		$('#dialg_form_ciudad').dialog({
			autoOpen: false,
			width: 320,
			height: 200,
			modal: true
		});
		
		$('#dialg_form_2').dialog({
			autoOpen: false,
			width: 300,
			height: 200,
			modal: true
		});
		
                             
  	// save_nom_provincia              
 	function Provincia_Add(){
        var frmProvincia=$("#frmProvincia_Add").serialize(); 
        frmProvincia=frmProvincia+"&opc=1"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Provincia.php",
            data:frmProvincia,
            success:function(response){ 
                $('#dialg_msg').dialog('open');
               	$("#msg").text("Los datos se han guardado correctamente.");
                $("#frmProvincia_Add .form-field").val ("");
                location.reload();
            } 
        }); 
    }
    
    
    
  	//Documentación: Nombres que debe tener las cajas de texto para Actualizar.
    // update_id_provincia . 
    // update_nom_provincia .   
 	function Provincia_Update(){
        var frmProvincia=$("#frmProvincia_Update").serialize(); 
        frmProvincia=frmProvincia+"&opc=2"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Provincia.php",
            data:frmProvincia,
            success:function(response){ 
                 $('#dialg_form').dialog('close');
                $('#dialg_msg').dialog('open');
                $("#msg").text("Los datos se han actualizado correctamente");
//                $("#tabla_result").reload();
				location.reload();
            }
        });   
    }
	
	//Documentación: Nombres que debe tener las cajas de texto para Actualizar.
    // update_id_provincia . 
    // update_nom_provincia .   
 	function Ciudad_Update_Edit(){
        var frmCiudad=$("#frmCiudad_Update").serialize(); 
        frmCiudad=frmCiudad+"&opc=9"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Provincia.php",
            data:frmCiudad,
            success:function(response){ 
                 $('#dialg_form').dialog('close');
                $('#dialg_msg').dialog('open');
                $("#msg").text("Los datos se han actualizado correctamente");
//                $("#tabla_result").reload();
				location.reload();
            }
        });   
    }
 


    //esconde el modal form
    $("#btn_Provincia_Cancel").click(function(){
        $('#dialg_form').dialog('close');
        
    });
	
	//esconde el modal form
    $("#btn_Ciudad_Cancel").click(function(){
        $('#dialg_form_ciudad').dialog('close');
        
    });
    
    $("#btn_ciudad_Cancel").click(function(){
        $('#dialg_form_2').dialog('close');
        
    });
    
     $("#btn_Provincia_New").click(function(){
        $("#frmProvincia_Add .form-field").val ("");
        
    });
    
    //cargo formulario modal con sus valores
     $(".clsMatrizModificar").livequery("click", function(e){
         var id=$(this).attr("id").replace("btn_update","");
         var txt_provincia=$("#provincia_"+id).val();
         $("#update_id_provincia").val(id);
         $("#update_nom_provincia").val(txt_provincia);
         
         
         //Aca nos traemos las localidades
         
        dat_localidades = [];
		$.ajax({ 
			type:"POST",
			url:"CONTROLLER/C_Provincia.php?",
			data:"opc=7&id_provincia=" + id,
			success:function(response){ 
				var arr = response.split("|");
				var length = arr.length - 1;
				for(var i = 0; i < length ; i++) {
					var arr_1 = arr[i].split(";");
					var id = ltrim(arr_1[0]);
					var nombre = ltrim(arr_1[1]);
					var row_tmp = {
						id:id,
						ciudad:nombre
					};
					dat_localidades.push(row_tmp);
				}

				var datainfo = {
					"total":0,
					"rows":dat_localidades
				};
				$("#localidad_table").datagrid('loadData',datainfo);
			}
		});
         
         $('#dialg_form').dialog('open');
     });
     
	 
	 //cargo formulario modal con sus valores
     $(".clsMatrizModificarCiudad").livequery("click", function(e){
         var id=$(this).attr("id").replace("btn_update_cuidad","");
         var txt_ciudad=$("#ciudad_"+id).val();
         $("#update_id_ciudad_edit").val(id);
         $("#update_nom_ciudad_edit").val(txt_ciudad);
         
         
         //Aca nos traemos las localidades
         
         $('#dialg_form_ciudad').dialog('open');
     });
     
	 
     
     $("#btn_ciudad_update").click(function(){
    	nueva_ciudad = $("#update_nom_ciudad").val();
    	id = $("#update_id_provincia").val();

    	if(nueva_ciudad.length > 3){
    	
    		$.ajax({ 
				type:"POST",
				url:"CONTROLLER/C_Provincia.php?",
				data:"opc=8&id_provincia=" + id + "&ciudad="+nueva_ciudad,
				success:function(response){ 

					
					var dat_localidades = [];

					$.ajax({ 
						type:"POST",
						url:"CONTROLLER/C_Provincia.php?",
						data:"opc=7&id_provincia=" + id,
						success:function(response){ 
							var arr = response.split("|");
							var length = arr.length - 1;
							for(var i = 0; i < length ; i++) {
								var arr_1 = arr[i].split(";");
								var id = ltrim(arr_1[0]);
								var nombre = ltrim(arr_1[1]);
								var row_tmp = {
									id:id,
									ciudad:nombre
								};
								dat_localidades.push(row_tmp);
							}

							var datainfo = {
								"total":0,
								"rows":dat_localidades
							};
							$("#localidad_table").datagrid('loadData',datainfo);
						}
					});


				}
			});
    	}
    	$("#update_nom_ciudad").val('');
        $('#dialg_form_2').dialog('close');
        
    });
     
     
    //Documentación: Nombres que debe tener la caja de texto para Delete.
    // delete_id_provincia . 
 	$(".clsMatrizEliminar").livequery("click", function(e){
        var id=$(this).attr("id").replace("btn_delete","");
        var frmProvincia="delete_id_provincia="+id+"&opc=3"; 
        $.ajax({ 
            type:"POST",
            url:"Controller/C_Provincia.php",
            data:frmProvincia,
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
        var val_provincia=$("#txt_Buscar_Modificar").val();
        var frmProvincia="opc=5&show_provincia="+val_provincia; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Provincia.php",
            data:frmProvincia,
            success:function(response){ 
                $("#tabla_result").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
    
    function resultBusquedad_Delete(){
        var val_provincia=$("#txt_Buscar_Delete").val();
        var fmrProvincia="opc=6&show_provincia_delete="+val_provincia; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Provincia.php",
            data:frmProvincia,
            success:function(response){ 
                $("#tabla_result_delete").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
    
    //ltrim quita los espacios o caracteres indicados al inicio de la cadena
	function ltrim(str, chars) {
		chars = chars || "\\s";
		return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
	}

});
