$(document).ready(function(){
 	var cont=0;
 	var dat_fact=[];//modelo del grid
	var dat_fact_prov=[];
 	var dat_cheques=[];
 	var dat_retencion=[];
 	var dat_facturas=[];
	var dat_facturas_proveedor=[];
 	var dat_transferencias=[];
 	var total_iva=0;

 	$('#link_pendientes').hide();
 	$('#link_ultimas').hide();
 	$('#btn_Recibo_Print').hide();
	$('#btn_Recibo_Open').hide();

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
        "sAjaxSource": "VIEW/WBuscarRecibo.php?",
        "sPaginationType": "full_numbers",
        "aaSorting": [[ 0, "desc" ]], // para ordenarlos por default
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "xls", "pdf"
            ]
        }
    });

	$('#tt').datagrid('reloadFooter',[  //inicio foter del datagrid
		{cantidad:"Total : ",total: 0}
	]);

	$('#ttc').datagrid('reloadFooter',[  //inicio foter del datagrid
		{cantidad:"Total : ",total: 0}
	]);

    $(".datepicker").datepicker();
    $('.datepicker').datepicker('option', {dateFormat: 'dd-mm-yy'});
    //carga la fecha actual
    $('.datepicker').datepicker('setDate', new Date());


	function reloadData(){
        var datainfo = {
            "total":0,
            "rows":dat_fact
        };
        $('#tt').datagrid('loadData', datainfo);
    }

	function reloadDataProv(){
        var datainfo = {
            "total":0,
            "rows":dat_fact_prov
        };
        $('#ttp').datagrid('loadData', datainfo);
    }

    function reloadDataCheque(){
        var datainfoc = {
            "total":0,
            "rows":dat_cheques
        };
        $('#ttc').datagrid('loadData', datainfoc);
    }

    function reloadDataRetencion(){
        var datainfoc = {
            "total":0,
            "rows":dat_retencion
        };
        $('#ttr').datagrid('loadData', datainfoc);
    }

    function reloadDataTransferencia(){
        var datainfoc = {
            "total":0,
            "rows":dat_transferencias
        };
        $('#ttt').datagrid('loadData', datainfoc);
    }

	function vaciarVector(){
		dat_fact=[];
		dat_fact_prov=[];
		dat_cheques=[];
		dat_retencion=[];
		dat_facturas=[];
		fat_facturas_proveedor=[];
		dat_transferencias=[];
		cont=0;
		reloadData();
		reloadDataProv();
		sumatoriaProv();
		reloadDataCheque();
		sumatoriaCheque();
		reloadDataTransferencia();
		sumatoriaTransferencia();
		reloadDataRetencion();
		sumatoriaRetencion();
		sumatoria();

		sumatoriaTotal();
		$("#total_remito").empty();
	}

	function sumatoria(){//total de footer
        var tl=$("#tt").datagrid('getRows');
        var lng=tl.length;
        var sum=0;

        for(var t=0;t<lng;t++){
            //              var ret=tl[i]['producto'];
            sum=sum + parseFloat(tl[t]['total']);
        }

        $('#tt').datagrid('reloadFooter',[
           {cantidad:"Total : ",total: sum.toFixed(2)}
        ]);
    }

    function sumatoriaCheque(){//total de footer
        var tl=$("#ttc").datagrid('getRows');
        var lng=tl.length;
        var sum=0;
//        var efect = $("#save_efectivo_recibo").val();
//        if(efect == "")
//        	efect  = 0;
//        efect = parseFloat(efect);

        for(var t=0;t<lng;t++){
            //              var ret=tl[i]['producto'];
            sum=sum + parseFloat(tl[t]['monto']);
        }
        var toto = 0;
        var toto = sum; // + efect;

        $("#total_cheques").empty();
        $("#total_cheques").append("<b>"+toto.toFixed(2)+"</b>");
        $("#save_total_cheque").val(toto.toFixed(2));

        sumatoriaTotal();
    }

	function sumatoriaProv(){//total de footer
        var tl=$("#ttp").datagrid('getRows');
        var lng=tl.length;
        var sum=0;

        for(var t=0;t<lng;t++){
            sum=sum + parseFloat(tl[t]['total']);
        }
        var toto = 0;
        var toto = sum; // + efect;

        $("#total_proveedor").empty();
        $("#total_proveedor").append("<b>"+toto.toFixed(2)+"</b>");
        $("#save_total_proveedor").val(toto.toFixed(2));

        sumatoriaTotal();
    }

    function sumatoriaRetencion(){//total de footer
        var tl=$("#ttr").datagrid('getRows');
        var lng=tl.length;
        var sum=0;

        for(var t=0;t<lng;t++){
            sum=sum + parseFloat(tl[t]['monto']);
        }
        var toto = 0;
        var toto = sum;

        $("#total_retencion").empty();
        $("#total_retencion").append("<b>"+toto.toFixed(2)+"</b>");
        $("#save_total_retencion").val(toto.toFixed(2));

        sumatoriaTotal();
    }

    function sumatoriaTransferencia(){//total de footer
        var tl=$("#ttt").datagrid('getRows');
        var lng=tl.length;
        var sum=0;

        for(var t=0;t<lng;t++){
            sum=sum + parseFloat(tl[t]['monto']);
        }
        var toto = 0;
        var toto = sum;

        $("#total_transferencias").empty();
        $("#total_transferencias").append("<b>"+toto.toFixed(2)+"</b>");
        $("#save_total_transferencia").val(toto.toFixed(2));

        sumatoriaTotal();
    }

    function sumatoriaTotal(){
    	var cheque 		= parseFloat($("#save_total_cheque").val());
    	if($("#save_total_cheque").val() == "") cheque = 0;
    	var retencion	= parseFloat($("#save_total_retencion").val());
    	if($("#save_total_retencion").val() == "") retencion = 0;
    	var efectivo 	= parseFloat($("#save_efectivo_recibo").val());
    	if($("#save_efectivo_recibo").val() == "") efectivo = 0;
    	var transfer 	= parseFloat($("#save_total_transferencia").val());
    	if($("#save_total_transferencia").val() == "") transfer = 0;
		var proveedor 	= parseFloat($("#save_total_proveedor").val());
    	if($("#save_total_proveedor").val() == "") proveedor = 0;
		var saldo		= parseFloat($("#save_saldo_recibo").val());
        if($("#save_saldo_recibo").val() == "") saldo = 0;

    	var total = cheque + retencion + efectivo + transfer + proveedor + saldo;

    	$("#save_total_recibo").val(total.toFixed(2));
    	$("#total_remito").empty();
        $("#total_remito").append("<b>"+total.toFixed(2)+"</b>");

        if($("#save_id_recibo").val() == 0){
        	calcularRecibo();
        }
    }

	function calcularRecibo(){
		var ln_fact = dat_fact.length;
		var total_recibo = parseFloat($("#save_total_recibo").val());

		for(var i=0 ; i < ln_fact ; i++){
			if(total_recibo > 0){
				if(dat_fact[i]['total'] <= total_recibo ){
					dat_fact[i]['pendiente'] = 0;
					total_recibo = total_recibo - parseFloat(dat_fact[i]['total']);
				}else{
					dat_fact[i]['pendiente'] = (parseFloat(dat_fact[i]['total']) - total_recibo).toFixed(2);
					total_recibo = 0;
				}
			}else{
				dat_fact[i]['pendiente'] = dat_fact[i]['total'];
			}
		}
        $("#save_saldo_para_proveedor").val(0);
        if(total_recibo > 0){
            $("#save_saldo_para_proveedor").val(parseFloat(total_recibo));
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

	$('#dialg_form').dialog({
		autoOpen: false,
		width: 500,
		height: 300,
		modal: true
	});

	$('#dialg_factura_proveedor').dialog({
		autoOpen: false,
		width: 400,
		height: 300,
		modal: true
	});

	$('#dialg_form_cheque').dialog({
		autoOpen: false,
		width: 500,
		height: 400,
		modal: true
	});

	$('#dialg_reten').dialog({
		autoOpen: false,
		width: 250,
		height: 250,
		modal: true
	});

	$('#dialg_transferencia').dialog({
		autoOpen: false,
		width: 250,
		height: 250,
		modal: true
	});


	$('#error_msg').dialog({
		autoOpen: false,
		width: 460,
		height: 140,
		modal: true
	});

	$('#dialg_open').dialog({
		autoOpen: false,
		width: 330,
		height: 120,
		modal: true
	});

	$('#dial_msg_close').click(function() {
		$('#dialg_msg').dialog('close');
		location.reload();
	});

	$("#error_msg_close").click(function(){
		$('#error_msg').dialog('close');
	});

	$("#btn_Detalle_cerrar").click(function(){
		 $('#dialg_form').dialog('close');
	});

	$("#btn_Detalle_cerrar_Factura_Proveedor").click(function(){
		 $('#dialg_factura_proveedor').dialog('close');
	});

	$("#btn_Retencion_Cerrar").click(function(){
		 $('#dialg_reten').dialog('close');
	});

	$("#btn_Transferencia_Cerrar").click(function(){
		 $('#dialg_transferencia').dialog('close');
	});

	//cerrar ventana de abrir orden
	$("#dialg_open_close").click(function(){
		$("#dialg_open").dialog('close');
	});

	$('#cmbgridCliente').combogrid({
		panelWidth:500,
		url: 'CONTROLLER/C_Persona.php?opc=30',
		idField:'id_persona',
		textField:'nom_persona',
		mode:'remote',
		fitColumns:true,
		columns:[[
			{field:'id_persona',title:'Id',width:20},
			{field:'nom_persona',title:'Razón social',align:'right',width:100},
			{field:'ruc_persona',title:'CUIT',align:'right',width:100},
			{field:'pendientes',title:'Fx pendientes.',align:'right',width:30},
			{field:'saldo',title:'Saldo.',align:'right',width:30},
		]],
		onSelect:function(rowData){
			var row =$('#cmbgridCliente').combogrid('grid').datagrid('getSelected');
			$("#txt_cliente").val(row.nom_persona);
			$("#txt_cuit").val(row.ruc_persona);
			$("#save_id_cliente").val(row.id_persona);
			$("#save_saldo_recibo").val(row.saldo);

			//blanqueo la grilla de facturas
			dat_fact = [];
			reloadData();
			sumatoria();


			dat_facturas = [];
			if(row.pendientes > 0) {
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
				$('#dialg_form').dialog('open');

				$('#link_pendientes').show();
				$("#link_ultimas").show();
			}
			else {
				$('#link_pendientes').hide();
				$('#link_ultimas').show();
			}
		}
    });

    //abrir popup pendientes de cobro
    $('#link_pendientes').click(function(){
    	var id_persona = $("#save_id_cliente").val();
		dat_facturas = [];
		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Factura.php?",
			data:"opc=17&id_cli=" + id_persona,
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
						pendiente:arr_1[2],
						fecha:arr_1[3],
						or_rem:arr_1[4]
					};

					if($.grep(dat_fact, function(e){ return e.id == id; }) == 0)
						dat_facturas.push(row_tmp);
				}
				var datainfo = {
					"total":0,
					"rows":dat_facturas
				};
				$("#facturas_table").datagrid('loadData',datainfo);
			}
		});
		$('#dialg_form').dialog('open');

    });

	//abrir popup pendientes de cobro
    $('#link_nuevoFacturaProveedor').click(function(){
    	var id_persona = $("#save_id_cliente").val();
		if(id_persona > 0){
			dat_facturas_proveedor = [];
			$.ajax({
				type:"POST",
				url:"CONTROLLER/C_Compra.php?",
				data:"opc=15&id_cli=" + id_persona,
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
							fecha:arr_1[3]
						};

						if($.grep(dat_fact_prov, function(e){ return e.id == id; }) == 0)
							dat_facturas_proveedor.push(row_tmp);
					}
					var datainfo = {
						"total":0,
						"rows":dat_facturas_proveedor
					};
					$("#facturas_table_proveedor").datagrid('loadData',datainfo);
				}
			});
			$('#dialg_factura_proveedor').dialog('open');
		}

    });

    //abrir popup pendientes de cobro
    $('#link_ultimas').click(function(){
    	var id_persona = $("#save_id_cliente").val();
		dat_facturas = [];
		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Factura.php?",
			data:"opc=18&id_cli=" + id_persona,
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
						pendiente:arr_1[2],
						fecha:arr_1[3],
						or_rem:arr_1[4]
					};

					if($.grep(dat_fact, function(e){ return e.id == id; }) == 0)
						dat_facturas.push(row_tmp);
				}
				var datainfo = {
					"total":0,
					"rows":dat_facturas
				};
				$("#facturas_table").datagrid('loadData',datainfo);
			}
		});
		$('#dialg_form').dialog('open');

    });


    $("#btn_Detalle_Cobrar").click(function() {
		var row = $("#facturas_table").datagrid('getSelected');
		var index = dat_facturas.indexOf(row);
		var prefijo = "";

		if(index!=-1) {
			dat_facturas.splice(index,1); // Remove it if really found!

			row['check'] = '<input type="button" id="btn_delete_fact'+row['id']+'" class="clsBorrar" value="X"/>';

			dat_fact.push(row);
			reloadData();
			sumatoria();
		}

		var datainfo = {
			"total":0,
			"rows":dat_facturas
		};
		$("#facturas_table").datagrid('loadData',datainfo);

		sumatoriaTotal();
		calcularRecibo();
	});


