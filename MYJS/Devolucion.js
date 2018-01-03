$(document).ready(function(){

var cont=0;
 var dat=[];//modelo del grid
$('#tt').datagrid('reloadFooter',[  //inicio foter del datagrid
    {cantidad:"SubTotal : ",total: 0},
    {cantidad:"Iva 0% : ",total: 0},
    {cantidad:"Iva 12% : ",total: 0},
    {cantidad:"Descto (%) : ",total: 0},
    {cantidad:"Total : ",total: 0}
]);   

 function Add(){
       
       if(verificarDat()){
            cont++;
             var idprod=  $("#txt_idproducto").val();
            var prod=  $("#txt_nom_producto").val();
            var precio=$("#txt_precio").val();
            precio=parseFloat(precio);
            var canti=$("#txt_cantidad").val();
            canti=parseInt(canti);
            var subt=$("#txt_sub").val();
            subt=parseFloat(subt);
            var tmp_row={
                id:idprod,
                producto:prod,
                precio:precio,
                cantidad:canti,
                total:subt
            };
            dat.push(tmp_row);
            reloadData();
            sumatoria();
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
        var descto=$("#cmbDescto option:selected").text();
        descto=parseFloat(descto);
        var lng=tl.length;
        var sum=0;
        for(var t=0;t<lng;t++){
            //              var ret=tl[i]['producto'];
            sum=sum+tl[t]['total'];
        }
        var iva=sum*0.12;
//        iva=iva.toFixed(2);
        var toto=sum+iva;
        var tdsct=(descto*sum)/100;
        toto=toto-tdsct;
//        toto=toto.toFixed(2);
        $('#tt').datagrid('reloadFooter',[
           {cantidad:"SubTotal : ",total: sum.toFixed(2)},
           {cantidad:"Iva 0% : ",total: 0},
           {cantidad:"Iva 12% : ",total: iva.toFixed(2)},
           {cantidad:"Descto (%) : ",total: tdsct.toFixed(2)},
           {cantidad:"Total : ",total: toto.toFixed(2)}
        ]);
        $("#save_descto_fact").val(tdsct.toFixed(2));
        $("#iva12_fact").val(iva.toFixed(2));
        $("#total_fact").val(toto.toFixed(2));

     
    }

 function verificarDat(){//tomo el ide del producto
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
                
        $('#dial_msg_close').click(function() {
			$('#dialg_msg').dialog('close');
		});    
    
    $('#cmbgridFactura').combogrid({
            panelWidth:800,
            url: 'CONTROLLER/C_Devolucion.php?opc=6',
            idField:'id_fact',
            textField:'id_fact',
            mode:'remote',
            fitColumns:true,
            columns:[[
                {field:'id_fact',title:'Factura',width:50},
                {field:'cliente',title:'Cliente',align:'right',width:300},
                {field:'ruc',title:'RUC',align:'right',width:150}, 
                {field:'descto_fact',title:'Descto',align:'right',width:80},
                {field:'iva12_fact',title:'Iva',align:'right',width:80},
                {field:'total_fact',title:'Total',align:'right',width:80}
            ]],
            onSelect:function(rowData){
            var row =$('#cmbgridFactura').combogrid('grid').datagrid('getSelected');
               $("#txt_apellidos_fact").val(row.cliente);
               $("#txt_ruc_fact").val(row.ruc);
              
               
            },
            onClickRow:function(rowData){
                vaciarVector();
                var row =$('#cmbgridFactura').combogrid('grid').datagrid('getSelected');
                $("#cmbDescto option:selected").text(row.descto_fact);
                 $("#save_id_factcmp_devo").val(row.id_fact);
                 $("#save_descto_devo").val(row.descto_fact);
                 $("#save_iva12_devo").val(row.iva12_fact);
                 $("#save_total_devo").val(row.total_fact);
               cargarDetalleFactura(row.id_fact);
                
            }
    });
 $('#cmbgridProducto').combogrid({
				panelWidth:800,
				url: 'CONTROLLER/C_Factura.php?opc=6',
				idField:'id_producto',
				textField:'nom_producto',
				mode:'remote',
				fitColumns:true,
				columns:[[
                                    {field:'id_producto',title:'Id',width:20},
                                    {field:'nom_producto',title:'Producto',align:'right',width:150},
                                    {field:'descrip_producto',title:'Descripción',align:'right',width:500}, 
                                    {field:'pvp1_producto',title:'Precio',align:'right',width:60}, 
                                    {field:'stock_producto',title:'Stock',align:'right',width:60}
				]],
                                onSelect:function(rowData){
                                var row =$('#cmbgridProducto').combogrid('grid').datagrid('getSelected');
                                $("#txt_idproducto").val(row.id_producto);
                                $("#txt_nom_producto").val(row.nom_producto);
                                var tot=row.pvp1_producto*1;
                                 $("#txt_precio").val(row.pvp1_producto);
                                 $("#txt_cantidad").val(1);
                                 $("#txt_sub").val(tot);
                                
                                }
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

var validator_addproducto = $("#frm_AddProducto").validate({ 
        rules: { 
            txt_precio: {
                required: true, 
                number: true
            },
            txt_cantidad: {
                required: true, 
                digits: true
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
                required: true
            },
            save_obs_devo: {
                required: true, 
               minlength:5
            }
        }, 
        messages: { 
            txt_apellidos_fact: "Requerido",
            txt_ruc_fact:"Requerido",
            save_obs_devo:"Ingrese el concepto de la compra"
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
            frm_Devolucion_Add();
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
    
    $("#btn_Devolucion_New").click(function(){
       vaciarVector();
       $("#frm_factura .form-field").val ("");
    });

 function cargarDetalleFactura(ID_FACT){
     var frm="opc=7&id_fact="+ID_FACT;
      $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Devolucion.php",
            data:frm,
            dataType:'json',
            success:function(response){ 
                var tk=response.length;
                for(var pi=0;pi<tk;pi++){
                    var sub=response[pi].precio_detfact*response[pi].canti_detfact;
                    sub=sub.toFixed(2)*1;
                     var tmp_row={
                     id:response[pi].id_producto,
                     producto:response[pi].nom_producto,
                     precio:response[pi].precio_detfact,
                     cantidad:response[pi].canti_detfact,
                     total:sub
                    };
                   dat.push(tmp_row);
            
                }
                reloadData();
                sumatoria();
            } 
        }); 
 }
 

//Nota: Agregar un tiempo adicional, al recibir el return del response.1s es sugerido.
//Documentación:Nombres que debe tener las cajas de texto para Guardar.

// save_id_devo 0
// save_id_factcmp_devo 1
// save_tipo_cmpbt_devo 1   (3 porqu es venta)
// save_descto_devo 1
// save_iva12_devo  1
// save_total_devo  1
// save_obs_devo    1
// save_fecha_devo  0
// save_estado_devo 0

function frm_Devolucion_Add(){
      var frmDevo=$("#frm_factura").serialize(); 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Devolucion.php?opc=1&"+frmDevo,
            data:({Detalle:dat}),
            success:function(response){ 
               
               $('#dialg_msg').dialog('open');
               $("#msg").text("Los datos se han guardado correctamente.");
            } 
        }); 
}


    $("#btn_Devolucion_Add").click(function(){
        $("#frm_factura").submit();
    });


 

//Documentación: Nombres que debe tener las cajas de texto para Actualizar.

// update_id_devo . 

// update_id_factcmp_devo . 

// update_tipo_cmpbt_devo . 

// update_descto_devo . 

// update_iva12_devo . 

// update_total_devo . 

// update_obs_devo . 

// update_fecha_devo . 

// update_estado_devo . 



});
