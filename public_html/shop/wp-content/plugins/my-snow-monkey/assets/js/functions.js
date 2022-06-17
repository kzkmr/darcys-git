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
  $('.ec-header-bottom__store-link-item').hover(
    function() {
      $(this).find('.store-link-jp').addClass('active');
    },
    function() {
      $(this).find('.store-link-jp').removeClass('active');
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
  var time = $('.c-meta__item--published, .time-format');
  time.each(function() {
    var timeText = $(this).text();
    var result = timeText.replaceAll('-', '/');
    console.log(result);
    $(this).text(result);
  });
});

// 販売店ヘッダーナビ
$(function() {
  var url = location.pathname;
  var item = $('.ec-header-bottom-list__item');
  console.log(url);
  switch(url) {
    case '/shop/store-guide/':
    item.eq(2).addClass('active');
    break;
    case '/mypage/news':
    item.eq(1).addClass('active');
    break;
  }
});


// Chainstore api読み込み
var path = '../../../../../../'; // ECCUBE設置パス
$.ajax({
    url: path+"mypage/api_isstore", // apiパス
    type: 'post',
    dataType: 'json',
}).done(function(data) {
    if (data.done) {
        // 販売店時の処理を記載
        $('.is_store').removeClass('hide');  // is_storeを表示
        $('body').addClass('layout-store');
        //console.log('store');
    }else{
        // 販売店以外の処理を記載
        $('.not_store').removeClass('hide');  // not_storeを表示
        //console.log('not store');
    }
}).fail(function(data) {
        // エラー発生：販売店以外の処理を記載
        $('.not_store').removeClass('hide');  // not_storeを表示
        //console.log('error');
});

$.ajax({
    url: path+"mypage/api_login", // apiパス
    type: 'post',
    dataType: 'json',
}).done(function(data) {
    if (data.done) {
        // ログイン時の処理を記載
        $('.nologin_block').removeClass('hide');  // login_blockを表示
        console.log('logged in!');
    }else{
        // 未ログイン時の処理を記載
        $('.login_block').removeClass('hide');  // nologin_blockを表示
        console.log('logged out!');
    }
}).fail(function(data) {
        // エラー発生：未ログイン時の処理を記載
        $('.login_block').removeClass('hide');  // nologin_blockを表示
        console.log('log error!');
});
