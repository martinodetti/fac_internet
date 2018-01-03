$(document).ready(function(){
var tipo_proveedor=[];
var tipo_proveedor_update=[];
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
                $('.datepicker').datepicker('option', {dateFormat: 'yy/mm/dd'});
                //carga la fecha actual
                $('.datepicker').datepicker('setDate', new Date());
//AutoComplete plugin
//carga txt_update_tipo_provd conjson
    function loadAjaxJsonProveedor(idprod){
        $.getJSON("CONTROLLER/C_Producto.php?opc=8&show_idprod="+idprod+"&callback=?", function(data){
            var lon=data.length;
           for(var i=0;i<lon;i++){
//               alert(data[i].nombre +" "+data[i].id); 
                var ret = $("<a>").addClass("remove").attr({
                    href: "javascript:",
                    title: "Remove " + data[i].nombre
                });
                var spanp = $("<span class='tag tag-silver' id='"+data[i].id+"'>").text(data[i].nombre).appendTo(ret);
                ret.insertBefore("#update_tipo_proveedor");
           }
        });
   
//         $("#update_tipo_proveedor").text(tmp);
    }
//attach autocomplete
    $("#save_tipo_proveedor").autocomplete({					
        //define callback to format results
        source: function(req, add){					
            $.getJSON("CONTROLLER/C_Producto.php?opc=10&callback=?", req, function(data) {							
                var suggestions = [];		
                $.each(data, function(i, val){	
                    suggestions.push({
                        label: val.nombre,
                        value:val.id
                    });
                });				
                //pass array to callback
                add(suggestions);
            });
        },				
        //define select handler
        select: function(e, ui) {            
            if(verificarSpan(ui.item.value)){
            }else{
                var friend2 = ui.item.label,
                        ap = $("<a>").addClass("remove").attr({
                            href: "javascript:",
                            title: "Remove " + friend2
                        }),
                        spanp = $("<span class='tag tag-silver' id='"+ui.item.value+"'>").text(friend2).appendTo(ap);
                        ap.insertBefore("#save_tipo_proveedor");
            }

        },			
        //define select handler
        change: function() {					
        //prevent 'to' field being updated and correct position
       $("#save_tipo_proveedor").val("").css("top", 2);
        }
    });
    
  //segundo autosuggest  
      $("#update_tipo_proveedor").autocomplete({					
        //define callback to format results
        source: function(req, add){					
            $.getJSON("CONTROLLER/C_Producto.php?opc=10&callback=?", req, function(data) {							
                var suggestions = [];		
                $.each(data, function(i, val){	
                    suggestions.push({
                        label: val.nombre,
                        value:val.id
                    });
                });				
                //pass array to callback
                add(suggestions);
            });
        },				
        //define select handler
        select: function(e, ui) {            
            if(verificarSpanUpdate(ui.item.value)){
            }else{
                var friend2 = ui.item.label,
                        ap = $("<a>").addClass("remove").attr({
                            href: "javascript:",
                            title: "Remove " + friend2
                        }),
                        spanp = $("<span class='tag tag-silver' id='"+ui.item.value+"'>").text(friend2).appendTo(ap);
                        ap.insertBefore("#update_tipo_proveedor");
            }

        },			
        //define select handler
        change: function() {					
        //prevent 'to' field being updated and correct position
       $("#update_tipo_proveedor").val("").css("top", 2);
        }
    });
		
    
 //fin autosuggest
 //
//add click handler to friends div
$("#div_proveedor").click(function(){
    $("#save_tipo_proveedor").focus();
});
$("#div_proveedor2").click(function(){
    $("#update_tipo_proveedor").focus();
});



  $(".tag").livequery("click", function(e){
        $(this).parent().remove();
        return false;
  });	
  
    function verificarSpan(valor){
        var cont=0;
        $("#div_proveedor").find("span").each(function(){
            var val_id=$(this).attr("id");
            if(parseInt(val_id)==parseInt(valor)){
                cont++;
            }
        });
        if(cont>=1)
            return true;
        else
            return false;
    }  
    function verificarSpanUpdate(valor){
        var cont=0;
        $("#div_proveedor2").find("span").each(function(){
            var val_id=$(this).attr("id");
            if(parseInt(val_id)==parseInt(valor)){
                cont++;
            }
        });
        if(cont>=1)
            return true;
        else
            return false;
    }  
 

//$(".remove", document.getElementById("friends")).live("click", function(){
//    //remove current friend
////    $(this).parent().remove();
//    $(this).parent().css("background", "yellow");
//    //correct 'to' field position
//    if($("#friends span").length === 0) {
//        $("#to").css("top", 0);
//    }				
//});	

//fin autocomplete

//VALIDATION FORM//
    var validatorNuevo = $("#frmProducto_Add").validate({ 
        rules: { 
            save_nom_producto: {
                required: false, 
                minlength: 1
            }, 
            save_descrip_producto:{
                 required: true, 
                minlength: 8
            },
            save_codbarra_producto:{
                required: true, 
                minlength:7
            },
            save_id_marca:{
               required: true
            },
            save_id_tiporeten:{
                required: true
            },
            save_id_unimedida:{
               required: true
            },
            save_costo_producto:{
              required: true,
              minlength:1,
              number:true
            },
            save_id_ganancia:{
              required: true
            },
            save_pvp1_producto:{
              required: true  
            },
            save_stkmin_producto:{
              required: true ,
              number:true
            },
            save_stkmax_producto:{
              required: true ,
              number:true  
            },
            save_fecing_producto:{
              required: true  
            },
            save_fecupdate_producto:{
              required: true 
            },
			save_posicion_producto:{
              required: false
            },
            save_img_producto:{
              required:false
            }
            
        }, 
        messages: { 
            save_nom_producto: "Ingrese el nombre del producto",
            save_descrip_producto:"Ingrese la descripción",
            save_codbarra_producto:"Ingrese el código de barra",
            save_id_marca:"Seleccione la marca",
            save_id_tiporeten:"Seleccione la retención",
            save_id_unimedida:"Seleccione la unidad de medida",
            save_costo_producto:"Ingrese el costo",
            save_id_ganancia:"Seleccione la ganancia",
            save_pvp1_producto:"Ingrese el Precio de Venta",
            save_stkmin_producto:"Solo números",
            save_stkmax_producto:"Solo números",
            save_fecing_producto:"Seleccione la fecha de Ingreso",
            save_fecupdate_producto:"Seleccione la fecha de Vencimiento",
			save_posicion_producto:"Debe ingresar una posición para el producto",
            save_img_producto:"Suba una imagen"
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
           frmProducto_Add();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    //validator busca
    var validatorBuscar = $("#frmProducto_Buscar").validate({ 
        rules: { 
            txt_Buscar_Modificar: {
                required: true,
                minlength: 1
            }
        }, 
        messages: { 
            txt_Buscar_Modificar: "Ingrese mínimo un caracter"
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
            resultBusquedad();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    
    //valida el update
    
     var validatorUpdate = $("#frmProducto_Update").validate({ 
        rules: { 
          update_nom_producto: {
                required: true, 
                minlength: 5
            }, 
            update_descrip_producto:{
                 required: true, 
                minlength: 8
            },
          update_codbarra_producto:{
                required: true, 
                minlength:7
            },
            update_id_marca:{
               required: true
            },
            update_id_tiporeten:{
                required: true
            },
           update_id_unimedida:{
               required: true
            },
           update_costo_producto:{
              required: true,
              minlength:1,
              number:true
            },
            update_id_ganancia:{
              required: true
            },
            update_pvp1_producto:{
              required: true  
            },
            update_stkmin_producto:{
              required: true ,
              number:true
            },
            update_stkmax_producto:{
              required: true ,
              number:true  
            },
            update_fecing_producto:{
              required: true  
            },
			update_posicion_producto:{
              required: true  
            },
            update_fecupdate_producto:{
              required: true 
            } 
        }, 
        messages: { 
            update_nom_producto: "Ingrese el nombre del producto",
            update_descrip_producto:"Ingrese la descripción",
            update_codbarra_producto:"Ingrese el código de barra",
            update_id_marca:"Seleccione la marca",
            update_id_tiporeten:"Seleccione la retención",
            update_id_unimedida:"Seleccione la unidad de medida",
            update_costo_producto:"Ingrese el costo",
            update_id_ganancia:"Seleccione la ganancia",
            update_pvp1_producto:"Ingrese el Precio de Venta",
            update_stkmin_producto:"Solo números",
            update_stkmax_producto:"Solo números",
            update_fecing_producto:"Seleccione la fecha de Ingreso",
			update_posicion_producto: "Debe ingresr una posición para le producto",
            update_fecupdate_producto:"Seleccione la fecha de Vencimiento"
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
           frmProducto_Update();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    
    //validacion para el eliminar buscar
    
      var validatorDelete = $("#frmProducto_Buscar_Delete").validate({ 
        rules: { 
            txt_Buscar_Delete: {
                required: true,
                minlength: 1
            }
        }, 
        messages: { 
            txt_Buscar_Delete: "Mínimo un caracter"
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
            //llamo a función buscar_delete_de la vista
          resultBusquedad_Delete();
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
    });      
    

//DIALOG//
		$('#dialg_msg').dialog({
			autoOpen: false,
			width: 460,
			height: 160,
			modal: true
		});
                
        $('#dial_msg_close').click(function() {
//			$('#dialg_msg').dialog('close');
			location.reload();
		});    
      //modal que actuliza          
		$('#dialg_form').dialog({
			autoOpen: false,
			width: 850,
			height: 500,
			modal: true
		}); 
 
 /**
  * Devuelve un array listo para enviar a php
  */
 function array_post(){
     tipo_proveedor=[];
     //ajax-> ({info:data,persona:personal})
        $("#div_proveedor").find("span").each(function(){
            var id_tipo_tmp=$(this).attr("id");
            var tmp_data=[id_tipo_tmp];
           tipo_proveedor.push(tmp_data);
        });
    } 
 function array_postpdate(){
     tipo_proveedor_update=[];
     //ajax-> ({info:data,persona:personal})
        $("#div_proveedor2").find("span").each(function(){
            var id_tipo_tmp=$(this).attr("id");
            var tmp_data=[id_tipo_tmp];
           tipo_proveedor_update.push(tmp_data);
        });
    } 
    
 function subirFoto(){
     var btnUpload=$('#upload_img');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: 'CONTROLLER/C_Producto.php?opc=9',
			name: 'uploadfile',
                         params: {
                         opc: '9'
                                },
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg)$/.test(ext))){
                                      $('#vision').html("<p>Solo JPG O PNG son permitidas.</p>").addClass('Uploaderror');
			             return false;
				}
				status.text('Cargando...');
			},
			onComplete: function(file, response){
				status.text('');
				if(response=="success"){
					$("#save_img_producto").val(file);
					$('#vision').removeClass('Uploaderror');
					$('#vision').removeClass('Uploadfrontal');
					$('#vision').html('');
					$('#vision').html('<img src="./IMG_PROD/'+file+'" alt="" /><br />'+file).addClass('Uploadsuccess');
				} else if(response=="error"){
					$('#vision').html("<p>"+file+"</p>").addClass('Uploaderror');
				}else if(response=="excess"){
					$('#vision').removeClass('Uploadfrontal');
					$('#vision').html("<p>Solo imagenes menores a 20kb.</p>").addClass('Uploaderror');
				}
			}
		});
 }
 
 function subirFoto2(){
     var btnUpload=$('#upload_img2');
		var status=$('#status2');
		new AjaxUpload(btnUpload, {
			action: 'CONTROLLER/C_Producto.php?opc=9',
			name: 'uploadfile',
                         params: {
                         opc: '9'
                                },
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg)$/.test(ext))){
                                      $('#vision2').html("<p>Solo JPG O PNG son permitidas.</p>").addClass('Uploaderror');
			             return false;
				}
				status.text('Cargando...');
			},
			onComplete: function(file, response){
				status.text('');
				if(response=="success"){
                                    $("#update_img_producto").val(file);
                                    $('#vision2').removeClass('Uploaderror');
                                    $('#vision2').removeClass('Uploadfrontal');
                                    $('#vision2').html('');
					$('#vision2').html('<img src="./IMG_PROD/'+file+'" alt="" /><br />'+file).addClass('Uploadsuccess');
				} else if(response=="error"){
					$('#vision2').html("<p>"+file+"</p>").addClass('Uploaderror');
				}else if(response=="excess"){
                                    $('#vision2').removeClass('Uploadfrontal');
                                    $('#vision2').html("<p>Solo imagenes menores a 20kb.</p>").addClass('Uploaderror');
                                }
			}
		});
 }
 
 
 $("#upload_img").click(function(){
     subirFoto();
 });
 $("#upload_img2").click(function(){
     subirFoto2();
 });
 
    //Nota: Agregar un tiempo adicional, al recibir el return del response.1s es sugerido.
    //Documentación:Nombres que debe tener las cajas de texto para Guardar.
    // save_id_producto 1
    // save_id_tiporeten    1
    // save_id_marca    1
    // save_id_unimedida    1
    // save_id_ganancia     1
    // save_codbarra_producto   1
    // save_nom_producto    1
    // save_descrip_producto    1
    // save_costo_producto  1
    // save_pvp1_producto   1
    // save_stock_producto  1 =0 no envia post
    // save_stkmin_producto 1
    // save_stkmax_producto 1
    // save_img_producto    1
    // save_fecing_producto 1
    // save_fecupdate_producto   1
    // save_estado_producto 1

    function frmProducto_Add(){
        array_post();
        var frmProducto=$("#frmProducto_Add").serialize(); 
//        alert(frmProducto);
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Producto.php?opc=1&"+frmProducto,
            data:({Proveedor:tipo_proveedor}),
            success:function(response){ 
               $('#dialg_msg').dialog('open');
               $("#msg").text("Los datos se han guardado correctamente.");
            } 
        }); 
    }
    
   
