

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
                
         $(".datepicker").datepicker();
                $('.datepicker').datepicker('option', {dateFormat: 'yy/mm/dd'});
                //carga la fecha actual
                $('.datepicker').datepicker('setDate', new Date());
                
                
        $("#btn_Cliente_filtrar").click(function(){
            var fecha=$("#fecha_cliente_buscar").val();
            var dat="fecha="+fecha+"&opc=1";
                     $.ajax({ 
                    type:"POST",
                    url:"CONTROLLER/C_Cliente_pago.php",
                    data:dat,
                    success:function(response){ 
                        $("#div_pago_pendiente").html($(response).fadeIn('slow'));       
                    }  
                }); 
            
        });


});