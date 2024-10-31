<?php
namespace W_RafflePlayWoo_ViewPage;

include_once( RAFFLE_PLAY_WOO_DIR_PATH . '/includes/RafflePlayWoo_Includes.php');

if( ! defined('ABSPATH') )
    die('No Access to this page');

use RafflePlayWoo_Includes\RafflePlayWoo_Includes as RafflePlayWoo_Includes;

class W_RafflePlayWoo_ViewPage{
    public static function drp_ViewPage( $settings ){
        RafflePlayWoo_Includes::rpwoo_loading_screen();               
    ?>     
        <div class='wrap'>
            <div class="container-fluid">

            <?php wp_nonce_field( 'raffle_woo_nonce_action', 'raffle_woo_nonce_name' ); ?>
           
                <div class="panel panel-default bmp-pins-new-panel">
                              
                    <div class="panel-heading">                  
                        <h3 class='show-tooltip-ticket' data-toggle='tooltip' title=''> <?php esc_html_e('View Tickets', 'raffle-play-woo');?></h3>                                      
                    </div>                
                 
                    <div class="panel-body">
                        <div class='row bmp-set-row' >
                           
                            <div id="divViewFilter">
                               
                                <input type="checkbox" disabled id="ckbTypeData" <?php if( $settings['live_raffle']) echo 'checked';?> data-toggle="toggle"
                                    data-size='small'
                                    data-on="<?php esc_html_e('Live', 'raffle-play-woo');?>" 
                                    data-off="<?php esc_html_e('Test', 'raffle-play-woo');?>" /> 


                                <button class='button button-primary' style='display: none;' id="btnBackup" ><?php esc_html_e('Backup', 'raffle-play-woo');?></button>
                                <button class='button button-primary' id="btnViewFilter" ><?php esc_html_e('Filter', 'raffle-play-woo');?></button>

                                <strong > <span id="mainFilterInfo"> <span id="filterInfo"> </span>
                                 <span id='filterClear' data-toggle='tooltip'  title="<?php esc_html_e('Clear Filter', 'raffle-play-woo' ) ?>"> <i class="fas fa-calendar-times"></i> </span> </span> </strong>
                                
                                <button class='button button-primary border-danger' style='float: right; margin-right: 30px;' id="btnDeleteTickets" >
                                <?php esc_html_e('Delete Raffle Tickets', 'raffle-play-woo');?>
                                <?php RafflePlayWoo_Includes:: rpwoo_premium_image(); ?>
                                </button>
                               
                            </div>

                            <div id='p_view_order_modal'> 

                                <label for="view_order_modal"  class='bmp-set-row'>
                                    <i class="fa fa-eye view-order-link"></i>  
                                    <input type="checkbox" checked name="" id="view_order_modal"> <?php esc_html_e('Order in Modal', 'raffle-play-woo' ); ?>
                                </label>

                                <label for="view_order_tickets" class='spacer5 bmp-set-row'>  
                                    <?php RafflePlayWoo_Includes:: rpwoo_premium_image(); ?>                                  
                                    <input type="checkbox" name="" id="view_order_tickets"> <?php esc_html_e('View Tickets by Order', 'raffle-play-woo' ); ?>
                                </label>

                                <?php 
                                    echo "<span class='spacer5 bmp-set-row'>";
                                    echo "<b>";
                                    esc_html_e('Raffle', 'raffle-play-woo' );
                                    echo "</b>";
                                    echo RafflePlayWoo_Includes::rpwoo_create_dropdown( $settings['raffles'], 'raffles_list' );
                                    echo "</span>";
                                ?>
                            </div>

                            <div id='div_filter_status' class='bmp-set-row'>
                                    
                                    <?php
                                    // to be implemented
                                        echo "<span id='order_status_filter_header'>";
                                        echo "<strong>";
                                        esc_html_e('Order Status ', 'raffle-play-woo' );
                                        echo " </strong>";
                                        echo "</span>";
                                        $title = esc_html__('wait to load after changing status', 'raffle-play-woo' );
                                        foreach( $settings['statuses'] as $key=>$value ){
                                                $checked = '';
                                                if( in_array( $key, $settings['saved_statuses']) )
                                                    $checked = 'checked';
                                                echo "<label title='{$title}' data-toggle='tooltip' data-placement='bottom' style='margin-right: 10px;'> <input {$checked} id='{$key}' class='form-control' type='checkbox' /> {$value}  </label> <span> </span>";
                                        }                                        
                                         
                                    ?>
                                  
                                    </p>

                                    <button id='btn_print_tickets' class='btn btn-secondary'>  
                                        <?php RafflePlayWoo_Includes:: rpwoo_premium_image(); ?>                                                                           
                                        <?php esc_html_e('Print Tickets', 'raffle-play-woo' ); ?>
                                    </button>                                  
                                    
                                    <button id='btn_duplicates' class='btn btn-secondary'>
                                        <?php RafflePlayWoo_Includes:: rpwoo_premium_image(); ?> 
                                        <span class='dup-no'></span>                                        
                                        <?php esc_html_e('Duplicates', 'raffle-play-woo' ); ?>
                                    </button>

                                </div>

                            <table class="table table-striped" id="tbl_view"  >
                                <thead>

                                </thead>
                                <tbody>

                                </tbody>

                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                    
                    </div> 

                </div> 

            </div> <!-- /container-fluid -->
        </div> <!-- /wrap -->
        

          <!-- Modal -->
        <div class="modal" id="modalViewFilter"  tabindex="-1" role="dialog" >
            <div class="modal-dialog">
            <div class="modal-content">
                <div class='modal-headline'></div>

                <div class="modal-header">
                    <h4 class="modal-title"><?php esc_html_e('Filter', 'raffle-play-woo');?> </h4>
                        <button type="button" class="close modal-close-btn" id='modal_close_btn' data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-2">
                            <b> <?php esc_html_e('From', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-9">    
                            <div class='modal-dates-wrapper'>                       
                                <input type="text" id="datepicker_from">  

                            </div>
                           
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-sm-2">
                            <b> <?php esc_html_e('To', 'raffle-play-woo' );?> </b>
                        </div>
                        <div class="col-sm-9">                          
                            <div class='modal-dates-wrapper'>                       
                                <input type="text" id="datepicker_to">  
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="button button-primary" id="btnFilterSave"><?php esc_html_e('Filter', 'raffle-play-woo');?></button>
                    <button type="button" class="button button-default" data-dismiss="modal"><?php esc_html_e('Cancel', 'raffle-play-woo');?></button>              
                    <button type="button" class="button button-secondary" id="btnFilterClear"><?php esc_html_e('Clear', 'raffle-play-woo');?></button>
                </div>
            </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        

        <!-- Modal -->
        <div class="modal" id="modalViewOrder"  tabindex="-1" role="dialog" >
            <div class="modal-dialog modal-lg">
            <div class="modal-content" style="margin-top: -100px;">
                <div class='modal-headline'></div>
                
                <div class="modal-header">
                    <h4 class="modal-title"><?php esc_html_e('Filter', 'raffle-play-woo');?> </h4>
                        <button type="button" class="close modal-close-btn" id='modal_close_btn' data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>

                <div class="modal-body">
                    <iframe id='view_order_frame' 
                         frameborder="0" width='100%'></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-primary" id=""><?php esc_html_e('Close', 'raffle-play-woo');?></button>
                </div>
            </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
      
        <!-- Modal -->
        <div class="modal" id="modalBackup"  tabindex="-1" role="dialog" >
            <div class="modal-dialog ">
            <div class="modal-content">
                <div class='modal-headline'></div>

                <div class="modal-header">
                <h4 class="modal-title"><?php esc_html_e('Backup Actions', 'raffle-play-woo');?> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <label for="input_backup_name">
                                <?php esc_html_e('Backup Name (max 10 characters)*', 'raffle-play-woo' ); ?>
                            </label>
                        </div>
                        <div class="col-sm-5">                           
                            <input type='text' id='input_backup_name' class='form-control' />                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            
                        </div>
                        <div class="col-sm-7" style='margin-top: 5px;'>
                            <label for="radio_backup_alldata">                          
                                <input type="radio" name="radio_backup_data" id="radio_backup_alldata"> <?php esc_html_e('Backup All Live Data','raffle-play-woo'); ?>
                            </label>

                            <label for="radio_backup_viewdata">
                                <input checked type="radio" name="radio_backup_data" id="radio_backup_viewdata"> <?php esc_html_e('Backup Data from Table View', 'raffle-play-woo'); ?>
                            </label>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="button button-primary" id=""><?php esc_html_e('Execute', 'raffle-play-woo');?></button>
                    <button type="button" data-dismiss="modal" class="button button-secondary" id=""><?php esc_html_e('Cancel', 'raffle-play-woo');?></button>
                </div>
            </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


      <?php  
    }
}