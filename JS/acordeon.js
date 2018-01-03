$(document).ready(function(){
	
	$(".accordion h3:first").addClass("active");
	$(".accordion div:not(:first)").hide();

	$(".accordion h3").click(function(){
		$(this).next("div").slideToggle("fast")
		.siblings("div:visible").slideUp("fast");
		$(this).toggleClass("active");
		$(this).siblings("h3").removeClass("active");

	});

  $('a.blocker').livequery("click", function(e){
        var c_id =  $(this).attr('id').replace('block-','');
       if(c_id==1){
            $.post("block-"+c_id+".php?", {  }, function(response){
         $('#div-1').html($(response).fadeIn('slow'));});
       }
       else if(c_id==2){
         $.post("Form.php?", {  }, function(response){
         $('#div-1').html($(response).fadeIn('slow'));});
        }
        else if(c_id==3){
               $.ajax({
        type:"POST",
        url:"Phpsesion.php?",
        data:"",
        dataType:"json",
        success:function(msg){
            if(parseInt(msg.status)==1){
//                window.location=msg.txt;
           alert(msg.txt);

            }else if(parseInt(msg.status)==0){
                alert(msg.txt);
            }
        }
        });
          }
        
    });
     $('#btnLog').livequery("click", function(e){
         var data=$("#frm").serialize();
         var val=$("#txtCorreo").val();
        if( validateCorreo(val)){
             $.ajax({
        type:"POST",
        url:"Verificar.php?",
        data:data,
        dataType:"json",
        success:function(msg){
            if(parseInt(msg.status)==1){
//                window.location=msg.txt;
           alert(msg.txt);

            }else if(parseInt(msg.status)==0){
                alert(msg.txt);
            }
        }
        });
        }else{
            alert("Correo invalido");
        }

});


});

function validateCorreo(correo)
{
     var a = correo;
    var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
    //if it's valid email
    if(filter.test(a)){

        return true;
    }
    //if it's NOT valid
    else{

        return false;
    }
}