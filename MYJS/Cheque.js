$(document).ready(function(){
 var cont=0;
 var dat_mov=[];//modelo del grid

 
 //$('#div_cliente').hide();
 
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
        "sAjaxSource": "VIEW/WBuscarCheque.php?",
        "aaSorting": [[ 0, "desc" ]], // para chequearlos por default
        "sPaginationType": "full_numbers",
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "xls", "pdf"                          
            ]
        }
    });
	

    $(".datepicker").datepicker();
    $('.datepicker').datepicker('option', {dateFormat: 'dd-mm-yy'});
    //carga la fecha actual
//    $('.datepicker').datepicker('setDate', new Date());


	$(".clsMatrizVer").livequery("click", function(e){
		$(".tag").remove();
		dat_mov = [];
		
		
		var idcheque=$(this).attr("id").replace("btn_detalle","");

            var frmcheque="id_cheque="+idcheque+"&opc=13"; 
            $.ajax({ 
                type:"POST",
                url:"CONTROLLER/C_Cheque.php",
                data:frmcheque,
                dataType:'json',
                success:function(response){ 
					
					$("#update_num_cheque").val(response._num_cheque);
					$("#update_monto_cheque").val(response._monto_cheque);
					$("#update_fecrec_cheque").val(response._fecrec_cheque);
					$("#update_fecpago_cheque").val(response._fecpago_cheque);
					$("#update_num_recibo_cheque").val(response._num_recibo);
					$("#update_cliente_cheque").val(response._cliente);
					$("#update_banco_cheque").val(response._banco_cheque);
					$("#update_propietario_cheque").val(response._propietario);
					$("#update_id_cheque").val(response._id_cheque);
					$("#update_provd_cheque").val(response._proveedor);
					$("#update_estado_cheque").val(response._estado_cheque);

/*					
					for( var i= 0; i < response._movimientos.length ; i++)
					{
						var row_tmp = {
							fecha: response._movimientos[i].fec_movicheque,
							observacion: response._movimientos[i].obs_movicheque
						};
						dat_mov.push(row_tmp);
					}

					var datainfo = {
						"total":0,
						"rows":dat_mov
					};
					
					$("#remitos_table").datagrid('loadData',datainfo);
*/
					$("#btn_Cheque_Depositar").hide();
					if(response._estado_cheque == "En mano")
						$("#btn_Cheque_Depositar").show();
                } 
		});
		
		$("#dialg_chequeDetalle").dialog('open');

	});

	function vaciarVector(){
		dat_mov=[];
		cont=0;
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
	
	$('#dialg_chequeDetalle').dialog({
		autoOpen: false,
		width:528,
		height:450,
		modal: true
	});
	
	$('#dialg_chequeDetalle_close').click(function() {
		$('#dialg_chequeDetalle').dialog('close');
	}); 
            
                
	$('#dial_msg_close').click(function() {
		$('#dialg_msg').dialog('close');
		location.reload();
	});    

	
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
			{field:'obs_vehi', title:'',hidden:true}

		]],
		onSelect:function(rowData){
			var row =$('#cmbgridCliente').combogrid('grid').datagrid('getSelected');
			
			if(row.id_cliente == '0'){
				$("#dialg_nuevoCliente").dialog('open');
			}else{
			
				$("#label_cliente_vehiculo").show();
				$("#save_id_cliente").val(row.id_cliente);
				$("#save_id_vehiculo").val(row.id_vehiculo);
				$("#txt_cliente").val(row.cliente);
				$("#txt_vehiculo").val(row.vehiculo + ' ('+row.dominio+')');
				$("#save_patente").val(row.dominio);
				$("#div_deleteVehiculo").hide();
				$("#txt_obs_vehiculo").val(row.obs_vehi);
				$("#save_obs_cheque").val($("#save_obs_cheque").val() + ' - ' + row.obs_vehi);
				if(row.id_vehiculo > 0) {
					$("#div_deleteVehiculo").show();
				}
			}
		}
    });
    

    
	var validator_addCheque = $("#frm_cheque").validate({ 
        rules: { 
            save_obs_cheque: {
                required: false, 
            	minlength:5
            },
            txt_num_cheque: {
               	required: false, 
            }
        }, 
        messages: { 
            txt_num_cheque:"Requerido"
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
    
    $("#btn_Cheque_New").click(function(){
      	vaciarVector();
       
	   	vaciarCampos();

    });
    
    
    $("#btn_Cheque_Depositar").click(function(){
    	var idcheque = $("#update_id_cheque").val();
    	$.ajax({
    		url: "CONTROLLER/C_Cheque.php?opc=14",
    		data: {'idcheque': idcheque},
    		type: 'POST',
    		dataType: 'JSON',
    		success:function(response){
    			$('#dialg_chequeDetalle').dialog('close');
    			$('#dialg_msg').dialog('open');
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
	   	$("#patente_vozcliente").val('');
	   	$("#save_id_vozcliente").val('');
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

    function Cheque_Add(){
		validador= validarCombos();
		var opc = '2'; //Esto es para actualizar una cheque ya creada
		if(validador == 'C'){
		
			if($("#tipo_submit").val() =='nuevo') {
				opc = '1'; //Esto es para crear una cheque de trabajo nuevo
			}
	
			var frmCheque=$("#frm_cheque").serialize();
			$.ajax({ 
				type:"POST",
				url:"CONTROLLER/C_Cheque.php?opc="+opc+"&"+frmCheque,
				data:({Detalle:dat}),
				dataType:'json',
				success:function(response){ 
					$('#dialg_msg').dialog('open');
					$("#msg").text(response.txt);
				   
					//Vaciamos todo para que un nuevo remito
					vaciarVector();
					$("#frm_cheque .form-field").val ("");
					vaciarCampos();
				} 
			}); 
		}else{
			$('#error_msg').dialog('open');
			$("#msg_err").text("Debe completar los campos: " + validador);
		}
    }
	

    
    $("#btn_Cheque_Add").click(function(){
	    $("#tipo_guardar").val('abierto');
    	$("#frm_cheque").submit();
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
  	
});
