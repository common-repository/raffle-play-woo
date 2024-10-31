(function($){
    "use strict";
    $(document).ready(function(){
        //save setting ajax
        const DRP_SAVE_ACTION = 'drp_save_settings';        
        var original_ticket_start_count_at = parseInt( $('#rdp_ticket_start_count_at').val() );
        var original_live_val              = ( $('#rdp_life_raffle').prop('checked') ? 1 : 0 );        
        
        $('.rdp_save_settings').on('click', function(e){
            e.preventDefault();
            let obj = {};
            let data = {};
            data.ticket_count_starts_at = parseInt( $('#rdp_ticket_start_count_at').val() );
            data.live_raffle            = ( $('#rdp_life_raffle').prop('checked') ? 1 : 0 ); 
            data.email_header           = $.trim( $('#rpwoo_email_header_lbl').val() );
            data.email_body             = $.trim( $('#rpwoo_email_body_lbl').val() );   
            data.ticket_prefix          = $.trim( $('#rpwoo_ticket_prefix').val() ); 
            data.limit_tickets          = ( $('#radio_limit_raffle_yes').prop('checked') ? 1 : 0 );
            data.limit_tickets_no       = parseInt( $('#limit_raffle_no_tickets').val() );

            data.start_date             = $.trim( $('#rpwoo_start_date').val() );
            data.end_date               = $.trim( $('#rpwoo_end_date').val() );

            data.start_time             = $.trim( $('#rpwoo_start_time').val() );
            data.end_time               = $.trim( $('#rpwoo_end_time').val() );
            data.email_extra            = $.trim( $('#rpwoo_email_body_extra_txt').val() );
            data.email_pos              = $('input:radio[name="rpwoo_email_data_pos"]:checked').val();  
            data.terminated             = $('#rdp_terminate_raffle').prop('checked') ? 'yes' : 'no';  

            data.msg_terminate          = $.trim( $('#msg_terminate').val() );
            data.msg_startdate          = $.trim( $('#msg_startdate').val() );
            data.msg_enddate            = $.trim( $('#msg_enddate').val() );
            data.msg_will_enddate       = $.trim( $('#msg_will_enddate').val() );
            data.msg_add_to_cart        = $.trim( $('#msg_add_to_cart').val() );
            data.msg_add_to_cart_ex     = $.trim( $('#msg_add_to_cart_ex').val() );
            data.msg_update_cart_ex     = $.trim( $('#msg_update_cart_ex').val() );
            data.raffle_name            = $.trim( $('#rpwoo_raffle_name').val() );
            data.inc_name               = $('#rpwoo_inc_name').prop('checked') ? 1 : 0;
            data.limit_order_per_raffle = $('#limit_order_per_raffle').prop('checked') ? 1 : 0;
            data.limit_order_per_raffle_txt = $.trim( $('#limit_order_per_raffle_txt').val() );

            data.show_ticket_image      = $('#show_ticket_image').prop('checked') ? 'yes' : 'no';
            data.ticket_image           = $('#select_ticket_image option:selected').val();

            if( data.ticket_image == 'custom'){
                data.ticket_image = 'blue';
            }
            
            data.acc_tab_raffle         = $('#show_acc_tab').prop('checked') ? 'yes' : 'no';
            data.check_duplicates       = $('#rdp_check_duplicates').prop('checked') ? 'yes' : 'no';
            data.raffle_woo_nonce_name  = $('#raffle_woo_nonce_name').val();
            data.show_orders_table      = $('#show_orders_table').prop('checked') ? 'yes' : 'no';

            data.gen_checkout           = $('#rdp_gen_checkout').prop('checked') ? 'yes' : 'no';
            data.cart_block             = $('#cart_block').prop('checked') ? 'yes' : 'no';
            data.checkout_block         = $('#checkout_block').prop('checked') ? 'yes' : 'no';
            data.gen_c_set_time         = $('#gen_c_set_time').val();
            data.gen_c_set_countdown    = $('#gen_c_set_countdown').prop('checked') ? 'yes' : 'no';
            data.gen_c_set_location     = $('#gen_c_set_location option:selected').val();
            data.gen_c_set_location_block     = $('#gen_c_set_location_block option:selected').val();
            data.gen_c_set_countdown_lbl = $('#gen_c_set_countdown_lbl').val();
            data.gen_c_set_remove_checkout = $('#gen_c_set_remove_checkout').prop('checked') ? 'yes' : 'no';
            data.gen_c_set_cycles          = $('#gen_c_set_cycles').val();
            data.gen_c_msg_removed         = $('#gen_c_msg_removed').val();

            data.order_status_processing    = $('#rpwoo_checkout_order_processing').prop('checked') ? 'yes' : 'no';
            data.order_status_completed     = $('#rpwoo_checkout_order_completed').prop('checked') ? 'yes' : 'no';
            data.order_status_onhold        = $('#rpwoo_checkout_order_onhold').prop('checked') ? 'yes' : 'no';

        
            if ( isNaN( data.limit_tickets_no ))
               data.limit_tickets_no = 0;
            else if ( data.limit_tickets_no < 0 )
               data.limit_tickets_no = 0;
            
            if( $('#rpwoo_resolved_issues').length > 0 ){
                if( $('#rpwoo_resolved_issues').prop('checked') ){
                    data.mark_issues = true;
                }
            }

            obj.action = DRP_SAVE_ACTION;
            obj.data = data;
            bmp_save_setting_ajax( obj  );
        });
      
        $('#rpwoo_ticket_prefix').on('keydown', function(){
            let input_val = $.trim( $(this).val() );
            if( input_val.length > 15 ){
                $( this ).val( input_val.substring( 0, 15 ) );
            }
        });      

        $( "#rpwoo_start_date, #rpwoo_end_date" ).datepicker({
            yearRange : '2018:' + ( (new Date()).getFullYear() + 4),
            dateFormat : 'dd-mm-yy',
            changeMonth: true, 
            changeYear: true
        });

        if( $('#rpwoo_db_health').length > 0 ){
            $('#rpwoo_db_health').on('click', function(){
                rpwoo_fixDB();
            });
        }

        $('#radio_limit_raffle_no').on('change', function(){
            if( $( this ).prop('checked') ){
                $('#limit_raffle_no_tickets').prop('readonly', true );
            }
        });

        $('#radio_limit_raffle_yes').on('change', function(){
            if( $( this ).prop('checked') ){
                $('#limit_raffle_no_tickets').prop('readonly', false );
            }
        });

        if( $('#radio_limit_raffle_no').prop('checked'))
            $('#limit_raffle_no_tickets').prop('readonly', true );           

        $('.clockpicker_main').clockpicker({           
            autoclose : true          
        });

        $('#rpwoo_checkout_order_processing, #rpwoo_checkout_order_completed, #rpwoo_checkout_order_onhold').on('change, input', function(){
            check_order_status();
        });

        $('#select_ticket_image').on('change', function(){
            let $value = $('#select_ticket_image option:selected').val();    
            let img_url = $('#ticket_img_show').data('src');
            let ticket_img_url = '#';
            let img_prefix = 'images/ticket-image-';

            if( $value == 'custom'){
                $( '.div-custom-ticket-img').show();
                let $custom_ticket_url = $.trim( $('#ticket_image_url').val() );
                ticket_img_url = $custom_ticket_url !== '' ? $custom_ticket_url : '#';
                
            }else{
                $('.div-custom-ticket-img').hide();
                ticket_img_url = img_url + img_prefix + $value + '.png';
            }

            $('#ticket_img_show').attr('src', ticket_img_url );

        });
        $('#select_ticket_image').trigger('change');
        
        $('[data-toggle="tooltip"]').tooltip({
           selector: false,
           trigger : 'hover'
        });

        $('#gen_c_set_remove_checkout').on('change', function(){
            let val = $( this ).prop('checked');
            $('#gen_c_set_cycles').prop('disabled', ! val );
        });

        $('#gen_c_set_remove_checkout').trigger('change');
       
        check_order_status();
    
    //    $('[data-toggle="tooltip"]').tooltip();  
    });

    function check_order_status(){
  
        let order_status_processing    = $('#rpwoo_checkout_order_processing').prop('checked') ? 'yes' : 'no';
        let order_status_completed     = $('#rpwoo_checkout_order_completed').prop('checked') ? 'yes' : 'no';
        let order_status_onhold        = $('#rpwoo_checkout_order_onhold').prop('checked') ? 'yes' : 'no';

        if( order_status_processing == 'no' && order_status_completed == 'no' && order_status_onhold == 'no' ){
            $('.alert-order-status').show();              
        }else{
            $('.alert-order-status').hide();
        }
    }

    function bmp_save_setting_ajax( $obj, $callback ){
        $('#drpLoaderImg').show();
        var data_ajax = {
            action: $obj.action,
            type: 'POST',
            data: $obj.data,
            dataType: 'json', 
            contentType: 'application/json'
        }
        
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: data_ajax,
            beforeSend: function(){              

              if( typeof $callback !== 'undefined'){
                  $callback();
              }
            }, 
            success: function(data){
                //should display a success/error message;
            
                try {
                    data = JSON.parse( data );  
                    if( 'error' in data ){
                        alert( data.error );
                        return false;
                    }
                    
                    let lRec = false;
                    if( typeof data.live_raffle !== 'undefined'){
                        $('#rdp_life_raffle').prop('checked', data.live_raffle );
                        lRec = true;
                    }                        
                    if( typeof data.count_start_at  !== 'undefined'){
                        if( data.count_start_at == '' )
                            data.count_start_at = '0';
                        $('#rdp_ticket_start_count_at').val( data.count_start_at );
                        lRec = true;
                    }

                    if( typeof data.last_live_ticket !== 'undefined'){
                        $('#liveLastTicketNo').val( data.last_live_ticket);
                        lRec = true; 
                    }


                    if( lRec )
                      $( '.bmp-pins-new-panel .panel-heading').bmp_message( rpwoo_local_lng.saved, 'success' );
                              
                } catch (error) {
                    $( '.bmp-pins-new-panel .panel-heading').bmp_message( rpwoo_local_lng.error_parsing_data, 'danger' ); 
                }            

            },
            error: function( request, status, error ){
             
                alert( 'Request ' + request + ' - Status: ' + status + ' - Error: ' + error);    
            },
            complete: function(){
                $('#drpLoaderImg').hide();
            }
        })
    }

    function rpwoo_fixDB(){
        $('#drpLoaderImg').show();
        var data_ajax = {
            action: 'drp_fix_db',
            type: 'POST',
            data: 'fix_db',
            dataType: 'json', 
            contentType: 'application/json',
            raffle_woo_nonce_name  : $('#raffle_woo_nonce_name').val()
        }

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: data_ajax,
            beforeSend: function(){              
            }, 
            success: function(data){                           
                
                if( data == 'changed'){
                    window.location.reload();
                }
                $('#drpLoaderImg').hide();
            },
            error: function( request, status, error ){
            },
            complete: function(){               
            }
        })
    }
})(this.jQuery);