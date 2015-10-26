(function ($){
    $(document).ready(function(){
            var slider_effect ='.carousel-inner .active';
            var w_width=$( window ).width();
            if(slider_effect){
                    $('.slider_text').css({'opacity':'1','margin-top':'10px'});}
            else{$('.slider_text').css({'opacity':'0'});}
            //manu_fixed
            $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            var scrool_size=$("header .navbar-default").height();
            if (scroll >= scrool_size){
                    $("header .navbar-default").addClass('menu_fixed');
                    $(".bottom_to_top").addClass('bottom_top_active');}
            else{
                    $("header .navbar-default").removeClass('menu_fixed');
                    $(".bottom_to_top").removeClass('bottom_top_active');
                    }
            });
            //owl-carousel js  //
                    $('.owl-carousel').owlCarousel({
                            loop:true,
                            margin:30,
                            responsiveClass:true,
                            responsive:{
                                    0:{
                                            items:1,
                                            nav:true
                                    },
                                    600:{
                                            items:2,
                                            nav:true,
                                            loop:false
                                    },
                                    992:{
                                            items:3,
                                            nav:true,
                                            loop:false
                                    }
                            }
                    })
             $('#date_pic,#date_pic_2').datepicker({
                    format: "dd/mm/yyyy"
            });
            //-- Image Viewer --//
            $.bindViewer(".viewer-item");
            // Code for Lazy Load
            $('.os').waypoint(function() {
                    var anim = $(this).attr('data-animate'),
                            del  = $(this).attr('data-animation-delay');
                            dur  = $(this).attr('data-animation-duration');
                            $(this).addClass('animated '+anim).css({animationDelay: del + 'ms'});
                            $(this).css({animationDuration: dur + 'ms'});
            },{offset: '90%',triggerOnce: true});
    });
})(jQuery);