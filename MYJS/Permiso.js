$(document).ready(function(){
    
var cab=[];
var detalle=[];  
    
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
            

  	$('#cmbgridApe').combogrid({
		panelWidth:400,
		url: 'CONTROLLER/C_Persona.php?opc=12',
		idField:'id_persona',
		textField:'nom_persona',
		mode:'remote',
		fitColumns:true,
		columns:[[
            {field:'id_persona',title:'Id',width:20},
            {field:'nom_persona',title:'Nombre',align:'right',width:100},
            {field:'ape_persona',title:'Apellido',align:'right',width:100}, 
            {field:'ruc_persona',title:'Usuario',align:'right',width:100}
                               
		]],
        onSelect:function(rowData){
        	var row =$('#cmbgridApe').combogrid('grid').datagrid('getSelected');
           	$("#txt_apellidos_new").val(row.nom_persona+' '+row.ape_persona);
           	$("#txt_idpersona_new").val(row.id_persona);
           	$("#txt_usuario").val(row.ruc_persona);
           	
           	$.ajax({
           		type:"POST",
           		url:'CONTROLLER/C_Acceso_modulo.php?',
           		data:'opc=7&id_trabajador='+row.id_persona,
           		dataType:'json',
           		success:function(response){
           			detalle = [];
					$.each(response, function(i, item) {
						var tmp_row={
							id:item.id_modulo,
							modulo:item.nom_modulo,
							padre:item.nom_padre
						};
						if(item.nom_padre !== null)
							detalle.push(tmp_row);
					});
					reloadData();
           		}
           	});

        }
	});
                    
  	$('#cmbgridTrabajador').combogrid({
		panelWidth:400,
		url: 'CONTROLLER/C_Persona.php?opc=13',
		idField:'id_persona',
		textField:'nom_persona',
		mode:'remote',
		fitColumns:true,
		columns:[[
		    {field:'id_persona',title:'Id',width:20},
		    {field:'nom_persona',title:'Nombre',align:'right',width:100},
		    {field:'ape_persona',title:'Apellido',align:'right',width:100}, 
		    {field:'ruc_persona',title:'Cédula',align:'right',width:100}
		]],
        onSelect:function(rowData){
	    	var row =$('#cmbgridTrabajador').combogrid('grid').datagrid('getSelected');
	       	$("#txt_update_apellidos").val(row.nom_persona+' '+row.ape_persona);
	       	$("#txt_update_idpersona").val(row.id_persona);
        }
	}); 
  
  
  
	$("#cmbModulo").change(function(){
	    var id=$("#cmbModulo").val();
	    var id_tra = $("#cmbGridApe").val();
	    $("#cmbAccion").load("CONTROLLER/C_Acceso_modulo.php?opc=6", {id_mod: id });
	    
	});
    
    
    function add(){
        if(analizar()){
		    var idp=$("#cmbModulo").val();
		   
		    var id=$("#cmbAccion").val();
		    var padre=$("#cmbModulo option:selected").text();
		    var modulo=$("#cmbAccion option:selected").text();
		     var tmp_row={
		        id:id,
		        modulo:modulo,
		        padre:padre
		    };
		    detalle.push(tmp_row);
		    reloadData();
		    if(analizarCab(id)){
		       var tmp_id={idpadre:idp};   
		       cab.push(tmp_id);
		    }
        }
    }
    function analizarCab(id){
        var aux=0;
        var lon=cab.length;
        for(var t=0;t<lon;t++){
		    if(cab[t].idpadre==id){
		        aux++;
		        break;
		    }
		}
    	if(aux>0)return false;
        else return true;
    }
    
    function reloadData(){
        var datainfo = {
            "rows":detalle
        };
        $('#tt').datagrid('loadData', datainfo);
    }
    
    function vaciarForm(){
    	cab=[];
        detalle=[];
       	reloadData(); 
    }
    
    function analizar(){
        var lon=detalle.length;
    	var id=$("#cmbAccion").val();
        var aux=0;
        for(var tk=0;tk<lon;tk++){
            if(detalle[tk].id==id){
                aux++;
            break;
            }
        }
        if(aux>0)return false;
        else return true;
    }
    
     function Delete(){
        var row = $('#tt').datagrid('getSelected'); 
        var index= detalle.indexOf(row); // Find the index
       	if(index!=-1) detalle.splice(index,1); // Remove it if really found!
        reloadData();
    }
    
   //VALIDATION FORM//
   
   var validatorCab = $("#form_permiso_new").validate({ 
        rules: { 
            txt_apellidos_new: {
                required: true
            },
            txt_clave_new: {
                required: false,
                minlength:5
            },
            txt_usuario: {
            	required: true,
            	minlength:5
            }
        }, 
        messages: { 
            txt_apellidos_new: "Seleccione el Trabajador",
            txt_usuario: "Ingrese un usuario",
            txt_clave_new: "Ingrese una clave"
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
           TrabajadorAcceso_Add();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
   
		var validatorNuevo = $("#frm_combo").validate({ 
        rules: { 
            cmbModulo: {
                required: true
            },
            cmbAccion: {
                required: true
            }
        }, 
        messages: { 
            cmbModulo: "Seleccione el modulo",
            cmbAccion: "Seleccione la acción"
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
         add();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    
    
    var validator_Update_Acceso = $("#frm_update_Acceso").validate({ 
        rules: { 
            txt_update_apellidos: {
                required: true
            }
        }, 
        messages: { 
            txt_apellidos_new: "Seleccione el Trabajador"
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
          	updateTrabajadorAcceso();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
   
    

//DIALOG//
	$('#dialg_msg').dialog({
		autoOpen: false,
		width: 460,
		height: 140,
		modal: true
	});
            
    $('#dial_msg_close').click(function() {
		$('#dialg_msg').dialog('close');
		location.reload();
	});    
     
     
     
  	$("#btn_Permiso_quitar").click(function(){
     	Delete();  
  	});   
  
  	$("#btn_Permiso_Guardar").click(function(){
   		$("#form_permiso_new").submit();
  	});   
  
  	$("#btn_Permiso_Nuevo").click(function(){
      	$("#form_permiso_new .form-field").val ("");
     	vaciarForm();
  	});
  
  
  	$("#btn_updateAcceso_Nuevo").click(function(){
	  	$("#frm_update_Acceso .form-field").val();
  	});
     
                             
  // save_nom_marca              
 	function TrabajadorAcceso_Add(){
        var frmTrabajador_acceso=$("#form_permiso_new").serialize(); 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Acceso_modulo.php?opc=1&"+frmTrabajador_acceso,
            data:({Cabecera:cab,Cuerpo:detalle}),
            success:function(response){ 
               	$('#dialg_msg').dialog('open');
               	$("#msg").text("Los datos se han guardado correctamente.");
               	$("#form_permiso_new .form-field").val ("");
            } 
        }); 
    }
   
 	function updateTrabajadorAcceso(){
     	var frm_acceso=$("#frm_update_Acceso").serialize();  
   		$.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Acceso_modulo.php?opc=3",
            data:frm_acceso,
            success:function(response){ 
               	$('#dialg_msg').dialog('open');
               	$("#msg").text("El acceso de este trabajador ha sido eliminado.");
               	$("#frm_update_Acceso .form-field").val ("");
            } 
        }); 
 	}
 

});
