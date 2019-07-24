$( "#dropdown" ).select2({
    theme: "bootstrap"
});

$(document).ready(function() {
$('.js-example-basic-single').select2();
});
$(document).ready(function() {
$('.js-example-basic-multiple').select2();
});
$.fn.select2.defaults.set( "theme", "bootstrap" );
