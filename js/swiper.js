$(document).ready(function(){
  "use strict";

  var mySwiper = new Swiper ('.swiper-container', {
    // Optional parameters
    loop: true,
    autoplay: 15000,
    // If we need pagination
    pagination: '.swiper-pagination',
    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    grabCursor: true,
    onClick: function(swiper){
      swiper.stopAutoplay();
    }

  });
});