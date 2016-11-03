
$( document ).ready(function() {
    console.log( "document loaded" );

    $('.item-hover').hover( function() {
      $(this).find('.item-hover-caption').fadeIn(300);
    }, function() {
      $(this).find('.item-hover-caption').fadeOut(100);
    })

});
