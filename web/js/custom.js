var $ = jQuery;
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
$("#email").on('change', function(e) {
    $(this).val($(this).val().trim());
});