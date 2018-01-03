/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {

		//BOX LOGIN ERROR TEST//
		$("#content-login .error").hide();
		$("#error").click(function() {
			$("#box-login").show('shake', 55);
			$(".header-login").show('shake', 55);
			$("#content-login .error").show('blind', 500);
			return false;
		});
                $(".message").click(function() {
                      $(this).hide('blind', 500);
                      return false;
               });
		
		//focus en la busqueda de articulos
		$("#username").focus();
		
		
		$("#login").click(function(){    
			login();    
/*		      
           var cedula=$("#username").val();
           var clave=$("#password").val();
            $.ajax({
                type:"POST",
                url:"CONTROLLER/C_Persona.php",
                data:"opc=6&txt_cedula="+cedula+"&txt_clave="+clave,
                dataType:"json",
                success:function(response){

                   if(parseInt(response.estado)==1){
                     window.location=response.txt;
                   }  else{
                     $("#box-login").show('shake', 55);
                        $(".header-login").show('shake', 55);
                        $("#content-login .error").show('blind', 500);
                    }
                                    
                  }
               }); 
*/                
        });
        
        $("#password").keypress(function(e){
        	if(e.which == 13){
        		login();
        	}
        });
		
		function login(){
			var cedula=$("#username").val();
           	var clave=$("#password").val();
            $.ajax({
                type:"POST",
                url:"CONTROLLER/C_Persona.php",
                data:"opc=6&txt_cedula="+cedula+"&txt_clave="+clave,
                dataType:"json",
                success:function(response){

                   if(parseInt(response.estado)==1){
                     window.location=response.txt;
                   }  else{
                     $("#box-login").show('shake', 55);
                        $(".header-login").show('shake', 55);
                        $("#content-login .error").show('blind', 500);
                    }
                                    
                  }
               });
		}

});
