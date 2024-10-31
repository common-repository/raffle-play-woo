(function($){
    "use strict";
    var selected_row = -1;
    var current_date = 0;
    const D_FUTURE_2099 = 4073587200;

    $(document).ready(function(){
        
        Init();

        ShowTable();    

    });

    function Init(){

             
        $('.btn-add').on('click', function(){
        
            $('#modalSaveEdit .modal-title').text( rpwoo_local_lng.new_raffle );
            $('#modal_action').val('-1');
            $('#modalSaveEdit').modal({
                backdrop: 'static',
                show : true
            });
        });

        $('.btn-edit').on('click', function(){
        

            $('#modalSaveEdit .modal-title').text( rpwoo_local_lng.edit_raffle );
            $('#modalSaveEdit').modal({
                backdrop: 'static',
                show : true
            });
            
        });

        $('#email_extra_inherit').on('change', function(){
            
            if( $( this ).prop('checked') ){
               $('#email_extra').prop('readonly', true); 
            }else{
                $('#email_extra').prop('readonly', false );
            }
        });

        $('#btnSave').on('click', function(){                               
           $('#modalSaveEdit').modal('hide'); 

        });

        $('#datepicker_from, #datepicker_to').datepicker({
            yearRange : '2016:' + ( (new Date()).getFullYear() + 4),
            dateFormat : 'dd-mm-yy',
            changeMonth: true, 
            changeYear: true
        });
    }

    function getRaffleInfo( raffle_id ){

        let wrapper = '<div class="min-width-120">';
        let raffle_item = null;
        for( let i = 0; i<rpwoo_data.length; i++ ){
            let item = rpwoo_data[i];
            if( item.id == raffle_id ){
                raffle_item = item;
                break;
            }
        }

        if( raffle_item !== null ){
          
            wrapper += '<p class="center-text"><b> ' + raffle_item.name  + '</b></p>';
            wrapper += '<p> <span class="left-text" > ' + rpwoo_local_lng.last_ticket + '<span> - ' + ( ( raffle_item.extra_info.last_sold == '') ? 'N/A' : raffle_item.extra_info.last_sold ) + '</p>';
            wrapper += '<p> <span class="left-text" > ' + rpwoo_local_lng.sold_tickets + '<span> - ' + ( raffle_item.extra_info.sold_no)  + '</p>';
        }
        wrapper += '</div>';


        return wrapper;
    }

    function ShowTable(){

        $('#raffle_product_table').bootstrapTable('destroy').bootstrapTable({
            columns: [
                {
                    title : rpwoo_local_lng.id,
                    field : 'id',
                    align : 'center',                  
                    visible : false
                },
                {
                    title : rpwoo_local_lng.raffle_name,
                    field : 'name',
                    sortable : true,
                    formatter : function ( value, row ){
                        //
                        let valid_dates = isValidDates( row.start_datetime, row.end_datetime, row.now_time );

                        if( ! row.is_live )
                            value = "<i class='fa fa-tools'></i> " + value;
                        

                        if( row.is_terminated || ( ! valid_dates ) ) 
                            return "<div class='ended-raffle'></div> " +  value;
                        else
                            return "<div class='live-raffle'></div> " +  value;
                    }
                },
                {
                    title : rpwoo_local_lng.start_ticket,
                    field : 'start_ticket',
                    sortable : true
                },            

                {
                    title : rpwoo_local_lng.live,
                    field : 'is_live',
                    sortable : true,
                    formatter : function(value, row ){                   
                        if( value )
                            return rpwoo_local_lng.yes
                        else 
                            return rpwoo_local_lng.test
                    }
                },
                {
                    title : rpwoo_local_lng.terminated,
                    field : 'is_terminated',
                    sortable : true,
                    formatter : function(value, row ){                   
                        if( value )
                            return rpwoo_local_lng.yes
                        else 
                            return rpwoo_local_lng.no
                    }
                },  
                {
                    title : rpwoo_local_lng.prefix,
                    field : 'prefix'
                },

                {
                    title : rpwoo_local_lng.limited,
                    field : 'is_limit',
                    sortable : true,

                    formatter : function(value, row ){   
  
                        let limit_no_txt = '';
                        if( row.limit_no != 0 ){
                            limit_no_txt = ' - ' + row.limit_no;
                        }
                        if( value )
                            return rpwoo_local_lng.yes + limit_no_txt;
                        else 
                            return rpwoo_local_lng.no + limit_no_txt;
                    }
                },
                {
                    title : rpwoo_local_lng.limit_no,
                    field : 'limit_no',
                    sortable : true,
                    visible : false
                },
                {
                    title : rpwoo_local_lng.start_date,
                    field : 'start_date_str',
                    formatter : function( value, row ){
                        return value + ' ' + row.start_timestr;
                    }
                },
                {
                    title : rpwoo_local_lng.end_date,
                    field : 'end_date_str',
                    formatter : function( value, row ){                        
                        return value + ' ' + row.end_timestr;
                    }
                },
                {
                    title : rpwoo_local_lng.products,
                    field : 'products',
                    formatter : function( value, row ){
                        let products = [];
              
                        for( const prod in value ){
                            products.push( value[ prod.toString() ] );   
                        }
                        return products.join(', ');
                    }
                },
                {
                    title : rpwoo_local_lng.shortcode + ' ' + shortcodeInfo(),
                    field : 'shortcode'
                },
                {
                    title : rpwoo_local_lng.info,
                    field : 'id',
                    align : 'center',                   
                    formatter : function( value, row ){                                       
                        let info = getRaffleInfo( value );                                          
                        return "<i data-toggle='tooltip' data-placement='right' title='"+ info.toString() + 
                                "' class='fas fa-info-circle text-info' style='cursor: pointer;''></i>";
                    }
                },

            ],
            data : rpwoo_data,
            onPostBody : function(){               
                $('[data-toggle="tooltip"]').tooltip({
                    trigger : 'hover',
                    placement : 'auto',
                    html : true
                });   
                
                $('#raffle_product_table tbody tr').on('click', function(){
                    $('#raffle_product_table tbody tr').removeClass('active-row');
                    $( this ).addClass('active-row');
                    selected_row = parseInt( $( this ).attr('data-index') ) + 1;
                   
                }); 
                
                if( rpwoo_data.length > 0 ){
                    if( selected_row == -1 &&  $('#raffle_product_table tbody tr').length > 0 )
                        $('#raffle_product_table tbody tr:first').click(); 

                    if( selected_row != -1 ){
                        $('#raffle_product_table tbody tr:nth-child(' + selected_row +')').click();  
                    }
                }
            }

        });

        return false;
    }

    function shortcodeInfo(){
        let info = rpwoo_local_lng.shortcode_info + "<p>[raffle name=\"msg\" id=\"99\" show_raffle_name=\"1\"]</p>" ;
        return "<i data-toggle='tooltip' data-placement='right' title='"+ info.toString() + 
        "' class='fas fa-info-circle text-info' style='cursor: pointer;''></i>";
    }



})(this.jQuery);