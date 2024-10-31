<?php

include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/RafflePlayWoo_Includes.php');

if( ! defined('ABSPATH') )
    die('No Access to this page');

use RafflePlayWoo_Includes\RafflePlayWoo_Includes as RafflePlayWoo_Includes;

?>


<!-- product raffle tab-->
<div class="tab-pane fade" id="v-pills-producttab" role="tabpanel" aria-labelledby="v-pills-producttab-tab">                                 
    <h5>                                        
        <?php
            esc_html_e('Product Raffle Tab - Show last orders with sold tickets and customer info', 'raffle-play-woo');
        ?>
    </h5> 

    <p>
        <?php esc_html_e('Only in Premium version', 'raffle-play-woo');  RafflePlayWoo_Includes::rpwoo_premium_image(); ?> 
    </p>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Show Product Raffle Tab', 'raffle-play-woo'); ?>
        </div>
    
        <div class="col-sm-7" >                               
            <input type="checkbox" id="product_raffle_tab" 
                data-toggle='toggle' 
                data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" 
                data-size='small'/>
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Show Table as Data Table', 'raffle-play-woo'); ?> <br/>
            <span>
                <?php esc_html_e('Data Table is displayed with search, column sorting, pagination', 'raffle-play-woo'); ?> 
            </span> <br/>

            <span>
                <?php echo sprintf( '<a href="https://datatables.net/" target="_blnak"> %s </a>', esc_html__('View more here', 'raffle-play-woo') ); ?> 
            </span>

        </div>
    
        <div class="col-sm-7" >                               
            <input type="checkbox" id="prt_show_data_table" 
                data-toggle='toggle' 
                data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" 
                data-size='small'/>
        </div>
    </div>  

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Tab Name', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="prt_tab_name" style='width: 100%'
                value="Last Sold Tickets"
            />           
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Priority', 'raffle-play-woo'); ?>      
            <br/>

            <span style='font-size: .7rem'> 
                <i>
                    <?php esc_html_e('Order of the tab, 5 will be the first tab shown, 15 will be second, and so on', 'raffle-play-woo'); ?> 
                </i>
            </span>

        </div>
    
        <div class="col-sm-7" >                               
            <input type="number" id="prt_priority" min='1' style='max-width: 70px';
                value="5"
            />             
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Show Last Orders (limit)', 'raffle-play-woo'); ?>   <br/>
            <i><?php esc_html_e('(use -1 for unlimited)', 'raffle-play-woo'); ?> </i> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="number" id="prt_show_last_orders" min='1' style='max-width: 70px';
                value="10"
            />         
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Show Customer Name', 'raffle-play-woo'); ?>
        </div>
    
        <div class="col-sm-7" >                               
            <input type="checkbox" id="prt_show_customer_name" 
                data-toggle='toggle' 
                data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" 
                checked data-size='small'/>
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Show Customer City', 'raffle-play-woo'); ?>
        </div>
    
        <div class="col-sm-7" >                               
            <input type="checkbox" id="prt_show_customer_city" 
                data-toggle='toggle' 
                data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" 
                checked data-size='small'/>
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Show Customer Country', 'raffle-play-woo'); ?>
        </div>
    
        <div class="col-sm-7" >                               
            <input type="checkbox" id="prt_show_customer_country" 
                data-toggle='toggle' 
                data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" 
                checked data-size='small'/>
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Show Purchased at', 'raffle-play-woo'); ?>
        </div>
    
        <div class="col-sm-7" >                               
            <input type="checkbox" id="prt_show_purchased_at" 
                data-toggle='toggle' 
                data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" 
                checked data-size='small'/>
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Label Tickets', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="prt_lbl_tickets" style='width: 100%'
                value="Tickets Sold"
            />           
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Label Customer Name', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="prt_lbl_customer_name" style='width: 100%'
                value="Customer Name"
            />           
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Label Customer City', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="prt_lbl_city" style='width: 100%'
                value="City"
            />           
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Label Customer Country', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="prt_lbl_country" style='width: 100%'
                value="Country"
            />           
        </div>
    </div>

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Label Purchased', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="prt_lbl_purchased" style='width: 100%'
                value="Purchased At"
            />           
        </div>
    </div>  

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Sold Time Hours ago (less than 24 hours)', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="prt_sold_time_hours" style='width: 100%'
                value="%s hours ago"
            />           
        </div>
    </div>  

    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Sold Time Minutes ago (less than 1 hour)', 'raffle-play-woo'); ?> 
        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="prt_sold_time_mins" style='width: 100%'
                value="%s minutes ago"
            />           
        </div>
    </div>  


    <div class='row bmp-set-row' >
        <div class="col-sm-5 " > 
            <?php esc_html_e('Custom display on any page the latest raffle tickets sold', 'raffle-play-woo'); ?> <br/>

        </div>
    
        <div class="col-sm-7" >                               
            <input type="text" id="shortcode_prt" style='width: 100%' readonly
                value='[RAFFLE_PRODUCT_TAB raffle_id="1" limit="5" data_table="no" type="identifier"]'
            />   
            <p></p>
            <code>raffle_id</code>            
            <i><?php esc_html_e('Add raffle id, only to display tickets sold for that raffle', 'raffle-play-woo'); ?> <br/></i>

            <code>limit</code>            
            <i><?php esc_html_e('Limit or rows to display (use -1 for unlimited rows)', 'raffle-play-woo'); ?> <br/></i>

            <code>data_table</code>   yes/no -       
            <i><?php esc_html_e('display table as data table', 'raffle-play-woo'); ?> <br/></i>
            
            <code>type</code>
            <i><?php esc_html_e('Unique identifier for the shortcode', 'raffle-play-woo'); ?> <br/></i>
        </div>
    </div> 



</div>
<!-- end of product raffle tab -->