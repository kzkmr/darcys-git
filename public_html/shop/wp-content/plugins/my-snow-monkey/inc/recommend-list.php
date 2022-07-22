<?php
/**
 * @package snow-monkey
 * @author Basic Figure
 * @license GPL-2.0+
 * @version 1.0
 *
 */
?>

<div class="recommend-list">
  <p class="recommend-list__title">こちらの記事もおすすめ</p>
  <ul class="recommend-list__list">
    <?php
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => 4,
      'order' => 'DESC',
      'orderby' => 'rand',
      'post__not_in'=> array( get_the_ID() ),
    );
    $the_query = new WP_Query($args);
    if ( $the_query->have_posts() ):
      while ( $the_query->have_posts() ): $the_query->the_post();
      $category = get_the_category();
      $classes = '';
      switch( $category[0]->cat_name ) {
        case 'Information':
          $classes = 'color-info';
          break;
        case 'Ice':
          $classes = 'color-ice';
          break;
        case 'Bread':
          $classes = 'color-bread';
          break;
        case 'Coffee':
          $classes = 'color-coffee';
          break;
        case 'Other':
          $classes = 'color-other';
          break;
        default:
          $classes = '';
      }
    ?>
    <li class="recommend-item">
      <a href="<?php the_permalink(); ?>">
        <figure class="recommend-item__img">
          <?php
          if ( has_post_thumbnail() ) {
            the_post_thumbnail('thumbnail');
          }
          ?>
        </figure>
        <div class="recommend-item__body">
          <div class="recommend-item__meta">
            <p class="recommend-item__date"><?php the_time('Y/m/d') ?></p>
            <span class="recommend-item__cat <?php echo $classes; ?>"><?php echo $category[0]->cat_name; ?></span>
          </div>
          <p class="recommend-item__text"><?php the_title(); ?></p>
        </div>
      </a>
    </li>
    <?php
      endwhile;
    endif;
    wp_reset_postdata();
    ?>
  </ul>

</div>