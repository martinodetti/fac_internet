$(document).ready(function(){
    
    
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
                
 //DATAPICKER//
		$(".datepicker").datepicker();
                $('.datepicker').datepicker('option', {dateFormat: 'yy/mm/dd'});
                //carga la fecha actual
                $('.datepicker').datepicker('setDate', new Date());
                
 $('#cmbgrid').combogrid({
				panelWidth:800,
				url: 'CONTROLLER/C_Compra.php?opc=10',
				idField:'id_producto',
				textField:'nom_producto',
				mode:'remote',
				fitColumns:true,
				columns:[[
                                    {field:'id_producto',title:'Id',width:20},
                                    {field:'nom_producto',title:'Producto',align:'right',width:150},
                                    {field:'descrip_producto',title:'Descripción',align:'right',width:500}, 
                                    {field:'costo_producto',title:'Costo',align:'right',width:60}, 
                                    {field:'stock_producto',title:'Stock',align:'right',width:60}
				]],
                                onSelect:function(rowData){
                                var row =$('#cmbgrid').combogrid('grid').datagrid('getSelected');
                                $("#txt_id_producto").val(row.id_producto);
//                                $("#txt_costo").val(row.costo_producto);
//                                $("#txt_idproducto").val(row.id_producto);
//                                $("#txt_nom_producto").val(row.nom_producto);
                                
                                }
			});  


    //Nota: Agregar un tiempo adicional, al recibir el return del response.1s es sugerido.
    //Documentación:Nombres que debe tener las cajas de texto para Guardar.
    
    
    $("#btn_Buscar").click(function(){
        var id_prod=$("#txt_id_producto").val();
        var fec_ini=$("#fec_ini").val();
        var fec_final=$("#fec_final").val();
        var dt="opc=4&id_prod="+id_prod+"&fec_ini="+fec_ini+"&fec_fin="+fec_final;
         $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Kardex.php",
            data:dt,
            success:function(response){ 
//                alert(response);
                $("#tabla_result").empty();
                $("#tabla_result").html($(response).fadeIn('slow')); 
                
            } 
            
        }); 
    });
    
    
    // save_id_kardex
    // save_id_factcmp_kardex
    // save_tipo_entrdsald_kardex
    // save_tipo_cmpbt_kardex
    // save_cod_factcmp_kardex
    // save_fecha_kardex
    // save_estado_kardex
    
    $("#btn_Kardex_Add").click(function(){
        
        //nombre del formulario: frmKardex_Add 
        
        var frmKardex=$("#frmKardex_Add").serialize(); 
        
        frmKardex=frmKardex+"&opc=1"; 
        
        $.ajax({ 
            
            type:"POST",
            
            url:"CONTROLLER/C_kardex.php",
            
            data:frmKardex,
            
            success:function(response){ 
                
                $("#mydiv").html($(response).fadeIn('slow')); 
                
            } 
            
        }); 
        
    });
    
    
    
    //Documentación: Nombres que debe tener las cajas de texto para Actualizar.
    
    // update_id_kardex . 
    
    // update_id_factcmp_kardex . 
    
    // update_tipo_entrdsald_kardex . 
    
    // update_tipo_cmpbt_kardex . 
    
    // update_cod_factcmp_kardex . 
    
    // update_fecha_kardex . 
    
    // update_estado_kardex . 
    
    $("#btn_Kardex_Update").click(function(){
        
        //nombre del formulario: frmKardex_Update 
        
        var frmKardex=$("#frmKardex_Update").serialize(); 
        
        frmKardex=frmKardex+"&opc=2"; 
        
        $.ajax({ 
            
            type:"POST",
            
            url:"CONTROLLER/C_kardex.php",
            
            data:frmKardex,
            
            success:function(response){ 
                
                $("#mydiv").html($(response).fadeIn('slow')); 
                
            } 
            
        }); 
        
    });
    
    //Documentación: Nombres que debe tener la caja de texto para Delete.
    
    // delete_id_kardex . 
    
    $("#btn_Kardex_Delete").click(function(){
        
        //nombre del formulario: frmKardex_Delete 
        
        var id_kardex=$("#delete_id_kardex").val();
        var frmKardex="delete_id_kardex="+id_kardex+"&opc=3"; 
        
        $.ajax({ 
            
            type:"POST",
            
            url:"Controller/C_kardex.php",
            
            data:frmKardex,
            
            success:function(response){ 
                
                $("#mydiv").html($(response).fadeIn('slow')); 
                
            } 
            
        }); 
        
    });
    
    //Documentación: Nombres que debe tener la caja de texto para Show.
    
    // show_id_kardex . 
    
    $("#btn_Kardex_Show").click(function(){
        
        var id_kardex=$("#show_id_kardex").val();
        var frmKardex="show_id_kardex="+id_kardex+"&opc=4"; 
        
        $.ajax({ 
            
            type:"POST",
            
            url:"CONTROLLER/C_kardex.php",
            
            data:frmKardex,
            
            success:function(response){ 
                
                $("#mydiv").html($(response).fadeIn('slow')); 
                
            } 
            
        }); 
        
    });
    
    $("#btn_Kardex_List").click(function(){
        
        //nombre del formulario: frmKardex_List 
        
        var frmKardex=$("#frmKardex_List").serialize(); 
        
        frmKardex=frmKardex+"&opc=5"; 
        
        $.ajax({ 
            
            type:"POST",
            
            url:"Controller/C_kardex.php",
            
            data:frmKardex,
            
            success:function(response){ 
                
                
            } 
            
        }); 
        
    });
    
});
