<?php

/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 17.0.0
 *
 * renamed: template-parts/prev-next-nav.php
 */

use Framework\Helper;

$args = wp_parse_args(
  // phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
  $args,
  // phpcs:enable
  [
    '_in_same_term'   => false,
    '_excluded_terms' => [],
    '_taxonomy'       => 'category',
    '_next_label'     => __('Old post', 'snow-monkey'),
    '_prev_label'     => __('New post', 'snow-monkey'),
  ]
);
?>

<div class="c-prev-next-nav">
  <?php foreach (['prev', 'next'] as $key) : ?>
    <div class="c-prev-next-nav__item c-prev-next-nav__item--<?php echo esc_attr($key); ?>">
      <?php
      if ('prev' === $key) {
        $_post = get_previous_post($args['_in_same_term'], $args['_excluded_terms'], $args['_taxonomy']);
      } elseif ('next' === $key) {
        $_post = get_next_post($args['_in_same_term'], $args['_excluded_terms'], $args['_taxonomy']);
      }
      ?>

      <?php if (!empty($_post->ID)) : ?>
        <?php
        $background_image_size = wp_is_mobile() ? 'large' : 'medium';

        ob_start();
        ?>
        <div class="c-prev-next-nav__item-figure">
          <?php echo get_the_post_thumbnail($_post->ID, $background_image_size); ?>
        </div>
        <div class="c-prev-next-nav__item-text">
          <div class="c-prev-next-nav__item-label">
            <?php if ('prev' === $key) : ?>
              <i class="fas fa-angle-left" aria-hidden="true"></i>

              前の記事

            <?php else : ?>

              次の記事

              <i class="fas fa-angle-right" aria-hidden="true"></i>
            <?php endif; ?>
          </div>
          <div class="c-prev-next-nav__item-title">
            %title
          </div>
        </div>
        <?php
        $format = ob_get_clean();

        if (!function_exists('snow_monkey_prev_next_nav_title')) {
          /**
           * Trim the post title.
           *
           * @param string $nav_title The post title.
           * @return string
           */
          function snow_monkey_prev_next_nav_title($nav_title)
          {
            // phpcs:disable WordPress.WP.I18n.MissingArgDomain
            $num_words            = 60;
            $excerpt_length_ratio = 55 / _x('55', 'excerpt_length');
            // phpcs:enable
            return wp_trim_words($nav_title, $num_words * $excerpt_length_ratio);
          }
        }
        add_filter('the_title', 'snow_monkey_prev_next_nav_title');

        if ('prev' === $key) {
          previous_post_link(
            '%link',
            $format,
            $args['_in_same_term'],
            $args['_excluded_terms'],
            $args['_taxonomy']
          );
        } elseif ('next' === $key) {
          next_post_link(
            '%link',
            $format,
            $args['_in_same_term'],
            $args['_excluded_terms'],
            $args['_taxonomy']
          );
        }

        remove_filter('the_title', 'snow_monkey_prev_next_nav_title');
        ?>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</div>
<?php
