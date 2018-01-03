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
    $(".tabs.sortable").tabs().find(".ui-tabs-nav").sortable({
        axis:'x'
    });

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
    $('.datepicker').datepicker('option', {
        dateFormat: 'yy/mm/dd'
    });
    //carga la fecha actual
    $('.datepicker').datepicker('setDate', new Date());
     
     var oTable=  $('#table-example').dataTable({
        "bServerSide": true,
//        "bProcessing": true,
        "bFilter": true,
        "bJQueryUI": true,
        "sAjaxSource": "VIEW/WBuscarPago.php?",
        "fnServerParams": function ( aoData ) {
            aoData.push( { "name": "fecIni", "value": $("#fecIni_cliente_buscar").val() },{ "name": "fecFin", "value": $("#fecFin_cliente_buscar").val() } );
        },
        "sPaginationType": "full_numbers",
        "sDom": '<"H"Tfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            "copy", "csv", "xls", "pdf"                          
            ]
        }
    });
              
       $('div.dataTables_filter input').unbind();
    $('div.dataTables_filter input').bind('keyup', function(e) {
        var dat=$(this).val();
        if((dat.length>=2)||(e.keyCode == 13)){
            oTable.fnFilter($(this).val());
        }
    });          
     
      $("#btn_Cliente_filtrar").click(function(){
            oTable.fnFilter('');
      });
     
});