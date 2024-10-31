<?php

namespace RafflePlayWoo_Plugin;

include_once( 'RafflePlayWoo_LifeCycle.php');
include_once( 'd/D_RafflePlayWoo_Main.php');
include_once( WP_PLUGIN_DIR .'/woocommerce/includes/blocks/class-wc-blocks-utils.php');

if( ! defined('ABSPATH') )
    die('No Access to this page');


use RafflePlayWoo_LifeCycle;
use RafflePlayWoo_MainTbl;

class RafflePlayWoo_Plugin extends RafflePlayWoo_LifeCycle\RafflePlayWoo_LifeCycle{
    
    public function getPluginDisplayName(){
        return 'Raffle Play Woo';
    }

    protected function getMainPluginFileName(){
        return 'raffle-play-woo.php';
    }

    private function createMainTables( $table_name, $charset_collate ){

        $backup_field = "backup_name varchar(30) default '',";
        if( $table_name !== $this->prefixTableName('main_bk') )
            $backup_field = "";

        $sql_query =  "CREATE TABLE IF NOT EXISTS {$table_name} (
                    id mediumint(5) NOT NULL auto_increment,
                    order_id int(10) NOT NULL default '0',                            
                    customer_id int(5) NOT NULL default '0',
                    product_id  int(5) NOT NULL default '0',
                    ticket int(10) NOT NULL default '0',
                    quantity int(5) NOT NULL default '0',                                   
                    tickets_purchased int(5) NOT NULL default '0',
                    catid_one int(5) NOT NULL default '0',
                    catid_two int(5) NOT NULL default '0',
                    catid_three int(5) NOT NUll default '0',
                    ticket_no int(10) NOT NULL default '0',
                    ticket_from int(10) NOT NULL default '0',
                    ticket_to int(10) NOT NULL default '0',                            
                    ticket_txt text NOT NULL default '',
                    total_price float NOT NULL default '0.0', 
                    live_order int(1) NOT NULL default '0',
                    deleted int(1) NOT NULL default '0', 
                    order_status varchar(30) default '',
                    woo_session_id varchar(200) default '',
                    extra_one text default '',
                    reserved int(1) NOT NULL default '0',
                    {$backup_field}                   
                    created_at datetime NOT NULL default CURRENT_TIMESTAMP,                                 
                    PRIMARY KEY  (id),
                    KEY order_id (order_id),                            
                    KEY customer_id (customer_id),
                    KEY product_id (product_id),
                    KEY ticket (ticket),
                    KEY ticket_no (ticket_no),
                    KEY catid_one (catid_one),
                    KEY catid_two (catid_two),
                    KEY order_status (order_status),
                    KEY created_at (created_at),
                    KEY live_order (live_order),
                    KEY woo_session_id (woo_session_id),
                    KEY reserved (reserved)
                ) $charset_collate;";  

