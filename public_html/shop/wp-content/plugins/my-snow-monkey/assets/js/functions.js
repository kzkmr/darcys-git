$(function() {

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
