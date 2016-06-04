<?php
/**
 * WooCommerce Product Builder Options Template
 * Shows all options in a categorized manner.
 * @author Philipp Bauer <philipp.bauer@vividdesign.de> 
 * @version 0.9 
 * Updated by Darren Jermy, Version .01
 * Fixes: Category selection with pretty permalinks, bypass category lock
 */

global $wcpb;
global $woocommerce, $product;
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a> 
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
}
// Get subcategories
$arr_settings = $wcpb->get_settings();
$arr_session_data = $wcpb->get_session_data();
$arr_optioncats = get_categories( 'taxonomy=product_cat&hide_empty=0&hierarchical=1&parent=' . $arr_settings['product_cat'] );
?>

<section class="wcpb-category-options">
<?php $i = 1; foreach ( $arr_optioncats as $obj_optioncat ) : ?>

<ul id="<?php echo $obj_optioncat->slug; ?>" 
<?php echo ( ! isset( $_GET['optioncat'] ) && $i == 1 || isset( $_GET['optioncat'] ) && count( $arr_session_data['options'] ) > 0 && $i == 1 ) ? ' class="active"' : ( isset( $_GET['optioncat'] ) && count( $arr_session_data['options'] ) == 0 && $_GET['optioncat'] == $obj_optioncat->slug ? ' class="active"' : '' ); ?>>

<?php
// Get options from this category
$arr_options_args = array(
	'tax_query'	=> array(
		array(
			'taxonomy'	=> 'product_cat',
			'field'		=> 'slug',
			'terms'		=> $obj_optioncat->slug,
		),
	),
	'post_type'	=> 'product',
	'orderby'	=> 'title',
	'order'		=> 'ASC',
);
$obj_options = new WP_Query( $arr_options_args );
$obj_alt = get_post_meta($obj_option->ID);
$part = $obj_optioncat->slug;

#$price = get_post_meta( get_the_ID(), '_regular_price',true);
$defaultVal = 'Choose an option';?>
<div id="form-<?php echo $part;?>">Change <?php echo $part;?> ?:
<select id="<?php echo $part;?>" onchange="this" >
<?php foreach ( $obj_options->posts as $obj_option ) {
	
	 $product = new WC_Product($obj_option->ID);
	 $price = $product->get_price();?>
	 
<option data-price="<?php echo strip_tags($price); ?>" value="<?php echo $obj_option->ID ?>" > <?php echo $obj_option->post_title ?>    £<?php echo strip_tags($price); ?> </option>
<?php } ?> 
</select>
			<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
		<script type="text/javascript">
		jQuery(document).ready(function($) {
    // $() will work as an alias for jQuery() inside of this function
		
		//prepend a default option to every dropdown
		$('select#<?php echo $part;?>').prepend("<option value=''>Please choose an Option</option>").val('')
		
		
  jQuery(window).load(function(){
    // get the specific select element by id #model
    jQuery('select#<?php echo $part;?>').change(function() {    
        var price = "";
		var idvalue = "";
        
        // get the option that has been selected
        jQuery( "select#<?php echo $part;?> option:selected" ).each(function() {
            // get the value data-attribute, prepend it with "model"
            price += "£" + jQuery( this ).data('price');
			idvalue += "" + jQuery( this ).val();
            // the variable value will now be identical to the id of one of the wrapping custom_variation divs
        });
		// Hide all unused divs
        //jQuery( '.Price').css( 'display', 'none' );
        // Display the divs with the specific ids
        jQuery( '.Price#' + price ).css( 'display', 'block' );
$("#price-<?php echo $part;?>").text("You selected for <?php echo $part;?>: " + price);
$("#option_id-<?php echo $part;?>").val(idvalue);
$('#addcart-<?php echo $part;?>').attr('data-product_id' , +idvalue);

});
 });
 });
 
		     </script>
			 <input type="hidden" id="option_id-<?php echo $part;?>" value="">
			<input type="hidden" name="product_id-<?php echo $part;?>" value=''><button id="addcart-<?php echo $part;?>" type="submit" data-quantity="1" data-product_id=""
    class="button product_type_simple add_to_cart_button ajax_add_to_cart"> <?php _e( 'add to cart', 'woocommerce' ) ;?></button><div id="price-<?php echo $part;?>" ></div>
			</div>
	</li>
<div class="clearfix"></div>
</ul>

<?php endforeach; # $i++;  ?>
<div id="parts-total">
	Total cost of PC build:	<a href="<?php echo WC()->cart->get_cart_url(); ?>">
  <span class="cart_totals"><?php echo WC()->cart->get_cart_total(); ?></span>
</a>

			</div> 
</section>