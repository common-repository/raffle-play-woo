<?php
/*
* Plugin Name: Raffle Play Woo
* Plugin URI: https://tuskcode.com
* Version: 2.4.1
* Author: dan009
* Description: Raffle Play Woo is the next raffle plugin for your website. It offers a complete workflow of managing raffle tickets from the admin view to the user experience.
* Text Domain: raffle-play-woo
* License: GPLv3
*/

if( ! defined('ABSPATH') )
    die('No Access to this page');

$RafflePlayWoo_MinimalRequiredPhpVersion = '5.2';
if( ! defined('RAFFLE_PLAY_WOO_VERSION')) define('RAFFLE_PLAY_WOO_VERSION', '2.4.1');
if( ! defined('RAFFLE_PLAY_WOO_WP_TESTED')) define('RAFFLE_PLAY_WOO_WP_TESTED', '6.6');
if( ! defined('RAFFLE_PLAY_WOO_URL')) define( 'RAFFLE_PLAY_WOO_URL', esc_url( plugins_url( '', __FILE__ ) ) );
if( ! defined('RAFFLE_PLAY_WOO_DIR_PATH') ) define('RAFFLE_PLAY_WOO_DIR_PATH', plugin_dir_path( __FILE__ ));
if( ! defined('RAFFLE_PLAY_WOO_LOG_FILE')) define( 'RAFFLE_PLAY_WOO_LOG_FILE', RAFFLE_PLAY_WOO_DIR_PATH . 'logs/RafflePlayWoo_error.log' );

/* Check the php version, and display a message if the running version is lower than the required on */

function RafflePlayWoo_noticePhpVersionWrong(){
    global $RafflePlayWoo_MinimalRequiredPhpVersion;
    echo '<div class="updated fade">' .
        esc_html__( 'Error: plugin "Raffle Play" requires a higher version of PHP to be running.', 'raffle-play-woo' ).
        '<br/>' . esc_html__('Minimal version of PHP required: ', 'raffle-play-woo' ) . '<strong>' . $RafflePlayWoo_MinimalRequiredPhpVersion . '</strong>'.
        '<br/>' . esc_html__('Your server\'s PHP version: ', 'raffle-play-woo' ) . '<strong>' . phpversion() . '</strong></div>';
}

function RafflePlayWoo_RaffleNotLicensed(){
    echo '<div class="notice notice-error is-dismissible"><strong>' .
    esc_html__( 'Raffle Play Woo', 'raffle-play-woo' ). '<br/>' .
    esc_html__( 'The plugin is not licensed', 'raffle-play-woo' ) .' </strong></div>';
}

function RafflePlayWoo_NoticeWoocommerceNotInstalled(){   
    echo '<div class="notice notice-error is-dismissible"><strong>' .
        esc_html__( 'Raffle Play Woo', 'raffle-play-woo' ). '<br/>' .
        esc_html__( ' WooCommerce is not installed/active', 'raffle-play-woo' ) .' </strong></div>';
}

function RafflePlayWoo_InvalidLicense(){
    echo '<div class="notice notice-warning is-dismissible"><p><strong>' .
    esc_html__( 'Raffle Play Woo', 'raffle-play-woo' ). ' - ' .
    esc_html__( 'Your license is not valid', 'raffle-play-woo' ) .' </strong></p></div>';  
}

function RafflePlayWoo_error_log( $message ){
    error_log( date( 'Y-m-d H:i:s' ) . ' - ' . esc_html( $message ) . PHP_EOL, 3, RAFFLE_PLAY_WOO_LOG_FILE, 3 );
}

function RafflePlayWoo_PhpVersionCheck(){
    global $RafflePlayWoo_MinimalRequiredPhpVersion;
    if( version_compare(phpversion(), $RafflePlayWoo_MinimalRequiredPhpVersion ) < 0 ){
        add_action('admin_notices', 'RafflePlayWoo_noticePhpVersionWrong');
        return false;
    }
    return true;
}

function RafflePlayWoo_WoocommerceInstalled(){
    $result = false;
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

    if ( is_plugin_active('woocommerce/woocommerce.php') ) 
        $result = true;
    else
        add_action('admin_notices', 'RafflePlayWoo_NoticeWoocommerceNotInstalled'); 

    return $result;
} 

function RafflePlayWoo_i18n_init(){
    $pluginDir = dirname( plugin_basename(__FILE__) );
    load_plugin_textdomain( 'raffle-play-woo' , false, $pluginDir . '/languages/');
}

if( RafflePlayWoo_PhpVersionCheck() && RafflePlayWoo_WoocommerceInstalled()  ){    
    include_once( 'raffle-play-woo_init.php');     
    RafflePlayWoo_init\RafflePlayWoo_init::RafflePlayWoo_init_plugin( __FILE__ );
}

add_action( 'init', 'RafflePlayWoo_i18n_init');    