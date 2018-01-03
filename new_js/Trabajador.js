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

//Tables

var oTable=  $('#table-example').dataTable({
        "bServerSide": true,
        "bFilter": true,
        "bJQueryUI": true,
        "sAjaxSource": "VIEW/WBuscarTrabajador.php?",
       "sPaginationType": "full_numbers",
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "csv", "xls", "pdf"                          
            ]
        }
    });



//end tables
 //VALIDATION FORM//
    var validatorNuevo = $("#frmPersona_Add").validate({ 
        rules: { 
            save_nom_persona: {
                required: true, 
                minlength: 4
            },
            save_ape_persona: {
                required: true, 
                minlength: 4
            },
            save_id_ciudad:{
                required: true
            },
            save_id_sexo:{
                required: true
            },
            save_id_civil:{
                required: true
            },
            save_ruc_persona:{
                 required: true, 
                minlength: 10,
                maxlength:13,
                number:true
            },
            save_telf_persona:{
                required: false, 
                minlength:7,
                number:true
            },
            save_cel_persona:{
               required: true, 
                minlength:9 ,
                number:true
            },
            save_email_persona:{
                required: false,
                email:true
            },
            
            save_direc_persona:{
              required: true,
              minlength:5  
            },
            save_obs_persona:{
              required: true,
              minlength:5   
            }
            
        }, 
        messages: { 
            save_nom_persona: "Ingrese el nombre",
            save_ape_persona: "Ingrese el apellido",
            save_id_ciudad:"Seleccione una ciudad",
            save_id_sexo:"Seleccione su sexo",
            save_id_civil:"Seleccione su estado civil",
            save_ruc_persona:"Ingrese su cédula o RUC",
            save_telf_persona:"Ingrese un número de teléfono",
            save_cel_persona:"Ingrese un número de celular",
            save_email_persona:"Ingrese su e-mail",
            save_web_persona:"Ingrese la url",
            save_direc_persona:"Ingrese una dirección",
            save_obs_persona:"Ingrese una descripción de la ocupación"
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
    var validatorBuscar = $("#frmTrabajador_Buscar").validate({ 
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
            update_ape_persona: {
                required: true, 
                minlength: 4
            },
            update_id_ciudad:{
                required: true
            },
            update_id_sexo:{
                required: true
            },
            update_id_civil:{
                required: true
            },
            update_ruc_persona:{
                 required: true, 
                minlength: 10,
                maxlength:13,
                number:true
            },
            update_telf_persona:{
                required: false, 
                minlength:7,
                number:true
            },
            update_cel_persona:{
               required: true, 
                minlength:9 ,
                number:true
            },
            update_email_persona:{
                required: false,
                email:true
            },  
            update_direc_persona:{
              required: true,
              minlength:5  
            },
            update_obs_persona:{
              required: true,
              minlength:5   
            }
            
        }, 
        messages: { 
            update_nom_persona: "Ingrese el nombre",
            update_ape_persona: "Ingrese el apellido",
            update_id_ciudad:"Seleccione una ciudad",
            update_id_civil:"Seleccione el estado civil",
            update_id_sexo:"Seleccione el sexo",
            update_ruc_persona:"Ingrese el RUC",
            update_telf_persona:"Ingrese un número de teléfono",
            update_cel_persona:"Ingrese un número de celular",
            update_email_persona:"e-mail invalido",
            update_direc_persona:"Ingrese una dirección",
            update_obs_persona:"Ingrese la ocupación de la empresa"
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
    
      var validatorDelete = $("#frmTrabajador_Buscar_Delete").validate({ 
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
			width: 850,
			height: 500,
			modal: true
		});
                                          
                
                








    //Nota: Agregar un tiempo adicional, al recibir el return del response.1s es sugerido.
    //Documentación:Nombres que debe tener las cajas de texto para Guardar.
    // save_id_persona  0
    // save_id_tipoper  0
    // save_id_ciudad   0
    // save_id_sexo     0
    // save_id_civil    0
    // save_nom_persona 0
    // save_ape_persona 0
    // save_ruc_persona 0
    // save_direc_persona   0
    // save_telf_persona    0
    // save_cel_persona     0
    // save_email_persona   0
    // save_web_persona                   1
    // save_obs_persona     0
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
    // update_id_persona . 0
    // update_id_tipoper . 0
    // update_id_ciudad . 0
    // update_id_sexo . 0
    // update_id_civil . 0
    // update_nom_persona . 0
    // update_ape_persona . 0
    // update_ruc_persona . 0
    // update_direc_persona . 0
    // update_telf_persona . 0
    // update_cel_persona . 0
    // update_email_persona . 0
    // update_web_persona . 1
    // update_obs_persona . 0
    // update_fec_persona . 1
    // update_estado_persona . 1
    // update_clave_persona . 1

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
                $("#tabla_result").empty();
            } 
        });   
    }
    
     //cargo formulario modal con sus valores
     $(".clsMatrizModificar").livequery("click", function(e){
         var idper=$(this).attr("id").replace("btn_update","");
           var frmtrabajador="show_id_persona="+idper+"&opc=20"; 
            $.ajax({ 
                type:"POST",
                url:"Controller/C_Persona.php",
                data:frmtrabajador,
                dataType:'json',
                success:function(response){ 
                    $("#update_id_persona").val(idper);
                    $("#update_id_tipoper").val(response._id_tipoper);
                    $("#update_nom_persona").val(response._nom_persona);
                    $("#update_ape_persona").val(response._ape_persona);

                    $("#update_id_sexo").val(response._id_sexo);
                    $('#update_id_ciudad').val(response._id_ciudad);
                    $('#update_id_civil').val(response._id_civil);

                    $("#update_ruc_persona").val(response._ruc_persona);
                    $("#update_telf_persona").val(response._telf_persona);
                    $("#update_cel_persona").val(response._cel_persona);
                    $("#update_email_persona").val(response._email_persona);
                    $("#update_direc_persona").val(response._direc_persona);
                    $("#update_obs_persona").val(response._obs_persona);
          
                } 
            }); 

           $('#dialg_form').dialog('open');
     });
    
    $(".clsMatrizEliminar").livequery("click", function(e){
         var id=$(this).attr("id").replace("btn_delete","");
        var frmtrabajador="delete_id_persona="+id+"&opc=3"; 
        $.ajax({ 
            type:"POST",
            url:"Controller/C_Persona.php",
            data:frmtrabajador,
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
        var ape_traba=$("#txt_Buscar_Modificar").val();
        var frmtrabajador="opc=8&ape_trabajador="+ape_traba; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Persona.php",
            data:frmtrabajador,
            success:function(response){ 
                $("#tabla_result").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
    
    function resultBusquedad_Delete(){
        var ape_traba=$("#txt_Buscar_Delete").val();
        var frmtrabajador="opc=9&ape_trabajador_delete="+ape_traba; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Persona.php",
            data:frmtrabajador,
            success:function(response){ 
                $("#tabla_result_delete").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
 
    
    

});






