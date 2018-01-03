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
                
   //DATAPICKER//
    $(".datepicker").datepicker();
    $('.datepicker').datepicker('option', {dateFormat: 'dd/mm/yy'});
    //carga la fecha actual
    $('.datepicker').datepicker('setDate', new Date());             
                
                
        $('#dial_msg_close').click(function() {
			$('#dialg_msg').dialog('close');
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
       cargarFactura();
       
   });
   
   $('#cmbgridCliente').combogrid({
		panelWidth: 200,
		url: 'CONTROLLER/C_Persona.php?opc=32',
		idField:'id_cliente',
		textField:'nombre',
		mode:'remote',
		fitColumns:true,
		columns:[[
			{field:'id_cliente',title:'',width:0, hidden:true},
			{field:'nombre',title:'Cliente',align:'right',width:200}

		]],
		onSelect:function(rowData){
			var row =$('#cmbgridCliente').combogrid('grid').datagrid('getSelected');
			$("#txt_cliente").val(row.id_cliente);
		}
    });
   
   
   
    $('#dg').datagrid({
        url:"CONTROLLER/C_Factura.php?opc=8",
        idField:'id_fact',
		textField:'id_fact',
        mode:'remote',
        columns:[[ 
                 {field:'id_fact',title:'Id',width:10},
				 {field:'tipo',title:'Tipo',width:15},
                 {field:'num_fact',title:'Num',width:30},
                 {field:'fecemi_fact',title:'Fecha',width:35},
                 {field:'cliente',title:'Cliente',width:80},
				 {field:'obs_fact',title:'Observación',width:100},  
                 {field:'descto_fact',title:'Desc',width:20},  
                 {field:'iva105_fact',title:'Iva 10,5%',width:25},  
				 {field:'iva21_fact',title:'Iva 21%',width:25},  
				 {field:'subtotal_fact',title:'Subtotal',width:30},  
                 {field:'total_fact',title:'Total',width:30}
                 
            ]],
		onClickRow:function(rowData){
            vaciarDetalle();
            var ret=$('#dg').datagrid('getSelected');
            cargarDetalle(ret.id_fact);
        }
    });
    
	$('#tt').datagrid({
        url:"CONTROLLER/C_Factura.php?opc=9",
        idField:'id_fact',
		textField:'id_fact',
        mode:'remote',
        columns:[[ 
                 {field:'id_fact',title:'Id Fact',width:40},  
                 {field:'nom_producto',title:'Cod',width:40},  
                 {field:'descrip_producto',title:'Producto',width:100},
                 {field:'canti_detfact',title:'Cant',width:40},  
                 {field:'precio_detfact',title:'Precio',width:40}
            ]]
       
    });
 
 function vaciarDetalle(){
     detalle=[];
     reloadDataDetalle();
 }
 
	function vaciarCabecera(){
		dat=[];
		reloadData();
	}
 

	function cargarFactura(){
		var idc=$("#txt_cliente").val();
		var frm="opc=19&idc="+idc;
		$.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Factura.php",
            data:frm,
            dataType:'json',
            success:function(response){ 
                var tk=response.length;
                for(var pi=0;pi<tk;pi++){

                     var tmp_row={
						id_fact:response[pi].id_fact,
						num_fact:response[pi].num_fact,
						tipo:response[pi].tipo,
						cliente:response[pi].cliente,
						obs_fact:response[pi].obs_fact,
						descto_fact:response[pi].descto_fact,
						iva105_fact:response[pi].iva105_fact,
						iva21_fact:response[pi].iva21_fact,
						total_fact:response[pi].total_fact,
						subtotal_fact:(parseFloat(response[pi].total_fact) - parseFloat(response[pi].iva21_fact) - parseFloat(response[pi].iva105_fact)).toFixed(2),
						fecemi_fact:response[pi].fecemi_fact
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
		var iva_21 = 0; //id 1
		var iva_105 = 0; // id 2
		var desc = 0;
        
        for(var t=0;t<lng;t++){
        	if(tl[t]['tipo'] == "Fx")
        	{
		        sum		= sum 		+ 	parseFloat(tl[t]['total_fact']) - parseFloat(tl[t]['iva21_fact']) - parseFloat(tl[t]['iva105_fact']);
				iva_21 	= iva_21 	+ 	parseFloat(tl[t]['iva21_fact']);
				iva_105 = iva_105 	+ 	parseFloat(tl[t]['iva105_fact']);
				desc 	= desc 		+ 	parseFloat(tl[t]['descto_fact']);
			}
			else
			{
				sum		= sum 		- 	parseFloat(tl[t]['total_fact']) + parseFloat(tl[t]['iva21_fact']) + parseFloat(tl[t]['iva105_fact']);
				iva_21 	= iva_21 	- 	parseFloat(tl[t]['iva21_fact']);
				iva_105 = iva_105 	- 	parseFloat(tl[t]['iva105_fact']);
				desc 	= desc 		- 	parseFloat(tl[t]['descto_fact']);
			}
        }
        var toto=sum+iva_21+iva_105;

        $("#label_subtotal").val(sum.toFixed(2));
        $("#label_iva105").val(iva_105.toFixed(2));
        $("#label_iva21").val(iva_21.toFixed(2));        
        $("#label_total").val(toto.toFixed(2));
		$("#label_desc").val(desc.toFixed(2));
 
    }
 
 
 function cargarDetalle(ID_FACT){
      var frm="opc=9&id_fact="+ID_FACT;
       $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Factura.php",
            data:frm,
            dataType:'json',
            success:function(response){ 
                var tk=response.length;
                for(var pi=0;pi<tk;pi++){
                     var tmp_row={
                     id_fact:response[pi].id_fact,
                     nom_producto:response[pi].nom_producto,
                     descrip_producto:response[pi].descrip_producto,
                     canti_detfact:response[pi].canti_detfact,
                     precio_detfact:response[pi].precio_detfact
                    };
                   detalle.push(tmp_row);    
                }
                reloadDataDetalle();
            } 
        }); 
 }



});



