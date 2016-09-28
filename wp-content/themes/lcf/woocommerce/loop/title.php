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

?>
<h6 class="bold shop-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h6>
