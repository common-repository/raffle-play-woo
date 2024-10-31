<?php

namespace W_RafflePlayWoo_MainPage;

include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/RafflePlayWoo_Includes.php');

if( ! defined('ABSPATH') )
    die('No Access to this page');

use RafflePlayWoo_Includes\RafflePlayWoo_Includes as RafflePlayWoo_Includes;
    
class W_RafflePlayWoo_MainPage{

    public static function drp_MainPage( $settings ){

        RafflePlayWoo_Includes::rpwoo_loading_screen();        

        $date_format = array(
            'dd-mm-yyyy',
            'dd/mm/yyyy',
            'yyyy-mm-dd',
            'yyyy/mm/dd'
        );
        $no_products = sizeof( $settings['products'] );
        $class_prod = 'border-danger';
        if( $no_products > 0 )
            $class_prod = '';
      ?>
        
        <div class='wrap'>
            <div class="container-fluid"> 
            <div class='h6 row bmp-set-row'>
                <p>
                    <?php esc_html_e('146 hours (around 15 working days) of development were dedicated for this free plugin.', 'raffle-play-woo'); ?> <br/>
                    <?php esc_html_e('If you like it and want to show your support, please rate it. Thank you very much.', 'raffle-play-woo'); ?>
                    <a href="https://wordpress.org/support/plugin/raffle-play-woo/reviews/#new-post" target='_blank'> <?php esc_html_e( 'Rate It Here', 'raffle-play-woo');?> </a>
                    <br/>
                    <a href="https://youtu.be/IznIClpeBzM" target='_blank'> <?php esc_html_e( 'Setup Video HERE', 'raffle-play-woo');?> </a>
                </p>
            </div>
            <hr />

            <p style='text-align: right;'>
                    <strong> <?php esc_html_e('Version', 'raffle-play-woo'); ?> </strong>
                    <input type="text" readonly value="<?php echo esc_html( RAFFLE_PLAY_WOO_VERSION ); ?>">
            </p>

            <?php if( count( $settings['products'] ) == 0 ){ ?>

                <div class="row">
                    <div class="col-lg-6 col-sm-12">

                        <div class="alert alert-warning" id='alert_no_products' role="alert">
                            <img class='img-fluid' src='<?php echo RAFFLE_PLAY_WOO_URL."/images/product-setup-image.png";?>' /> 
                            <p>
                                <b>
                                    <?php esc_html_e('You have no Raffle Products linked to this raffle.', 'raffle-play-woo'); ?> <br/>
                                    <?php esc_html_e('Create a new product, go to "Raffle Play Woo Settings" tab and check the checkbox "Raffle Play Product"', 'raffle-play-woo'); ?> <br/>
                                    <?php esc_html_e('Next enter the number of raffle tickets to be generated per product (under the checkbox)', 'raffle-play-woo'); ?> <br/>
                                

                                </b>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <p> <?php esc_html_e('Setup Video', 'raffle-play-woo'); ?> </p>
                        <iframe width="100%" height="380" src="https://www.youtube.com/embed/IznIClpeBzM" title="How to Setup Raffle Play Woo - Wordpress Plugin - Free Version" 
                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>

                    
                </div>

            <?php } ?>

            <?php  if( $settings['live_tickets_purchased'] == 0 ){ ?>

                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-warning" id='alert_no_products' role="alert">
                            <h5>
                                <b>
                                    <?php esc_html_e('No raffle tickets generated yet.', 'raffle-play-woo'); ?> <br/>                                  
                                </b>
                            </h5>
                        </div> 
                    </div>

                </div>

                <p></p>
                <p></p>

            <?php
                }
            ?>            
                
            <?php wp_nonce_field( 'raffle_woo_nonce_action', 'raffle_woo_nonce_name' ); ?>

                    <div class='header-messages'>
                        <?php if( $settings['terminated'] ){ ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                         
                                <strong> <?php esc_html_e('Raffle is Terminated', 'raffle-play-woo'); ?> </strong>
                           
                                <button style='float: right;' type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>

                        <?php } ?>
                       
                    </div>
                    <?php RafflePlayWoo_Includes:: rpwoo_premium_link(); ?>
                    <input type='submit' class="button button-primary rdp_save_settings" value="<?php esc_html_e('Save', 'raffle-play-woo' );?>" />  
                        <p></p>
                        <h5 class='default-header-text'><?php esc_html_e('Default Raffle', 'raffle-play-woo');?></h5>      
                        
                    <div class="row bmp-set-row">
                        <div class="col-2">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                <a class="nav-link active" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true">
                                    <?php esc_html_e('General',  'raffle-play-woo' ); ?>
                                </a>

                                <a class="nav-link" id="v-pills-email-tab" data-toggle="pill" href="#v-pills-email" role="tab" aria-controls="v-pills-email" aria-selected="false">
                                    <?php esc_html_e('Email Template / Thank you page',  'raffle-play-woo' ); ?>
                                </a>

                                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                    <?php esc_html_e('User Messages',  'raffle-play-woo' ); ?>
                                </a>

                                <a class="nav-link" id="v-pills-multiple-tab" data-toggle="pill" href="#v-pills-multiple" 
                                    role="tab" aria-controls="v-pills-multiple" aria-selected="false">
                                    <?php esc_html_e('Multiple Raffles',  'raffle-play-woo' ); ?>
                                </a>

                                <a class="nav-link" id="v-pills-pdf-tab" data-toggle="pill" href="#v-pills-pdf" 
                                    role="tab" aria-controls="v-pills-pdf" aria-selected="false">
                                    <?php esc_html_e('PDF Email Attachment',  'raffle-play-woo' ); ?>
                                </a>

                                <a class="nav-link" id="v-pills-extra-tab" data-toggle="pill" href="#v-pills-extra" 
                                    role="tab" aria-controls="v-pills-extra" aria-selected="false">
                                    <?php esc_html_e('Extra Settings',  'raffle-play-woo' ); ?>
                                </a>

                                <a class="nav-link" id="v-pills-acc-tab" data-toggle="pill" href="#v-pills-acc"
                                    role="tab" aria-controls="v-pills-acc" aria-selected="false">
                                    <?php esc_html_e('Woocommerce Account',  'raffle-play-woo' ); ?>
                                </a>

                                <a class="nav-link d-none" id="v-pills-test-tab" data-toggle="pill" href="#v-pills-test" role="tab" aria-controls="v-pills-test" aria-selected="false">
                                    <?php esc_html_e('Test Info',  'raffle-play-woo' ); ?>
                                </a>

                                <a class="nav-link d-none" id="v-pills-shortinfo-tab" data-toggle="pill" href="#v-pills-shortinfo" 
                                    role="tab" aria-controls="v-pills-shortinfo" aria-selected="false">
                                    <?php esc_html_e('Shortcode Info Raffle',  'raffle-play-woo' ); ?>
                                </a>

                                <a class="nav-link" id="v-pills-countdown-tab" data-toggle="pill" href="#v-pills-countdown" 
                                    role="tab" aria-controls="v-pills-countdown" aria-selected="false">
                                    <?php esc_html_e('Countdown Settings',  'raffle-play-woo' ); ?>
                                </a>

                                <a class="nav-link" id="v-pills-progressbar-tab" data-toggle="pill" href="#v-pills-progressbar" 
                                    role="tab" aria-controls="v-pills-progressbar" aria-selected="false">
                                    <?php esc_html_e('Progress Bar Settings',  'raffle-play-woo' ); ?>
                                </a>

                                <a class="nav-link" id="v-pills-gencheckout-tab" data-toggle="pill" href="#v-pills-gencheckout" 
                                    role="tab" aria-controls="v-pills-gencheckout" aria-selected="false">
                                    <?php esc_html_e('Generated Tickets at Checkout',  'raffle-play-woo' ); ?>
                                </a>

                                <a class="nav-link" id="v-pills-user_search-tab" data-toggle="pill" href="#v-pills-user_search" 
                                    role="tab" aria-controls="v-pills-user_search" aria-selected="false">
                                    <?php esc_html_e('Customer Search Tickets',  'raffle-play-woo' ); ?>                                
                                </a>

                                <a class="nav-link" id="v-pills-producttab-tab" data-toggle="pill" href="#v-pills-producttab"                                  
                                    role="tab" aria-controls="v-pills-producttab" aria-selected="false">
                                    <?php esc_html_e('Product Raffle Tab (Last Tickets Sold)',  'raffle-play-woo' ); ?>  
                           
                                </a>

                                <a class="nav-link" id="v-pills-userpickstab-tab" data-toggle="pill" href="#v-pills-userpickstab"                                  
                                    role="tab" aria-controls="v-pills-userpickstab" aria-selected="false">
                                    <?php esc_html_e('User Picks Tickets at Checkout',  'raffle-play-woo' ); ?>                                                                 
                                </a>


                            </div>
                        </div>
                        <div class="col-9 div-container-right">
                            <div class="tab-content" id="v-pills-tabContent">
                                <!-- general tab -->
                                <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">                               
                                
                                    <?php if( ! $settings['db_health']  ){ 
                                        
                                        ?>
                                        <div class='row bmp-set-row' >
                                            <div class="col-sm-5" style='display: inline-block; color: red; font-weight: 800'> 
                                                <?php esc_html_e('There are issues with the DB Tables', 'raffle-play-woo' );?> 
                                            </div>
                                        
                                            <div class="col-sm-7" style='display: inline-block'>                               
                                                <input type="button" id='rpwoo_db_health' class='button button-primary'  value="<?php esc_html_e('Run Fix', 'raffle-play-woo');?>" />
                                            </div>
                                        </div>

                                    <?php } ?>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5" style='display: inline-block'> 
                                            <label for="rdp_live_raffle"> <?php esc_html_e('Raffle Name', 'raffle-play-woo' );?> </label>
                                        </div>
                                    
                                        <div class="col-sm-7" style=''>                               
                                            <input type="text"  value="<?php echo esc_html( $settings['raffle_name']);?>" id='rpwoo_raffle_name' />       
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5" style='display: inline-block'> 
                                            <label for="rdp_live_raffle"> <?php esc_html_e('Raffle Status', 'raffle-play-woo' );?> </label>
                                        </div>
                                    
                                        <div class="col-sm-7" style=''>                               
                                            <input type="checkbox"  data-toggle="toggle" data-size='small' <?php if( $settings['live_raffle']) echo "checked";?> id='rdp_life_raffle'
                                            data-on="<?php esc_html_e('Live', 'raffle-play-woo');?>" disabled data-off="<?php esc_html_e('Test', 'raffle-play-woo');?>" />       
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                             <?php esc_html_e('Terminate Raffle Now', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip' 
                                                title="<?php esc_html_e('No raffle products will be available at checkout while disabled.', 'raffle-play-woo' ); ?>" > 
                                                <i class="fa fa-info-circle text-info"></i> 

                                            </span>
                                        </div>
                                    
                                        <div class="col-sm-7" style=''>                               
                                            <input type="checkbox" disabled data-toggle="toggle" data-size='small' id='rdp_terminate_raffle'
                                                data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"  data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" 
                                                <?php if( $settings['terminated'] ) echo 'checked'; ?>
                                            />  
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>     
                                        </div>
                                    </div>

                                    
                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5" style='display: inline-block'> 
                                            <?php esc_html_e('Live Ticket Starts At', 'raffle-play-woo' );?> 
                                        </div>
                                        <div class="col-sm-7" style='display: inline-block'> 
                                                <input  type="text"  name="rdp_ticket_start_count_at" class=''
                                                     value="<?php 
                                                            if( $settings['ticket_count_starts_at'] == false )
                                                                echo '0';
                                                            else 
                                                                echo esc_html( $settings['ticket_count_starts_at'] );
                                                                
                                                            ?>"
                                                        id="rdp_ticket_start_count_at" placeholder="" />

                                                        <span data-toggle='tooltip' 
                                                title="<?php esc_html_e('If changing the ticket no while raffle is running, make sure is above the last used ticket.', 'raffle-play-woo' ); ?>" > 
                                                <i class="fa fa-info-circle text-info"></i> 

                                            </span>
                                                    
                                        </div>
                                    </div>
                                    
                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Limit Number or Raffle Tickets', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" style='display: inline-block; margin-top: 3px'>   
                                            <label for="radio_limit_raffle_yes">                            
                                                <input type='radio' disabled <?php if( $settings['is_limited'] ) echo 'checked'; ?>  id='radio_limit_raffle_yes' name='radio_limit_raffle' /> 
                                                <?php esc_html_e('Yes', 'raffle-play-woo' ); ?>                                      
                                            </label>
                                            <input type="number" disabled   id="limit_raffle_no_tickets" min='1'  value="<?php echo esc_html( $settings['limit_no'] ); ?>" />
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>                                          

                                            <span class="spacer5"></span>

                                            <span data-toggle='tooltip' 
                                                title="<?php esc_html_e('Generate Random Tickets within the range created by start ticket plus number of tickets. ***IMPORTANT*** Do not change the raffle ticket system from random to inline after tickets have been purchased***', 'raffle-play-woo' ); ?>" > 
                                                <i class="fa fa-info-circle text-info"></i> 
                                            </span>
                                           
                                            <input type="checkbox"  data-toggle="toggle" data-size='small' id='gen_random_tickets'
                                                data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"  data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" 
                                                disabled
                                            />  
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>  
                                            <?php esc_html_e('Generate Random Tickets ', 'raffle-play-woo' ); ?>   

                                            <br />

                                            <label for="radio_limit_raffle_no">
                                                <input type='radio' disabled <?php if( ! $settings['is_limited'] ) echo 'checked'; ?>  
                                                id='radio_limit_raffle_no' name='radio_limit_raffle' /> 
                                                    <?php esc_html_e('No', 'raffle-play-woo' ); ?>                                                     
                                            </label>

                                            
                                           
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row border border-success' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                                <?php esc_html_e('Generate, Reserve, and Show Raffle tickets at checkout', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip' 
                                                title="<?php esc_html_e('The tickets will be generated and shown at checkout page', 'raffle-play-woo' ); ?>" > 
                                                <i class="fa fa-info-circle text-info"></i> 

                                            </span>
                                        </div>
                                    
                                        <div class="col-sm-7" style=''>                               
                                            <input type="checkbox"  data-toggle="toggle" data-size='small' 
                                                id='rdp_gen_checkout'
                                                data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"  
                                                data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" 
                                                <?php if( isset(  $settings['gen_checkout'][0]) && $settings['gen_checkout'][0] == 'yes' ) echo 'checked'; ?>
                                            />       
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row border border-success'  >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                                <?php esc_html_e('Let customers pick tickets at checkout', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip' 
                                                title="<?php esc_html_e('This feature only works if tickets are generated at checkout. The customer can change the raffle tickets to the desired ones', 'raffle-play-woo' ); ?>" > 
                                                <i class="fa fa-info-circle text-info"></i> 

                                            </span>
                                            <span class='text-success badge badge-primary'>
                                                <?php esc_html_e('Enable Generate and Display tickets at checkout and add background image for ticket', 'raffle-play-woo' );?> 
                                            </span>
                                            <br/>
                                            <span>
                                                <i>
                                                    <a href="https://youtu.be/34FZ7mUxUy0" target='_blank'>
                                                        <?php esc_html_e('Watch setup video here', 'raffle-play-woo'); ?> 
                                                    </a>
                                                </i> 
                                            </span>
                                        </div>
                                    
                                        <div class="col-sm-7" style=''>                               
                                            <input type="checkbox"  data-toggle="toggle" data-size='small' 
                                                id='rdp_user_pick_tickets'
                                                data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"  
                                                data-off="<?php esc_html_e('No', 'raffle-play-woo');?>"                                               
                                            />  
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>      
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Ticket Number Leading Zeros', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip'
                                                title="<?php esc_html_e('Put leading zeros to the number, the prefix will be included', 'raffle-play-woo' ); ?>"> 
                                            <i class="fa fa-info-circle text-info"></i> </span>
                                        </div>
                                    
                                        <div class="col-sm-7" 
                                            style='display: inline-block'>                               
                                            <input type="number" readonly
                                                min='0'
                                                max='20'
                                                placeholder="0"  id="rpwoo_leading_zeros" 
                                                value="0" 
                                            />  
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>  

                                            <p style='display: inline'> 
                                                <i>                                                                                 
                                                    <?php 
                                                        esc_html_e('Eg: Leading zero set to 5, prefix T-, ticket is 12 => result: T-00012', 'raffle-play-woo');
                                                    ?>
                                                </i>
                                            </p>
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Ticket Prefix', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip'
                                                title="<?php esc_html_e('Leave empty if no prefix wanted. (eg: Ticket-10024)', 'raffle-play-woo' ); ?>"> 
                                            <i class="fa fa-info-circle text-info"></i> </span>
                                        </div>
                                    
                                        <div class="col-sm-7" style='display: inline-block'>                               
                                            <input type="text" placeholder="<?php esc_html_e('Max 15 alpha-numeric', 'raffle-play-woo' );?>"  id="rpwoo_ticket_prefix" 
                                             value="<?php echo stripslashes( esc_html( $settings['ticket_prefix'] )); ?>" />                                    
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Raffle Start Date Time', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" style='display: inline-block'>                               
                                            <input type="text" disabled placeholder='dd-mm-yyyy'
                                                 id="rpwoo_start_date"  value="<?php echo esc_html( $settings['start_date'] ); ?>" />   
                                            <input type="text" disabled placeholder='hh:mm' class='clockpicker_main' 
                                                id="rpwoo_start_time"  value="<?php echo esc_html( $settings['start_time'] ); ?>" />                                  
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>  
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Raffle End Date Time', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" style='display: inline-block'>                               
                                            <input type="text" disabled  placeholder='dd-mm-yyyy' id="rpwoo_end_date" 
                                                 value="<?php echo esc_html( $settings['end_date'] ); ?>" />    
                                            <input type="text" disabled class='clockpicker_main'  placeholder='hh:mm' id="rpwoo_end_time"  
                                                value="<?php echo esc_html( $settings['end_time'] ); ?>" />                                    
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>  
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Last Live Used Ticket', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" style='display: inline-block'>                               
                                            <input type="number" id="liveLastTicketNo" readonly
                                                value="<?php echo esc_html( $settings['live_last_ticket'] ); ?>" />
                                        </div>
                                    </div>


                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Live Raffle Tickets Purchased', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" style='display: inline-block'>                               
                                            <input type="number" id="liveTicketsPurchased" readonly
                                                 value="<?php echo esc_html( $settings['live_tickets_purchased'] ); ?>" />
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Terminate Raffle on Buy Out Product', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip'
                                                title="<?php esc_html_e('The raffle will be set to terminated if the "Buyout Product" is sold (out of stock). Terminate raffle by selling one non raffle product', 'raffle-play-woo' ); ?>"> 
                                            <i class="fa fa-info-circle text-info"></i> </span>
                                        </div>
                                    
                                        <div class="col-sm-7" style=''>                               
                                            <input type="checkbox"  data-toggle="toggle" data-size='small' id='rdp_enable_buy_product'
                                                data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                                                data-off="<?php esc_html_e('No', 'raffle-play-woo');?>"                                             
                                            /> 
                                            <?php esc_html_e('Buy Out Product ', 'raffle-play-woo' );?>  
                                            <select name="" id=""> 
                                                <option value=""> <?php esc_html_e('Dummy - Non Raffle Product', 'raffle-play-woo' );?> </option>    
                                            </select>
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>  
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                           <b>  <?php esc_html_e('Raffle Products', 'raffle-play-woo' );?>  </b>
                                        </div>
                                    
                                        <div class="col-sm-7" style='display: inline-block'>   
                                            <?php
                                                $products_to_display = esc_html__('Default Raffle has no products linked', 'raffle-play-woo' );
                                                if( $no_products > 0)
                                                    $products_to_display = esc_html( implode( '&#13;&#10;', $settings['products'] ) );
                                            ?>

                                            <textarea name="" class="<?php echo $class_prod;?>" id="raffle_products" 
                                            cols="30" rows="<?php echo $no_products + 1;?>" 
                                            style="width: 100%;" readonly><?php echo $products_to_display; ?></textarea>                                        
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row border border-success' style='background-color: rgba(144, 238, 144, 0.4);' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Generate Raffle Tickets for Order Status', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip' 
                                                title="<?php esc_html_e('Raffle Tickets will only be generated for these statuses', 'raffle-play-woo' ); ?>"> 
                                            <i class="fa fa-info-circle text-info"></i> </span>
                                        </div>
                                    
                                        <div id='order_status_generate' class="col-sm-7" style='display: inline-block'>   
                                            <label style="cursor: pointer;"
                                                   title="<?php esc_html_e('Processing', 'raffle-play-woo' ); ?>">                            
                                                    <input type="checkbox" id="rpwoo_checkout_order_processing"  
                                                        <?php if( $settings['order_status_gen']['woocommerce_order_status_processing'] == 'yes') echo 'checked'; ?>
                                                    />
                                                        <?php esc_html_e('Processing', 'raffle-play-woo' );?>                                                                        
                                            </label>

                                            <label style='margin-left: 8px; cursor: pointer;'
                                                title="<?php esc_html_e('Completed', 'raffle-play-woo' ); ?>">                            
                                                <input type="checkbox" id="rpwoo_checkout_order_completed" 
                                                    <?php if( $settings['order_status_gen']['woocommerce_order_status_completed'] == 'yes') echo 'checked'; ?>
                                                /> 
                                                <?php esc_html_e('Completed', 'raffle-play-woo' );?>                                                                        
                                            </label>

                                            <label style='margin-left: 8px; cursor: pointer;'
                                                title="<?php esc_html_e('On Hold', 'raffle-play-woo' ); ?>">                            
                                                <input type="checkbox"  id="rpwoo_checkout_order_onhold" 
                                                    <?php if( $settings['order_status_gen']['woocommerce_order_status_on-hold'] == 'yes') echo 'checked'; ?>
                                                /> 
                                                <?php esc_html_e('On Hold', 'raffle-play-woo' );?>                                                                        
                                            </label>
                                           
                                            <span > 
                                                <i data-toggle='tooltip' 
                                                    title='<?php esc_html_e('Tickets will only be generated for these order statuses', 'raffle-play-woo' ); ?>' class="fa fa-info-circle text-info">
                                                </i> 
                                            </span>   
                                            
                                        </div>

                                        <div class="alert alert-danger alert-order-status" style='display: none' role="alert">
                                               <?php esc_html_e('No raffle tickets will be generated. You need to select at least one order status to generate tickets. Recommending to enable Processing and Completed', 'raffle-play-woo'); ?>
                                        </div>

                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Ignore Orders at Checkout', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip' 
                                                title="<?php esc_html_e('It wont affect the order, raffle tickets won\'t be created', 'raffle-play-woo' ); ?>"> 
                                            <i class="fa fa-info-circle text-info"></i> </span>
                                        </div>
                                    
                                        <div id='order_status_div' class="col-sm-7" style='display: inline-block'>   
                                            <label 
                                                    title="<?php esc_html_e('Payment failed or was declined (unpaid)', 'raffle-play-woo' ); ?>">                            
                                                <input type="checkbox" checked  disabled id="rpwoo_checkout_order_failed"   />
                                                     <?php esc_html_e('Failed', 'raffle-play-woo' );?>                                                                        
                                            </label>

                                            <label 
                                                title="<?php esc_html_e('Cancelled by an admin or the customer – no further action required', 'raffle-play-woo' ); ?>"">                            
                                                <input type="checkbox" checked disabled id="rpwoo_checkout_order_cancelled" /> 
                                                <?php esc_html_e('Cancelled', 'raffle-play-woo' );?>                                                                        
                                            </label>
                                           
                                            <span > 
                                                <i data-toggle='tooltip' 
                                                    title='<?php esc_html_e('At Checkout, do not assign raffle tickets to following orders', 'raffle-play-woo' ); ?>' class="fa fa-info-circle text-info">
                                                </i> 
                                            </span>                                                                       

                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Raffle Duplicate Tickets', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip' 
                                                title='<?php esc_html_e('Two customers buying raffle products at the same time, might cause the db to overlap the orders, and create duplicate tickets. Chances are minimal. But the system will spot any malfunctions ', 'raffle-play-woo' ); ?>'> 
                                            <i class="fa fa-info-circle text-info"></i> </span>
                                        </div>
                                        
                                        <div id='div_issue_block' class="col-sm-7" style='display: inline-block'>    
                                            <?php if( sizeof( $settings['health'] ) > 0 ) echo '<h4 id="issue_header">' . esc_html('Duplicate tickets found', 'raffle-play-woo') . '</h4>'; ?>
                                            <div name="" id='div_raffle_issues' style='min-width: 150px; max-height: 200px; overflow-y: auto; min-height: 30px; border-radius: 5px;
                                                    <?php if( sizeof( $settings['health'] ) > 0 ) echo "border: 1px solid red;";else echo "border: 1px solid gray;"; ?>' id="" readonly>
                                                <?php   if( sizeof( $settings['health'] ) > 0 ){                                                   
                                                            echo implode(' ', $settings['health'] );
                                                        }else  esc_html_e('No issues found!', 'raffle-play-woo' ); ?>
                                            </div>        

                                        </div>
                                    </div>

                                    <p></p>

                                    
                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Enable Duplicates Fixing after Order Created', 'raffle-play-woo' ); ?> 
                                            <span data-toggle='tooltip' 
                                                    title='<?php esc_html_e('Are you getting duplicated tickets? Enable this option, and the system will check for duplicates, and fix them after the order is created', 'raffle-play-woo' ); ?>'> 
                                                <i class="fa fa-info-circle text-info"></i> 
                                            </span>
                                            <br/>
                                            <span style='font-size: .7rem'> <i><?php esc_html_e('Why do I get duplicated tickets? Slow server combined with lots of orders.') ?> </i> </span> 
                                        </div>
                                        
                                        <div class="col-sm-7" >                                                                      
                                            <input type="checkbox"  data-toggle="toggle" data-size='small' 
                                                <?php if( $settings['check_duplicates'] == 'yes') echo "checked";?> 
                                                    id='rdp_check_duplicates'
                                                    data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"  
                                                    data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" />       
                                        </div>
                                    </div>

                                    <p></p>
                                    <hr />

                                    <div class='row bmp-set-row'>
                                        <div class='row' >
                                            <div class="col-sm-5" > 
                                                <?php esc_html_e('Show Tickets Number with Raffle image in background (Thank you Page / Email )', 'raffle-play-woo' );?> 
                                                <span data-toggle='tooltip' 
                                                    title="<?php esc_html_e('Raffle image will be placed in the background of the ticket number. Custom images can be used, or customized in the template', 'raffle-play-woo' ); ?>" > 
                                                    <i class="fa fa-info-circle text-info"></i> 

                                                </span>
                                            </div>
                                                                
                                            <div class="col-sm-7" >                               
                                                <input type="checkbox" id="show_ticket_image" 
                                                data-toggle='toggle' 
                                                data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                                                data-off="<?php esc_html_e('No', 'raffle-play-woo');?>"                                                
                                                    <?php if( $settings['ticket_image_raffles']['0']->show == 'yes' )
                                                    echo 'checked'; ?> 
                                                data-size='small'/>

                                                <?php esc_html_e('This feature is FREE. In the PREMIUM version is located in "Extra Settings Tab"', 'raffle-play-woo' );?> 
                                            </div>

                                        </div>
                                  
                                        <div class='row' >
                                            <div class="col-sm-5 " style='display: inline-block; padding-left: 50px;'> 
                                                <?php esc_html_e('Raffle Tickets Images', 'raffle-play-woo' );?> 
                                            </div>                                    
                                        
                                            <div class="col-sm-7" style='display: inline-block'>  
                                                <select name="select_ticket_image" id="select_ticket_image">
                                                    <option value="blue" <?php if( $settings['ticket_image_raffles']['0']->ticket_image == 'blue') echo 'selected'; ?> ><?php esc_html_e('Blue', 'raffle-play-woo' ); ?> </option>
                                                    <option value="gold-one" <?php if( $settings['ticket_image_raffles']['0']->ticket_image == 'gold-one') echo 'selected'; ?> ><?php esc_html_e('Gold', 'raffle-play-woo' ); ?> </option>
                                                    <option value="orange" <?php if( $settings['ticket_image_raffles']['0']->ticket_image == 'orange') echo 'selected'; ?> ><?php esc_html_e('Orange', 'raffle-play-woo' ); ?> </option>
                                                    <option value="custom">  <?php esc_html_e('Custom Image', 'raffle-play-woo') ?> </option>
                                                </select>
                                                <img id='ticket_img_show' data-src="<?php echo RAFFLE_PLAY_WOO_URL . '/';?>" src="" style='width: 80px;' alt="">

                                                <div class='row' style='margin-top: 12px' >
                                                
                                                    <div class="col-sm-12 div-custom-ticket-img" style='display: none' >  
                                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>
                                                        <button class='button button-primary' id='load_ticket_img' style='display: inline; height: 34px;' >
                                                        <?php esc_html_e('Library', 'raffle-play-woo' ); ?></button>                             
                                                        <div style='display: inline;'>
                                                            <input type="text" id="ticket_image_url"  style='width:80%' style='display: inline;'
                                                            placeholder="https://yourdomain.com/images/raffle-ticket-image.png"
                                                            value="<?php echo esc_url_raw( $settings['ticket_image_raffles']['0']->ticket_image_url ); ?>" />
                                                        </div>
                                                    </div>
                                                </div>
        
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Show Countdown on Product Page', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip' 
                                                title='<?php esc_html_e('Show Countdown if Raffle has start date or end date set for the products linked to this raffle.', 'raffle-play-woo' ); ?>'> 
                                            <i class="fa fa-info-circle text-info"></i> </span>
    
                                        </div>
                                        
                                        <div class="col-sm-7" >  
                                            <div >                             
                                                <input type="checkbox"  data-toggle="toggle" data-size='small'                                                
                                                        id='rdp_show_countdown'
                                                        data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"  
                                                        data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" />  

                                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                                        
                                                <span style='width: 205px; margin-left: 20px; margin-top: -3px;'>
                                                    <img width='200' style='max-width: 200px' 
                                                        src="<?php echo esc_url_raw( RAFFLE_PLAY_WOO_URL .'/images/countdown-image.png');?>" 
                                                        alt="<?php esc_html_e('Countdown Image', 'raffle-play-woo');?>" />
                                                </span>
                                            </div>

                                            <div>
                                                <hr />
                                                <?php esc_html_e('Position on Product page', 'raffle-play-woo'); ?>
                                                <br />
                                                <select name="countdown_pos" id="countdown_pos">                       
                                                    <?php

                                                        $options = array(
                                                            'woocommerce_before_single_product' 		=> esc_html__('Before Single Product', 'raffle-play-woo'),
                                                            'woocommerce_before_single_product_summary' => esc_html__('Before Single Product Summary', 'raffle-play-woo'),
                                                            'woocommerce_single_product_summary' 		=> esc_html__('Top of Single Product Summary', 'raffle-play-woo'),
                                                            'woocommerce_before_add_to_cart_form' 		=> esc_html__('Before Add to Cart Form', 'raffle-play-woo'),
                                                            'woocommerce_before_variations_form'        => esc_html__('Before Variations Form', 'raffle-play-woo'),
                                                            'woocommerce_before_add_to_cart_button'     => esc_html__('Before Add to Cart Button', 'raffle-play-woo'),
                                                            'woocommerce_before_single_variation'     	=> esc_html__('Before Single Variation', 'raffle-play-woo'),
                                                            'woocommerce_before_single_variation'    	=> esc_html__('Before Single Variation', 'raffle-play-woo'),
                                                            'woocommerce_before_add_to_cart_quantity' 	=> esc_html__('Before Add to Cart Quanitity', 'raffle-play-woo'),
                                                            'woocommerce_after_add_to_cart_quantity' 	=> esc_html__('After Add to Cart Quanitity', 'raffle-play-woo'),
                                                            'woocommerce_after_add_to_cart_button'      => esc_html__('After Add to Cart Button', 'raffle-play-woo'),
                                                            'woocommerce_after_add_to_cart_form'        => esc_html__('After Add to Cart Form', 'raffle-play-woo'),
                                                            'woocommerce_after_single_product_summary'  => esc_html__('After Single Product Summary', 'raffle-play-woo')
                                                        );

                                                        foreach( $options as $key => $val ){                                              
                                                            echo "<option value='$key'> $val </option>";                                                          
                                                        }
                                                    ?>
                                                </select>  

                                                <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 

                                                <span>
                                                    <?php echo sprintf( esc_html__('View Positions %s', 'raffle-play-woo'), '<a href="https://www.businessbloomer.com/woocommerce-visual-hook-guide-single-product-page" target="_blank">' . 
                                                                esc_html__('Here', 'raffle-play-woo') . '</a>'); ?>
                                                </span>
                                                <p style='font-size:.8rem'>
                                                    <i>
                                                        <?php esc_html_e('The countdown does not show in the position you have selected? Some themes change the position of hooks with different style or html applied to the page.', 'raffle-play-woo' );?> 
                                                    </i>
                                                </p>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Show Countdown on Shop Grid Cards', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip' 
                                                title='<?php esc_html_e('Show Countdown if Raffle has start date or end date set for the products linked to this raffle.', 'raffle-play-woo' ); ?>'> 
                                                <i class="fa fa-info-circle text-info"></i> 
                                            </span>                                   
    
                                        </div>
                                        
                                        <div class="col-sm-7" >  
                                            <div >                             
                                                <input type="checkbox"  data-toggle="toggle" data-size='small'                                              
                                                        id='show_countdown_card'
                                                        data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"  
                                                        data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" />  

                                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>  
                                                        
                                                <span style='width: 205px; margin-left: 20px; margin-top: -3px;'>
                                                    <img width='200' style='max-width: 200px' 
                                                        src="<?php echo esc_url_raw( RAFFLE_PLAY_WOO_URL .'/images/countdown-image.png');?>" 
                                                        alt="<?php esc_html_e('Countdown Image', 'raffle-play-woo');?>" />
                                                </span>
                                            </div>

                                            <div>
                                                <hr />
                                                <?php esc_html_e('Position on Grid Card', 'raffle-play-woo'); ?>
                                                <br />
                                                <select name="countdown_card_pos" id="countdown_card_pos">                       
                                                    <?php

                                                        $options = array(
                                                            'woocommerce_before_shop_loop_item' 		=> esc_html__('Before Loop Item', 'raffle-play-woo'),
                                                            'woocommerce_before_shop_loop_item_title'   => esc_html__('Before Loop Item Title', 'raffle-play-woo'),
                                                            'woocommerce_shop_loop_item_title' 		    => esc_html__('Shop Loop Item Title', 'raffle-play-woo'),
                                                            'woocommerce_after_shop_loop_item_title' 	=> esc_html__('After Loop Item Title', 'raffle-play-woo'),
                                                            'woocommerce_after_shop_loop_item'          => esc_html__('After Price Loop Item', 'raffle-play-woo')
                                                        );

                                                        foreach( $options as $key => $val ){                                            
                                                            echo "<option value='$key'> $val </option>";                                                            
                                                        }
                                                    ?>
                                                </select>  

                                                <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>  
                                                <span>
                                                    <?php echo sprintf( esc_html__('View Positions %s', 'raffle-play-woo'), '<a href="https://www.businessbloomer.com/woocommerce-visual-hook-guide-archiveshopcat-page/" target="_blank">' . 
                                                                esc_html__('Here', 'raffle-play-woo') . '</a>'); ?>
                                                </span>
                                                <p style='font-size:.8rem'>
                                                    <i>
                                                        <?php esc_html_e('Some themes change the position of hooks with different style or html applied to the page.', 'raffle-play-woo' );?> 
                                                    </i>
                                                </p>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <!-- progress bar -->
                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Show Progress Bar on Product Page', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip' 
                                                title='<?php esc_html_e('Show Progress Bar, if the raffle has limited number of tickets', 'raffle-play-woo' ); ?>'> 
                                            <i class="fa fa-info-circle text-info"></i> </span>                                           
                                         
                                        </div>
                                        
                                        <div class="col-sm-7" >  
                                            <div >                             
                                                <input type="checkbox"  data-toggle="toggle" data-size='small'                                                   
                                                        id='show_pb_prod'
                                                        data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"  
                                                        data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" />  

                                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>  
                                                        
                                                <span style='width: 285px; margin-left: 20px; margin-top: -3px;'>
                                                    <img width='300' style='max-width: 300px' 
                                                        src="<?php echo esc_url_raw( RAFFLE_PLAY_WOO_URL .'/images/progress-bar-image.png');?>" 
                                                        alt="<?php esc_html_e('Progressbar Image', 'raffle-play-woo');?>" />
                                                </span>
                                            </div>

                                            <div>
                                                <hr />
                                                <?php esc_html_e('Position on Product page', 'raffle-play-woo'); ?>
                                                <br />
                                                <select name="pb_prod_pos" id="pb_prod_pos">                       
                                                    <?php

                                                        $options = array(
                                                            'woocommerce_before_single_product' 		=> esc_html__('Before Single Product', 'raffle-play-woo'),
                                                            'woocommerce_before_single_product_summary' => esc_html__('Before Single Product Summary', 'raffle-play-woo'),
                                                            'woocommerce_single_product_summary' 		=> esc_html__('Top of Single Product Summary', 'raffle-play-woo'),
                                                            'woocommerce_before_add_to_cart_form' 		=> esc_html__('Before Add to Cart Form', 'raffle-play-woo'),
                                                            'woocommerce_before_variations_form'        => esc_html__('Before Variations Form', 'raffle-play-woo'),
                                                            'woocommerce_before_add_to_cart_button'     => esc_html__('Before Add to Cart Button', 'raffle-play-woo'),
                                                            'woocommerce_before_single_variation'     	=> esc_html__('Before Single Variation', 'raffle-play-woo'),
                                                            'woocommerce_before_single_variation'    	=> esc_html__('Before Single Variation', 'raffle-play-woo'),
                                                            'woocommerce_before_add_to_cart_quantity' 	=> esc_html__('Before Add to Cart Quantity', 'raffle-play-woo'),
                                                            'woocommerce_after_add_to_cart_quantity' 	=> esc_html__('After Add to Cart Quantity', 'raffle-play-woo'),
                                                            'woocommerce_after_add_to_cart_button'      => esc_html__('After Add to Cart Button', 'raffle-play-woo'),
                                                            'woocommerce_after_add_to_cart_form'        => esc_html__('After Add to Cart Form', 'raffle-play-woo'),
                                                            'woocommerce_after_single_product_summary'  => esc_html__('After Single Product Summary', 'raffle-play-woo')
                                                        );

                                                        foreach( $options as $key => $val ){                                           
                                                            echo "<option value='$key'> $val </option>";                                                        
                                                        }
                                                    ?>
                                                </select>  

                                                <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>  
                                                <span>
                                                    <?php echo sprintf( esc_html__('View Positions %s', 'raffle-play-woo'), '<a href="https://www.businessbloomer.com/woocommerce-visual-hook-guide-single-product-page" target="_blank">' . 
                                                                esc_html__('Here', 'raffle-play-woo') . '</a>'); ?>
                                                </span>
                                                <p style='font-size:.8rem'>
                                                    <i>
                                                        <?php esc_html_e('The Progress bar does not show in the position you have selected? Some themes change the position of hooks with different style or html applied to the page.', 'raffle-play-woo' );?> 
                                                    </i>
                                                </p>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Show Progress Bar on Shop Grid Cards', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip' 
                                                title='<?php esc_html_e('Show Progress bar if the raffle has limited number of tickets.', 'raffle-play-woo' ); ?>'> 
                                            <i class="fa fa-info-circle text-info"></i> </span>
    
                                        </div>
                                        
                                        <div class="col-sm-7" >  
                                            <div >                             
                                                <input type="checkbox"  data-toggle="toggle" data-size='small' 
                                                   
                                                        id='show_pb_card'
                                                        data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"  
                                                        data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" />  

                                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>  
                                                        
                                                <span style='width: 280px; margin-left: 20px; margin-top: -3px;'>
                                                    <img width='300' style='max-width: 300px' 
                                                        src="<?php echo esc_url_raw( RAFFLE_PLAY_WOO_URL .'/images/progress-bar-image.png');?>" 
                                                        alt="<?php esc_html_e('Progress Bar Image', 'raffle-play-woo');?>" />
                                                </span>
                                            </div>

                                            <div>
                                                <hr />
                                                <?php esc_html_e('Position on Grid Card', 'raffle-play-woo'); ?>
                                                <br />
                                                <select name="pb_card_pos" id="pb_card_pos">                       
                                                    <?php

                                                        $options = array(
                                                            'woocommerce_before_shop_loop_item' 		=> esc_html__('Before Loop Item', 'raffle-play-woo'),
                                                            'woocommerce_before_shop_loop_item_title'   => esc_html__('Before Loop Item Title', 'raffle-play-woo'),
                                                            'woocommerce_shop_loop_item_title' 		    => esc_html__('Shop Loop Item Title', 'raffle-play-woo'),
                                                            'woocommerce_after_shop_loop_item_title' 	=> esc_html__('After Loop Item Title', 'raffle-play-woo'),
                                                            'woocommerce_after_shop_loop_item'          => esc_html__('After Price Loop Item', 'raffle-play-woo')
                                                        );

                                                        foreach( $options as $key => $val ){                                                                 
                                                            echo "<option value='$key'> $val </option>";                                                        
                                                        }
                                                    ?>
                                                </select>  

                                                <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>  
                                                <span>
                                                    <?php echo sprintf( esc_html__('View Positions %s', 'raffle-play-woo'), '<a href="https://www.businessbloomer.com/woocommerce-visual-hook-guide-archiveshopcat-page/" target="_blank">' . 
                                                                esc_html__('Here', 'raffle-play-woo') . '</a>'); ?>
                                                </span>
                                                <p style='font-size:.8rem'>
                                                    <i>
                                                        <?php esc_html_e('Some themes change the position of hooks with different style or html applied to the page.', 'raffle-play-woo' );?> 
                                                    </i>
                                                </p>
                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- end of general tab -->

                                <!-- email -->
                                <div class="tab-pane fade" id="v-pills-email" role="tabpanel" aria-labelledby="v-pills-email-tab">
                                                                   
                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Header Text', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" style='display: inline-block'>                               
                                            <input type="text"   id="rpwoo_email_header_lbl" 
                                               value="<?php echo  stripslashes( esc_html( $settings['email_header_lbl'] )); ?>"
                                               placeholder="<?php esc_html_e('Raffle Tickets Info', 'raffle-play-woo'); ?>"
                                            />                                                                         
                                            
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Include Raffle Name', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" style=''>                               
                                            <input type="checkbox"  disabled data-toggle="toggle" data-size='small' <?php if( $settings['inc_raffle_name']) echo "checked";?> id='rpwoo_inc_name'
                                            data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"  data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" />  
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>     
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Body Tickets', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" style='display: inline-block'>                               
                                            <input type="text"  id="rpwoo_email_body_lbl" 
                                             value="<?php echo stripslashes( esc_html( $settings['email_body_lbl'] )); ?>" 
                                             placeholder="<?php esc_html_e('Tickets Purchased', 'raffle-play-woo'); ?>" 
                                            />                                                                         
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Extra Line Info', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip' 
                                                title='<?php esc_html_e('Extra info about raffle displayed on next table row. Leave empty to skip. Eg: Raffle draw is on 25th of June 2021. Good Luck!', 'raffle-play-woo' ); ?>'> 
                                            <i class="fa fa-info-circle text-info"></i> </span>
                                            
                                        </div>
                                    
                                        <div class="col-sm-7" style='display: inline-block'>                               
                                            <input type="text" style='width: 95% !important;'  disabled placeholder="<?php stripslashes( esc_html_e('Eg: Raffle draw is on 25th of June 2021','raffle-play-woo')); ?>"
                                            id="rpwoo_email_body_extra_txt"  value="<?php echo $settings['email_extra'];?>" />                                                                         
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>  
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " style='display: inline-block'> 
                                            <?php esc_html_e('Ticket Info Position', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" style='display: inline-block'>                               
                                        <label for="rpwoo_email_pos_one">
                                            <input type="radio" disabled <?php if( $settings['email_pos'] == '1') echo 'checked'; ?>  id="rpwoo_email_pos_one" name='rpwoo_email_data_pos'  value="1" />  
                                            <?php esc_html_e('Before Order Info', 'raffle-play-woo' ); ?>    
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>                                                                     
                                        </label>
                                            <br/>
                                        <label for="rpwoo_email_pos_two">
                                            <input type="radio" <?php if( $settings['email_pos'] == '2') echo 'checked'; ?>  id="rpwoo_email_pos_two" name='rpwoo_email_data_pos'  value="2" /> 
                                            <?php esc_html_e('Between Order Info and Billing Address', 'raffle-play-woo' ); ?>                                                                          
                                        </label>
                                            <br/>
                                        <label for="rpwoo_email_pos_three">
                                            <input type="radio" disabled <?php if( $settings['email_pos'] == '3') echo 'checked'; ?>  id="rpwoo_email_pos_three" name='rpwoo_email_data_pos'  value="3" />  
                                            <?php esc_html_e('After Billing Address', 'raffle-play-woo' ); ?>  
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>                                                                         
                                        </label>
                                        </div>
                                    </div>
                            
                                </div>

                                <!-- end of email -->

                                <!-- messages -->
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">  
                                                                
                                                       
                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                        
                                        </div>
                                    
                                        <div class="col-sm-7" style='color:red; font-weight: 500' >                               
                                           ( <?php esc_html_e("%s - 2, 3 uses date replacer; %d - 5, 6 uses numeric replacer; If deleted won't replace the values") ?>)
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                            <?php esc_html_e('Messages Shortcode', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <input type="text" style='min-width: 205px;' readonly id="msg_shortcode"  
                                            value="<?php echo esc_html( $settings['msg_shortcode'] ); ?>" />
                                            <?php esc_html_e("To show raffle name add (show_raffle_name='1') in the shortcode", 'raffle-play-woo' );?> 
                                             <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>    
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                           1. <?php esc_html_e('Raffle is Terminated', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <input type="text" disabled style='width: 95% !important;' id="msg_terminate" 
                                                value="<?php echo '';?>" 
                                            placeholder="<?php esc_html_e('(Your Message) The raffle has finished', 'raffle-play-woo' );?>"
                                            />
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>    
                                        </div>
                                    </div>
                                    
                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                           2. <?php esc_html_e("Raffle hasn't started (start date - %s)", 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <input type="text" disabled style='width: 95% !important;' id="msg_startdate" 
                                                value="<?php echo ''; ?>" 
                                              placeholder="<?php esc_html_e('(Your Message) The raffle will start on %s', 'raffle-play-woo'); ?>"
                                            />
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                           3. <?php esc_html_e('Raffle has ended (end date - %s)', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <input type="text" disabled style='width: 95% !important;' id="msg_enddate" 
                                            value="<?php echo ''; ?>" 
                                            placeholder="<?php esc_html_e('(Your Message) The raffle has finished on %s', 'raffle-play-woo' ); ?>"
                                            />
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                           4. <?php esc_html_e('Raffle will end (end date - %s)', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <input type="text" disabled style='width: 95% !important;' id="msg_will_enddate" 
                                                value="<?php esc_html_e( $settings['msg_will_enddate'] ); ?>" 
                                                placeholder="<?php esc_html_e('(Your Message) The raffle will end on %s', 'raffle-play-woo' ); ?>"
                                            />
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                           5. <?php esc_html_e('Add To Cart (limit on - no tickets left)', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <input type="text" disabled style='width: 95% !important;' id="msg_add_to_cart"  value="<?php echo''; ?>" 
                                            placeholder="<?php esc_html_e('(Your Message) All raffle tickets have been sold', 'raffle-play-woo'); ?>"
                                            />
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                           6.  <?php esc_html_e('Add To Cart (limit on - exceeding tickets - %d)', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <input type="text" disabled style='width: 95% !important;' id="msg_add_to_cart_ex" 
                                            placeholder="<?php esc_html_e('(Your Message) There are only %d tickets left', 'raffle-play-woo') ?>" 
                                                 value="<?php echo ''; ?>" />
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                           7. <?php esc_html_e('Update Cart (limit on - exceeding tickets - %d)', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <input type="text" disabled id="msg_update_cart_ex"  style='width: 95% !important;'
                                                placeholder="<?php esc_html_e('(Your Message) There are only %d tickets left', 'raffle-play-woo') ?>" 
                                                 value="<?php echo ''; ?>" />
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                        </div>
                                    </div>                                                                         


                                </div>
                                <!-- end of messages -->

                                <!-- multiple-->
                                <div class="tab-pane fade" id="v-pills-multiple" role="tabpanel" aria-labelledby="v-pills-multiple-tab">                                 
                            
                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                            <?php esc_html_e('One Raffle tickets at checkout.', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip' 
                                                title="<?php esc_html_e('Limit order per raffle tickets. Avoid mixing raffle tickets per order. The check is made on add to cart event.', 'raffle-play-woo' ); ?>" > 
                                                <i class="fa fa-info-circle text-info"></i> 

                                            </span>
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <input type="checkbox" id="limit_order_per_raffle" disabled data-toggle='toggle' data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                                            data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" <?php if($settings['limit_order_per_raffle'] ) echo 'checked'; ?> data-size='small'/>
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>
                                            <br/>
                                            <input disabled style='margin-top: 3px; width: 95%;' id='limit_order_per_raffle_txt' type="text" 
                                            placeholder="(Your Message) Only One raffle tickets allowed per order" id="" data-toggle='toggle'
                                            value="<?php echo esc_html( $settings['limit_order_per_raffle_txt'] );?>" />
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>
                                        </div>
                                    </div>
                                    

                                </div>
                                <!-- end of multiple -->

                                <!-- pdf attachment settings -->
                                <div class="tab-pane fade" id="v-pills-pdf" role="tabpanel" aria-labelledby="v-pills-pdf-tab">                                 

                                
                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                    <h5> <?php esc_html_e('Works only with PHP version 7.1, and above', 'raffle-play-woo');?> </h5>
                                        <?php

                                            if( version_compare( phpversion(), '7.1' ) < 0 ){
                                                echo "<p style='color:red;'> ";
                                                esc_html_e( 'Your PHP version is less than 7.1, therefore this feature wont work' , 'raffle-play-woo' );
                                                echo "</p>";
                                            }
                                        ?>
                                    
                                    </div>

                                    <div class="col-sm-7" >                               
                                        <?php
                                            $link_documentation = sprintf( esc_html__("View PDF Attachment Documentation %s "), "<a href='https://tuskcode.com/raffle-play-woo/raffle-play-woo-premium/' target='_blank'> HERE </a>");    
                                            echo ( $link_documentation );
                                        ?>
                                    </div>
                                </div>

                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <b><?php esc_html_e('Enable PDF Email Attachment', 'raffle-play-woo' );?> </b>
                                        <span data-toggle='tooltip' 
                                            title="<?php esc_html_e('Create a pdf attachment with the raffle info. Attached to the email', 'raffle-play-woo' ); ?>" > 
                                            <i class="fa fa-info-circle text-info"></i> 
                                            
                                        </span>
                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                    </div>

                                    <div class="col-sm-7" >                               
                                        <input type="checkbox" id="enable_pdf_att" data-toggle='toggle'
                                        <?php if( version_compare( phpversion(), '7.1' ) < 0 ){ echo "disabled"; } ?>
                                        data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                                        data-off="<?php esc_html_e('No', 'raffle-play-woo');?>"  data-size='small'/>
                                        <span> <i><?php esc_html_e('(PDFs are only generated for processing, invoice, and completed orders)', 'raffle-play-woo' );?></i></span>
                                    </div>
                                </div>

                                <div class='row bmp-set-row' style='display: none;' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Restrict attachment only for Orders with: ', 'raffle-play-woo' );?> 
                                        <span data-toggle='tooltip' 
                                            title="<?php esc_html_e('Restrict attachement only for Order with raffle products, or let all orders to have pdf attachment', 'raffle-play-woo' ); ?>" > 
                                            <i class="fa fa-info-circle text-info"></i> 

                                        </span>
                                    </div>

                                    <div class="col-sm-7" >                               
                                        <input type="checkbox" id="pdf_restrict" data-toggle='toggle'                                         
                                        data-on="<?php esc_html_e('Raffle', 'raffle-play-woo');?>" 
                                        data-off="<?php esc_html_e('No Restrict', 'raffle-play-woo');?>"  
                                        data-size='small' data-width='110' />

                                    </div>
                                </div>

                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5" > 
                                        <?php esc_html_e('PDF Filename', 'raffle-play-woo' );?> 
                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                    </div>

                                    <div class="col-sm-7" >                               
                                        <p>
                                            <label for="pdf_filename_guid">
                                                <input type="radio" id="pdf_filename_guid" name='pdf_filename_name'
                                                checked />
                                                <?php esc_html_e('Order Id + GUID (eg: 5_ADFE2345ADEFEF-42ADFG-34TERE.pdf) ***RECOMMENDED***', 'raffle-play-woo' ); ?>
                                            </label>
                                        </p>

                                        <p>
                                            <label for="pdf_filename_name">
                                                <input type="radio" id="pdf_filename_name"  name='pdf_filename_name'
                                                />
                                                <?php esc_html_e('Order Id + Customer First Name + Customer Last Name (eg: 5_John_Silva.pdf)', 'raffle-play-woo' ); ?>
                                            </label>
                                        </p>

                                    </div>                                     
                                </div>

                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('PDF Template', 'raffle-play-woo' );?>
                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                    </div>

                                    <div class="col-sm-7" >                                                               
                                        <select name="pdf_template" id="pdf_template">                                           
                                            <option value="one" selected='selected' ><?php esc_html_e('One', 'raffle-play-woo');?> </option>
                                            <option value="two"> <?php esc_html_e('Two', 'raffle-play-woo');?> </option>
                                        
                                        </select>
                                        <i> <b> <?php esc_html_e('(can be found and edited (styled) under plugin folder /includes/templates )', 'raffle-play-woo' );?> </b> </i> 
                                    </div>
                                </div>

                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Include Product Name & Quantity', 'raffle-play-woo' );?> 
                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                    </div>

                                    <div class="col-sm-7" >                               
                                        <input type="checkbox" id="pdf_inc_prod" data-toggle='toggle' data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                                        data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" data-size='small'/>
                                    </div>
                                </div>

                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Include Billing Info', 'raffle-play-woo' );?> 
                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                    </div>

                                    <div class="col-sm-7" >                               
                                        <input type="checkbox" id="pdf_inc_add" data-toggle='toggle' data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                                        data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" data-size='small'/>
                                    </div>
                                </div>


                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5" > 
                                        <?php esc_html_e('Page Orientation', 'raffle-play-woo' );?> 
                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                    </div>

                                    <div class="col-sm-7" >                               
                                        <p>
                                            <label for="pdf_ori_port">
                                                <input type="radio" id="pdf_ori_port" name='pdf_orientation'
                                                />
                                                <?php esc_html_e('Portrait', 'raffle-play-woo' ); ?>
                                            </label>
                                        </p>

                                        <p>
                                            <label for="pdf_ori_land">
                                                <input type="radio" id="pdf_ori_land"  name='pdf_orientation'
                                                 />
                                                <?php esc_html_e('Landscape', 'raffle-play-woo' ); ?>
                                            </label>
                                        </p>

                                    </div>                                     
                                </div>


                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Header Logo Image (only .jpeg)', 'raffle-play-woo' );?> 
                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                    </div>

                                    <div class="col-sm-7" >  
                                        <button class='button button-primary' id='pdf_load_img' style='display: inline; height: 34px;' ><?php esc_html_e('Library', 'raffle-play-woo' ); ?></button>                             
                                        <div style='display: inline;'>
                                            <input type="text" id="pdf_header_image"  style='width:80%' style='display: inline;'
                                            placeholder="https://yourdomain.com/images/header-image.jpeg"
                                             />
                                        </div>
                                    </div>
                                </div>

                                <?php 
                                    $settings['pdf_business_info'] = 'empty';
                                    $settings['pdf_footer_info'] = 'empty';
                                    $settings['pdf_extra_css'] = 'empty';

                                    $company_info = $settings['pdf_business_info'];
                                    $footer_info  = $settings['pdf_footer_info'];
                                    $pdf_extra_css = $settings['pdf_extra_css'];

                                    if( $company_info == 'empty' ){       
                                        $company_data = array(
                                            "<div>",
                                            "<h3> My Company / Shop Name </h3>",
                                            "<p>44, Midlands Street </p>",
                                            "<p>County Neverland  </p>",
                                            "<p>Company Number:  2332425  </p>",
                                            "<p>Vat Number: A3453345 </p> ",
                                            "<p>Email: shoe@shine.com </p>",
                                            "</div>"

                                        );    

                                        $company_info = esc_html( implode('br_nl', $company_data ) );
                                    }

                                    if( $footer_info == 'empty'){
                                        $footer_data = array(
                                            "<div style='text-align: center;'>",
                                            "<p> <strong> Copyright @%year% Company Name. All Rights Reserved</strong> </p>",                            
                                            "</div>"
                                        );

                                    $footer_info = esc_html( implode('br_nl', $footer_data ) );
                                    }

                                    if( $pdf_extra_css == 'empty'){
                                        $pdf_extra_css_data = array(
                                            ".main h3{",
                                                "font-size: 15px;    /* comment: header info */",
                                            "}",
                                            ".main p, .billing-info-data{   /* comment: table data */",
                                                "font-size: 13px;",
                                            "}",                                        
                                            "table th, .raffle-info-header{   /* comment: table header */ ",
                                                "font-size: 15px !important;",
                                            "}",                                        
                                            "table td{    /*comment: table data */",
                                                "font-size: 13px !important;",
                                            "}",
                                            ".header-business-info p{   /* comment: business info paragraphs */",                        
                                                "font-size: 12px;",
                                            "}"                                
                                        );
                                        $pdf_extra_css = esc_html( implode('br_nl', $pdf_extra_css_data ) );
                                    }

                                    $company_info = str_replace("br_nl", "\n", $company_info );
                                    $footer_info = str_replace("br_nl", "\n", $footer_info );
                                    $pdf_extra_css = str_replace("br_nl", "\n",  $pdf_extra_css );

                                ?>

                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Business Info Header (html)', 'raffle-play-woo' );?> <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                        <p class='text-danger'> <?php esc_html_e('Be aware: inproper html manipulation will break the pdf file');?></p>
                                        
                                    </div>

                                    <div class="col-sm-7" >  
                                    
                                        <textarea 
                                            autocomplete='false' autocorrect='false' autocapitalize='false' spellcheck='false'
                                            class="form-control" id="pdf_business_info" cols="30" rows="6">
                                            <?php echo esc_html( $company_info );?>
                                        </textarea>
                                    </div>
                                </div>

                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Extra Info Footer (html)', 'raffle-play-woo' );?>   <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                        <p class='text-danger'> <?php esc_html_e('Be aware: inproper html manipulation will break the pdf file');?></p>
                                       
                                    </div>

                                    <div class="col-sm-7" >  
                                        <textarea 
                                            autocomplete='false' autocorrect='false' autocapitalize='false' spellcheck='false'
                                            class="form-control" id="pdf_footer_info" cols="30" rows="6">
                                            <?php echo esc_html( $footer_info );?> </textarea>
                                    </div>
                                </div>

                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Footer Height (px)', 'raffle-play-woo' );?> 
                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                    </div>

                                    <div class="col-sm-7" >  
                                        <input type="number" name="" style='width: 100px;' value="50"  min=0 id="pdf_footer_height" />px
                                    </div>
                                </div>

                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Extra Style (CSS)', 'raffle-play-woo' );?>      <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                        <p class='text-danger'> <?php esc_html_e('Be aware: inproper css manipulation will break the pdf file');?></p>
                                    
                                    </div>

                                    <div class="col-sm-7" >  
                                        <textarea 
                                            autocomplete='false' autocorrect='false' autocapitalize='false' spellcheck='false'
                                            class="form-control" id="pdf_extra_css" cols="30" rows="6"><?php echo $pdf_extra_css;?> </textarea>
                                    </div>
                                </div>
                                                            
                                </div>
                                <!-- end of pdf attachment settings -->

                                 <!-- extra-->
                                <div class="tab-pane fade" id="v-pills-extra" role="tabpanel" aria-labelledby="v-pills-extra-tab">                                 
                            
                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                            <?php esc_html_e('Hide Terminated Raffles in the Product->Raffles List', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip' 
                                                title="<?php esc_html_e('In the product settings. Hide Terminated Raffles from the raffles list. This is convenient when you have a long list of raffles. Beaware that the product might be linked to the any of the hidden terminated raffle.', 'raffle-play-woo' ); ?>" > 
                                                <i class="fa fa-info-circle text-info"></i> 

                                            </span>
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <input type="checkbox" id="hide_terminated_raffles" data-toggle='toggle' data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                                            data-off="<?php esc_html_e('No', 'raffle-play-woo');?>"  data-size='small'/>
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                            <?php esc_html_e('Show Raffle Tickets in Woocommerce Orders Table View', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip' 
                                                title="<?php esc_html_e('Quick view of the raffle tickets in the Orders Table View', 'raffle-play-woo' ); ?>" > 
                                                <i class="fa fa-info-circle text-info"></i> 

                                            </span>
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <input type="checkbox" id="show_orders_table" data-toggle='toggle' 
                                            <?php if( $settings['show_orders_table'] == 'yes') echo 'checked';?>
                                            data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                                            data-off="<?php esc_html_e('No', 'raffle-play-woo');?>"  data-size='small'/>
                                            
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                            <?php esc_html_e('Customize how raffle ticket will show in Thank you Page / Email', 'raffle-play-woo' );?> 
                                            <span data-toggle='tooltip' 
                                                title="<?php esc_html_e('Change width, height, color, text size of the raffle ticket view in Thank you / Email', 'raffle-play-woo' ); ?>" > 
                                                <i class="fa fa-info-circle text-info"></i> 

                                            </span>
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <div class="row">
                                                <label for="inputTicketWidth" class="col-sm-3 col-form-label" > 
                                                    <?php esc_html_e('Ticket Width', 'raffle-play-woo') ?> (px)
                                                </label>
                                                <div class="col-sm-5">
                                              
                                                    <input type="number" id="inputTicketWidth" 
                                                    value='' />
                                                    <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                                    
                                                </div>
                                            </div>                                            

                                            <p></p>

                                            <div class="row">
                                                <label for="inputTicketHeight" class="col-sm-3 col-form-label"> 
                                                    <?php esc_html_e('Ticket Height', 'raffle-play-woo') ?> (px) 
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="number"  id="inputTicketHeight" 
                                                        value='' >
                                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                                </div>
                                            </div>

                                            <p></p>

                                            <div class="row">
                                                <label for="inputTicketHeight" class="col-sm-3 col-form-label"> 
                                                    <?php esc_html_e('Line Height', 'raffle-play-woo') ?> (px) 
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="number" id="inputLineHeight" 
                                                        value='' >
                                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                                </div>
                                            </div>

                                            <p></p>

                                            <div class="row">
                                                <label for="inputTextSize" class="col-sm-3 col-form-label"> 
                                                    <?php esc_html_e('Text Size', 'raffle-play-woo') ?> (px) 
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="number"  id="inputTextSize"  
                                                        value=''>
                                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                                </div>
                                            </div>

                                            <p></p>

                                            <div class="row">
                                                <label for="inputTextColor" class="col-sm-3 col-form-label"> 
                                                    <?php esc_html_e('Text Color', 'raffle-play-woo') ?> 
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text"  id="inputTextColor"  
                                                        value='' >
                                                        <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    

                                </div>
                                <!-- end of extra -->

                                 <!--  woocommerce account -->
                                <div class="tab-pane fade" id="v-pills-acc" role="tabpanel" 
                                    aria-labelledby="v-pills-acc-tab">   

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                            <b><?php esc_html_e('Enable Raffle Tab in Woocommerce Account', 'raffle-play-woo' );?> </b>
                                            <br />
                                            <i style='font-size: 0.9rem'>
                                                <?php esc_html_e('If Enabled go to Settings ->
                                                     Permalinks and click on Save Changes for the Tab to show up in the Woocommerce Account - Do it once ', 'raffle-play-woo' );?> 
                                            </i>
                                            
                                        </div>

                                        <div class="col-sm-7" >                               
                                            <input type="checkbox" id="show_acc_tab" data-toggle='toggle' 
                                            data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                                            data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" 
                                            <?php 
                                                if( $settings['show_acc_tab'] === 'yes' )
                                                    echo 'checked'; 
                                            ?> 
                                            data-size='small'/>
                                        </div>
                                    </div>

                                    <hr/>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                            <?php esc_html_e('Tab Name', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <input type="text" id="" readonly 
                                                value="<?php esc_html_e('Raffle', 'raffle-play-woo');?>" />
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                            <?php esc_html_e('Tab Location', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" >                                                                          

                                            <select>
                                            <?php 
                                                $tab_raffle_location = array(
                                                    __('Before Dashboard', 'raffle-play-woo'),
                                                    __('Before Order', 'raffle-play-woo'),
                                                    __('Before Downloads', 'raffle-play-woo'),
                                                    __('Before Addresses', 'raffle-play-woo'),
                                                    __('Before Payments Methods', 'raffle-play-woo'),
                                                    __('Before Account Details', 'raffle-play-woo'),
                                                    __('Before Logout', 'raffle-play-woo'),
                                                );
                                                foreach( $tab_raffle_location as $key=>$loc ){
                                                    if( $key == 6 )
                                                        echo "<option selected value='$key'> $loc </option>";
                                                    else
                                                        echo "<option value='$key'> $loc </option>";
                                                }
                                            ?>
                                            </select>
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                            <?php esc_html_e('Content Display - Raffle Tickets', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" >                                                                          
                                            <?php esc_html_e('Show Tickets Grouped by:', 'raffle-play-woo'); ?> <br/>
                                            <select>
                                            <?php 
                                                $tab_raffle_location = array(
                                                    __('Order', 'raffle-play-woo'),
                                                    __('Raffle', 'raffle-play-woo'),
 
                                                );
                                                foreach( $tab_raffle_location as $key=>$loc ){
                                                    echo "<option value='$key'> $loc </option>";
                                                }
                                            ?>
                                            </select>
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>
                                        </div>
                                    </div>

                                </div>
                                <!-- end of test -->

                                
                                <!-- test-->
                                <div class="tab-pane fade d-none" id="v-pills-test" role="tabpanel" aria-labelledby="v-pills-test-tab">                                 
                            
                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                            <?php esc_html_e('Test Ticket Starts At', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <input type="number" id="" readonly 
                                                value="<?php echo esc_html( $settings['test_start_ticket'] ); ?>" />
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>
                                        </div>
                                    </div>
                                    
                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                            <?php esc_html_e('Last Test Ticket', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <input type="number" id="" readonly 
                                                value="<?php echo esc_html( $settings['test_last_ticket'] ); ?>" />
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>
                                        </div>
                                    </div>

                                    <div class='row bmp-set-row' >
                                        <div class="col-sm-5 " > 
                                            <?php esc_html_e('Test Raffle Tickets Purchased', 'raffle-play-woo' );?> 
                                        </div>
                                    
                                        <div class="col-sm-7" >                               
                                            <input type="number" id="test_tickets_purchased" readonly 
                                                value="<?php echo esc_html( $settings['test_tickets_purchased'] ); ?>" />
                                            <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>
                                        </div>
                                    </div>

                                </div>
                                <!-- end of test -->

                                 <!-- shortcode -->
                                <div class="tab-pane fade" id="v-pills-shortinfo" role="tabpanel" aria-labelledby="v-pills-shortinfo-tab">  
                                    <p>
                                        <b>
                                            <?php esc_html_e('Only in Premium version', 'raffle-play-woo');  RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                        </b>
                                    </p>
                                            <div class='row bmp-set-row d-none' >
                                                <div class="col-sm-5 " > 
                                                    <?php esc_html_e('Shortcode Info Raffle Data', 'raffle-play-woo' );?> 
                                                </div>

                                                <div class="col-sm-7" >                               
                                                    <input type="text" id="" readonly style='width: 400px;'
                                                        value="[raffle name='info' id='0' productid='' tags='']" />
                                                </div>
                                            </div>

                                            <div class='row bmp-set-row' >
                                                <div class="col-sm-12" > 
                                                    <p><?php esc_html_e('With this shortcode you can retrieve the primary attributes of any raffle. 
                                                                    It can be used to display raffle information or integrate it with other plugins. Check the link below to the youtube video.', 'raffle-play-woo' );?> </p>

                                                    <p> productid="55" (product id = 55) <?php esc_html_e(' is optional, if productid is added, the raffle linked to that product will be retrieved.', 'raffle-play-woo' );?> </p>
                                                    <p> tags="custom-code1, custom-code2" <?php esc_html_e(' is optional, used to filter the code, if the shortcode is present in multiple pages (Dedicated keyword. Do not use keyword ".', 'raffle-play-woo' );?>product") </p>
                                                    <p> <?php echo( sprintf( __('Watch explanation %s and %s on this youtube videos I made', 'raffle-play-woo' ), 
                                                                "<a href='https://youtu.be/o_8aZ4IV9XE' target='_blank'> HERE One </a>",
                                                                "<a href='https://youtu.be/FW8LdN85ujc' target='_blank'> HERE Two </a>" )); ?> </p>
                                                    <p> <?php echo( sprintf( __('The code with other plugin integration is found ', 'raffle-play-woo' ), "<a href='https://tuskcode.com/version-5-6-2/' target='_blank'> HERE </a>" )); ?> </p>
                                                    <p><?php esc_html_e('1. Copy the shortcode and paste it in the page/post/etc', 'raffle-play-woo' );?> </p>
                                                    <p><?php esc_html_e('2. In the functions.php of your child theme add following filter hook', 'raffle-play-woo' );?> </p>
<pre> 
<code> 
add_filter('raffle_info_filter', 'funct_raffle_filter', 10, 2 );
function funct_raffle_filter( $content, $raffle_obj ){
// $raffle_obj is of type associative array and it has the following keys
// $raffle_id           = $raffle_obj['raffle_id'];         //raffle id
// $raffle_name         = $raffle_obj['raffle_name'];       //raffle name
// $start_ticket        = $raffle_obj['start_ticket'];      //raffle starting number
// $limit_tickets       = $raffle_obj['limit_tickets'];     //number of total tickets if not 'unlimited', else number
// $sold_tickets        = $raffle_obj['sold_tickets'];      //number of sold tickets
// $last_sold_ticket    = $raffle_obj['last_sold_ticket'];  //last sold ticket
// $last_sold_prefixed  = $raffle_obj['last_sold_prefixed'];    //last sold with prefix
// $prefix              = $raffle_obj['prefix'];            //prefix 
// $start_datetime      = $raffle_obj['start_datetime'];    //1690911878, 0
// $end_datetime        = $raffle_obj['end_datetime'];      //1690921878
// $start_date_string   = $raffle_obj['start_date_string']; //Tue, 01 Aug 2023 17:44:36 GMT
// $end_date_string     = $raffle_obj['end_date_string'];
// $is_terminated       = $raffle_obj['is_terminated'];     // true/false
// $is_raffle           = $raffle_obj['is_raffle']; 
// productid            = $raffle_obj['productid'];
// tags                 = $raffle_obj['tags'];

$content = "Today is a great day.";

return $content;
}
</code> 
</pre>
                                                
                                                </div>


                                            </div>

                                </div>
                                <!-- end of shortcode -->

                            <!-- countdown -->
                        <div class="tab-pane fade" id="v-pills-countdown" role="tabpanel" aria-labelledby="v-pills-countdown-tab">                                 
                            
                            <h5>                                        
                                <?php
                                    esc_html_e('Customize Countdown', 'raffle-play-woo');
                                ?>                                  
                            </h5>  
                            
                            <p>
                                <b>
                                    <?php esc_html_e('Only in Premium version', 'raffle-play-woo');  RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                </b>
                            </p>
                            <div>
                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Display Countdown on Product Page', 'raffle-play-woo' );?> 
                                    </div>
                                
                                    <div class="col-sm-7" >      
                                        <select name="countdown_pos" id="countdown_pos">                       
                                            <?php

                                                $options = array(
                                                    'woocommerce_before_single_product' 		=> esc_html__('Before Single Product', 'raffle-play-woo'),
                                                    'woocommerce_before_single_product_summary' => esc_html__('Before Single Product Summary', 'raffle-play-woo'),
                                                    'woocommerce_single_product_summary' 		=> esc_html__('Top of Single Product Summary', 'raffle-play-woo'),
                                                    'woocommerce_before_add_to_cart_form' 		=> esc_html__('Before Add to Cart Form', 'raffle-play-woo'),
                                                    'woocommerce_before_variations_form'        => esc_html__('Before Variations Form', 'raffle-play-woo'),
                                                    'woocommerce_before_add_to_cart_button'     => esc_html__('Before Add to Cart Button', 'raffle-play-woo'),
                                                    'woocommerce_before_single_variation'     	=> esc_html__('Before Single Variation', 'raffle-play-woo'),
                                                    'woocommerce_before_single_variation'    	=> esc_html__('Before Single Variation', 'raffle-play-woo'),
                                                    'woocommerce_before_add_to_cart_quantity' 	=> esc_html__('Before Add to Cart Quanitity', 'raffle-play-woo'),
                                                    'woocommerce_after_add_to_cart_quantity' 	=> esc_html__('After Add to Cart Quanitity', 'raffle-play-woo'),
                                                    'woocommerce_after_add_to_cart_button'      => esc_html__('After Add to Cart Button', 'raffle-play-woo'),
                                                    'woocommerce_after_add_to_cart_form'        => esc_html__('After Add to Cart Form', 'raffle-play-woo'),
                                                    'woocommerce_after_single_product_summary'  => esc_html__('After Single Product Summary', 'raffle-play-woo')
                                                );

                                                foreach( $options as $key => $val ){  
                                                    echo "<option value='$key'> $val </option>";                                               
                                                }
                                            ?>
                                        </select>  
                                        <span>
                                            <?php echo sprintf( esc_html__('View Positions %s', 'raffle-play-woo'), '<a href="https://www.businessbloomer.com/woocommerce-visual-hook-guide-single-product-page" target="_blank">' . 
                                                        esc_html__('Here', 'raffle-play-woo') . '</a>'); ?>
                                        </span>
                                        <p style='font-size:.8rem'>
                                            <i>
                                                <?php esc_html_e('The countdown does not show in the position you have selected? Some themes change the position of hooks with different style or html applied to the page.', 'raffle-play-woo' );?> 
                                            </i>
                                        </p>
                                    </div>
                                </div>

                                <div class='row bmp-set-row' >
                                        <div class="col-sm-5" style='display: inline-block'> 
                                            <label for="countdown_hide_cart"> <?php esc_html_e('Hide "Add To Cart" Button', 'raffle-play-woo' );?> </label>
                                            <br/>
                                            <i><span style='font-size: .9rem;'> (<?php esc_html_e("If Raffle hasn't started, or it's finished", 'raffle-play-woo' );?>)</span></i>
                                        </div>
                                    
                                        <div class="col-sm-7" style=''>       
                                            <div class="checkbox disabled">                        
                                                <input type="checkbox"  data-toggle="toggle" data-size='small' 
                                                    id='countdown_hide_cart'
                                                    data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"  
                                                    data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" />       
                                            </div>
                                        </div>
                                    </div>
                                
                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Background Color', 'raffle-play-woo' );?> 
                                    </div>
                                
                                    <div class="col-sm-7" >                               
                                        <input type="text" id="countdown_bg"  value="#fff" readonly />
                                    </div>
                                </div>

                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Color', 'raffle-play-woo' );?> 
                                    </div>
                                
                                    <div class="col-sm-7" >                               
                                        <input type="text" id="countdown_color"  value="black" readonly />
                                    </div>
                                </div>

                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Days Label', 'raffle-play-woo' );?> 
                                    </div>
                                
                                    <div class="col-sm-7" >                               
                                        <input type="text" id="countdown_days"  value="Days" readonly />
                                    </div>
                                </div>

                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Hours Label', 'raffle-play-woo' );?> 
                                    </div>
                                
                                    <div class="col-sm-7" >                               
                                        <input type="text" id="countdown_hours"  value="Hours" readonly />
                                    </div>
                                </div>

                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Minutes Label', 'raffle-play-woo' );?> 
                                    </div>
                                
                                    <div class="col-sm-7" >                               
                                        <input type="text" id="countdown_mins"  value="Minutes" readonly />
                                    </div>
                                </div>

                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Seconds Label', 'raffle-play-woo' );?> 
                                    </div>
                                
                                    <div class="col-sm-7" >                               
                                        <input type="text" id="countdown_secs"  value="Seconds" readonly />
                                    </div>
                                </div>


                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Starts In Label', 'raffle-play-woo' );?> 
                                    </div>
                                
                                    <div class="col-sm-7" >                               
                                        <input type="text" id="countdown_starts"  value="The Raffle Starts in" readonly />
                                    </div>
                                </div>

                                <div class='row bmp-set-row' >
                                    <div class="col-sm-5 " > 
                                        <?php esc_html_e('Ends In Label', 'raffle-play-woo' );?> 
                                    </div>
                                
                                    <div class="col-sm-7" >                               
                                        <input type="text" id="countdown_ends"  value="The Raffle Ends in" readonly />
                                    </div>
                                </div>

                                <hr />

                                <p>
                                    <?php esc_html_e('The above settings are used to display the raffle countdown in the product page', 'raffle-play-woo' );?> 
                                </p>

                                <p>
                                    <?php esc_html_e('Do you want to display a countdown in the home page? or any other page?', 'raffle-play-woo' );?> 
                                </p>

                                <p>
                                 <?php esc_html_e('Here is an example on how to display a custom counter on any page with tuskcode countdwon', 'raffle-play-woo' );?> 
                                   <?php
                                        echo 'TUSKCODE_RAFFLE_COUNTDOWN';
                                   ?>
                                </p>
                        
<code>
<textarea rows='10' style='width: 100%;' editable='false' readonly>
<?php echo "[TUSKCODE_RAFFLE_COUNTDOWN
datetime='2025-12-25 00:00:00'
Bgcolor='red' 
'color='#fff' 
days='DD'
hours='HH'
minutes='MM'
seconds='SS'.
header='Days left until Christmas 2025']";

?>
</textarea>
</code>

                                <p>
                                    <?php esc_html_e('How it works.', 'raffle-play-woo' );?> 
                                </p>

                                <p>
                                    <?php esc_html_e('Copy the shortcode on any page or post, and change the values. Datetime can be of timestamp or format yyyy-mm-dd hh:mm:ss. Color and bgcolor can be of hex or rgb. The rest are just labels.', 'raffle-play-woo' );?> 
                                </p>
                            

                            </div>

                        </div>
                        <!-- end of countdown -->

                        <!-- progress bar-->
                        <div class="tab-pane fade" id="v-pills-progressbar" role="tabpanel" aria-labelledby="v-pills-progressbar-tab">                                 
                            <h5>                                        
                                <?php
                                    esc_html_e('Customize Progress Bar', 'raffle-play-woo');
                                ?>
                            </h5> 

                            <p>
                                <b>
                                    <?php esc_html_e('Only in Premium version', 'raffle-play-woo');  RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
                                </b>
                            </p>

                            <div class='row bmp-set-row' >
                                <div class="col-sm-5 " > 
                                    <?php esc_html_e('Hide Progress Bar if the product is not purchasable', 'raffle-play-woo'); ?> <br/>
                                    <i>
                                        <?php esc_html_e('eg: raffle is terminated, raffle hasn\'t started, raffle has ended', 'raffle-play-woo' );?> 
                                    </i>
                                    <span data-toggle='tooltip' 
                                        title="<?php esc_html_e('Progress Bar would be hidden if the raffle not running.', 'raffle-play-woo' ); ?>" > 
                                        <i class="fa fa-info-circle text-info"></i> 

                                    </span>
                                </div>
                            
                                <div class="col-sm-7" >                               
                                    <input type="checkbox" id="pb_hide" data-toggle='toggle' data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                                    data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" readonly data-size='small'/>
                                </div>
                            </div>

                            <div class='row bmp-set-row' >
                                <div class="col-sm-5 " > 
                                    <?php esc_html_e('Show Progress Bar only for limited raffle tickets', 'raffle-play-woo'); ?> <br/>
                                    <i>
                                        <?php esc_html_e('eg: Raffle has 1000 tickets available, the progress will show.', 'raffle-play-woo' );?> 
                                    </i>

                                </div>
                            
                                <div class="col-sm-7" >                               
                                    <input type="checkbox" id="pb_only_limited" data-toggle='toggle' readonly data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                                    data-off="<?php esc_html_e('No', 'raffle-play-woo');?>"  data-size='small'/>
                                </div>
                            </div>
                          
                            <div class='row bmp-set-row' >
                                <div class="col-sm-5 " style='display: inline-block'> 
                                    <?php esc_html_e('Text to display', 'raffle-play-woo' );?> 
                                </div>                                    
                            
                                <div class="col-sm-7">  
                                    <input type="text" id="pb_text" readonly style='width: 100%' value="[sold]/[total] - tickets left [remaining]" />
                                    <p> <b> [sold] </b> - <?php esc_html_e(' keyword to display sold tickets'); ?></p>
                                    <p> <b> [total] </b> - <?php esc_html_e(' keyword for total number of tickets'); ?></p>
                                    <p> <b> [remaining] </b> - <?php esc_html_e(' keyword for remaining tickets'); ?></p>
                                    <p> <?php esc_html_e('The keywords will be replaced with the numbers when displayed', 'raffle-play-woo'); ?> </p>
                                    <p> <b> <?php esc_html_e('eg: 20/100 tickets sold - 80 left', 'raffle-play-woo'); ?> </b> </p>
                                </div>
                            </div>

                            <div class='row bmp-set-row' >
                                <div class="col-sm-5 " style='display: inline-block'> 
                                    <?php esc_html_e('Text Color', 'raffle-play-woo' );?> 
                                </div>                                    
                            
                                <div class="col-sm-7">  
                                    <input type="text" id="pb_color" readonly value="rgba(234,234,212, 0.5)" />
                                </div>
                            </div>

                            <div class='row bmp-set-row' >
                                <div class="col-sm-5 " style='display: inline-block'> 
                                    <?php esc_html_e('Progress Bar Color', 'raffle-play-woo' );?> 
                                </div>                                    
                            
                                <div class="col-sm-7">  
                                    <input type="text" id="pb_bar_color" readonly value="blue" />
                                </div>
                            </div>

                            <div class='row bmp-set-row' >
                                <div class="col-sm-5 " style='display: inline-block'> 
                                    <?php esc_html_e('Background Color', 'raffle-play-woo' );?> 
                                </div>                                    
                            
                                <div class="col-sm-7">  
                                    <input type="text" id="pb_bg_color" readonly  value="#000" />
                                </div>
                            </div>

                            <div class='row bmp-set-row' >
                                <div class="col-sm-5 " style='display: inline-block'> 
                                    <?php esc_html_e('Custom HTML classes', 'raffle-play-woo' );?> <br/>
                                    <span> &#x1F6C8 <i> <?php esc_html_e('Use spaces as delimiter', 'raffle-play-woo' );?> </i> &#x1F6C8</span>
                                </div>                                    
                            
                                <div class="col-sm-7">  
                                    <input type="text" id="pb_html_class" readonly style='width: 100%' value='custom-class' />
                                </div>
                            </div>

                            <div class='row bmp-set-row' >
                                <div class="col-sm-5 " style='display: inline-block'> 
                                    <?php esc_html_e('Custom Progress Bar Shortcode', 'raffle-play-woo' );?> <br/>
                                    
                                </div>                                    
                            
                                <div class="col-sm-7">  
                                    <p><?php esc_html_e('You can place custom progress bar on any page with the following shortcode - if options left empty will pick the default setting set above.', 'raffle-play-woo'); ?></p>
                                    <p> <?php esc_html_e( 'Optional settings');?></p>
                                    <ul>
                                        <li> <p> <b> raffle_id="0" </b>  - <?php esc_html_e('Raffle id, swap 0 to your desired raffle id', 'raffle-play-woo');?> </p></li>
                                        <li> <p> <b> bar_color="red"</b> - <?php esc_html_e('Bar color of the progress, text, hex, rgb, and rgba accepted.', 'raffle-play-woo');?> </p></li>
                                        <li> <p> <b> bg_color="rgba(100, 200, 100, 0.3)" </b> -
                                                <?php esc_html_e('Background color of the progress, text, hex, rgb, and rgba accepted.', 'raffle-play-woo');?>
                                            <p>
                                        </li>
                                        <li> <p> <b> text="Sold %sold% - Percentage %percentage% - Remaining %remaining% - Total %total%" </b> -
                                            <?php esc_html_e('Text to display, for shortcode use the following text replaces', 'raffle-play-woo');?>
                                            </p>
                                        </li>
                                        <li> <p> <b> html_class="custom-class" </b> - <?php esc_html_e('Custom html class', 'raffle-play-woo');?> </p> </li>
                                        
                                    </ul>
                                    <code>
                                        [RAFFLE_PROGRESSBAR raffle_id="0" bar_color="red" bg_color="rgba(100, 200, 100, 0.3)" text="Sold %sold% - Percentage %percentage% - Remaining %remaining% - Total %total%" html_class="custom-class"]  
                                    </code>
                                </div>
                            </div>
                            

                        </div>
                        <!-- end of progress bar-->

                        <!-- Generate Raffle Tickets at Checkout -->
                        <?php include_once( 'main/W_RafflePlayWoo_Main_GenCheckout.php'); ?>
                        <!-- end of generate raffle tickets at checkout -->

                        <!-- Generate Raffle Tickets at Checkout -->
                        <?php include_once( 'main/W_RafflePlayWoo_Main_SearchTickets.php'); ?>
                        <!-- end of generate raffle tickets at checkout -->

                        <!-- Generate Raffle Tickets at Checkout -->
                        <?php include_once( 'main/W_RafflePlayWoo_Main_ProductTab.php'); ?>
                        <!-- end of generate raffle tickets at checkout -->

                        <!-- User Picks tickets at checkout -->
                        <?php include_once( 'main/W_RafflePlayWoo_Main_UserPicks.php'); ?>
                        <!-- end of User Picks tickets at checkout -->


                            </div>
                        </div>
                    </div>

                   
                    <input type='submit' class="button button-primary rdp_save_settings" value="<?php esc_html_e('Save', 'raffle-play-woo' );?>" />  
                  

            </div> <!-- /container-fluid -->
        </div> <!-- /wrap -->

      <?php  
    }
}