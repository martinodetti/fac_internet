$(document).ready(function(){

var porcentaje_iva=0.12;
var dat=[];//modelo del grid
var cont=0;

$('#tt').datagrid('reloadFooter',[
     {cantidad:"Subtotal: ",total:0},
     {cantidad:"Iva 0%: ",total:0},
     {cantidad:"Iva 12%: ",total:0},
     {cantidad:"Total: ",total:0}
]);
    
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
        
$(".datepicker").datepicker();
            $('.datepicker').datepicker('option', {dateFormat: 'yy/mm/dd'});
            //carga la fecha actual
            $('.datepicker').datepicker('setDate', new Date());       
        
           
           
      //validaciones
  

var validator_addproducto = $("#frm_AddProducto").validate({ 
        rules: { 
            txt_nomproduc:{
                required:true,
                minlength:5
            },
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
            txt_nomproduc:"Requerido",
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
    
    
    
    var validator_addGasto = $("#frmGastos_Add").validate({ 
        rules: { 
            save_id_factura:{
                required: true,
                minlength:3,
                number:true
            },
            
            save_nom_empresa_gast:{
                required: true,
                minlength:5
            },
            
            save_nom_comp_gast:{
                required: true,
                minlength:5
            },
                  
            save_descrip_gast: {
                required: true, 
               minlength:5
            }
        }, 
        messages: { 
            save_id_factura:"Requerido",
            save_descrip_gast:"Ingrese el concepto del gasto",
            save_nom_comp_gast:"Requerido",
            save_nom_empresa_gast:"Requerido"
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
            frmGastos_Add();
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
    
$("#btn_gasto_New").click(function(){
       vaciarVector();
       $("#frmGastos_Add .form-field").val ("");
    });

$("#btn_gasto_Add").click(function(){
        $("#frmGastos_Add").submit();
    });
    
    
 $("#txt_cantidad").keyup(function(){
    var v1= $("#txt_precio").val();
    var v2= $("#txt_cantidad").val();
    var v3=v1*v2;
    $("#txt_sub").val(v3.toFixed(2));
});
     
     
    // save_id_gasto
    // save_descrip_gast
   
    // save_fecha_gast
    // save_prec_uni_gast
    // save_id_factura
    // save_nom_empresa_gast
    // save_nom_comp_gast
    // save_iva_gast
 // save_cant_gast
    function frmGastos_Add()
    {
        //nombre del formulario: frmGastos_Add 
        var frmGastos=$("#frmGastos_Add").serialize(); 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_gastos.php?opc=1&"+frmGastos,
            data:({Detalle:dat}),
            dataType:"json",
            success:function(response){ 

                     $('#dialg_msg').dialog('open');
                     $("#msg").text("Los datos se han guardado correctamente.");
                     vaciarVector();
                     $("#frmGastos_Add .form-field").val ("");

            } 

        }); 

    }

 

    //Documentación: Nombres que debe tener las cajas de texto para Actualizar.

    // update_id_gasto . 

    // update_descrip_gast . 

    // update_cant_gast . 
    // update_fecha_gast . 
    // update_prec_uni_gast . 
    // update_id_factura . 
    // update_nom_empresa_gast . 
    // update_nom_comp_gast . 
    // update_iva_gast . 

    function frmGastos_Update()
    {


        //nombre del formulario: frmGastos_Update 

        var frmGastos=$("#frmGastos_Update").serialize(); 

        frmGastos=frmGastos+"&opc=2"; 

        $.ajax({ 

            type:"POST",

            url:"CONTROLLER/C_gastos.php",

            data:frmGastos,

            success:function(response){ 

                $("#mydiv").html($(response).fadeIn('slow')); 

            } 

        }); 

    }

    //Documentación: Nombres que debe tener la caja de texto para Delete.

    // delete_id_gasto . 

    function frmGastos_Delete()
    {

        //nombre del formulario: frmGastos_Delete 

        var id_gasto=$("#delete_id_gasto").val();
        var frmGastos="delete_id_gasto"+id_gasto+"&opc=3"; 

        $.ajax({ 

            type:"POST",

            url:"Controller/C_gastos.php",

            data:frmGastos,

            success:function(response){ 

                $("#mydiv").html($(response).fadeIn('slow')); 

            } 

        }); 

    }

    //Documentación: Nombres que debe tener la caja de texto para Show.

    // show_id_gasto . 
    function show_id_gasto()
    {


        var id_gasto=$("#show_id_gasto").val();
        var frmGastos="show_id_gasto"+id_gasto+"&opc=4"; 

        $.ajax({ 

            type:"POST",

            url:"CONTROLLER/C_gastos.php",

            data:frmGastos,

            success:function(response){ 

                $("#mydiv").html($(response).fadeIn('slow')); 

            } 

        }); 

    }

    function frmGastos_List()
    {


        //nombre del formulario: frmGastos_List 

        var frmGastos=$("#frmGastos_List").serialize(); 

        frmGastos=frmGastos+"&opc=5"; 

        $.ajax({ 

            type:"POST",

            url:"Controller/C_gastos.php",

            data:frmGastos,

            success:function(response){ 


            } 

        }); 

    }
    
    
    
    
    
    function Add(){
        cont++;
            var prod=  $("#txt_nomproduc").val();
            var precio=$("#txt_precio").val();
            precio=parseFloat(precio);
            var canti=$("#txt_cantidad").val();
            canti=parseInt(canti);
            var subt=$("#txt_sub").val();
            subt=parseFloat(subt);
            var tmp_row={
                
                producto:prod,
                precio:precio,
                cantidad:canti,
                total:subt
            };
            dat.push(tmp_row);
            reloadData();
            sumatoria();       
    }
    
    
    
    function sumatoria()
    {
        
         var fila=$("#tt").datagrid('getRows');
         var lnt=fila.length;
         var suma=0;
         for(var i=0;i<lnt;i++)
         {
             suma=suma+fila[i]['total'];
         }
         var iva=suma*porcentaje_iva;
         var total=iva+suma;
         $('#tt').datagrid('reloadFooter',[
             {cantidad:"Subtotal: ",total:suma.toFixed(2)},
             {cantidad:"Iva 0%: ",total:0},
             {cantidad:"Iva 12%: ",total:iva.toFixed(2)},
             {cantidad:"Total: ",total:total.toFixed(2)}
         ]);
        $("#save_iva_gast").val(iva.toFixed(2));
        $("#save_cant_gast").val(total.toFixed(2));
       
    }
    
    function reloadData(){
        var datainfo = {
            "total":0,
            "rows":dat
        };
        $('#tt').datagrid('loadData', datainfo);
    }
    
    function Delete(){
        
       var row = $('#tt').datagrid('getSelected'); 
       var index= dat.indexOf(row); // Find the index
       if(index!=-1) dat.splice(index,1); // Remove it if really found!
        reloadData();
        sumatoria();
    } 
    
    
    function vaciarVector(){
      dat=[];
      cont=0;
      reloadData();
      sumatoria();
  }
   

});