<?php

namespace W_RafflePlayWoo_Lucky;

if( ! defined('ABSPATH')) exit;

include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/RafflePlayWoo_Includes.php');
use RafflePlayWoo_Includes\RafflePlayWoo_Includes as RafflePlayWoo_Includes;

class W_RafflePlayWoo_Lucky{

    public static function drp_luckyPage( $data ){

?>

        <style>
            .lbl-ava-ticket{
                min-width: 80px;
                cursor: pointer;
            }

            .tooltip_div {
                position: relative;
                display: inline-block;            
            }

            .tooltip_div .tooltiptext {
                visibility: hidden;
                min-width: 120px;
                padding: 5px;
                background-color: #555;
                color: #fff;
                text-align: center;
                border-radius: 6px;
                padding: 5px 0;
                position: absolute;
                z-index: 1;
                bottom: 125%;
                left: 50%;
                margin-left: -60px;
                opacity: 0;
                transition: opacity 0.3s;
            }

            .tooltip_div .tooltiptext::after {
                content: "";
                position: absolute;
                top: 100%;
                left: 50%;
                margin-left: -5px;
                border-width: 5px;
                border-style: solid;
                border-color: #555 transparent transparent transparent;
            }

            .tooltip_div:hover .tooltiptext {
                visibility: visible;
                opacity: 1;
            }
        </style>


        <?php wp_nonce_field( 'nonce_field_form_rpr', 'nonce_field_form_rpr' ); ?>

        <div class='wrap lucky-page'>

            <div class="container-fluid" 
                ref='main_container'>
                <div class="bmp-set-row">

                   
                    <h3 class='h3'>
                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>  
                            <?php esc_html_e('Only Available in Premium Version', 'raffle-play-woo'); ?> 
                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                    </h3> 
                    

                    <h3 class='h4'> <?php esc_html_e('Lucky Numbers (Instant Wins)', 'raffle-play-woo'); ?> </h3>

                    

                    <p style='font-size: .85rem;'> 
                        <i> 
                            <?php esc_html_e('While running a raffle reward your customers with smaller prizes as instant wins', 'raffle-play-woo'); ?> 
                        </i> 
                    </p>

                    <p style='font-size: .85rem; margin-top: -7px;'> 
                        <i>
                            <?php esc_html_e('You can define a winning number or let the system pick one. It only works with Random Tickets', 'raffle-play-woo'); ?> 
                        </i> 
                    </p>

                    <p style='font-size: .9rem; margin-top: -7px; font-weight: 600;'> 
                        <i>
                            <a href="https://youtu.be/Ypyw8KzWyd4" target='_blank'>
                                <?php esc_html_e('Watch setup video here', 'raffle-play-woo'); ?> 
                            </a>
                        </i> 
                    </p>

                    <div class='content-lucky row'>

                        <div class='col-lg-12 col-md-12 col-sm-12'>
                            <h5><?php esc_html_e('Demo Image - Admin setup', 'raffle-play-woo');?></h5>
                            <img style='max-width: 80%;' class='img-fluid' src="<?php echo RAFFLE_PLAY_WOO_URL . '/images/demo-lucky-image.png'; ?>" alt="">
                        </div>

                        <div class='col-lg-12 col-md-12 col-sm-12'>
                            <h5><?php esc_html_e('Demo Image - Display Image with Shortcode', 'raffle-play-woo');?></h5>
                            <img  class='img-fluid' src="<?php echo RAFFLE_PLAY_WOO_URL . '/images/demo-lucky-numbers-display.png'; ?>" alt="">
                        </div>

                    </div>

                </div>




                <!-- Modal -->

                <!-- /.modal -->   


            </div> <!-- /container-fluid -->
        </div> <!-- /wrap -->

      <?php  
    
    }
}