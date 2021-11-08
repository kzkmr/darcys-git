<?php
/**
 * @package snow-monkey
 * @author Basic Figure
 * @license GPL-2.0+
 * @version 1.0
 *
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_entries_layout'      => 'rich-media',
		'_excerpt_length'      => null,
		'_force_sm_1col'       => false,
		'_infeed_ads'          => false,
		'_item_thumbnail_size' => 'medium_large',
		'_item_title_tag'      => 'h3',
		// '_display_item_meta'   => 'post' === $args['_name'] ? true : false,
		'_display_item_terms'  => 'post' === $args['_name'] ? true : false,
		'_posts_query'         => false,
	]
);
?>

<?php
 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
 
$the_query = new WP_Query( array(
  'post_status' => 'publish',
  'post_type' => 'post',
  'paged' => $paged,
  'posts_per_page' => 9,
  'orderby'     => 'date',
  'order' => 'DESC'
) );
?>

<div class="smb-recent-posts">

  <div class="snow-monkey-posts snow-monkey-recent-posts">

    <ul class="c-entries c-entries--rich-media" data-has-infeed-ads="false" data-force-sm-1col="false">
      <?php 
        while ($the_query->have_posts()) : $the_query->the_post();

        $_terms = Helper::get_the_public_terms( get_the_ID() );
        $args['_terms'] = $_terms ? [ $_terms[0] ] : [];
      ?>
      <li class="c-entries__item">
        <?php

        Helper::get_template_part(
          'template-parts/loop/entry-summary',
          $args['_name'],
          [
            '_context'        => $args['_context'],
            '_entries_layout' => $args['_entries_layout'],
            '_excerpt_length' => $args['_excerpt_length'],
            '_thumbnail_size' => $args['_item_thumbnail_size'],
            '_terms'          => $_terms ? [ $_terms[0] ] : [],
            '_title_tag'      => $args['_item_title_tag'],
            '_display_meta'   => true,
          ]
        );
        ?>
      </li>
    <?php endwhile; ?>
    
    </ul>
  </div>

</div>

<div class="p-blog-navi">
<?php //ページリスト表示処理
global $wp_rewrite;
$paginate_base = get_pagenum_link(1);
if(strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()){
  $paginate_format = '';
  $paginate_base = add_query_arg('paged','%#%');
}else{
  $paginate_format = (substr($paginate_base,-1,1) == '/' ? '' : '/') .
  user_trailingslashit('page/%#%/','paged');
  $paginate_base .= '%_%';
}
echo paginate_links(array(
  'base' => $paginate_base,
  'format' => $paginate_format,
  'total' => $the_query->max_num_pages,
  'mid_size' => 1,
  'current' => ($paged ? $paged : 1),
  'prev_text' => '<<<',
  'next_text' => '>>>',
)); ?>
</div>

<?php wp_reset_postdata(); ?>