        return $sql_query;
    }

    private function createAuditTable( $table_name, $charset_collate ){
        $sql_query =  "CREATE TABLE IF NOT EXISTS {$table_name} (
                    id mediumint(5) NOT NULL auto_increment,
                    order_id int(5) NOT NULL default '0',
                    action_type varchar(30) NOT NULL default '',
                    product_id int(5) NOT NULL default '0',
                    customer_id int(5) NOT NULL default '0',
                    old_value varchar(30) NOT NULL default '',
                    new_value varchar(30) NOT NULL default '',
                    action_txt  varchar(200) NOT NULL default '',
                    created_at datetime NOT NULL default CURRENT_TIMESTAMP, 
                    created_by int(5) NOT NULL default '0',                                
                    PRIMARY KEY  (id),
                    KEY order_id (order_id),
                    KEY product_id (product_id),
                    KEY customer_id (customer_id),
                    KEY action_type (action_type)                   
                ) $charset_collate;"; 
        return $sql_query;
    }

    private function createRaffleTable( $table_name, $charset_collate ){
        $sql_query =  "CREATE TABLE IF NOT EXISTS {$table_name} (
                    raffle_id mediumint(5) NOT NULL auto_increment,
                    r_name varchar(50) NOT NULL default '',
                    is_live int(1) NOT NULL default '1',
                    is_terminated int(1) NOT NULL default '0',
                    start_ticket int(10) NOT NULL default '1000',
                    last_purchased int(10) NOT NULL default '0',
                    is_limit int(1) NOT NULL default '0',
                    limit_no int(10) NOT NULL default '0',
                    prefix varchar(20) NOT NULL default '',
                    start_datetime int NOT NULL default '0',
                    end_datetime int NOT NULL default '0',
                    extra_email text NOT NULL default '',
                    extra_email_in int(1) NOT NULL default '0',
                    deleted int(1) NOT NULL default '0',
                    shortcode varchar(50) NOT NULL default '',
                    shrt_extra varchar(150) NOT NULL default '',
                    shrt_ckb  int(1) NOT NULL default '0',
                    field_logic int(1) NOT NULL default '0',
                    field_int int(10) NOT NULL default '0',
                    field_char varchar(100) NOT NULL default '',                             
                    PRIMARY KEY  (raffle_id),
                    KEY is_live (is_live)                
                ) $charset_collate;"; 

        return $sql_query;

    }

    private function createWinnersTable( $table_name, $charset_collate ){
        $sql_query =  "CREATE TABLE IF NOT EXISTS {$table_name} (
            id mediumint(5) NOT NULL auto_increment,
            ticket int(12) NOT NULL default '0',
            raffle_id int(5) NOT NULL default '0', 
            prize varchar(50) NOT NULL default '',
            extra_text varchar(200) NOT NULL default '',
            extra_text_two varchar(200) NOT NULL default '',
            extra_ckb int(1) NOT NULL default '0',  
            deleted int(1) NOT NULL default '0',                 
            PRIMARY KEY  (id),
            KEY ticket (ticket),
            KEY raffle_id (raffle_id)                
        ) $charset_collate;"; 

        return $sql_query;
    }

    private function createRaffleProductTableJoin( $table_name, $charset_collate ){
        $sql_query =  "CREATE TABLE IF NOT EXISTS {$table_name} (
            id mediumint(5) NOT NULL auto_increment,
            product_id int(5) NOT NULL default '0',
            raffle_id int(5) NOT NULL default '0',                     
            PRIMARY KEY  (id),
            KEY product_id (product_id),
            KEY raffle_id (raffle_id)                
        ) $charset_collate;"; 

        return $sql_query;
    } 
    

    protected function installDatabaseTables(){
        global $wpdb;
       
        $table_main         = $this->prefixTableName('main');
        $table_main_b       = $this->prefixTableName('main_bk');
        $table_audit        = $this->prefixTableName('audit');  
        $table_r_product    = $this->prefixTableName('raffle');     
        $table_r_p_join     = $this->prefixTableName('product');
        $table_winners      = $this->prefixTableName('winners');

        $charset_collate    = $wpdb->get_charset_collate();
          
        $sql_main           = $this->createMainTables( $table_main, $charset_collate );

        $sql_main_b         = $this->createMainTables( $table_main_b, $charset_collate );

        $sql_audit          = $this->createAuditTable( $table_audit, $charset_collate );   

        $sql_raffle         = $this->createRaffleTable( $table_r_product, $charset_collate );

        $sql_r_p_join       = $this->createRaffleProductTableJoin( $table_r_p_join, $charset_collate );

        $sql_winners        = $this->createWinnersTable( $table_winners, $charset_collate );

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        dbDelta( $sql_main );  
        dbDelta( $sql_main_b ) ;    
        dbDelta( $sql_audit  ); 
        dbDelta( $sql_raffle );
        dbDelta( $sql_r_p_join );
        dbDelta( $sql_winners );
        
        //check if tables were installed
        $db_obj = new RafflePlayWoo_MainTbl\RafflePlayWoo_MainTbl();
        $tables_created = $db_obj->checkDbHealth();
        $this->setTablesCreated( $tables_created ); 
        
        try {
            $winners_columns = $wpdb->get_results(" SHOW COLUMNS FROM {$table_winners} ");     
     
            if( ! $this->bmp_hasColumn( $winners_columns, 'order_id') ){          
                $wpdb->query("ALTER TABLE {$table_winners   } ADD order_id int NOT NULL DEFAULT '0' ");
            }
        } catch (\Throwable $th) {
            //throw $th;
            RafflePlayWoo_error_log( 'installDatabaseTables - ' . $th->getMessage() );
        }

        //add session id to main table
        try {
            $main_columns = $wpdb->get_results(" SHOW COLUMNS FROM {$table_main} ");     
     
            if( ! $this->bmp_hasColumn( $main_columns, 'woo_session_id') ){          
                $wpdb->query("ALTER TABLE {$table_main} ADD woo_session_id varchar(200) NOT NULL DEFAULT '' ");
                $wpdb->query("ALTER TABLE {$table_main} ADD KEY woo_session_id (woo_session_id)");
            }
        } catch (\Throwable $th) {
            RafflePlayWoo_error_log( 'Raffle Play woo - Error adding column woo_session_id ' . $th->getMessage() );            
        }

        //add extra_one to main table
        try {
            $main_columns = $wpdb->get_results(" SHOW COLUMNS FROM {$table_main} ");     
        
            if( ! $this->bmp_hasColumn( $main_columns, 'extra_one') ){          
                $wpdb->query("ALTER TABLE {$table_main} ADD extra_one text NOT NULL DEFAULT '' ");
               
            }
        } catch (\Throwable $th) {
            RafflePlayWoo_error_log( 'Raffle Play woo - Error adding column extra_one - ' . $th->getMessage());
        }

        //add reserved to main table
        try {
            $main_columns = $wpdb->get_results(" SHOW COLUMNS FROM {$table_main} ");     
        
            if( ! $this->bmp_hasColumn( $main_columns, 'reserved') ){          
                $wpdb->query("ALTER TABLE {$table_main} ADD reserved int(1) NOT NULL DEFAULT '0' ");
                $wpdb->query("ALTER TABLE {$table_main} ADD KEY reserved (reserved)");
            }
        } catch (\Throwable $th) {
            RafflePlayWoo_error_log( 'Raffle Play woo - Error adding column reserved - ' . $th->getMessage() );            
        }
    
    }

    private function bmp_hasColumn( $arrColumns, $colName ){
        if( is_array( $arrColumns ) ){
            foreach( $arrColumns as $column ){
                if( $column->Field == $colName ){
                    return true;                
                }
            }
        }
        return false;
    }

    private function drp_local_txt(){
        //here goes all the localization to front-end
        return array(
            'saved'                 => __('Saved', 'raffle-play-woo' ),
            'error_parsing_data'    => __ ('Error Parsing Data', 'raffle-play-woo'),
            'order_id'              => __('Order Id', 'raffle-play-woo' ),
            'ticket'                => __('Ticket', 'raffle-play-woo'),
            'ticket_from'           => __('Ticket From', 'raffle-play-woo'),
            'ticket_to'             => __('Ticket To', 'raffle-play-woo'),
            'no_tickets'            => __('No Tickets', 'raffle-play-woo'),
            'total_tickets'         => __('Total Tickets', 'raffle-play-woo'),
            'order_sale'            => __('Order Sale', 'raffle-play-woo'),
            'first_name'            => __('First Name', 'raffle-play-woo'),
            'last_name'             => __('Last Name', 'raffle-play-woo'),
            'email'                 => __('Email', 'raffle-play-woo'),
            'customer_id'           => __('Customer Id', 'raffle-play-woo'),
            'order_date_time'       => __('Order Date/Time', 'raffle-play-woo'),
            'raffle_ticket'         => __('Raffle Ticket', 'raffle-play-woo'),
            'invalid_number'        => __('Invalid Number', 'raffle-play-woo'),
            'greater_than_zero'     => __('Should be greater than zero', 'raffle-play-woo' ),
            'country'               => __('Country', 'raffle-play-woo' ),
            'county'                => __('County', 'raffle-play-woo' ),
            'phone'                 => __('Phone', 'raffle-play-woo' ),
            'city'                  => __('City', 'raffle-play-woo' ),
            'id'                    => __('Id', 'raffle-play-woo' ),
            'raffle_name'           => __('Raffle Name', 'raffle-play-woo' ),
            'live'                  => __('Live', 'raffle-play-woo' ),
            'terminated'            => __('Terminated', 'raffle-play-woo' ),
            'yes'                   => __('Yes', 'raffle-play-woo' ),
            'no'                    => __('No', 'raffle-play-woo' ),
            'products'              => __('Products', 'raffle-play-woo' ),
            'product'               => __('Product', 'raffle-play-woo' ),
            'limited'               => __('Limited', 'raffle-play-woo' ),
            'limit_no'              => __('Limit No', 'raffle-play-woo' ),
            'info'                  => __('Info', 'raffle-play-woo' ),
            'start_ticket'          => __('Start Ticket', 'raffle-play-woo' ),
            'new_raffle'            => __('New Raffle', 'raffle-play-woo' ),
            'edit_raffle'           => __('Edit Raffle', 'raffle-play-woo' ),
            'no_row_selected'       => __('No Row Selected', 'raffle-play-woo' ),
            'no_raffle_selected'    => __('No Raffle Selected', 'raffle-play-woo' ),
            'raffle_name_required'  => __('Raffle Name Required', 'raffle-play-woo' ),
            'invalid_start_ticket'  => __('Invalid Start Ticket Number', 'raffle-play-woo'),
            'invalid_limit_no'      => __('Invalid Limit Number', 'raffle-play-woo' ),
            'start_date'            => __('Start Date', 'raffle-play-woo' ),
            'end_date'              => __('End Date', 'raffle-play-woo' ),
            'prefix'                => __('Prefix', 'raffle-play-woo' ),
            'test'                  => __('Test', 'raffle-play-woo' ),
            'last_ticket'           => __('Last Ticket', 'raffle-play-woo' ),
            'sold_tickets'          => __('Sold Tickets', 'raffle-play-woo' ),
            'shortcode'             => __('Shortcode', 'raffle-play-woo'),
            'address'               => __('Address', 'raffle-play-woo'),
            'extra_info'            => __('Extra Info', 'raffle-play-woo'),
            'invalid_ticket_no'     => __('Invalid Ticket Number', 'raffle-play-woo'),
            'prize'                 => __('Prize', 'raffle-play-woo' ),
            'delete_row_confirm'    => __('Are you sure you want to delete it?', 'raffle-play-woo'),
            'shortcode_info'        => __("To display the raffle name add show_raffle_name in the shortcode", 'raffle-play-woo'),
            'raffle'                => __("Raffle", 'raffle-play-woo'),
            'delete_raffle_tkts'    => __("Are you sure you want to delete this raffle's tickets?", 'raffle-play-woo'),
            'records_deleted'       => __("Records Deleted", 'raffle-play-woo' ),
            'duplicated_meta_name'  => __("Warning. There is another column with same DB Meta Name", 'raffle-play-woo' )
        );

    }

    protected function uninstallDatabaseTables(){
    }

    public function upgrade(){
    }


    public function addActionsAndFilters(){    
  
        add_action('admin_menu', array(&$this, 'addMenuPages'));     
        add_action('admin_enqueue_scripts', array( &$this, 'pw_load_scripts')); 

        add_action( 'wp_enqueue_scripts', array( &$this, 'load_extra_scripts') );

        add_filter( 'woocommerce_product_data_tabs', array( &$this, 'drp_woo_custom_raffle_tab' ) );
        add_action( 'woocommerce_product_data_panels', array( &$this, 'drp_woo_custom_product_data_fields' ));

        if( $this->get_showOrdersTable() == 'yes'){
            add_filter( 'woocommerce_shop_order_list_table_columns', array( &$this, 'drp_table_shop_order_column' ), 20, 1);
            add_action( 'woocommerce_shop_order_list_table_custom_column', array( &$this, 'drp_render_custom_column' ), 20, 2 );
        }
 
    //    add_action( 'woocommerce_product_options_general_product_data', array( &$this, 'drp_woo_product_checkbox' ) );
        add_action( 'woocommerce_process_product_meta', array( &$this, 'drp_woo_save_custom_fields' ), 10, 1);
        
        add_action( 'woocommerce_admin_order_data_after_order_details', array( &$this, 'drp_display_order_data_in_admin'), 20, 1 ); //admin order view
        add_filter( 'manage_edit-product_columns', array( &$this, 'drp_add_product_column' ), 10, 1 );
        add_action( 'manage_product_posts_custom_column', array( &$this, 'drp_product_column_raffle'), 11, 2 );
        add_filter( 'plugin_row_meta',  array( &$this, 'drp_woo_plugin_links'), 10, 2 ); 
        
        add_action( 'woocommerce_email_after_order_table', array( &$this, 'drp_order_email_instructions'), 21, 4); 

        add_action( 'woocommerce_before_save_order_items', array( &$this, 'drp_update_order_customer_id'), 10, 2 );

        try {
            $gen_checkout_set = $this->get_genCheckoutSettings();
            $location = trim( apply_filters( 'raffle_location_checkout_generated_tickets', $gen_checkout_set['location'] ) );  
            
            if( $location != '' ){
                add_action( $location, array( &$this, 'drp_generateAndShowTicketsAtCheckout'), 30  );
            }
            
            $location_block = trim( apply_filters( 'raffle_location_checkout_block_generated_tickets', $gen_checkout_set['location_block'] ) );  

            if( $location_block !=  '' ){
                add_action( 'wp_head', array( &$this, 'drp_generated_tickets_add_jscript_checkout'), 9999 );

                $ajax_action_checkout_block = 'drp_checkout_block_location';
                add_action("wp_ajax_nopriv_{$ajax_action_checkout_block}", array( &$this, $ajax_action_checkout_block ) );
                add_action("wp_ajax_{$ajax_action_checkout_block}", array( &$this, $ajax_action_checkout_block ) );
            }

        } catch (\Throwable $th) {
            RafflePlayWoo_error_log( 'Issue with location at checkout generated tickets '. $th->getMessage() );
        }
     
        
        /* order status */
        
        $order_status_gen = $this->get_orderStatusGenerateTickets();

        foreach( $order_status_gen as $hook=>$action ){

            if( $action == 'yes'){                
                add_action( esc_html( $hook ), array( &$this, 'drp_woo_process_checkout' ), 10, 1);
            }
        }

        if( is_admin() ){
                add_action( 'woocommerce_order_status_failed', array( &$this, 'drp_woo_mark_deleted_order' ), 10, 1); 
                add_action( 'woocommerce_order_status_refunded', array( &$this, 'drp_woo_mark_deleted_order' ), 10, 1); 
                add_action( 'woocommerce_order_status_cancelled', array( &$this, 'drp_woo_mark_deleted_order' ), 10, 1);             
        }

        // display the extra data on order received page and my-account order review     
        add_action( 'woocommerce_thankyou', array( &$this,'drp_display_order_data_thank_you'), 20 );
        add_action( 'woocommerce_view_order', array( &$this, 'drp_display_order_data'), 20 );     

        add_action('wp_ajax_drp_save_settings', array( &$this, 'drp_save_settings') );
        add_action('wp_ajax_drp_get_data', array(&$this, 'drp_get_data') );
        add_action('wp_ajax_drp_fix_db', array(&$this, 'drp_fix_db') );       
        
        if( $this->get_showAccTabRaffle() == 'yes'){
            add_action( 'init', array( &$this, 'raffle_woo_item_endpoint') );
            add_filter( 'query_vars', array( &$this, 'raffle_woo_item_query_vars' ) );
            add_filter( 'woocommerce_account_menu_items', array( &$this, 'raffle_woo_new_item_tab' ) );
            add_action( 'woocommerce_account_raffle_endpoint', array( &$this, 'raffle_woo_item_content' ) );
            add_filter ( 'woocommerce_account_menu_items', array( &$this, 'raffle_woo_edit_account_tab' ) );
            add_filter ( 'woocommerce_account_menu_items', array( &$this, 'raffle_woo_reorder_account_menu' ) );
        }

        add_action( 'admin_footer', array( &$this, 'drp_feedback_uninstall') );
               
    }

    public function load_extra_scripts(){

        global $wp;

         if ( is_checkout() && empty( $wp->query_vars['order-pay'] ) && ! isset( $wp->query_vars['order-received'] ) ) {
           
            $js_url = esc_url( RAFFLE_PLAY_WOO_URL.'/js/raffle_checkout_block.js' . '?v='.$this->getVersion() );
            wp_enqueue_script('raffle-checkout-generate-script', $js_url, array('jquery'), $this->getVersion(), array('strategy' => 'defer' ));
        }

    }

    public function pw_load_scripts( $hook ){

        global $rpwoo_main_page;        
        global $rpwoo_view_page;
        global $rpwoo_audit_page;
        global $rpwoo_reports_page;
        global $rpwoo_info_page;
        global $rpwoo_product_page;
        global $rpwoo_winners_page;
        global $rpwoo_releases_page;
        global $rpwoo_promotion_page;
        global $rpwoo_lucky_page;
        global $rpwoo_logs_page;

        if( $hook === 'edit.php'){
            //raffle_column with, wrap issue
            wp_enqueue_style('rpwoo-style-product-column', RAFFLE_PLAY_WOO_URL.'/css/product-column.css' . '?v='.$this->getVersion() );
        }

        if( ($rpwoo_main_page != $hook) && ($rpwoo_view_page != $hook ) && 
            ($rpwoo_audit_page != $hook) && ( $rpwoo_reports_page != $hook ) &&
            ($rpwoo_info_page != $hook) && ( $rpwoo_product_page != $hook ) &&
            ($rpwoo_winners_page != $hook ) && ( $rpwoo_releases_page != $hook ) &&
            ($rpwoo_promotion_page != $hook )  && ( $rpwoo_lucky_page != $hook ) &&
            ($rpwoo_logs_page != $hook ) )
            return;

        wp_enqueue_style('rpwoo-style-main', RAFFLE_PLAY_WOO_URL.'/css/drp_main.css' . '?v='.$this->getVersion(), array(), $this->getVersion() );
        wp_enqueue_style('rpwoo-style-bootstrap', RAFFLE_PLAY_WOO_URL.'/css/bootstrap.min.css' . '?v='.$this->getVersion(), array(), $this->getVersion() );
        wp_enqueue_style('rpwoo-style-fontawsome', RAFFLE_PLAY_WOO_URL.'/css/fa/css/all.css'.'?v='.$this->getVersion(), array(), $this->getVersion() );
        wp_enqueue_style('rpwoo-style-bootstrap-toggle', RAFFLE_PLAY_WOO_URL.'/css/bootstrap-toggle.min.css'. '?v='.$this->getVersion(), array(), $this->getVersion() );     
        wp_enqueue_style('rpwoo-style-bootstrap-table', RAFFLE_PLAY_WOO_URL.'/css/bootstrap-table.css' . '?v='.$this->getVersion(), array(), $this->getVersion() );
        wp_enqueue_style('rpwoo-my-style-clockpicker', RAFFLE_PLAY_WOO_URL.'/css/clockpicker.css' . '?v='.$this->getVersion(), array(), $this->getVersion() );
        wp_enqueue_style('rpwoo_my-style-jquery-theme',   RAFFLE_PLAY_WOO_URL.'/jquery/themes/sunny/jquery-ui.min.css' . '?v='.$this->getVersion(), array(), $this->getVersion() );

        
        wp_enqueue_script('rpwoo-script-bootstrap-toggle', RAFFLE_PLAY_WOO_URL.'/js/bootstrap-toggle.min.js' . '?v='.$this->getVersion() );
        wp_enqueue_script('rpwoo-script-bootstrap', RAFFLE_PLAY_WOO_URL.'/js/bootstrap.min.js' . '?v='.$this->getVersion() );        
        wp_enqueue_script('rpwoo-script-messages',  RAFFLE_PLAY_WOO_URL.'/js/rpwoo_script_message.js'.'?v=' . $this->getVersion() );     
        wp_enqueue_script('rpwoo-script-drp-bootstrap-table', RAFFLE_PLAY_WOO_URL.'/js/bootstrap-table.js'.'?v=' . $this->getVersion() ); 
        wp_enqueue_script('rpwoo_plugin_view_clockpicker', RAFFLE_PLAY_WOO_URL.'/js/clockpicker.js' . '?v='.$this->getVersion() ); 
       
        wp_enqueue_script( 'jquery-ui-datepicker' ); 

        //localization in the front end 
        wp_localize_script('rpwoo-script-messages', 'rpwoo_local_lng', $this->drp_local_txt() );

        if( $rpwoo_main_page == $hook ){
            wp_enqueue_script('rpwoo_plugin_main_script', RAFFLE_PLAY_WOO_URL.'/js/drp_main.js' . '?v='.$this->getVersion() );
        }else if( $rpwoo_product_page == $hook ){
            wp_enqueue_script('rpwoo_plugin_view', RAFFLE_PLAY_WOO_URL.'/js/drp_raffles.js' . '?v='.$this->getVersion() ); 
        }else if( $rpwoo_view_page == $hook ){           
            wp_enqueue_script('rpwoo_plugin_view', RAFFLE_PLAY_WOO_URL.'/js/drp_view.js' . '?v='.$this->getVersion() );  
        }else if( $rpwoo_audit_page == $hook ){
            wp_enqueue_script('rpwoo_plugin_audit', RAFFLE_PLAY_WOO_URL.'/js/drp_audit.js' . '?v='.$this->getVersion() ); 
        }else if( $rpwoo_reports_page == $hook ){
            wp_enqueue_style('rpwoo-style-reports_page', RAFFLE_PLAY_WOO_URL.'/css/drp_reports.css' . '?v='.$this->getVersion(), array(), $this->getVersion() );
            wp_enqueue_script('rpwoo_plugin_reports_script', RAFFLE_PLAY_WOO_URL.'/js/drp_reports.js' . '?v='.$this->getVersion(), array(), $this->getVersion() );
        }else if( $rpwoo_winners_page == $hook ){
            wp_enqueue_script('rpwoo_plugin_view', RAFFLE_PLAY_WOO_URL.'/js/drp_winners.js' . '?v='.$this->getVersion(), array(), $this->getVersion() );   
        }        
           
    }
}