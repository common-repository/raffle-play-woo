<?php

include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/RafflePlayWoo_Includes.php');

if( ! defined('ABSPATH') )
    die('No Access to this page');

use RafflePlayWoo_Includes\RafflePlayWoo_Includes as RafflePlayWoo_Includes;

?>


<!-- progress bar-->
<div class="tab-pane fade" id="v-pills-user_search" role="tabpanel" aria-labelledby="v-pills-user_search-tab">                                 
    <h5>                                        
        <?php
            esc_html_e('Customers can search for their tickets', 'raffle-play-woo');
        ?>
    </h5> 

    <p>
        <?php esc_html_e('Only in Premium version', 'raffle-play-woo');  RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
    </p>
    
    <p>
        <?php
            esc_html_e('Create a custom shortcode and show it on a page', 'raffle-play-woo');
        ?>
    </p>

    <p>
        <?php
            esc_html_e('Watch setup video', 'raffle-play-woo'); 
        ?>

        <a href="https://youtu.be/qxvpwwxAcsY" target='_blank'> 
            <?php
                esc_html_e('HERE', 'raffle-play-woo'); 
            ?>    
        </a>         
    </p>


    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Search By', 'raffle-play-woo'); ?>  
            
            <br />

            <span style='font-size: 0.7rem;'>
                <i>
                    <?php esc_html_e('Recommended to have at least search on by email and order id', 'raffle-play-woo'); ?>
                </i>
            </span>

            <br />

            <span style='font-size: 0.7rem;'>
                <i>
                    <?php esc_html_e('Below selected must match the order data to show the tickets', 'raffle-play-woo'); ?>
                </i>
            </span>
        
        </div>

        <div class="col-sm-7" >   
            
            <label for="searchby_email">
                <input type="radio" name="search_by_type" id="searchby_email" checked >

                <?php esc_html_e('Email', 'raffle-play-woo');?>

            </label>


            <p> </p>
            
            <p>
                <?php esc_html_e("OR", 'raffle-play-woo');?>
            </p>

            <label for="searchby_phone">
                <input type="radio" name="search_by_type" id="searchby_phone" >

                <?php esc_html_e('Phone Number', 'raffle-play-woo');?>
                <span class='text-success'> (new)</span>

            </label>

            <p></p>

            <hr/>

            <p>
                <?php esc_html_e("AND", 'raffle-play-woo');?>
            </p>

            <label for="searchby_order_id">
                <input type="checkbox" name="" id="searchby_order_id" checked>

                <?php esc_html_e('Order Id', 'raffle-play-woo');?>
            
            </label>


            <p></p>

            <p>
                <?php esc_html_e("AND", 'raffle-play-woo');?>
            </p>

            <label for="searchby_first_name">
                <input type="checkbox" name="" id="searchby_first_name">

                <?php esc_html_e('First Name', 'raffle-play-woo');?>
            
            </label>

            <p></p>

            <p>
                <?php esc_html_e("AND", 'raffle-play-woo');?>
            </p>

            <label for="searchby_last_name">
                <input type="checkbox" name="" id="searchby_last_name">

                <?php esc_html_e('Last Name', 'raffle-play-woo');?>
            
            </label>

        </div>
    </div>



    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('No tickets found message', 'raffle-play-woo'); ?>  
            
            <br />

            <span style='font-size: 0.7rem;'>
                <i>
                    <?php esc_html_e('Display message when no tickets found', 'raffle-play-woo'); ?>
                </i>
            </span>

            <br />
        
        </div>
    
        <div class="col-sm-7" >                               
                <input type="text" name="" id="user_search_no_found" style='width: 100%;'
                    value="<?php esc_html_e('No Raffle Tickets found on this search', 'raffle-play-woo'); ?>"
                />        
        </div>
    </div>   
    
    
    <div class='row bmp-set-row' >

        <div class="col-sm-5 " > 
            <?php esc_html_e('Shortcode Generated', 'raffle-play-woo'); ?>  
            
            <br />

            <span style='font-size: 0.7rem;'>
                <i>
                    <?php esc_html_e('Copy the shortcode and paste it in the page. (Enter unique shortcode id)', 'raffle-play-woo'); ?>
                </i>
            </span>

            <br />
        
        </div>
    
        <div class="col-sm-7" >                               
   
        </div>

        <p></p>

        <p>
            <button class='button button-secondary btn-copy-shortcode' style='width: 150px;'> 
                <?php esc_html_e('Copy Shortcode', 'raffle-play-woo');?>
            </button>

            <input type="text" name="" id="search_shortcode_id" value='11' style='width: 70px;' />
            <?php esc_html_e('Shortcode Id - Enter unique id for this shortcode before copy', 'raffle-play-woo'); ?>

        </p>

        <input type="text" name="" id="user_search_shortcode" style='width: 100%;'
                    value='[RAFFLE_SEARCH id="303" search_by="order_id,email" not_found_lbl="No Raffle Tickets found on this search"]' readonly
                />     
    </div>  

</div>
<!-- end of progress bar-->