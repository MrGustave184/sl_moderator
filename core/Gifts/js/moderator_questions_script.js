(function( $ ) {
 
"use strict";

$(document).ready(function() {
    console.log($("#sl_moderator_questions").length);

    $("#sl_moderator_questions").on('click', function(event) {
        console.log(event);
    });  
});

     

 
})(jQuery);