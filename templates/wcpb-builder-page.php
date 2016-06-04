<?php
/**
 * WooCommerce Product Builder Page Template
 * @author Philipp Bauer <philipp.bauer@vividdesign.de>
 * @version 0.9
 */

/* HANDLE POST/GET DATA */
$mix_request = false;
if ( isset( $_REQUEST ) )
	$mix_request = $_REQUEST;
do_action( 'wcpb_before_product_builder', $mix_request );

?>
<?php echo $obj_product_cat->term_id; ?>
<div id="wcpb-config-wrapper">
	<div id="cart">
	<?php do_action( 'wcpb_include_template', 'templates/cart.php'  ); ?></div>
	<div id="wcpb-config-selection">
		
		<?php do_action( 'wcpb_include_template', 'templates/wcpb-select-options.php' ); ?> 
		<div class="clearfix"></div>
	
	<div class="clearfix"></div>
	
</div>