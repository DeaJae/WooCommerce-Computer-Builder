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
// Get subcategories
$arr_settings = $wcpb->get_settings();
$arr_session_data = $wcpb->get_session_data();
$arr_optioncats = get_categories( 'taxonomy=product_cat&hide_empty=0&hierarchical=1&child_of=' . $arr_settings['product_cat'] );
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
?>

<?php foreach ( $obj_options->posts as $obj_option ) : ?>
	
	<li>
		<div class="wcpb-option-thumb">
		<a href="<?php echo get_permalink($obj_option->ID) ;?>"> <?php echo get_the_post_thumbnail($obj_option->ID); ?> </a></div> <!-- directly pull thumb from array, clickable -->

		<h3 class="options"><a href="<?php echo get_permalink($obj_option->ID) ;?>"> <?php echo $obj_option->post_title; ?></a></h3> <!-- clickable content!-->
		<?php $product = new WC_Product($obj_option->ID); ?> <!--Directly pull pricing info from DB  -->
			<?php echo $product->get_price_html(); ?>
		<form class="wcpb-option-form" action="<?php echo get_permalink( get_the_ID() ); echo $i == 1 ? '?optioncat=' . $arr_optioncats[1]->slug : '?optioncat=' . $obj_optioncat->slug; ?>" method="post">
			<input type="hidden" name="option_id" value="<?php echo $obj_option->ID; ?>">
			<input type="hidden" name="option_cat" value="<?php echo $obj_optioncat->slug; ?>">
			<input type="hidden" name="option_qty" value="1">
			
		<button type="submit" 
		data-quantity="1" data-product_id="<?php echo $obj_option->ID; ?>"
    class="button alt add_to_cart_button product_type_simple">
   <?php _e( 'add to cart', 'wcpb' ) ;?>
   
</button>
		</form>
			<div class="wccb-option-des"><?php echo nl2br($obj_option->post_excerpt); ?></div>		<!-- post_content if your content is small enough. Post_excerpt is Product Short Description in product editing page..-->
	 
	</li>
<?php endforeach; ?>
<div class="clearfix"></div>
</ul>

<?php $i++; endforeach; ?>
</section>
