<?php
/**
 * WooCommerce Product Builder Tablist Template
 * @author Philipp Bauer <philipp.bauer@vividdesign.de> | modified by Darren Jermy (www.littleportitservices.co.uk)
 * Tablist using Woocommerce categories without creating DB entries in WCPB
 * @version 0.9.1
 */
global $wcpb;
$arr_session_data = $wcpb->get_session_data();
$unlocked = count( $arr_session_data['current_product'] ) > 0 ? false : false;
$arr_optioncats = get_categories( 'taxonomy=product_cat&hide_empty=0&hierarchical=1&child_of=' . $arr_settings['product_cat'] );
?>

<nav class="wcpb-category-tablist">
<div class="menu-categs-box">	
			<?php $arr_optioncats = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC',  'parent' => 90)); //, 'exclude' => '1,2,3' (Parent is your category containing the wanted Categories.. use its ID)
				foreach($arr_optioncats as $arr_optioncat) : 
					#$wthumbnail_id = get_woocommerce_term_meta( $wcatTerm->term_id, 'thumbnail_id', true );
					#$wimage = wp_get_attachment_url( $wthumbnail_id );
				?>
				<ul>
					<!--<li class="libreak"><php if($wimage!=""):?><img src="<php echo $wimage?>"><php endif;?></li> -->
					<li>
						<?php echo ( ! isset( $_GET['optioncat'] ) && $i == 1 || isset( $_GET['optioncat'] ) && count( $arr_session_data['options'] ) == 0 && $i == 1 ) ? ' active' : ( isset( $_GET['optioncat'] ) && count( $arr_session_data['options'] ) > 0 && $_GET['optioncat'] == $key ? ' active' : '' ); ?><a href="<?php echo get_permalink( get_the_ID() ) . '?optioncat=' . $arr_optioncat->slug ;?>"><?php echo $arr_optioncat->name; ?> </a> 
						<ul class="wsubcategs">
						<?php
						$wsubargs = array(
						   'hierarchical' => 1,
						   'show_option_none' => '',
						   'hide_empty' => 0,
						   'parent' => $arr_optioncat->slug,
						   'taxonomy' => 'product_cat'
						);
						$wsubcats = get_categories($wsubargs);
						foreach ($wsubcats as $wsc):
						?>
							<li><a href="<?php echo get_permalink( get_the_ID() ) . '?optioncat=' . $arr_optioncat->slug ;?>"><?php echo $arr_optioncat->name ;?></a></li>
						<?php
						endforeach;
						?>  
						</ul>
				
					</li>
				</ul>
			<?php 
				endforeach; 
			?>
		</div>
	<div class="clearfix"></div>
	</nav>
	

