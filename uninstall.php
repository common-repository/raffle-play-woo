<?php

include_once("includes/RafflePlayWoo_OptionsManager.php");

if ( ! defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

//disable for the moment
global $wpdb;

$rpwoo_options = new RafflePlayWoo_OptionsManager\RafflePlayWoo_OptionsManager();

$rpwoo_options->deleteOption('ticket_count_starts_at');
$rpwoo_options->deleteOption('last_ticket_no');
$rpwoo_options->deleteOption('last_order_no');
$rpwoo_options->deleteOption('started_orders'); 
$rpwoo_options->deleteOption('_installed');
$rpwoo_options->deleteOption('_version');
$rpwoo_options->deleteOption('live_raffle');
$rpwoo_options->deleteOption('last_debug_no');
$rpwoo_options->deleteOption('ticket_prefix');


$rpwoo_options->deleteOption('email_header'); 
$rpwoo_options->deleteOption('email_body'); 
$rpwoo_options->deleteOption('email_pos'); 

$rpwoo_options->deleteOption('limit_tickets'); 
$rpwoo_options->deleteOption('limit_tickets_no');
$rpwoo_options->deleteOption('filter_status_view'); 

$rpwoo_options->deleteOption('tables_created'); 
$rpwoo_options->deleteOption('terminated'); 

$rpwoo_options->deleteOption('new_version');
$rpwoo_options->deleteOption('last_version_check');

$rpwoo_options->deleteOption('raffle_name');
$rpwoo_options->deleteOption('inc_name');

$rpwoo_options->deleteOption('limit_order_per_raffle');
$rpwoo_options->deleteOption('limit_order_per_raffle_txt');

$rpwoo_options->deleteOption('custom_cols');
$rpwoo_options->deleteOption('custom_cols_ava');

$rpwoo_options->deleteOption('ticket_image_raffles');

$rpwoo_options->deleteOption('acc_tab_raffle');
$rpwoo_options->deleteOption('check_duplicates');
$rpwoo_options->deleteOption('show_orders_table');

$rpwoo_options->deleteOption('gen_checkout');

$rpwoo_options->deleteOption('gen_checkout_set');

$rpwoo_options->deleteOption('raffle_gen_checkout');

$rpwoo_options->deleteOption('order_status_gen_tickets');

$rpwoo_main_tbl     = $wpdb->prefix . strtolower( $rpwoo_options->prefix( 'main' ) );
$rpwoo_main_tbl_bk  = $wpdb->prefix . strtolower( $rpwoo_options->prefix( 'main_bk') );
$rpwoo_audit_tbl    = $wpdb->prefix . strtolower( $rpwoo_options->prefix( 'audit' ) );
$rpwoo_raffle_tbl   = $wpdb->prefix . strtolower( $rpwoo_options->prefix( 'raffle' ) );
$rpwoo_products_tbl = $wpdb->prefix . strtolower( $rpwoo_options->prefix( 'product' ) );
$rpwoo_winners_tbl  = $wpdb->prefix . strtolower( $rpwoo_options->prefix( 'winners' ) );

try {

	$rpwoo_ckb              = '_rpwoo_ckb';
    $rpwoo_var_prod         = '_rpwoo_var_prod';
    $rpwoo_ticket_no        = '_rpwoo_ticket_no';
    $rpwoo_raffle_type      = '_rpwoo_raffle_type';
   
	
	$query = $wpdb->get_results( "SELECT product_id from $rpwoo_products_tbl;");
	foreach( $query as $item ){
		$product_id = intval( $item->product_id );
		delete_post_meta( $product_id, $rpwoo_ckb );
		delete_post_meta( $product_id, $rpwoo_var_prod );
		delete_post_meta( $product_id, $rpwoo_ticket_no );
		delete_post_meta( $product_id, $rpwoo_raffle_type );		          
	}
} catch (\Throwable $th) {
	RafflePlayWoo_error_log( $th->getMessage() );
}

try{	
	
	$wpdb->query( $wpdb->prepare("DROP TABLE IF EXISTS %i", $rpwoo_main_tbl ) );

	$wpdb->query( $wpdb->prepare("DROP TABLE IF EXISTS %i", $rpwoo_main_tbl_bk ));

	$wpdb->query( $wpdb->prepare("DROP TABLE IF EXISTS %i", $rpwoo_audit_tbl ) );

	$wpdb->query( $wpdb->prepare("DROP TABLE IF EXISTS %i", $rpwoo_raffle_tbl ) );

	$wpdb->query( $wpdb->prepare("DROP TABLE IF EXISTS %i", $rpwoo_products_tbl ) );

	$wpdb->query( $wpdb->prepare("DROP TABLE IF EXISTS %i", $rpwoo_winners_tbl ) );

}catch( Exception $d ){
    RafflePlayWoo_error_log( $d->getMessage() );
}
