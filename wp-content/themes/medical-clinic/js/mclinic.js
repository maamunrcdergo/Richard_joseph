var nc = jQuery.noConflict();
'use strict';
nc(document).ready(function () {
  /*==========Code for Slider Effect==========*/
  var slider_effect = '.carousel-inner .active';
  var w_width = nc(window).width();
  if (slider_effect) {
    nc('.slider_text').css({'opacity': '1', 'margin-top': '10px'});
  }
  else {
    nc('.slider_text').css({'opacity': '0'});
  }

  /*==========Code for Lazy Scroll==========*/
  nc(document).ready(function () {
    //var nice = nc("html").niceScroll();
  });
  /*==========Code for nav Fixed==========*/
  nc(window).scroll(function () {
    var scroll = nc(window).scrollTop();
    var scrool_size = nc("header .navbar-default").height();
    if (scroll >= scrool_size) {
      nc("header .navbar-default").addClass('menu_fixed');
      nc(".bottom_to_top").addClass('bottom_top_active');
    }
    else {
      nc("header .navbar-default").removeClass('menu_fixed');
      nc(".bottom_to_top").removeClass('bottom_top_active');
    }
  });
  /*==========Code for owl-carousel==========*/
  nc('.owl-carousel').owlCarousel({
    loop: true,
    margin: 30,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: true
      },
      600: {
        items: 2,
        nav: true,
        loop: false
      },
      992: {
        items: 3,
        nav: true,
        loop: false
      }
    }
  })
  /*==========Code for datepicker==========*/
//  nc('#date_pic,#date_pic_2').datepicker({
//    format: "dd/mm/yyyy"
//  });
  /*==========Image Viewer==========*/
  nc.bindViewer(".viewer-item");
  /*==========Code for waypoint Lazy Load==========*/
  nc('.os').waypoint(function () {
    var anim = nc(this).attr('data-animate'),
            del = nc(this).attr('data-animation-delay');
    dur = nc(this).attr('data-animation-duration');
    nc(this).addClass('animated ' + anim).css({animationDelay: del + 'ms'});
    nc(this).css({animationDuration: dur + 'ms'});
  }, {offset: '90%', triggerOnce: true});
});

nc(document).ready(function () {
  nc('#mobilemenu-container').mmenu({
    extensions: [mclinic_obj.mm_theme, "effect-slide-listitems"],
    searchfield: false,
    counters: false,
    navbar: {
      title: 'MENU',
    },
    navbars: [
      {
        position: 'top',
        content: ['<a href="' + mclinic_obj.site_url + '" class="mm-logo"><img src="' + mclinic_obj.mm_logo + '" /></a>'], height: 2,
      }, {
        position: 'top',
        content: [
          'prev',
          'title',
          'close',
        ]
      }
    ],
    offCanvas: {
      position: "right",
      zposition: "front",
    },
  });
  var mmenuAPI = nc("#mobilemenu-container").data("mmenu");
  mmenuAPI.bind( "init", function( $panel ) {
    console.log('asdasdasdasd');
  });
  nc('#mm-button-toggle').on('click', function () {   
    mmenuAPI.open();
    return false;
  });
  nc('.backtoTop').on('click', function () {
    nc('html,body').animate({scrollTop: 0}, 'slow');
    return false;
  });
});