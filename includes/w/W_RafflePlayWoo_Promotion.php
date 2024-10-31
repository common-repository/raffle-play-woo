<?php

namespace W_RafflePlayWoo_Promotion;

if( ! defined('ABSPATH')) exit;

include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/RafflePlayWoo_Includes.php');

use RafflePlayWoo_Includes\RafflePlayWoo_Includes as RafflePlayWoo_Includes;

class W_RafflePlayWoo_Promotion{

    public static function drp_promotionPage( $data ){

     
    ?> 
    
        <script>
            var rpwoo_data        = <?php echo $data['data'];?>;  
            var rpwoo_raffles     = <?php echo wp_json_encode( $data['raffles'] );?>;       
            const rpwoo_symbol    = "<?php echo $data['currency']; ?>";
            const raffle_icon     = "<?php echo esc_url( $data['raffle_icon']);?>";
            const categories      = <?php echo wp_json_encode( $data['categories'] );?>;  
        </script>


        

        <div class='wrap promotion-page'>

            <div class="container-fluid" 
                ref='main_container' >
                <div class="bmp-set-row">
                   
                        <h3 class='h3'>
                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                <?php esc_html_e('Only Available in Premium Version', 'raffle-play-woo'); ?> 
                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                        </h3>
                  
                    <h3 class='h4'> <?php esc_html_e('Promotional Raffle', 'raffle-play-woo'); ?> </h3>
                    <p style='font-size: .85rem;'> 
                        <i> 
                            <?php esc_html_e('Create a promotional raffle with free tickets to boost your sales on your shop.', 'raffle-play-woo'); ?> 
                        </i> 
                    </p>
                    <p style='font-size: .85rem; margin-top: -7px;'> 
                        <i>
                            <?php esc_html_e('Reward customers with free raffle tickets for each purchase they make based on the amount at the checkout', 'raffle-play-woo'); ?> 
                        </i> 
                    </p>

                    <p style='font-size: .85rem; margin-top: -7px;'> 
                        <i>
                            <?php esc_html_e('Promotions can also be set based on products bought from specific category. See video for more.', 'raffle-play-woo'); ?> 
                        </i> 
                    </p>

                    <p style='font-size: .9rem; margin-top: -7px; font-weight: 600;'> 
                        <i>
                            <a href="https://youtu.be/QeSFjQ2zKvo" target='_blank'>
                                <?php esc_html_e('Watch promotional raffle setup video here', 'raffle-play-woo'); ?> 
                            </a>
                        </i> 
                    </p>


                    <div>
                        <h5>
                            <?php esc_html_e('Demo Image - Admin setup', 'raffle-play-woo');?>
                        </h5>
                        <img class='img-fluid' src="<?php echo RAFFLE_PLAY_WOO_URL . '/images/demo-promotion-image.png'; ?>" alt="">
                    </div>

                </div>




            </div> <!-- /container-fluid -->
        </div> <!-- /wrap -->

      <?php  
    
    }
}