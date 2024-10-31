var rpd_loaded_iframe = false;
const rpd_local_columns = 'rpd_local_columns';
(function($){
    "use strict";
    var oData = null;
    var filterObj = {
        from_date : '',
        from_time : '00:00:00',        
        to_date   : '',
        to_time   : '23:59:59',
        inc_deleted : false
    };

    let obj_delete_tickets = {
        action : 'drp_get_data',
        action_delete : 'drp_delete_tickets',
        raffle_id : -1
    };

    var visibleColumns = localStorage.getItem( rpd_local_columns );

    if( visibleColumns !== null ){

        visibleColumns = JSON.parse( visibleColumns );

    }else{

        visibleColumns = {
            order_id: true,
            raffle_ticket: true,
            tickets_total: false,
            price: true,
            product_name: true,
            email: true,
            first_name: true,
            last_name: true,
            city: true,
            country: false,
            phone: true,
            created_at: true             
        }

    }

    $(document).ready(function(){
        let obj = {
            action     : 'drp_get_data',
            get_info   : 'get_info',
            live_data  : $('#ckbTypeData').prop('checked') ? 1 : 0,
            dates      : filterObj,
            inc_deleted : 0,
            is_completed : 1,
            is_processing : 1
        };    
             
        if( obj.live_data == 1)
            $('#ckbTypeData').bootstrapToggle('on');
      
        drp_request_data( obj); 
       
    
        $('.lds-default').show();
        $( "#datepicker_from, #datepicker_to" ).datepicker({
            yearRange : '2018:' + ( (new Date()).getFullYear() + 4),
            dateFormat : 'dd-mm-yy',
            changeMonth: true, 
            changeYear: true
        });

        $('#btnViewFilter').on('click', function(){
           
            $('#modalViewFilter').modal({
                show : true,
                backdrop: 'static'
            });
        });

        $('#btnFilterSave').on('click', function(){        
            let filterTxt = '';
            filterObj.from_date = DateToString( $('#datepicker_from').datepicker('getDate') );
            filterObj.to_date   = DateToString( $('#datepicker_to').datepicker('getDate') );
            filterObj.from_time = '00:00'; //  $('#timepicker_from').val();
            filterObj.to_time   = '23:59'; //$('#timepicker_to').val();                                                   

          
            $('#modalViewFilter').modal('hide');
            
            if( (filterObj.from_date !== '') ){
                filterTxt +='From: ' + DateStrToString( filterObj.from_date ) + ' ' + filterObj.from_time +  ' - ';
            }
            if( filterObj.to_date !== ''){
                filterTxt += 'To: '+ DateStrToString( filterObj.to_date ) + ' ' + filterObj.to_time;
            }

            if( filterObj.inc_deleted  == 1){
                filterTxt += ' Only Deleted';
            }

            if( filterTxt !== ''){
                $('#filterInfo').text( filterTxt );
                $('#mainFilterInfo').show();
            }

            obj.get_info        = 'filter_dates';
          
            obj.raffle          = $('#raffles_list option:selected').val(); 

            obj.is_pending      = $('#wc-pending').prop('checked') ? 1 : 0;
            obj.is_processing   = $('#wc-processing').prop('checked') ? 1 : 0;
            obj.is_on_hold      = $('#wc-on-hold').prop('checked') ? 1 : 0;
            obj.is_completed    = $('#wc-completed').prop('checked') ? 1 : 0;
            obj.is_cancelled    = $('#wc-cancelled').prop('checked') ? 1 : 0;
            obj.is_refunded     = $('#wc-refunded').prop('checked') ? 1 : 0;
            obj.is_failed       = $('#wc-failed').prop('checked') ? 1 : 0;
            
            drp_request_data( obj );
        });

        $('#ckbTypeData').on('change', function(){
            let _value = $(this).prop('checked');
            
            if( _value )
                obj.live_data = 1;
            else 
                obj.live_data = 0;

            drp_request_data( obj);    
        });

        $('#raffles_list').on('change', function(){
            $('#btnFilterSave').trigger('click');
        });

        $('#div_filter_status input:checkbox').on('change', function(){
            $('#btnFilterSave').trigger('click');
        });

        $('#filterClear').on('click', function(){
            $('#mainFilterInfo').hide();
            $('#filterInfo').text( '');
            filterObj.from_date = '';
            filterObj.to_date   = '';
            filterObj.from_time = '00:00';
            filterObj.to_time   = '23:59';
            filterObj.inc_deleted = 0;
            obj.inc_deleted = 0;
            ClearDateTimeFilter();
            drp_request_data( obj );
        });

        $('#btnFilterClear').on('click', function(){
            ClearDateTimeFilter();
        });

        $('#modalViewOrder').on('hidden.bs.modal', function () {
            $('#view_order_frame').prop('src', '#');
            $('#drpLoaderImg').hide(); 
        });   

        $('#btnBackup').on('click', function(){
            $('#modalBackup').modal({
                show : true,
                backdrop : 'static'
            });
        });

        $("[data-toggle='tooltip']").tooltip({
            trigger : 'hover',
        //    placement : 'auto',
            html : true
        });

        $('.clockpicker').clockpicker();
    });

    function ClearDateTimeFilter(){        
        $('#datepicker_from, #datepicker_to').val('');
        $('#timepicker_from').val('00:00');
        $('#timepicker_to').val('23:59');
       
    }

    function DateToString( $date ){
        let year, month, day;
        let $returnDate = '';
        if( $date !== null ){
            year = $date.getFullYear();
            month = $date.getMonth() + 1;
            if( month < 10 )
              month = '0' + month;
            day   = $date.getDate();
            if( day < 10 )
                day = '0' + day;
            $returnDate = year+'-'+ month + '-' + day;
        };

        return $returnDate;
    }

    function OpenOrderToNewWindow( order_url, order_no ){
        
        $('#view_order_frame').prop('src', order_url ).css('visibility', 'hidden')     
       
        let iframe = document.getElementById( 'view_order_frame');

        if( iframe !== null ){     
            iframe.height = '';
            iframe.height = window.innerHeight - 250 + 'px';

            $('#modalViewOrder').modal('show');        
            
            if( ! rpd_loaded_iframe ){
                iframe.onload = function(){    
                    rpd_loaded_iframe = true;
                    $('#drpLoaderImg').show();            
                    $(iframe.contentDocument ).find('#adminmenumain, #wpadminbar, .woocommerce-layout, .notice, #side-sortables, ' +
                    ' .wrap h1:first, .wrap a:first, #screen-meta-links').hide();            
                    $('#view_order_frame').css('visibility', 'visible');                                
                    $('#drpLoaderImg').hide();                                     
                };       
            }

            if( typeof order_no !== 'undefined')                      
                $('#modalViewOrder .modal-title').text('Order View ' + order_no); 
            else 
                $('#modalViewOrder .modal-title').text('Order View ');      
        }else{
            $('#drpLoaderImg').hide(); 
        }
    }

    function DateStrToString( $date ){
        
        let $return = '';
        if( $date.indexOf('-') > 0 ){
            let arrDate = $date.split('-');
          
            if( Array.isArray( arrDate ) && (arrDate.length > 1 )){
                $return =  arrDate[2]  + '-' +arrDate[1]  + '-' +  arrDate[0] ;
            }
        }

        return $return;
    }

    function drp_request_data( $obj, $callback ){
        $('#drpLoaderImg').show();
        var data_ajax = {
            action: $obj.action,
            type: 'POST',
            data: $obj,
            dataType: 'json', 
            contentType: 'application/json'
        }

        $obj.raffle_woo_nonce_name = $('#raffle_woo_nonce_name').val();
        
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: data_ajax,
            success: function(data){
                //should display a success/error message   

                try {
                    if( data == '' ){
                        $('.panel-heading').bmp_message( 'Error processing request. Empty data received.' );
                        $('#drpLoaderImg').hide(); 
                        return;                    
                    }
                   
                    let result_ = JSON.parse( data );
                    if( 'error' in result_ ){
                        alert( result_.error );
                        return false;
                    }
                } catch (error) {
                    console.log( error );
                }
         
                try {

                    if( (typeof  $obj.action_delete !== 'undefined') && ($obj.action_delete == "drp_delete_tickets") ){
                        let message = rpwoo_local_lng.records_deleted + ' ' + data;
                    
                        $('.panel-heading').bmp_message( message );
                        $('#raffles_list').trigger('change');
                        return;
                    }

                    if( $obj.get_info === 'get_order_link'){
                        data = decodeURIComponent(data );
                        data = data.replace( /&amp;/g, '&');

                        if( typeof $callback !=='undefined'){
                            let view_on_modal = $('#view_order_modal').prop('checked');
                            if( view_on_modal )
                                $callback( data, $obj.order_id );
                            else
                                window.location.href = data;
                        }
                    }else{
                        oData = JSON.parse( data );                                                        
                        drp_populate_table();
                    }
                } catch (error) {                  
                    //$( '.bmp-pins-new-panel .panel-heading').bmp_message( rpwoo_local_lng.error_parsing_data, 'danger' );                     
                } 
               
         
            },
            error: function( request, status, error ){              
                alert( 'Request ' + request + ' - Status: ' + status + ' - Error: ' + error);    
                $('#drpLoaderImg').hide(); 
            },
            complete: function(){
                if( $obj.get_info != 'get_order_link')
                    $('#drpLoaderImg').hide(); 
            }
        })
    };

    function drp_populate_table(){
        let drp_boot_table = $('#tbl_view');
           

        drp_boot_table.bootstrapTable('destroy').bootstrapTable({
            columns :[
                {
                    title : rpwoo_local_lng.order_id,
                    field : 'order_id',
                    align : 'center',
                    sortable : true,                 
                    formatter : function(value, row ){
                        
                        return '<div>' + value + ' <i class="fa fa-eye view-order-link"></i> ' + ' x ' + row.tickets_total +' </div>';                        
                    },
                    events :{
                        'click .view-order-link' : function( e, value, row ){
                            let $obj = {  
                                action : 'drp_get_data',                              
                                get_info : 'get_order_link',
                                order_id : value
                            };
                          drp_request_data( $obj, OpenOrderToNewWindow );                                                 
                        }
                    }
                },
                {
                    title : rpwoo_local_lng.raffle_ticket,
                    field : 'raffle_ticket',
                    align : 'center',
                    sortable : true,
                    formatter : function ( value, row ){
                        return '<div><i class="fa fa-edit btn-edit-ticket" title="Edit - PREMIUM"></i>' + row.raffle_ticket + ' </div>';                          
                    }
                },
                {
                    title : rpwoo_local_lng.total_tickets,
                    field : 'tickets_total',
                    hide: true
                },
                {
                    title : rpwoo_local_lng.order_sale,
                    field : 'price'
                },
                {
                    title : rpwoo_local_lng.product,
                    field : 'product_name'
                },
                {
                    title : rpwoo_local_lng.first_name,
                    field : 'first_name',
                    sortable : true
                },
                {
                    title : rpwoo_local_lng.last_name,
                    field : 'last_name',
                    sortable : true
                },
                {
                    title : rpwoo_local_lng.email,
                    field : 'email',
                    sortable : true
                },
                {
                    title : rpwoo_local_lng.phone,
                    field : 'phone',
                    sortable : true
                },
                {
                    title : rpwoo_local_lng.city,
                    field : 'city',
                    sortable : true
                },
                {
                    title : rpwoo_local_lng.country,
                    field : 'country',
                    sortable : true,
                    hide: true
                },
                
                {
                    title : rpwoo_local_lng.order_date_time,
                    field : 'created_at'
                }
            ],
            "footer" :{
                id : "footer",
                name : 'footer_name'
            },
            data : oData,
            cache : false,
            search : true,            
            showColumns: true, 
            showExport: true,
            showFooter : false,
            exportTypes: ['csv', 'txt', 'excel', 'pdf'],
            pagination: true,
            exportOptions : {
                'fileName' : 'raffle-data-' + todayDateFormat()
            },
            onPostBody : function(){               
                //$('[data-toggle="popover"]').popover();  
                $('#tbl_view tr').on('click', function(){
                    $('#tbl_view tr').removeClass('active-row');
                    $( this ).addClass('active-row');
                });           
            }
                 
        });

     
        drp_boot_table.bootstrapTable( 'hideColumn', columnsToHide() );

        $('.columns-right .dropdown-item input[type="checkbox"]').on('click', function(){
            let is_checked = $( this ).prop('checked');
            let name = $( this ).data('field');
            if( typeof visibleColumns[ name ]  !== 'undefined' ){
                visibleColumns[ name ] = is_checked;
                localStorage.setItem( rpd_local_columns, JSON.stringify( visibleColumns ));
            }
        });
    }

    function columnsToHide(){
        
        let result = [];
           
        for( const i in visibleColumns ){
            if( ! visibleColumns[i] )
                result.push( i );
        }            

        return result;
    }

    function todayDateFormat(){
        return (new Date()).toISOString();
    }

    function rpd_raffle_tickets_formatter( row ){        
        let tickets = '';        
        let from = parseInt( row.ticket_from );
        let to = parseInt( row.ticket_to );
       
        while( from <= to ){
            tickets += '#'+from + ' ';
            from++;
        };
       
        let popover = ' data-toggle="popover" data-placement="auto" data-trigger="hover" data-content="'+tickets+'" '; 
        return '<div '+popover+' class="raffle-tickets-data"><a>' + row.ticket_from + ' - ' + row.ticket_to + '</a></div>'; 
    }

})(this.jQuery);