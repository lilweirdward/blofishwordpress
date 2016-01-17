<?php
/**
 * Product loop title
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<h3><?php the_title(); ?></h3>
<h4>$<?php echo money_format('%.2n', esc_attr( $product->get_price() )); ?></h3>
