jQuery(document).ready(function($){

    var at_window = $(window);
    function acme_resize_functions() {

        var homeSection = $('#at-banner-slider');
        var windowHeight = at_window.outerHeight();

        if (homeSection.hasClass('home-fullscreen')) {

            $('.home-fullscreen').css('height', windowHeight);
        }
    }
    //make slider full width
    acme_resize_functions();

    //window resize
    at_window.resize(function () {
        acme_resize_functions();
    });

    $('.acme-owl-carausel').show().owlCarousel({
        autoPlay : true,
        navigation : true, // Show next and prev buttons
        pagination : false, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        navigationText : ['<i class="fa fa-angle-double-left"></i>','<i class="fa fa-angle-double-right"></i>'],
        addClassActive: true
    });
    /*widgets slider*/
    $('.acme-widget-carausel').each(function(){
        var at_featured_img_slider = $(this);
        var items = parseInt(at_featured_img_slider.data('items'));
        at_featured_img_slider.show().owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            navigation : false, // Show next and prev buttons
            items : items,
            stopOnHover : true,
            itemsScaleUp:true
        });
    });
    /*parallax scolling*/
    $('a[href*="#"]').click(function(event){
        $('html, body').animate({
            scrollTop: $( $.attr(this, 'href') ).offset().top-$('.prolific-sticky').height()
        }, 1000);
    });
    /*bootstrap sroolpy*/
    $("body").scrollspy({target: ".navbar-fixed-top", offset: $('.prolific-sticky').height()+50 } );

    /*parallax*/
    function init_parallax_parallax_fixed(){
        var is_iPad = navigator.userAgent.match(/iPad/i) != null;
        if ( is_iPad ){
            jQuery('.at-parallax,.inner-main-title').each(function() {
                jQuery(this).css('background-attachment','');
            });
        }
        else{
            if (at_window.width() > 767) {
                jQuery('.at-parallax,.inner-main-title').each(function() {
                    jQuery(this).parallax('center', 0.2, true);
                    jQuery(this).css('background-attachment','fixed');
                });
            }
            else{
                jQuery('.at-parallax,.inner-main-title').each(function() {
                    jQuery(this).css('background-attachment','');
                });
            }
        }
    }
    init_parallax_parallax_fixed();
    // disable skrollr if the window is resized below 768px wide
    at_window.on('resize', function () {
        init_parallax_parallax_fixed();
    });

    function stickyMenu() {

        var scrollTop = at_window.scrollTop();
        var offset = 20;

        if ( scrollTop > offset ) {
            $('.prolific-sticky').addClass('navbar-fixed-top ');
            $('.front-page-header').addClass('nav-scrolled');
            $('.sm-up-container').show();
        }
        else {
            $('.prolific-sticky').removeClass('navbar-fixed-top ');
            $('.front-page-header').removeClass('nav-scrolled');
            $('.sm-up-container').hide();
        }
    }
    //What happen on window scroll
    stickyMenu();
    at_window.on("scroll", function (e) {
        setTimeout(function () {
            stickyMenu();
        }, 300)
    });
});

/*animation with wow*/
wow = new WOW({
        boxClass: 'init-animate',
        animateClass: 'animated' // default
    }
);
wow.init();

/**
 * Skip link focus fixed
 */
( function() {
    var isIe = /(trident|msie)/i.test( navigator.userAgent );

    if ( isIe && document.getElementById && window.addEventListener ) {
        window.addEventListener(
            'hashchange',
            function() {
                var id = location.hash.substring( 1 ),
                    element;

                if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
                    return;
                }

                element = document.getElementById( id );

                if ( element ) {
                    if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
                        element.tabIndex = -1;
                    }

                    element.focus();
                }
            },
            false
        );
    }
}() );