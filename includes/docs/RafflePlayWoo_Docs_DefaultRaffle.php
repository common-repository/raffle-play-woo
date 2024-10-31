<?php 
    if( ! defined('ABSPATH') ) die();
?>

    <div class="border border-info px-2">
        <p class='h4'><?php esc_html_e('General Settings', 'raffle-play-woo'); ?></p>
        <p>
            <?php esc_html_e('The Default Raffle is the main raffle, and all other raffles created inherit some of the settings from it', 'raffle-play-woo'); ?>
        </p>

        <p>
            <?php esc_html_e('Most of the settings found on this page are self explanatory.', 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e('Raffle Status', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e('It can be of type test, used for testing purposes, with special raffle numbers, and live.
             When finishing testing dont forget to switch to live.', 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e('Terminate Raffle', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e('The raffle will be terminated. No raffle tickets will be available for sale.', 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e('Live Tickets Start At', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("That's the starting point of the raffle tickets.", 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e('Limit number of tickets', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("The raffle will have a limited number of tickets", 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e('Ticket Prefix', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("Used with ticket number as Tkt-1001, Tkt-1002, etc. Instead of display a dull number as 1001, 1002", 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e('Raffle Start Date Time', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("Date and time when the raffle tickets are available for purchase", 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e('Raffle Start Date Time', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("Date and time when the raffle will end", 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e('Last Live Ticket', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("Informational - what's the last ticket purchased", 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e('Raffle Products', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("Informational - Shows the raffle products linked to this raffle", 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e('Raffle Duplicate Tickets', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("Informational - Might be the case when 2 raffle tickets to have the same number (should not happen)", 'raffle-play-woo'); ?>
        </p>
    </div>

    <p></p>

    <div class="border border-info px-2">
        <p class='h4'><?php esc_html_e('Email Template', 'raffle-play-woo'); ?></p>
        <p>      
            <?php esc_html_e("Labels and info that will show in the email confirmation, and thank you page", 'raffle-play-woo'); ?>
            <br />
            <?php esc_html_e("Any fields left empty will not be displayed", 'raffle-play-woo'); ?>
        </p>
        <p>
            <strong> <?php esc_html_e('Header Text', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("Info about the raffle", 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e('Raffle Name', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("Show raffle name", 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e('Body Tickets', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("Tickets Info", 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e('Extra Info Line', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("Extra information about the raffle (like when/where the draw is taking place)", 'raffle-play-woo'); ?>
            <br />
            <?php esc_html_e("***Or it can be left empty***", 'raffle-play-woo'); ?>>
        </p>

        <p>
            <strong> <?php esc_html_e('Ticket Info Position', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("In the email can be positioned in different places", 'raffle-play-woo'); ?>
        </p>
    </div>
    
    <p></p>

    <div class="border border-info px-2">
        <p class='h4'><?php esc_html_e('User Messages', 'raffle-play-woo'); ?></p>
        <p>
            <?php esc_html_e("User Message are very effective on showing the tickets status to the users", 'raffle-play-woo'); ?>
            <br />
            <?php esc_html_e("Messages are connected to general settings like terminated, start/end dates etc", 'raffle-play-woo'); ?>
            <?php esc_html_e("*** Leave empty not to display ***", 'raffle-play-woo'); ?>
            <?php esc_html_e("*** To display copy the short code and paste it into the post/page ***", 'raffle-play-woo'); ?>
        
        </p>

        <p>
            <strong> <?php esc_html_e('Raffle is Termindated', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("The raffle is set as terminated", 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e("Raffle hasn't started yet", 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("Start date is later than today - notify user - %s as start date", 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e("Raffle has ended", 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("End date is set as early than today - notify user - %s as end date", 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e("Raffle will end", 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("Raffle has an ending date - notify user - %s as end date", 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e("Add to Cart (no tickets left)", 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("The raffle has limited tickets - Upon adding to cart, the system checks if any tickets left, if not show message ", 'raffle-play-woo'); ?>

        </p>

        <p>
            <strong> <?php esc_html_e("Add to Cart (exceeding tickets %d)", 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("The raffle has limited tickets - notify user - eg: 3 tickets left, user wants to buy 5, exceeds with 2 - show message", 'raffle-play-woo'); ?>
        </p>

        <p>
            <strong> <?php esc_html_e("Update Cart (exceeding tickets %d)", 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("Same as the above one. The check is done on update cart", 'raffle-play-woo'); ?>
        </p>

        
    </div>

    <p></p>

    <div class="border border-info px-2">
        <p class='h4'><?php esc_html_e('Multiple Raffles', 'raffle-play-woo'); ?></p>
        <p>      
            <?php esc_html_e("Setting when running multiple raffless at the same time", 'raffle-play-woo'); ?>
        </p>
        <p>
            <strong> <?php esc_html_e('One Raffle Tickets at checkout', 'raffle-play-woo'); ?> </strong> <span> </span>
            <?php esc_html_e("Restrict the user of adding mixed raffle tickets at checkout. Some customers want only one raffle tickets at checkout", 'raffle-play-woo'); ?>
        </p>

        <p>         
            <?php esc_html_e("Off as Default", 'raffle-play-woo'); ?>
        </p>


    </div>

    <div class="border border-info px-2">
        <p class='h4'><?php esc_html_e('Test Info', 'raffle-play-woo'); ?></p>
        <p>      
            <?php esc_html_e("Used with 'Test' option in the settings", 'raffle-play-woo'); ?>
        </p>

        <p>      
            <?php esc_html_e("Before going live with the raffle as a good practice is good to do a few tests, this will give you an idea how the system works", 'raffle-play-woo'); ?>
        </p>

    </div>