$("#btn_Producto_New").click(function(){
     $("#frmProducto_Add .form-field").val (""); 
      $(".tag").remove();
});
$(".clsMatrizModificar").livequery("click", function(e){
     $(".tag").remove();
  var id_prod=$(this).attr("id").replace("btn_update","");
  loadAjaxJsonProveedor(id_prod);
   var nomprod=$("#nom_"+id_prod).val();  
   var costo=$("#costo_"+id_prod).val();  
   var pvp=$("#pvp_"+id_prod).val();  
   var fecing=$("#fecing_"+id_prod).val();  
   var fecupdate=$("#fecupdate_"+id_prod).val();  
   var codbarra=$("#codbarra_"+id_prod).val();  
   var descrip=$("#descrip_"+id_prod).val();  
   var stkmin=$("#stkmin_"+id_prod).val();  
   var stkmax=$("#stkmax_"+id_prod).val();  
   
  var imgprod=$("#imgprod_"+id_prod).val();  
  var tiporeten=$("#tiporeten_"+id_prod).val();  
  var marca=$("#marca_"+id_prod).val(); 
  var medida=$("#medida_"+id_prod).val();  
  var ganancia=$("#ganancia_"+id_prod).val();  
  
  $("#update_id_producto").val(id_prod);
  $("#update_nom_producto").val(nomprod);
  $("#update_descrip_producto").val(descrip);
  $("#update_codbarra_producto").val(codbarra);
//  
  $("#update_id_marca").val(marca);
  $("#update_id_tiporeten").val(tiporeten);
  $("#update_id_unimedida").val(medida);
  $("#update_costo_producto").val(costo);
  $("#update_id_ganancia").val(ganancia);
  
  $("#update_pvp1_producto").val(pvp);
//  
   $("#update_stkmin_producto").val(stkmin);
   $("#update_stkmax_producto").val(stkmax);
//   //fechas aun faltan
$("#update_fecing_producto").val(fecing);
 $("#update_fecupdate_producto").val(fecupdate)
  $("#update_img_producto").val(imgprod);
 $('#vision2').removeClass('Uploaderror');                               
 $('#vision2').removeClass('Uploadfrontal');
 $("#vision2").html('<img src="./IMG_PROD/'+imgprod+'" alt="" /><br />').addClass('Uploadsuccess');
 $('#dialg_form').dialog('open');
 
});


