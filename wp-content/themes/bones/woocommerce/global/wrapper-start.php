<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="categories <?php if ( ! is_shop() ) { echo 'side'; } else { echo 'scene_element scene_element--fadeinright'; } ?>">
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

                <div class="<?php echo $category->slug; if ( is_product_category( $category->slug ) || has_term( $category->slug, 'product_cat') ) { echo ' active'; } ?>">

                    <h1><?php echo $category->name; ?></h1>
                    <?php
                        if ( $category->slug == 'top' ) { ?>
                            <i class="fa fa-long-arrow-up fa-4x"></i>
                    <?php
                        } elseif ( $category->slug == 'mid' ) { ?>
                            <i class="fa fa-arrows-h fa-4x"></i>
                    <?php
                } elseif ( $category->slug == 'low' ) { ?>
                            <i class="fa fa-long-arrow-down fa-4x"></i>
                    <?php } ?>

                </div>

            </a>

        <?php } ?>

</div>
