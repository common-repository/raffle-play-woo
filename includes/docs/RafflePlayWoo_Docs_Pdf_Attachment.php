<?php 
    if( ! defined('ABSPATH') ) die();
?>


    <div class="border border-info px-2">
        <p class='h4'><?php esc_html_e('PDF Email Attachment', 'raffle-play-woo'); ?></p>

        <p>
            <?php
                $link_documentation = sprintf( __("Each Setting explained for PDF Attachment. View %s "), "<a href='https://tuskcode.com/setup-pdf-attachment-raffle-play-woo-premium/' target='_blank'> HERE </a>");    
                esc_html_e( $link_documentation );
            ?>
        </p>

        <p>
            <?php
                $link_documentation = sprintf( __("Documentation - How to add custom data to pdf. View %s "), "<a href='https://tuskcode.com/pdf-attachment-custom-hooks/' target='_blank'> HERE </a>");    
                esc_html_e( $link_documentation );
            ?>
        </p>


    </div>

    <p></p>