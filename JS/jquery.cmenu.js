/* @version 1.1 cmenu
 * @author Lucas Forchino
 * @webSite: http://www.jqueryload.com
 * jquery menu chrome style
 */
(function($){
    $.fn.cmenu=function(){
     return  this.each(function(){
         var cmenu=$(this);
         var menuItems=cmenu.find('li');
         menuItems.bind('mouseover',function(event){
                    var prevDiv=$(this).find('.selected');
                    if (prevDiv.size()==1){
                            prevDiv.show();
                        }
                        else{
                            var div= $('<div>');
                            var label= $('<label>');
                            div.addClass('selected');
                            label.html($(this).attr('label'));
                            div.append(label);
                            $(this).prepend(div);
                            $(this).find('.selected').show();
                        }
                })
        menuItems.bind('mouseout',function(event){
            cmenu.find('.selected').hide();
        })
        cmenu.find('img').bind('click',function(event){
           var action = $(this).parent().attr('action');
           location.href=action;
        });
     });// end fn.cmenu
 }
})(jQuery);
