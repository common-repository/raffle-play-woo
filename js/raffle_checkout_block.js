
try {
    
    if( typeof raffle_block_location !== 'undefined' && typeof raffle_block_admin_url !== 'undefined' ){

        let total_block = jQuery( raffle_block_location );
    
        if( total_block !=  null ){
            setTimeout( ()=>{
                    jQuery.get( raffle_block_admin_url, function( data ) {
                        if( data == '') {
                        
                        }else if( data == 'not_verify'){
                            //page did not verify
                        }else{
                            let newDiv = jQuery("<div class='raffle-tickets-generated-checkout' style='display:none; margin-top: 8px;'></div>").html( data );
                            jQuery( newDiv ).insertAfter( jQuery( raffle_block_location ) ).fadeIn( 2000 );
                        }
                    });
                }, 500 );

        }
    }
    
} catch (error) {
    console.log( error );
}
