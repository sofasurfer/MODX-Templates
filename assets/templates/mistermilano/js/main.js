
$( document ).ready(function() {

    var movementStrength = 25;
    var height = movementStrength / $(window).height();
    var width = movementStrength / $(window).width();
    $("_parallax.home").mousemove(function(e){
              var pageX = e.pageX - ($(window).width() / 2);
              var pageY = e.pageY - ($(window).height() / 2);
              var newvalueX = width * pageX * -10 - 25;
              var newvalueY = 0; //height * pageY * -1 - 50;
              console.log('position x: ' + newvalueX + ' y: ' + newvalueY);
              $('.parallax.home').css("background-position", newvalueX+"px     "+newvalueY+"px");
    });



    $('.item-hover').hover( function() {
      $(this).find('.item-hover-caption').fadeIn(300);
    }, function() {
      $(this).find('.item-hover-caption').fadeOut(100);
    })

});
