$(function(){
    var windowWidth = jQuery(window).width();
    $('.abc').bxSlider({
       auto: true,
       slideWidth: windowWidth,
       speed: 2000,
       mode: 'horizontal'
   });
});
