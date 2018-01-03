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
		
		$("#login").click(function(){
                   
                   $Data=$("#box-login").serialize();
                   
                                 $.ajax({
            type:"POST",
            url:"ValidarLog.php",
            data:$Data,
            dataType:"json",
            success:function(msg){         
                if(parseInt(msg.status)==1){
                    window.location=msg.txt;
                }else if(parseInt(msg.status)==0){
//                   alert(msg.txt);
                   $("#box-login").show('shake', 55);
		   $(".header-login").show('shake', 55);
	           $("#content-login .error").show('blind', 500);
                   return false;
                }
               
            }
        });
                    
                });
		
		
		//VALIDATION FORM//
		var validator = $("#formtest").validate({ 
        rules: { 
            firstname: {
                required: true, 
                minlength: 2
			},
            lastname: {
			    required: true, 
                minlength: 2
			},
            username: { 
                required: true, 
                minlength: 2
            }, 
            password: { 
                required: true, 
                minlength: 5 
            }, 
            password_confirm: { 
                required: true, 
                minlength: 5, 
                equalTo: "#form-password" 
            }, 
            email: { 
                required: true, 
                email: true
            }, 
			email_confirm: { 
                required: true, 
                minlength: 5, 
                equalTo: "#form-email" 
            }, 
            dateformat: "required", 
            terms: "required" 
        }, 
        messages: { 
            firstname: "Enter your firstname", 
            lastname: "Enter your lastname", 
            username: { 
                required: "Enter a username", 
                minlength: jQuery.format("Enter at least {0} characters"), 
                remote: jQuery.format("{0} is already in use") 
            }, 
            password: { 
                required: "Provide a password", 
                rangelength: jQuery.format("Enter at least {0} characters") 
            }, 
            password_confirm: { 
                required: "Repeat your password", 
                minlength: jQuery.format("Enter at least {0} characters"), 
                equalTo: "Enter the same password as above" 
            }, 
            email: { 
                required: "Please enter a valid email address", 
                minlength: "Please enter a valid email address", 
                remote: jQuery.format("{0} is already in use") 
            }, 
            dateformat: "Choose your preferred dateformat", 
            terms: "Please accept terms of use" 
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
            alert("Validate!"); 
        }, 
        success: function(label) { 
            label.html("&nbsp;").addClass("valid_small"); 
        } 
		}); 
		$("#form-username").focus(function() { 
			var firstname = $("#form-firstname").val(); 
			var lastname = $("#form-lastname").val(); 
			if(firstname && lastname && !this.value) { 
				this.value = firstname + "." + lastname; 
			} 
		}); 
		$("#reset").click (function(){
			$("#formtest .form-field").val ("");
		});
		
		
});
