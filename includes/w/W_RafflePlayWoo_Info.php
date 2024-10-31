<?php
namespace W_RafflePlayWoo_Info;

if( ! defined('ABSPATH') )
    die('No Access to this page');
   
class W_RafflePlayWoo_Info{

    public static function drp_InfoPage( $settings ){             
        ?>     
        <div class='wrap'>
            <div class="container-fluid">           
            
                <div class="row bmp-set-row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                            <a class="nav-link active"  id="v-pills-install-tab" data-toggle="pill" href="#v-pills-install" role="tab" aria-controls="v-pills-install" aria-selected="false">
                                <?php esc_html_e('Doc - Installation',  'raffle-play-woo' ); ?>
                            </a>

                            <a class="nav-link" id="v-pills-default-tab" data-toggle="pill" href="#v-pills-default" role="tab" aria-controls="v-pills-default" aria-selected="false">
                                <?php esc_html_e('Doc - Default Raffle Setup',  'raffle-play-woo' ); ?>
                            </a>

                            <a class="nav-link" id="v-pills-raffles-tab" data-toggle="pill" href="#v-pills-raffles" role="tab" aria-controls="v-pills-raffles" aria-selected="false">
                                <?php esc_html_e('Doc - Raffles Setup',  'raffle-play-woo' ); ?>
                            </a>

                            <a class="nav-link" id="v-pills-winners-tab" data-toggle="pill" href="#v-pills-winners" role="tab" aria-controls="v-pills-winners" aria-selected="false">
                                <?php esc_html_e('Doc - Winners Page',  'raffle-play-woo' ); ?>
                            </a>

                            <a class="nav-link" id="v-pills-reports-tab" data-toggle="pill" href="#v-pills-reports" role="tab" aria-controls="v-pills-reports" aria-selected="false">
                                <?php esc_html_e('Doc - Reports Page',  'raffle-play-woo' ); ?>
                            </a>

                            <a class="nav-link" id="v-pills-pdf-tab" data-toggle="pill" href="#v-pills-pdf" role="tab" aria-controls="v-pills-pdf" aria-selected="false">
                                <?php esc_html_e('Doc - Email PDF Attachment',  'raffle-play-woo' ); ?>
                            </a>

                        </div>
                    </div>

                    <div class="col-9">

                        <div class="tab-content div-container-right" id="v-pills-tabContent">                                       

                            <!-- Installation tab -->
                            <div class="tab-pane active fade show " id="v-pills-install" role="tabpanel" aria-labelledby="v-pills-install-tab">     
                                <?php
                                    include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/docs/RafflePlayWoo_Docs_Installation.php');
                                ?>
                            </div>

                            <!-- Default Raffle Setup tab -->
                            <div class="tab-pane fade show " id="v-pills-default" role="tabpanel" aria-labelledby="v-pills-default-tab">     
                                <?php
                                    include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/docs/RafflePlayWoo_Docs_DefaultRaffle.php');
                                ?>
                            </div>

                            <!-- Raffles Setup tab -->
                            <div class="tab-pane fade show " id="v-pills-raffles" role="tabpanel" aria-labelledby="v-pills-raffles-tab">     
                                <?php
                                    include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/docs/RafflePlayWoo_Docs_RafflesSetup.php');
                                ?>
                            </div>

                            <!-- Winners tab -->
                            <div class="tab-pane fade show" id="v-pills-winners" role="tabpanel" aria-labelledby="v-pills-winners-tab">     
                                <?php
                                    include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/docs/RafflePlayWoo_Docs_Winners.php');
                                ?>
                            </div>     

                             <!-- Reports tab -->
                            <div class="tab-pane fade show" id="v-pills-reports" role="tabpanel" aria-labelledby="v-pills-reports-tab">     
                                <?php
                                    include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/docs/RafflePlayWoo_Docs_Reports.php');
                                ?>
                            </div>   
                            
                            <!-- PDF Attachment tab -->
                            <div class="tab-pane fade show" id="v-pills-pdf" role="tabpanel" aria-labelledby="v-pills-pdf-tab">     
                                <?php
                                    include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/docs/RafflePlayWoo_Docs_Pdf_Attachment.php');
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