<?php

defined('ABSPATH') || exit;

// TEMPLATE TO DISPLAY RAFFLE TICKETS IN THANK YOU PAGE AND EMAIL

//BE AWARE WHEN EDITING THIS TEMPLATE FOR NOT BREAKING IT

/* HOW TO USE CUSTOM CODE WITHOUT BREAKING WHEN UPDATING THE PLUGIN
   STEP 1: MOVE THIS FILE TO YOUR CHILD CHILD-THEME/WOOCOMMERCE/INCLUDES/TEMPLATES/ 
   SETP 2: MAKE CHANGES TO THE FILE 
*/


?>
    <section class='woocommerce-order-details'>

<?php


if($email_header !== ''){

    if( $type == 'admin'){  
        echo "<h2 class='woocommerce-order-details__title form-field form-field-wide'>".esc_html( $email_header )."</h2>";
    }else{
        echo "<h2 class='woocommerce-order-details__title'>".esc_html( $email_header )."</h2>";
    }
}
?>

<style>
    .raffle-table
    .div-ticket-wrapper{
        background-repeat: no-repeat;
        background-size: 100%;       
        text-align: center; 
        display: inline-block;     
        margin-left: 6px;
        height: 42px;  
        width:  80px; 
        line-height: 45px;  
        transform: rotate( 0deg );  /* add -10 to tilt the image a bit */
        margin-top: 2px;
        margin-bottom: 2px;
        text-wrap: nowrap;        
    }

    .raffle-table
    .ticket-image-container{
        font-weight: 600;
    }
    .raffle-table
    tr
    td{
        font-size: .85rem;  
        color: #000;   
        font-weight: 600;       
    }
</style>

<table style='width: 100%; margin-bottom:40px; font-weight: 600; border-collapse: collapse;' 
        class='shop_table additional_info raffle-table'>
    <tbody>
    
        <?php   

      
        foreach( $info_data as $raffle=>$tickets_row ){
            $tickets_str = '';
            $extra_row_email = '';                                  

            if( isset( $ticket_image[ 0 ] ) && $ticket_image[ 0 ]->show == 'yes' ){

                $bg_image = '';
                $ticket_image_obj = $ticket_image[ 0 ];
                $ticket_image_sel = '';

                if( $ticket_image_obj->ticket_image == 'custom' )
                    $ticket_image_sel = esc_url( $ticket_image_obj->ticket_image_url );
                else
                    $ticket_image_sel = esc_url( RAFFLE_PLAY_WOO_URL . '/images/ticket-image-' . $ticket_image_obj->ticket_image . '.png' );    
                
                
                if( is_array( $tickets_row['tickets'] ) ){
                    foreach( $tickets_row['tickets'] as $ticket_no ){
                        $ticket_no = esc_html( $ticket_no );
                        $tickets_str .= "<div class='div-ticket-wrapper'" . 
                                                " style=\"background-image: url('{$ticket_image_sel}');\" >" .
                                                "<div class='ticket-image-container'> {$ticket_no} </div>" .
                                             "</div>";
                    }
                }
            }else{

                if( is_array( $tickets_row['tickets'] )){
                    $tickets_str = implode( ', ', $tickets_row['tickets'] );
                }     
            }                              
        ?>
        
        <?php if( $inc_raffle_name ) { ?>
            <tr>
                <td style="font-weight: 600; color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:center;"><?php
                    echo esc_html( $raffle ) ; ?>
                </td>
            </tr>
        <?php } ?>

        <?php if( $email_body != '' ){ ?>
            <tr>
                <td style="font-weight: 600; color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:center;"><?php echo $email_body; ?></td>
            </tr>
        <?php } ?>  

        <tr>
            <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:center" > 
                <?php echo $tickets_str; ?> 
            </td>                          
        </tr>

        <?php 

            if( $extra_row_email !== '' ){ ?>
                <tr>                             
                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:center;" 
                        colspan='<?php echo esc_html( $col_span ); ?>'> 
                    <?php echo esc_html( $extra_row_email ); ?> </td>                                                       
                </tr>  

        <?php
                }
                
            } 
                                
        ?>
    </tbody>
</table>

</section>