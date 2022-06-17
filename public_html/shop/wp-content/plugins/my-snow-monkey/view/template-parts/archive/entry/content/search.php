<?php
/**
 * @package snow-monkey
 * @author Basic Figure
 * @license GPL-2.0+
 * @version 13.0.0
 *
 * renamed: template-parts/archive/entry/content/content-search.php
 */

use Framework\Helper;

global $wp_query;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_entries_layout' => 'rich-media',
		'_force_sm_1col'  => false,
	]
);

$args = $wp_query->query;
$args = [
	'tax_query' => [
		[
			'taxonomy' => 'stores_type',
			'field'    => 'slug',
			'terms'    => [ 'directly_managed' ],
		]
	],
] + $args;

$the_query1 = new WP_Query( $args );

$args = [
	'tax_query' => [
		[
			'taxonomy' => 'stores_type',
			'field'    => 'slug',
			'terms'    => [ 'dealer' ],
		]
	],
] + $args;

$the_query2 = new WP_Query( $args );
?>

<div class="c-entry__content p-entry-content p-stores-content">
	<?php echo do_shortcode( '[call_php file=pageheader]' ) ?>
	<?php echo do_shortcode( '[call_php file=breadcrumb]' ) ?>
	<?php echo do_shortcode( '[call_php file=stores-search]' ) ?>
	<?php do_action( 'snow_monkey_prepend_archive_entry_content' ); ?>

	<div class="p-stores-content__list">
		<h3>直営店</h3>
		<div class="p-archive p-archive--stores">
			<ul class="c-entries c-entries--stores">
				<?php if ( $the_query1->have_posts() ): ?>
					<?php while ( $the_query1->have_posts() ): $the_query1->the_post(); ?>
						<li class="c-entries__item">
							<a href="<?php the_permalink(); ?>">
								<div class="c-entry-summary">
									<div class="c-entry-summary__figure">
										<?php
											the_post_thumbnail();
										?>
									</div>
									<div class="c-entry-summary__body">
										<p class="c-entry-summary__title"><?php the_title(); ?></p>
										<p class="c-entry-summary__product-title">取扱商品</p>
										<div class="c-entry-summary__term-wrap">
											<?php
											$terms_category = get_the_terms( get_the_ID(), 'stores_product' );
											if ( !empty($terms_category) ) : if ( !is_wp_error($terms_category) ) :
											?>
												<ul class="c-entry-summary__term-list">
													<?php foreach( $terms_category as $term_category ) : ?>
														<li><?php echo $term_category->name; ?></li>
													<?php endforeach; ?>
												</ul>
											<?php endif; endif; ?>
										</div>
									</div>
								</div>
							</a>
						</li>
					<?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</ul>
		</div>
	</div>

	<div class="p-stores-content__list">
		<h3>販売店</h3>
		<div class="p-archive p-archive--stores">
			<ul class="c-entries c-entries--stores">
				<?php if ( $the_query2->have_posts() ): ?>
					<?php while ( $the_query2->have_posts() ): $the_query2->the_post(); ?>
						<li class="c-entries__item">
							<a href="<?php the_permalink(); ?>">
								<div class="c-entry-summary">
									<div class="c-entry-summary__figure">
										<?php
											the_post_thumbnail();
										?>
									</div>
									<div class="c-entry-summary__body">
										<p class="c-entry-summary__title"><?php the_title(); ?></p>
										<p class="c-entry-summary__product-title">取扱商品</p>
										<div class="c-entry-summary__term-wrap">
											<?php
											$terms = get_the_terms( get_the_ID(), 'stores_product' );
											if ( !empty($terms) ) : if ( !is_wp_error($terms) ) :
											?>
												<ul class="c-entry-summary__term-list">
													<?php foreach( $terms as $term ) : ?>
														<li><?php echo $term->name; ?></li>
													<?php endforeach; ?>
												</ul>
											<?php endif; endif; ?>
										</div>
									</div>
								</div>
							</a>
						</li>
					<?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</ul>
		</div>
	</div>

	<?php
	// if ( ! empty( $wp_query->max_num_pages ) && $wp_query->max_num_pages >= 2 ) {
	// 	Helper::get_template_part( 'template-parts/archive/pagination' );
	// }
	?>
</div>

<script>
jQuery(function ($) {
$(function () {
	$('.c-entry-summary__term-list li:contains("Ice")').addClass('cat-ice');
	$('.c-entry-summary__term-list li:contains("Coffee")').addClass('cat-coffee');
	$('.c-entry-summary__term-list li:contains("Bread")').addClass('cat-bread');
});
});
</script>
