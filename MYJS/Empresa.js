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
			height: 160,
			modal: true
		});
                
        $('#dial_msg_close').click(function() {
			$('#dialg_msg').dialog('close');
		});                
                

  var validator_frmEmpresa_Update = $("#frmEmpresa_Update").validate({ 
        rules: { 
            update_razsocial_empresa: {
                required: true,
                minlength: 5
            },
            update_ruc_empresa:{
                required:true,
                number:true,
                minlength:13
            },
            update_id_ciudad:{
                 required:true
            },
            update_id_contador:{
                 required:true
            },
            update_id_representante:{
                 required:true
            },
            update_cel_empresa:{
                 required:true,
                 number:true,
                 minlength:9
            },
            update_telf_empresa:{
                 required:true,
                 number:true,
                 minlength:5
            },
            update_web_empresa:{
                 required:true,
                 minlength:5   
            },
            update_correo_empresa:{
                required:true,
                email:true
            },
            update_direc_empresa:{
                required:true,
                minlength:5   
            }
        }, 
        messages: { 
          update_razsocial_empresa  : "Requerido",
          update_ruc_empresa: "Requerido",
          update_id_ciudad : "Requerido",
          update_id_contador : "Requerido",
          update_id_representante : "Requerido",
          update_cel_empresa : "Requerido",
          update_telf_empresa : "Requerido",
          update_web_empresa : "Requerido",
          update_correo_empresa : "Requerido",
          update_direc_empresa : "Requerido"
          
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
            //llamo a esta función
           frmEmpresa_Update();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    
loading_data();

    //Documentación: Nombres que debe tener las cajas de texto para Actualizar.
    // update_id_empresa . 1
    // update_id_contador . 1
    // update_id_representante . 1
    // update_id_ciudad . 1
    // update_razsocial_empresa .   1
    // update_ruc_empresa . 1
    // update_direc_empresa .   1
    // update_telf_empresa .    1
    // update_cel_empresa . 1
    // update_web_empresa . 1
    // update_correo_empresa . 1
    // update_fecha_empresa . 1
    
    function frmEmpresa_Update(){
        //nombre del formulario: frmEmpresa_Update 
        var frmEmpresa=$("#frmEmpresa_Update").serialize(); 
        frmEmpresa=frmEmpresa+"&opc=2"; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Empresa.php",
            data:frmEmpresa,
            success:function(response){ 
               $('#dialg_msg').dialog('open');
               $("#msg").text("Los datos se han actualizado correctamente.");
            } 
        }); 
    }
    
   function loading_data(){
        window.setTimeout(function(){
            var id_cont=$("#id_contador").val();
            var id_repre=$("#id_representante").val();
            var id_ciudad=$("#id_ciudad").val(); 
            $("#update_id_ciudad").val(id_ciudad);
            $("#update_id_contador").val(id_cont);
            $("#update_id_representante").val(id_repre);
         },1000);
   }


});
