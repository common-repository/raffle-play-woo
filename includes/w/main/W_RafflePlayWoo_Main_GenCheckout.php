<?php
include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/RafflePlayWoo_Includes.php');

if( ! defined('ABSPATH') )
    die('No Access to this page');

use RafflePlayWoo_Includes\RafflePlayWoo_Includes as RafflePlayWoo_Includes;

?>


<!-- progress bar-->
<div class="tab-pane fade" id="v-pills-gencheckout" role="tabpanel" aria-labelledby="v-pills-gencheckout-tab">                                 
    <h5>                                        
        <?php
            esc_html_e('Generated Raffle tickets at Checkout', 'raffle-play-woo');
        ?>
    </h5> 

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Reserved Time - Cycle', 'raffle-play-woo'); ?> 
            <?php esc_html_e('(Generated tickets need to have a time limit for each order at checkout)', 'raffle-play-woo'); ?> 
            <br/>

            <span style='font-size: .7rem'> 
                <i>
                    <?php esc_html_e('These tickets are counted as purchased because are reserved for the customer for a specific time', 'raffle-play-woo'); ?> 
                </i>
            </span>

            <span data-toggle='tooltip' 
                title="<?php esc_html_e('Reserved time for the raffle tickets at checkout', 'raffle-play-woo' ); ?>" > 
                <i class="fa fa-info-circle text-info"></i> 

            </span>

        </div>
    
        <div class="col-sm-7" >                               
            <input type="number" id="gen_c_set_time" min='1' style='max-width: 70px';
                value="<?php echo esc_html( $settings['gen_c_set']['time'] ); ?>"
            /> 
            <?php esc_html_e('minutes', 'raffle-play-woo'); ?>
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Show Countdown for Reserved time', 'raffle-play-woo'); ?>

            <span data-toggle='tooltip' 
                title="<?php esc_html_e('Reserved time for tickets at checkout, show countdown.', 'raffle-play-woo' ); ?>" > 
                <i class="fa fa-info-circle text-info"></i> 

            </span>
        </div>
    
        <div class="col-sm-7" >       
            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>
            <input type="checkbox" id="gen_c_set_countdown" 
                data-toggle='toggle' 
                data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                data-off="<?php esc_html_e('No', 'raffle-play-woo');?>"
                disabled
                data-size='small'/>
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Reserve time message', 'raffle-play-woo'); ?> (eg: Reserved for %d minutes)  <br />
            
            <i>
                *** %d  <?php esc_html_e(' will be swapped with the number above', 'raffle-play-woo');?> ***
            </i>
        
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="gen_c_set_countdown_lbl" style='width: 100%'
                value="<?php echo esc_html( $settings['gen_c_set']['countdown_lbl'] ); ?>"
            />           
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Message after reserved time has passed!', 'raffle-play-woo'); ?>  
            
            <br />

            <span style='font-size: 0.7rem;'>
                <i>
                    <?php esc_html_e('The customer can still buy the tickets, but will be generated at thank you page', 'raffle-play-woo'); ?>
                </i>
            </span>

            <br />

            <span style='font-size: 0.7rem;'>
                <i>
                    <?php esc_html_e('Tickets will not be visible at checkout anymore', 'raffle-play-woo'); ?>
                </i>
            </span>
        
        </div>
    
        <div class="col-sm-7" >                               
                <input type="text" name="" id="gen_c_msg_removed" style='width: 100%;'
                    value="<?php echo esc_html( $settings['gen_c_set']['msg_removed']);?>"
                />        
        </div>
    </div>





    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Location at Checkout (if checkout is created with shortcode [woocommerce_checkout])', 'raffle-play-woo'); ?>
        </div>
    
        <div class="col-sm-7" >                               
            <select name="" id="gen_c_set_location">
                <?php

                    $options_sel = array(
                        ''                                 => esc_html('Do not Show', 'raffle-play-woo'),
                        'woocommerce_before_checkout_form' => esc_html('Before Checkout form', 'raffle-play-woo'),
                        'woocommerce_before_checkout_billing_form' => esc_html('Before Checkout Billing form', 'raffle-play-woo'),
                        'woocommerce_after_checkout_billing_form' => esc_html('After Checkout Billing form', 'raffle-play-woo'),
                        'woocommerce_before_order_notes' => esc_html('Before Order Notes', 'raffle-play-woo'),
                        'woocommerce_checkout_after_customer_details' => esc_html('After Customer Details', 'raffle-play-woo'),
                        'woocommerce_checkout_before_order_review' => esc_html('Before Order Review', 'raffle-play-woo'),
                        'woocommerce_review_order_before_order_total' => esc_html('Before Order Total', 'raffle-play-woo'),
                        'woocommerce_review_order_after_order_total' => esc_html('After Order Total', 'raffle-play-woo'),
                        'woocommerce_review_order_after_payment' => esc_html('After Review Order Payment', 'raffle-play-woo'),
                    );

                    foreach( $options_sel as $hook => $desc ){
                        if( $hook == $settings['gen_c_set']['location'] ){
                            echo "<option selected value='$hook'> $desc </option>";
                        }else{
                            echo "<option value='$hook'> $desc </option>";
                        }
                    }
                
                ?>
            </select>
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Location at Checkout (if checkout is created using blocks)', 'raffle-play-woo'); ?>
        </div>
    
        <div class="col-sm-7" >                               
            <select name="" id="gen_c_set_location_block">
                <?php

                    $options_sel = array(
                        ''                                      => esc_html('Do not Show', 'raffle-play-woo'),
                        '.wc-block-components-panel__content'   => esc_html('After Products List', 'raffle-play-woo'),
                        '.wp-block-woocommerce-checkout-order-summary-block' => esc_html('After Total Section','raffle-play-woo'),
                        '.container .main_title'                => esc_html('After Checkout Title', 'raffle-play-woo')

                    );

                    foreach( $options_sel as $hook => $desc ){
                        if( $hook == $settings['gen_c_set']['location_block'] ){
                            echo "<option selected value='$hook'> $desc </option>";
                        }else{
                            echo "<option value='$hook'> $desc </option>";
                        }
                    }
                
                ?>
            </select>
        </div>
    </div>


    <div class='row bmp-set-row d-none' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Stop Reserving Tickets after the Time Cycles have passed', 'raffle-play-woo'); ?>
            
            <span data-toggle='tooltip' 
                title="<?php esc_html_e('After the reserved time has passed removed the reserved raffle products from the checkout. When raffle tickets are generated at checkout are reserved as purchased tickets', 'raffle-play-woo' ); ?>" > 
                <i class="fa fa-info-circle text-info"></i> 
            </span>

            <br />


        </div>
    
        <div class="col-sm-7" >                               
            <input type="checkbox" id="gen_c_set_remove_checkout" 
                data-toggle='toggle' 
                data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" 
                <?php if( $settings['gen_c_set']['remove_checkout'] == 'yes' ) echo 'checked'; ?> data-size='small'/>

            <p></p>

            <p>                             
                <input type="number" name="" style='max-width: 70px; display: inline-block;' min='1' 
                    class='form-control' id="gen_c_set_cycles"
                    value="<?php echo esc_html( $settings['gen_c_set']['cycles'] ); ?>"
                >

                <span >
                    <?php esc_html_e('After how many Reserved Time cycles to remove the raffle products from Checkout', 'raffle-play-woo'); ?>
                </span>
                
            </p>
        
        </div>

        <p></p>

        <div class="col-sm-5 " > 

        </div>
    
        <div class="col-sm-7" >  

        </div>

        
    </div>
    

</div>
<!-- end of progress bar-->