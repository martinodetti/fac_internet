$(document).ready(function(){
 var cont=0;
 var dat=[];//modelo del grid
 var total_iva=0;
 var dat_vozcliente=[];

 //$('#div_cliente').hide();

 $("#div_deleteVehiculo").hide();
 $("#btn_Presupuesto_Generar").hide();
 $("#btn_Presupuesto_Generar_2").hide();
 $("#btn_Presupuesto_Open").hide();
 $("#btn_Presupuesto_Accepts").hide();


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
        "sAjaxSource": "VIEW/WBuscarPresupuesto.php?",
        "aaSorting": [[ 0, "desc" ]], // para ordenarlos por default
        "sPaginationType": "full_numbers",
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "xls", "pdf"
            ]
        },
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		if(aData[5] == "Pendiente"){
                	nRow.className = "abierto";
                }

                return nRow;
       	}
    });


	$.ajax({
		type:"POST",
		url:"CONTROLLER/C_Presupuesto.php?opc=12",
		success:function(response){
			if(response > 1){
				$("#txt_num_presupuesto").val(response);
			}else{
				$("#txt_num_presupuesto").val('1');
			}
		}
	});


	$('#tt').datagrid('reloadFooter',[  //inicio foter del datagrid
	    {cantidad:"SubTotal : ",total: 0},
		{cantidad:"Dto : ",total: 0},
	    {cantidad:"Total : ",total: 0}
	]);

    $(".datepicker").datepicker();
    $('.datepicker').datepicker('option', {dateFormat: 'dd-mm-yy'});
    $("#save_fecemi_presupuesto").datepicker('setDate', new Date());


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

    //DIALOG//
	$('#dialg_msg').dialog({
		autoOpen: false,
		width: 460,
		height: 140,
		modal: true
	});

	$('#error_msg').dialog({
		autoOpen: false,
		width: 460,
		height: 140,
		modal: true
	});

	$('#dialg_form').dialog({
		autoOpen: false,
		width: 750,
		height: 300,
		modal: true
	});

	$('#edit_form').dialog({
		autoOpen: false,
		width: 750,
		heigth: 400,
		modal: true
	});

	$("#btn_Detalle_cerrar").click(function(){
		 $('#dialg_form').dialog('close');
	});

	//TODOO LO QUE TIENE QUE VER CON LA MANO DE OBRA

	$('#dialg_manoobra').dialog({
		autoOpen: false,
		width: 430,
		height: 270,
		modal: true
	});

	$('#dialg_manoobra2').dialog({
		autoOpen: false,
		width: 430,
		height: 270,
		modal: true
	});

	$('#dialg_torneria').dialog({
		autoOpen: false,
		width: 430,
		height: 270,
		modal: true
	});

	$('#dialg_open').dialog({
		autoOpen: false,
		width: 330,
		height: 120,
		modal: true
	});

	//elegir la voz de cliente
	$('#dialg_vozcliente').dialog({
		autoOpen: false,
		width: 670,
		height: 400,
		modal: true
	});

	//ver detalle de voz de cliente
	$('#dialg_vervozcliente').dialog({
		autoOpen: false,
		width: 530,
		height: 360,
		modal: true
	});


	//cerrar ventana de mano de obra
	$("#dialg_manoobra_close").click(function(){
		$('#dialg_manoobra').dialog('close');
	});

	$("#dialg_manoobra_close2").click(function(){
		$('#dialg_manoobra2').dialog('close');
	});

	$("#dialg_torneria_close").click(function(){
		$('#dialg_torneria').dialog('close');
	});

	//cerrar ventana de abrir presupuesto
	$("#dialg_open_close").click(function(){
		$("#dialg_open").dialog('close');
	});

	//abrir ventana de mano de obra
	$("#btn_manoobra").click(function(){
		$("#dialg_manoobra").dialog('open');
	});

	//abrir ventana de mano de obra
	$("#btn_manoobra2").click(function(){
		$("#dialg_manoobra2").dialog('open');
	});

	$("#btn_torneria").click(function(){
		$("#dialg_torneria").dialog('open');
	});

	//cerrar ventana de vozcliente
	$("#dialg_vozcliente_close").click(function(){
		$('#dialg_vozcliente').dialog('close');

	});

	//cerrar cuadro de dialog mensaje
	$('#dial_msg_close').click(function() {
		$('#dialg_msg').dialog('close');
		location.reload();
	});

	// cerrar mensaje de error
	$("#error_msg_close").click(function(){
		$('#error_msg').dialog('close');
	});



// actualiza la informacion de la grilla
	function reloadData(){
        var datainfo = {
            "total":0,
            "rows":dat
        };
        $('#tt').datagrid('loadData', datainfo);
    }

// Agregar un producto a la grilla
	function Add(){
       if(verificarDat()){
            cont++;
            var idprod	= $("#txt_idproducto").val();
            var prod	= $("#txt_nom_producto").val();
            var precio	= $("#txt_precio").val();
			var codprod	= $("#txt_cod_producto").val();
            var canti	= $("#txt_cantidad").val();
            var subt	= $("#txt_sub").val();

            precio		= parseFloat(precio).toFixed(2);
            canti		= parseInt(canti);
            subt		= (parseFloat(subt)).toFixed(2);

            var tmp_row={
                id:idprod,
                codigo:codprod,
                producto:prod,
                precio:precio,
                cantidad:canti,
                total:subt
            };

			if(dat.length >= 35){
				$('#error_msg').dialog('open');
				$("#msg_err").text("La orden de reparación permite un máximo de 35 items");
			}else{
				dat.push(tmp_row);
				reloadData();
				sumatoria();
			}
       }
    }

