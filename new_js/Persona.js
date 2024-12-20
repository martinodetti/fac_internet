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
        "sAjaxSource": "VIEW/WBuscarProveedor.php?",
       "sPaginationType": "full_numbers",
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "xls", "pdf"                          
            ]
        }
    });
    
//focus en la busqueda de articulos
$("#table-example_filter").children().children().focus();
    
 //VALIDATION FORM//
    var validatorNuevo = $("#frmPersona_Add").validate({ 
        rules: { 
            save_nom_persona: {
                required: true, 
                minlength: 4
            },
            save_id_ciudad:{
                required: true
            },
            save_ruc_persona:{
                 required: false, 
                minlength: 7,
                maxlength:13
            },
            save_telf_persona:{
                required: false, 
                minlength:6
            },
            save_cel_persona:{
               required: false, 
                minlength:8
            },
            save_email_persona:{
                required: false,
                email:true
            },
            save_web_persona:{
               required: false,
                minlength:2
            },
            save_direc_persona:{
              required: false,
              minlength:5  
            },
            save_obs_persona:{
              required: false,
              minlength:5   
            },
            save_ganancia_persona:{
            	required:true,
            	number:true
            }
            
        }, 
        messages: { 
            save_nom_persona: "Ingrese la Razón Social",
            save_id_ciudad:"Seleccione una ciudad",
            save_ruc_persona:"Ingrese el CUIT/CUIL/DNI",
            save_telf_persona:"Ingrese un número de teléfono",
            save_cel_persona:"Ingrese un número de celular",
            save_email_persona:"Ingrese su e-mail",
            save_web_persona:"Ingrese la url",
            save_direc_persona:"Ingrese una dirección",
            save_obs_persona:"Ingrese la ocupación de la empresa",
            save_ganancia_persona:"Ingrese un margen de ganancia"
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
            frmPersona_Add();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    //validator busca
    var validatorBuscar = $("#frmProveedor_Buscar").validate({ 
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
    
     var validatorUpdate = $("#frmPersona_Update").validate({ 
        rules: { 
            update_nom_persona: {
                required: true, 
                minlength: 4
            },
            update_id_ciudad:{
                required: true
            },
            update_ruc_persona:{
                required: false, 
                minlength: 7,
                maxlength:13
            },
            update_telf_persona:{
                required: false, 
                minlength:6
            },
            update_cel_persona:{
               required: false, 
                minlength:8
            },
            update_email_persona:{
                required: false,
                email:true
            },
            update_web_persona:{
               required: false,
                minlength:2
            },
            update_direc_persona:{
              required: false,
              minlength:5  
            },
            update_obs_persona:{
              required: false,
              minlength:5   
            },
            update_ganancia_persona:{
            	required:true,
            	number: true
            }
            
        }, 
        messages: { 
            update_nom_persona: "Ingrese la Razón Social",
            update_id_ciudad:"Seleccione una ciudad",
            update_ruc_persona:"Ingrese el CUIT/CUIL/DNI",
            update_telf_persona:"Ingrese un número de teléfono",
            update_cel_persona:"Ingrese un número de celular",
            update_email_persona:"Ingrese su e-mail",
            update_web_persona:"Ingrese la url",
            update_direc_persona:"Ingrese una dirección",
            update_obs_persona:"Ingrese la ocupación de la empresa",
            update_ganancia_persona:"Ingrese un margen de ganancia"
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
           frmPersona_Update();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    
    //validacion para el eliminar buscar
    
      var validatorDelete = $("#frmProveedor_Buscar_Delete").validate({ 
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
			location.reload();
		});    
      //modal que actuliza          
		$('#dialg_form').dialog({
			autoOpen: false,
			width: 850,
			height: 570,
			modal: true
        });
        
        //modal que actuliza
		$('#dialg_ctacte').dialog({
			autoOpen: false,
			width: 400,
			height: 450,
			modal: true
		});


    //Nota: Agregar un tiempo adicional, al recibir el return del response.1s es sugerido.
    //Documentación:Nombres que debe tener las cajas de texto para Guardar.
    // save_id_persona  1
    // save_id_tipoper  1
    // save_id_ciudad   1
    // save_id_sexo      1
    // save_id_civil    1
    // save_nom_persona 1
    // save_ape_persona 1
    // save_ruc_persona 1
    // save_direc_persona   1
    // save_telf_persona    1
    // save_cel_persona 1
    // save_email_persona   1
    // save_web_persona 1
    // save_obs_persona 1
    // save_fec_persona 1
    // save_estado_persona  1
    // save_clave_persona   1

    function frmPersona_Add(){
        //nombre del formulario: frmPersona_Add 
        var frmPersona=$("#frmPersona_Add").serialize(); 
        frmPersona=frmPersona+"&opc=1"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Persona.php",
            data:frmPersona,
            success:function(response){ 
                $('#dialg_msg').dialog('open');
               	$("#msg").text("Los datos se han guardado correctamente.");
                $("#frmPersona_Add .form-field").val ("");
            }
        }); 
    }
    $("#btn_Persona_New").click(function(){
       $("#frmPersona_Add .form-field").val (""); 
    });
    $("#btn_Persona_Cancel").click(function(){
        $('#dialg_form').dialog('close');
    });

    //Documentación: Nombres que debe tener las cajas de texto para Actualizar.
    // update_id_persona . 
    // update_id_tipoper . 
    // update_id_ciudad . 
    // update_id_sexo . 
    // update_id_civil . 
    // update_nom_persona . 
    // update_ape_persona . 
    // update_ruc_persona . 
    // update_direc_persona . 
    // update_telf_persona . 
    // update_cel_persona . 
    // update_email_persona . 
    // update_web_persona . 
    // update_obs_persona . 
    // update_fec_persona . 
    // update_estado_persona . 
    // update_clave_persona . 

    function frmPersona_Update(){
        var frmPersona=$("#frmPersona_Update").serialize(); 
        frmPersona=frmPersona+"&opc=2"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Persona.php",
            data:frmPersona,
            success:function(response){ 
              $('#dialg_form').dialog('close');
                $('#dialg_msg').dialog('open');
                $("#msg").text("Los datos se han actualizado correctamente");
//                $("#tabla_result").reload();
//                location.reload();
            } 
        });   
    }

    $(".clsMatrizCtacte").livequery("click", function(e){
        var idper		= $(this).attr("id").replace("btn_ctacte","");//id de la persona
        var frmPersona	= "opc=33&id_provd="+idper;
        $("#txt_id_provd_temp").val(idper);
         $.ajax({
           type:"POST",
           url:"CONTROLLER/C_Persona.php",
           data:frmPersona,
           success:function(response){
               $("#ctacte_table").html($(response).fadeIn('slow'));
           }
       });

          $('#dialg_ctacte').dialog('open');
    });


    $('#btn_Detalle_imprimir').click(function (){
        var grid = "";//$("#ctacte_table").clone().html();
        var idcli = $("#txt_id_provd_temp").val();
        var windowSizeArray = [ "width=200,height=200","width=800,height=600,scrollbars=yes" ];
        var url 		= "ctacte_provd_print.php";
        var windowName 	= "popUp";//$(this).attr("name");
        var windowSize	= windowSizeArray;
        var param		= "?&provd="+idcli+"&grilla="+grid;
        var win			= window.open(url+param, windowName, windowSize);
    });

    $("#btn_Detalle_cerrar").click(function(){
        $('#dialg_ctacte').dialog('close');
    });
    
     //cargo formulario modal con sus valores
     $(".clsMatrizModificar").livequery("click", function(e){
         var idper=$(this).attr("id").replace("btn_update","");
        
         $("#update_id_persona").val(idper);
            var frmtrabajador="show_id_persona="+idper+"&opc=21"; 
            $.ajax({ 
                type:"POST",
                url:"CONTROLLER/C_Persona.php",
                data:frmtrabajador,
                dataType:'json',
                success:function(response){ 
                    $("#update_id_tipoper").val(response._id_tipoper);
                    $("#update_nom_persona").val(response._nom_persona);
                    $('#update_id_ciudad').val(response._id_ciudad);
                    $("#update_ruc_persona").val(response._ruc_persona);
                    $("#update_telf_persona").val(response._telf_persona);
                    $("#update_telf_persona_2").val(response._telf_persona_2);
                    $("#update_cel_persona").val(response._cel_persona);
                    $("#update_email_persona").val(response._email_persona);
                    $("#update_web_persona").val(response.web_persona);
                    $("#update_direc_persona").val(response._direc_persona);
                    $("#update_obs_persona").val(response._obs_persona);
                    $("#update_id_condiva").val(response._id_condiva);
                    $("#update_ganancia_persona").val(response._ganancia);
					$("#update_id_cliente").val(response._id_cliente_proveedor);
                    
                    if(parseFloat(response._id_ciudad) > 0){
                    	var id_c = response._id_ciudad;
                    	var id_p = 0;
						$("#update_id_ciudad").empty();
                    	param = "opc=26&id_c="+id_c;
                    	$.ajax({
                    		type:"POST",
							url:"CONTROLLER/C_Persona.php",
							data:param,
							dataType:"json",
							success:function(response){
								$("#update_id_ciudad").append('<option value="0"> </option>');
								$.each(response, function(i,item){
									if(parseFloat(item.id_ciudad) == parseFloat(id_c)){
										$("#update_id_ciudad").append('<option value="'+item.id_ciudad+'" selected="selected">'+item.nom_ciudad+'</option>');
										id_p = item.id_provincia;

									}else{
										$("#update_id_ciudad").append('<option value="'+item.id_ciudad+'">'+item.nom_ciudad+'</option>');
									}
									
								});
								$("#update_id_provincia").val(id_p);
							}
                    	});
                    }
                } 
            }); 

           $('#dialg_form').dialog('open');
     });
    
    $(".clsMatrizEliminar").livequery("click", function(e){
         var id=$(this).attr("id").replace("btn_delete","");
        var frmProveedor="delete_id_persona="+id+"&opc=3"; 
       
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Persona.php",
            data:frmProveedor,
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
        var val_razon=$("#txt_Buscar_Modificar").val();
        var frmProveedor="opc=5&show_razon="+val_razon; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Persona.php",
            data:frmProveedor,
            success:function(response){ 
                $("#tabla_result").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
    
    function resultBusquedad_Delete(){
        var val_razon=$("#txt_Buscar_Delete").val();
        var frmProveedor="opc=7&show_razon_delete="+val_razon; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Persona.php",
            data:frmProveedor,
            success:function(response){ 
                $("#tabla_result_delete").html($(response).fadeIn('slow')); 
            } 
        }); 
    }


//manejo de provincia y localidad

	$("#save_id_provincia").change(function(){
		$("#save_id_ciudad").empty();
		id_prov = $("#save_id_provincia").val();
		param = "opc=25&id_prov="+id_prov;
		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Persona.php",
			data:param,
			dataType:"json",
			success:function(response){
				$("#save_id_ciudad").append('<option value="0"> </option>');
				$.each(response, function(i,item){
					$("#save_id_ciudad").append('<option value="'+item.id_ciudad+'">'+item.nom_ciudad+'</option>');
				});
				
			}
		
		});
	
	});

    $("#save_ruc_persona").blur(function(){
		cuit= $("#save_ruc_persona").val();
        param = "opc=34&id_tipo_per=2&ruc="+cuit;
        console.log(param);
        $.ajax({
			type:"POST",
			url:"CONTROLLER/C_Persona.php",
			data:param,
			dataType:"json",
			success:function(response){
				if(response != ''){
                    alert("El número de CUIT "+cuit+ " ya se encuentra registrado");
                    $("#save_ruc_persona").val("");
                    $("#save_ruc_persona").focus();
                }
			}
		});
	});
    

	$("#update_id_provincia").change(function(){
		$("#update_id_ciudad").empty();
		id_prov = $("#update_id_provincia").val();
		param = "opc=25&id_prov="+id_prov;
		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Persona.php",
			data:param,
			dataType:"json",
			success:function(response){
				$("#update_id_ciudad").append('<option value="0"> </option>');
				$.each(response, function(i,item){
					$("#update_id_ciudad").append('<option value="'+item.id_ciudad+'">'+item.nom_ciudad+'</option>');
				});
				
			}
		
		});
	
	});
    
    

});



