<?php
/**
 * @package inc2734/wp-share-buttons
 * @author inc2734
 * @license GPL-2.0+
 */
?>
<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo esc_attr( get_permalink( $post_id ) ); ?>" data-text="<?php echo esc_attr( $title ); ?>" data-hashtags="<?php echo esc_attr( $hashtags ); ?>"><?php esc_html_e( 'Tweet', 'inc2734-wp-share-buttons' ); ?></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
