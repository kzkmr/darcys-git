<?php
/**
 * @package snow-monkey
 * @author Basic Figure
 * @license GPL-2.0+
 * @version 1.0
 *
 */
?>

<div class="product-gallery">
  <?php
    $group_set = SCF::get('product_images');
  ?>
  <div class="main-img js-main-img">
    <img src="<?php echo esc_url(wp_get_attachment_image_src($group_set[0]['product_image'],'full')[0]); ?>" alt="">
  </div>

  <ul class="sub-img js-sub-img">
    <?php
      foreach ( $group_set as $field_name => $fields ):
        $spotImg = wp_get_attachment_image_src($fields['product_image'],'full');
    ?>
    <li>
      <img src="<?php echo esc_url($spotImg[0]); ?>" alt="">
    </li>
    <?php
      endforeach;
    ?>
  </ul>

</div>

<script>
$(function () {
$(".js-sub-img img").on("click", function () {
  img = $(this).attr("src");
  $(".js-main-img img").fadeOut(500, function () {
    $(".js-main-img img")
      .attr("src", img)
      .on("load", function () {
        $(this).fadeIn(500);
      });
    });
  });
});
</script>
