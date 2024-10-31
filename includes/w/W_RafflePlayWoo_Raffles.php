<?php
namespace W_RafflePlayWoo_Raffles;

include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/RafflePlayWoo_Includes.php');

if( ! defined('ABSPATH') )
    die('No Access to this page');

use RafflePlayWoo_Includes\RafflePlayWoo_Includes as RafflePlayWoo_Includes;

class W_RafflePlayWoo_Raffles{
    public static function drp_ProductPage( $settings ){
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
                                    <a class="nav-item nav-link text-primary btn-edit" href="#"> <i class="fa fa-edit"></i> </a>                                
                                    <a class="nav-item nav-link text-primary btn-delete" href="#"> <i class="fa fa-trash"></i> </a>
                                </div>
                                <?php RafflePlayWoo_Includes::rpwoo_premium_image(); ?>
                            </div>
                            <?php RafflePlayWoo_Includes::rpwoo_premium_link(); ?>
                        </nav>
                    </div>
                    <table class='table table-striped' 
                           id='raffle_product_table'>
                    </table>
                </div>
            </div> <!-- /container-fluid -->
        </div> <!-- /wrap -->

        <script>
            var rpwoo_data = []; 
        </script>
        

          <!-- Modal -->
        <div class="modal" id="modalSaveEdit"  tabindex="-1" role="dialog" >
           
            <div class="modal-dialog modal-lg" style='margin-top: 80px !important;'>
            <div class="modal-content ">
                <div class='modal-headline'></div>

                <div class="modal-header">
                    <?php RafflePlayWoo_Includes:: rpwoo_premium_image(); ?>
                    <h4 class="modal-title" style='text-align: center'>
                        <?php esc_html_e('Raffle Action', 'raffle-play-woo');?>
                       
                    </h4>
                   
                    <button type="button" class="close modal-close-btn" id='modal_close_btn' data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
                </div>
               

                <div class="modal-body">

                    <div class="row bmp-set-row">
                        <div class="col-sm-5">
                            <b> <?php esc_html_e('Raffle Name', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-7">    
                            <input type="text" name="" id="raffle_name">                           
                        </div>
                    </div>

                    <p></p>

                    <div class="row bmp-set-row">
                        <div class="col-sm-5">
                            <b> <?php esc_html_e('Start Ticket', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-7">    
                            <input type="number" min='1' name="" id="start_ticket">                           
                        </div>
                    </div>

                    <p></p>

                    <div class="row bmp-set-row">
                        <div class="col-sm-5">
                            <b> <?php esc_html_e('Live', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-7">    
                            <input type="checkbox" checked  name="" data-toggle='toggle'
                             data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"
                             data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" id="is_live">                           
                        </div>
                    </div>

                    <p></p>

                    <div class="row bmp-set-row">
                        <div class="col-sm-5">
                            <b> <?php esc_html_e('Terminated', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-7">    
                            <input type="checkbox"  name="" data-toggle='toggle'
                            data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"
                            data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" id="is_terminated">                           
                        </div>
                    </div>

                    <p></p>

                    <div class="row bmp-set-row">
                        <div class="col-sm-5">
                            <b> <?php esc_html_e('Ticket Prefix', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-7">    
                            <input type="text"  name="" id="ticket_prefix" /> <?php esc_html_e('(limited to 15 characters)', 'raffle-play-woo'); ?>                           
                        </div>
                    </div>

                    <p></p>

                    <div class="row bmp-set-row">
                        <div class="col-sm-5">
                            <b> <?php esc_html_e('Limited Tickets', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-7">    
                            <?php esc_html_e('Yes', 'raffle-play-woo');?> <input type="radio"  name="is_limited" id="is_limited_yes">   
                            <input type="number" name="" min='1' id="limit_no">
                            <br />
                            <?php esc_html_e('No', 'raffle-play-woo');?> <input checked type="radio"  name="is_limited" id="is_limited_no">                          
                        </div>
                    </div>
                    
                    <p></p>

                    <div class="row bmp-set-row">
                        <div class="col-sm-5">
                            <b> <?php esc_html_e('Start Date', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-7">    
                            <div class='col-sm-6' style='display: inline-block'>                       
                                <input type="text" id="datepicker_from" placeholder='dd-mm-yyyy'>                                                                    
                            </div>
                           
                            <div class="input-group clockpicker col-sm-3" style='display: inline-flex'
                                data-autoclose="true">
                                    <input type="text" id="timepicker_from"
                                    class="form-control"  placeholder="hh:mm"  >
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                            </div>
                         
                           
                        </div>
                    </div>

                    <p></p>

                    <div class="row bmp-set-row">
                        <div class="col-sm-5">
                            <b> <?php esc_html_e('End Date', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-7">   

                            <div class='col-sm-6' style='display: inline-block'>                       
                                <input type="text" id="datepicker_to" placeholder='dd-mm-yyyy'>  
                            </div>

                            <div class="input-group clockpicker col-sm-3" 
                                style='display: inline-flex'
                                data-autoclose="true">
                                <input type="text" id="timepicker_to"
                                class="form-control"  placeholder="hh:mm"  >
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                             
                           
                        </div>
                    </div>

                    <p></p>

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

                    <p></p>
                
                    <div class="row bmp-set-row">
                        <div class="col-sm-5">
                            <b> <?php  esc_html_e('Email Extra Line Text', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-7">    
                            <input type="text" placeholder="<?php esc_html_e('Eg: Raffle takes place on 10th of January 2021', 'raffle-play-woo' ); ?>"  name="" id="email_extra" style='width: 100%' />                           
                        </div>
                    </div>
                
                    <p></p>
                 

                    <div class="row bmp-set-row">
                        <div class="col-sm-5">
                            <b> <?php esc_html_e('Inherit Email Format from Default Raffle', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-7">    
                            <input type="checkbox" checked disabled  name="" data-toggle='toggle'
                            data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"
                            data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" id="is_live">                           
                        </div>
                    </div>

                    <p></p>

                    <div class="row bmp-set-row">
                        <div class="col-sm-5">
                            <b> <?php esc_html_e('Inherit Messages from Default Raffle', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-7">    
                            <input type="checkbox" checked disabled  name="" data-toggle='toggle'
                            data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"
                            data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" id="is_live">                           
                        </div>
                    </div>

                    <div class='row bmp-set-row' >
                        <div class="col-sm-5 " > 
                            <b>  <?php esc_html_e('Show Tickets Number with Raffle image in background (Thank you Page / Email )', 'raffle-play-woo' );?>  </b>
                            <span data-toggle='tooltip' 
                                title="<?php esc_html_e('Raffle image will be placed in the background of the ticket number. Custom images can be used, or customized in the template', 'raffle-play-woo' ); ?>" > 
                                <i class="fa fa-info-circle text-info"></i> 

                            </span>
                        </div>
                                                            
                        <div class="col-sm-7" >                               
                            <input type="checkbox" id="show_ticket_image" data-toggle='toggle' data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>" 
                            data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" data-size='small'/>
                        </div>

                    </div>

                    <div class='row bmp-set-row' >
                        <div class="col-sm-5 " style='display: inline-block'> 
                            <b>
                                <?php esc_html_e('Raffle Tickets Images', 'raffle-play-woo' );?> 
                            </b>
                        </div>                                    
                    
                        <div class="col-sm-7" style='display: inline-block; padding-left: 40px;'>  
                            <select name="select_ticket_image" id="select_ticket_image">
                                <option value="blue" ><?php esc_html_e('Blue', 'raffle-play-woo' ); ?> </option>
                                <option value="gold-one"  ><?php esc_html_e('Gold', 'raffle-play-woo' ); ?> </option>
                                <option value="gold-two" ><?php esc_html_e('Gold Lines', 'raffle-play-woo' ); ?> </option>
                                <option value="gray" ><?php esc_html_e('Gray', 'raffle-play-woo' ); ?> </option>
                                <option value="orange"  ><?php esc_html_e('Orange', 'raffle-play-woo' ); ?> </option>
                                <option value="purple" ><?php esc_html_e('Purple', 'raffle-play-woo' ); ?> </option>
                                <option value="red"  ><?php esc_html_e('Red', 'raffle-play-woo' ); ?> </option>
                                <option value="custom"  ><?php esc_html_e('Custom', 'raffle-play-woo' ); ?> </option>                                                
                            </select>
                            <img id='ticket_img_show' data-src="<?php echo esc_url( RAFFLE_PLAY_WOO_URL . '/' );?>" 
                                src="" style='width: 80px;' alt="">

                            <div class='row bmp-set-row' style='margin-top: 12px' >
                            
                                <div class="col-sm-12 div-custom-ticket-img" style='display: none' >  
                                    <button class='button button-primary' id='load_ticket_img' style='display: inline; height: 34px;' >
                                    <?php esc_html_e('Library', 'raffle-play-woo' ); ?></button>                             
                                    <div style='display: inline;'>
                                        <input type="text" id="ticket_image_url"  style='width:80%' style='display: inline;'
                                        placeholder="https://yourdomain.com/images/raffle-ticket-image.png"
                                        value="" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class='row bmp-set-row' >
                        <div class="col-sm-5 " style='display: inline-block'> 
                            <b>
                                <?php esc_html_e('Show Countdown on Product Page', 'raffle-play-woo' );?> 
                            </b>

                            <span data-toggle='tooltip' data-container="#modalSaveEdit"
                                title='<?php esc_html_e('Show Countdown if Raffle has start date or end date set for the products linked to this raffle', 'raffle-play-woo' ); ?>'> 
                                <i class="fa fa-info-circle text-info"></i> 
                            </span>


                        </div>
                        
                        <div class="col-sm-7" >                               
                            <input type="checkbox"  data-toggle="toggle" data-size='small'                               
                                    id='rdp_show_countdown'
                                    data-on="<?php esc_html_e('Yes', 'raffle-play-woo');?>"  
                                    data-off="<?php esc_html_e('No', 'raffle-play-woo');?>" />  
                                    
                            <span>
                                <img width='200' style='max-width: 200px' 
                                    src="<?php echo esc_url_raw( RAFFLE_PLAY_WOO_URL .'/images/countdown-image.png');?>" 
                                    alt="<?php esc_html_e('Countdown Image', 'raffle-play-woo');?>" />
                            </span>
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