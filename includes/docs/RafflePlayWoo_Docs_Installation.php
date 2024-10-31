<?php 
    if( ! defined('ABSPATH') ) die();
?>

    <div class="border border-info px-2">
        <p class='h4'><?php esc_html_e('Step One - Install the Plugin', 'raffle-play-woo'); ?></p>
        <p>
            <?php esc_html_e('The Plugin requires no special installation, just as any regular plugin proceed with instalation, and activation.', 'raffle-play-woo'); ?>
        </p>
    </div>

    <p></p>

    <div class="border border-info px-2">
        <p class='h4'><?php esc_html_e('Step Two - Create Raffle Product', 'raffle-play-woo'); ?></p>
        <p>
            <?php esc_html_e("Go to 'Products' page and create a new product. But don't leave the page yet.", 'raffle-play-woo'); ?>                        
        </p>
        <p>
            <?php esc_html_e("Under 'Product' page go to 'General' tab and you should see two extra options ", 'raffle-play-woo'); ?>                        
            <br/>
            <strong> <?php esc_html_e("Raffle Play Product", 'raffle-play-woo'); ?>  </strong> <?php esc_html_e("(Enable the option)", 'raffle-play-woo'); ?> 
            <br />
            <strong> <?php esc_html_e("Raffle Number or Tickets", 'raffle-play-woo'); ?> </strong> <?php esc_html_e("(Add Number of thickets for this raffle product)", 'raffle-play-woo'); ?>
            <br />            
        </p>

        <img src="<?php echo esc_url( RAFFLE_PLAY_WOO_URL.'/images/icons/info/products_raffle_product.png' ); ?>" alt="products raffle" />

        <p> <?php esc_html_e("For now your product is under the Default raffle ", 'raffle-play-woo'); ?>  </p>
    </div>
    
    <p></p>

    <div class="border border-info px-2">
        <p class='h4'><?php esc_html_e('Step Three - Configure Email Raffle Labels', 'raffle-play-woo'); ?></p>
        <p>
            <?php esc_html_e("Go to General Setting (Default Raffle)  and edit the 'Email Template' section.", 'raffle-play-woo'); ?>
            <br />
            <?php esc_html_e("These labels will show in the 'Thank you page' and the 'Confirmation Email' ", 'raffle-play-woo'); ?>
        
        </p>
        <img src="<?php echo esc_url( RAFFLE_PLAY_WOO_URL.'/images/icons/info/email_template_labels.png'); ?>"  alt="products raffle" />      
        
    </div>



    <p></p>

    <div class="border border-info px-2">
        <p class='h4'><?php esc_html_e('Finish', 'raffle-play-woo'); ?></p>
        <p ><?php esc_html_e('This is the minimal setup to have a raffle running', 'raffle-play-woo'); ?></p>
        <p ><?php esc_html_e('Good luck, and stay updated for new plugin changes on ', 'raffle-play-woo'); ?> 
            <a href='http://tuskcode.com' target='_blank'> tuskcode.com </a>  
        </p>

        <p ><?php esc_html_e("If you like this plugin don't forget to rate it", 'raffle-play-woo'); ?></p>
        <p ><?php esc_html_e("For suggestions email me at developer@tuskcode.com", 'raffle-play-woo'); ?></p>
    </div>