$(document).ready(function(){

// $.validator.addMethod('IP4Checker', function(value) {
// var ip = "^(25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[0-9]{2}"+
//             "|[0-9])(\.(25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[0-9]{2}|[0-9])){3}$";
//    return value.match(ip);
//            }, 'IP invalida');
 //BOX SORTABLE //

 	var dat_ctacte = [];

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

    $(".datepicker").datepicker();
    $('.datepicker').datepicker('option', {dateFormat: 'yy/mm/dd'});
    //carga la fecha actual
    $('.datepicker').datepicker('setDate', new Date());

//Timepicker
	$('#save_hora_detcliente').timepicker({
		timeOnlyTitle:"Seleccione la hora",
		timeText: 'Tiempo',
		hourText: 'Hora',
	   	minuteText: 'Minuto',
	   	currentText:"Actual",
	   	closeText:"Fin"
	});

	$("#update_hora_detcliente").timepicker({
		timeOnlyTitle:"Seleccione la hora",
		timeText: 'Tiempo',
		hourText: 'Hora',
	   	minuteText: 'Minuto',
	   	currentText:"Actual",
	   	closeText:"Fin"
	});


// TableTools.DEFAULTS.aButtons = [ "copy", "csv", "xls", "pdf" ];
// TableTools.DEFAULTS.sSwfPath = "media/swf/copy_cvs_xls_pdf.swf";
//tablas

 var oTable=  $('#table-example').dataTable({
		"bServerSide": true,
//      "bProcessing": true,
        "bFilter": true,
        "bLengthChange": false,
        "bJQueryUI": true,
        "sAjaxSource": "VIEW/WBuscarCliente.php?",
        "sPaginationType": "full_numbers",
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            	"copy", "xls", "pdf"
            ]
        }
    });

 var oTable1=  $('#table-ctacte').dataTable({
		"bServerSide": true,
//      "bProcessing": true,
        "bFilter": true,
        "bLengthChange": false,
        "bJQueryUI": true,
        "iDisplayLength": 20,
        "sAjaxSource": "VIEW/WBuscarClienteCtaCte.php?",
        "sPaginationType": "full_numbers",
        "sDom": '<"H"Tfr>t<"F"ip>',
        "aaSorting": [[ 4, "desc" ]],
        "oTableTools": {
            "aButtons": [
            	"copy", "xls", "pdf"
            ]
        }
    });


//focus en la busqueda de articulos
$("#table-example_filter").children().children().focus();

/*
    var oTableTools = new TableTools( oTable, {
		"buttons": [
			"copy",
			"csv",
			"xls",
			"pdf"
//			{ "type": "print", "buttonText": "Print me!" }
		]
	});
	/*
  var oTabla=$('#table-modificar').dataTable({
        "bServerSide": true,
//        "bProcessing": true,
        "bFilter": true,
         "bLengthChange": false,
        "bJQueryUI": true,
        "sAjaxSource": "VIEW/WBuscarCliente.php?",
        "sPaginationType": "full_numbers"
//        "sDom": '<"H"Tfr>t<"F"ip>'
//        "oTableTools": {
//            "aButtons": [
//            "copy", "csv", "xls", "pdf"
//            ]
//        }
    });
*/
//     var oTableTools_2 = new TableTools( oTabla, {
//		"buttons": [
//			"copy",
//			"csv",
//			"xls",
//			"pdf",
//			{ "type": "print", "buttonText": "Print me!" }
//		]
//	} );

//       $('div.dataTables_filter input').unbind();
//    $('div.dataTables_filter input').bind('keyup', function(e) {
//        var dat=$(this).val();
//        if((dat.length>=2)||(e.keyCode == 13)){
//            oTable.fnFilter($(this).val());
//        }
//    });

