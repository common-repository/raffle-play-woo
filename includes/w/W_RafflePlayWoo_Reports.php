<?php

namespace W_RafflePlayWoo_Reports;

require_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/RafflePlayWoo_Includes.php');

if( ! defined('ABSPATH') )
    die('No Access to this page');

use RafflePlayWoo_Includes\RafflePlayWoo_Includes as RafflePlayWoo_Includes;

class RafflePlayWoo_Front{

    public static function drp_reports_html( $settings ){

        RafflePlayWoo_Includes::rpwoo_loading_screen();

        
        $date_format = array(
            'dd/mm/yyyy',
            'yyyy/mm/dd',          
            'dd-mm-yyyy',
            'yyyy-mm-dd',
            'dd/mm/yy',           
            'dd-mm-yy',           
            'yy/mm/dd',           
            'yy-mm-dd'            
        );
        
        ?>
            <div class='wrap drp-reports'>
                <div class="container-fluid ">
                    <form method="POST" >
                        <div class="panel panel-default" id='panel_reports'>
                            <div class="panel-heading">                  
                                <h4 class='d-inline'> <?php esc_html_e('Reports', 'raffle-play-woo');?></h4>
                                <span class='d-inline'> <?php esc_html_e('(live data)', 'raffle-play-woo');?></span>   
                                <?php RafflePlayWoo_Includes:: rpwoo_premium_link(); ?>                                           
                            </div>
                            <p></p>

                            <div class="panel-body">
                                <div class='bmp-set-row' >

                                        <div id="div_order_raffles" class='bmp-set-row' >
                                            <h5> <b> <?php esc_html_e('Raffle', 'raffle-play-woo');?> </b> 
                                                <?php
                                                    echo RafflePlayWoo_Includes::rpwoo_create_dropdown( $settings['raffles'], 'raffles_list' );                                                                                      
                                                ?>
                                            </h5>
                                            
                                           
                                        </div>

                                        <div  class='bmp-set-row'>
                                            <div style='display: inline-block;' >
                                                <label for="drp_date_from" >  <?php esc_html_e('From Date', 'raffle-play-woo'); ?></label>
                                                <input type='text' disabled name="drp_date_from" class='input-dates' id="drp_date_from" />
                                                
                                            </div>

                                            <div style='display: inline-block;' >
                                                <label for="drp_date_to" >  <?php esc_html_e('To', 'raffle-play-woo'); ?></label>
                                                <input type='text' name="drp_date_to" class='input-dates' disabled id="drp_date_to" />                                               
                                            </div>

                                            <button class='button button-secondary' id="rpr_clear_dates">
                                                <i class="fa fa-broom" title="<?php esc_html_e('Clear Dates', 'raffle-play-woo'); ?>"></i>
                                            </button>
                                          
                                        </div>

                                        <p></p>
                                         
                                        <label for="drp_radio_sales_day" class='bmp-set-row'>
                                            <input type='radio' checked name="drp_radio_report" disabled value='1' id="drp_radio_sales_day" />
                                            <?php esc_html_e('Daily Sales', 'raffle-play-woo'); ?>
                                            <?php RafflePlayWoo_Includes:: rpwoo_premium_image(); ?>
                                        </label>
                                        <p></p>  

                                        <label for="drp_radio_sales_weekly" class='bmp-set-row'>
                                            <input type='radio'  name="drp_radio_report" value='2' disabled id="drp_radio_sales_weekly" />
                                            <?php esc_html_e('Weekly Sales', 'raffle-play-woo'); ?>                                        
                                            <?php echo '<i> '; esc_html_e('(Monday to Sunday)', 'raffle-play-woo'); echo '</i>' ?>
                                            <?php RafflePlayWoo_Includes:: rpwoo_premium_image(); ?>
                                        </label>
                                        <p></p>  

                                        <label for="drp_radio_sales_monthly" class='bmp-set-row'>
                                            <input type='radio'  name="drp_radio_report" value='3' disabled id="drp_radio_sales_monthly" />
                                            <?php esc_html_e('Monthly Sales', 'raffle-play-woo'); ?>
                                            <?php RafflePlayWoo_Includes:: rpwoo_premium_image(); ?>
                                        </label>
                                        <p></p>     

                                        <label for="drp_radio_sales_region" class='bmp-set-row'>
                                            <input type='radio' name="drp_radio_report" disabled value='4' id="drp_radio_sales_region"/>
                                            <?php esc_html_e('Sales by Region/County', 'raffle-play-woo'); ?>
                                            <?php RafflePlayWoo_Includes:: rpwoo_premium_image(); ?>
                                        </label>                                    
                                        <p></p>

                                        <label for="drp_radio_sales_country" class='bmp-set-row'>
                                            <input type='radio' name="drp_radio_report" disabled value='5' id="drp_radio_sales_country"/>
                                            <?php esc_html_e('Sales by Country&County', 'raffle-play-woo'); 
                                                echo "<span class='spacer'></span>";
                                                echo "<select name='country_selected' id='countries_list'>";
                                                echo "<option value='all'>". esc_html__('All', 'raffle-play-woo' ) . "</option>";

                                                foreach( $settings['countries'] as $key=>$country ){
                                                    $selected = '';
                                                    if( $key == $settings['base_country'] ){
                                                        $selected = 'selected';
                                                    }
                                                    echo "<option {$selected} value='{$key}'> {$country} </option>";
                                                }  

                                                echo "</select>";                                               
                                                
                                            ?> 
                                             <?php RafflePlayWoo_Includes:: rpwoo_premium_image(); ?>
                                        </label>   
                                        <br/>              
                                        <label style="margin-left: 75px; margin-top: 10px;" class='bmp-set-row' for="other_countries">
                                                <?php 
                                                    esc_html_e( ' Include the rest of the Countries ', 'raffle-play-woo' );
                                                ?>
                                                <input type="checkbox" name="group_country" id="other_countries" />
                                           
                                                <?php esc_html_e( '(grouped by country)'); ?>
                                        </label>                   
                                        <p></p>

                                        <label for="drp_radio_sales_ticket" class='bmp-set-row'>
                                            <input type='radio' disabled name="drp_radio_report" value='6' id="drp_radio_sales_ticket" /> 
                                            <?php esc_html_e('Sales by Product', 'raffle-play-woo'); ?> 
                                            <?php RafflePlayWoo_Includes:: rpwoo_premium_image(); ?>
                                        </label>
                                        <p></p>   

                                        <label for="drp_radio_raffle_ticket" class='bmp-set-row'>
                                            <input type='radio' disabled name="drp_radio_report" value='7' id="drp_radio_raffle_ticket" /> 
                                            <?php esc_html_e('By Raffle Ticket '); ?> 
                                            <button onclick='return false;' class='button button-primary' id='btn_modal_fields'> <?php esc_html_e('Export Columns', 'raffle-play-woo'); ?> </button>
                                            <?php RafflePlayWoo_Includes:: rpwoo_premium_image(); ?>
                                        </label>
                                        <p></p>     

                                        <input type="hidden" value='0' name="rpr_product_sale" id='rpr_product_sale' />
                                        <input type="hidden" value='' name="rpr_report_four_cols_sel" id='report_four_cols_sel' />
                                        <input type="hidden" value='' name="rpr_report_four_cols_ava" id='report_four_cols_ava' />
                                        <input type="submit" class='button button-primary' id="btn_send_report" value="<?php esc_html_e('Go', 'raffle-play-woo');?>" />
                                        <input type="hidden" name="rpr_report_order_status" value='' />
                                        <?php wp_nonce_field( 'nonce_field_form_rpr', 'nonce_field_form_rpr' ); ?>
                                
                                </div>

                            
                            </div> 

                        </div> 

                        <div class='panel panel-default' id='panel_settings'>
                            <div class="panel-heading">
                            <h4> <?php esc_html_e('Report Settings', 'raffle-play-woo');?></h4>  
                            </div>

                            <div class="panel-body bmp-set-row">
                                <div id='div_custom_currency' class='bmp-set-row'>
                                    <label for="input_custom_currency">
                                        <?php esc_html_e('Custom Currency Symbol', 'raffle-play-woo');?>
                                        <input type='text' style="width: 50px;" max='5' disabled name='input_custom_currency' id='input_custom_currency'  value="<?php echo htmlspecialchars_decode( $settings['custom_currency']);?>" /> 
                                        <i> (<?php esc_html_e('If empty, use woocommerce currency', 'raffle-play-woo');?>)</i>
                                        <?php RafflePlayWoo_Includes:: rpwoo_premium_image(); ?>
                                    </label>
                                </div>
                                <div id="div_order_status" class='bmp-set-row' >
                                    <h5> <b> <?php esc_html_e('Order Status ', 'raffle-play-woo');?> </b> </h5>
                                    <?php

                                        foreach( $settings['statuses'] as $key=>$value ){
                                            $checked = '';
                                            if( in_array( $key, $settings['saved_statuses']) )
                                                $checked = 'checked';
                                            echo "<label style='margin-right: 10px;'> <input disabled {$checked} id='{$key}' type='checkbox' /> {$value}  </label> <span> </span>";
                                        }
                                                                            
                                        RafflePlayWoo_Includes:: rpwoo_premium_image(); 
                                    ?>
                                </div>


                                <div id="div_order_filter" class='bmp-set-row' >
                                    <h5> <b> <?php esc_html_e('Running Multiple Raffles at the same time', 'raffle-play-woo');?> </b>                                         
                                    </h5>
                                    <h6> (<?php esc_html_e('Order has mixed raffle products', 'raffle-play-woo');?> )</h6>
                                 
                                    <input type="checkbox" data-toggle='toggle' checked  disabled  name="order_filter" id="order_filter_product"
                                        data-on='<?php esc_html_e('Product', 'raffle-play-woo'); ?>' data-off='<?php esc_html_e('Order', 'raffle-play-woo'); ?>'
                                    /> <?php esc_html_e('Get Sale By Product', 'raffle-play-woo') ?>
                                    <?php RafflePlayWoo_Includes:: rpwoo_premium_image(); ?>                                   
                                </div>


                            </div>
                            <input type="hidden" name="hidden_order_status" id='hidden_order_status' value=''>
                        </div>
                    </form>
                </div> <!-- /container-fluid -->
            </div> <!-- /wrap -->

            <div id="modal_fields" class="modal-rpr">

                <!-- Modal content -->
                <div class="rpwoo-modal-content">                   
                
                    <p class='info_col_fields'>*** <?php esc_html_e('Drag & drop to remove from Report Columns', 'raffle-play-woo');?> ***</p>
                    <p class='info_col_fields'>*** <?php esc_html_e('Order can be changed by dragging to desired position number', 'raffle-play-woo');?> ***</p>            
                    <div class="rpwoo-modal-body">                                   
                        <div class="" id="div_report_fields">
                            <h3> <?php esc_html_e('Report Columns', 'raffle-play-woo');?></h3>
                            <ul id="ul_report_fields" class="connectedSortable">                                
                            </ul>
                        </div>                      
                        <p id='div_middle'></p>
                        <div class="" id="div_fields">
                            <div class='ul-header' style='display: inline-block'>
                                <h3 style='display: inline-block'> <?php esc_html_e('Available Columns', 'raffle-play-woo');?></h3>
                                <a class="nav-item nav-link active text-primary btn-add-col" style='width: 25px; display: inline-block' href="#">                              
                                    <i class="fa fa-plus-square"></i>   
                                </a>
                                <div id='div_new_column' style='width: 270px; height: 250px; background: #DCDCDC; position: absolute; display: none;'>
                                   <p style='padding: 4px'> <?php esc_html_e( 'Col Text', 'raffle-play-woo' ); ?> <input type="text" name="" id="new_col_name">     </p>
                                   <p style='padding: 4px' >  <?php esc_html_e( 'DB Meta Name', 'raffle-play-woo' ); ?> 
                                        <input type="text" name="" id="db_col_name">  </p>
                                   <p class='text-danger' style='padding: 4px' > 
                                     <?php esc_html_e('DB  Name  is going to be extracted from the order metadata. (E.g. Data captured at checkout)', 'raffle-play-woo' ); ?> 
                                     <?php esc_html_e('Invalid chars (<,>,&,%,\',")', 'raffle-play-woo'); ?>
                                   </p>

                                    <p></p>    
                                    <p></p>
                                    <p></p>

                                    <div class="div-footer" style='position: absolute; top:212px; left: 148px' >    
                                        <button class='button button-secondary btn-cancel-col'> <?php esc_html_e('Cancel', 'raffle-play-woo' ); ?> </button>
                                        <button class='button button-primary btn-save-col'> <?php esc_html_e('Add', 'raffle-play-woo' ); ?> </button>
                                    </div>
                                </div>
                            </div>
                            <ul id="ul_available_fields" class="connectedSortable">                         
                            </ul>
                        </div>     
        
                    </div>
                  
                    
                    <div class="rpwoo-modal-footer">
                        <button id='btn_close_modal' class='button button-primary'> <?php esc_html_e('OK', 'raffle-play-woo'); ?> </button>    
                         <i> <?php esc_html_e('(In order to save the column changes, run this report)', 'raffle-play-woo' );?>  </i>
                    </div>
                </div>


            </div>

            <script>
                
                var s_rpr_raffle_ticket_no  = "<?php esc_html_e('Raffle Ticket No', 'raffle-play-woo');?>";
                var s_rpr_order_no          = "<?php esc_html_e('Order No', 'raffle-play-woo');?>";
                var s_rpr_order_total       = "<?php esc_html_e('Order Total', 'raffle-play-woo');?>";
                var s_rpr_first_name        = "<?php esc_html_e('First Name', 'raffle-play-woo');?>";
                var s_rpr_last_name         = "<?php esc_html_e('Last Name', 'raffle-play-woo');?>";
                var s_rpr_address_one       = "<?php esc_html_e('Address One', 'raffle-play-woo');?>";
                var s_rpr_address_two       = "<?php esc_html_e('Address Two', 'raffle-play-woo');?>";
                var s_rpr_city              = "<?php esc_html_e('City', 'raffle-play-woo');?>";
                var s_rpr_post_code         = "<?php esc_html_e('Post Code', 'raffle-play-woo');?>";
                var s_rpr_country           = "<?php esc_html_e('Country', 'raffle-play-woo');?>";
                var s_rpr_county            = "<?php esc_html_e('County', 'raffle-play-woo');?>";
                var s_rpr_email             = "<?php esc_html_e('Email', 'raffle-play-woo');?>";
                var s_rpr_phone             = "<?php esc_html_e('Phone', 'raffle-play-woo');?>";
                var s_rpr_order_status      = "<?php esc_html_e('Order Status', 'raffle-play-woo');?>";
                var s_rpr_order_date        = "<?php esc_html_e('Order Date', 'raffle-play-woo');?>";
                var custom_cols_sel         = <?php echo $settings['custom_cols'];?>;
                var custom_cols_ava         = <?php echo $settings['custom_cols_ava'];?>;

                var woo_countries           = <?php echo wp_json_encode( $settings['countries'] );?>;     
                                       
            </script>

        <?php

    }


}