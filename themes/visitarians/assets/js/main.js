var $ = jQuery;

/**
 * HOME PAGE SLIDER 
 */ 
$(window).load(function () {
  $('#event_slider').flexslider({
    animation: "slide",
    controlNav: false,
    mousewheel: false,
    touch: true,
    randomize: false, 
    start: function (slider) {
      $('body').removeClass('loading');
    }
  });
  $('#event_slider_thumbnail').flexslider({
    animation: "slide",
    animationLoop: true,
    itemWidth: 150,
    itemMargin: 5,
    pausePlay: true,
    mousewheel: false,
    touch: true,
    randomize: false, 
    controlNav: false,
    asNavFor: '.flexslider'
    
  });
});

$(document).ready(function () {
  "use strict";

  var window_width = $(window).width(),
    window_height = window.innerHeight,
    header_height = $(".default-header").height(),
    header_height_static = $(".site-header.static").outerHeight(),
    fitscreen = window_height - header_height;


  $(".fullscreen").css("height", window_height)
  $(".fitscreen").css("height", fitscreen);

  //-------- Active Sticky Js ----------//
  $(".default-header").sticky({ topSpacing: 0 });

  if (document.getElementById("default-select")) {
    $('select').niceSelect();
  };
});
