var $ = jQuery;

$("#email").on('change', function(e) {
    $(this).val($(this).val().trim());
});