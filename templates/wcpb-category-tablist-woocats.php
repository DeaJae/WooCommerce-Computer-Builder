<?php
/**
 * WooCommerce Product Builder Tablist Template
 * @author Philipp Bauer <philipp.bauer@vividdesign.de> | modified by Darren Jermy (www.littleportitservices.co.uk)
 * Tablist using Woocommerce categories without creating DB entries in WCPB
 * @version 0.9.1
 * @author Philipp Bauer <philipp.bauer@vividdesign.de>
 * @version 0.9
 */
global $wcpb;

?>

<nav class="wcpb-category-tablist">
<div class="menu-categs-box">	
			<?php $arr_optioncats = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC',  'parent' => 90)); //, 'exclude' => '1,2,3'
				foreach($arr_optioncats as $arr_optioncat) : 
					#$wthumbnail_id = get_woocommerce_term_meta( $wcatTerm->term_id, 'thumbnail_id', true );
					#$wimage = wp_get_attachment_url( $wthumbnail_id ); //Stuff for image on category menu item.. Not needed but left for a possible icon method.
				?>
				
				<ul>
					<!--<li class="libreak"><php if($wimage!=""):?><img src="<php echo $wimage?>"><php endif;?></li> // Again for cat images-->
					<li>
						
						 
	   <a <?php {if ($_GET['optioncat'] == $arr_optioncat->slug)
        echo 'class="active"' ;}?> href="<?php echo get_permalink($arr_optioncat->slug, $arr_optioncat->taxonomy ) . '?optioncat=' . $arr_optioncat->slug; ?>"><?php echo $arr_optioncat->name;?> </a>
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
							<li><a href="<?php echo get_permalink($wsc->slug, $wsc->taxonomy )  . '?optioncat=' . $wsc->slug ;?>"><?php echo $wsc->name ;?></a></li>
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
	

