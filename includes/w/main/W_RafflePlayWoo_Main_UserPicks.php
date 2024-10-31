<?php
    if( ! defined( 'ABSPATH') ) die('No Access here');
    include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/RafflePlayWoo_Includes.php');
?>


<!-- product raffle tab-->
<div class="tab-pane fade" id="v-pills-userpickstab" role="tabpanel" aria-labelledby="v-pills-userpickstab-tab">                                 
    <h5>                                        
        <?php
            esc_html_e('User Picks Tickets at Checkout', 'raffle-play-woo');           
        ?>
    </h5> 
    <p>
        <?php 
            esc_html_e('Only in Premium version', 'raffle-play-woo');
            \RafflePlayWoo_Includes\RafflePlayWoo_Includes::rpwoo_premium_image();
        ?>
    </p>

    <span>
        <i>
            <a href="https://youtu.be/34FZ7mUxUy0" target='_blank'>
                <?php esc_html_e('Watch setup video here', 'raffle-play-woo'); ?> 
            </a>
        </i> 
    </span>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Show Max number of Tickets per page', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="userpicklbl_max_show_no" style='width: 100px'
                value="100"
            />           
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Text Search Buton', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="userpicklbl_search_btn" style='width: 100%'
                value="Search"
            />           
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Text Placeholder Search Input', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="userpicklbl_placeholder_search_input" style='width: 100%'
                value="Search Input"
            />           
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Text Change To', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="userpicklbl_change_to" style='width: 100%'
                value="change to"
            />           
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Text Change Button', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="userpicklbl_change_btn" style='width: 100%'
                value="Change"
            />           
        </div>
    </div>


    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Text Changing Action Button', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="userpicklbl_changing_btn" style='width: 100%'
                value="Changing... Please Wait"
            />           
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Text Previous Button', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="userpicklbl_prev_btn" style='width: 100%'
                value="Previous %s"
            />           
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Text Next Button', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="userpicklbl_next_btn" style='width: 100%'
                value="Next %s"
            />           
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Text Cancel Button', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="userpicklbl_cancel_btn" style='width: 100%'
                value="Cancel"
            />           
        </div>
    </div>


    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Text Loading Available Tickets', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="userpicklbl_loading_msg" style='width: 100%'
                value="Loading Available Tickets"
            />           
        </div>
    </div>  


    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Text Tickets not found', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="userpicklbl_not_found_msg" style='width: 100%'
                value="No tickets found"
            />           
        </div>
    </div> 

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Text No ticket selected', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="userpicklbl_no_ticket_selected_msg" style='width: 100%'
                value="Please select a ticket"
            />           
        </div>
    </div> 

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Text Ticket not available anymore', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="userpicklbl_not_available_anymore" style='width: 100%'
                value="Sorry, ticket not available anymore. Taken."
            />           
        </div>
    </div> 


</div>
<!-- end of product raffle tab -->