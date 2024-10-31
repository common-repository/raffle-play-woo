<?php

namespace W_RafflePlayWoo_Logs;

if( ! defined('ABSPATH')) exit;

include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/RafflePlayWoo_Includes.php');
use RafflePlayWoo_Includes\RafflePlayWoo_Includes as RafflePlayWoo_Includes;

class W_RafflePlayWoo_Logs{

    public static function drp_LogsPage( $data ){

        RafflePlayWoo_Includes::rpwoo_loading_screen();

    ?>     
        <script>
      
            const   rpwoo_url           = "<?php echo esc_url(RAFFLE_PLAY_WOO_URL) . '/';?>";          
            const   rpwoo_admin_url     = "<?php echo get_admin_url(); ?>";

        </script>

        <?php wp_nonce_field( 'nonce_field_form_rpr', 'nonce_field_form_rpr' ); ?>

        <div class='wrap logs-page'>

            <div class="container-fluid" 
                ref='main_container'>
                <div class="bmp-set-row">

                    <h3 class='h4'> <?php esc_html_e('Logs Info', 'raffle-play-woo'); ?> </h3>


                    <div class='content-lucky'>


                        <div class="row">

                            <div class="col-md-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" 
                                role="tablist" aria-orientation="vertical">
                                    <a href="#v-pills-logfile" class='nav-link' id='v-pills-logfile-tab' data-toggle="pill" aria-selected='false'>
                                        <?php esc_html_e('Raffle Log File', 'raffle-play-woo'); ?>
                                    </a>
                                    
                                </div>
                            </div>

                            <div class="col-md-9">

                                <div class="tab-content" id="v-pills-tabContent">


                                    <div class='tab-pane fade show active' id='v-pills-logfile' role='tabpanel' style='width:100%; height:100%;' aria-labelledby="'v-pills-logfile-tab'"> 
                                        <p>
                                            <?php esc_html_e('In wp_config.php add the following code to enable debugging', 'raffle-play-woo'); ?><br/>

                                            <code>
                                                define( 'WP_DEBUG', true ); <br/>
                                                define( 'WP_DEBUG_LOG', true ); <br/>
                                                define( 'WP_DEBUG_DISPLAY', false );
                                            </code>
                                        </p>
                                        <p>
                                            <?php esc_html_e('Raffle debug file (different than debug.log from wordpress)', 'raffle-play-woo'); ?> </br>
                                            (last 30k characters)
                                        </p>
                                        <textarea style='width:100%; height:100%;' rows='18' name="" id="" readonly > <?php echo str_replace('new_line', '&#13;&#10',  $data['logfilecontent'] ); ?></textarea>

                                        <p>Debug.log (last 30k characters)</p>
                                        <textarea style='width:100%; height:100%;' rows='18' name="" id="" readonly ><?php echo str_replace('new_line', '&#13;&#10', $data['debug_log_content'] ); ?></textarea>

                                    </div>
                                    
                                </div>
                            </div>

                        </div>

                    </div>

                </div>



            </div> <!-- /container-fluid -->
        </div> <!-- /wrap -->

      <?php  
    
    }
}