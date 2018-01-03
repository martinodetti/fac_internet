/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(function(){
		var btnUpload=$('#upload_img');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: 'upload-file.php?opc=3',
			name: 'uploadfile',
                         params: {
                         opc: '3'
                                },
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg)$/.test(ext))){
                    // extension is not allowed
					//status.text('Only JPG or PNG  are allowed');
                                        $('#vision').html("<p>Solo JPG O PNG son permitidas.</p>").addClass('error');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
                                alert(response);
				if(response=="success"){
                                    $("#txt_img_persona").val(file);
                                    $('#vision').html('');
                                    $('#vision').removeClass('frontal');
					$('#vision').html('<img src="./img_test/'+file+'" alt="" /><br />'+file).addClass('success');
				} else if(response=="error"){
					$('#vision').html("<p>"+file+"</p>").addClass('error');
				}else if(response=="3"){
                                    $('#vision').html("<p>Solo imagenes menores a 20kb.3</p>").addClass('error');
                                }
			}
		});

	});