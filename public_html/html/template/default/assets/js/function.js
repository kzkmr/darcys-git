
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

$(function () {

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

    // TODO: カート展開時のアイコン変更処理
    $('.ec-headerRole__cart').on('click', '.ec-cartNavi', function() {
        // $('.ec-cartNavi').toggleClass('is-active');
        $('.ec-cartNaviIsset').toggleClass('is-active');
        $('.ec-cartNaviNull').toggleClass('is-active')
    });

    $('.ec-headerRole__cart').on('click', '.ec-cartNavi--cancel', function() {
        // $('.ec-cartNavi').toggleClass('is-active');
        $('.ec-cartNaviIsset').toggleClass('is-active');
        $('.ec-cartNaviNull').toggleClass('is-active')
    });

    $('.ec-orderMail__link').on('click', function() {
        $(this).siblings('.ec-orderMail__body').slideToggle();
    });

    $('.ec-orderMail__close').on('click', function() {
        $(this).parent().slideToggle();
    });

    $('.is_inDrawer').each(function() {
        var html = $(this).html();
        $(html).appendTo('.ec-drawer-role');
    });

    $('.ec-blockTopBtn').on('click', function() {
        $('html,body').animate({'scrollTop': 0}, 500);
    });

    // スマホのドロワーメニュー内の下層カテゴリ表示
    // TODO FIXME スマホのカテゴリ表示方法
    $('.ec-itemNav ul a').click(function() {
        var child = $(this).siblings();
        if (child.length > 0) {
            if (child.is(':visible')) {
                return true;
            } else {
                child.slideToggle();
                return false;
            }
        }
    });

    // イベント実行時のオーバーレイ処理
    // classに「load-overlay」が記述されていると画面がオーバーレイされる
    $('.load-overlay').on({
        click: function() {
            loadingOverlay();
        },
        change: function() {
            loadingOverlay();
        }
    });

    // submit処理についてはオーバーレイ処理を行う
    $(document).on('click', 'input[type="submit"], button[type="submit"]', function() {

        // html5 validate対応
        var valid = true;
        var form = getAncestorOfTagType(this, 'FORM');

        if (typeof form !== 'undefined' && !form.hasAttribute('novalidate')) {
            // form validation
            if (typeof form.checkValidity === 'function') {
                valid = form.checkValidity();
            }
        }

        if (valid) {
            loadingOverlay();
        }
    });
});

$(window).on('pageshow', function() {
    loadingOverlay('hide');
});

/**
 * オーバーレイ処理を行う関数
 */
function loadingOverlay(action) {

    if (action == 'hide') {
        $('.bg-load-overlay').remove();
    } else {
        $overlay = $('<div class="bg-load-overlay">');
        $('body').append($overlay);
    }
}

/**
 *  要素FORMチェック
 */
function getAncestorOfTagType(elem, type) {

    while (elem.parentNode && elem.tagName !== type) {
        elem = elem.parentNode;
    }

    return (type === elem.tagName) ? elem : undefined;
}

// anchorをクリックした時にformを裏で作って指定のメソッドでリクエストを飛ばす
// Twigには以下のように埋め込む
// <a href="PATH" {{ csrf_token_for_anchor() }} data-method="(put/delete/postのうちいずれか)" data-confirm="xxxx" data-message="xxxx">
//
// オプション要素
// data-confirm : falseを定義すると確認ダイアログを出さない。デフォルトはダイアログを出す
// data-message : 確認ダイアログを出す際のメッセージをデフォルトから変更する
//
$(function() {
    var createForm = function(action, data) {
        var $form = $('<form action="' + action + '" method="post"></form>');
        for (input in data) {
            if (data.hasOwnProperty(input)) {
                $form.append('<input name="' + input + '" value="' + data[input] + '">');
            }
        }
        return $form;
    };

    $('a[token-for-anchor]').click(function(e) {
        e.preventDefault();
        var $this = $(this);
        var data = $this.data();
        if (data.confirm != false) {
            if (!confirm(data.message ? data.message : eccube_lang['common.delete_confirm'] )) {
                return false;
            }
        }

        // 削除時はオーバーレイ処理を入れる
        loadingOverlay();

        var $form = createForm($this.attr('href'), {
            _token: $this.attr('token-for-anchor'),
            _method: data.method
        }).hide();

        $('body').append($form); // Firefox requires form to be on the page to allow submission
        $form.submit();
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

// 販売店ヘッダーナビ
$(function() {
  var url = location.pathname;
  var query = location.search ? location.search : '';
  url = url + query;
  var item = $('.ec-header-bottom-list__item');
  // console.log(url);
  // console.log(url.startsWith('/mypage'));

  switch(url) {
    case '/mypage/menu':
    item.eq(0).addClass('active');
    break;
    case '/mypage/news':
    item.eq(1).addClass('active');
    break;
    case '/products/list':
    case '/products/list?category_id=1':
    item.eq(2).addClass('active');
    break;
    case '/products/list?category_id=8':
    item.eq(3).addClass('active');
    break;
    // case '/mypage':
    // case '/mypage/chainstore_coupon_jisseki':
    // case '/mypage/chainstore_coupon_list':
    // item.eq(4).addClass('active');
    // break;
  }
});

// 数字インプット
$(function () {
  var input = $('input[type="number"]');
  input.on('focus', function() {
    this.select();
  });
});