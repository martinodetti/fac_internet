$(document).ready(function(){
	var cont=0;
	var dat=[];//modelo del grid
	var total_iva=0;
	var dat_remitos=[];

	$('#tt').datagrid('reloadFooter',[  //inicio foter del datagrid
		{cantidad:"SubTotal : ",total: 0},
		{cantidad:"Iva 21% : ",total: 0},
		{cantidad:"Iva 10.5% : ",total: 0},
		{cantidad:"Descto (%) : ",total: 0},
		{cantidad:"Total : ",total: 0}
	]);

	set_num_factura();

		//TABLES
	var oTable=  $('#table-example').dataTable({
        "bServerSide": true,
        "bFilter": true,
        "bJQueryUI": true,
        "sAjaxSource": "VIEW/WBuscarFactura.php?",
        "sPaginationType": "full_numbers",
        "aaSorting": [[ 1, "desc" ]], // para ordenarlos por default
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "xls", "pdf"
            ]
        }
    });

    var oTable=  $('#table-example-nc').dataTable({
        "bServerSide": true,
        "bFilter": true,
        "bJQueryUI": true,
        "sAjaxSource": "VIEW/WBuscarNotacredito.php?",
        "sPaginationType": "full_numbers",
        "aaSorting": [[ 2, "desc" ]], // para ordenarlos por default
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "xls", "pdf"
            ]
        }
    });

    var oTable=  $('#table-example-nd').dataTable({
        "bServerSide": true,
        "bFilter": true,
        "bJQueryUI": true,
        "sAjaxSource": "VIEW/WBuscarNotadebito.php?",
        "sPaginationType": "full_numbers",
        "aaSorting": [[ 2, "desc" ]], // para ordenarlos por default
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "xls", "pdf"
            ]
        }
    });

    $("#btn_Factura_Cancel").hide();
	$("#btn_Factura_Print").hide();


    $('#tblLoading').ajaxStart(function() { $(this).show(); });
	$('#tblLoading').ajaxComplete(function() { $(this).hide(); });


	$(".datepicker").datepicker();
	$('.datepicker').datepicker('option', {dateFormat: 'dd-mm-yy'});
	//carga la fecha actual
	$('.datepicker').datepicker('setDate', new Date());


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


	$("#save_tipo_fact").change(function(){
		set_num_factura();
	});

	$('#link_pendientes').hide();

	function set_num_factura() {
		id_tipo = $("#save_tipo_fact").val();
		$.ajax({
			type:"POST",
			data:"&id_tipo=" + id_tipo,
			url:"CONTROLLER/C_Factura.php?opc=10",
			success:function(response){
				if(response > 1){
					$("#txt_num_fact").val($.trim(response));
				}else{
					$("#txt_num_fact").val('1');
				}
			}
		});
		if(id_tipo == 1) {
			$("#checkiva").attr('checked', true);
		} else {
			$("#checkiva").attr('checked', false);
		}
		sumatoria();
	}


	$("#txt_num_fact").change(function(){
		var num_fact = $("#txt_num_fact").val();
		var tipo_fact = $("#save_tipo_fact").val();

		$.ajax({
			type:"POST",
			data: "&num_fact="+num_fact+"&tipo_fact="+tipo_fact,
			url: "CONTROLLER/C_Factura.php?opc=15",
			success:function(response){
				if(response != 0){
					$("#txt_num_fact").val("");
					$("#dialg_error").dialog('open');
                    $("#msg_err").text("El número de factura ingresado ya se encuentra cargado para este tipo de factura");
				}
			}
		});
	});


	$("#checkiva").click(function() {
		sumatoria();
	});


	function Add(){
        var existe = verificarDat();
        if(existe == 'NE'){
            cont++;
            var idprod		= $("#txt_idproducto").val();
            var id_tipoiva 	= $("#txt_tipoiva").val();
            var prod		= $("#txt_nom_producto").val();
            var cod			= $("#txt_cod_producto").val();
            var precio		= $("#txt_precio").val();
            var subt		= $("#txt_sub").val();
            var prec_s_iva	= $("#txt_precio").val();
            var tot_s_iva	= prec_s_iva * canti;

            if(id_tipoiva == '1'){
            	precio			= (parseFloat(precio) * 1.21).toFixed(2);
            	subt			= (parseFloat(subt) * 1.21).toFixed(2);
            }else{
            	precio			= (parseFloat(precio) * 1.105).toFixed(2);
            	subt			= (parseFloat(subt) * 1.105).toFixed(2);
            }
            var canti		= $("#txt_cantidad").val();
            canti			= parseFloat(canti);

            var precio_orig	= $("#txt_precio_limpio").val();
            precio_orig		= parseFloat(precio_orig);
            var prec_s_iva	= $("#txt_precio").val();
            prec_s_iva 		= parseFloat(prec_s_iva);
            var tot_s_iva	= prec_s_iva * canti;
            tot_s_iva		= parseFloat(tot_s_iva);

            var tmp_row={
                id:idprod,
                codigo:cod,
                producto:prod,
                precio_orig:precio_orig,
                cantidad:canti,
                id_tipoiva:id_tipoiva,
                total:tot_s_iva,
                precio:prec_s_iva,
				id_remi: 0
            };

            if($("#save_tipo_fact").val() == "B"){
	            tmp_row.precio 	= precio,
	            tmp_row.total	= subt
            }

            dat.push(tmp_row);
            reloadData();
            sumatoria();
		}
		else {
			var precio		= $("#txt_precio").val();
			var nueva_cant 	= parseFloat(dat[existe]['cantidad']) + parseFloat($("#txt_cantidad").val());
			var nuevo_subt 	= nueva_cant * precio;

			dat[existe]['total'] = nuevo_subt;
			dat[existe]['cantidad'] = nueva_cant;

			reloadData();
            sumatoria();
		}

    }

	function reloadData(){
		for(var t=0;t<dat.length;t++)
		{
			dat[t].precio = Math.round(dat[t].precio);
			dat[t].total = Math.round(dat[t].precio * dat[t].cantidad);
		}
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

		$("#btn_Factura_Add").show();
		$("#btn_Factura_Print").hide();
		$("#btn_Factura_Cancel").hide();
		$("#cmbDescto").val(0);
	}

	function sumatoria(){//total de footer
		var tl=$("#tt").datagrid('getRows');
//		var descto=$("#cmbDescto option:selected").text();
		var descto=$("#cmbDescto").val();
		if($("#save_percepcion").val() != '')
			var percepcion = parseFloat($("#save_percepcion").val());
		else
			var percepcion = 0;

		descto=parseFloat(descto);
		var lng=tl.length;
		var sum=0;
		var iva_21 = 0; //id 1
		var iva_105 = 0; // id 2
		var iva_0 = 0; // id 3
		var valor_sin_desc = 0;

        for(var t=0;t<lng;t++){
            //              var ret=tl[i]['producto'];
            valor_real = tl[t]['total'] - ( (tl[t]['total'] * descto) / 100);
            valor_sin_desc = valor_sin_desc + tl[t]['total'];
            sum=sum + valor_real;

            if($("#save_tipo_fact").val() == "A"){ //siempre tengo que discriminar el iva
	            switch(tl[t]['id_tipoiva']){
            	case '1':
            		iva_21 = iva_21 + ((valor_real * 0.21));
            		break;
            	case '2':
            		iva_105 = iva_105 + ((valor_real * 0.105));
            		break;
            	case 1:
            		iva_21 = iva_21 + ((valor_real * 0.21));
            		break;
	            }
	        }
	        else{
	            switch(tl[t]['id_tipoiva']){
            	case '1':
            		iva_21 = iva_21 + ((valor_real / 1.21 * 0.21));
            		break;
            	case '2':
            		iva_105 = iva_105 + ((valor_real / 1.105 * 0.105));
            		break;
            	case 1:
            		iva_21 = iva_21 + ((valor_real / 1.21 * 0.21));
            		break;
	            }
	        }
        }
//        sum = sum - iva_21 - iva_105;
        $("#txt_temporal").val(sum.toFixed(2));

//        iva=iva.toFixed(2);
		if($("#save_tipo_fact").val() == "A"){
	        var toto=sum+iva_21+iva_105;
	    }
	    else{
	    	var toto=sum;
	    }

        var tdsct=(descto*valor_sin_desc)/100;

        if(isNaN(tdsct))
        	tdsct = 0;

        toto=toto+percepcion;
//        toto=toto.toFixed(2);
		if($("#save_tipo_fact").val() == "A")
		{
			$('#tt').datagrid('reloadFooter',[
				{cantidad:"SubTotal : ",total: sum.toFixed(2)},
				{cantidad:"Iva 21% : ",total: iva_21.toFixed(2)},
				{cantidad:"Iva 10.5% : ",total: iva_105.toFixed(2)},
				{cantidad:"Descto (%) : ",total: tdsct.toFixed(2)},
				{cantidad:"Total : ",total: toto.toFixed(2)}
		    ]);
		}
		else
		{
			$('#tt').datagrid('reloadFooter',[
				{cantidad:"SubTotal : ",total: toto.toFixed(2)},
				{cantidad:"Iva 21% : ",total: 0},
				{cantidad:"Iva 10.5% : ",total: 0},
				{cantidad:"Descto (%) : ",total: tdsct.toFixed(2)},
				{cantidad:"Total : ",total: toto.toFixed(2)}
		   	]);
		}

        $("#save_descto_fact").val(tdsct.toFixed(2));
        $("#iva21_fact").val(iva_21.toFixed(2));
        $("#iva105_fact").val(iva_105.toFixed(2));
        $("#total_fact").val(toto.toFixed(2));

    }



	function verificarDat(){//tomo el id del producto
        var row =$('#cmbgridProducto').combogrid('grid').datagrid('getSelected');
        var lon=dat.length;
        var aux= 'NE';
        for(var tk=0;tk<lon;tk++){
            if(dat[tk].id==row.id_producto){
                aux = tk;
            break;
            }
        }
        return aux;
    }

	function Delete(){
        var row = $('#tt').datagrid('getSelected');
        var index= dat.indexOf(row); // Find the index
		if(index!=-1) {
			dat.splice(index,1); // Remove it if really found!
		}

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

	$('#dialg_cobrar').dialog({
		autoOpen: false,
		width: 230,
		heigth: 300,
		modal: true
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


	$('#dial_msg_close').click(function() {
		$('#dialg_msg').dialog('close');
		location.reload();
	});

	$('#btn_cobro_cerrar').click(function() {
		$('#dialg_cobrar').dialog('close');
	});


	//oculto el div de los remitos
    $('#remitos_pendientes').hide();

	$('#cmbgridCliente').combogrid({
		panelWidth:500,
		url: 'CONTROLLER/C_Persona.php?opc=14',
		idField:'id_persona',
		textField:'nom_persona',
		mode:'remote',
		fitColumns:true,
		columns:[[
			{field:'id_persona',title:'Id',width:20},
			{field:'nom_persona',title:'Nombre',align:'right',width:100},
			{field:'ape_persona',title:'Apellido',align:'right',width:100},
			{field:'ruc_persona',title:'CUIT',align:'right',width:100},
			{field:'listaprecio',title:'Precios', align:'right', width:100},
			{field:'pendientes',title:'Pend',align:'right',width:30},
			{field:'id_listaprecio',title:'',align:'right', hidden:true },
			{field:'porcentaje',title:'',align:'right', hidden:true },
			{field:'id_condiva',title:'',align:'right', hidden:true },
			{field:'tiene_ctacte',title:'', align:'right',hidden:true},
			{field:'limite_ctacte',title:'', align:'right',hidden:true},
			{field:'pendiente',title:'', align:'right',hidden:true}
		]],
		onSelect:function(rowData){
			var row =$('#cmbgridCliente').combogrid('grid').datagrid('getSelected');
			$("#txt_apellidos_fact").val(row.nom_persona+' '+row.ape_persona);
			$("#txt_ruc_fact").val(row.ruc_persona);
			$("#save_id_cliente").val(row.id_persona);
			$("#txt_porcentaje").val(row.porcentaje);
			$("#txt_id_condiva").val(row.id_condiva);

			var param="show_id_persona="+row.id_persona+"&opc=21";
			$.ajax({
                type:"POST",
                url:"CONTROLLER/C_Persona.php",
                data:param,
                dataType:'json',
                success:function(response){

					if(response._id_condiva == "1"){
						$("#save_tipo_fact").val('A');
					}else{
						$("#save_tipo_fact").val('B');
					}

					set_num_factura();
					$("#cmb_forma_pago option[value='3']").remove();
					if(response._tiene_ctacte == "1"){
						$("#cmb_forma_pago").append('<option value="3" selected="selected">Cuenta corriente</option>');
					}
				}
			});

			if($("#cmb_tipo_fact").val() == 1 ) {
				dat_remitos = [];
				if(row.pendientes > 0) {
					$.ajax({
						type:"POST",
						url:"CONTROLLER/C_Remito.php?",
						data:"opc=10&id_cli=" + row.id_persona,
						success:function(response){
							var arr = response.split("|");
							var length = arr.length - 1;
							for(var i = 0; i < length ; i++) {
								var yaesta = false;
								var arr_1 = arr[i].split(";");
								var id = ltrim(arr_1[0]);
								if(arr_1[1] == 'remito')
								{
									yaesta = yaCobrado($('#txt_idremitos').val(), id);
								}
								else
								{
									yaesta = yaCobrado($('#txt_idordenes').val(), id);
								}
								if(!yaesta)
								{
									var row_tmp = {
										tipo:arr_1[1],
										id:id,
										dominio:arr_1[2],
										total:arr_1[3],
										fecha:arr_1[4]
									};
									dat_remitos.push(row_tmp);
								}
							}
							var datainfo = {
								"total":0,
								"rows":dat_remitos
							};
							$("#remitos_table").datagrid('loadData',datainfo);
						}
					});
					$('#dialg_form').dialog('open');

					$('#link_pendientes').show();
				}
				else {
					$('#remitos_pendientes').hide();
					$('#link_pendientes').hide();
				}
				recalcularPrecios();
				sumatoria();

			}else if($("#cmb_tipo_fact").val() == 2 ) {
				$.ajax({
					type:"POST",
					url:"CONTROLLER/C_Factura.php?",
					data:"opc=17&id_cli=" + row.id_persona,
					success:function(response){
						var arr = response.split("|");
						var length = arr.length - 1;
						for(var i = 0; i < length ; i++) {
							var arr_1 = arr[i].split(";");
							var id = ltrim(arr_1[0]);
							var row_tmp = {
								id:id,
								tipo_num:arr_1[1],
								total:arr_1[2],
								pendiente: arr_1[2],
								fecha:arr_1[3],
								or_rem:arr_1[4]
							};
							dat_facturas.push(row_tmp);
						}
						var datainfo = {
							"total":0,
							"rows":dat_facturas
						};
						$("#facturas_table").datagrid('loadData',datainfo);
					}
				});
				$('#dialg_form_factura').dialog('open');
			}

			

			if(parseInt(row.tiene_ctacte) == 1 && (parseFloat(row.pendiente) >= parseFloat(row.limite_ctacte)) && row.limite_ctacte > 0){
                $("#msg_err").text("El cliente superó el límite de cuenta corriente asignado.");
                $("#dialg_error").dialog('open');
            }
		}
    });

    //abrir popup pendientes de cobro
    $('#link_pendientes').click(function(){
    	dat_remitos = [];
    	id_persona = $('#save_id_cliente').val();
    	$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Remito.php?",
			data:"opc=10&id_cli=" + id_persona,
			success:function(response){
				var arr = response.split("|");
				var length = arr.length - 1;
				for(var i = 0; i < length ; i++) {
					var yaesta = false;
					var arr_1 = arr[i].split(";");
					var id = ltrim(arr_1[0]);
					if(arr_1[1] == 'remito')
					{
						yaesta = yaCobrado($('#txt_idremitos').val(), id);
					}
					else
					{
						yaesta = yaCobrado($('#txt_idordenes').val(), id);
					}
					if(!yaesta)
					{
						var row_tmp = {
							tipo:arr_1[1],
							id:id,
							dominio:arr_1[2],
							total:arr_1[3],
							fecha:arr_1[4]
						};
						dat_remitos.push(row_tmp);
					}
				}
				var datainfo = {
					"total":0,
					"rows":dat_remitos
				};
				$("#remitos_table").datagrid('loadData',datainfo);
			}
		});
		$('#dialg_form').dialog('open');

    });

    function yaCobrado(str, val)
    {
    	var arr = str.split(',');
    	index = arr.indexOf(val.toString());
    	if(index >= 0){
    		return true;
    	}else {
    		return false;
    	}
    }


	$('#dialg_form').dialog({
		autoOpen: false,
		width: 500,
		height: 300,
		modal: true
	});

	$('#dialg_form_factura').dialog({
		autoOpen: false,
		width: 500,
		height: 300,
		modal: true
	});

	$('#dialg_form_2').dialog({
		autoOpen: false,
		width: 750,
		height: 300,
		modal: true
	});

	$('#dialg_open').dialog({
		autoOpen: false,
		width: 330,
		height: 120,
		modal: true
	});

	$("#btn_Detalle_cerrar").click(function(){
		 $('#dialg_form').dialog('close');
	});

	$("#btn_Detalle_cerrar_2").click(function(){
		 $('#dialg_form_2').dialog('close');
	});

	$("#btn_manoobra").click(function(){
		$("#dialg_manoobra").dialog('open');
	});

	$("#btn_manoobra2").click(function(){
		$("#dialg_manoobra2").dialog('open');
	});

	$("#btn_torneria").click(function(){
		$("#dialg_torneria").dialog('open');
	});

	$("#btn_Detalle_Ver").click(function() {
		$(".tag").remove();
		var row = $("#remitos_table").datagrid('getSelected');
		if(row == null) {
			return 0;
		}

		if(row.tipo == 'orden'){
			var id_orden=row.id;
			var url = "VIEW/WBuscarDetalleOrden.php?id_orden=" + id_orden;
		}else{
			var id_remi=row.id;
			var url = "VIEW/WBuscarDetalleRemito.php?id_remito=" + id_remi;
		}

		$('#table_detalle_remito_popup').dataTable({
			"bServerSide": false,
			"bFilter": false,
			"bJQueryUI": true,
			"bDestroy":true,
			"sAjaxSource": url,
		   "sPaginationType": "full_numbers",
			"sDom": '<"H"Tfr>t<"F"ip>',
			"oTableTools": {
				"aButtons": [
				]
			}
		});

		$('#dialg_form_2').dialog('open');
	});

	$("#btn_Detalle_Cobrar").click(function() {
		var row = $("#remitos_table").datagrid('getSelected');
		var index = dat_remitos.indexOf(row);
		var dominio = row.dominio;
		var prefijo = "";

		if(index!=-1) {
			dat_remitos.splice(index,1); // Remove it if really found!
		}
		var datainfo = {
			"total":0,
			"rows":dat_remitos
		};
		$("#remitos_table").datagrid('loadData',datainfo);

		//aca tenemos que llamar a la funcion que va a traer el detalle del remito y lo meterá en la factura
		if(row != null) {
			if(row.tipo == 'remito'){
				sumDetalleRemito(row.id);
				prefijo = "R-"+ row.id;
			}else if(row.tipo == 'orden'){
				sumDetalleOrden(row.id);
				prefijo = "OR-" + row.id;
			}
		}
		$("#txt_dominio_print").val(dominio);
		$("#save_orden_y_remito").val($("#save_orden_y_remito").val() + " " + prefijo);
		recalcularPrecios();
	});


	$('#remitos_table').datagrid({
		onDblClickRow:function(){
			var id=$(this).attr("id").replace("clsCobrar","");
			var row = $("#remitos_table").datagrid('getSelected');
			var index = dat_remitos.indexOf(row);
			var dominio = row.dominio;
			var prefijo = "";

			if(index!=-1) {
				dat_remitos.splice(index,1); // Remove it if really found!
			}
			var datainfo = {
				"total":0,
				"rows":dat_remitos
			};
			$("#remitos_table").datagrid('loadData',datainfo);

			//aca tenemos que llamar a la funcion que va a traer el detalle del remito y lo meterá en la factura
			if(row != null) {
				if(row.tipo == 'remito'){
					sumDetalleRemito(row.id);
					prefijo = "R-"+ row.id;
				}else if(row.tipo == 'orden'){
					sumDetalleOrden(row.id);
					prefijo = "OR-" + row.id;
				}
			}
			$("#txt_dominio_print").val(dominio);
			$("#save_orden_y_remito").val($("#save_orden_y_remito").val() + " " + prefijo);
			recalcularPrecios();

			return false;
		}
	});

	function sumDetalleOrden(id_orden) {

		var porctj = 0;
		var nuevo_porctj = parseFloat($("#txt_porcentaje").val());

		if(nuevo_porctj > 0 || nuevo_porctj < 0){ //si es diferente a 0 lo cambio sino dejo el 0%
			porctj = nuevo_porctj;
		}

		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Orden.php?",
			data:"opc=11&id_orden=" + id_orden,
			dataType:'json',
			success:function(response){
				var arr_det = response.detalle;
				for (var i = 0 ; i < arr_det.length ; i++) {
					var precio = parseFloat(arr_det[i]['precio_detord']);
					var precio_con_porcentaje = Math.round(parseFloat(precio+(precio*porctj/100)).toFixed(2));
//					var precio_con_porcentaje = Math.round(precio);
					var subtotal = precio_con_porcentaje * parseFloat(arr_det[i]['canti_detord']);

					var id = arr_det[i]['id_producto'];
					if(id == "0" && $("#importe_manoobra").val() != ""){
						id = "-2";
					}

					var tmp_row={
						id:id,
						codigo:arr_det[i]['nom_producto'],
						producto:arr_det[i]['descrip_producto'],
						precio:precio_con_porcentaje,
						precio_orig:arr_det[i]['precio_detord'],
						cantidad:arr_det[i]['canti_detord'],
						id_tipoiva:arr_det[i]['id_tipoiva'],
						total:subtotal,
						id_remi:0,
						id_orden:arr_det[i]['id_orden']
					};

					if($("#save_tipo_fact").val() == "B"){
//						tmp_row.precio 	= (arr_det[i]['precio_detord'] * 1.21).toFixed(2),
//						tmp_row.total	= (arr_det[i]['subtotal'] * 1.21).toFixed(2)
                        tmp_row.precio  = (tmp_row.precio * 1.21).toFixed(2);
                        tmp_row.total   = (tmp_row.total * 1.21).toFixed(2);
					}


					if(tmp_row.id == '0'){
						$("#importe_manoobra").val(tmp_row.precio);
						$("#descripcion_manoobra").val(tmp_row.producto);
						$("#txt_importe_manoobra").val(tmp_row.precio);
						$("#txt_descripcion_manoobra").val(tmp_row.producto);
					}

					if(tmp_row.id == '-2'){
						$("#importe_manoobra2").val(tmp_row.precio);
						$("#descripcion_manoobra2").val(tmp_row.producto);
						$("#txt_importe_manoobra2").val(tmp_row.precio);
						$("#txt_descripcion_manoobra2").val(tmp_row.producto);
					}

					if(tmp_row.id == '-1'){
						$("#importe_torneria").val(tmp_row.precio);
						$("#descripcion_torneria").val(tmp_row.producto);
						$("#txt_importe_torneria").val(tmp_row.precio);
						$("#txt_descripcion_torneria").val(tmp_row.producto);

					}

					dat.push(tmp_row);
				}
				reloadData();
				sumatoria();

				if(response._obs_orden != ""){
					$("#save_obs_fact").val($("#save_obs_fact").val() + ' '+ response._obs_orden);
				}
			}
		});


		var id_orden_tmp = $('#txt_idordenes').val();
		if(id_orden_tmp == "") {
			$('#txt_idordenes').val(id_orden);
		} else {
			$('#txt_idordenes').val(id_orden_tmp + ',' + id_orden);
		}
	}


	function sumDetalleRemito(id_remi) {
		var porctj = 0;
		var nuevo_porctj = parseFloat($("#txt_porcentaje").val());

		if(nuevo_porctj > 0 || nuevo_porctj < 0){ //si es diferente a 0 lo cambio sino dejo el 0%
			porctj = nuevo_porctj;
		}
		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Remito.php?",
			data:"opc=11&id_remi=" + id_remi,
			dataType:'json',
			success:function(response){
				if(response.obs_remi != ""){
					$("#save_obs_fact").val($("#save_obs_fact").val() + ' - ' + response.obs_remi);
				}

				var arr_det = response.detalle;
				for (var i = 0 ; i < arr_det.length ; i++) {
					var precio = parseFloat(arr_det[i]['precio_detremi']);
					var precio_con_porcentaje = Math.round(parseFloat(precio+(precio*porctj/100)).toFixed(2));
					var subtotal = precio_con_porcentaje * parseFloat(arr_det[i]['canti_detremi']);
					var tmp_row={
						id:arr_det[i]['id_producto'],
						codigo:arr_det[i]['nom_producto'],
						producto:arr_det[i]['descrip_producto'],
						precio:precio_con_porcentaje,
						precio_orig:arr_det[i]['precio_detremi'],
						cantidad:arr_det[i]['canti_detremi'],
						id_tipoiva:arr_det[i]['id_tipoiva'],
						total:subtotal,
						id_remi:arr_det[i]['id_remi']
					};

					if($("#save_tipo_fact").val() == "B"){
						tmp_row.precio 	= (precio_con_porcentaje * 1.21).toFixed(2),
						tmp_row.total	= (subtotal * 1.21).toFixed(2)
					}


					if(tmp_row.id == '0'){
						$("#importe_manoobra").val(tmp_row.precio);
						$("#descripcion_manoobra").val(tmp_row.producto);
						$("#txt_importe_manoobra").val(tmp_row.precio);
						$("#txt_descripcion_manoobra").val(tmp_row.producto);
					}

					dat.push(tmp_row);
				}
				reloadData();
				sumatoria();
			}
		});
		var id_remis_tmp = $('#txt_idremitos').val();
		if(id_remis_tmp == "") {
			$('#txt_idremitos').val(id_remi);
		} else {
			$('#txt_idremitos').val(id_remis_tmp + ',' + id_remi);
		}
	}

	$('#cmbgridProducto').combogrid({
		panelWidth:800,
		delay:300,
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
			{field:'stock_producto',title:'Stock',align:'right',width:60},
			{field:'id_tipoiva', title: 'IVA', align:'right', hidden:true}
		]],
		onSelect:function(rowData){
			var porctj = 0;
			var row =$('#cmbgridProducto').combogrid('grid').datagrid('getSelected');
			$("#txt_idproducto").val(row.id_producto);
			$("#txt_nom_producto").val(row.descrip_producto);
			$("#txt_cod_producto").val(row.nom_producto);
			$("#txt_tipoiva").val(row.id_tipoiva);
			var precio_limpio = parseFloat(row.pvp1_producto);
			var nuevo_porctj = parseFloat($("#txt_porcentaje").val());
			if(nuevo_porctj > 0 || nuevo_porctj < 0){ //si es superior a 0 lo cambio sino dejo el 0%
				porctj = nuevo_porctj;
			}
			var precio_nuevo = parseFloat(precio_limpio+(precio_limpio*porctj/100)).toFixed(2);

			$("#txt_precio").val(Math.round(precio_nuevo));
			$("#txt_cantidad").val(1);
			$("#txt_sub").val(Math.round(precio_nuevo));
			$("#txt_precio_limpio").val(precio_limpio);
		}
	});


	function recalcularPrecios(){
		var porctj = 0;
		var nuevo_porctj = parseFloat($("#txt_porcentaje").val()).toFixed(2);
		var id_condiva = $("#txt_id_condiva").val();

		if(nuevo_porctj > 0 || nuevo_porctj < 0){ //si es diferente a 0 lo cambio sino dejo el 0%
			porctj = nuevo_porctj;
		}
		var lng=dat.length;

		for(var t=0;t<lng;t++){
			if(dat[t]['id'] > 0){
				var precio_orig = parseFloat(dat[t]['precio_orig']);

				if(id_condiva == "1"){
					dat[t]['precio'] = parseFloat(precio_orig+(precio_orig*porctj/100)).toFixed(2);
				}
				else{
					if(dat[t]['id_tipoiva'] == '1'){
						dat[t]['precio'] = parseFloat((precio_orig+(precio_orig*porctj/100))*1.21).toFixed(2);
					}else{
						dat[t]['precio'] = parseFloat((precio_orig+(precio_orig*porctj/100))*1.21).toFixed(2);
					}
				}
				dat[t]['total'] = (dat[t]['precio']*dat[t]['cantidad']).toFixed(2);
			}
        }
		reloadData();
		sumatoria();
	};

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
                required: true,
                number: true
            },
            txt_cantidad: {
                required: true,
		number: true
//                digits: true
            },
            txt_sub: {
                required: true,
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


	var validator_addFactura = $("#frm_factura").validate({
        rules: {
            txt_apellidos_fact: {
                required: true
            },
            txt_ruc_fact: {
                required: false,
                minlength: 7,
                maxlength: 13
            },
            save_obs_fact: {
                required: false,
               minlength:5
            },
            save_num_fact: {
               required: true,
               number:true
            },
            save_percepcion:{
            	number:true
        	}

        },
        messages: {
            txt_apellidos_fact: "Requerido",
            txt_ruc_fact:"Requerido",
            save_obs_fact:"Ingrese el concepto de la compra",
            save_percepcion:"Debe ingresar un importe válido",
            save_num_fact: "Debe ingresar un número de factura válido"
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
            Factura_Add();
        },
        success: function(label) {
            label.html("&nbsp;").addClass("valid_small");
        }
    });

    $("#dialg_manoobra_close").click(function(){
		$('#dialg_manoobra').dialog('close');
	});

	$("#dialg_manoobra_close2").click(function(){
		$('#dialg_manoobra2').dialog('close');
	});

	$("#dialg_torneria_close").click(function(){
		$('#dialg_torneria').dialog('close');
	});

	//cerrar ventana de abrir orden
	$("#dialg_open_close").click(function(){
		$("#dialg_open").dialog('close');
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

	function addManoobra_to_detalle(mo) {
		//Vamos a ver si ya está agregado
		var existe = false;
        var lon=dat.length;
        for(var tk=0;tk<lon;tk++){
            if(dat[tk].id== mo){
              	dat.splice(tk,1);
              	break;
            }
        }


		var importe = 0;
		var producto = "";
		if(mo == 0){
	        importe = parseFloat($("#importe_manoobra").val());
	        producto = $("#descripcion_manoobra").val();
	    }else{
	    	importe = parseFloat($("#importe_manoobra2").val());
	    	producto = $("#descripcion_manoobra2").val();
	    }

        var tmp_row={
                id:mo,
                producto:producto,
                codigo:'MO',
                precio_orig:importe,
                precio: importe,
                cantidad:1,
                id_tipoiva:1,
                total:importe,
				id_remi: 0
        };

        if($("#save_tipo_fact").val() == "B"){
            tmp_row.precio 	= importe * 1.21,
            tmp_row.total	= importe * 1.21
        }

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

        if($("#save_tipo_fact").val() == "B"){
            tmp_row.precio 	= importe * 1.21,
            tmp_row.total	= importe * 1.21
        }

        dat.push(tmp_row);

        reloadData();
        sumatoria();
	}

	$("#save_percepcion").change(function(){
    	sumatoria();
    });



    $("#btn_AddProducto").click(function(){
        $("#frm_AddProducto").submit();
    });

    $("#btn_QuitarProducto").click(function(){
		Delete();
    });

    $("#btn_Factura_New").click(function(){
		vaciarVector();
		$("#frm_factura .form-field").val ("");
		$('.datepicker').datepicker('setDate', new Date());
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

    function Factura_Add(){

        var frmFactura=$("#frm_factura").serialize();
        $.ajax({
            type:"POST",
            url:"CONTROLLER/C_Factura.php?opc=1&"+frmFactura,
            data:({Detalle:dat}),
            dataType:'json',
            success:function(response){
            	if(response.error == 0){
					$('#txt_num_fact').val(response.numero);
					$('#txt_cae').val(response.cae);
					$('#txt_cae_vto').val(response.cae_vto);
					$('#txt_punto_de_venta').val(response.p_de_v);
               		$("#msg").text(response.txt);
                    $('#dialg_msg').dialog('open');
               		imprimir_automatico();
                }else{
                	$('#dialg_error').dialog('open');
                    $("#msg_err").text("ERROR AFIP: " + response.descripcion);
                }
            }
        });

    }

    $("#btn_Factura_Add").click(function(){
		$("#frm_factura").submit();
    });

    $("#btn_Factura_Print").click(function(){
		$("#txt_idremitos").val($("#save_orden_y_remito").val());
        imprimir_automatico();
    });

    //esta es la funcion que vamos a utilizar para imprimir de forma automatica.
    //genero el popup que es el que genera el archivo pdf en el servidor y lo cierro automaticamente
    function imprimir_automatico(){

    	var fo=getStringParsedToPrint();

        var windowSizeArray = [ "width=700,height=820","width=700,height=820,scrollbars=no" ];
        var numero			= $("#txt_num_fact").val();
        var fecha 			= $("#save_fecemi_fact").val();
        var cli				= $("#save_id_cliente").val();
        var total			= $("#total_fact").val();
        var descu			= $("#save_descto_fact").val();
		var cae				= $("#txt_cae").val();
		var cae_vto			= $("#txt_cae_vto").val();
		var p_de_v			= $("#txt_punto_de_venta").val();
        var tipo_doc        = $("#cmb_tipo_fact").val();

        if($("#save_tipo_fact").val() == "A"){
        	var iva10		= $("#iva105_fact").val();
			var iva21		= $("#iva21_fact").val();
			var sub			= $("#txt_temporal").val();
			var url			= "factura_a_afip.php";
			var tipofact	= "A";
		}else{
			var iva10		= '';
			var iva21		= '';
			var sub 		= $("#total_fact").val();
			var url			= "factura_b_afip.php";
			var tipofact	= "B";
		}

        //le agrego los 0 (ceros) necesarios al punto de venta
        if(p_de_v.length == 1){
            p_de_v = "000"+p_de_v;
        }else if(p_de_v.length == 2){
            p_de_v = "00"+p_de_v;
        }else{
            p_de_v = "0"+p_de_v;
        }

        //le agrego los 0 (ceros) necesarios al numero
        if(numero.length == 1){
            numero = "0000000"+numero;
        }else if(numero.length == 2){
            numero = "000000"+numero;
        }else if(numero.length == 3){
            numero = "00000"+numero;
        }else if(numero.length == 4){
            numero = "0000"+numero;
        }else if(numero.length == 5){
            numero = "000"+numero;
        }
/*
		//le agrego los 0 (ceros) necesarios al punto de venta
		if(p_de_v.length == 1){
			p_de_v = "00"+p_de_v;
		}else{
			p_de_v = "0"+p_de_v;
		}

		//le agrego los 0 (ceros) necesarios al numero
		if(numero.length == 1){
			numero = "00000"+numero;
		}else if(numero.length == 2){
			numero = "0000"+numero;
		}else if(numero.length == 3){
			numero = "000"+numero;
		}else if(numero.length == 4){
			numero = "00"+numero;
		}else if(numero.length == 5){
			numero = "0"+numero;
		}
*/
        var remis			= $("#txt_idremitos").val();
        var ordens			= $("#txt_idordenes").val();
        var forpago			= $("#cmb_forma_pago").val();
		var dominio			= $("#txt_dominio_print").val();
		var idvehiculo		= $("#txt_id_vehiculo").val();

		var obs				= $("#save_obs_fact").val();


        var windowName 		= "popUp";//$(this).attr("name");
        var windowSize		= windowSizeArray;
        var param			= "?&id_cliente="+cli+"&numero="+p_de_v+"-"+numero+"&fecha="+fecha+"&total="+total+"&descu="+descu+"&iva10="+iva10+"&iva21="+iva21;
        var param			= param + "&sub="+sub+"&remis="+remis+"&ordens="+ordens+"&detalle="+fo+"&forpago="+forpago+"&dominio="+dominio;
        var param			= param + "&tipo_fact="+tipofact+"&obs="+obs+"&cae="+cae+"&cae_vto="+cae_vto;
        var param           = param + "&tipo_doc="+tipo_doc;
        var win				= window.open(url+param, windowName, windowSize);


//setTimeout(function() {win.close();}, 4000);


    }



	function getStringParsedToPrint(){

		var lon=dat.length;
		var cade="";
        var aux=0;
        for(var tk=0;tk<lon;tk++){

        	//Essto lo hago solo para poder imprimir la mano de obra completa
        	var producto = dat[tk].producto;
        	if(dat[tk].id == '0')
        		var producto =  $("#txt_descripcion_manoobra").val();
        		if(dat[tk].id == '-2')
        		var producto =  $("#txt_descripcion_manoobra2").val();
        	if(dat[tk].id == '-1')
        		var producto = $("#txt_descripcion_torneria").val();

			cade=cade+dat[tk].id+"|"+dat[tk].codigo+"|"+producto+"|"+dat[tk].precio+"|"+dat[tk].cantidad+"|"+dat[tk].total+"^";
        }
        cade=cade.toString().substr(0, cade.length-1);
        return cade;
	}

    //Documentación: Nombres que debe tener las cajas de texto para Actualizar.

    // update_id_fact .
    // update_id_empresa .
    // update_id_cliente .
    // update_id_vendedor .
    // update_descto_fact .
    // update_obs_fact .
    // update_fecemi_fact .
    // update_estado_fact .



    //Documentación: Nombres que debe tener la caja de texto para Delete.

    // delete_id_fact .

    $("#btn_Factura_Delete").click(function(){

        //nombre del formulario: frmFactura_Delete

        var id_fact=$("#delete_id_fact").val();
        var frmFactura="delete_id_fact="+id_fact+"&opc=3";
        $.ajax({
            type:"POST",
            url:"Controller/C_factura.php",
            data:frmFactura,
            success:function(response){

            }
        });
    });

    //para ver una factura ya emitida
    $(".clsMatrizVer").livequery("click", function(e){
		$(".tag").remove();
		vaciarVector();
		$("#frm_factura .form-field").val ("");
		var id_fact=$(this).attr("id").replace("btn_detalle","");

        var frmfact="id_fact="+id_fact+"&opc=13";
        $.ajax({
            type:"POST",
            url:"CONTROLLER/C_Factura.php",
            data:frmfact,
            dataType:'json',
            success:function(response){

            	if(response._tipo_fact == "1")
                	$("#save_tipo_fact").val('A');
                else
                	$("#save_tipo_fact").val('B');

                if(response._nota_credito == "1")
                    $("#cmb_tipo_fact").val(2);
                else if(response._nota_debito == "1")
                    $("#cmb_tipo_fact").val(3);
                else
                    $("#cmb_tipo_fact").val(1);


				$("#cmb_forma_pago").val(response._forma_pago);
				$("#txt_id_fact").val(response._id_fact);
				$("#save_id_cliente").val(response._id_cliente);
                $("#txt_num_fact").val(response._num_fact);
                $("#txt_apellido_fact").val();
                $("#txt_ruc_fact").val();
                $("#save_obs_fact").val(response._obs_fact);
                $("#save_fecemi_fact").val(response._fecemi_fact);
                $("#txt_apellidos_fact").val(response.cliente._nom_persona);
                $("#txt_ruc_fact").val(response.cliente._ruc_persona);
                $("#save_percepcion").val(response._percepcion_fact);
                $("#save_orden_y_remito").val(response._or_y_remito_fact);

                $("#txt_importe_torneria").val(response.importe_TO);
				$("#txt_descripcion_torneria").val(response.descripcion_TO);
				$("#txt_importe_manoobra").val(response.importe_MO);
				$("#txt_descripcion_manoobra").val(response.descripcion_MO);
				$("#txt_importe_manoobra2").val(response.importe_MO2);
				$("#txt_descripcion_manoobra2").val(response.descripcion_MO2);

				$("#txt_dominio_print").val(response.dominio);

				$("#txt_cae").val(response._nro_cae);
				$("#txt_cae_vto").val(response._cae_vto);
				$("#txt_punto_de_venta").val(response._punto_de_venta)

				if(response._descto_fact != "0.00"){
					var desc = parseFloat(response._descto_fact);
					var tot = parseFloat(response._total_fact);
					var iva21 = parseFloat(response._iva21_fact);
					var iva105 = parseFloat(response._iva105_fact);

					var porce_descto = desc * 100 / (tot - iva21 - iva105 + desc);
					porce_descto = porce_descto.toFixed(2);

					$("#cmbDescto").val(porce_descto);
				}
				var portj = 0;
//				if(response._estado_fact == 1)
//					portj = parseFloat(response.porcentaje);

				$.each(response.detalle, function(i, item) {

					if(parseInt(item._id_producto) > 0){
						precio=parseFloat(item._precio_detfact)+((parseFloat(item._precio_detfact)*portj)/100);
					}else{
						precio = item._precio_detfact;
					}

					canti=parseInt(item._canti_detfact);
					subt=parseFloat(canti*precio);

					if(item._id_producto == '0'){
						if(response._tipo_fact != "1"){
                            precio = parseFloat(precio*1.21);
                        }
						$("#txt_importe_manoobra").val(precio);
						$("#txt_descripcion_manoobra").val(item._descrip_producto);
						$("#importe_manoobra").val(precio);
						$("#descripcion_manoobra").val(item._descrip_producto);
					}
					if(item._id_producto == '-2'){
						if(response._tipo_fact != "1"){
							precio = parseFloat(precio*1.21);
						}
						$("#txt_importe_manoobra2").val(precio);
						$("#txt_descripcion_manoobra2").val(item._descrip_producto);
						$("#importe_manoobra2").val(precio);
						$("#descripcion_manoobra2").val(item._descrip_producto);
					}
					if(item._id_producto == '-1'){
						if(response._tipo_fact != "1"){
	                  		precio = parseFloat(precio*1.21);
                        }
						$("#txt_importe_torneria").val(precio);
						$("#txt_descripcion_torneria").val(item._descrip_producto);
						$("#importe_torneria").val(precio);
						$("#descripcion_torneria").val(item._descrip_producto);
					}

					var tmp_row={
						id:item._id_producto,
						codigo:item._nom_producto,
						producto:item._descrip_producto,
						precio:precio,
						cantidad:canti,
						id_tipoiva:item._id_tipoiva,
						total:subt
					};
					dat.push(tmp_row);
				});


				$(".tabs").tabs('select','#tabs-1');

				reloadData();
				sumatoria();

				$("#btn_Factura_Add").hide();
   				$("#btn_Factura_Print").show();
//   				if(response._estado_fact != "3")
//	   				$("#btn_Factura_Cancel").show();
            }
		});

	});

	$("#btn_Factura_Cancel").click(function(){
//		$("#dialg_open").dialog('open');
	});


    //para cobrar una factura
    $(".clsMatrizCobrar").livequery("click", function(e){
		var id_fact=$(this).attr("id").replace("btn_cobrar","");
		$("#save_cobro_id_fact").val(id_fact);

		$("#dialg_cobrar").dialog('open');
	});


	$('#btn_cobro_cobrar').click(function() {
		var id_fact = $("#save_cobro_id_fact").val();
		var forma_pago = $("#cmb_cobro_forma_de_pago").val();
		var frmfact="id_fact="+id_fact+"&forma_pago="+forma_pago+"&opc=14";
        $.ajax({
            type:"POST",
            url:"CONTROLLER/C_Factura.php",
            data:frmfact,
            dataType:'json',
            success:function(response){
				location.reload();
            	$(".tabs").tabs('select','#tabs-2');
            }
		});
	});

	$("#dialg_open_acept").click(function(){
		var clave_usuario = $("#clave_usuario").val();

		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Persona.php?",
			data:"opc=28&clave="+clave_usuario,
			success:function(response){
				if(response == 1){
					var id_fact = $("#txt_id_fact").val();
					$.ajax({
						type:"POST",
						url:"CONTROLLER/C_Factura.php?",
						data:"opc=16&id_fact="+id_fact,
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


	//ltrim quita los espacios o caracteres indicados al inicio de la cadena
	function ltrim(str, chars) {
		chars = chars || "\\s";
		return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
	}


});
