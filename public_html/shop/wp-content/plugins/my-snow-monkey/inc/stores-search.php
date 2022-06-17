<div class="p-stores-search">

	<div class="p-stores-search__item p-stores-search__item--area">
		<p class="p-stores-search__text">地域から探す</p>
		<form method="get" id="search-form" action="<?php echo esc_url(home_url('/stores/')); ?>">
			<input type="hidden" name="post_type" value="stores">
			<input type="hidden" class="field" name="s">
			<select name="stores_area">
				<?php
					$taxonomy_name = 'stores_area';
					$taxonomys = get_terms($taxonomy_name);
					echo var_dump($taxonomys);
					if(!is_wp_error($taxonomys) && count($taxonomys)):
					foreach($taxonomys as $taxonomy):
						$tax_posts = get_posts(array('post_type' => 'stores', 'taxonomy' => $taxonomy_name, 'term' => $taxonomy->slug ) );
					if($tax_posts):
				?>
					<option value="<?php echo $taxonomy->slug; ?>"><?php echo $taxonomy->name; ?></option>
				<?php
					endif;
					endforeach;
					endif;
				?>
			</select>
			<input type="submit" value="検索">
		</form>
	</div>

	<div class="p-stores-search__item p-stores-search__item--product">
		<p class="p-stores-search__text">取扱商品から探す</p>
		<form method="get" id="search-form" action="<?php echo esc_url(home_url('/stores/')); ?>">
			<input type="hidden" name="post_type" value="stores">
			<input type="hidden" class="field" name="s">
			<select name="stores_product">
				<?php
					$taxonomy_name = 'stores_product';
					$taxonomys = get_terms($taxonomy_name);
					echo var_dump($taxonomys);
					if(!is_wp_error($taxonomys) && count($taxonomys)):
					foreach($taxonomys as $taxonomy):
						$tax_posts = get_posts(array('post_type' => 'stores', 'taxonomy' => $taxonomy_name, 'term' => $taxonomy->slug ) );
					if($tax_posts):
				?>
					<option value="<?php echo $taxonomy->slug; ?>"><?php echo $taxonomy->name; ?></option>
				<?php
					endif;
					endforeach;
					endif;
				?>
			</select>
			<input type="submit" value="検索">
		</form>
	</div>
</div>
