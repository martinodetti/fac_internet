$(document).ready(function(){

// $.validator.addMethod('IP4Checker', function(value) {
// var ip = "^(25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[0-9]{2}"+
//             "|[0-9])(\.(25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[0-9]{2}|[0-9])){3}$";
//    return value.match(ip);
//            }, 'IP invalida');
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
                 required: false,
                minlength: 11,
                maxlength:11,
                number:true
            },
            save_limite_persona:{
                minlength: 1,
                maxlength:10,
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
            save_nom_persona: "Ingrese el nombre",
            save_ape_persona: "Ingrese el apellido",
            save_id_ciudad:"Seleccione una ciudad",
            save_id_sexo:"Seleccione su sexo",
            save_id_civil:"Seleccione su estado civil",
            save_ruc_persona:"Ingrese su cédula o CUIT",
            save_telf_persona:"Ingrese un número de teléfono",
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
            update_limite_persona:{
                minlength: 1,
                maxlength:10,
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
			location.reload();
		});
      //modal que actuliza
		$('#dialg_form').dialog({
			autoOpen: false,
			width: 850,
			height: 500,
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

    $("#btn_Cliente_filtrar").click(function(){
        var fec=$("#fecha_cliente_buscar").val();
        var data_cli="fecha="+fec+"&opc=15";
         $.ajax({
            type:"POST",
            url:"CONTROLLER/C_Persona.php",
            data:data_cli,
            success:function(response){
                $("#div_cliente_pendiente").html($(response).fadeIn('slow'));
            }
        });
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

    $(".clsMatrizDetalle").livequery("click", function(e){
         var idcliente=$(this).attr("id").replace("btn_update_detcliente","");
        var nombres=$("#id_detcli_nombres_"+idcliente).val();
        var det_ruc=$("#id_detcli_ruc_"+idcliente).val();
        var det_tel=$("#id_detcli_tel_"+idcliente).val();
        var det_cel=$("#id_detcli_cel_"+idcliente).val();
        var det_direc=$("#id_detcli_direc_"+idcliente).val();
        var det_trabajador=$("#id_detcli_trabajador_"+idcliente).val();
        $("#txt_ver_idcliente").val(idcliente);

        $("#txt_ver_nombres").val(nombres);
        $("#txt_ver_ruc").val(det_ruc);
        $("#txt_ver_telefono").val(det_tel);
        $("#txt_ver_celular").val(det_cel);
        $("#txt_ver_direc").val(det_direc);
        $("#txt_ver_trabajador").val(det_trabajador);
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
         var idper=$(this).attr("id").replace("btn_update","");
         var tipoper=$("#id_tipoper_"+idper).val();
         var id_ciudad=$("#ciudad_"+idper).val();
         var id_sexo=$("#sexo_"+idper).val();
         var id_civil=$("#civil_"+idper).val();

         var nom=$("#nom_"+idper).val();
         var ape=$("#ape_"+idper).val();

         var ruc=$("#ruc_"+idper).val();
         var tel=$("#tel_"+idper).val();
         var cel=$("#cel_"+idper).val();

         var email=$("#email_"+idper).val();
         var direc=$("#direc_"+idper).val();

         //detalle de cliente
         var update_iddetcliente=$("#detcli_idcli_"+idper).val();
         var update_id_traba=$("#detcli_traba_"+idper).val();
         var update_tipo_con=$("#detcli_tipoconex_"+idper).val();
         var update_ip=$("#detcli_ip_"+idper).val();
         var update_hora=$("#detcli_hora_"+idper).val();
         var update_fecha=$("#detcli_fecha_"+idper).val();
         var update_estado=$("#detcli_estado_"+idper).val();
         $("#update_id_detcliente").val(update_iddetcliente);
         $("#update_id_trabajador").val(update_id_traba);
         $("#update_id_tipoconex").val(update_tipo_con);
         $("#update_fecha_detcliente").val(update_fecha);
         $("#update_hora_detcliente").val(update_hora);
         $("#update_ip_detcliente").val(update_ip);
         $("#update_estado_conex").val(update_estado);
         //fin detalle cliente

//         var obs=$("#obs_"+idper).val();


         $("#update_id_persona").val(idper);
         $("#update_id_tipoper").val(tipoper);
         $("#update_nom_persona").val(nom);
         $("#update_ape_persona").val(ape);

         $("#update_id_sexo").val(id_sexo);
         $('#update_id_ciudad').val(id_ciudad);
         $('#update_id_civil').val(id_civil);

          $("#update_ruc_persona").val(ruc);
          $("#update_telf_persona").val(tel);
          $("#update_cel_persona").val(cel);
          $("#update_email_persona").val(email);
          $("#update_direc_persona").val(direc);
//          $("#update_obs_persona").val(obs);


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
        var ape_cliente2=$("#txt_Buscar_Modificar").val();
        var frmtrabajador="opc=10&ape_cliente="+ape_cliente2;
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




});
