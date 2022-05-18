<?php
/**
 * @package snow-monkey
 * @author Basic Figure
 * @license GPL-2.0+
 * @version 1.0
 *
 */
?>

<?php if ( is_page('news') ): ?>
  <div class="pageheader">
    <img src="<?php echo wp_upload_dir()['url']; ?>/news.jpg" alt="">
    <h1 class="pageheader__title">
      NEWS
    </h1>
  </div>
<?php elseif ( is_page('story') ): ?>
  <div class="pageheader">
    <img src="<?php echo wp_upload_dir()['url']; ?>/story.jpg" alt="">
    <h1 class="pageheader__title">
      STORY
      <span>製品の誕生物語</span>
    </h1>
  </div>
<?php elseif ( is_page('story-ice-cream') ): ?>
  <div class="pageheader">
    <img src="<?php echo wp_upload_dir()['url']; ?>/story_ice.jpg" alt="">
    <h1 class="pageheader__title">
      STORY
      <span>ICE CREAM</span>
    </h1>
  </div>
<?php elseif ( is_page('products-list') ): ?>
  <div class="pageheader">
    <img src="<?php echo wp_upload_dir()['url']; ?>/products.jpg" alt="">
    <h1 class="pageheader__title">
      PRODUCTS
      <span>ダシーズファクトリーの商品ラインアップ</span>
    </h1>
  </div>
<?php elseif ( is_archive('stores') ): ?>
  <div class="pageheader">
    <img src="<?php echo wp_upload_dir()['url']; ?>/stores.jpg" alt="">
    <h1 class="pageheader__title">
      STORE
      <span>ダシーズファクトリー実店舗のご案内</span>
    </h1>
  </div>
<?php elseif ( is_singular('post') ): ?>
  <div class="pageheader-wrap">
    <div class="pageheader">
      <?php
      if (has_post_thumbnail()) {
          the_post_thumbnail();// サムネイルタグを出力
          $thumbnail = get_the_post_thumbnail();// サムネイル画像情報を変数に格納
      } else {
        ?>
          <img src="<?php echo wp_upload_dir()['url']; ?>/products-detail.jpg" alt="">
        <?php
      }
      ?>
      <h1 class="pageheader__title">
        <?php single_post_title(); ?>
      </h1>
    </div>
  </div>
<?php elseif ( is_page('concept') || is_parent_slug() === 'concept' ): ?>
  <div class="pageheader">
    <img src="<?php echo wp_upload_dir()['url']; ?>/concept_02.jpg" alt="">
    <h1 class="pageheader__title">
      CONCEPT
      <span>製品のこだわり</span>
    </h1>
  </div>
<?php elseif ( get_post_type() == 'products' ): ?>
  <div class="pageheader-wrap">
    <div class="pageheader">
      <img src="<?php echo wp_upload_dir()['url']; ?>/products-detail.jpg" alt="">
      <h1 class="pageheader__title">
        PRODUCTS
        <span>ICE CREAM</span>
      </h1>
    </div>
  </div>
<?php endif; ?>