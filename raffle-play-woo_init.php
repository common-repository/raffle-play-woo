<?php
namespace RafflePlayWoo_init;

require_once( 'includes/RafflePlayWoo_Plugin.php');

if( ! defined('ABSPATH') )
    die('No Access to this page');

use RafflePlayWoo_Plugin;

class RafflePlayWoo_init{

    public static function RafflePlayWoo_init_plugin( $file ){

        $rpwoo_aPlugin = new RafflePlayWoo_Plugin\RafflePlayWoo_Plugin();
        
        if( $rpwoo_aPlugin->getVersionSaved() != RAFFLE_PLAY_WOO_VERSION ){
            $rpwoo_aPlugin->setVersionSaved( RAFFLE_PLAY_WOO_VERSION );    
            $rpwoo_aPlugin->install();
    
        }else{
            $rpwoo_aPlugin->upgrade();      
        }
        
        $rpwoo_aPlugin->addActionsAndFilters();

        if( ! $file ){
            $file = __FILE__;
        }
    
        register_activation_hook( $file, array( &$rpwoo_aPlugin, 'activate') );

        register_deactivation_hook( $file, array( &$rpwoo_aPlugin, 'deactivate') );        
        
    }
}