// limpia los campos
	function vaciarVector(){
		dat=[];
		cont=0;
		reloadData();
		sumatoria();
		$("#cmbDescto").val(0);
	}

	function sumatoria(){//total de footer
        var tl=$("#tt").datagrid('getRows');
		var descto=$("#cmbDescto").val();
        var lng=tl.length;
        var sum=0;
		var valor_sin_desc = 0;

        for(var t=0;t<lng;t++){
            valor_real = tl[t]['total'] - ( (tl[t]['total'] * descto) / 100);
			valor_sin_desc = valor_sin_desc + parseFloat(tl[t]['total']);
            sum=sum + parseFloat(valor_real);
        }
        $("#txt_temporal").val(sum.toFixed(2));

		var tdsct=(descto*valor_sin_desc)/100;

        if(isNaN(tdsct))
        	tdsct = 0;

//        iva=iva.toFixed(2);
        var toto=sum;
        toto=toto;
        toto=toto.toFixed(2);

        $('#tt').datagrid('reloadFooter',[
           {cantidad:"SubTotal : ",total: sum.toFixed(2)},
		   {descuento:"Dto: ",total: tdsct.toFixed(2)},
           {cantidad:"Total : ",total: toto}
        ]);

        $("#save_total_presupuesto").val(toto);
		$("#save_descto_fact").val(tdsct.toFixed(2));

    }


// Verifica si el producto ya esta en la grilla
	function verificarDat(){//tomo el id del producto
        var row =$('#cmbgridProducto').combogrid('grid').datagrid('getSelected');
        var lon=dat.length;
        var aux=0;
        for(var tk=0;tk<lon;tk++){
            if(dat[tk].id==row.id_producto){
                aux++;
            break;
            }
        }
        if(aux>0)return false;
        else return true;
    }

// eliminar un producto de la grilla
	function Delete(){
        var row = $('#tt').datagrid('getSelected');
        var index= dat.indexOf(row); // Find the index
       	if(index!=-1)
       		dat.splice(index,1); // Remove it if really found!
       	if(row.id == 0){
       		$("#txt_importe_manoobra").val("");
			$("#txt_descripcion_manoobra").val("");
			$("#importe_manoobra").val("");
			$("#descripcion_manoobra").val("");
		}
		if(row.id == -2){
       		$("#txt_importe_manoobra2").val("");
			$("#txt_descripcion_manoobra2").val("");
			$("#importe_manoobra2").val("");
			$("#descripcion_manoobra2").val("");
		}
		if(row.id == -1){
			$("#txt_importe_torneria").val("");
			$("#txt_descripcion_torneria").val("");
			$("#importe_torneria").val("");
			$("#descripcion_torneria").val("");
		}


        reloadData();
        sumatoria();
    }


//	$("#label_cliente_vehiculo").hide();

	$('#cmbgridCliente').combogrid({
		panelWidth: 500,
		url: 'CONTROLLER/C_Persona.php?opc=23',
		idField:'id_cliente',
		textField:'dominio',
		mode:'remote',
		fitColumns:true,
		columns:[[
			{field:'id_cliente',title:'',width:0, hidden:true},
			{field:'id_vehiculo',title:'',width:0, hidden:true},
			{field:'cliente',title:'Cliente',align:'right',width:200},
			{field:'dominio',title:'Patente',align:'right',width:70},
			{field:'vehiculo',title:'Vehiculo',align:'right',width:200},
			{field:'obs_vehi', title:'',hidden:true},
			{field:'porcentaje', title:'', hidden:true}

		]],
		onSelect:function(rowData){
			var row =$('#cmbgridCliente').combogrid('grid').datagrid('getSelected');

			row = eliminaNull(row);

			obsplus = $("#save_obs_presupuesto").val() + ' - ' + row.obs_vehi;

			if(row.id_cliente == '0'){
				$("#dialg_nuevoCliente").dialog('open');
			}else{

				$("#label_cliente_vehiculo").show();
				$("#save_id_cliente").val(row.id_cliente);
				$("#save_id_vehiculo").val(row.id_vehiculo);
				$("#txt_cliente").val(row.cliente);
				$("#txt_vehiculo").val(row.vehiculo + ' ('+row.dominio+')');
				$("#save_patente").val(row.dominio);
				$("#txt_obs_vehiculo").val(row.obs_vehi);
				$("#save_obs_presupuesto").val(obsplus);
				$("#div_deleteVehiculo").hide();
				$("#txt_porcentaje").val(row.porcentaje);
				if(row.id_vehiculo > 0) {
					$("#div_deleteVehiculo").show();
				}else{
					$("#txt_vehiculo").val("");
					$("#div_deleteVehiculo").hide();
				}

				if($("#save_obs_presupuesto").val() == ' - '){
					$("#save_obs_presupuesto").val("");
				}
			}
		}
    });

    $("#btn_deleteVehiculo").click(function(){
    	$("#save_id_vehiculo").val("");
    	$("#txt_vehiculo").val("");
    	$("#div_deleteVehiculo").hide();
    });


	$('#cmbgridProducto').combogrid({
		panelWidth:800,
		url: 'CONTROLLER/C_Factura.php?opc=6',
		idField:'id_producto',
		textField:'descrip_producto',
		mode:'remote',
		fitColumns:true,
		columns:[[
		   {field:'id_producto',title:'Id',width:20},
		   {field:'nom_producto',title:'Producto',align:'right',width:150},
		   {field:'descrip_producto',title:'Descripción',align:'right',width:500},
		   {field:'pvp1_producto',title:'Precio',align:'right',width:60},
		   {field:'stock_producto',title:'Stock',align:'right',width:60}
//		   {field:'id_tipoiva', title: 'IVA', align:'right', width:60}
		]],
		onSelect:function(rowData){
			var row =$('#cmbgridProducto').combogrid('grid').datagrid('getSelected');
			var porctj = 0;
			var nuevo_porctj = parseFloat($("#txt_porcentaje").val());
			if(nuevo_porctj > 0 || nuevo_porctj < 0){ //si es superior a 0 lo cambio sino dejo el 0%
				porctj = nuevo_porctj;
			}
			var precio_original = parseFloat(row.pvp1_producto);
			var precio_con_porcentaje = Math.round(parseFloat(precio_original+(precio_original*porctj/100)).toFixed(2));

			$("#txt_idproducto").val(row.id_producto);
			$("#txt_nom_producto").val(row.descrip_producto);
			$("#txt_cod_producto").val(row.nom_producto);
//			$("#txt_tipoiva").val(row.id_tipoiva);
			var tot=precio_con_porcentaje*1;
			$("#txt_precio").val(precio_con_porcentaje);
			$("#txt_cantidad").val(1);
			$("#txt_sub").val(tot);
		}
	});

	$("#cmbgridProducto").next().find('input').click(function(){
		$("#cmbgridProducto").combobox('clear');
	});

	$("#txt_cantidad").keyup(function(){
		var v1= $("#txt_precio").val();
		var v2= $("#txt_cantidad").val();
		var v3=v1*v2;
		$("#txt_sub").val(v3.toFixed(2));
	});


	$("#cmbDescto").change(function(){
	var numero = $("#cmbDescto").val();
		if (!/^([0-9.])*$/.test(numero)){
				alert("El valor " + numero + " no es un número");
			$("#cmbDescto").val(0);
		}else{
				sumatoria();
		}
    });

