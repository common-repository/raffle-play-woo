<?php
namespace W_RafflePlayWoo_Releases;

if( ! defined('ABSPATH') )
    die('No Access to this page');
   
class W_RafflePlayWoo_Releases{

    public static function drp_ReleasesPage( $settings = null ){             
        ?>     
        <div class='wrap'>
            <div class="container-fluid">           
                    <h3 class='h3'> <?php esc_html_e('Release Notes', 'raffle-play-woo'); ?></h3>
                <div class="row bmp-set-row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                            <li class="nav-item">
                                <a class="nav-link active"  id="v-pills-release221-tab" 
                                    data-toggle="pill" href="#v-pills-release221" role="tab" 
                                    aria-controls="v-pills-release221" aria-selected="false">
                                    <?php esc_html_e('Releases',  'raffle-play-woo' ); ?>
                                </a>
                            </li>

                        </div>
                    </div>

                    <div class="col-9">

                        <div class="tab-content div-container-right" id="v-pills-content">                                       

                            <!-- Installation tab -->

                            <div class="tab-pane fade active show" id="v-pills-release221" role="tabpanel"
                                aria-labelledby="v-pills-release221-tab">     

                                <?php
                                    include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/releases/RafflePlayWoo_Release_240.php');
                                ?>
                                
                                <?php
                                    include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/releases/RafflePlayWoo_Release_233.php');
                                ?>

                                <?php
                                    include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/releases/RafflePlayWoo_Release_232.php');
                                ?>

                                <?php
                                    include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/releases/RafflePlayWoo_Release_23.php');
                                ?>

                                <?php
                                    include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/releases/RafflePlayWoo_Release_221.php');
                                ?>

                                <?php
                                    include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/releases/RafflePlayWoo_Release_22.php');
                                ?>
                            </div>



                        </div>


                    </div>


                </div>

            </div> <!-- /container-fluid -->
        </div> <!-- /wrap -->
        
      <?php  
    }
}