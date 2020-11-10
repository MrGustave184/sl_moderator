(function($) {
 
"use strict";

$(document).ready(function() {
    $("#sl_moderator_questions").on('click', function(event) {
        console.log(event);
    }); 
    
    $("#moderator_send_question").on('click', function (event) {
        fetch('http://gamification.test/wp-json/shocklogic/moderator/questions')
            .then(response => response.json().then(data => {
                console.log(data);
            }));
    })
});


})(jQuery);

