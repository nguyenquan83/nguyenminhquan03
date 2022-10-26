jQuery(document).ready(function($) {

/*------------------------------------------------
            DECLARATIONS
------------------------------------------------*/

    var loader                  = $('#loader');
    var loader_container        = $('#preloader');
    var scroll                  = $(window).scrollTop();  
    var scrollup                = $('.backtotop');
    var dropdown_toggle         = $('.main-navigation button.dropdown-toggle');
    var menu_toggle             = $('#masthead .menu-toggle');
    var primary_menu            = $('#masthead ul.nav-menu');

/*------------------------------------------------
            PRELOADER
------------------------------------------------*/

    loader_container.delay(1000).fadeOut();
    loader.delay(1000).fadeOut("slow");

/*------------------------------------------------
            BACK TO TOP
------------------------------------------------*/

    $(window).scroll(function(e) {
        e.preventDefault();
        if ($(this).scrollTop() > 1) {
            scrollup.css({bottom:"25px"});
        } 
        else {
            scrollup.css({bottom:"-100px"});
        }
    });

    scrollup.click(function() {
        $('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });

/*------------------------------------------------
            NAVIGATION
------------------------------------------------*/

    menu_toggle.click(function() {
        primary_menu.slideToggle();
        $(this).toggleClass('active');
        $('#masthead .main-navigation').toggleClass('menu-open');
        $('.menu-overlay').toggleClass('active');
       
    });

    dropdown_toggle.click(function() {
        $(this).toggleClass('active');
       $(this).parent().find('.sub-menu').first().slideToggle();
    });

    $('.main-navigation ul li.search-menu a').click(function(e) {
        e.preventDefault();
        $(this).toggleClass('search-active');
        $('.main-navigation #search').fadeToggle();
        $('.main-navigation .search-field').focus();
    });

/*------------------------------------------------
            SLICK SLIDER
------------------------------------------------*/

    $('.featured-slider').slick();

    $('.testimonial-slider').slick({
        responsive: [
        {
            breakpoint: 1023,
            settings: {
            slidesToShow: 2
            }
        },
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 1
            }
        }
        ]
    });



/*--------------------------------------------------------------
 Keyboard Navigation
----------------------------------------------------------------*/
if( $(window).width() < 1024 ) {
    $('#primary-menu').find("li").last().bind( 'keydown', function(e) {
        if( e.which === 9 ) {
            e.preventDefault();
            $('#masthead').find('.menu-toggle').focus();
        }
    });

    $('#primary-menu > li:last-child button:not(.active)').bind( 'keydown', function(e) {
        if( e.which === 9 ) {
            e.preventDefault();
            $('#masthead').find('.menu-toggle').focus();
        }
    });

    $('#search').find("button").unbind('keydown');

}
else {
    $('#primary-menu').find("li").unbind('keydown');

    $('#search').find("button").bind( 'keydown', function(e) {
        var tabKey              = e.keyCode === 9;
        var shiftKey            = e.shiftKey;

        if( tabKey ) {
            e.preventDefault();
            $('#search').hide();
            $('.search-menu > a').removeClass('search-active').focus();
        }

        if( shiftKey && tabKey ) {
            e.preventDefault();
            $('#search').show();
            $('.main-navigation .search-field').focus();
            $('.search-menu > a').addClass('search-active');
        }
    });

    $('.search-menu > a').on('keydown', function (e) {
        var tabKey              = e.keyCode === 9;
        var shiftKey            = e.shiftKey;
        
        if( $('.search-menu > a').hasClass('search-active') ) {
            if ( shiftKey && tabKey ) {
                e.preventDefault();
                $('#search').hide();
                $('.search-menu > a').removeClass('search-active').focus();
            }
        }
    });
}

$(window).resize(function() {
    if( $(window).width() < 1024 ) {
        $('#primary-menu').find("li").last().bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#masthead').find('.menu-toggle').focus();
            }
        });

        $('#primary-menu > li:last-child button:not(.active)').bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#masthead').find('.menu-toggle').focus();
            }
        });

        $('#search').find("button").unbind('keydown');

    }
    else {
        $('#primary-menu').find("li").unbind('keydown');

        $('#search').find("button").bind( 'keydown', function(e) {
            var tabKey              = e.keyCode === 9;
            var shiftKey            = e.shiftKey;

            if( tabKey ) {
                e.preventDefault();
                $('#search').hide();
                $('.search-menu > a').removeClass('search-active').focus();
            }

            if( shiftKey && tabKey ) {
                e.preventDefault();
                $('#search').show();
                $('.main-navigation .search-field').focus();
                $('.search-menu > a').addClass('search-active');
            }
        });

        $('.search-menu > a').on('keydown', function (e) {
            var tabKey              = e.keyCode === 9;
            var shiftKey            = e.shiftKey;
            
            if( $('.search-menu > a').hasClass('search-active') ) {
                if ( shiftKey && tabKey ) {
                    e.preventDefault();
                    $('#search').hide();
                    $('.search-menu > a').removeClass('search-active').focus();
                }
            }
        });
    }
});

menu_toggle.on('keydown', function (e) {
    var tabKey    = e.keyCode === 9;
    var shiftKey  = e.shiftKey;

    if( menu_toggle.hasClass('active') ) {
        if ( shiftKey && tabKey ) {
            e.preventDefault();
            primary_menu.slideUp();
            $('.main-navigation').removeClass('menu-open');
            $('.menu-overlay').removeClass('active');
            menu_toggle.removeClass('active');
        };
    }
});

/*------------------------------------------------
            Playlist
------------------------------------------------*/

$('#music-player .wrapper .wp-playlist').append('<button class="toggle-playlist"><i class="fa fa-th-list"></i></button>');

$('.toggle-playlist').click(function() {
    $('#music-player .wp-playlist-tracks').slideToggle();
});


$(window).scroll(function() {
    if ($(this).scrollTop() > 1) {
        $('#music-player').css({display:"block"});
    } 
    else {
        $('#music-player').css({display:"none"});
    }
});


$(window).on('scroll', function() {
  if($(window).scrollTop() >= $('#content').offset().top + $('#content').outerHeight() - window.innerHeight) {
    $('#music-player').hide();
  }
});

/*------------------------------------------------
                END JQUERY
------------------------------------------------*/

});