$(document).ready(function(){

//VARIABLES INCIALES DEL grid
 var cont=0;
 var dat=[];//modelo del grid
$('#tt').datagrid('reloadFooter',[  //inicio foter del datagrid
    {cantidad:"SubTotal : ",total: 0},
    {cantidad:"Iva 10,5% : ",total: 0},
    {cantidad:"Iva 21% : ",total: 0},
    {cantidad:"Total : ",total: 0}
]);   


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

//DATAPICKER//
    $(".datepicker").datepicker();
    $('.datepicker').datepicker('option', {dateFormat: 'dd-mm-yy'});
    //carga la fecha actual
    $('.datepicker').datepicker('setDate', new Date());
    
    $("#btn_Compra_Update").hide();
    
    
    var oTable=  $('#table-example').dataTable({
        "bServerSide": true,
        "bFilter": true,
        "bJQueryUI": true,
        "sAjaxSource": "VIEW/WBuscarCompra.php?",
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
        "sAjaxSource": "VIEW/WBuscarNotacreditoCompra.php?",
        "sPaginationType": "full_numbers",
        "aaSorting": [[ 2, "desc" ]], // para ordenarlos por default
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "xls", "pdf"                          
            ]
        }
    });
    
    
    
    //DIALOG//
    $('#dialg_msg').dialog({
            autoOpen: false,
            width: 460,
            height: 160,
            modal: true
    });
    
    $('#dialg_error').dialog({
		autoOpen: false,
		width: 460,
		height: 160,
		modal: true
	});

    $('#dial_msg_close').click(function() {
            $('#dialg_msg').dialog('close');
            location.reload();
    });   
    
    $('#dialg_error_close').click(function() {
		$('#dialg_error').dialog('close');
	});     
    
    
 //Inicio jqueryeasy   
 
 
 
 //FUNCIONES jqueryeasy
  function Add(){
       
       if(verificarDat()){
            cont++;
            var idprod	= $("#txt_idproducto").val();
            var codprod	= $("#txt_cod_producto").val();
            var prod	= $("#txt_nom_producto").val();
            var precio	= $("#txt_costo").val();
            var tiiva 	= $("#txt_tipoiva").val();
            var porciva = $("#txt_porcentaje_iva").val();
            var preciovta=$("#txt_precio").val();
            var margen	= $("#margen_ganancia").val();
            var id_condiva = $("#id_condiva").val();

            var desc_p = 0;
            if($("#txt_descuento_prod").val() != ""){
	            desc_p	= $("#txt_descuento_prod").val();
	        }else if($("#save_descuento").val() != ""){
	        	desc_p = $("#save_descuento").val();
	        }
            
            var precio_orig = parseFloat(precio);
            precio = parseFloat(precio) - parseFloat(precio) * parseFloat(desc_p) / 100;
            
            precio=parseFloat(precio);
            preciovta=parseFloat(precio) + (parseFloat(precio) * parseFloat(margen) / 100);
            var canti=$("#txt_cantidad").val();
            canti=parseFloat(canti);
            
/*
            if(id_condiva != "2"){
                var iva = parseFloat(precio*0.105);
                if(tiiva == '21%')
                	var iva= parseFloat(precio*0.21);
            }else{
                var iva = 0;
            }
*/  
            var iva = parseFloat(precio * parseFloat(porciva) / 100) ;

            var subt=precio*canti;
            var tmp_row={
                id:idprod,
                cod:codprod,
                producto:prod,
                precio_orig:precio_orig.toFixed(2),
                precio:precio.toFixed(2),
                preciovta:Math.round(preciovta.toFixed(2)),
                cantidad:canti,
                tipoiva:tiiva,
                iva:iva.toFixed(2),
                total:subt.toFixed(2)
            };
            dat.push(tmp_row);
            reloadData();
            sumatoria();
	    
	    $("#cmbgrid").next().find('input').focus();
	    $("#cmbgrid").combobox('clear');
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
  
  function reloadConDescuento(){
  
	var margen = $("#margen_ganancia").val();
  	var desct = 0;
  	if($("#save_descuento").val() != "")
		desct = parseFloat($("#save_descuento").val());

  	var tl=$("#tt").datagrid('getRows');
  	var lng=tl.length;
  	

  	for(var t=0;t<lng;t++){
	    var precio 	= (tl[t].precio_orig - (tl[t].precio_orig * desct / 100)).toFixed(2);
        tl[t].precio = parseFloat(precio);
		var preciovta	= tl[t].precio + (tl[t].precio * parseFloat(margen) / 100);
        tl[t].preciovta = parseFloat(preciovta);
		tl[t].iva 		= (tl[t].precio * 0.105).toFixed(2);
		if(tl[t].tipoiva == '21%')
			tl[t].iva 	= (tl[t].precio * 0.21).toFixed(2);
		tl[t].total 	= (tl[t].precio * tl[t].cantidad).toFixed(2);
	}

	reloadData();
	sumatoria();
  }
 
  	function sumatoria(){//total de footer
		var tl=$("#tt").datagrid('getRows');
	
		if($("#txt_percepcion").val() != '')
			var percepcion = parseFloat($("#txt_percepcion").val());
		else
			var percepcion = 0;
			
		if($("#save_iva_ret").val() != '')
			var iva_ret = parseFloat($("#save_iva_ret").val());
		else
			var iva_ret = 0;
		
		if($("#save_iibb_ret").val() != '')
			var iibb_ret = parseFloat($("#save_iibb_ret").val());
		else
			var iibb_ret = 0;
/*		
		if($("#save_descuento").val() != '')
			var descuento = parseFloat($("#save_descuento").val());
		else
			var descuento = 0;
*/		
		if($("#save_ganancia_ret").val() != '')
			var ganancia_ret = parseFloat($("#save_ganancia_ret").val());
		else
			var ganancia_ret = 0;
			
		if($("#save_concepto_nograv").val() != '')
			var concepto_nograv = parseFloat($("#save_concepto_nograv").val());
		else
			var concepto_nograv = 0;
		
        var id_condiva = $("#id_condiva").val();

		var lng=tl.length;
		var sum=0;
		var iva10=0;
		var iva21=0;
		for(var t=0;t<lng;t++){
	
		    sum=sum+parseFloat(tl[t]['total']);
            if(id_condiva != "2"){
    		    if(tl[t]['tipoiva'] == '21%'){
	    	    	iva21 = iva21 + parseFloat(tl[t]['iva'] * tl[t]['cantidad']);
		        }else{
		        	iva10 = iva10 + parseFloat(tl[t]['iva'] * tl[t]['cantidad']);
    		    }
            }
		}

		var toto=sum + iva21 + iva10 + iva_ret + iibb_ret + ganancia_ret + concepto_nograv;

		$('#tt').datagrid('reloadFooter',[
		   {cantidad:"SubTotal : ",total: sum.toFixed(2)},
		   {cantidad:"IVA 21% : ",total: iva21.toFixed(2)},
		   {cantidad:"Otro IVA : ",total: iva10.toFixed(2)},
		   {cantidad:"Total : ",total: toto.toFixed(2)}
		]);
		$("#save_subtotal_compra").val(sum.toFixed(2));
		$("#save_iva21_compra").val(iva21.toFixed(2));
		$("#save_iva10_compra").val(iva10.toFixed(2));
		$("#save_total_compra").val(toto.toFixed(2));
     
    }
    

  function verificarDat(){
        var row =$('#cmbgrid').combogrid('grid').datagrid('getSelected');
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


   $('#cmbgrid').combogrid({
		panelWidth:800,
		delay:400,
		url: 'CONTROLLER/C_Compra.php?opc=10',
		idField:'id_producto',
		textField:'descrip_producto',
		mode:'remote',
		fitColumns:true,
		columns:[[
            {field:'id_producto',title:'Id',width:20},
            {field:'nom_producto',title:'Código',align:'right',width:150},
            {field:'descrip_producto',title:'Descripción',align:'right',width:450}, 
            {field:'precio_producto', title:'Precio de venta', align:'right', width:110},
            {field:'costo_producto',title:'Costo',align:'right',width:60}, 
            {field:'stock_producto',title:'Stock',align:'right',width:60},
            {field:'tipo_iva', title:'IVA', aligh:'right', width:45},
            {field:'porcentaje_iva', title:'%', aligh:'right', width:10}
		]],
        onSelect:function(rowData){
		    var row =$('#cmbgrid').combogrid('grid').datagrid('getSelected');
		    $("#txt_costo").val(row.costo_producto);
		    $("#txt_idproducto").val(row.id_producto);
		    $("#txt_cod_producto").val(row.nom_producto);
		    $("#txt_nom_producto").val(row.descrip_producto);
		    $("#txt_tipoiva").val(row.tipo_iva);
            $("#txt_porcentaje_iva").val(row.porcentaje_iva);
		    $("#txt_precio").val(Math.round(row.precio_producto));
		    
		    actualizarPrecioVenta();
		    
		    $("#txt_costo").focus();
		    $("#txt_costo").select();
        }
	});
	
	$("#cmbgrid").next().find('input').click(function(){
		$("#cmbgrid").combobox('clear');
	});
	
	$("#txt_costo").change(function(){
		actualizarPrecioVenta();
	});
   
  	function actualizarPrecioVenta(){
   		var costo = parseFloat($("#txt_costo").val());
   		var margen = parseFloat($("#margen_ganancia").val());
   		var precio_venta = costo + (costo * margen / 100)
   		$("#txt_precio").val(Math.round(precio_venta.toFixed(2)));
   	}
   
    
  $("#btn_QuitarProducto").click(function(){
      Delete();
//Add();
  });  
    
 //FIN jqueryeasy   
    
    
    //VALIDATION FORM//
	var validator_frm_add_producto = $("#frm_add_producto").validate({ 
        rules: { 
            txt_costo: {
                required: true, 
                number: true
            },
            txt_cantidad: {
                required: true, 
                number: true
            },
            txt_precio: {
                required: false, 
                number: true
            },
            txt_descuento_prod: {
            	required: false,
            	number: true
            }
        }, 
        messages: { 
            txt_costo: "Ingrese el costo", 
            txt_cantidad: "Ingrese la cantidad",
            txt_precio: "Ingrese el precio de venta",
            txt_descuento_prod: "El descuento debe ser un número válido"
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
             //limpiar campso
             $("#frm_add_producto .form-field").val ("");
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    
    //valido el cabezal
    var validator_frmCompra_Add=$("#frmCompra_Add").validate({ 
    rules: { 
            save_id_provd: {
                required: true
            },
            save_guiacod_compra: {
                required: true, 
                minlength:1
            },
            save_obs_compra:{
              	required: false,   
               	minlength:1
            },
            txt_percepcion:{
            	number:true
            },
            save_iva_ret:{
            	number:true
            },
            save_iibb_ret:{
            	number:true
            },
            save_ganancia_ret:{
	            number:true
            },
            save_descuento:{
            	number:true
            },
			save_concepto_nograv:{
				number:true
			}
        }, 
        messages: { 
            save_id_provd: "Seleccione el proveedor", 
            save_guiacod_compra: "Ingrese el número de remito",
            save_obs_compra:"Ingrese la observación, ejm:responsable",
            save_iva_ret:"Debe ingresar un monto válido",
            save_iibb_ret:"Debe ingresar un monto válido",
            save_descuento:"Debe ingresar un monto válido",
            save_ganancia_ret:"Debe ingresar un monto válido",
			save_concepto_nograv:"Debe ingresar un monto válido"
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
           //guadar aqui compra
          form_frmCompra_Add();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    
        
    $("#btn_Compra_Add").click(function(){
       $('#frmCompra_Add').submit();
    });
    $("#btn_AddProducto").click(function(){
       $('#frm_add_producto').submit();
    });
    //limpo los campso
    $("#btn_Compra_New").click(function(){
      $("#frmCompra_Add .form-field").val ("");
      $("#tipo_guardar").val("nuevo");
      vaciarVector();
    });
    
    
    $("#txt_percepcion").keyup(function(){
    	sumatoria();
    });
    
    $("#save_iva_ret").keyup(function(){
    	sumatoria();
    });
    
    $("#save_iibb_ret").keyup(function(){
    	sumatoria();
    });
    
    $("#save_descuento").keyup(function(){
    	reloadConDescuento();
//    	sumatoria();
    });
    
    $("#save_ganancia_ret").keyup(function(){
    	sumatoria();
    });
	
	 $("#save_concepto_nograv").keyup(function(){
    	sumatoria();
    });
    
    
    

    //Nota: Agregar un tiempo adicional, al recibir el return del response.1s es sugerido.
    //Documentación:Nombres que debe tener las cajas de texto para Guardar.
    // save_id_compra   1
    // save_id_provd    1
    // save_guiacod_compra  1
    // save_total_compra    1
    // save_obs_compra  1
    // save_baseGrava_compra    1
    // save_fec_compra  1
    // save_estado_compra   1
    
    function form_frmCompra_Add(){
        //nombre del formulario: frmCompra_Add 
        var frmCompra=$("#frmCompra_Add").serialize(); 
        var opc = 1;
        if($("#tipo_guardar").val() == "update")
        	opc = 2;
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Compra.php?opc="+opc+"&"+frmCompra,
            data:({Detalle:dat}),
            success:function(response){ 
//                alert(response);
                $('#dialg_msg').dialog('open');
				$("#msg").text("Los datos se han guardado correctamente.");
            } 

        }); 
    }
    
    $("#save_id_provd").change(function(){
		id_provd = $("#save_id_provd").val();

		param = "opc=11&id_provd="+id_provd;
		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Compra.php",
			data:param,
			dataType:"json",
			success:function(response){
				$("#margen_ganancia").val(response.ganancia);
                $("#id_condiva").val(response.id_condiva);
				
				$("#label_ganancia").html("Margen de ganancia: " + response.ganancia + "%");
			}
		});
		
		
		verificarNumeroDeFactura();
		actualizarPrecioVenta();
	});
	
	$("#save_guiacod_compra").change(function(){
		verificarNumeroDeFactura();
	});
	
	function verificarNumeroDeFactura(){
		var num_fact = $("#save_guiacod_compra").val();
		var prov = $("#save_id_provd").val();
		
		$.ajax({
			type:"POST",
			data: "&num_fact="+num_fact+"&id_prov="+prov,
			url: "CONTROLLER/C_Compra.php?opc=12",
			success:function(response){
				if(response != 0 && num_fact != ""){
					$("#save_guiacod_compra").val("");
					$("#dialg_error").dialog('open');
				}
			}
		});
	
	}
	
	
	//para ver una factura ya emitida
    $(".clsMatrizEdit").livequery("click", function(e){
		$(".tag").remove();
		vaciarVector();
		$("#frm_compra .form-field").val ("");
		var id_compra=$(this).attr("id").replace("btn_edit","");
	
        var frmcompra="id_compra="+id_compra+"&opc=13"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Compra.php",
            data:frmcompra,
            dataType:'json',
            success:function(response){
    	
				$("#save_fec_compra").val(response._fec_compra);
				$("#save_guiacod_compra").val(response._guiacod_compra);
				$("#save_obs_compra").val(response._obs_compra);
				$("#save_iibb_ret").val(response._iibb_ret_compra);
				$("#save_iva_ret").val(response._iva_ret_compra);
				$("#save_ganancia_ret").val(response._ganancia_ret_compra);
				$("#save_descuento").val(response._descuento_compra);
				$("#save_concepto_nograv").val(response._concepto_nograv);
				$("#save_id_provd").val(response._id_provd);
				$("#tipo_guardar").val("update");
				$("#update_id_compra").val(id_compra);
				
				if(response.detalle !== null){
					$.each(response.detalle, function(i, item) {
						
						precio=parseFloat(item.costouni_detcompra);
                        precio_vta=parseFloat(item.pvp1_producto);
						canti=parseInt(item.canti_detcompra);
						subt=parseFloat(canti*precio);
						var tipoiva = "21";
						if(item.id_tipoiva == "2")
							tipoiva = "10.5";
                        if(item.id_tipoiva == "3")
                            tipoiva = "Exc";
                        if(item.id_tipoiva == "4")
                            tipoiva = "27";
                        if(item.id_tipoiva == "5")
                            tipoiva = "2.5";
                        if(item.id_tipoiva == "6")
                            tipoiva = "5";

						var tmp_row={
							id:item.id_producto,
							cod:item.nom_producto,
							producto:item.descrip_producto,
							precio:precio,
							precio_orig:precio,
							preciovta:precio_vta,
							cantidad:canti,
							tipoiva:tipoiva + "%",
							iva:(precio*parseFloat(tipoiva)/100).toFixed(2),
							total:subt.toFixed(2)
						};
						dat.push(tmp_row);
					});
				}


				$(".tabs").tabs('select','#tabs-1');
				$("#btn_Compra_Add").hide();
				$("#btn_Compra_Update").show();
				
				
				reloadData();
				sumatoria();
			
            } 
		});

	});
	 
	$("#btn_Compra_Update").click(function(){
		$("#dialg_open").dialog('open');
	});


	$('#dialg_open').dialog({
		autoOpen: false,
		width: 330,
		height: 120,
		modal: true
	});
	
	//cerrar ventana de abrir orden
	$("#dialg_open_close").click(function(){
		$("#dialg_open").dialog('close');
	});
	
	$("#dialg_open_acept").click(function(){
		var clave_usuario = $("#clave_usuario").val();
		
		$.ajax({
			type:"POST",
			url:"CONTROLLER/C_Persona.php?",
			data:"opc=28&clave="+clave_usuario,
			success:function(response){
				if(response == 1){
					$("#btn_Compra_Update").hide();
					$("#btn_Compra_Add").show();
				}
				else{
					alert("Acceso denegado");
				}

			}
		});
		$('#dialg_open').dialog('close');
		
	});
    
 

    //Documentación: Nombres que debe tener las cajas de texto para Actualizar.

    // update_id_compra . 

    // update_id_provd . 

    // update_guiacod_compra . 

    // update_total_compra . 

    // update_obs_compra . 

    // update_baseGrava_compra . 

    // update_fec_compra . 

    // update_estado_compra . 

//    $("#btn_Compra_Update").click(function(){
//
//        //nombre del formulario: frmCompra_Update 
//
//        var frmCompra=$("#frmCompra_Update").serialize(); 
//
//        frmCompra=frmCompra+"&opc=2"; 
//
//        $.ajax({ 
//
//            type:"POST",
//
//            url:"CONTROLLER/C_compra.php",
//
//            data:frmCompra,
//
//            success:function(response){ 
//
//                $("#mydiv").html($(response).fadeIn('slow')); 
//
//            } 
//
//        }); 
//
//    });

    //Documentación: Nombres que debe tener la caja de texto para Delete.

    // delete_id_compra . 

//    $("#btn_Compra_Delete").click(function(){
//        //nombre del formulario: frmCompra_Delete 
//        var id_compra=$("#delete_id_compra").val();
//        var frmCompra="delete_id_compra="+id_compra+"&opc=3"; 
//        $.ajax({ 
//            type:"POST",
//            url:"Controller/C_compra.php",
//            data:frmCompra,
//            success:function(response){ 
//    
//            } 
//
//        }); 
//
//    });

    //Documentación: Nombres que debe tener la caja de texto para Show.

    // show_id_compra . 

//    $("#btn_Compra_Show").click(function(){
//        var id_compra=$("#show_id_compra").val();
//        var frmCompra="show_id_compra="+id_compra+"&opc=4"; 
//        $.ajax({ 
//            type:"POST",
//            url:"CONTROLLER/C_compra.php",
//            data:frmCompra,
//            success:function(response){ 
//            } 
//        }); 
//
//    });

   

});
