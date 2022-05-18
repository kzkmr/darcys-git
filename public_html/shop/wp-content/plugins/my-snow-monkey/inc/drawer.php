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
			<ul class="ec-item-nav__nav">
				<li class="ec-item-nav__nav-item">
					<a href="/products/list/">
						ONLINE SHOP
						<span>オンライン ショップ</span>
					</a>
				</li>
				<li class="ec-item-nav__nav-item">
					<a href="<?php echo esc_url(home_url('/news/')); ?>">
						NEWS
						<span>ニュース</span>
					</a>
				</li>
				<li class="ec-item-nav__nav-item">
					<a href="<?php echo esc_url(home_url('/story/')); ?>">
						STORY
						<span>ストーリー</span>
					</a>
				</li>
				<li class="ec-item-nav__nav-item">
					<a href="<?php echo esc_url(home_url('/concept/')); ?>">
						CONCEPT
						<span>コンセプト</span>
					</a>
				</li>
				<li class="ec-item-nav__nav-item">
					<a href="<?php echo esc_url(home_url('/products-list/')); ?>">
						PRODUCTS
						<span>プロダクツ</span>
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
						STORE
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