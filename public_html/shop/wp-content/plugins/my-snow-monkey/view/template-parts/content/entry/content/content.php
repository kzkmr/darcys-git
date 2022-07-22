<?php

/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.8.0
 */

use Framework\Helper;
?>

<?php do_action('snow_monkey_before_entry_content'); ?>

<div class="c-entry__content p-entry-content">

  <?php if (is_singular('post') || is_singular('store-news')) : ?>
    <h2 class="c-entry__content__title">
      <?php the_title(); ?>
    </h2>
    <p class="c-entry__content__date time-format">
      <?php the_time('Y/m/d'); ?>
    </p>
  <?php endif; ?>

  <?php do_action('snow_monkey_prepend_entry_content'); ?>

  <?php the_content(); ?>
  <?php Helper::get_template_part('template-parts/content/link-pages'); ?>

  <?php do_action('snow_monkey_append_entry_content'); ?>
</div>

<?php do_action('snow_monkey_after_entry_content'); ?>