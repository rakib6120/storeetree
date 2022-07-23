// JavaScript Document
$(document).ready(function(){
    
    
    
    $('.dropdown').hover(function() {
        $(this).addClass('open');
    },
    function() {
        $(this).removeClass('open');
    });
    
    
    
    $(".option-select").chosen({disable_search_threshold: 10});
    
    $('.feature_single_block').responsiveEqualHeightGrid();
    $('.sd_height').responsiveEqualHeightGrid();
    $('.sd_height2').responsiveEqualHeightGrid();
    $('.speed_round .choose_select_common ul li').responsiveEqualHeightGrid();
    $('.video_qs_thm').responsiveEqualHeightGrid();
    $('.contact_info_block_sc').responsiveEqualHeightGrid();
    


    jQuery(".scroll_block").mCustomScrollbar({
      autoHideScrollbar: false,
      scrollbarPosition: "outtside",
      scrollInertia:3000
    });


    jQuery( "#accordion" ).accordion({
        heightStyle: "content"
    });



    jQuery('#main-slider').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          asNavFor: '#carousel-slider'
        });
        
        jQuery('#carousel-slider').slick({
            vertical:true,
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '#main-slider',
            dots: false,
            centerMode: false,
            focusOnSelect: true
        });
        
    
    
    $(function(){
        if (navigator.userAgent.indexOf('Mac OS X') != -1) {
          $(".abc").css("line-height", "40px");
        }
        
        if(navigator.userAgent.indexOf('Mac') > 0 && navigator.userAgent.indexOf('Firefox') > 0){
            $(".abc").css("line-height", "38px");
        }
        
        if(navigator.userAgent.indexOf('Mac') > 0 && navigator.userAgent.indexOf('Chrome') > 0){
          $(".abc").css("line-height", "40px");
        }
    });




    $('#menu__opener').click(function(){
        $('body').addClass('menu_active');
    })

    $('#sidebar_hide').click(function(){
        $('body').removeClass('menu_active');
    })

    $('.header_signUP a').click(function(){
        $('body').removeClass('menu_active');
    })
    
    
    
    
    
    jQuery('#banner_slider').owlCarousel({
        loop:true,
        margin:0,
        responsiveClass:true,
        autoplay:true,
        nav:true,
        responsive:{
            0:{
                items:1,
                margin:0,
            },
            480:{
                items:1,
                margin:0,
            },
            640:{
                items:1,
                margin:0,
            },
            768:{
                items:1,
                margin:0,
            },
            992:{
                items:1,
                margin:0,
            },
            1200:{
                items:1,
                margin:0,
            },
            1492:{
                items:1,
                margin:0,
            }
            
            
            
        }
    });

    jQuery('#banner_slider2').owlCarousel({
        loop:true,
        margin:0,
        responsiveClass:true,
        autoplay:true,
        nav:true,
        responsive:{
            0:{
                items:1,
                margin:0,
            },
            480:{
                items:1,
                margin:0,
            },
            640:{
                items:2,
                margin:15,
            },
            768:{
                items:2,
                margin:15,
            },
            992:{
                items:2,
                margin:15,
            },
            1200:{
                items:3,
                margin:15,
            }
            
            
            
            
        }
    });
    
    
    
});


