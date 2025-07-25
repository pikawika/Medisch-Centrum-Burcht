<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

$single_type = bridge_qode_woocommerce_single_type();
$tabs_position_class = 'left';
if ( $single_type == 'tabs-on-bottom' ) {
	$tabs_position_class = 'center';
}

if ( ! empty( $product_tabs ) ) : ?>
	<?php if ( $single_type != '' ) { ?>
		<div class="q_tabs horizontal <?php echo esc_attr( $tabs_position_class ); ?>">
			<ul class="tabs-nav">
				<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
					<li role="presentation" class="<?php echo esc_attr( $key ); ?>_tab">
						<a href="#tab-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $product_tab['title'] ), $key ); ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="tabs-container">
				<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
					<div class="tab-content" id="tab-<?php echo esc_attr( $key ); ?>">
						<?php call_user_func( $product_tab['callback'], $key, $product_tab ); ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php } else { ?>

		<div class="q_accordion_holder toggle boxed woocommerce-accordion">
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>

				<h6 class="title-holder clearfix <?php echo esc_attr($key) ?>_tab">
					<span class="tab-title"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $product_tab['title'] ), $key ); ?></span>
				</h6>
				<div class="accordion_content">
					<div class="accordion_content_inner">
						<?php call_user_func( $product_tab['callback'], $key, $product_tab ) ?>
					</div>
				</div>

			<?php endforeach; ?>

            <?php do_action( 'woocommerce_product_after_tabs' ); ?>
		</div>

	<?php } ?>

<?php endif; ?>