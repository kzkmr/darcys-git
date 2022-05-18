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
  <div class="breadcrumb-wrapper">
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>">
          <span itemprop="name">HOME</span>
        </a>
        <meta itemprop="position" content="1" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/news/')); ?>">
          <span itemprop="name">NEWS</span>
        </a>
        <meta itemprop="position" content="2" />
      </li>
    </ol>
  </div>
<?php elseif ( is_page('story') ): ?>
  <div class="breadcrumb-wrapper">
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>">
          <span itemprop="name">HOME</span>
        </a>
        <meta itemprop="position" content="1" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/story/')); ?>">
          <span itemprop="name">STORY</span>
        </a>
        <meta itemprop="position" content="2" />
      </li>
    </ol>
  </div>
<?php elseif ( is_page('story-ice-cream') ): ?>
  <div class="breadcrumb-wrapper">
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>">
          <span itemprop="name">HOME</span>
        </a>
        <meta itemprop="position" content="1" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/story/')); ?>">
          <span itemprop="name">STORY</span>
        </a>
        <meta itemprop="position" content="2" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/story/story-ice-cream/')); ?>">
          <span itemprop="name">ICE CREAM</span>
        </a>
        <meta itemprop="position" content="3" />
      </li>
    </ol>
  </div>
<?php elseif ( is_page('concept') ): ?>
  <div class="breadcrumb-wrapper">
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>">
          <span itemprop="name">HOME</span>
        </a>
        <meta itemprop="position" content="1" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/concept/')); ?>">
          <span itemprop="name">CONCEPT</span>
        </a>
        <meta itemprop="position" content="2" />
      </li>
    </ol>
  </div>
<?php elseif ( is_page('concept-ice-cream') ): ?>
  <div class="breadcrumb-wrapper">
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>">
          <span itemprop="name">HOME</span>
        </a>
        <meta itemprop="position" content="1" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/concept/')); ?>">
          <span itemprop="name">CONCEPT</span>
        </a>
        <meta itemprop="position" content="2" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <span itemprop="name">アイスクリームのこだわり</span>
        <meta itemprop="position" content="2" />
      </li>
    </ol>
  </div>
<?php elseif ( is_page('products-list') ): ?>
  <div class="breadcrumb-wrapper">
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>">
          <span itemprop="name">HOME</span>
        </a>
        <meta itemprop="position" content="1" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/products-list/')); ?>">
          <span itemprop="name">PRODUCTS</span>
        </a>
        <meta itemprop="position" content="2" />
      </li>
    </ol>
  </div>
<?php elseif ( is_archive('stores') ): ?>
  <div class="breadcrumb-wrapper">
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>">
          <span itemprop="name">HOME</span>
        </a>
        <meta itemprop="position" content="1" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/stores/')); ?>">
          <span itemprop="name">STORE</span>
        </a>
        <meta itemprop="position" content="2" />
      </li>
    </ol>
  </div>
<?php elseif ( is_singular('stores') ): ?>
  <div class="breadcrumb-wrapper">
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>">
          <span itemprop="name">HOME</span>
        </a>
        <meta itemprop="position" content="1" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/stores/')); ?>">
          <span itemprop="name">STORE</span>
        </a>
        <meta itemprop="position" content="2" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name"><?php single_post_title(); ?></span>
        <meta itemprop="position" content="3" />
      </li>
    </ol>
  </div>
<?php elseif ( is_singular('post') ): ?>
  <div class="breadcrumb-wrapper">
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>">
          <span itemprop="name">HOME</span>
        </a>
        <meta itemprop="position" content="1" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/news/')); ?>">
          <span itemprop="name">NEWS</span>
        </a>
        <meta itemprop="position" content="2" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php get_the_permalink(); ?>">
          <span itemprop="name"><?php single_post_title(); ?></span>
        </a>
        <meta itemprop="position" content="2" />
      </li>
    </ol>
  </div>
<?php elseif ( is_singular('products') ): ?>
  <div class="breadcrumb-wrapper">
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>">
          <span itemprop="name">HOME</span>
        </a>
        <meta itemprop="position" content="1" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/products/')); ?>">
          <span itemprop="name">PRODUCTS</span>
        </a>
        <meta itemprop="position" content="2" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php get_the_permalink(); ?>">
          <span itemprop="name"><?php single_post_title(); ?></span>
        </a>
        <meta itemprop="position" content="2" />
      </li>
    </ol>
  </div>
<?php elseif ( is_page('contact') ): ?>
  <div class="breadcrumb-wrapper">
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>">
          <span itemprop="name">HOME</span>
        </a>
        <meta itemprop="position" content="1" />
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="<?php echo esc_url(home_url('/contact/')); ?>">
          <span itemprop="name">CONTACT</span>
        </a>
        <meta itemprop="position" content="2" />
      </li>
    </ol>
  </div>
<?php endif; ?>