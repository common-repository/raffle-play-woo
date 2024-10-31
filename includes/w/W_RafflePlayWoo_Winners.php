<?php

namespace W_RafflePlayWoo_Winners;

include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/RafflePlayWoo_Includes.php');

if( ! defined('ABSPATH') )
    die('No Access to this page');

use RafflePlayWoo_Includes\RafflePlayWoo_Includes as RafflePlayWoo_Includes;

class W_RafflePlayWoo_Winners{
    
    public static function drp_WinnersPage( $settings ){
        RafflePlayWoo_Includes::rpwoo_loading_screen();     
    ?>     
        <div class='wrap'>
            <div class="container-fluid bmp-set-row">
                <div>                 
                    <div>
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <a class="navbar-brand" href="#"></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav" style="font-size: 1.2em;">
                                    <a class="nav-item nav-link active text-primary btn-add" href="#">  <i class="fa fa-plus-square"></i>   </a>
                                    <a class="nav-item nav-link text-primary btn-delete" href="#"> <i class="fa fa-trash-alt"></i> </a>
                                  
                                </div>
                                <?php RafflePlayWoo_Includes:: rpwoo_premium_image(); ?>
                            </div>
                            <?php RafflePlayWoo_Includes:: rpwoo_premium_link(); ?>
                        </nav>
                       
                    </div>
                    <table class='table table-striped' id='raffle_winners_table'>
                    </table>

                </div>
            </div> <!-- /container-fluid -->
        </div> <!-- /wrap -->
        
          <!-- Modal -->
        <div class="modal" id="modalSaveEdit"  tabindex="-1" role="dialog" >
            <div class="modal-dialog" style='margin-top: 80px !important;'>
            <div class="modal-content ">
                <div class='modal-headline'></div>

                <div class="modal-header">
                    <h4 class="modal-title"><?php esc_html_e('Winner', 'raffle-play-woo');?> </h4>
                        <button type="button" class="close modal-close-btn" id='modal_close_btn' data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                

                <div class="modal-body">

                    <div class="row bmp-set-row">
                        <div class="col-sm-5">
                            <b> <?php esc_html_e('Prize', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-7">    
                            <input type="text" name="" id="prize_name" placeholder="<?php esc_html_e('Prize Name', 'raffle-play-woo');?>">                           
                        </div>
                    </div>


                    <p></p>

                    <div class="row bmp-set-row">
                        <div class="col-sm-5">
                            <b> <?php esc_html_e('Ticket', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-7">    
                            <input type="number" min='1' name="" id="ticket_no" placeholder="<?php esc_html_e('Ticket Number', 'raffle-play-woo' );?>">                           
                        </div>
                    </div>

                    <p></p>

                    <div class="row bmp-set-row">
                        <div class="col-sm-5">
                            <b> <?php esc_html_e('Extra Info', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-7">    
                            <textarea name="" id="extra_info" cols="20" rows="10" placeholder="<?php esc_html_e('Maximum 200 characters', 'raffle-play-woo');?>"></textarea>                       
                        </div>
                    </div>                 

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="" value='-1' id='modal_action'>
                    <?php wp_nonce_field( 'nonce_field_form_rpr', 'nonce_field_form_rpr' ); ?>
                    <button type="button" class="button button-default" data-dismiss="modal" > <?php esc_html_e('Cancel', 'raffle-play-woo');?> </button>
                    <button type="button" class="button button-primary" id="btnSave"><?php esc_html_e('Save', 'raffle-play-woo');?> </button>                                                 
                </div>

              

            </div><!-- /.modal-content -->
            
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->        


      <?php  
    }
}