//      $("#btn_Cliente_filtrar").click(function(){
//            oTable.fnFilter('');
//      });
//fin de tablas



 //VALIDATION FORM//
    var validatorNuevo = $("#frmPersona_Add").validate({
        rules: {
            save_nom_persona: {
                required: true,
                minlength: 4
            },
            save_ape_persona: {
                required: false,
                minlength: 4
            },
            save_id_ciudad:{
                required: true
            },
            save_id_sexo:{
                required: false
            },
            save_id_civil:{
                required: false
            },
            save_ruc_persona:{
                 required: false,
                minlength: 7,
                maxlength:13
            },
            save_limite_ctacte:{
                minlength: 1,
                maxlength:10,
                number: true
            },
            save_telf_persona:{
                required: false
            },
            save_telf_persona_2:{
                required: false
            },
            save_cel_persona:{
               required: false
            },
            save_email_persona:{
                required: false,
                email:true
            },
            save_direc_persona:{
              required: false,
              minlength:5
            },
            save_obs_persona:{
              required: false,
              minlength:5
            },
            save_id_trabajador:{
             required: false
            },
            save_id_tipoconex:{
              required: false
            },
            save_estado_conex:{
              required: true
            }
        },
        messages: {
            save_nom_persona: "Ingrese la razón social",
            save_ape_persona: "Ingrese el nombre de fantasía",
            save_id_ciudad:"Seleccione una ciudad",
            save_id_sexo:"Seleccione su sexo",
            save_id_civil:"Seleccione su estado civil",
            save_ruc_persona:"Ingrese el CUIT o DNI",
            save_telf_persona:"Ingrese un número de teléfono",
            save_telf_persona_2:"Ingrese un número de teléfono",
            save_cel_persona:"Ingrese un número de celular",
            save_email_persona:"Ingrese su e-mail",
            save_web_persona:"Ingrese la url",
            save_direc_persona:"Ingrese una dirección",
            save_obs_persona:"Ingrese una descripción de la ocupación",
            save_id_trabajador:"Requerido",
            save_id_tipoconex:"Requerido",
            save_estado_conex:"Requerido"
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
//                alert("todo bien");
        },
        success: function(label) {
            label.html("&nbsp;").addClass("valid_small");
        }
    });
    //validator busca
