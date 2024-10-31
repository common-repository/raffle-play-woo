<?php
namespace W_RafflePlayWoo_AuditPage;

include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/RafflePlayWoo_Includes.php');

if( ! defined('ABSPATH') )
    die('No Access to this page');

class W_RafflePlayWoo_AuditPage{

    public static function drp_AuditPage( $settings ){
      
      ?>
        
        <div class='wrap'>
            <div class="container-fluid">
                <div class="panel panel-default bmp-pins-new-panel">
                    <div class="panel-heading">                  
                        <h3> <?php esc_html_e('Audit Info', 'raffle-play-woo');?></h3>                  
                    </div>

                    <div class="panel-body">
                        <div class='row bmp-set-row' >
 
                         </div>

                         <div class='row bmp-set-row' >

                         </div>
                    
                    </div> 

                </div> 

            </div> <!-- /container-fluid -->
        </div> <!-- /wrap -->

      <?php  
    }
}