$(".clsMatrizEliminar").livequery("click", function(e){
     var id=$(this).attr("id").replace("btn_delete","");
     var frmProducto="delete_id_producto="+id+"&opc=3"; 
        $.ajax({ 
            type:"POST",
            url:"Controller/C_Producto.php",
            data:frmProducto,
            success:function(response){ 
                $('#dialg_msg').dialog('open');
                $("#msg").text("Registro eliminado sactisfactoriamente.");
                $("#tabla_result_delete").empty();
            } 
        }); 
});


$("#btn_Producto_Cancel").click(function(){
//nombre del formulario: frmProducto_Update 
 $('#dialg_form').dialog('close');


});

 function resultBusquedad(){
        var val_producto=$("#txt_Buscar_Modificar").val();
        var frmProveedor="opc=5&show_producto="+val_producto; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Producto.php",
            data:frmProveedor,
            success:function(response){ 
                $("#tabla_result").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
    
   function resultBusquedad_Delete(){
        var val_producto=$("#txt_Buscar_Delete").val();
        var frmProducto="opc=7&show_producto_delete="+val_producto; 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Producto.php",
            data:frmProducto,
            success:function(response){ 
                $("#tabla_result_delete").html($(response).fadeIn('slow')); 
            } 
        }); 
    }
  
    

    //Documentación: Nombres que debe tener las cajas de texto para Actualizar.

    // update_id_producto .     1

    // update_id_tiporeten . 1

    // update_id_marca . 1

    // update_id_unimedida . 1

    // update_id_ganancia . 1

    // update_codbarra_producto . 1

    // update_nom_producto . 1

    // update_descrip_producto .  1

    // update_costo_producto . 1

    // update_pvp1_producto . 1

    // update_stock_producto . 1

    // update_stkmin_producto . 1

    // update_stkmax_producto . 1

    // update_img_producto . 1

    // update_fecing_producto . 1

    // update_fecupdate_producto . 1

    // update_estado_producto . 1

 function frmProducto_Update(){//FALTA EL ARRAY DE PROVEDORES
     array_postpdate();
        var frmProducto=$("#frmProducto_Update").serialize(); 
        $.ajax({ 
            type:"POST",
            url:"CONTROLLER/C_Producto.php?opc=2&"+frmProducto,
            data:({Proveedor:tipo_proveedor_update}),
            success:function(response){ 
                 $('#dialg_form').dialog('close');
                $('#dialg_msg').dialog('open');
                $("#msg").text("Los datos se han actualizado correctamente");
                $("#tabla_result").empty();
            } 
        }); 
    }
    
 $("#update_id_ganancia").click(function() {
     var gana=$("#update_id_ganancia option:selected").text();
     gana=gana/100;
     var costo=$("#update_costo_producto").val();     
     costo= parseFloat(costo) + parseFloat(costo)*parseFloat(gana);
     costo=costo.toFixed(2);//redondeo dos decimales
    $("#update_pvp1_producto").val(costo);
 });
 $("#save_id_ganancia").click(function() {
     var gana=$("#save_id_ganancia option:selected").text();
     gana=gana/100;
     var costo=$("#save_costo_producto").val();     
     costo= parseFloat(costo) + parseFloat(costo)*parseFloat(gana);
     costo=costo.toFixed(2);//redondeo dos decimales
    $("#save_pvp1_producto").val(costo);
 });


    
   
});