//    var validatorBuscar = $("#frmTrabajador_Buscar").validate({
//        rules: {
//            txt_Buscar_Modificar: {
//                required: true,
//                minlength: 1
//            }
//        },
//        messages: {
//            txt_Buscar_Modificar: "Ingrese mínimo un caracter"
//        },
//        errorPlacement: function(error, element) {
//             if ( element.is(":radio") )
//                error.appendTo( element.parent().prev() );
//            else if ( element.is(":checkbox") )
//                error.appendTo ( element.parent().prev() );
//            else
//                error.appendTo( element.prev() );
//        },
//        submitHandler: function() {
//            //llamo a esta función
//            resultBusquedad();
//        },
//        success: function(label) {
//            label.html("&nbsp;").addClass("valid_small");
//        }
//    });
//
    //valida el update

     var validatorUpdate = $("#frmPersona_Update").validate({
        rules: {
            update_nom_persona: {
                required: true,
                minlength: 4
            },
            update_ape_persona: {
                required: false,
                minlength: 4
            },
            update_id_ciudad:{
                required: true
            },
            update_id_sexo:{
                required: false
            },
            update_id_civil:{
                required: false
            },
            update_ruc_persona:{
                required: false,
                minlength: 7,
                maxlength:13
            },
            update_limite_ctacte:{
                required: false,
                minlength: 1,
                maxlength:10,
                number: true
            },
            update_telf_persona:{
                required: false
            },
            update_telf_persona_2:{
                required: false
            },
            update_cel_persona:{
               required: false
            },
            update_email_persona:{
                required: false,
                email:true
            },
            update_direc_persona:{
              required: false,
              minlength:1
            },
            update_obs_persona:{
              required: false,
              minlength:1
            }

        },
        messages: {
            update_nom_persona: "Ingrese la razón social",
            update_ape_persona: "Ingrese el nombre de fantasía",
            update_id_ciudad:"Seleccione una ciudad",
            update_id_civil:"Seleccione el estado civil",
            update_id_sexo:"Seleccione el sexo",
            update_ruc_persona:"Ingrese el CUIT o DNI",
            update_telf_persona:"Ingrese un número de teléfono",
            update_telf_persona_2:"Ingrese un número de teléfono",
            update_cel_persona:"Ingrese un número de celular",
            update_email_persona:"e-mail invalido",
            update_direc_persona:"Ingrese una dirección",
            update_obs_persona:"Ingrese la observacion del cliente"
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
			location.reload();
		});


		$('#btn_Detalle_imprimir').click(function (){
			var grid = "";//$("#ctacte_table").clone().html();
       		var idcli = $("#txt_id_cliente_temp").val();
        	var windowSizeArray = [ "width=200,height=200","width=800,height=600,scrollbars=yes" ];
            var url 		= "ctacte_print.php";
		    var windowName 	= "popUp";//$(this).attr("name");
		    var windowSize	= windowSizeArray;
		    var param		= "?&cliente="+idcli+"&grilla="+grid;
		    var win			= window.open(url+param, windowName, windowSize);
		});


      	//modal que actuliza
		$('#dialg_form').dialog({
			autoOpen: false,
			width: 750,
			height: 510,
			modal: true
		});

		//modal que actuliza
		$('#dialg_ctacte').dialog({
			autoOpen: false,
			width: 700,
			height: 450,
			modal: true
		});


	$('#dialg_cliente_update').dialog({
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
    // save_id_condiva   1
    // save_tiene_ctacte   1


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
                $("#frmPersona_Add.form-field").val ("");
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
//                $("#tabla_result").reload();
            }
        });
    }

    $(".clsMatrizDetalle").livequery("click", function(e){
        var idcliente=$(this).attr("id").replace("btn_update_detcliente","");
        var id_traba="";
        var frmCliente="show_id_cliente="+idcliente+"&opc=17";
          $.ajax({
            type:"POST",
            url:"CONTROLLER/C_Persona.php",
            data:frmCliente,
            dataType:'json',
            success:function(response){
                $("#txt_ver_nombres").val(response._nom_persona+' '+response._ape_persona);
                $("#txt_ver_ruc").val(response._ruc_persona);
                $("#txt_ver_telefono").val(response._telf_persona);
                $("#txt_ver_telefono_2").val(response._telf_persona_2);
                $("#txt_ver_celular").val(response._cel_persona);
                $("#txt_ver_direc").val(response._direc_persona);
                $("#txt_ver_trabajador").val(response._id_trabajador);
            }
        });
        $("#txt_ver_idcliente").val(idcliente);
        $('#dialg_cliente_update').dialog('open');
    });


    $("#btn_ver_update").click(function(){
        var frm_up=$("#form_detalle_cliente").serialize();
        frm_up=frm_up+"&opc=16";
          $.ajax({
            type:"POST",
            url:"CONTROLLER/C_Persona.php",
            data:frm_up,
            success:function(response){
                $('#dialg_cliente_update').dialog('close');
                 $('#dialg_msg').dialog('open');
               $("#msg").text("Los datos se han guardado correctamente.");

            }
        });
    });

    $("#btn_ver_cancel").click(function(){
         $('#dialg_cliente_update').dialog('close');
    });

     //cargo formulario modal con sus valores
     $(".clsMatrizModificar").livequery("click", function(e){
         var idper=$(this).attr("id").replace("btn_update","");//id de la persona
         var frmPersona="opc=18&show_id_cliente="+idper;
          $.ajax({
            type:"POST",
            url:"CONTROLLER/C_Persona.php",
            data:frmPersona,
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
                $("#update_telf_persona_2").val(response._telf_persona_2);
                $("#update_cel_persona").val(response._cel_persona);
                $("#update_email_persona").val(response._email_persona);
                $("#update_direc_persona").val(response._direc_persona);

                $("#update_id_condiva").val(response._id_condiva);
                $("#update_tiene_ctacte").val(response._tiene_ctacte);
                $("#update_limite_ctacte").val(response._limite_ctacte);

                $("#update_id_listaprecio").val(response._id_listaprecio);

                $("#update_obs_persona").val(response._obs_persona);

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

    $(".clsMatrizCtacte").livequery("click", function(e){
 		var idper		= $(this).attr("id").replace("btn_ctacte","");//id de la persona
 		var frmPersona	= "opc=27&id_cliente="+idper;
 		$("#txt_id_cliente_temp").val(idper);
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


 	$("#btn_Detalle_cerrar").click(function(){
		 $('#dialg_ctacte').dialog('close');
	});


    $(".clsMatrizEliminar").livequery("click", function(e){
         var id=$(this).attr("id").replace("btn_delete","");
        var frmtrabajador="delete_id_persona="+id+"&opc=3";
        $.ajax({
            type:"POST",
            url:"CONTROLLER/C_Persona.php",
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



//    function resultBusquedad(){
//        var ape_cliente2=$("#txt_Buscar_Modificar").val();
//        var frmtrabajador="opc=10&ape_cliente="+ape_cliente2;
//        $.ajax({
//            type:"POST",
//            url:"CONTROLLER/C_Persona.php",
//            data:frmtrabajador,
//            success:function(response){
//                $("#tabla_result").html($(response).fadeIn('slow'));
//            }
//        });
//    }

    function resultBusquedad_Delete(){
        var ape_cliente=$("#txt_Buscar_Delete").val();
        var frmtrabajador="opc=11&ape_cliente_delete="+ape_cliente;
        $.ajax({
            type:"POST",
            url:"CONTROLLER/C_Persona.php",
            data:frmtrabajador,
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
