$(document).ready(function(){

var dat=[];//modelo del grid
var detalle=[];//modelo del grid

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
	
	$('#dialg_edit').dialog({
		autoOpen: false,
		width: 270,
		height: 270,
		modal: true
	});
                
   //DATAPICKER//
    $(".datepicker").datepicker();
    $('.datepicker').datepicker('option', {dateFormat: 'dd-mm-yy'});
    //carga la fecha actual
    $('.datepicker').datepicker('setDate', new Date());             
                
                
    $('#dialg_msg_close').click(function() {
		$('#dialg_msg').dialog('close');
	});    
	$('#dialg_edit_close').click(function() {
		$('#dialg_edit').dialog('close');
	});  
   
   function reloadData(){
        var datainfo = {
            "total":0,
            "rows":dat
        };
        $('#dg').datagrid('loadData', datainfo);
    }
   
   function reloadDataDetalle(){
        var datainfo = {
            "total":0,
            "rows":detalle
        };
        $('#tt').datagrid('loadData', datainfo);
   }
   
   $("#btn_Buscar").click(function(){
       
       vaciarCabecera();
       cargarCompra();
       
   });
   
    $('#dg').datagrid({
        url:"CONTROLLER/C_Compra.php?opc=8",
        idField:'id_compra',
		textField:'id_compra',
        mode:'remote',
        columns:[[ 
                 {field:'fec_compra',title:'Fecha',width:40},
                 {field:'comprobante',title:'Nº',width:60}, 
                 {field:'proveedor',title:'Proveedor',width:140}, 
                 {field:'cuit',title:'Cuit',width:30}, 
                 {field:'iva21',title:'IVA21%',width:30}, 
                 {field:'iva10',title:'IVA10,5%',width:30},
                 {field:'iibb_ret',title:'Ret IIBB',width:30},
                 {field:'iva_ret',title:'Ret IVA',width:30},
                 {field:'ganancia_ret',title:'Ret ganancia',width:30},
				 {field:'concepto_nograv',title:'No grav',width:30},
                 {field:'descuento',title:'Desc',width:30},
                 {field:'total_compra',title:'Total',width:30}  
                 
            ]],
			onClickRow:function(rowData){
				vaciarDetalle();
				var ret=$('#dg').datagrid('getSelected');
				cargarDetalle(ret.id_compra);
        }
    });
    
    
	$('#tt').datagrid({
        url:"CONTROLLER/C_Compra.php?opc=9",
        idField:'id_compra',
		textField:'id_compra',
        mode:'remote',
        columns:[[ 
             {field:'nom_producto',title:'Cod',width:30},  
             {field:'descrip_producto',title:'Producto',width:90},
             {field:'canti_detcompra',title:'Cantidad',width:20},  
             {field:'costouni_detcompra',title:'Precio',width:20},
             {field:'tipoiva',title:'Tipo IVA', width:20},
             {field:'iva',title:'IVA',width:20},
             {field:'precio',title:'',width:0, hidden:true},
             {field:'id_producto',title:'',width:0, hidden:true},
             {field:'subtotal',title:'Subtotal',width:20}
        ]],
      	onDblClickRow:function(rowData){
      		var prod = $('#tt').datagrid('getSelected');
      		$("#update_id_producto").val(prod.id_producto);
      		$("#codigo_producto").val(prod.nom_producto);
      		$("#update_pvp1_producto").val(prod.precio);
      		
      		$("#dialg_edit").dialog('open');
      	}
    });
 
	function vaciarDetalle(){
	 detalle=[];
	 reloadDataDetalle();
	}
 
	function vaciarCabecera(){
	 dat=[];
	 reloadData();
	}

    $("#btn_Exportar").click(function(){
        $('#dg').datagrid('toExcel','compras.xls');
    });
 

 	function cargarCompra(){
		var fecini=$("#fec_ini").val();
		var fecfin=$("#fec_final").val();
		var frm="opc=8&fec_ini="+fecini+"&fec_final="+fecfin;
		$.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Compra.php",
            data:frm,
            dataType:'json',
            success:function(response){ 

                var tk=response.length;
                for(var pi=0;pi<tk;pi++){

                     var tmp_row={
				         id_compra:response[pi].id_compra,
				         tipo:response[pi].tipo,
				         remito:response[pi].remito,
				         fec_compra:response[pi].fec_compra,
				         fec_ingreso:response[pi].fec_ingreso,
				         proveedor:response[pi].proveedor,
				         obs_compra:response[pi].obs_compra,
				         subtotal:response[pi].subtotal,
				         iva21:response[pi].iva21,
				         iva10:response[pi].iva10,
				         iibb_ret:response[pi].iibb_ret,
				         iva_ret:response[pi].iva_ret,
				         ganancia_ret:response[pi].ganancia_ret,
						 concepto_nograv:response[pi].concepto_nograv,
				         descuento:response[pi].descuento,
				         total_compra:response[pi].total_compra,
                         comprobante:response[pi].tipo+' '+response[pi].remito,
                         cuit:response[pi].cuit
                    };
                   dat.push(tmp_row);
            
                }
                reloadData();
                sumatoria();
            } 
        }); 
 	}
 
	function sumatoria(){//total de footer
		var tl=$("#dg").datagrid('getRows');
		var lng=tl.length;
		var sum=0;
		var sub=0;
		var iva_21 = 0; //id 1
		var iva_105 = 0; // id 2
		var desc = 0;
		var iibb_ret = 0;
		var iva_ret = 0;
		var ganancia_ret = 0;
		var concepto_nograv = 0;
        
        for(var t=0;t<lng;t++){
        	
	    	sub		= sub		+ 	parseFloat(tl[t]['subtotal']);
	        sum		= sum 		+ 	parseFloat(tl[t]['total_compra']);
			iva_21 	= iva_21 	+ 	parseFloat(tl[t]['iva21']);
			iva_105 = iva_105 	+ 	parseFloat(tl[t]['iva10']);
			iva_ret = iva_ret 	+	parseFloat(tl[t]['iva_ret']);
			iibb_ret= iibb_ret	+ 	parseFloat(tl[t]['iibb_ret']);
			desc	= desc 		+ 	parseFloat(tl[t]['descuento']);
			
			concepto_nograv = concepto_nograv + parseFloat(tl[t]['concepto_nograv']);
		
			ganancia_ret = ganancia_ret + parseFloat(tl[t]['ganancia_ret']);
			
        }
//        var toto=sum+iva_21+iva_105;

		$("#label_iibb_ret").val(iibb_ret.toFixed(2));
		$("#label_iva_ret").val(iva_ret.toFixed(2));
		$("#label_ganancia_ret").val(ganancia_ret.toFixed(2));
		$("#label_descuento").val(desc.toFixed(2));
        $("#label_total").val(sum.toFixed(2));
        $("#label_iva105").val(iva_105.toFixed(2));
        $("#label_iva21").val(iva_21.toFixed(2));        
        $("#label_ivaret").val(iva_ret.toFixed(2));  
        $("#label_subtotal").val(sub.toFixed(2));
		$("#label_concepto_nograv").val(concepto_nograv.toFixed(2));
//		$("#label_desc").val(desc.toFixed(2));
 
    }
 
 	function cargarDetalle(ID_compra){
      	var frm="opc=9&id_compra="+ID_compra;
       	$.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Compra.php",
            data:frm,
            dataType:'json',
            success:function(response){ 
                var tk=response.length;
                for(var pi=0;pi<tk;pi++){
                	var tipoiva = '10,5%';
                	var iva = parseFloat(response[pi].costouni_detcompra) * 0.105;
                	if(response[pi].tipo_iva == "1"){
                		var tipoiva = '21%';
                		var iva = parseFloat(response[pi].costouni_detcompra) * 0.21;
                	}
                	var subtotal = (parseFloat(response[pi].costouni_detcompra) + iva) * response[pi].canti_detcompra;
                
                    var tmp_row={
		                id_compra:response[pi].id_compra,
		                nom_producto:response[pi].nom_producto,
		                descrip_producto:response[pi].descrip_producto,
		                canti_detcompra:response[pi].canti_detcompra,
		                costouni_detcompra:response[pi].costouni_detcompra,
		                precio:response[pi].precio,
		                id_producto:response[pi].id_producto,
		                tipoiva:tipoiva,
		                iva:iva.toFixed(2),
		                subtotal:subtotal.toFixed(2)
                    };
                   	detalle.push(tmp_row);    
                }
                reloadDataDetalle();
            } 
        }); 
 	}
 	
 	//actualizacion del precio de venta
 	
 	var validatorUpdate = $("#frmPrecio_Update").validate({ 
    	rules: { 
    		update_pvp1_producto: {
	    		required: true, 
	    		number: true
          	}
        },
        messages: { 
            update_pvp1_producto: "Debe ingresar un importe válido"
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
           frmPrecio_Update();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });  
    
    function frmPrecio_Update()
    {
    	var idp 	= $("#update_id_producto").val();
    	var precio 	= $("#update_pvp1_producto").val();
    	var frmPrecio=$("#frmPrecio_Update").serialize();
    	$.ajax({
    		type:"POST",
    		url:"CONTROLLER/C_Producto.php?opc=13&"+frmPrecio,
    		
    		success:function(response){ 
             	$('#dialg_edit').dialog('close');
                $('#dialg_msg').dialog('open');
                $("#msg").text("Los datos se han actualizado correctamente");
				for(i = 0 ; i < detalle.length ; x++){
					if(detalle[i].id_producto == idp){
						detalle[i].precio = precio;
						break;
					}
				}
				reloadDataDetalle();
            } 
    	});
    	
    }
	
});
