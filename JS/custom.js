$(document).ready(function() {

$('.menu').cmenu();

		//BOX LOGIN ERROR TEST//
		$("#content-login .error").hide();
		$("#error").click(function() {
			$("#box-login").show('shake', 55);
			$(".header-login").show('shake', 55);
			$("#content-login .error").show('blind', 500);
			return false;
		});

             


		//LANGUAGE //
		$(".flag").hide();
		$(".language_button").click(function() {
			$(".flag").toggle('drop');
		});
		
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
                
		
		//MESSAGE - TAG HIDE //
		$(".message").click(function() {
                      $(this).hide('blind', 500);
                      return false;
        });
		$(".tag").click(function() {
                      $(this).hide('highlight', 500);
                      return false;
        });	
		
		//SEARCH INPUT//
		$("#search_input").focusin(
		function() {
			$('#search_input').val('');
		});
		$("#search_input").focusout(
		function() {
			$('#search_input').val('Search...');
		});
		
		
		
		
});
