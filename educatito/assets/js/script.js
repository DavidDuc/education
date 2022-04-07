/*
 * Title:   Educatito
 * Author:  JRBthemes
 */

(function ($) {
    'use strict';

    var Popuplogin = function () {
        $('.popup-with-form').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#name',
            callbacks: {
                beforeOpen: function () {
                    if ($(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                }
            }
        });
    }
    var Coursebestseller = function () {
        if ($('.our-course').length) {
            $('.our-course').slick({
                dots: false,
                infinite: true,
                variableWidth: false,
                //arrows: false,
                nextArrow: '<div class="educatito-next"><i class="fa fa-angle-right"></i></div>',
                prevArrow: '<div class="educatito-prev"><i class="fa fa-angle-left"></i></div>',
                speed: 300,
                autoplay: false,
                slidesToShow: 4,
                slidesToScroll: 4,
                responsive: [
                    {
                        breakpoint: 1600,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4
                        }
                    },
                    {
                        breakpoint: 1220,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
            var filtered = false;
            $('.educatito-filters-button .button-filter').on('click', function () {
                var filtername = $(this).attr('id');
                if (filtered === false) {
                    $('.our-course').slick('slickUnfilter');
                    $('.our-course').slick('slickFilter', '.filter-' + filtername);
                    $('.educatito-filters-button .button-filter').attr('class', 'button-filter');
                    $(this).attr('class', 'is-checked button-filter');
                    return false;
                } else {
                    $('.our-course').slick('slickUnfilter');
                    $('.our-course').slick('slickFilter', '.filter-' + filtername);
                    $('.our-course').slickGoTo(0);
                    $('.educatito-filters-button .button-filter').attr('class', 'button-filter');
                    $(this).attr('class', 'is-checked button-filter');
                    filtered = false;
                    return false;
                }
            });
        }
    }
    var menudesktop = function () {
        $('.menu-primary .menu-item-has-children').each(function () {
            $(this).addClass('uk-parent');
        });
        $('.menu-primary .sub-menu').each(function () {
            $(this).addClass('uk-dropdown uk-dropdown-navbar uk-dropdown-bottom');
        });
        $(".menu-primary .menu-item-has-children").hover(
                function () {
                    $(this).addClass("uk-open");
                }, function () {
            $(this).removeClass("uk-open");
        }
        );
    }
    var EducatitoFullimage = function () {
        if ($('section').hasClass('full-screen')) {
            var windowsHeight = $(window).height();
            $('.full-screen').css('height', windowsHeight + 'px');
            //when resizing the site, we adjust the heights of the sections
            $(window).resize(function () {
                EducatitoFullimage();
            });
        }
    };
    var menu_position_hover = function () {
        var windowWidth = $(window).width();
        $(".menu-primary .menu-item-has-children").hover(
                function () {
                    var left = $(this).find('.sub-menu').offset().left;
                    var width = $(this).find('.sub-menu').outerWidth() + 0;
                    var w_l = left + width;
                    if (windowWidth < w_l) {
                        jQuery(this).find('.sub-menu').addClass('menu-psright');
                    }
                    ;
                }, function () {
            jQuery(this).find('.sub-menu').removeClass('menu-psright');
        }
        );
        $(".default-menu .page_item_has_children").hover(
                function () {
                    var left = $(this).find('.children').offset().left;
                    var width = $(this).find('.children').outerWidth() + 0;
                    var w_l = left + width;
                    if (windowWidth < w_l) {
                        jQuery(this).find('.children').addClass('menu-psright');
                    }
                    ;
                }, function () {
            jQuery(this).find('.children').removeClass('menu-psright');
        }
        );
    }
    $(window).resize(function () {
        menu_position_hover();
    });

    var menuMobileList = function () {
        if ($('.menu-item-has-children').length) {
            $('.menu-mobi li.menu-item-has-children').children('a').append(function () {
                return '<button class="dropdown-expander"><i class="uk-icon-angle-right"></i></button>';
            });
            $('.menu-mobi .dropdown-expander').on('click', function () {
                $(this).parent().parent().children('.sub-menu').slideToggle();
                $(this).find('i').toggleClass('uk-icon-angle-right uk-icon-angle-down');
                $(this).parent('a').parent('li').toggleClass('active');
                return false;
            });
        }
    }
    var menuMobileListdf = function () {
        if ($('.page_item_has_children').length) {
            $('.menu-mobi li.page_item_has_children').children('a').append(function () {
                return '<button class="dropdown-expander"><i class="uk-icon-angle-right"></i></button>';
            });
            $('.menu-mobi .dropdown-expander').on('click', function () {
                $(this).parent().parent().children('.children').slideToggle();
                $(this).find('i').toggleClass('uk-icon-angle-right uk-icon-angle-down');
                $(this).parent('a').parent('li').toggleClass('active');
                return false;
            });
        }
    }
    var menuMobile = function () {
        $(".header .menu-bars-mobi").on('click', function () {
            $(this).toggleClass("open");
            $('.menu-mobi').slideToggle();
            return false;
        });
        $("#menu_primary_toggle").on('click', function () {
            $(this).toggleClass("active");
            $('.menu-mobi').slideToggle().toggleClass("active");
            return false;
        });
        $(window).resize(function () {
            jQuery("#menu_primary_toggle").removeClass("active");
            jQuery(".menu-mobi").removeClass("active").hide();
        });
    }
    //menu cart
    var positioncartmini = function (a) {
        if (a === "open") {
            jQuery(".display-posion-cart").addClass("active")
        } else {
            if (a === "close") {
                jQuery(".display-posion-cart").removeClass("active")
            } else {
                jQuery(".display-posion-cart").toggleClass("active")
            }
        }
    }
    var cartHeader = function () {
        $("header").on("click", ".cart", function () {
            if (Modernizr.mq("screen and (max-width:767px)")) {
            } else {
                positioncartmini();
                $(document).keydown(function (l) {
                    var k = l.keyCode ? l.keyCode : l.which;
                    if (k == 27) {
                        positioncartmini("close")
                    }
                });
                return false
            }
        });
        $(window).resize(function () {
            jQuery(".display-posion-cart").removeClass("active");
        });
        var height_cart = $('header .display-posion-cart').height();
        if (height_cart > 500) {
            $('header .display-posion-cart').css('height', '500px');
            $('header .display-posion-cart').css('overflow-y', 'scroll');
            $('header .display-posion-cart ul').css('padding-right', '0px');
            $('header .display-posion-cart > p').css('padding-right', '0px');
        }
    }
    var selectFilterPortfolio = function () {
        if ($('.educatito-list-filter').length) {
            if ($(window).width() < 600) {
                $('.educatito-list-filter .filter-mobile a').on('click', function () {
                    $('.educatito-filter-category').slideToggle().toggleClass('active');
                });
                $('.educatito-list-filter .educatito-filter-category a').on('click', function () {
                    var txt = $(this).text();
                    $('.educatito-list-filter .filter-mobile a span').text(txt);
                    $('.educatito-filter-category').slideUp().removeClass('active');
                });
            }
        }
    }
    var Backtotop = function () {
        if ($('.educatito-scroll-top').length) {
            var scrollTrigger = 500, // px
                    backToTop = function () {
                        var scrollTop = $(window).scrollTop();
                        if (scrollTop > scrollTrigger) {
                            $('.educatito-scroll-top').addClass('show-icon-top');
                        } else {
                            $('.educatito-scroll-top').removeClass('show-icon-top');
                        }
                    };
            backToTop();
            $(window).on('scroll', function () {
                backToTop();
            });
            $('.educatito-scroll-top').on('click', function (e) {
                e.preventDefault();
                $('html,body').animate({
                    scrollTop: 0
                }, 700);
            });
        }
    }
    var Testimonialsidebar = function () {
        if ($('.testimonial-sidebar').length) {
            $('.testimonial-sidebar').owlCarousel({
                center: false,
                items: 1,
                nav: false,
                loop: true,
                margin: 0,
                autoplay: true
            });
        }
    }
    var Testimonialslick = function () {
        if ($('.slick-testimonial').length) {
            $('.slick-testimonial').slick({
                dots: true,
                infinite: true,
                variableWidth: false,
                arrows: false,
                autoplay: false,
                slidesToShow: 2,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
        if ($('.slick-testimonial-v2').length) {
            $('.slick-testimonial-v2').slick({
                dots: true,
                infinite: true,
                centerMode: true,
                variableWidth: false,
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        }
        if ($('.slick-testimonial-v4').length) {
            $('.slick-testimonial-v4').slick({
                dots: true,
                infinite: true,
                variableWidth: false,
                arrows: false,
                autoplay: true,
                slidesToShow: 2,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
    }
    var Courseour = function () {
        if ($('.course-our').length) {
            $('.course-our').owlCarousel({
                center: false,
                items: 4,
                nav: false,
                loop: true,
                margin: 30,
                autoplay: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    480: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    1219: {
                        items: 4
                    }
                }
            });
        }
    }

    var imagesLightBox = function () {
        if ($('.images_lightbox').length) {
            $('.images_lightbox').lightGallery();
        }
    }

    var portfolioGrid = function () {
        // init Isotope
        if (jQuery('.portfolio-grid').length) {
            var $grid = jQuery('.portfolio-grid').isotope({
                itemSelector: '.element-item',
                layoutMode: 'fitRows',
                transitionDuration: "0.6s"
            });
            // bind filter button click
            jQuery('.educatito-filters-button').on('click', '.button-filter', function () {
                var filterValue = jQuery(this).attr('data-filter');
                $grid.isotope({filter: filterValue});
            });
            // change is-checked class on buttons
            jQuery('.button-group').each(function (i, buttonGroup) {
                var $buttonGroup = jQuery(buttonGroup);
                $buttonGroup.on('click', '.button-filter', function () {
                    $buttonGroup.find('.is-checked').removeClass('is-checked');
                    jQuery(this).addClass('is-checked');
                });
            });
        }
    }
    /*
     * Our Course
     */
    var Ourcourse = function () {
        // init Isotope
        if (jQuery('.course-our').length) {
            var $grid = jQuery('.course-our').isotope({
                itemSelector: '.items',
            });
            // bind filter button click
            jQuery('.educatito-filters-button').on('click', '.button-filter', function () {
                var filterValue = jQuery(this).attr('data-filter');
                jQuery('.course-our').isotope({filter: filterValue});
            });
            // change is-checked class on buttons
            jQuery('.button-group').each(function (i, buttonGroup) {
                var $buttonGroup = jQuery(buttonGroup);
                $buttonGroup.on('click', '.button-filter', function () {
                    $buttonGroup.find('.is-checked').removeClass('is-checked');
                    jQuery(this).addClass('is-checked');
                });
            });
        }
    }
    var Hoverdivportfolio = function () {
        if (jQuery('.portfolio-grid-hoverdir').length) {
            jQuery('.portfolio-grid-hoverdir .hoverdir').each(function () {
                jQuery(this).hoverdir({
                    hoverElem: '.overlay'
                })
            });
        }
    }
    var EducatitoToggle = function () {
        if (jQuery('.educatito-toggle.defaul').length) {
            $(".educatito-toggle.defaul .toggle-info").css({"display": "block"});
        }
        $('.educatito-toggle.enable .toggle-header').on('click', function () {
            $(this).closest('.educatito-toggle').find('.toggle-info').slideUp(500);
            $(this).toggleClass('active');
        });

        $('.educatito-accordion .toggle-header').on('click', function () {
            if (!$(this).is('.active')) {
                $(this).closest('.educatito-accordion').find('.toggle-header.active').toggleClass('active').next().slideUp(500);
                $(this).toggleClass('active');
                $(this).next().slideDown(500);
            } else {
                $(this).toggleClass('active');
                $(this).next().slideUp(500);
            }
        });
    }
    var EducatitoGroupTestimonial = function () {
        $('#testimonial-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: false,
            asNavFor: '#testimonial-carousel',
        });
        $('#testimonial-carousel').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: '#testimonial-slider',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }
    var Loadmore = function () {
        jQuery('.loadmore-portfolio').on('click', function () {

            var id = $(this).data("id");
            var loadmore = jQuery('#educatito_portfolio_grid_' + id + " .loadmore-portfolio");
            var loading = jQuery('#educatito_portfolio_grid_' + id + " .loader");
            var paged = $(this).attr("data-paged");
            var column = $(this).attr("data-column");
            var max_paged = $(this).data("max-paged");
            var posts_per_page = $(this).data("posts-per-page");
            loadmore.hide();
            loading.show();
            jQuery.ajax({
                type: 'post',
                data: {
                    'action': 'educatito_add_new_portfolio',
                    'id': id,
                    'paged': paged,
                    'column': column,
                    'posts_per_page': posts_per_page
                },
                url: educaLoadmoreAjax.ajaxurl,
                success: function (msg) {
                    loading.hide();
                    loadmore.show();
                    if (msg != '') {

                        var portfolio_id = jQuery('#portfolio-grid-' + id);
                        var paged2 = parseInt(paged) + 1;
                        jQuery('#educatito_portfolio_grid_' + id + ' .loadmore-portfolio').attr("data-paged", paged2);
                        if (paged2 === max_paged) {
                            $('#educatito_portfolio_grid_' + id + ' .paging_more').hide();
                        }

                        var elem = jQuery(msg);
                        portfolio_id.isotope().append(elem)
                                .isotope('appended', elem)
                                .isotope('layout');
                        portfolio_id.isotope('layout');
                        setTimeout('jQuery(".portfolio-grid").isotope("layout")', 300);
                        //hoverder
                        if (jQuery('.hoverdir').length) {
                            jQuery('.hoverdir').each(function () {
                                jQuery(this).hoverdir({
                                    hoverElem: '.overlay'
                                });
                            });
                        }
                    } else {
                        $('#educatito_portfolio_grid_' + id + ' .paging_more').hide();
                    }
                }
            });
        });
    }
    var changetext = function () {
        if (jQuery('.section-box-home3').length) {
            $(".section-box-home3 .aio-icon-read").html('<div class="read-more-box">Read More</div>');
        }
    }
    var removeClassLoading = function () {
        $('.educatito-our_course  .our-course-wrap .our-course-content').removeClass('jrb-loadding');
        $('.educatito-events  .box .uk-switcher').removeClass('jrb-loadding');
    }
    var addLoading = function () {
        $('.educatito-our_course .our-course-wrap .educatito-filter-category li').on('click', function () {
            $('.educatito-our_course  .our-course-wrap .our-course-content').addClass('jrb-loadding');
            setTimeout(removeClassLoading, 1000);
        });
        $('.educatito-events  .box  .uk-subnav li').on('click', function () {
            $('.educatito-events  .box .uk-switcher').addClass('jrb-loadding');
            setTimeout(removeClassLoading, 1000);
        });
    }
    var Courseslider = function () {
        if ($('.slider-course').length) {
            $('.slider-course').slick({
                dots: false,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                arrows: false,
                center: true,
            });
        }
    }
    jQuery(document).ready(function ($) {
        Popuplogin();
        Backtotop();
        menudesktop();
        menu_position_hover();
        menuMobileList();
        menuMobileListdf();
        menuMobile();
        EducatitoFullimage();
        cartHeader();
        selectFilterPortfolio();
        Coursebestseller();
        Testimonialsidebar();
        Testimonialslick();
        Courseour();
        imagesLightBox();
        Hoverdivportfolio();
        Loadmore();
        changetext();
        EducatitoGroupTestimonial();
        EducatitoToggle();
        addLoading();
        Courseslider();
    });
    jQuery(window).on('load', function () {
        portfolioGrid();
        Ourcourse();
    });
    /*
     * Load Page
     */
    jQuery(window).load(function () {
        jQuery('body').addClass('loaded');
        jQuery("#spinner-wrapper").fadeOut("slow");
        jQuery("#cube-wrapper").fadeOut("slow");
    });
    // login
    jQuery(document).ready(function ($) {
        var form_modal = $('.cd-user-modal'),
            form_login = form_modal.find('#cd-login'),
            form_signup = form_modal.find('#cd-signup'),
            form_modal_tab = $('.cd-switcher'),
            tab_login = form_modal_tab.children('li').eq(0).children('a'),
            tab_signup = form_modal_tab.children('li').eq(1).children('a'),
            main_nav = $('.main-nav');
        main_nav.on('click', function (event) {
            if ($(event.target).is(main_nav)) {
                $(this).children('ul').toggleClass('is-visible');
            } else {
                main_nav.children('ul').removeClass('is-visible');
                form_modal.addClass('is-visible');
                ($(event.target).is('.cd-signup')) ? signup_selected() : login_selected();
            }

        });

        $('.cd-user-modal').on('click', function (event) {
            if ($(event.target).is(form_modal) || $(event.target).is('.cd-close-form')) {
                form_modal.removeClass('is-visible');
            }
        });

        form_modal_tab.on('click', function (event) {
            event.preventDefault();
            ($(event.target).is(tab_login)) ? login_selected() : signup_selected();
        });

        $('.hide-password').on('click', function () {
            var $this = $(this),
                $password_field = $this.prev('input');

            ('password' == $password_field.attr('type')) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
            ('Hide' == $this.text()) ? $this.text('Show') : $this.text('Hide');
        });
        function login_selected() {
            form_login.addClass('is-selected');
            form_signup.removeClass('is-selected');
            tab_login.addClass('selected');
            tab_signup.removeClass('selected');
        }

        function signup_selected() {
            form_login.removeClass('is-selected');
            form_signup.addClass('is-selected');
            tab_login.removeClass('selected');
            tab_signup.addClass('selected');
        }

    });
})(jQuery);
