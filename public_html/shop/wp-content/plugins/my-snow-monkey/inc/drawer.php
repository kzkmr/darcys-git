<div class="ec-overlay-role"></div>
<div class="ec-drawer-role-close">
  <div class="ec-drawer-role-close__bars">
    <span></span>
    <span></span>
  </div>
</div>
<div class="ec-drawer-role">
  <div class="ec-header-search">
    <form method="get" class="searchform" action="/products/list">
      <div class="ec-header-search__keyword">
        <div class="ec-input">
          <input type="search" name="name" maxlength="50" class="search-name" placeholder="キーワードを入力" />
          <button class="ec-header-search__keyword-btn" type="submit">
            <div class="ec-icon">
              <img src="<?php echo ec_asset_url(); ?>/icon/search-dark.svg" alt="">
            </div>
          </button>
        </div>
      </div>
    </form>
  </div>

  <div class="ec-header-link-area">
    <div class="ec-header-link__list">
      <a class="ec-header-link__item" href="<?php echo ec_url(); ?>/mypage">
        <span>マイページ</span>
      </a>
    </div>
  </div>

  <div class="ec-header-category-area">
    <div class="ec-item-nav">
      <ul class="ec-item-nav__nav is_store hide">
        <li class="ec-item-nav__nav-item">
          <a href="<?php echo ec_url(); ?>/mypage/menu">
            トップ
          </a>
        </li>
        <li class="ec-item-nav__nav-item">
          <a href="<?php echo ec_url(); ?>/mypage/news">
            新着情報
          </a>
        </li>
        <li class="ec-item-nav__nav-item">
          <a href="<?php echo esc_url(home_url('/store-guide/')); ?>">
            ご利用案内
          </a>
        </li>
        <li class="ec-item-nav__nav-item">
          <a href="<?php echo ec_url(); ?>">
            商品発注
          </a>
        </li>
        <li class="ec-item-nav__nav-item">
          <a href="<?php echo ec_url(); ?>/products/list?category_id=8">
            販促品発注
          </a>
        </li>
        <li class="ec-item-nav__nav-item">
          <a href="<?php echo esc_url(home_url('/products-list/')); ?>">
            商品紹介
          </a>
        </li>
        <li class="ec-item-nav__nav-item">
          <a href="<?php echo ec_url(); ?>/mypage/">
            マイページ
          </a>
        </li>
      </ul>
      <ul class="ec-item-nav__nav not_store hide">
        <li class="ec-item-nav__nav-item">
          <a href="/products/list/">
            ONLINE SHOP
            <span>オンライン ショップ</span>
          </a>
        </li>
        <li class="ec-item-nav__nav-item">
          <a href="<?php echo esc_url(home_url('/guide/')); ?>">
            GUIDE
            <span>お買い物ガイド</span>
          </a>
        </li>
        <li class="ec-item-nav__nav-item">
          <a href="<?php echo esc_url(home_url('/news/')); ?>">
            NEWS
            <span>お知らせ</span>
          </a>
        </li>
        <li class="ec-item-nav__nav-item">
          <a href="<?php echo esc_url(home_url('/story/')); ?>">
            STORY
            <span>製品の誕生物語</span>
          </a>
        </li>
        <li class="ec-item-nav__nav-item">
          <a href="<?php echo esc_url(home_url('/concept/')); ?>">
            CONCEPT
            <span>製品のこだわり</span>
          </a>
        </li>
        <li class="ec-item-nav__nav-item">
          <a href="<?php echo esc_url(home_url('/products-list/')); ?>">
            PRODUCTS
            <span>製品ラインアップ</span>
          </a>
        </li>
        <li class="ec-item-nav__nav-item">
          <a href="<?php echo ec_url(); ?>/company/">
            ABOUT US
            <span>会社概要</span>
          </a>
        </li>
        <li class="ec-item-nav__nav-item">
          <a href="<?php echo esc_url(home_url('/stores/')); ?>">
            STORES
            <span>実店舗のご紹介</span>
          </a>
        </li>
        <li class="ec-item-nav__nav-item">
          <a href="<?php echo esc_url(home_url('/contact/')); ?>">
            CONTACT US
            <span>お問い合わせ</span>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <!-- ▲カテゴリナビ(SP) -->

</div>