$('#facturas_table').datagrid({
		onDblClickRow:function(){



		}
	});

	$('#facturas_table').datagrid({
		onDblClickRow:function(){
			var row = $("#facturas_table").datagrid('getSelected');
			var index = dat_facturas.indexOf(row);
			var prefijo = "";

			if(index!=-1) {
				dat_facturas.splice(index,1); // Remove it if really found!

				row['check'] = '<input type="button" id="btn_delete_fact'+row['id']+'" class="clsBorrar" value="X"/>';

				dat_fact.push(row);
				reloadData();
				sumatoria();
			}

			var datainfo = {
				"total":0,
				"rows":dat_facturas
			};
			$("#facturas_table").datagrid('loadData',datainfo);

			sumatoriaTotal();
			calcularRecibo();
		}
	});


	$("#btn_Detalle_Cobrar_Factura_Proveedor").click(function() {
		var row = $("#facturas_table_proveedor").datagrid('getSelected');
		var index = dat_facturas_proveedor.indexOf(row);
		var prefijo = "";

		if(index!=-1) {
			dat_facturas_proveedor.splice(index,1); // Remove it if really found!

			row['check'] = '<input type="button" id="btn_delete_fact_prov'+row['id']+'" class="clsBorrarProveedor" value="X"/>';

			dat_fact_prov.push(row);
		}

		var datainfo = {
			"total":0,
			"rows":dat_facturas_proveedor
		};
		$("#facturas_table_proveedor").datagrid('loadData',datainfo);

		reloadDataProv();
		sumatoriaProv();
//		calcularRecibo();
	});

	$(".clsBorrar").livequery("click", function(e){
		var idf=$(this).attr("id").replace("btn_delete_fact","");
		for (var i =0; i < dat_fact.length; i++){
		   	if (dat_fact[i].id === idf) {
			  	dat_fact.splice(i,1);
			  	break;
	   		}
	   	}
		reloadData();
		sumatoria();
//		calcularRecibo();
	});

	$(".clsBorrarProveedor").livequery("click", function(e){
		var idf=$(this).attr("id").replace("btn_delete_fact_prov","");
		for (var i =0; i < dat_fact_prov.length; i++){
		   	if (dat_fact_prov[i].id === idf) {
			  	dat_fact_prov.splice(i,1);
			  	break;
	   		}
	   	}
		reloadDataProv();
		sumatoriaProv();
//		calcularRecibo();
	});

	$(".clsBorrarCheque").livequery("click", function(e){
		var numero=$(this).attr("id").replace("btn_delete_cheque","");
		for (var i =0; i < dat_cheques.length; i++){
		   	if (dat_cheques[i].numero === numero) {
			  	dat_cheques.splice(i,1);
			  	break;
	   		}
	   	}
		reloadDataCheque();
		sumatoriaCheque();
	});

	$(".clsBorrarRetencion").livequery("click", function(e){
		var numero=$(this).attr("id").replace("btn_delete_reten","");
		for (var i =0; i < dat_retencion.length; i++){
		   	if (dat_retencion[i].numero === numero) {
			  	dat_retencion.splice(i,1);
			  	break;
	   		}
	   	}
		reloadDataRetencion();
		sumatoriaRetencion();
	});

	$(".clsBorrarTransferencia").livequery("click", function(e){
		var numero=$(this).attr("id").replace("btn_delete_transferencia","");
		for (var i =0; i < dat_transferencias.length; i++){
		   	if (dat_transferencias[i].numero === numero) {
			  	dat_transferencias.splice(i,1);
			  	break;
	   		}
	   	}
		reloadDataTransferencia();
		sumatoriaTransferencia();
	});

	var validator_addRecibo = $("#frm_recibo").validate({
        rules: {
            save_obs_recibo: {
                required: false
            },
            save_num_recibo: {
               	required: true
            },
            txt_cliente:{
            	required: true
            }
        },
        messages: {
            save_num_recibo:"Requerido",
            txt_cliente: "Requerido"
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
            Recibo_Add();
        },
        success: function(label) {
            label.html("&nbsp;").addClass("valid_small");
        }
    });

    $("#btn_Recibo_New").click(function(){
       vaciarVector();
	   $("#frm_recibo .form-field").val ("");
	   vaciarCampos();
	   $("#btn_Recibo_Add").show();
	   $("#btn_Recibo_Open").hide();
	   $('.datepicker').datepicker('setDate', new Date());
	   $("#save_recibo_local").removeAttr('checked');
	   $("#btn_Recibo_Print").hide();
	   $("#tipo_guardar").val('nuevo');
	});

	$("#save_recibo_local").change(function(){
		if($(this).attr("checked")){
			$("#btn_Recibo_Print").show();
			$.ajax({
				type:"POST",
				url:"CONTROLLER/C_Recibo.php?opc=17",
				dataType:'json',
				success:function(response){
					$("#save_num_recibo").val(response);
					$("#save_num_recibo").prop('readonly', true);
				}
			});
		}else{
			$("#btn_Recibo_Print").hide();
			$("#save_num_recibo").prop('readonly', false);
			$("#save_num_recibo").val("");
		}
	});

	function vaciarCampos(){
		$('#cmbgridCliente').combogrid('clear');
		$('#save_id_cliente').val('');
	}

	$("#link_nuevoCheque").click(function(){
		$('#dialg_form_cheque').dialog('open');
	});

	$("#link_nuevaRetencion").click(function(){
		$('#dialg_reten').dialog('open');
	});

	$("#link_nuevaTransferencia").click(function(){
		$('#dialg_transferencia').dialog('open');
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

    function Recibo_Add(){
			/*
					validador= validarCombos();
					var opc = 1;
					if(validador == 'C'){
			*/

			if($("#tipo_guardar").val() == "nuevo"){
				opc = 1;
			}else{
				opc = 20;
			}

			var frmRecibo=$("#frm_recibo").serialize();

			$.ajax({
				type:"POST",
				url:"CONTROLLER/C_Recibo.php?opc="+opc+"&"+frmRecibo,
				data:({cheques: dat_cheques,facturas: dat_fact, retenciones: dat_retencion, transferencias: dat_transferencias, fact_prov: dat_fact_prov}),
				dataType:'json',
				success:function(response){
					$('#dialg_msg').dialog('open');
					$("#msg").text(response.txt);

					//Vaciamos todo para que un nuevo recibo
					vaciarVector();
					$("#frm_recibo .form-field").val ("");
					vaciarCampos();
				}
			});
/*
		}else{
			$('#error_msg').dialog('open');
			$("#msg_err").text("Debe completar los campos: " + validador);
		}
*/
    }

    $("#btn_Recibo_Add").click(function(){
        $("#frm_recibo").submit();
    });

	//Con este vamos ver un recibo
	$(".clsMatrizVer").livequery("click", function(e){
		vaciarCampos();
		vaciarVector();
		$(".tag").remove();
		var idremi=$(this).attr("id").replace("btn_detalle","");

            var frmremi="id_recibo="+idremi+"&opc=13";
            $.ajax({
                type:"POST",
                url:"CONTROLLER/C_Recibo.php",
                data:frmremi,
                dataType:'json',
                success:function(response){
//					response = eliminaNull(response);
					$("#save_id_recibo").val(response.id_recibo);
					$("#save_num_recibo").val(response.num_recibo);
					$("#save_fecemi_recibo").val(response.fecha_recibo);
					$("#txt_cliente").val(response.nom_persona + '-' + response.ape_persona);
					$("#save_id_cliente").val(response.id_cliente);
					$("#txt_cuit").val(response.ruc_persona);
					$("#save_obs_recibo").val(response.obs_recibo);
					$("#save_efectivo_recibo").val(response.efectivo_recibo);
					$("#save_saldo_recibo").val(response.saldo_a_favor);
                    $("#save_id_responsable").val(response.id_responsable);
					if(response.tipo_recibo == "2")
						$("#save_recibo_local").attr("checked", "checked") ;

					//facturas
					$.each(response.facturas, function(i, item) {
						total=parseFloat(item.monto_fact);
						saldo=parseFloat(item.saldo_fact);

						var tmp_row={
							id:item.id_fact,
							tipo_num:item.num_fact,
							fecha:item.fecha,
							total:total,
							pendiente:saldo,
							check:'<input type="button" id="btn_delete_fact'+item.id_fact+'" class="clsBorrar" value="X"/>'
						};
						dat_fact.push(tmp_row);
    				});
    				sumatoria();
					reloadData();

					//facturas	proveedor
					$.each(response.facturas_prov, function(i, item) {
						total=parseFloat(item.monto_fact);

						var tmp_row={
							id:item.id_fact,
							tipo_num:item.num_fact,
							fecha:item.fecha,
							total:total,
							check:'<input type="button" id="btn_delete_fact_prov'+item.id_fact+'" class="clsBorrarProveedor" value="X"/>'
						};
						dat_fact_prov.push(tmp_row);
    				});
    				sumatoriaProv();
					reloadDataProv();

    				//cheques
    				$.each(response.cheques, function(i, item) {
						total=parseFloat(item.monto_cheque);

						var tmp_row={
							numero:item.num_cheque,
							banco:item.banco_cheque	,
							fecha:item.fecha,
							monto:total,
							estado:item.estado_cheque,
							propie:item.propietario,
							cuit_propie:item.cuit_propietario,
							obs:item.obs_cheque,
							check:'<input type="button" id="btn_delete_cheque'+item.num_cheque+'" class="clsBorrarCheque" value="X"/>'
						};
						dat_cheques.push(tmp_row);
    				});
    				reloadDataCheque();
					sumatoriaCheque();

    				//retenciones
    				$.each(response.retenciones, function(i, item) {
						total=parseFloat(item.monto);

						var tmp_row={
							numero:item.numero,
							tipo:item.tipo,
							monto:total,
							check:'<input type="button" id="btn_delete_reten'+item.numero+'" class="clsBorrarRetencion" value="X"/>'
						};
						dat_retencion.push(tmp_row);
    				});
    				reloadDataRetencion();
					sumatoriaRetencion();

    				//transferencias
    				$.each(response.transferencias, function(i, item) {
						total=parseFloat(item.monto);
						var del = i+1;
						var tmp_row={
							numero:item.num_transferencia,
							monto:total,
							check:'<input type="button" id="btn_delete_transferencia'+item.num_transferencia+'" class="clsBorrarTransferencia" value="X"/>'
						};
						dat_transferencias.push(tmp_row);
    				});
    				reloadDataTransferencia();
					sumatoriaTransferencia();

					$("#btn_Recibo_Add").hide();
					$("#btn_Recibo_Open").show();
					$("#btn_Recibo_Print").show();
					$(".tabs").tabs('select','#tabs-1');

                }
		});

	});

	//NUEVO CHEQUE

	var validator_addCheque = $("#frm_cheque").validate({
        rules: {
        	save_num_cheque: {
        		required: true,
        		minlength:5
        	},
        	save_monto_cheque: {
        		required: true,
        		number:true,
        		minlength: 2
        	},
        	save_fecpago_cheque:{
        		required: true,
        		minlenth:8
        	},
            save_banco_cheque: {
                required: true,
            	minlength:2
            },
            save_obs_cheque: {
            	required: false
            }

        },
        messages: {
            save_num_cheque:"Requerido",
            save_monto_cheque:"Requerido",
            save_fecpago_cheque:"Requerido",
            save_banco_cheque:"Requerido"

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
            Cheque_Add();
        },
        success: function(label) {
            label.html("&nbsp;").addClass("valid_small");
        }
    });

    function Cheque_Add(){

    	$.ajax({
			type:"POST",
			data:"&numero=" + $("#save_num_cheque").val() + "&banco=" + $("#save_banco_cheque").val(),
			url:"CONTROLLER/C_Cheque.php?opc=16",
			success:function(response){
				if(response == 1){
					alert("Número de cheque y banco existente en el sistema");
				}else{
					var che = new Object();

			    	che.numero 	= $("#save_num_cheque").val();
			    	che.monto	= $("#save_monto_cheque").val();
			    	che.fecha	= $("#save_fecpago_cheque").val();
			    	che.estado	= $("#save_estado_cheque").val();
			    	che.banco	= $("#save_banco_cheque").val();
			    	che.propie	= $("#save_propietario_cheque").val();
			    	che.cuit_propie	= $("#save_cuit_propie_cheque").val();
			    	che.obs		= $("#save_obs_cheque").val();
			    	che.check 	= '<input type="button" id="btn_delete_cheque'+che.numero+'" class="clsBorrarCheque" value="X"/>';

			    	dat_cheques.push(che);
			    	reloadDataCheque();
			    	sumatoriaCheque();

			    	$("#frm_cheque .form-field").val ("");
			    	$("#dialg_form_cheque").dialog('close');
				}
			}
		});
    }

    $("#btn_Cheque_Add").click(function(){
    	$("#frm_cheque").submit();
    });

    //FIN GUARDAR CHEQUE


    //NUEVA RETENCION

	var validator_addRetencion = $("#frm_retencion").validate({
        rules: {
        	txt_id_tiporeten: {
        		required: true
        	},
        	txt_reten_importe: {
        		required: true,
        		number:true,
        		minlength: 1
        	},
        	txt_reten_numero: {
        		required: false
        	}
        },
        messages: {
            txt_id_tiporeten:"Requerido",
            txt_reten_importe:"Requerido"

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
            Retencion_Add();
        },
        success: function(label) {
            label.html("&nbsp;").addClass("valid_small");
        }
    });

    function Retencion_Add(){

    	var ret = new Object();
    	ret.numero 	= $("#txt_reten_numero").val();
    	ret.tipo	= $("#txt_id_tiporeten option:selected").text();
    	ret.idtipo	= $("#txt_id_tiporeten").val();
    	ret.monto	= $("#txt_reten_importe").val();
    	ret.check 	= '<input type="button" id="btn_delete_reten'+ret.numero+'" class="clsBorrarRetencion" value="X"/>';

    	dat_retencion.push(ret);
    	reloadDataRetencion();
    	sumatoriaRetencion();

    	$("#frm_retencion .form-field").val ("");
    	$("#dialg_reten").dialog('close');

    }



    $("#btn_Retencion_Add").click(function(){
    	$("#frm_retencion").submit();
    });

    //FIN GUARDAR RETENCION


    //NUEVA TRANSFERENCIA

    var validator_addTransferencia = $("#frm_transferencia").validate({
        rules: {
        	txt_transferencia_importe: {
        		required: true,
        		number:true,
        		minlength: 1
        	},
        	txt_transferencia_numero: {
        		required: false
        	}
        },
        messages: {
            txt_transferencia_importe:"Requerido"

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
            Transferencia_Add();
        },
        success: function(label) {
            label.html("&nbsp;").addClass("valid_small");
        }
    });

    function Transferencia_Add(){

    	var tra = new Object();
    	tra.numero 	= $("#txt_transferencia_numero").val();
    	tra.monto	= $("#txt_transferencia_importe").val();
    	tra.check 	= '<input type="button" id="btn_delete_transferencia'+tra.numero+'" class="clsBorrarTransferencia" value="X"/>';

    	dat_transferencias.push(tra);
    	reloadDataTransferencia();
    	sumatoriaTransferencia();

    	$("#frm_transferencia .form-field").val ("");
    	$("#dialg_transferencia").dialog('close');

    }



    $("#btn_Transferencia_Add").click(function(){
    	$("#frm_transferencia").submit();
    });

    //FIN NUEVA TRANSFERENCIA



    $("#save_efectivo_recibo").change(function(){
    	sumatoriaTotal();
    	calcularRecibo();
    });



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

 	//ltrim quita los espacios o caracteres indicados al inicio de la cadena
	function ltrim(str, chars) {
		chars = chars || "\\s";
		return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
	}

	$("#btn_Recibo_Print").click(function(){
		imprimir();
	});

    $("#save_num_recibo").change(function(){
        var num = $("#save_num_recibo").val();
        $.ajax({
			type:"POST",
			data:"&num=" + num,
			url:"CONTROLLER/C_Recibo.php?opc=19",
			success:function(response){
				if(response >= 1){
					$("#save_num_recibo").val("");
                    $('#error_msg').dialog('open');
        			$("#msg_err").text("Numero de recibo utilizado");
				}
			}
		});
    });

	function imprimir(){

    	var fo=getStringParsedToPrint();

        var windowSizeArray = [ "width=200,height=200","width=800,height=600,scrollbars=yes" ];
        var numero		= $("#save_num_recibo").val();
        var fecha 		= $("#save_fecemi_recibo").val();
        var cliente		= $("#txt_cliente").val();
        var cuit		= $("#txt_cuit").val();
        var obs			= $("#save_obs_recibo").val();
        var efectivo	= $("#save_efectivo_recibo").val();
        var total		= $("#total_remito").val();
        var saldo 		= $("#save_saldo_recibo").val();

        var url 		= "recibo_pdf.php";
        var windowName 	= "popUp";//$(this).attr("name");
        var windowSize 	= windowSizeArray;
        var param		= "?obs="+obs+"&cliente="+cliente+"&cuit="+cuit+"&numero="+numero+"&fecha="+fecha+"&saldo="+saldo+"&efectivo="+efectivo+"&total="+total+"&detalle="+fo;
        var win			= window.open(url+param, windowName, windowSize);

    }



	function getStringParsedToPrint(){

		var lon_fact	= dat_fact.length;
	 	var lon_che 	= dat_cheques.length;
	 	var lon_ret 	= dat_retencion.length;
	 	var lon_trans 	= dat_transferencias.length;
		var lon_fact_p	= dat_fact_prov.length;


		var cade=[];
		//facturas
		var str = "";
        for(var tk=0;tk<lon_fact;tk++){
        	str=str+dat_fact[tk].id+"|"+dat_fact[tk].tipo_num+"|"+dat_fact[tk].fecha+"|"+dat_fact[tk].total+"|"+dat_fact[tk].pendiente+"^";
        }
        cade = cade + str.toString().substr(0, str.length-1) + "~";

        //cheques
		var str = "";
        for(var tk=0;tk<lon_che;tk++){
        	str=str+dat_cheques[tk].numero+"|"+dat_cheques[tk].banco+"|"+dat_cheques[tk].fecha+"|"+dat_cheques[tk].monto+"^";
        }
        cade = cade + str.toString().substr(0, str.length-1) + "~";

        //retenciones
		var str = "";
        for(var tk=0;tk<lon_ret;tk++){
        	str=str+dat_retencion[tk].numero+"|"+dat_retencion[tk].tipo+"|"+dat_retencion[tk].monto+"^";
        }
        cade = cade + str.toString().substr(0, str.length-1) + "~";

        //transferencias
		var str = "";
        for(var tk=0;tk<lon_trans;tk++){
        	str=str+dat_transferencias[tk].numero+"|"+dat_transferencias[tk].monto+"^";
        }
        cade = cade + str.toString().substr(0, str.length-1)+ "~";

		 //facturas proveedor
		var str = "";
        for(var tk=0;tk<lon_fact_p;tk++){
        	str=str+dat_fact_prov[tk].id+"|"+dat_fact_prov[tk].tipo_num+"|"+dat_fact_prov[tk].fecha+"|"+dat_fact_prov[tk].total+"^";
        }
        cade = cade + str.toString().substr(0, str.length-1);
        return cade;
	}


	$("#btn_Recibo_Open").click(function(){
    	$("#clave_usuario").val("");
    	$('#dialg_open').dialog('open');
    });

	$("#dialg_open_acept").click(function(){
		var clave_usuario = $("#clave_usuario").val();

		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Persona.php?",
			data:"opc=28&clave="+clave_usuario,
			success:function(response){
				if(response == 1){
					$("#btn_Recibo_Add").show();
					$("#btn_Recibo_Open").hide();
					$("#tipo_guardar").val("update");
				}
				else{
					alert("Acceso denegado");
				}

			}
		});
		$('#dialg_open').dialog('close');

	});




});
