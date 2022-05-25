$(function() {

$('.pagetop').hide();

$(window).on('scroll', function() {
    // ページトップフェードイン
    if ($(this).scrollTop() > 300) {
        $('.pagetop').fadeIn();
    } else {
        $('.pagetop').fadeOut();
    }
});

$('.pagetop').click(function () {
    $('body, html').animate({ scrollTop: 0 }, 500);
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
  $('.p-global-navi__item').hover(
    function() {
      $(this).find('.p-global-navi__jp').addClass('active');
      if( $(this).hasClass('has-child') ) {
        $(this).find('.p-global-navi-child').stop().slideDown(200);
      }
    },
    function() {
      $(this).find('.p-global-navi__jp').removeClass('active');
      if( $(this).hasClass('has-child') ) {
        $(this).find('.p-global-navi-child').stop().slideUp(200);
      }
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


// 時刻表示
$(function() {
  var time = $('.c-meta__item--published');
  time.each(function() {
    var timeText = $(this).text();
    var result = timeText.replaceAll('-', '.');
    console.log(result);
    $(this).text(result);
  });
});


// Chainstore api読み込み
var path = '../../../../../../'; // ECCUBE設置パス
$('.is_store').hide();  // is_storeを非表示
$('.not_store').hide();  // not_storeを非表示
$.ajax({
    url: path+"mypage/api_login", // apiパス
    type: 'post',
    dataType: 'json',
}).done(function(data) {
    if (data.done) {
        // ログイン時の処理を記載
        $('.is_store').show();  // is_storeを表示
    }else{
        // 未ログイン時の処理を記載
        $('.not_store').show();  // not_storeを表示
        console.log('ok');
    }
}).fail(function(data) {
        // エラー発生：未ログイン時の処理を記載
        $('.not_store').show();
        console.log('error');  // not_storeを表示
});