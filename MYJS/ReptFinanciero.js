$(document).ready(function(){

var dat_venta=[];//modelo del grid
var dat_compra=[];//modelo del grid
var dat_gasto=[];//modelo del grid
//
//
//
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
    $('.datepicker').datepicker('option', {dateFormat: 'yy/mm/dd'});
    //carga la fecha actual
    $('.datepicker').datepicker('setDate', new Date());             
                
                
        $('#dial_msg_close').click(function() {
			$('#dialg_msg').dialog('close');
		});    
   
   function reloadData_venta(){
        var datainfo = {
            "total_fact":0,
            "rows":dat_venta
        };
        $('#dg').datagrid('loadData', datainfo);
    }
    
    function reloadData_gasto(){
        var datainfo2 = {
            "cant_gast":0,
            "rows":dat_gasto
        };
        $('#tg').datagrid('loadData', datainfo2);
    }
   
 function reloadData_compra(){
        var datainfo1 = {
            "total_compra":0,
            "rows":dat_compra
        };
        $('#tt').datagrid('loadData', datainfo1);
    }
    
   
   $("#btn_Buscar").click(function(){
       vaciarCabecera();
       cargarFactura();
       cargarCompra();
       cargarGasto();
   });
   
    $('#dg').datagrid({
        url:"CONTROLLER/C_Factura.php?opc=8",
        idField:'id_fact',
	textField:'id_fact',
        mode:'remote',
        columns:[[ 
                 {field:'id_fact',title:'Id Factura',width:60},
                 {field:'fecemi_fact',title:'Fecha',width:60},
                 {field:'obs_fact',title:'Observación',width:60},  
                 {field:'descto_fact',title:'Descuento',width:60},  
                 {field:'iva12_fact',title:'Iva',width:60},  
                 {field:'total_fact',title:'Total',width:60} 
                 
            ]]
     
       
    });
    
    
    
  
      $('#tt').datagrid({
        url:"CONTROLLER/C_Compra.php?opc=8",
        idField:'id_compra',
	textField:'id_compra',
        mode:'remote',
        columns:[[ 
                 {field:'id_compra',title:'Id Compra',width:60}, 
                 {field:'fec_compra',title:'Fecha',width:60},
                 {field:'obs_compra',title:'Observación',width:60},                
                 {field:'baseGrava_compra',title:'Iva',width:60},  
                 {field:'total_compra',title:'Total',width:60}  
                 
            ]]
   
    });
    
    
 
 
 $('#tg').datagrid({
        url:"CONTROLLER/C_Gastos.php?opc=8",
        idField:'id_gasto',
	textField:'id_gasto',
        mode:'remote',
        columns:[[ 
                 {field:'id_gasto',title:'Id Gasto',width:60}, 
                 {field:'fecha_gast',title:'Fecha',width:60},
                 {field:'descrip_gast',title:'Observación',width:60},                
                 {field:'iva_gast',title:'Iva',width:60},  
                 {field:'cant_gast',title:'Total',width:60}  
                 
            ]]
   
    });
    
    $('#tg').datagrid('reloadFooter',[  //inicio foter del datagrid
           {iva_gast:"Total de Ventas : ",cant_gast: 0},
           {iva_gast:"Total de Compras: ",cant_gast: 0},
           {iva_gast:"Total de Gastos : ",cant_gast: 0},       
           {iva_gast:"Total : ",cant_gast: 0}
]); 
      

 
 function vaciarCabecera(){
     dat_venta=[];
     reloadData_venta();
     dat_compra=[];
     reloadData_compra();
     dat_gasto=[];
     reloadData_gasto();
 }
 

 function cargarFactura(){
     var fecini=$("#fec_ini").val();
     var fecfin=$("#fec_final").val();
     var frm="opc=8&fec_ini="+fecini+"&fec_final="+fecfin;
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
                     fecemi_fact:response[pi].fecemi_fact,
                     obs_fact:response[pi].obs_fact,
                     descto_fact:response[pi].descto_fact,
                     iva12_fact:response[pi].iva12_fact,
                     total_fact:parseFloat(response[pi].total_fact)
                     
                    };
                   dat_venta.push(tmp_row);
            
                }
                reloadData_venta();
                
            } 
        }); 
 }
 
 

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
                     fec_compra:response[pi].fec_compra,
                     obs_compra:response[pi].obs_compra,
                     baseGrava_compra:response[pi].baseGrava_compra,
                     total_compra:parseFloat(response[pi].total_compra)                 
                    };
                   dat_compra.push(tmp_row);
            
                }
                reloadData_compra();
                
            } 
        }); 
 }




 function cargarGasto(){
     var fecini=$("#fec_ini").val();
     var fecfin=$("#fec_final").val();
     var frm="opc=8&fec_ini="+fecini+"&fec_final="+fecfin;
      $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Gastos.php",
            data:frm,
            dataType:'json',
            success:function(response){ 
                var tk=response.length;
                for(var pi=0;pi<tk;pi++){

                     var tmp_row={
                     id_gasto:response[pi].id_gasto,
                     fecha_gast:response[pi].fecha_gast,
                     descrip_gast:response[pi].descrip_gast,
                     iva_gast:response[pi].iva_gast,
                     cant_gast:parseFloat(response[pi].cant_gast)                 
                    };
                   dat_gasto.push(tmp_row);
            
                }
              
                reloadData_gasto();
                sumatoria();
            } 
        }); 
 }
 
 
 function sumatoria(){//total de footer
        var tl=$("#dg").datagrid('getRows');
        var lng=tl.length;
        var sum_ventas=0;
        var sum_compra=0;
        var sum_gasto=0;
       
        for(var t=0;t<lng;t++){          
            sum_ventas=sum_ventas+tl[t]['total_fact'];
        }
     
        var tl1=$("#tt").datagrid('getRows');
        var  lng1=tl1.length;       
        for(t=0;t<lng1;t++){          
            sum_compra=sum_compra+tl1[t]['total_compra'];
        }
        
     
        var tl2=$("#tg").datagrid('getRows');
        var lng2=tl2.length;
       
        for(t=0;t<lng2;t++){          
            sum_gasto=sum_gasto+tl2[t]['cant_gast'];
        }
       
        var total1=sum_ventas-sum_compra-sum_gasto;
   
        
         $('#tg').datagrid('reloadFooter',[
           {iva_gast:"Total de Ventas : ",cant_gast: sum_ventas.toFixed(2)},
           {iva_gast:"Total de Compras: ",cant_gast: sum_compra.toFixed(2)},
           {iva_gast:"Total de Gastos : ",cant_gast: sum_gasto.toFixed(2)},       
           {iva_gast:"Total : ",cant_gast: total1.toFixed(2)}
]); 
 }
 

});



