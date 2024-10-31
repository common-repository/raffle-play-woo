(function( $ ){
    "use strict";
    var all_columns = [];

    $(document).ready( function(){
        "use strict";

        var custom_columns = [
            {
                text : s_rpr_raffle_ticket_no,
                name : 'ticket_no',
                custom: 0
            },{
                text : s_rpr_order_no,
                name : 'order_id',
                custom: 0
            },{
                text : s_rpr_first_name,
                name : 'first_name',
                custom: 0
            },{
                text : s_rpr_last_name,
                name : 'last_name',
                custom: 0
            },{
                text : s_rpr_address_one,
                name : 'address_one',
                custom: 0
            },{
                text : s_rpr_address_two,
                name : 'address_two',
                custom: 0
            },{
                text : s_rpr_city,
                name : 'city',
                custom: 0
            },{
                text : s_rpr_post_code,
                name : 'post_code',
                custom: 0
            },{
                text : s_rpr_country,
                name : 'country',
                custom: 0
            },{
                text : s_rpr_county,
                name : 'county',
                custom: 0
            },{
                text : s_rpr_email,
                name : 'email',
                custom: 0
            },{
                text : s_rpr_phone,
                name : 'phone',
                custom: 0
            },{
                text : s_rpr_order_total,
                name : 'order_total',
                custom: 0
            },{
                text : s_rpr_order_status,
                name : 'order_status',
                custom: 0
            },{
                text : s_rpr_order_date,
                name : 'order_date',
                custom: 0
            }
        ];      

        build_custom_columns();
        
        $('.input-dates').datepicker({
            yearRange : '2016:' + ( (new Date()).getFullYear() + 4),
            dateFormat : 'dd-mm-yy',
            changeMonth: true, 
            changeYear: true
        });


        $('#rpr_clear_dates').on('click', function(e){
            e.preventDefault();
            $('#drp_date_from, #drp_date_to').val('');
            return false;
        });

        $('#btn_modal_fields').on('click', function(e){
            e.preventDefault();
            $('#modal_fields').show();
            return false;
        });

        $('#btn_close_modal').on('click', function(){
            $('#modal_fields').hide(); 
        });

        $('#div_order_status input[type=checkbox]').on('click', function(){
            if( $('#div_order_status').hasClass('requested') ){
                $('#div_order_status').removeClass('requested');
            }
        });

        $('#order_filter_product').on('change', function(){
            let e_val = $( this ).prop('checked') ? 1 : 0;
            $('#rpr_product_sale').val( e_val );
        });

        $('.btn-add-col, .btn-cancel-col').on('click', function(){
            $('#new_col_name, #db_col_name').val('');
            $('#div_new_column').slideToggle();
        });

        $('li .fa-trash-alt').on('click', function( el ){         
            $( this ).parent().remove();  
        });

        $('.btn-save-col').on('click', function(){
            
            let col_text = $.trim( $('#new_col_name').val() ); 
            let col_db   = $.trim( $('#db_col_name').val() );

            if( (col_text == '') || (col_db == '') ){
                return;
            }

            let special_chars = /[<|>|&|%|'|"]/g;
            let special_pos = col_db.search( special_chars );

            if( special_pos !== -1 ){
                alert( 'Invalid Input')
                return
            }

            let white_space_pos = col_db.search( /\s/g );
            if( white_space_pos !== -1 ){
                alert('Invalid Input');
                return;
            }

            let obj ={
                    text : col_text,
                    name : col_db,
                    custom: 1
            };

            let li_items = $('#modal_fields .rpwoo-modal-body li');
            let len = li_items.length;
            let i = 0;
            let item = null;
            let lFound = false;
            let name = '';

            while( i < len ){

                item = li_items[ i ];

                name = $(item).data('name');

                if( name == obj.name ){
                    lFound = true;
                    i = len;
                }
                i++;
            }
            
       
            if( lFound ){ //there is anothe field with same name
                $('#modal_fields .rpwoo-modal-body').bmp_message( rpwoo_local_lng.duplicated_meta_name , 'danger');
                return; 
            }


            let li = $('<li>'+ obj.text.toString()+' <i class="fas fa-trash-alt"></i></li>').attr({
                'data-text' : obj.text.toString(),
                'data-name' : obj.name.toString(),
                'data-custom' : obj.custom,
                'title' : obj.name.toString()
            });            

            $('#ul_available_fields').prepend( li );

            $('li .fa-trash-alt').on('click', function( el ){ 
                $( this ).parent().remove();                    
            });

          //  build_custom_columns();
            $('.btn-cancel-col').click();

        });

        $('#btn_send_report').on('click', function(e){
         
            let checkbox_rep         = $('#drp_radio_raffle_ticket').prop('checked');       
            let ckb_orders = [];
          
            if( checkbox_rep === true){
              let li_items = $('#ul_report_fields li'); //selected
              let li_avail = $('#ul_available_fields li'); //available
              if( li_items ){
                  let arr_names = [];
                  for( let i = 0; i < li_items.length; i++ ){
                    let li_item_obj = li_items[i];                    
                    let name = $( li_item_obj ).data('name');
                    let text = $( li_item_obj ).data('text');
                    let custom = $( li_item_obj ).data('custom');
                    let obj = { 
                        name : name,
                        text : text,
                        custom : custom
                    }
                    arr_names.push( obj );
                  }
                  $('#report_four_cols_sel').val( JSON.stringify( arr_names ) );                                
              }

              if( li_avail.length > 0 ){
                  let obj_arr = [];
                  for( let i = 0; i < li_avail.length; i++ ){
                    let li_item_obj = li_avail[i];                    
                    let name = $( li_item_obj ).data('name');
                    let text = $( li_item_obj ).data('text');
                    let custom = $( li_item_obj ).data('custom');
                    let obj = { 
                        name : name,
                        text : text,
                        custom : custom
                    }
                    obj_arr.push( obj );
                  }
                  $('#report_four_cols_ava').val( JSON.stringify( obj_arr ) );   
              }

            } 
           
            $('#div_order_status input[type=checkbox]').each( function(){
                if( this.checked )                 
                    ckb_orders.push( this.id );                
            });

            if( ckb_orders.length == 0 ){
                $('#div_order_status').addClass('requested');
                return false;
            }else{
                $('#hidden_order_status').val( ckb_orders.join(',') ); 
            }

            
        });

        $( "#ul_report_fields, #ul_available_fields" ).sortable({
            connectWith: ".connectedSortable"
        }).disableSelection();

        $("[data-toggle='tooltip']").tooltip();

        function build_custom_columns(){
           
            let report_fields = [];
            let avail_fields = [];
            let i = 0;
            if( (custom_cols_sel.length == 0) && ( custom_cols_ava.length == 0) ) 
                custom_cols_ava = custom_columns;

            all_columns = custom_cols_ava.concat( custom_cols_sel );
            
            for(  i = 0; i < custom_cols_sel.length; i++ ){
                let li_obj = custom_cols_sel[i];
                let trash_can = (li_obj.custom == 1) ? "<i class='fas fa-trash-alt'></i>" : '';
                let li = $("<li>"+ li_obj.text.toString()   + trash_can + "</li>").attr({
                                                                'data-text' : li_obj.text.toString(),
                                                                'data-name': li_obj.name.toString(),
                                                                'data-custom': li_obj.custom,
                                                                'title' : li_obj.name.toString()
                                                            });
                                                            
                report_fields.push( li );                                           
            }

            for( i = 0; i < custom_cols_ava.length; i++){
                let li_obj = custom_cols_ava[i];
                let trash_can = (li_obj.custom == 1) ? "<i class='fas fa-trash-alt'></i>" : '';
                let li = $("<li>" + li_obj.text.toString() + trash_can + "</li>").attr({
                                                                'data-text' : li_obj.text.toString(),
                                                                'data-name': li_obj.name.toString(),
                                                                'data-custom': li_obj.custom,
                                                                'title' : li_obj.name.toString()
                                                            });
                avail_fields.push( li ); 
            }
    
            $('#ul_report_fields').empty().append( report_fields );
            $('#ul_available_fields').empty().append( avail_fields );
        }
  
    });
})(this.jQuery);