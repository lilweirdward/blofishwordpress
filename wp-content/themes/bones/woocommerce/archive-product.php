<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
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

    <?php
        if ( ! is_shop() )
        { ?>

    <div class="section side">

        <!-- <div class="wrap">

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
                            <span <?php if ( is_product_category( $category->slug ) ) { echo 'class="bold"'; } ?>><?php echo $category->name; ?></span>
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

            <p>
                For us at BLoFISH Clothing, "All for All" isn't just our slogan, it is our lifestyle, one we live and breathe every moment. Share your story, and share the message: #A4A
            </p>

        </div> -->

		<?php //do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				//do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif;

        get_template_part( 'footerbar' ); ?>

    </div>

	<?php } ?>

<?php get_footer( 'shop' ); ?>
