$(document).ready(function(){
 	var cont=0;
 	var dat_fact=[];//modelo del grid
 	var dat_cheques=[];
 	var dat_cheques_disponibles=[];
 	var dat_retencion=[];
 	var dat_facturas=[];
	var dat_transferencias=[];
 	var total_iva=0;

 	$('#link_pendientes').hide();

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
        "sAjaxSource": "VIEW/WBuscarPagoProv.php?",
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

	$('#ttt').datagrid('reloadFooter',[  //inicio foter del datagrid
        {cantidad:"Total : ",total: 0}
    ]);

	$('#ttr').datagrid('reloadFooter',[  //inicio foter del datagrid
        {cantidad:"Total : ",total: 0}
    ]);

    $(".datepicker").datepicker();
    $('.datepicker').datepicker('option', {dateFormat: 'dd-mm-yy'});
    //carga la fecha actual
    $('.datepicker').datepicker('setDate', new Date());

	$.ajax({
		type:"POST",
		url:"CONTROLLER/C_Recibo.php?opc=18",
		dataType:'json',
		success:function(response){
			$("#save_num_recibo").val(1);
			if(response > 1)
				$("#save_num_recibo").val(response);
			$("#save_num_recibo").prop('readonly', true);
		}
	});


	function reloadData(){
        var datainfo = {
            "total":0,
            "rows":dat_fact
        };
        $('#tt').datagrid('loadData', datainfo);
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
		dat_cheques=[];
		dat_retencion=[];
		dat_facturas=[];
		dat_transferencias=[];
		cont=0;
		reloadData();
		reloadDataCheque();
		sumatoriaCheque();
		reloadDataRetencion();
		sumatoriaRetencion();
		reloadDataTransferencia();
		sumatoriaTransferencia();

		sumatoria();

		sumatoriaTotal();
		$("#total_recibo").empty();
	}

	function sumatoria(){//total de footer
        var tl=$("#tt").datagrid('getRows');
        var lng=tl.length;
        var sum=0;

        for(var t=0;t<lng;t++){
            //var ret=tl[i]['producto'];
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

        for(var t=0;t<lng;t++){
            sum=sum + parseFloat(tl[t]['monto']);
        }
        var toto = 0;
        var toto = sum; // + efect;

        $("#total_cheques").empty();
        $("#total_cheques").append("<b>"+toto.toFixed(2)+"</b>");
        $("#save_total_cheque").val(toto.toFixed(2));

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
    	var transferencias= parseFloat($("#save_total_transferencia").val());
    	if($("#save_total_transferencia").val() == "") transferencias = 0;

		var efectivo 	= parseFloat($("#save_efectivo_recibo").val());
    	if($("#save_efectivo_recibo").val() == "") efectivo = 0;
    	var debito 	= parseFloat($("#save_debito_recibo").val());
    	if($("#save_debito_recibo").val() == "") debito = 0;
    	var saldo 	= parseFloat($("#save_saldo_recibo").val());
    	if($("#save_saldo_recibo").val() == "") saldo = 0;

    	var total = cheque + retencion + transferencias + efectivo + debito + saldo;

    	$("#save_total_recibo").val(total.toFixed(2));
    	$("#total_remito").empty();
        $("#total_remito").append("<b>"+total.toFixed(2)+"</b>");

    	calcularRecibo();
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

			$("#save_nuevo_saldo_recibo").val(total_recibo.toFixed(2));

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
		width: 500,
		height: 140,
		modal: true
	});

	$('#dialg_form').dialog({
		autoOpen: false,
		width: 400,
		height: 300,
		modal: true
	});

	$('#dialg_form_cheque').dialog({
		autoOpen: false,
		width: 650,
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

    $('#dialg_form_cheque_add').dialog({
		autoOpen: false,
		width: 500,
		height: 400,
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

	$("#btn_Retencion_Cerrar").click(function(){
		 $('#dialg_reten').dialog('close');
	});

	$("#btn_Transferencia_Cerrar").click(function(){
		 $('#dialg_transferencia').dialog('close');
	});

    $("#link_nuevoChequeAdd").click(function(){
		$('#dialg_form_cheque_add').dialog('open');
	});





	$('#cmbgridProvee').combogrid({
		panelWidth:500,
		url: 'CONTROLLER/C_Persona.php?opc=31',
		idField:'id_persona',
		textField:'nom_persona',
		mode:'remote',
		fitColumns:true,
		columns:[[
			{field:'id_persona',title:'Id',width:20},
			{field:'nom_persona',title:'Razón social',align:'right',width:100},
			{field:'ruc_persona',title:'CUIT',align:'right',width:100},
			{field:'pendientes',title:'Fx pendientes.',align:'right',width:30},
		]],
		onSelect:function(rowData){
			var row =$('#cmbgridProvee').combogrid('grid').datagrid('getSelected');

			$("#txt_proveedor").val(row.nom_persona);
			$("#txt_cuit").val(row.ruc_persona);
			$("#save_id_provd").val(row.id_persona);
			$("#save_saldo_recibo").val(row.saldo);

			//blanqueo la grilla de facturas
			dat_fact = [];
			reloadData();
			sumatoria();


			dat_facturas = [];
			if(row.pendientes > 0) {
				$.ajax({
					type:"POST",
					url:"CONTROLLER/C_Compra.php?",
					data:"opc=14&id_provd=" + row.id_persona,
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
			}
			else {
				$('#link_pendientes').hide();
			}
		}
    });

    //abrir popup pendientes de cobro
    $('#link_pendientes').click(function(){
    	var id_persona = $("#save_id_provd").val();
		dat_facturas = [];
		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Compra.php?",
			data:"opc=14&id_provd=" + id_persona,
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
						fecha:arr_1[3]
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

		calcularRecibo();
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
		calcularRecibo();
	});

	$(".clsBorrarCheque").livequery("click", function(e){
		var id=$(this).attr("id").replace("btn_delete_cheque","");
		for (var i =0; i < dat_cheques.length; i++){
		   	if (dat_cheques[i].id === id) {
			  	dat_cheques.splice(i,1);
			  	break;
	   		}
	   	}
		reloadDataCheque();
		sumatoriaCheque();
	});

    $(".clsBorrarChequeNuevo").livequery("click", function(e){
		var id=$(this).attr("id").replace("btn_delete_cheque","");
		for (var i =0; i < dat_cheques.length; i++){
		   	if (dat_cheques[i].numero === id) {
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
            txt_proveedor: "Requerido"
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
	   $('.datepicker').datepicker('setDate', new Date());

	});

	function vaciarCampos(){
		$('#cmbgridProvee').combogrid('clear');
		$('#save_id_provd').val('');
	}

	$("#link_nuevoCheque").click(function(){
		dat_cheques_disponibles = [];
		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Cheque.php?",
			data:"opc=4",
			dataType:'json',
			success:function(response){
				$.each(response, function(i, item) {
					var row_tmp = {
						id: item.id_cheque,
						numero: item.num_cheque,
						fecha: item.fecpago_cheque,
						monto: item.monto_cheque,
						banco: item.banco_cheque,
						propietario: item.propietario,
						cliente: item.cliente
					};

					if($.grep(dat_cheques, function(e){ return e.id == item.id_cheque; }) == 0)
						dat_cheques_disponibles.push(row_tmp);
				});

				var datainfo = {
					"total": 0,
					"rows": dat_cheques_disponibles
				};
				$("#cheques_table").datagrid('loadData', datainfo);
			}
		});



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

		var frmRecibo=$("#frm_recibo").serialize();

		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Recibo.php?opc=2&"+frmRecibo,
			data:({cheques: dat_cheques,facturas: dat_fact, retenciones: dat_retencion, transferencias: dat_transferencias}),
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
    }

    var validator_addCheque = $("#frm_cheque_add").validate({
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

    	var che = new Object();

    	che.numero 	= $("#save_num_cheque").val();
        che.id      = 0;
    	che.monto	= $("#save_monto_cheque").val();
    	che.fecha	= $("#save_fecpago_cheque").val();
    	che.estado	= $("#save_estado_cheque").val();
    	che.banco	= $("#save_banco_cheque").val();
    	che.propie	= $("#save_propietario_cheque").val();
    	che.cuit_propie	= $("#save_cuit_propie_cheque").val();
    	che.obs		= $("#save_obs_cheque").val();
    	che.check 	= '<input type="button" id="btn_delete_cheque'+che.numero+'" class="clsBorrarChequeNuevo" value="X"/>';

    	dat_cheques.push(che);
    	reloadDataCheque();
    	sumatoriaCheque();

    	$("#frm_cheque_add .form-field").val ("");
    	$("#dialg_form_cheque_add").dialog('close');
    }

    $("#btn_Cheque_Add").click(function(){
    	$("#frm_cheque_add").submit();
    });

    $("#btn_Recibo_Add").click(function(){
        $("#frm_recibo").submit();
    });

	//Con este vamos ver un recibo
	$(".clsMatrizVer").livequery("click", function(e){
		vaciarCampos();
		vaciarVector();
		$(".tag").remove();
		var idremi=$(this).attr("id").replace("btn_detalle","");

            var frmremi="id_recibo="+idremi+"&opc=16";
            $.ajax({
                type:"POST",
                url:"CONTROLLER/C_Recibo.php",
                data:frmremi,
                dataType:'json',
                success:function(response){
//					response = eliminaNull(response);

					$("#save_num_recibo").val(response.num_recibo);
					$("#save_fecemi_recibo").val(response.fecha_recibo);
					$("#txt_proveedor").val(response.nom_persona + '-' + response.ape_persona);
					$("#txt_cuit").val(response.ruc_persona);
					$("#save_obs_recibo").val(response.obs_recibo);
					$("#save_efectivo_recibo").val(response.efectivo_recibo);
					$("#save_debito_recibo").val(response.debito_recibo);
                    $("#save_saldo_recibo").val(response.saldo_a_favor);

					//facturas
					$.each(response.facturas, function(i, item) {
						total=parseFloat(item.monto_fact);
						saldo=parseInt(item.saldo_fact);

						var tmp_row={
							id:item.id_compra,
							tipo_num:item.guiacod_compra,
							fecha:item.fecha,
							total:total,
							pendiente:saldo
						};
						dat_fact.push(tmp_row);
    				});
    				//sumatoria();
					//reloadData();

    				//cheques
    				$.each(response.cheques, function(i, item) {
						total=parseFloat(item.monto_cheque);

						var tmp_row={
							numero:item.num_cheque,
							banco:item.banco_cheque	,
							fecha:item.fecha,
							monto:total
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
							monto:total
						};
						dat_retencion.push(tmp_row);
    				});
    				reloadDataRetencion();
					sumatoriaRetencion();

					//transferencias
    				$.each(response.transferencias, function(i, item) {
						total=parseFloat(item.monto);

						var tmp_row={
							numero:item.num_transferencia,
							monto:total
						};
						dat_transferencias.push(tmp_row);
    				});
    				reloadDataTransferencia();
					sumatoriaTransferencia();
						

					sumatoria();
					reloadData();

					$("#btn_Recibo_Add").hide();
					$(".tabs").tabs('select','#tabs-1');

                }
		});

	});


    $("#btn_Cheque_Usar").click(function(){
    	var row = $("#cheques_table").datagrid('getSelected');
		var index = dat_cheques_disponibles.indexOf(row);
		var prefijo = "";

		if(index!=-1) {
			dat_cheques_disponibles.splice(index,1); // Remove it if really found!

			row['check'] = '<input type="button" id="btn_delete_cheque'+row['id']+'" class="clsBorrarCheque" value="X"/>';

			dat_cheques.push(row);
			reloadDataCheque();
			sumatoriaCheque();
		}

		var datainfo = {
			"total":0,
			"rows":dat_cheques_disponibles
		};
		$("#cheques_table").datagrid('loadData',datainfo);

		calcularRecibo();
    });

    $('#cheques_table').datagrid({
        onDblClickRow:function(){
            var row = $("#cheques_table").datagrid('getSelected');
    		var index = dat_cheques_disponibles.indexOf(row);
    		var prefijo = "";

    		if(index!=-1) {
    			dat_cheques_disponibles.splice(index,1); // Remove it if really found!

    			row['check'] = '<input type="button" id="btn_delete_cheque'+row['id']+'" class="clsBorrarCheque" value="X"/>';

    			dat_cheques.push(row);
    			reloadDataCheque();
    			sumatoriaCheque();
    		}

    		var datainfo = {
    			"total":0,
    			"rows":dat_cheques_disponibles
    		};
    		$("#cheques_table").datagrid('loadData',datainfo);

    		calcularRecibo();
        }

    });



    $("#btn_Cheque_Cerrar").click(function(){
		 $('#dialg_form_cheque').dialog('close');
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

    $("#save_saldo_recibo").change(function(){
        sumatoriaTotal();
        calcularRecibo();
    });


    $("#save_debito_recibo").change(function(){
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



	function imprimir(){

    	var fo=getStringParsedToPrint();

        var windowSizeArray = [ "width=200,height=200","width=800,height=600,scrollbars=yes" ];
        var numero		= $("#save_num_recibo").val();
        var fecha 		= $("#save_fecemi_recibo").val();
        var proveedor	= $("#txt_proveedor").val();
        var cuit		= $("#txt_cuit").val();
        var obs			= $("#save_obs_recibo").val();
        var efectivo	= $("#save_efectivo_recibo").val();
		var debito		= $("#save_debito_recibo").val();
        var total		= $("#save_total_recibo").val();
        var saldo       = $("#save_saldo_recibo").val();

        var url 		= "orden_pago_pdf.php";
        var windowName 	= "popUp";//$(this).attr("name");
        var windowSize 	= windowSizeArray;
        var param		= "?obs="+obs+"&proveedor="+proveedor+"&cuit="+cuit+"&numero="+numero+"&fecha="+fecha+"&debito="+debito+"&efectivo="+efectivo+"&saldo="+saldo+"&total="+total+"&detalle="+fo;
        var win			= window.open(url+param, windowName, windowSize);

    }



	function getStringParsedToPrint(){

		var lon_fact	= dat_fact.length;
	 	var lon_che 	= dat_cheques.length;
	 	var lon_ret 	= dat_retencion.length;
	 	var lon_trans 	= dat_transferencias.length;


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
        cade = cade + str.toString().substr(0, str.length-1);
        return cade;
	}

});
