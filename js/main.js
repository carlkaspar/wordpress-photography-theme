
(function($){


  $( document ).ready(function() {
      $('#flex-photos a').addClass('gal-item');
      $('.lbox a').attr('data-fancybox','gallery');
      $('.lbox a img').wrap('<div class="img-container"></div>');
      $('img').addClass('lazy');



  });




  $('img').on('contextmenu', function(e){
      return false;
  });

  $('img').mousedown(function(e){
    e.preventDefault;
  });














  function galleryHeightMobile() {
    $('.gal-item').each(function(){
      var iH = parseInt($(this).attr('data-imgh'));
      var iW = parseInt($(this).attr('data-imgw'));
      var newW = $('.container').width() / 2 - 5;

      $(this).attr('data-h', newW * iH / iW + 6);
    });

    var oddHeight = 0;
    var evenHeight = 0;

    $('#flex-photos a:odd').each(function(){
      oddHeight += parseInt($(this).attr('data-h'));
    });


    $('#flex-photos a:even').each(function(){
      evenHeight += parseInt($(this).attr('data-h'));
    });

    $('#flex-photos').height(Math.max(oddHeight,evenHeight));
  }


  function galleryHeightDesktop() {
    $('.gal-item').each(function(){
      var iH = parseInt($(this).attr('data-imgh'));
      var iW = parseInt($(this).attr('data-imgw'));
      var newW = $('.container').width() / 3 - 10;


      $(this).attr('data-h', newW * iH / iW + 14);
    });


    var firstHeight = 0;
    var secondHeight = 0;
    var thirdHeight = 0;

    $('#flex-photos a:nth-child(3n + 1)').each(function(){
      firstHeight += parseInt($(this).attr('data-h'));
    });


    $('#flex-photos a:nth-child(3n + 2)').each(function(){
      secondHeight += parseInt($(this).attr('data-h'));
    });

    $('#flex-photos a:nth-child(3n + 3)').each(function(){
      thirdHeight += parseInt($(this).attr('data-h'));
    });

    $('#flex-photos').height(Math.max(firstHeight, secondHeight, thirdHeight));

  }


  $(window).load(function() {

    if ( $(window).width() >= 768 ) {
      galleryHeightDesktop();
    } else {
      galleryHeightMobile();
    }
    $('#flex-photos img').hide().css('visibility', 'visible').fadeIn(1000);

  });







  $('.img-container, .img-title').mouseenter(function() {
      $(this).find('.img-title').addClass('hover');
  });

  $('.img-container, .img-title').mouseout(function() {
      $(this).find('.img-title').removeClass('hover');
  });








  $( window ).on('resize', function() {
    if ( $(window).width() >= 768 ) {
      galleryHeightDesktop();
    } else {
      galleryHeightMobile();
    }
  });


  $(window).load(function() {
    $('#loading').hide();
    $('.about-wrapper').hide().css('visibility', 'visible').fadeIn(1000);
    $('.contact').hide().css('visibility', 'visible').fadeIn(1000);

  })






  $.fancybox.defaults.loop = true;
  $.fancybox.defaults.wheel = false;
  $.fancybox.defaults.image.preload = false;
  $.fancybox.defaults.buttons = [
    "slideShow",
    "thumbs",
    "close"
  ];
  $.fancybox.defaults.protect = true;
  $.fancybox.defaults.clickContent = false;
  $.fancybox.defaults.mobile = {
    arrows: false
  };



// lazysizes Options
window.lazySizesConfig = window.lazySizesConfig || {};
window.lazySizesConfig.preloadAfterLoad = true;



})(jQuery);