//validator

	var validator_addproducto = $("#frm_AddProducto").validate({
        rules: {
            txt_precio: {
                required: false,
                number: true
            },
            txt_cantidad: {
                required: true,
		number: true
//                digits: true
            },
            txt_sub: {
                required: false,
                number: true
            }
        },
        messages: {
            txt_precio: "Requerido",
            txt_cantidad:"Sólo números",
            txt_sub:"Requerido"
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
            Add();
        },
        success: function(label) {
            label.html("&nbsp;").addClass("valid_small");
        }
    });


	var validator_addPresupuesto = $("#frm_presupuesto").validate({
        rules: {
            save_obs_presupuesto: {
                required: false,
            	minlength:1
            },
            txt_num_presupuesto: {
               	required: false,
               	number:true
            }
        },
        messages: {
        	save_obs_presupuesto: "No Requerido",
            txt_num_presupuesto:"Requerido"

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
            Presupuesto_Add();
        },
        success: function(label) {
            label.html("&nbsp;").addClass("valid_small");
        }
    });


    $("#btn_AddProducto").click(function(){
        $("#frm_AddProducto").submit();
    });
    $("#btn_QuitarProducto").click(function(){
		Delete();
    });
    $("#btn_Presupuesto_New").click(function(){
      	vaciarVector();

	   	id = $("#txt_num_presupuesto").val();
	   	$("#frm_presupuesto .form-field").val ("");
	   	vaciarCampos();
	   	$("#txt_num_presupuesto").val(id);
	   	$("#save_fecemi_presupuesto").datepicker('setDate', new Date());
	   	$("#save_fecingreso_presupuesto").datepicker('setDate', new Date());
	   	$("#tipo_submit").val('nuevo');

	   	document.forms["frm_presupuesto"].reset();

	   	$("#btn_Presupuesto_Close").show();
		$("#btn_Presupuesto_Add").show();
        $("#btn_Presupuesto_Accepts").hide();
		$("#btn_Presupuesto_Generar").hide();
		$("#btn_Presupuesto_Generar_2").hide();
		$("#btn_Presupuesto_Rechazar").show();
		$("#btn_Presupuesto_Open").hide();

		$("#lbl_tiene_voz_cliente").hide();

		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Presupuesto.php?opc=12",
			success:function(response){
				if(response > 1){
					$("#txt_num_presupuesto").val(response);
				}else{
					$("#txt_num_presupuesto").val('1');
				}
			}
		});
    });

	function vaciarCampos(){
		$('#cmbgridEmpleado').combogrid('clear');
		$('#cmbgridProducto').combogrid('clear');
		$('#cmbgridVehiculo').combogrid('clear');
		$('#cmbgridCliente').combogrid('clear');
		$('#div_cliente').hide();
		$('#save_id_cliente').val('');
		$('#save_id_vehiculo').val('');
		$('#save_id_vendedor').val('');
		$("#detalle_vozcliente").val('');
	   	$("#contacto_vozcliente").val('');
	   	$("#save_id_vozcliente").val('');

	   	$("#txt_detalle_vozcliente").val('');
	   	$("#txt_contacto_vozcliente").val('');

	   	$("#txt_importe_manoobra").val('');
	   	$("#txt_descripcion_manoobra").val('');

	   	$("#txt_importe_manoobra2").val('');
	   	$("#txt_descripcion_manoobra2").val('');

	   	$("#txt_importe_torneria").val('');
	   	$("#txt_descripcion_torneria").val('');

	   	$("#importe_manoobra").val('');
	   	$("#descripcion_manoobra").val('');

	   	$("#importe_manoobra2").val('');
	   	$("#descripcion_manoobra2").val('');

	   	$("#importe_torneria").val('');
	   	$("#descripcion_torneria").val('');

	}

    //Nota: Agregar un tiempo adicional, al recibir el return del response.1s es sugerido.
    //Documentación:Nombres que debe tener las cajas de texto para Guardar.
    // save_id_fact  0
    // save_id_empresa  1
    // save_id_cliente  1
    // save_id_vendedor 1
    // save_descto_fact 1
    // save_obs_fact    1
    // iva12_fact       1
    // total_fact       1
    // save_fecemi_fact 0
    // save_estado_fact 0

    function Presupuesto_Add(){

		validador= validarCombos();
		var opc = '2'; //Esto es para actualizar una presupuesto ya creada
		if(validador == 'C'){

			if($("#tipo_submit").val() =='nuevo') {
				opc = '1'; //Esto es para crear una presupuesto de trabajo nuevo
			}

			var frmPresupuesto=$("#frm_presupuesto").serialize();
			$.ajax({
				type:"POST",
				url:"CONTROLLER/C_Presupuesto.php?opc="+opc+"&"+frmPresupuesto,
				data:({Detalle:dat}),
				dataType:'json',
				success:function(response){
					$('#dialg_msg').dialog('open');
					$("#msg").text(response.txt);

					//Vaciamos todo para que un nuevo remito
					vaciarVector();
					$("#frm_presupuesto .form-field").val ("");
					vaciarCampos();
				}
			});
		}else{
			$('#error_msg').dialog('open');
			$("#msg_err").text("Debe completar los campos: " + validador);
		}
    }

	function validarCombos(){
		return 'C'; //Por ahora no vamos a validar los combos. Esto lo hago mas adelante.
		str = '';
		separador = '';
		if($('#save_id_vendedor').val() == ''){
			str = str + 'Empleado';
			separador = ', ';
		}
		if($('#save_id_vehiculo').val() == ''){
			str = str + separador + 'Vehiculo';
			separador = ', ';
		}
		if($('#save_id_cliente').val() == ''){
			str = str + separador + 'Cliente';
		}
		if(str == ''){
			return 'C';
		}else{
			return str;
		}
	}

    $("#btn_Presupuesto_Add").click(function(){
	    $("#tipo_guardar").val('abierto');
    	$("#frm_presupuesto").submit();
    });

    $("#btn_Presupuesto_Accepts").click(function(){
	    $("#tipo_guardar").val('aceptado');
    	$("#frm_presupuesto").submit();
    });

    $("#btn_Presupuesto_Generar").click(function(){
    	$("#tipo_guardar").val('generar');
    	$("#frm_presupuesto").submit();
    });


    $("#btn_Presupuesto_Generar_2").click(function(){
    	$("#tipo_guardar").val('generar_2');
    	$("#frm_presupuesto").submit();
    });

    $("#btn_Presupuesto_Close").click(function(){
    	$("#tipo_guardar").val('vencido');
    	$("#frm_presupuesto").submit();
    });

    $("#btn_Presupuesto_Rechazar").click(function(){
    	$("#tipo_guardar").val('rechazado');
    	$("#frm_presupuesto").submit();
    });

    $("#btn_Presupuesto_Open").click(function(){
    	$("#clave_usuario").val("");
    	$('#dialg_open').dialog('open');
    });

    $("#btn_Presupuesto_Print").click(function(){

        var fo=getStringParsedToPrint();
        var windowSizeArray = [ "width=200,height=200","width=800,height=600,scrollbars=yes" ];

        var numero	= $("#txt_num_presupuesto").val();
        var fecemi	= $("#save_fecemi_presupuesto").val();
        var fecing	= $("#save_fecingreso_presupuesto").val();
        var fecegr	= $("#save_fecegreso_presupuesto").val();
        var vehiid	= $("#save_id_vehiculo").val();
        var cliid	= $("#save_id_cliente").val();
        var obs		= $("#save_obs_presupuesto").val();
        var to		= $("#save_total_presupuesto").val();
        var kms		= $('#save_kms_presupuesto').val();
        var descto 	= $('#save_descto_fact').val();
        var voz		= "VOZ CLIENTE: " + $("#detalle_vozcliente").val() + ". CONTACTO: " + $("#contacto_vozcliente").val();

        var url 		= "presupuesto_pdf.php";
        var windowName 	= "popUp";//$(this).attr("name");
        var windowSize 	= windowSizeArray;
        var param		= "?mostrar_precios=1&id_cliente="+cliid+"&detalle="+fo+"&numero="+numero+"&fecemi="+fecemi+"&fecing="+fecing+"&fecegr="+fecegr+"&idvehiculo="+vehiid+"&obs="+obs+"&total="+to+"&voz="+voz+"&kms="+kms+"&descto="+descto;
        var win			= window.open(url+param, windowName, windowSize);

    });

    $("#btn_Presupuesto_Pdf").click(function(){

        var fo=getStringParsedToPrint();
        var windowSizeArray = [ "width=200,height=200","width=800,height=600,scrollbars=yes" ];

        var numero	= $("#txt_num_presupuesto").val();
        var fecemi	= $("#save_fecemi_presupuesto").val();
        var fecing	= $("#save_fecingreso_presupuesto").val();
        var fecegr	= $("#save_fecegreso_presupuesto").val();
        var vehiid	= $("#save_id_vehiculo").val();
        var cliid	= $("#save_id_cliente").val();
        var obs		= $("#save_obs_presupuesto").val();
        var to		= $("#save_total_presupuesto").val();
        var descto 	= $('#save_descto_fact').val();
        var voz		= "<br>VOZ CLIENTE: <b>" + $("#detalle_vozcliente").val() + "</b>. CONTACTO: <b>" + $("#contacto_vozcliente").val();

        var url 		= "presupuesto_pdf.php?";
        var windowName 	= "popUp";//$(this).attr("name");
        var windowSize 	= windowSizeArray;
        var param		= "mostrar_precios=1&id_cliente="+cliid+"&detalle="+fo+"&numero="+numero+"&fecemi="+fecemi+"&fecing="+fecing+"&fecegr="+fecegr+"&idvehiculo="+vehiid+"&obs="+obs+"&total="+to+"&voz="+voz+"&descto="+descto;

		var win			= window.open(url+param, windowName, windowSize);

    });

