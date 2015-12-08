<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

    <div class="section side">

        <div class="wrap">

            <img class="header" src="<?php echo get_template_directory_uri(); ?>/library/images/words-logo.png" />

            <div class="mini-categories">

                <?php

                    $product_categories = get_categories( apply_filters( 'woocommerce_product_subcategories_args', array(
                        'menu_order'   => 'ASC',
                        'hide_empty'   => 0,
                        'hierarchical' => 1,
                        'taxonomy'     => 'product_cat',
                        'pad_counts'   => 1
                    ) ) );

                    foreach ( $product_categories as $category ) { ?>

                        <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
                            <span <?php if ( is_product_category( $category->slug ) || has_term( $category->slug, 'product_cat') ) { echo 'class="bold"'; } ?>><?php echo $category->name; ?></span>
                        </a> |

                <?php }

                    $cart = WC()->session->get( 'cart', array() );
                    $actualCart = WC()->cart; ?>

                <span>
                    <a href="<?php $page = get_page_by_title('Cart'); echo get_page_link($page->ID); ?>">
                        <i class="fa fa-shopping-cart"></i> <?php echo $actualCart->get_cart_subtotal(); ?>
                    </a>
                </span>

            </div>

        </div>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

    	<?php
    		/**
    		 * woocommerce_after_main_content hook
    		 *
    		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
    		 */
    		do_action( 'woocommerce_after_main_content' );
    	?>

<?php get_footer( 'shop' ); ?>
