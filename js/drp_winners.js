(function($){
    'use strict';

    var selected_row = -1;

    $(document).ready(function(){
        Init();
        ShowTable();
    });

    function Init(){
        $('.btn-add').on('click', function(){
            ResetModal();
            $('#modalSaveEdit').modal({
                show: true,
                backdrop: 'static'
            });

        });
    }


    function ResetModal(){
        $('#prize_name').val('');
        $('#raffles_list option:first').prop('selected', true );
        $('#ticket_no').val('');
        $('#extra_info').val('');
    }


    function ShowTable(){

        let rpwoo_data = [
            { 
                id: '',
                order_id : '',
                prize: '',
                raffle_ticket : '',
                raffle_name : '',
                first_name :'',
                last_name : '',
                phone : '', 
                email : '',
                address_one : '',
                address_two : ''
            }
        ];

        $('#raffle_winners_table').bootstrapTable('destroy').bootstrapTable({
            columns: [
                {
                    title : rpwoo_local_lng.id,
                    field : 'id',
                    align : 'center',                  
                    visible : false
                },
                {
                    title : rpwoo_local_lng.order_id,
                    field : 'order_id',
                    sortable : true
                },
                {
                    title : rpwoo_local_lng.prize,
                    field : 'prize',
                    sortable : true
                },                
                {
                    title : rpwoo_local_lng.ticket,
                    field : 'raffle_ticket',
                    sortable : true
                },
                {
                    title : rpwoo_local_lng.raffle_name,
                    field : 'raffle_name',
                    sortable : true,
                    formatter : function ( value, row ){
                        //
                        return value;
                    }
                },
                {
                    title : rpwoo_local_lng.first_name,
                    field : 'first_name'
                },

                {
                    title : rpwoo_local_lng.last_name,
                    field : 'last_name'
                },
                {
                    title : rpwoo_local_lng.phone,
                    field : 'phone'
                },

                {
                    title : rpwoo_local_lng.email,
                    field : 'email'
                },

                {
                    title : rpwoo_local_lng.address,
                    field : 'address_one',
                    formatter : function( value, row ){
                        if( row.address_two != null )
                            return row.address_one + ' ' + row.address_two;
                        else 
                            return row.address_one;
                    }
                },
                {
                    title : rpwoo_local_lng.address,
                    field : 'address_two',
                    visible : false
                },

                {
                    title : rpwoo_local_lng.country,
                    field : 'country'
                },

                {
                    title : rpwoo_local_lng.county,
                    field : 'county'
                },
                {
                    title : rpwoo_local_lng.extra_info,
                    field : 'extra_info',
                    align : 'center',
                    formatter : function( value, row ){                                                                                                   
                        return "<i data-toggle='tooltip' data-placement='right'  class='fas fa-info-circle text-info' style='cursor: pointer;''></i>";
                    }
                }

            ],
            data : rpwoo_data,           

        });

        return false;
    }

})(this.jQuery);