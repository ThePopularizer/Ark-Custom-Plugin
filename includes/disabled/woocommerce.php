<?php

if (!defined('WC_VERSION')) {
  return;
}

/**
 * Add "Print receipt" link to Order Received page and View Order page
 */
function isa_woo_thankyou() {
    echo '<a href="javascript:window.print()" id="print-button">Print receipt</a>';
}
add_action( 'woocommerce_thankyou', 'isa_woo_thankyou', 1);
add_action( 'woocommerce_view_order', 'isa_woo_thankyou', 8 );

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );
function woo_add_custom_general_fields() {
  global $woocommerce, $post;
  echo '<div class="options_group">';
  woocommerce_wp_text_input(
      array(
      	'id'          => '_supplier_text',
      	'label'       => __( 'Supplier', 'woocommerce' ),
      	'placeholder' => '',
      	'desc_tip'    => 'true',
      	'description' => __( 'Enter the name of the supplier here.', 'woocommerce' )
      )
   );
   woocommerce_wp_text_input(
      array(
          'id'          => '_supplier_code',
          'label'       => __( 'Supplier Code', 'woocommerce' ),
          'placeholder' => '',
          'desc_tip'    => 'true',
          'description' => __( 'Enter the supplier code here.', 'woocommerce' )
      )
    );
   woocommerce_wp_text_input(
      array(
         'id'                => '_supplier_cost',
         'label'             => __( 'Original Cost', 'woocommerce' ),
         'placeholder'       => '',
         'desc_tip'          => 'true',
         'description'       => __( 'Enter original cost here.', 'woocommerce' ),
         'type'              => 'number',
         'custom_attributes' => array(
               'step' 	=> '0.01',
               'min'	=> '0'
               )
      )
   );
  echo '</div>';
}

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );
function woo_add_custom_general_fields_save( $post_id ){

	// Text Field
	$woocommerce_text_field = $_POST['_supplier_text'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_supplier_text', esc_attr( $woocommerce_text_field ) );
   $woocommerce_text_field = $_POST['_supplier_code'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_supplier_code', esc_attr( $woocommerce_text_field ) );

	// Number Field
	$woocommerce_number_field = $_POST['_supplier_cost'];
	if( !empty( $woocommerce_number_field ) )
		update_post_meta( $post_id, '_supplier_cost', esc_attr( $woocommerce_number_field ) );
}


// remove_action( 'woocommerce_single_product_summary',
// 'woocommerce_template_single_excerpt', 20);

// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 999 );

add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
   if (is_checkout()) {
     switch( $currency ) {
        case 'NZD': $currency_symbol = 'NZ $'; break;
     }
     return $currency_symbol;
  } else {
     switch( $currency ) {
        case 'NZD': $currency_symbol = '$'; break;
     }
     return $currency_symbol;
  }
}

// Sales Badge Percentage

add_filter('woocommerce_sale_flash', 'tp_woo_savings_on_sales_flash');
function tp_woo_savings_on_sales_flash()
{
  global $post, $product;
	if ( ! $product->is_in_stock() ) return;
	$sale_price = get_post_meta( $product->id, '_price', true);
	$regular_price = get_post_meta( $product->id, '_regular_price', true);
  $prepend = '';
	if (empty($regular_price)){ //then this is a variable product
		$available_variations = $product->get_available_variations();
		$variation_id=$available_variations[0]['variation_id'];
		$variation= new WC_Product_Variation( $variation_id );
		$regular_price = $variation ->regular_price;
		$sale_price = $variation ->sale_price;
    $prepend = 'Up to ';
	}

	$savings = ceil(( ($regular_price - $sale_price) / $regular_price ) * 100);
  $saveamount = number_format((float)($regular_price - $sale_price), 2, '.', '');
  $sale_flash = '<span class="onsale"><span class="save-percentage">';
  if ( !$product->is_type( 'variable' )) {
    $sale_flash .= $prepend . $savings . '% OFF';
  }
  $sale_flash .= '</span><span class="save-amount">Save ';
  if ( $product->is_type( 'variable' )) {
    $sale_flash .= 'up to ';
  }
  $sale_flash .= '$' . $saveamount . '!</span></span>';
	return $sale_flash;
}

// add_action( 'woocommerce_after_single_product', 'custom_woocommerce_before_add_to_cart_form',0 );

// function custom_woocommerce_after_add_to_cart_form( $desc ){
// global $product;
//
// if ( is_single( $product->id ) )
//    echo '<a data-toggle="tooltip" data-placement="right" title="Buy Now, Pay Later" class="finance-link btn btn-link" href="/finance/" target="_blank"><i class="fa fa-money"></i> Finance</a><br/><br/>';
// return $desc;
// }
// add_action( 'woocommerce_after_add_to_cart_button', 'custom_woocommerce_after_add_to_cart_form',0,1 );

/* Remove Page Titles */

add_filter('woocommerce_show_page_title',false);
