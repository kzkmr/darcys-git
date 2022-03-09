$(function() {

$('.pagetop').hide();

$(window).on('scroll', function() {
    // ページトップフェードイン
    if ($(this).scrollTop() > 300) {
        $('.pagetop').fadeIn();
    } else {
        $('.pagetop').fadeOut();
    }

    // PC表示の時のみに適用
    if (window.innerWidth > 767) {

        if ($('.ec-orderRole').length) {

            var side = $(".ec-orderRole__summary"),
                wrap = $(".ec-orderRole").first(),
                min_move = wrap.offset().top,
                max_move = wrap.height(),
                margin_bottom = max_move - min_move;

            var scrollTop = $(window).scrollTop();
            if (scrollTop > min_move && scrollTop < max_move) {
                var margin_top = scrollTop - min_move;
                side.css({"margin-top": margin_top});
            } else if (scrollTop < min_move) {
                side.css({"margin-top": 0});
            } else if (scrollTop > max_move) {
                side.css({"margin-top": margin_bottom});
            }

        }
    }
    return false;
});

$('.ec-header-sp-btn').on('click', function() {
    $('.ec-layoutRole').toggleClass('is_active');
    $('.ec-drawer-role').toggleClass('is_active');
    $('.ec-drawer-role-close').toggleClass('is_active');
    $('body').toggleClass('have_curtain');
});

$('.ec-overlay-role').on('click', function() {
    $('body').removeClass('have_curtain');
    $('.ec-layoutRole').removeClass('is_active');
    $('.ec-drawer-role').removeClass('is_active');
    $('.ec-drawer-role-close').removeClass('is_active');
});

$('.ec-drawer-role-close').on('click', function() {
    $('body').removeClass('have_curtain');
    $('.ec-layoutRole').removeClass('is_active');
    $('.ec-drawer-role').removeClass('is_active');
    $('.ec-drawer-role-close').removeClass('is_active');
});

});

// ヘッダードロップダウンメニュー
$(function() {
  $('.has-child').hover(
    function() {
      $(this).find('.p-global-navi__jp').addClass('active');
      $(this).find('.p-global-navi-child').stop().slideDown(200);
    },
    function() {
      $(this).find('.p-global-navi__jp').removeClass('active');
      $(this).find('.p-global-navi-child').stop().slideUp(200);
    }
  );
});

// $(function () {
//   var term = $('.c-entry-summary__term');
//   if( term.length ) {
//     term.each(function() {
//       var head = $(this).parent().next().find('.c-entry-summary__header');
//       $(this).appendTo(head);
//     });
//   }

//   var meta = $('.c-entry-summary__meta');
//   if( meta.length ) {
//     meta.each(function() {
//       var head = $(this).prevAll('.c-entry-summary__header');
//       $(this).appendTo(head);
//     });
//   }
// });

// $(function () {
//   $(window).on('load resize', function () {
//     var windowWidth = window.innerWidth;
//     var slider = $('.p-news-list ul.c-entries');
//     if (windowWidth >= 768) {

//       if (slider.length) {
//         if(slider.children().length >= 4){
//           slider.not('.slick-initialized').slick({
//             arrows: true,
//             dots: false,
//             autoplay: true,
//             autoplaySpeed: 4000,
//             speed: 1500,
//             slidesToShow: 3,
//             slidesToScroll: 1,
//             lazyLoad: 'ondemand',
//             pauseOnFocus: false,
//             pauseOnHover: false,
//             pauseOnDotsHover: false,
//             centerMode: true,
//             centerPadding: '0',
//             cssEase: 'linear'
//           });
//         }
//       }

//     } else {

//       if (slider.length) {
//         slider.not('.slick-initialized').slick({
//           arrows: true,
//           dots: false,
//           autoplay: true,
//           autoplaySpeed: 4000,
//           speed: 1500,
//           slidesToShow: 1,
//           slidesToScroll: 1,
//           lazyLoad: 'ondemand',
//           pauseOnFocus: false,
//           pauseOnHover: false,
//           pauseOnDotsHover: false,
//           centerMode: true,
//           centerPadding: '0',
//           swipeToSlide: true,
//           cssEase: 'linear'
//         });
//       }
//     }
//   });
// });