/*
    $("#btn_vozcliente_Print").click(function(){
    	var patente = $("#patente_vozcliente").val();
    	var detalle	= $("#detalle_vozcliente").val();
    	var contacto= $("#contacto_vozcliente").val();


    	var windowSizeArray = [ "width=200,height=200","width=800,height=600,scrollbars=yes" ];
    	var url		= "vozcliente_print.php";
    	var windowName 	= "popUp";//$(this).attr("name");
        var windowSize 	= windowSizeArray;
        var param		= "?&patente="+patente+"&detalle="+detalle+"&contacto="+contacto;
        var win			= window.open(url+param, windowName, windowSize);
    });
*/

	function getStringParsedToPrint(){
		var lon=dat.length;
		var cade="";
        var aux=0;
        for(var tk=0;tk<lon;tk++){

        	//Essto lo hago solo para poder imprimir la mano de obra completa
        	var producto = dat[tk].producto;
        	if(dat[tk].id == '0')
        		var producto = $("#txt_descripcion_manoobra").val();
        	if(dat[tk].id == '-1')
        		var producto = $("#txt_descripcion_torneria").val();
        	if(dat[tk].id == '-2')
        		var producto = $("#txt_descripcion_manoobra2").val();

			cade=cade+dat[tk].id+"|"+producto+"|"+dat[tk].precio+"|"+dat[tk].cantidad+"|"+dat[tk].total+"|"+dat[tk].codigo+"~";
        }
        cade=cade.toString().substr(0, cade.length-1);
        return cade;
	}

	//Con este vamos a modificar una presupuesto de reparacion
	$(".clsMatrizVer").livequery("click", function(e){
		vaciarCampos();
		vaciarVector();
		$(".tag").remove();
		var idpresupuesto=$(this).attr("id").replace("btn_detalle","");

            var frmpresupuesto="id_presupuesto="+idpresupuesto+"&opc=13";
            $.ajax({
                type:"POST",
                url:"CONTROLLER/C_Presupuesto.php",
                data:frmpresupuesto,
                dataType:'json',
                success:function(response){

					response = eliminaNull(response);
					$("#tipo_submit").val("update");
					$("#txt_num_presupuesto").val(response.id_presupuesto);
					$("#save_fecemi_presupuesto").val(response.fecha_emi);
					$("#save_id_vozcliente").val(response.id_vozcliente);
					$("#txt_cliente").val(response.nom_cliente + '-' + response.ape_cliente);
					$("#txt_vehiculo").val(response.marca + ' ' + response.modelo + ' (' + response.dominio + ')');
					$("#save_obs_presupuesto").val(response.observacion);
					$("#save_id_vehiculo").val(response.id_vehiculo);
					$("#save_id_cliente").val(response.id_cliente);
					$("#txt_importe_manoobra").val(response.importe_MO);
					$("#txt_descripcion_manoobra").val(response.descripcion_MO);
					$("#importe_manoobra").val(response.importe_MO);
					$("#descripcion_manoobra").val(response.descripcion_MO);
					$("#txt_importe_manoobra2").val(response.importe_MO2);
					$("#txt_descripcion_manoobra2").val(response.descripcion_MO2);
					$("#importe_manoobra2").val(response.importe_MO2);
					$("#descripcion_manoobra2").val(response.descripcion_MO2);
					$("#txt_importe_torneria").val(response.importe_TO);
					$("#txt_descripcion_torneria").val(response.descripcion_TO);
					$("#importe_torneria").val(response.importe_TO);
					$("#descripcion_torneria").val(response.descripcion_TO);
					$("#txt_detalle_vozcliente").val(response.descrip_vc);
					$("#detalle_vozcliente").val(response.descrip_vc);
					$("#txt_contacto_vozcliente").val(response.contacto_vc);
					$("#contacto_vozcliente").val(response.contacto_vc);
					$("#txt_porcentaje").val(response.porcentaje);
					$("#save_kms_presupuesto").val(response.kms_presupuesto);
		  			$("#txt_estado_presupuesto").val(response.estado);
					var descto_val = parseFloat((parseFloat(response.descto_presupuesto)*100)/(parseFloat(response.descto_presupuesto)+parseFloat(response.total)));
					if(isNaN(descto_val)){
						descto_val = 0;
					}
					$("#cmbDescto").val(descto_val);

					if(response.contacto_vc != '' || response.descrip_vc != '')
						$('#lbl_tiene_voz_cliente').show();
					else
						$('#lbl_tiene_voz_cliente').hide();

					var porctj = 0;
					var porctj_mo = 0;
					var nuevo_porctj = parseFloat($("#txt_porcentaje").val());
					if((nuevo_porctj > 0 || nuevo_porctj < 0) && response.estado == "Pendiente")
						porctj = nuevo_porctj;
					if(nuevo_porctj > 0 || nuevo_porctj < 0)
						porctj_mo = nuevo_porctj;


					$.each(response.detalle, function(i, item) {

						if(item._id_producto == 0){
							var precio=parseFloat(item._precio_detpresupuesto);
							var nuevo_precio = precio + (precio*porctj_mo/100);
							var nuevo_precio = Math.round(nuevo_precio);
						}else{
							var precio=parseFloat(item._precio_detpresupuesto);
							var nuevo_precio = precio + (precio*porctj/100);
							var nuevo_precio = Math.round(nuevo_precio);
						}

                        canti=parseInt(item._canti_detpresupuesto);
                        subt=parseFloat(canti*nuevo_precio).toFixed(2);
                        var tmp_row={
                            id:item._id_producto,
                            codigo:item._nom_producto,
                            producto:item._descrip_producto,
                            precio:nuevo_precio,
                            cantidad:canti,
                            total:subt
                        };
                        dat.push(tmp_row);

/*
						precio=parseFloat(item._precio_detpresupuesto).toFixed(2);
						var nuevo_precio = precio;
						canti=parseInt(item._canti_detpresupuesto);
						subt=parseFloat(canti*nuevo_precio).toFixed(2);
						var tmp_row={
							id:item._id_producto,
							codigo:item._nom_producto,
							producto:item._descrip_producto,
							precio:nuevo_precio,
							cantidad:canti,
							total:subt
						};
						dat.push(tmp_row);
*/
    				});

					//buscar voz cliente
					if(response.id_vozcliente > 0)
						buscarvozcliente(response.id_vozcliente);

					$(".tabs").tabs('select','#tabs-1');
					reloadData();
    				sumatoria();

    				$("#btn_Presupuesto_Close").hide();
    				$("#btn_Presupuesto_Rechazar").hide();
    				$("#btn_Presupuesto_Add").hide();
                    $("#btn_Presupuesto_Accepts").hide();
    				$("#btn_Presupuesto_Generar").hide();
    				$("#btn_Presupuesto_Generar_2").hide();
    				if(response.estado == "Pendiente")
    					$("#btn_Presupuesto_Open").hide();
    				else
	    				$("#btn_Presupuesto_Open").show();
                }
		});

	});



	//Con este vamos a modificar una presupuesto de reparacion
	$(".clsMatrizModificar").livequery("click", function(e){
		vaciarCampos();
		vaciarVector();
		$(".tag").remove();
		var idpresupuesto=$(this).attr("id").replace("btn_editar","");

            var frmpresupuesto="id_presupuesto="+idpresupuesto+"&opc=13";
            $.ajax({
                type:"POST",
                url:"CONTROLLER/C_Presupuesto.php",
                data:frmpresupuesto,
                dataType:'json',
                success:function(response){
					response = eliminaNull(response);
					$("#tipo_submit").val("update");
					$("#txt_num_presupuesto").val(response.id_presupuesto);
					$("#save_fecemi_presupuesto").val(response.fecha_emi);
					$("#save_id_vozcliente").val(response.id_vozcliente);
					$("#txt_cliente").val(response.nom_cliente + '-' + response.ape_cliente);
					$("#txt_vehiculo").val(response.marca + ' ' + response.modelo + ' (' + response.dominio + ')');
					$("#save_obs_presupuesto").val(response.observacion);
					$("#save_id_vehiculo").val(response.id_vehiculo);
					$("#save_id_cliente").val(response.id_cliente);
					$("#txt_importe_manoobra").val(response.importe_MO);
					$("#txt_descripcion_manoobra").val(response.descripcion_MO);
					$("#importe_manoobra").val(response.importe_MO);
					$("#descripcion_manoobra").val(response.descripcion_MO);
					$("#txt_importe_manoobra2").val(response.importe_MO2);
					$("#txt_descripcion_manoobra2").val(response.descripcion_MO2);
					$("#importe_manoobra2").val(response.importe_MO2);
					$("#descripcion_manoobra2").val(response.descripcion_MO2);
					$("#txt_importe_torneria").val(response.importe_TO);
					$("#txt_descripcion_torneria").val(response.descripcion_TO);
					$("#importe_torneria").val(response.importe_TO);
					$("#descripcion_torneria").val(response.descripcion_TO);
					$("#txt_detalle_vozcliente").val(response.descrip_vc);
					$("#detalle_vozcliente").val(response.descrip_vc);
					$("#txt_contacto_vozcliente").val(response.contacto_vc);
					$("#contacto_vozcliente").val(response.contacto_vc);
					$("#txt_porcentaje").val(response.porcentaje);
					$("#save_kms_presupuesto").val(response.kms_presupuesto);
					$("#cmbDescto").val(parseFloat((parseFloat(response.descto_presupuesto)*100)/(parseFloat(response.descto_presupuesto)+parseFloat(response.total))));

					if(response.contacto_vc != '' || response.descrip_vc != '')
						$('#lbl_tiene_voz_cliente').show();
					else
						$('#lbl_tiene_voz_cliente').hide();

					var porctj = 0;
					var nuevo_porctj = parseFloat($("#txt_porcentaje").val());
					if(nuevo_porctj > 0 || nuevo_porctj < 0)
						porctj = nuevo_porctj;

					$.each(response.detalle, function(i, item) {

						var precio=parseFloat(item._precio_detpresupuesto);
						var nuevo_precio = precio + (precio*porctj/100);
						var nuevo_precio = Math.round(nuevo_precio);

						canti=parseInt(item._canti_detpresupuesto);
						subt=parseFloat(canti*nuevo_precio).toFixed(2);
						var tmp_row={
							id:item._id_producto,
							codigo:item._nom_producto,
							producto:item._descrip_producto,
							precio:nuevo_precio,
							cantidad:canti,
							total:subt
						};
						dat.push(tmp_row);
    				});

					//buscar voz cliente
					if(response.id_vozcliente > 0)
						buscarvozcliente(response.id_vozcliente);

					$(".tabs").tabs('select','#tabs-1');
					reloadData();
    				sumatoria();

    				$("#btn_Presupuesto_Close").show();
    				$("#btn_Presupuesto_Add").show();
                    $("#btn_Presupuesto_Accepts").show();
    				$("#btn_Presupuesto_Rechazar").show();
    				$("#btn_Presupuesto_Generar").show();
    				$("#btn_Presupuesto_Generar_2").show();
    				$("#btn_Presupuesto_Open").hide();
                }
		});

	});

	function buscarvozcliente(idvc){
		// voz de cliente
		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Vozcliente.php?",
			data:"opc=10&id_vozcliente="+idvc,

			success:function(response){
				var arr = response.split("|");
				var length = arr.length - 1;
				for(var i = 0; i < length ; i++) {
					var arr_1 = arr[i].split("^");
					var id = ltrim(arr_1[0]);
					$("#save_id_vozcliente").val(id);
					$("#patente_vozcliente").val(arr_1[2]);
					$("#detalle_vozcliente").val(arr_1[3]);
					$("#contacto_vozcliente").val(arr_1[4]);
				}
			}
		});
	}

	//abrir ventana de voz cliente
	$("#btn_vozcliente").click(function(){
//		$("#dialg_vozcliente").dialog('open');
		abrirGrillaVozcliente();
	});

	//abrir ventana para ver voz cliente
	$("#btn_vervozcliente").click(function(){
		$("#detalle_vozcliente").val($("#txt_detalle_vozcliente").val());
		$("#contacto_vozcliente").val($("#txt_contacto_vozcliente").val());
		$("#dialg_vervozcliente").dialog('open');
	});


	$("#dialg_manoobra_acept").click(function(){
		var importe = parseFloat($("#importe_manoobra").val());
		if(isNaN(importe) || importe == '') {
			alert("El importe tiene que ser número con separador decimal (.)");
		}else{

			$("#txt_importe_manoobra").val(importe);
			$("#txt_descripcion_manoobra").val($("#descripcion_manoobra").val());
			addManoobra_to_detalle(0);

			$('#dialg_manoobra').dialog('close');
		}

	});

	$("#dialg_manoobra_acept2").click(function(){
		var importe = parseFloat($("#importe_manoobra2").val());
		if(isNaN(importe) || importe == '') {
			alert("El importe tiene que ser número con separador decimal (.)");
		}else{

			$("#txt_importe_manoobra2").val(importe);
			$("#txt_descripcion_manoobra2").val($("#descripcion_manoobra2").val());
			addManoobra_to_detalle(-2);

			$('#dialg_manoobra2').dialog('close');
		}

	});

	$("#dialg_torneria_acept").click(function(){
		var importe = parseFloat($("#importe_torneria").val());
		if(isNaN(importe) || importe == '') {
			alert("El importe tiene que ser número con separador decimal (.)");
		}else{

			$("#txt_importe_torneria").val(importe);
			$("#txt_descripcion_torneria").val($("#descripcion_torneria").val());
			addTorneria_to_detalle();

			$('#dialg_torneria').dialog('close');
		}

	});


	$("#dialg_open_acept").click(function(){
		var clave_usuario = $("#clave_usuario").val();

		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Persona.php?",
			data:"opc=28&clave="+clave_usuario,
			success:function(response){
				if(response == 1){
    				$("#btn_Presupuesto_Close").show();
    				$("#btn_Presupuesto_Add").show();
                    $("#btn_Presupuesto_Accepts").hide();
    				$("#btn_Presupuesto_Generar").show();
    				$("#btn_Presupuesto_Generar_2").show();
    				$("#btn_Presupuesto_Rechazar").show();
    				$("#btn_Presupuesto_Open").hide();
          //para guardar aceptado
                    if($("#txt_estado_presupuesto").val() == 'Aceptado'){
                        $("#btn_Presupuesto_Accepts").show();
                    }
				}
				else{
					alert("Acceso denegado");
				}

			}
		});
		$('#dialg_open').dialog('close');

	});


	$("#dialg_vozcliente_acept").click(function(){

		$("#txt_detalle_vozcliente").val($("#detalle_vozcliente").val());
		$("#txt_contacto_vozcliente").val($("#contacto_vozcliente").val());
		$('#dialg_vervozcliente').dialog('close');
	});


	$("#dialg_vozcliente_close").click(function(){
		$("#dialg_vervozcliente").dialog('close');
	});


	function addManoobra_to_detalle(mo) {
		//Vamos a ver si ya está agregado
		//mano de obra 1
		var existe = false;
        var lon=dat.length;
        for(var tk=0;tk<lon;tk++){
            if(dat[tk].id== mo){
              	dat.splice(tk,1);
              	break;
            }
        }
		var importe = 0;
		if(mo == 0)
	        importe = parseFloat($("#importe_manoobra").val());
	    else
	    	importe = parseFloat($("#importe_manoobra2").val());


        var tmp_row={
                id:mo,
                codigo:'MO',
                producto:'Mano de obra',
                precio: importe,
                cantidad:1,
                id_tipoiva:1,
                total:importe,
				id_remi: 0
            };
            dat.push(tmp_row);

        reloadData();
        sumatoria();
	}

	function addTorneria_to_detalle() {
		//Vamos a ver si ya está agregado

		var existe = false;
        var lon=dat.length;
        for(var tk=0;tk<lon;tk++){
            if(dat[tk].id=='-1'){
              	dat.splice(tk,1);
              	break;
            }
        }

        var importe = parseFloat($("#importe_torneria").val());

        var tmp_row={
                id:'-1',
                codigo:'TO',
                producto:'Torneria',
                precio: importe,
                cantidad:1,
                id_tipoiva:1,
                total:importe,
				id_remi: 0
            };
            dat.push(tmp_row);

        reloadData();
        sumatoria();
	}

	//voz de cliente
	function abrirGrillaVozcliente()
	{
		patente = $('#save_patente').val();
		dat_vozcliente = [];
		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Vozcliente.php?",
			data:"opc=10&patente="+patente,

			success:function(response){
				var arr = response.split("|");
				var length = arr.length - 1;
				for(var i = 0; i < length ; i++) {
					var arr_1 = arr[i].split("^");
					var id = ltrim(arr_1[0]);
					if($("#save_id_vozcliente").val() != id)
					{
						var row_tmp = {
							id:id,
							fecha:arr_1[1],
							patente:arr_1[2],
							detalle:arr_1[3],
							contacto:arr_1[4]
						};
						dat_vozcliente.push(row_tmp);
					}
				}
				var datainfo = {
					"total":0,
					"rows":dat_vozcliente
				};
				$("#vozcliente_table").datagrid('loadData',datainfo);
			}
		});
		$("#dialg_vozcliente").dialog('open');

	}

	$("#btn_vozcliente_usar").click(function() {
		var row = $("#vozcliente_table").datagrid('getSelected');
		var index = dat_vozcliente.indexOf(row);
		if(index!=-1) {
			dat_vozcliente.splice(index,1); // Remove it if really found!
		}
		var datainfo = {
			"total":0,
			"rows":dat_vozcliente
		};
		$("#vozcliente_table").datagrid('loadData',datainfo);

		//aca tenemos que llamar a la funcion que va a traer el detalle del remito y lo meterá en la factura
		if(index!=-1) {
			$("#save_id_vozcliente").val(row.id);
			$("#patente_vozcliente").val(row.patente);
			$("#detalle_vozcliente").val(row.detalle);
			$("#contacto_vozcliente").val(row.contacto);

		}

		$("#dialg_vozcliente").dialog('close');
	});

	//ltrim quita los espacios o caracteres indicados al inicio de la cadena
    function ltrim(str, chars) {
        chars = chars || "\\s";
        return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
    }

    function eliminaNull(obj){
		for(var attr in obj){
		  	if(obj[attr] === null){
		  		obj[attr] = '';
		  	}
	  		if(typeof obj[attr] === 'object'){
   				eliminaNull(obj[attr]);
		  	}
		}
		return obj;
  	}


  	//
  	//
  	//
  	// todo para cargar un nuevo cliente y vehiculo desde este modulo


	$('#dialg_nuevoCliente').dialog({
		autoOpen: false,
		width: 620,
		height: 630,
		modal: true
	});

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
            save_ruc_persona:{
                 required: false,
                minlength: 7,
                maxlength:13
            },
            save_telf_persona:{
                required: false,
                minlength:6
            },
            save_telf_persona_2:{
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
            save_direc_persona:{
              required: false,
              minlength:5
            },
            save_obs_persona:{
              required: false,
              minlength:5
            },
            save_dominio_vehiculo: {
                required: true,
                minlength: 6
            },
            save_marca_vehiculo:{
                 required: false
            },
            save_modelo_vehiculo:{
                required: false
            },
            save_anio_vehiculo:{
               required: false,
               minlength: 4,
               maxlength: 4,
               number: true
            },
            save_observacion_vehiculo:{
                required: false
            }
        },
        messages: {
            save_nom_persona: "Ingrese la razón social",
            save_ape_persona: "Ingrese el nombre de fantasía",
            save_id_ciudad:"Seleccione una ciudad",
            save_ruc_persona:"Ingrese el CUIT o DNI",
            save_telf_persona:"Ingrese un número de teléfono",
            save_telf_persona_2:"Ingrese un número de teléfono",
            save_cel_persona:"Ingrese un número de celular",
            save_email_persona:"Ingrese su e-mail",
            save_direc_persona:"Ingrese una dirección",
            save_obs_persona:"Ingrese una descripción de la ocupación",
            save_dominio_vehiculo: "Debe ingresar una patente válida (AAA111)",
            save_marca_vehiculo:"Ingrese la marca del vehículo",
            save_modelo_vehiculo:"Ingrese el modelo del vehículo",
            save_anio_vehiculo:"Ingrese el año del vehículo",
            save_observacion_vehiculo:"Ingrese una observación"

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
            frmPersonaAuto_Add();
//                alert("todo bien");
        },
        success: function(label) {
            label.html("&nbsp;").addClass("valid_small");
        }
    });


	function frmPersonaAuto_Add(){
		//nombre del formulario: frmPersona_Add
        var frmPersona=$("#frmPersona_Add").serialize();
        frmPersona=frmPersona+"&opc=29";

        var nombre = $("#save_nom_persona").val();
        var dominio = $("#save_dominio_vehiculo").val();
        var vehiculo = $("#save_marca_vehiculo").val() + " " + $("#save_modelo_vehiculo").val() + " ("+dominio+")";
        var obs_vehi = $("save_observacion_vehiculo").val();

        $.ajax({
            type:"POST",
            url:"CONTROLLER/C_Persona.php",
            data:frmPersona,
            success:function(response){

                if(response != ""){
                	var arr_tmp = response.split(";");

                	$("#label_cliente_vehiculo").show();
					$("#save_id_cliente").val($.trim(arr_tmp[0]));
					$("#save_id_vehiculo").val($.trim(arr_tmp[1]));
					$("#txt_cliente").val(nombre);
					$("#txt_vehiculo").val(vehiculo);
					$("#save_patente").val(dominio);
					$("#div_deleteVehiculo").hide();
					$("#txt_obs_vehiculo").val(obs_vehi);
					$("#save_obs_orden").val();
					if(arr_tmp[1] > 0) {
						$("#div_deleteVehiculo").show();
					}
                	$("#dialg_nuevoCliente").dialog('close');
                }
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

	$("#save_dominio_vehiculo").change(function(){
		var dominio = $("#save_dominio_vehiculo").val();

		$.ajax({
			type:"POST",
			data: "&dominio=" + dominio,
			url: "CONTROLLER/C_Vehiculo.php?opc=14",
			success:function(response){
				if(response != 0){
					$("#save_dominio_vehiculo").val("");
					$("#dialg_error").dialog('open');
				}
			}
		});
	});

	$('#dialg_error').dialog({
		autoOpen: false,
		width: 460,
		height: 160,
		modal: true
	});


	$('#dialg_error_close').click(function() {
		$('#dialg_error').dialog('close');
	});


  	//label de voz cliente
  	$('#detalle_vozcliente').change(function(){
  		mostrarLabel();
  	});

  	$('#contacto_vozcliente').change(function(){
  		mostrarLabel();
  	});

  	function mostrarLabel(){
  		if($('#detalle_vozcliente').val() != '' || $('#contacto_vozcliente').val() != ''){
  			$('#lbl_tiene_voz_cliente').show();
  		}else{
  			$('#lbl_tiene_voz_cliente').hide();
  		}
  	}

	function eliminaNull(obj){
        for(var attr in obj){
            if(obj[attr] === null){
                obj[attr] = '';
            }
            if(typeof obj[attr] === 'object'){
                eliminaNull(obj[attr]);
            }
        }
        return obj;
    }

});
