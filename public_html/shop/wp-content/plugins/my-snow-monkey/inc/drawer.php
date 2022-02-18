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
			<a class="ec-header-link__item" href="<?php echo ec_url(); ?>/entry">
				<span>新規会員登録</span>
			</a>
			<a class="ec-header-link__item" href="<?php echo ec_url(); ?>/mypage/login">
				<span>ログイン</span>
			</a>
		</div>
	</div>

	<div class="ec-header-category-area">
		<div class="ec-item-nav">
			<ul class="ec-item-nav__nav">
				<li>
					<a href="<?php echo esc_url(home_url('/')); ?>">NEWS</a>
				</li>
				<li>
					<a href="<?php echo esc_url(home_url('/story/')); ?>">STORY</a>
				</li>
				<li>
					<span>CONCEPT</span>
					<ul class="ec-item-nav__child-nav">
						<li>
							<a href="">ICE CREAM</a>
						</li>
						<li>
							<a href="">BREAD</a>
						</li>
						<li>
							<a href="">COFFEE</a>
						</li>
					</ul>
				</li>
				<li>
					<span>PRODUCTS</span>
					<ul class="ec-item-nav__child-nav">
						<li>
							<a href="<?php echo ec_url(); ?>/products/list?category_id=1">
								ICE CREAM
							</a>

						</li>
						<li>
							<a href="<?php echo ec_url(); ?>/products/list?category_id=2">
								BREAD
							</a>

						</li>
						<li>
							<a href="<?php echo ec_url(); ?>/products/list?category_id=5">
								COFFEE
							</a>

						</li>
					</ul>
				</li>
				<li>
					<a href="">ABOUT US</a>
				</li>
				<li>
					<a href="<?php echo ec_url(); ?>/products/">STORE</a>
				</li>
				<li>
					<a href="">CONTACT US</a>
				</li>
			</ul>
		</div>
	</div>

	<!-- ▲カテゴリナビ(SP) -->

</div>