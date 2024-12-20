$(document).ready(function(){
 var cont=0;
 var dat=[];//modelo del grid
 var total_iva=0;

 //$('#div_cliente').hide();

 	$("#div_deleteVehiculo").hide();

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
        "sAjaxSource": "VIEW/WBuscarRemito.php?",
        "sPaginationType": "full_numbers",
        "aaSorting": [[ 0, "desc" ]], // para ordenarlos por default
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "xls", "pdf"
            ]
        }
    });


	$.ajax({
		type:"POST",
		url:"CONTROLLER/C_Remito.php?opc=12",
		success:function(response){
			if(response > 1){
				$("#txt_num_remi").val(response);
			}else{
				$("#txt_num_remi").val('1');
			}
		}
	});


$('#tt').datagrid('reloadFooter',[  //inicio foter del datagrid
    {cantidad:"SubTotal : ",total: 0},
    {cantidad:"Total : ",total: 0}
]);

    $(".datepicker").datepicker();
    $('.datepicker').datepicker('option', {dateFormat: 'dd-mm-yy'});
    //carga la fecha actual
    $('.datepicker').datepicker('setDate', new Date());

/*
	$("#btn_plan_calculo").click(function(){
		var fec_ini = $("#plan_fecini_producto").datepicker('getDate');//datepicker('getDate')
		var fec_fin = $('#plan_fecfin_producto').datepicker('getDate');
		var dayDiff = Math.ceil((fec_fin - fec_ini) / (1000 * 60 * 60 * 24));
		var costo=$("#plan_pago_producto").val();
		var total=(parseFloat(costo)/30)*dayDiff;
		total=total.toFixed(2)*1;
		$("#plan_numdia_producto").val(dayDiff);
		$("#plan_total_producto").val(total);
		$("#txt_precio").val(total);
	});
*/
	$("#btn_Remito_Generar").hide();
    $("#btn_Remito_Open").hide();


	function Add(){
       if(verificarDat()){
            cont++;
            var idprod	= $("#txt_idproducto").val();
            var prod	= $("#txt_nom_producto").val();
            var codprod	= $("#txt_cod_producto").val();
            var precio	= $("#txt_precio").val();
         	var canti	= $("#txt_cantidad").val();
            canti=parseInt(canti);

            precio=parseFloat(precio);
            var subt=$("#txt_sub").val();
            subt=parseFloat(subt);

            var tmp_row={
                id:idprod,
                codigo:codprod,
                producto:prod,
                precio:precio,
                cantidad:canti,
                total:subt
            };
			if(dat.length >= 20){
				$('#error_msg').dialog('open');
				$("#msg_err").text("El remito permite un máximo de 20 items");
			}else{
				dat.push(tmp_row);
				reloadData();
				sumatoria();
			}
       }

    }

	function reloadData(){
        var datainfo = {
            "total":0,
            "rows":dat
        };
        $('#tt').datagrid('loadData', datainfo);
    }

	function vaciarVector(){
		dat=[];
		cont=0;
		reloadData();
		sumatoria();
	}

	function sumatoria(){//total de footer
        var tl=$("#tt").datagrid('getRows');
        var lng=tl.length;
        var sum=0;

        for(var t=0;t<lng;t++){
            //              var ret=tl[i]['producto'];
            sum=sum + tl[t]['total'];
        }
        $("#txt_temporal").val(sum.toFixed(2));

//        iva=iva.toFixed(2);
        var toto=sum;
        toto=toto;
        toto=toto.toFixed(2);
        $('#tt').datagrid('reloadFooter',[
           {cantidad:"SubTotal : ",total: sum.toFixed(2)},
           {cantidad:"Total : ",total: toto}
        ]);
        $("#total_remi").val(toto);
    }



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



	function Delete(){
        var row = $('#tt').datagrid('getSelected');
        var index= dat.indexOf(row); // Find the index
       if(index!=-1) dat.splice(index,1); // Remove it if really found!
        reloadData();
        sumatoria();
    }

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



	$('#dial_msg_close').click(function() {
		$('#dialg_msg').dialog('close');
		location.reload();
	});

	$("#error_msg_close").click(function(){
		$('#error_msg').dialog('close');
	});


	$('#dialg_form').dialog({
		autoOpen: false,
		width: 750,
		height: 300,
		modal: true
	});

	$('#dialg_generar').dialog({
		autoOpen: false,
		width: 460,
		height: 140,
		modal: true
	});

	$('#dialg_confirmar_regenerar').dialog({
		autoOpen: false,
		width: 560,
		height: 140,
		modal: true
	});

	$('#dialg_open').dialog({
		autoOpen: false,
		width: 330,
		height: 120,
		modal: true
	});

	$('#dial_generar_close').click(function() {
		$('#dialg_generar').dialog('close');
	});

	$("#dialg_open_close").click(function(){
		$("#dialg_open").dialog('close');
	});



	$('#cmbgridEmpleado').combogrid({
		panelWidth:400,
		url: 'CONTROLLER/C_Persona.php?opc=12',
		idField:'id_persona',
		textField:'nom_persona',
		mode:'remote',
		fitColumns:true,
		columns:[[
			{field:'id_persona',title:'Id',width:20},
			{field:'nom_persona',title:'Nombre',align:'right',width:100},
			{field:'ape_persona',title:'Apellido',align:'right',width:100}

		]],
		onSelect:function(rowData){
		var row =$('#cmbgridEmpleado').combogrid('grid').datagrid('getSelected');
		   $("#save_id_vendedor").val(row.id_persona);
		}
    });




	$('#cmbgridVehiculo').combogrid({
		panelWidth:400,
		url: 'CONTROLLER/C_Vehiculo.php?opc=13',
		idField:'id_vehiculo',
		textField:'dominio',
		mode:'remote',
		fitColumns:true,
		columns:[[
			{field:'id_vehiculo',title:'Id',width:20},
			{field:'dominio',title:'Patente',align:'right',width:100},
			{field:'vehiculo',title:'Vehiculo',align:'right',width:100}

		]],
		onSelect:function(rowData){
			var row =$('#cmbgridVehiculo').combogrid('grid').datagrid('getSelected');
			$("#save_id_vehiculo").val(row.id_vehiculo);
			llenar_cmbGridCliente(row.id_vehiculo);
		}
	});

	$("#label_cliente_vehiculo").hide();

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
			{field:'porcentaje',title:'',align:'right', hidden:true },
            {fueld:'saldo',title:'',aligh:'right',hidden:true}

		]],
		onSelect:function(rowData){
			var row =$('#cmbgridCliente').combogrid('grid').datagrid('getSelected');
			$("#label_cliente_vehiculo").show();
			$("#save_id_cliente").val(row.id_cliente);
			$("#save_id_vehiculo").val(row.id_vehiculo);
			$("#txt_cliente").val(row.cliente);
			$("#txt_vehiculo").val(row.vehiculo + ' ('+row.dominio+')');
			$("#txt_porcentaje").val(row.porcentaje);
			if(row.vehiculo === null || row.dominio === null || row.vehiculo == 'SIN VEHICULO')
				$("#txt_vehiculo").val("");
			$("#div_deleteVehiculo").hide();
			if(row.id_vehiculo > 0) {
				$("#div_deleteVehiculo").show();
			}

            if(parseInt(row.tiene_ctacte) == 1 && (parseFloat(row.saldo) >= parseFloat(row.limite_ctacte)) && row.limite_ctacte > 0){
                $("#msg_err").text("El cliente superó el límite de cuenta corriente asignado.");
                $("#error_msg").dialog('open');
            }
		}
    });

    $("#btn_deleteVehiculo").click(function(){
    	$("#save_id_vehiculo").val("");
    	$("#txt_vehiculo").val("");
    	$("#div_deleteVehiculo").hide();
    });

    $("#btn_Remito_Anular").hide();

    $("#btn_Remito_Anular").click(function(){
		$("#dialg_open").dialog('open');
	});


    $("#dialg_open_acept").click(function(){
		var clave_usuario = $("#clave_usuario").val();

		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Persona.php?",
			data:"opc=28&clave="+clave_usuario,
			success:function(response){
				if(response == 1){
					var id_remi = $("#txt_num_remi").val();
                    var opc = 16;
                    if($("#estado_remi").val() != "1"){
                        opc = 17;
                    }
					$.ajax({
						type:"POST",
						url:"CONTROLLER/C_Remito.php?",
						data:"opc="+opc+"&id_remi="+id_remi,
						success:function(response){
							$("#dialg_msg").dialog('open');
						}
					});
				}
				else{
					alert("Acceso denegado");
				}

			}
		});
		$('#dialg_open').dialog('close');

	});


	function llenar_cmbGridCliente(id){
		$("#save_id_cliente").val();
		$('#div_cliente').show();
		$('#cmbgridCliente').combogrid({
			panelWidth:400,
			url: 'CONTROLLER/C_Persona.php?opc=22&idv='+id,
			idField:'id_persona',
			textField:'nom_persona',
			mode:'remote',
			fitColumns:true,
			columns:[[
				{field:'id_persona',title:'Id',width:20},
				{field:'nom_persona',title:'Nombre',align:'right',width:100},
				{field:'ape_persona',title:'Apellido',align:'right',width:100},
				{field:'ruc_persona',title:'RUC',align:'right',width:100}

			]],
			onSelect:function(rowData){
			var row =$('#cmbgridCliente').combogrid('grid').datagrid('getSelected');
			   $("#save_id_cliente").val(row.id_persona);
			}
		});

	}



	$('#cmbgridProducto').combogrid({
		panelWidth:600,
		url: 'CONTROLLER/C_Factura.php?opc=6',
		idField:'id_producto',
		textField:'descrip_producto',
		mode:'remote',
		fitColumns:true,
		columns:[[
		   {field:'id_producto',title:'Id',width:20},
		   {field:'nom_producto',title:'Producto',align:'right',width:100},
		   {field:'descrip_producto',title:'Descripción',align:'right',width:430},
		   {field:'pvp1_producto',title:'Precio',align:'right', width:80},
		   {field:'stock_producto',title:'Stock',align:'right',width:50},
		   {field:'id_tipoiva', title: 'IVA', align:'right', 'hidden':true}
		]],
		onSelect:function(rowData){
			var porctj = 0;
			var row =$('#cmbgridProducto').combogrid('grid').datagrid('getSelected');
			$("#txt_idproducto").val(row.id_producto);
			$("#txt_nom_producto").val(row.descrip_producto);
			$("#txt_cod_producto").val(row.nom_producto);
			$("#txt_tipoiva").val(row.id_tipoiva);
//			var tot=row.pvp1_producto*1;

			var precio_limpio = parseFloat(row.pvp1_producto);
			var nuevo_porctj = parseFloat($("#txt_porcentaje").val());
			if(nuevo_porctj > 0 || nuevo_porctj < 0){ //si es superior a 0 lo cambio sino dejo el 0%
				porctj = nuevo_porctj;
			}
			var precio_nuevo = parseFloat(precio_limpio+(precio_limpio*porctj/100)).toFixed(2);


			$("#txt_precio").val(Math.round(precio_nuevo));
			$("#txt_cantidad").val(1);
			$("#txt_sub").val(Math.round(precio_nuevo));
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
		sumatoria();
	});


//validator

	var validator_f = $("#frm_AddProducto").validate({
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


	var validator_addRemito = $("#frm_remito").validate({
        rules: {
            save_obs_remi: {
                required: false,
               minlength:5
            },
            txt_num_remi: {
               required: false,
            }
        },
        messages: {
            txt_num_remi:"Requerido"
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
            Remito_Add();
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
    $("#btn_Remito_New").click(function(){
       vaciarVector();
	   $("#frm_remito .form-field").val ("");
	   vaciarCampos();
	   $("#btn_Remito_Add").show();
	   $("#btn_Remito_Generar").hide();
	   $("#btn_Remito_Anular").hide();
       $("#btn_Remito_Open").hide();
	   $("#tipo_guardar").val("nuevo");
	   $('.datepicker').datepicker('setDate', new Date());

	   $.ajax({
			type:"POST",
			url:"CONTROLLER/C_Remito.php?opc=12",
			success:function(response){
				if(response > 1){
					$("#txt_num_remi").val(response);
				}else{
					$("#txt_num_remi").val('1');
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
	}


	$("#btn_Remito_Generar").click(function(){
    	$.ajax({
            type:"GET",
            url:"CONTROLLER/C_Remito.php?opc=15&id_remito=" + $("#txt_num_remi").val(),
            dataType:'json',
            success:function(response){
            	if(response == "E"){
            		$('#dialg_confirmar_regenerar').dialog('open');
            	}else{
					$.ajax({
						type:"GET",
						url:"CONTROLLER/C_Remito.php?opc=14&id_remito=" + $("#txt_num_remi").val(),
						dataType:'json',
						success:function(response){
							$('#dialg_generar').dialog('open');
							$("#msg_generar").text("Presupuesto generado con el número " + response);
						}
					});
            	}
            }
        });

    });


	$("#btn_dialg_regenerar_acept").click(function(){
    	$("#dialg_confirmar_regenerar").dialog('close');
    	$.ajax({
			type:"GET",
			url:"CONTROLLER/C_Remito.php?opc=14&id_remito=" + $("#txt_num_remi").val(),
			dataType:'json',
			success:function(response){
				$('#dialg_generar').dialog('open');
				$("#msg_generar").text("Presupuesto generado con el número " + response);
			}
		});
    });

	$("#btn_dialg_regenerar_close").click(function(){
    	$("#dialg_confirmar_regenerar").dialog('close');
    });

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

    function Remito_Add(){
		validador= validarCombos();
		var opc = 1;
		if(validador == 'C'){

			if($("#tipo_guardar").val() == "nuevo"){
				opc = 1;
			}else{
				opc = 2;
			}

			var frmRemito=$("#frm_remito").serialize();
			$.ajax({
				type:"POST",
				url:"CONTROLLER/C_Remito.php?opc="+opc+"&"+frmRemito,
				data:({Detalle:dat}),
				dataType:'json',
				success:function(response){
					$('#dialg_msg').dialog('open');
					$("#msg").text(response.txt);

					//Vaciamos todo para que un nuevo remito
					vaciarVector();
					$("#frm_remito .form-field").val ("");
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


    $("#btn_Remito_Add").click(function(){
        $("#frm_remito").submit();
    });

    $("#btn_Remito_Open").click(function(){
    	$("#clave_usuario").val("");
    	$('#dialg_open').dialog('open');
    });

    $("#btn_Remito_Print").click(function(){

        var fo=getStringParsedToPrint();

        var windowSizeArray = [ "width=200,height=200","width=800,height=600,scrollbars=yes" ];
        var numero		= $("#txt_num_remi").val();
        var fecha 		= $("#save_fecemi_remi").val();
        var cli			= $("#save_id_cliente").val();
        var vehiculo	= $("#txt_vehiculo").val();
        var vehiid		= $("#save_id_vehiculo").val();
        var concepto	= $("#save_obs_remi").val();
        var total		= $("#total_remi").val();

        var url 		= "remito_pdf.php";
        var windowName 	= "popUp";//$(this).attr("name");
        var windowSize 	= windowSizeArray;
        var param		= "?mostrar_precios=0&idcliente="+cli+"&vehiculo="+vehiculo+"&numero="+numero+"&idvehiculo="+vehiid+"&fecha="+fecha+"&concepto="+concepto+"&total="+total+"&detalle="+fo;
        var win			= window.open(url+param, windowName, windowSize);

    });

    $("#btn_Remito_Print1").click(function(){

        var fo=getStringParsedToPrint();

        var windowSizeArray = [ "width=200,height=200","width=800,height=600,scrollbars=yes" ];
        var numero		= $("#txt_num_remi").val();
        var fecha 		= $("#save_fecemi_remi").val();
        var cli			= $("#save_id_cliente").val();
        var vehiculo	= $("#txt_vehiculo").val();
        var vehiid		= $("#save_id_vehiculo").val();
        var concepto	= $("#save_obs_remi").val();
        var total		= $("#total_remi").val();

        var url 		= "remito_pdf.php";
        var windowName 	= "popUp";//$(this).attr("name");
        var windowSize 	= windowSizeArray;
        var param		= "?mostrar_precios=1&idcliente="+cli+"&vehiculo="+vehiculo+"&numero="+numero+"&idvehiculo="+vehiid+"&fecha="+fecha+"&concepto="+concepto+"&total="+total+"&detalle="+fo;
        var win			= window.open(url+param, windowName, windowSize);

    });


	function getStringParsedToPrint(){

		var lon=dat.length;
		var cade="";
        var aux=0;
        for(var tk=0;tk<lon;tk++){

        	//Essto lo hago solo para poder imprimir la mano de obra completa
        	var producto = dat[tk].producto;
        	if(dat[tk].id == '0')
        		var producto = $("#txt_descripcion_manoobra").val();

			cade=cade+dat[tk].id+"|"+producto+"|"+dat[tk].precio+"|"+dat[tk].cantidad+"|"+dat[tk].total+"|"+dat[tk].codigo+"^";
        }
        cade=cade.toString().substr(0, cade.length-1);
        return cade;
	}

	//Detalle de un remito

	$(".clsMatrizModificar").livequery("click", function(e){
		$(".tag").remove();
		var id_remi=$(this).attr("id").replace("btn_detalle","");

		$('#table_detalle_remito_popup').dataTable({
			"bServerSide": false,
			"bFilter": false,
			"bJQueryUI": true,
			"bDestroy":true,
			"sAjaxSource": "VIEW/WBuscarDetalleRemito.php?id_remito=" + id_remi,
		   "sPaginationType": "full_numbers",
			"sDom": '<"H"Tfr>t<"F"ip>',
			"oTableTools": {
				"aButtons": [
				]
			}
		});

		$('#dialg_form').dialog('open');
	});

	$("#btn_Detalle_cerrar").click(function(){
		 $('#dialg_form').dialog('close');
	});

	//MANO DE OBRA Y TODOO LO QUE TIENE QUE VER

	$('#dialg_manoobra').dialog({
		autoOpen: false,
		width: 430,
		height: 270,
		modal: true
	});


	$("#dialg_manoobra_close").click(function(){
		$('#dialg_manoobra').dialog('close');
	});

	$("#btn_manoobra").click(function(){
		$("#dialg_manoobra").dialog('open');
	});


	$("#dialg_manoobra_acept").click(function(){
		var importe = parseFloat($("#importe_manoobra").val());
		if(isNaN(importe) || importe == '') {
			alert("El importe tiene que ser número con separador decimal (.)");
		}else{

			$("#txt_importe_manoobra").val(importe);
			$("#txt_descripcion_manoobra").val($("#descripcion_manoobra").val());
			addManoobra_to_detalle();

			$('#dialg_manoobra').dialog('close');
		}

	});


	function addManoobra_to_detalle() {
		//Vamos a ver si ya está agregado
		var existe = false;
        var lon=dat.length;
        for(var tk=0;tk<lon;tk++){
            if(dat[tk].id=='0'){
              	dat.splice(tk,1);
              	break;
            }
        }

        var importe = parseFloat($("#importe_manoobra").val());

        var tmp_row={
                id:'0',
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


	//Con este vamos ver un remito
	$(".clsMatrizVer").livequery("click", function(e){
		vaciarCampos();
		vaciarVector();
		$(".tag").remove();
		var idremi=$(this).attr("id").replace("btn_detalle","");

            var frmremi="id_remito="+idremi+"&opc=13";
            $.ajax({
                type:"POST",
                url:"CONTROLLER/C_Remito.php",
                data:frmremi,
                dataType:'json',
                success:function(response){
//					response = eliminaNull(response);

					$("#txt_num_remi").val(response.id_remito);
					$("#save_fecemi_remi").val(response.fecha_remito);
					$("#txt_cliente").val(response.nom_persona + '-' + response.ape_persona);
					$("#txt_vehiculo").val(response.marca + ' ' + response.modelo + ' (' + response.dominio + ')');
					if(response.marca === null && response.modelo === null && response.dominio === null)
						$("#txt_vehiculo").val("");
					$("#save_obs_remi").val(response.obs_remi);
					$("#save_id_vehiculo").val(response.id_vehiculo);
					$("#save_id_cliente").val(response.id_cliente);
					$("#txt_importe_manoobra").val(response.importe_MO);
					$("#txt_descripcion_manoobra").val(response.descripcion_MO);
					$("#importe_manoobra").val(response.importe_MO);
					$("#descripcion_manoobra").val(response.descripcion_MO);
					$("#txt_porcentaje").val(response.porcentaje_listaprecio);
                    $("#estado_remi").val(response.estado_remi);
//					$("#txt_descripcion_vozcliente").val(response.descripcion_VC);
//					$("#descripcion_vozcliente").val(response.descrip_vc);


					var porctj = 0;
					var nuevo_porctj = parseFloat(response.porcentaje_listaprecio);
					if(nuevo_porctj > 0 || nuevo_porctj < 0)
						porctj = nuevo_porctj;


					$.each(response.detalle, function(i, item) {
						precio=parseFloat(item._precio_detremi);
						var precio_nuevo = Math.round((precio+(precio*porctj/100)).toFixed(2));
						if(response.estado_remi == "2")
							precio_nuevo = Math.round(precio);
						canti=parseInt(item._canti_detremi);
						subt=parseFloat(canti*precio_nuevo);
						var tmp_row={
							id:item._id_producto,
							codigo:item._nom_producto,
							producto:item._descrip_producto,
							precio:precio_nuevo,
							cantidad:canti,
							total:subt
						};
						dat.push(tmp_row);
    				});

//    				recalcularPrecios();
/*
    				if(response.importe_MO != ''){
    					precio_mo = parseFloat(response.importe_MO);
    					var tmp_row_mo={
    						id:'0',
    						producto:'MANO DE OBRA',
    						precio:precio_mo,
    						cantidad:'1',
    						total:precio_mo
    					};
    					dat.push(tmp_row_mo);
    				}
*/

					$(".tabs").tabs('select','#tabs-1');
					reloadData();
    				sumatoria();

    				$("#btn_Remito_Generar").show();
    				if(response.estado_remi != "1"){
    					$("#btn_Remito_Add").hide();
    					$("#tipo_guardar").val("nuevo");
    					$("#btn_Remito_Anular").hide();
                        $("#btn_Remito_Open").show();
    				}else{
                        $("#btn_Remito_Open").hide();
    					$("#btn_Remito_Add").show();
    					$("#btn_Remito_Anular").show();
    					$("#tipo_guardar").val("update");
    				}
                }
		});

	});

	function recalcularPrecios(){
		var porctj = 0;
		var nuevo_porctj = parseFloat($("#txt_porcentaje").val());

		if(nuevo_porctj > 0 || nuevo_porctj < 0){ //si es diferente a 0 lo cambio sino dejo el 0%
			porctj = nuevo_porctj;
		}
		var lng=dat.length;

		for(var t=0;t<lng;t++){
			if(dat[t]['id'] > 0){
				var precio_orig = Math.round(parseFloat(dat[t]['precio']));
				dat[t]['precio'] = Math.round(parseFloat(precio_orig+(precio_orig*porctj/100)).toFixed(2));
				dat[t]['total'] = dat[t]['precio']*dat[t]['cantidad'];
			}
        }
	};


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
