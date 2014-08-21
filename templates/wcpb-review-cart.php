<?php
/**
 * WooCommerce THINGY Review Textlist Template (cart based version)
 * @author Philipp Bauer <philipp.bauer@vividdesign.de> | Modified by Darren Jermy <sales@littleportitservices.co.uk>
 * @version 0.9 | .1 To be removed in .2
 */
?>
<div>
<ul>

</ul>
</div>
<?php global $woocommerce; ?>
 Products will appear in cart when next category is selected <!--Non ajax cart warning, won't update until page refreshed or changed. WooCommerce default -->
<!--testing for Live updating simple cart <a class="cart-contents" href="< ?php echo $woocommerce->cart->get_cart_url(); ?>" title="< ?php _e('View your shopping cart', 'woothemes'); ?>">< ?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - < ?php echo $woocommerce->cart->get_cart_total(); ?></a>-->
<?php woocommerce_get_template( 'cart/mini-cart.php', $args );?> <!-- Minicart from WooCommerce (Non AJAX!) -->

<div class="wcpb-config-review-actions">
</div>
<!--< ?php endif; ?> -->