<?php

/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 15.9.0
 *
 * renamed: template-parts/2row-header.php
 */

use Framework\Helper;

$header_content         = get_theme_mod('header-content');
$header_type            = get_theme_mod('header-layout') . '-header';
$header_alignfull       = get_theme_mod('header-alignfull');
$has_global_nav         = has_nav_menu('global-nav');
$has_drawer_nav         = has_nav_menu('drawer-nav') || has_nav_menu('drawer-sub-nav');
$has_header_sub_nav     = has_nav_menu('header-sub-nav');
$data_has_global_nav    = $has_global_nav ? 'true' : 'false';
$container_class        = $header_alignfull ? 'c-fluid-container' : 'c-container';
$hamburger_btn_position = get_theme_mod('hamburger-btn-position');
?>

<div class="l-<?php echo esc_attr($header_type); ?>" data-has-global-nav="<?php echo esc_attr($data_has_global_nav); ?>">

  <!-- スマホ/タブレット 用 -->
  <div class="c-row ec-header-navi-sp pc-none">
    <div class="ec-header-navi-sp__logo not_store hide">
      <a href="<?php echo ec_url(); ?>">
        <img src="<?php echo ec_asset_url(); ?>/img/common/logo_sp.png" width="80">
      </a>
    </div>
    <div class="ec-header-navi-sp__logo is_store hide">
      <a href="<?php echo ec_url(); ?>/mypage/menu">
        <img src="<?php echo ec_asset_url(); ?>/img/common/logo_sp.png" width="80">
      </a>
    </div>
    <div class="ec-header-navi-sp__login">
      <a class="nologin_block hide" href="<?php echo ec_url(); ?>/logout">
        <img src="<?php echo ec_asset_url(); ?>/img/common/lock-alt-solid.svg" width="25">
        <span>ログアウト</span>
      </a>
      <a class="login_block hide" href="<?php echo ec_url(); ?>/mypage/login">
        <img src="<?php echo ec_asset_url(); ?>/img/common/lock-alt-solid.svg" width="25">
        <span>ログイン</span>
      </a>
    </div>
    <div class="ec-header-navi-sp__cart">
      <div class="ec-headerRole__cart">
        <div class="ec-cartNaviWrap">
          <div class="ec-cartNavi">
            <a href="<?php echo ec_url(); ?>/cart">
              <img src="<?php echo ec_asset_url(); ?>/img/common/icon_cart_sp.png" width="30">
              <span class="ec-cartNavi__badge cart-num-indicator">0</span>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="ec-header-navi-sp__store">
      <a href="<?php echo ec_url(); ?>/products/list">
        <p><span class="small">ONLINE</span><span class="large">SHOP</span></p>
        <img src="<?php echo ec_asset_url(); ?>/img/common/icon_online_store.png" width="32">
      </a>
    </div>
    <div class="ec-header-navi-sp__btn">
      <div class="ec-header-sp-btn">
        <div class="ec-header-sp-btn__text">
          <span>MENU</span>
        </div>
        <div class="ec-header-sp-btn__bars">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
  </div>

  <!-- PC 用 -->
  <div class="p-custom-header sp-none">
    <div class="ec-header-top">
      <div class="ec-header-search">
        <form method="get" class="searchform" action="<?php echo ec_url(); ?>/products/list">
          <div class="ec-header-search__keyword">
            <div class="ec-input">
              <input type="search" name="name" maxlength="50" class="search-name" placeholder="キーワードを入力">
              <button class="ec-header-search__keyword-btn" type="submit">
                <div class="ec-icon">
                  <img src="<?php echo ec_url(); ?>/html/template/default/assets/icon/search-dark.svg" alt="">
                </div>
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="ec-header-top__login">
        <div class="ec-header-nav">
          <div class="ec-header-nav__item login_block hide">
            <a href="<?php echo ec_url(); ?>/entry">
              <span class="ec-header-nav__item-link">新規会員登録</span>
            </a>
          </div>
          <div class="ec-header-nav__item nologin_block hide">
            <a href="<?php echo ec_url(); ?>/mypage">
              <span class="ec-header-nav__item-link">マイページ</span>
            </a>
          </div>
          <div class="ec-header-nav__item login_block hide">
            <a href="<?php echo ec_url(); ?>/mypage/login">
              <span class="ec-header-nav__item-link">ログイン</span>
            </a>
          </div>
          <div class="ec-header-nav__item nologin_block hide">
            <a href="<?php echo ec_url(); ?>/logout">
              <span class="ec-header-nav__item-link">ログアウト</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="ec-header-bottom">
      <div class="ec-header-bottom__logo not_store hide">
        <p class="ec-header-bottom__img">
          <a href="<?php echo ec_url(); ?>">
            <img src="<?php echo ec_asset_url(); ?>/img/common/logo_header.png">
          </a>
        </p>
      </div>
      <div class="ec-header-bottom__logo is_store hide">
        <p class="ec-header-bottom__img">
          <a href="<?php echo ec_url(); ?>/mypage/menu">
            <img src="<?php echo ec_asset_url(); ?>/img/common/logo_header.png">
          </a>
        </p>
      </div>
      <div class="ec-header-bottom__center not_store hide">
        <div class="ec-header-bottom__gnav">
          <ul class="p-global-navi">
            <li class="p-global-navi__item">
              <a href="<?php echo esc_url(home_url('/news/')); ?>">NEWS</a>
              <a href="<?php echo esc_url(home_url('/news/')); ?>" class="p-global-navi__jp">お知らせ</a>
            </li>
            <li class="p-global-navi__item has-child">
              <a href="<?php echo esc_url(home_url('/story/')); ?>">STORY</a>
              <a href="<?php echo esc_url(home_url('/story/')); ?>" class="p-global-navi__jp">製品の誕生ものがたり</a>
              <ul class="p-global-navi-child">
                <li class="p-global-navi-child__item">
                  <a href="<?php echo esc_url(home_url('/story/')); ?>story-ice-cream">- ICE</a>
                </li>
              </ul>
            </li>
            <li class="p-global-navi__item has-child">
              <a href="<?php echo esc_url(home_url('/concept/')); ?>">CONCEPT</a>
              <a href="<?php echo esc_url(home_url('/concept/')); ?>" class="p-global-navi__jp">製品のこだわり</a>
              <ul class="p-global-navi-child">
                <li class="p-global-navi-child__item">
                  <a href="<?php echo esc_url(home_url('/concept/')); ?>concept-ice-cream/">- ICE</a>
                </li>
              </ul>
            </li>
            <li class="p-global-navi__item">
              <a href="<?php echo esc_url(home_url('/products-list/')); ?>">PRODUCTS</a>
              <a href="<?php echo esc_url(home_url('/products-list/')); ?>" class="p-global-navi__jp">商品ラインアップ</a>
            </li>
            <li class="p-global-navi__item">
              <a href="<?php echo ec_url(); ?>/company">ABOUT US</a>
              <a href="<?php echo ec_url(); ?>/company" class="p-global-navi__jp">会社概要</a>
            </li>
            <li class="p-global-navi__item">
              <a href="<?php echo esc_url(home_url('/stores/')); ?>">STORES</a>
              <a href="<?php echo esc_url(home_url('/stores/')); ?>" class="p-global-navi__jp">実店舗のご紹介</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="ec-header-bottom__center is_store hide">
        <div class="ec-header-bottom-title">
          <h1>ダシーズファクトリー商品発注システム</h1>
        </div>
      </div>
      <div class="ec-header-bottom__right">
        <ul class="ec-header-bottom__store-link">
          <li class="ec-header-bottom__store-link-item">
            <a href="<?php echo ec_url(); ?>/cart">
              <span class="ec-cartNavi-badge cart-num-indicator">0</span>
              <img src="<?php echo ec_asset_url(); ?>/img/common/icon_store.png" alt="" width="34">
            </a>
          </li>
          <li class="ec-header-bottom__store-link-item not_store hide">
            <a href="<?php echo ec_url(); ?>/products/list">
              <span>ONLINE SHOP</span>
            </a>
            <a href="/shop/guide/" class="store-link-jp">オンラインショップ</a>
          </li>
          <li class="ec-header-bottom__store-link-item not_store hide">
            <a href="<?php echo esc_url(home_url('/guide/')); ?>"><span class="store-link-small">GUIDE</span></a>
            <a href="<?php echo esc_url(home_url('/guide/')); ?>" class="store-link-jp">お買い物ガイド</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="ec-header-bottom-list is_store hide">
      <ul class="ec-header-bottom-list__list">
        <li class="ec-header-bottom-list__item">
          <a href="<?php echo ec_url(); ?>/mypage/menu">トップ</a>
        </li>
        <li class="ec-header-bottom-list__item">
          <a href="<?php echo ec_url(); ?>/mypage/news">新着情報</a>
        </li>
        <li class="ec-header-bottom-list__item">
          <a href="<?php echo esc_url(home_url('/store-guide/')); ?>">ご利用案内</a>
        </li>
        <li class="ec-header-bottom-list__item">
          <a href="<?php echo ec_url(); ?>">商品発注</a>
        </li>
        <li class="ec-header-bottom-list__item">
          <a href="<?php echo ec_url(); ?>/products/list?category_id=8">販促品発注</a>
        </li>
        <li class="ec-header-bottom-list__item">
          <a href="<?php echo esc_url(home_url('/products-list/')); ?>">商品紹介</a>
        </li>
        <li class="ec-header-bottom-list__item ec-header-bottom-list__item--colored">
          <a href="<?php echo ec_url(); ?>/mypage/">マイページ</a>
        </li>
      </ul>
    </div>
  </div>
</div>
