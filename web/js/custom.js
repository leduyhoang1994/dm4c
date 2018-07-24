var $ = jQuery;
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
$("#email").on('change', function(e) {
    $(this).val($(this).val().trim());
});
function makeAlert(title, message, type) {
    $.notify({
        // options
        icon: 'glyphicon glyphicon-warning-sign',
        title: "<b>"+title+" ! </b><br/>",
        message: message,
        url: '',
        target: '_blank'
    },{
        // settings
        element: 'body',
        position: null,
        type: type,
        allow_dismiss: true,
        newest_on_top: false,
        showProgressbar: false,
        placement: {
            from: "bottom",
            align: "center"
        },
        offset: 20,
        spacing: 10,
        z_index: 1051,
        delay: 4000,
        timer: 1000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',
    });
}