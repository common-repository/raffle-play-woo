<?php
namespace RafflePlayWoo_LifeCycle;


if( ! defined('ABSPATH') )
    die('No Access to this page');

include_once('RafflePlayWoo_InstallIndicator.php');
include_once('RafflePlayWoo_Raffles.php');
include_once('w/W_RafflePlayWoo_MainPage.php');
include_once('w/W_RafflePlayWoo_ViewPage.php');
include_once('w/W_RafflePlayWoo_AuditPage.php');
include_once('w/W_RafflePlayWoo_Reports.php');
include_once('w/W_RafflePlayWoo_Info.php');
include_once('w/W_RafflePlayWoo_Raffles.php');
include_once('w/W_RafflePlayWoo_Winners.php');
include_once('w/W_RafflePlayWoo_Releases.php');
include_once('d/D_RafflePlayWoo_Main.php');
include_once('d/D_RafflePlayWoo_Reports.php');
include_once('RafflePlayWoo_Includes.php');
include_once('w/W_RafflePlayWoo_Promotion.php');
include_once('w/W_RafflePlayWoo_Lucky.php');
include_once('w/W_RafflePlayWoo_Logs.php');

use RafflePlayWoo_InstallIndicator\RafflePlayWoo_InstallIndicator as RafflePlayWoo_InstallIndicator;
use RafflePlayWoo_MainTbl;
use RafflePlayWoo_Reports;
use W_RafflePlayWoo_Reports;
use RafflePlayWoo_Raffles;
use RafflePlayWoo_Includes;
use W_RafflePlayWoo_MainPage\W_RafflePlayWoo_MainPage as W_RafflePlayWoo_MainPage;
use W_RafflePlayWoo_ViewPage\W_RafflePlayWoo_ViewPage as W_RafflePlayWoo_ViewPage;
use W_RafflePlayWoo_Raffles\W_RafflePlayWoo_Raffles as W_RafflePlayWoo_Raffles;
use W_RafflePlayWoo_Winners\W_RafflePlayWoo_Winners as W_RafflePlayWoo_Winners;
use W_RafflePlayWoo_Info\W_RafflePlayWoo_Info as W_RafflePlayWoo_Info;
use W_RafflePlayWoo_AuditPage\W_RafflePlayWoo_AuditPage as W_RafflePlayWoo_AuditPage;
use W_RafflePlayWoo_Releases\W_RafflePlayWoo_Releases as Releases;
use W_RafflePlayWoo_Promotion\W_RafflePlayWoo_Promotion as Promotion;
use W_RafflePlayWoo_Lucky\W_RafflePlayWoo_Lucky as Lucky;
use W_RafflePlayWoo_Logs\W_RafflePlayWoo_Logs as Logs;

class RafflePlayWoo_LifeCycle extends RafflePlayWoo_InstallIndicator{
    private $db_obj     = null; 
    private $db_report  = null;
    private $db_raffle  = null;
    private $default_raffle = null;
    const COUNT_STARTS_AT_TXT = 'ticket_count_starts_at'; 
    const LIVE_RAFFLE_TXT     = 'live_raffle'; 
    const PRODUCT_CKB         = '_rpwoo_ckb';
    const PROMO_PROD_CKB      = '_rpwoo_promo_prod_ckb';
    const PRODUCT_NO_NAME     = '_rpwoo_ticket_no';
    const RAFFLE_TYPE         = '_rpwoo_raffle_type';
    const DEFAULT_RAFFLE_ID   = 0;
    const DEFAULT_RAFFLE_SHORT = "[raffle name='msg' id='0']";
    const PRODUCTION_PLUGIN   = true;
    const RAFFLE_ITEM_ENDPOINT = 'raffle';

    const SESSION_DATA              = 'raffle_session_data';
    const SESSION_CHECKOUT_CYCLE    = 'raffle_session_cycle';
    const SESSION_CHECKOUT_CYCLE_MSG  = 'raffle_session_cycle_msg';
    const SESSION_TICKETS_GEN       = 'raffle_tickets_generated';

    public function __construct(){
        $this->db_obj    = new RafflePlayWoo_MainTbl\RafflePlayWoo_MainTbl();
        $this->db_report = new RafflePlayWoo_Reports\RafflePlayWoo_Reports();
        $this->db_raffle = new RafflePlayWoo_MainTbl\RafflePlayWoo_RaffleTbl();
        $this->default_raffle = null;
    }

    public function install(){
        
        // Initialize Plugin Options
        $this->initOptions();

        // Initialize DB Tables used by the plugin
        $this->installDatabaseTables();

        // Other Plugin initialization - for the plugin writer to override as needed
        $this->otherInstall();

        // Record the installed version
        $this->saveInstalledVersion();

        // To avoid running install() more then once
        $this->markAsInstalled();
    }

    public function uninstall(){
        $this->otherUninstall();
        $this->unInstallDatabaseTables();
        $this->deleteSavedOptions();
        $this->markAsUnInstalled();
    }

    public function upgrade() {
    }

    public function activate() {
    }

    public function deactivate(){      

        if( isset( $_GET['action'] ) && ( $_GET['action'] == 'deactivate') && isset( $_GET['feedback'] ) ){            
           
            try{
             
                $plugin_name = sanitize_text_field( wp_unslash( $_GET['plugin'] ));
                
                if( strpos( $plugin_name , 'raffle-play-woo.php') !== false ){

                    $bmp_option = sanitize_text_field( wp_unslash( $_GET['option'] ) );
                    $bmp_other  = sanitize_text_field(  wp_unslash( $_GET['other'] ) );
                    $bmp_email  = sanitize_text_field(  wp_unslash( $_GET['email'] ) );  
                    
                    $user_email = '';

                    if( $bmp_email == 'yes'){
                        $current_user = wp_get_current_user();
                        $user_email = $current_user->user_email;
                    }
                                       
                    $bmp_to = 'developer@tuskcode.com';                

                    $optionsToText = [
                        esc_html("Lack of functionality"),
                        esc_html("Too difficult to use"),
                        esc_html("The plugin isn't working"),
                        esc_html("The plugin isn't useful"),
                        esc_html("Temporarily disabling or troubleshooting"),
                        esc_html("Other", 'raffle-play-woo')
                    ];
                    
                    if( strlen( $bmp_option ) > 0 ){
                        $bmp_option = intval( $bmp_option );
                        $bmp_option = $optionsToText[ $bmp_option ];
                    }
                
                    $bmp_subject = 'Feedback - Raffle Play Woo';
                    $bmp_message = "<h1>Raffle Play Woo Feedback</h1>";
                    $bmp_message .= "<p>User Email: " . $user_email . "</p>";
                    $bmp_message .= "<p> Option: ". $bmp_option."</p>";
                    $bmp_message .= "<p> Other: ". $bmp_other . "</p>";
                    $bmp_message .= "<p> Contact me: ". $bmp_email . "</p>";

                    $bmp_header = "From:feedback@wordpress.com \r\n";          
                    $bmp_header .= "MIME-Version: 1.0\r\n";
                    $bmp_header .= "Content-type: text/html\r\n";
                    
                    $is_sent =  mail( $bmp_to, $bmp_subject, $bmp_message, $bmp_header );
                   
               }

            }catch( \Exception $e ){
                RafflePlayWoo_error_log( $e->getMessage() );
            }
        
        }else{
    
        }
    }

    protected function initOptions() {
    }


    protected function installDatabaseTables() {
    }


    protected function unInstallDatabaseTables() {
    }


    protected function otherInstall() {
    }

  
    protected function otherUninstall() {
    }

    public function addMenuPages() {
        $this->addRaffleMainPage();       
        $this->addRaffleViewPage(); 
        $this->addRaffleProductPage();
        $this->addRaffleWinnersPage(); 
        $this->addRafflePromotionPage(); 
        $this->addRaffleLuckyPage();  
        $this->addRaffleReportsPage(); 
        $this->addRaffleInstructionsPage();    
        $this->addRaffleReleasesPage();   
        $this->addRaffleLogsPage();                 
    }
    
    protected function requireExtraPluginFiles() { 
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    }

 
    protected function getPluginSlug() {
        return 'Raffle_raffle_play_woo';
    }

    protected function getPluginViewSlug(){
        return 'Raffle_raffle_play_view';
    }

    protected function getPluginAuditSlug(){
        return 'Raffle_raffle_play_audit';
    }

    protected function getPluginReportsSlug(){
        return 'Raffle_raffle_play_reports';
    }

    protected function getPluginPromotionSlug(){
        return  'raffle_play_promotion';
    }

    protected function getPluginLogsSlug(){
        return  'raffle_play_logs';
    }

    protected function getPluginLuckySlug(){
        return  'raffle_play_lucky_numbers';
    }

    protected function getPluginInfoSlug(){
        return 'Raffle_raffle_play_info';
    }
    
    protected function getPluginRaffleProductSlug(){
        return 'Raffle_raffle_play_product';
    }

    protected function getPluginWinnersSlug(){
        return 'Raffle_raffle_play_winners';
    }

    protected function getPluginReleasesSlug(){
        return  'Raffle_raffle_play_releases';
    }


    protected function addRaffleMainPage(){
        global $rpwoo_main_page;   
        $displayName = $this->getPluginDisplayName(); 

        $rpwoo_main_page = add_menu_page(   $displayName,
                                            $displayName,
                                            'manage_options',
                                            $this->getPluginSlug(),
                                            array( &$this, 'drp_settings'),
                                            (RAFFLE_PLAY_WOO_URL.'/images/icons/plugin-icon.png'),
                                            150
                        );
    }

    protected function addRaffleProductPage(){

        global $rpwoo_product_page;

        $displayName = esc_html__('Raffles', 'raffle-play-woo' );  

        $rpwoo_product_page = add_submenu_page( $this->getPluginSlug(),
                                          $displayName,
                                          $displayName,
                                          'manage_options',
                                          $this->getPluginRaffleProductSlug(),
                                          array( &$this, 'drp_raffles_page'),
                                          171 
                        );
    }

    protected function addRaffleViewPage(){
        global $rpwoo_view_page;
        $displayName = esc_html__('View Tickets', 'raffle-play-woo' );  

        $rpwoo_view_page = add_submenu_page( $this->getPluginSlug(),
                                          $displayName,
                                          $displayName,
                                          'manage_options',
                                          $this->getPluginViewSlug(),
                                          array( &$this, 'drp_view_page'),
                                          161 
                        );
    }

    protected function addRaffleWinnersPage(){
        global $rpwoo_winners_page;
        $displayName = esc_html__('Winners', 'raffle-play-woo' );  

        $rpwoo_winners_page = add_submenu_page( $this->getPluginSlug(),
                                          $displayName,
                                          $displayName,
                                          'manage_options',
                                          $this->getPluginWinnersSlug(),
                                          array( &$this, 'drp_winners_page'),
                                          175
                        );
    }

    protected function addRafflePromotionPage(){
        global $rpwoo_promotion_page;
        $displayName = esc_html__('Promotion', 'raffle-play-woo' );  

        $capab = 'manage_options';

        $rpwoo_promotion_page = add_submenu_page( $this->getPluginSlug(),
                                          $displayName,
                                          $displayName,
                                          $capab,
                                          $this->getPluginPromotionSlug(),
                                          array( &$this, 'drp_promotion_page'),
                                          172 
                        );
    }

    protected function addRaffleLuckyPage(){
        global $rpwoo_lucky_page;
        $displayName = esc_html__('Lucky Numbers (Instant Wins)', 'raffle-play-woo' );  

        $rpwoo_lucky_page = add_submenu_page( $this->getPluginSlug(),
                                          $displayName,
                                          $displayName,
                                          'manage_options',
                                          $this->getPluginLuckySlug(),
                                          array( &$this, 'drp_lucky_page'),
                                          173
                        );
    }

    public function addRaffleReportsPage() {
        global $rpwoo_reports_page;   
        $displayName = esc_html__('Reports', 'raffle-play-woo' );   

        $rpwoo_reports_page = add_submenu_page( 
                                            $this->getPluginSlug(),
                                            $displayName,
                                            $displayName,
                                            'manage_options',
                                            $this->getPluginReportsSlug(),
                                            array( &$this, 'drp_reports_page'),                                          
                                            201
                        );                  
    }

    public function addRaffleInstructionsPage() {
        global $rpwoo_info_page;   
        $displayName = esc_html__('Documentation', 'raffle-play-woo' );   

        $rpwoo_info_page = add_submenu_page( 
                                            $this->getPluginSlug(),
                                            $displayName,
                                            $displayName,
                                            'manage_options',
                                            $this->getPluginInfoSlug(),
                                            array( &$this, 'drp_info_page'),                                          
                                            205
                        );                  
    }

    public function addRaffleReleasesPage() {
        global $rpwoo_releases_page;   
        $displayName = esc_html__('Releases', 'raffle-play-woo' );   

        $rpwoo_releases_page = add_submenu_page( 
                                            $this->getPluginSlug(),
                                            $displayName,
                                            $displayName,
                                            'manage_options',
                                            $this->getPluginReleasesSlug(),
                                            array( &$this, 'drp_releases_page'),                                          
                                            206
                        );                  
    }

    protected function addRaffleAuditPage(){
        global $rpwoo_audit_page;
        $displayName = esc_html__('Audit', 'raffle-play-woo' );  

        $rpwoo_audit_page = add_submenu_page( $this->getPluginSlug(),
                                          $displayName,
                                          $displayName,
                                          'manage_options',
                                          $this->getPluginAuditSlug(),
                                          array( &$this, 'drp_audit_page'),
                                          122 
                        );
    }

    public function addRaffleLogsPage() {
        global $rpwoo_logs_page;   
        $displayName = esc_html__('Logs', 'raffle-play-woo' );  
        
        $capab = 'manage_options';

        $rpwoo_logs_page = add_submenu_page( 
                                            $this->getPluginSlug(),
                                            $displayName,
                                            $displayName,
                                            $capab,
                                            $this->getPluginLogsSlug(),
                                            array( &$this, 'drp_logs_page'),                                          
                                            208
                        );                  
    }
    

    protected function prefixTableName($name) {
        global $wpdb;
        return $wpdb->prefix .  strtolower($this->prefix($name));
    }

    public function drp_woo_plugin_links($links, $file ){
        $plugin_basename = 'raffle-play-woo/raffle-play-woo.php';

        if( $plugin_basename == $file )
            return array_merge( $links,                
                    array( '<a href="' . menu_page_url( $this->getPluginInfoSlug(), false ) .'">' . esc_html__('Installation Info', 'raffle-play-woo' ) . '</a>' )
                ); 
        else
            return $links;
    }


    private function drp_loadDefaultRaffle( $load_extra = 1 ){

        if( $this->default_raffle !== null )        
            return $this->default_raffle;

        $raffle_name = $this->get_raffle_name();

        $is_raffle_terminated = $this->isRaffleTerminated();
        $is_raffle_limited    = $this->isRaffleLimited();

        $this->default_raffle = new RafflePlayWoo_Raffles\RafflePlayWoo_RaffleProduct(); 
        $this->default_raffle->set_id( 0 );
        $this->default_raffle->set_name( $raffle_name );
        $this->default_raffle->set_is_terminated( $this->isRaffleTerminated() );
        $this->default_raffle->set_is_live( $this->isLiveRaffle() );
        $this->default_raffle->set_is_limit( $this->isRaffleLimited() );
        $this->default_raffle->set_limit_no( $this->getLimitNo() );
        $this->default_raffle->set_prefix( $this->getTicketPrefix() );
        $this->default_raffle->set_start_datetime( 
                $this->getStartDate(), $this->getStartTime() );
        $this->default_raffle->set_end_datetime(
                $this->getEndDate(), $this->getEndTime() );
        $this->default_raffle->set_last_purchased( $this->getLastTicketNo( $this->default_raffle->get_is_live() ) );
        $this->default_raffle->set_test_ticket( $this->getLastTicketNo( false ) );

    }

    private function getExtraInfo(){

        $result = array(
            'email_line_one' => $this->getEmailHeaderLbl(),
            'email_line_two'  => $this->getEmailBodyLbl(),
            'email_pos'      => intval( $this->getEmailPos() ),
            'msg_terminated' => '',
            'msg_not_started' => $this->get_msg_start(),
            'msg_has_ended'   => $this->get_msg_end(),
            'msg_none_left'   => $this->get_msg_add_to_cart(),
            'msg_add_ex'      => $this->get_add_to_cart_ex(),
            'msg_update_ex'   => $this->get_update_cart_ex(),
            'msg_will_enddate'=> $this->get_msg_will_enddate(),
            'wp_date_format'  => get_option( 'date_format' ),
            'wp_time_format'  => get_option( 'time_format' ),
            'inc_name'        => $this->get_inc_name()            
        );

        return $result;
    }

    public function drp_feedback_uninstall(){
        RafflePlayWoo_Includes\RafflePlayWoo_Includes::raffle_add_feedback_form();
    }

    private function drp_loadRaffleById( $raffle_id, $load_extra = 0 ){
        //load non default raffle
        $raffle_obj = null;
      

        if( $raffle_id == 0 ){

            $this->drp_loadDefaultRaffle( $load_extra );
            $raffle_obj = $this->default_raffle;

        }

        return $raffle_obj;
    }

    private function drp_show_ticket_sq( $order_id, $type, $session_id = '' ){

        if( $type == 'account'){
            $customer_id = get_current_user_id();
            $rec_data = $this->db_obj->getTicketsFromCustomer( $customer_id );
        }else if( $order_id !== -1 ){       
            $rec_data       = $this->db_obj->getTicketsFromOrder( $order_id );   
        }else if( $order_id == -1 ){
            $rec_data       = $this->db_obj->getTicketsFromSession( $session_id ); 
        }

        if( count( $rec_data ) == 0 ){
            return;
        }
        
        $ticket_prefix      = trim( $this->getTicketPrefix() );
        $email_header       = trim( $this->getEmailHeaderLbl() );
        $email_body         = trim( $this->getEmailBodyLbl() );
        $def_raffle_name    = $this->get_raffle_name();
        $inc_raffle_name    = $this->get_inc_name(); 

        $info_data = array();      
     
        foreach( $rec_data as $item ){  

            if( $item->raffle == 0  ){
                if( ! isset( $info_data[ $def_raffle_name] ) ){
                    $info_data[ $def_raffle_name]['tickets'] = array();
                }
                $ticket_no = $ticket_prefix . $item->ticket;
                array_push( $info_data[ $def_raffle_name ]['tickets'], $ticket_no );               
            }
        }

        $content = '';

        if( sizeof( $info_data ) > 0 ){  

            $col_span = 1;
            if( $inc_raffle_name )
                $col_span += 1;
            if( $email_body != '' )
                $col_span += 1;

            $template_content = wc_get_template_html(
                "includes/templates/email_raffle_info.php",
                array(
                    'type'              => $type,
                    'email_header'      => $email_header,
                    'info_data'         => $info_data,
                    'email_body'        => $email_body,
                    'col_span'          => $col_span, 
                    'inc_raffle_name'   => $inc_raffle_name,
                    'ticket_image'      => $this->get_ticketImageRaffles()                                     
                ),
                '',
                RAFFLE_PLAY_WOO_DIR_PATH
            );    
          
            $content .= $template_content;    
      
        }

        echo $content;
        
    }

    public function drp_display_order_data_in_admin( $order ){        
        $this->drp_show_ticket_sq( $order->get_id(), 'admin' );
    }

    public function drp_product_column_raffle( $column, $postid ) {        
        if( $column == 'raffle_column'){
            $product_obj = wc_get_product( $postid );
            if( $product_obj == null )
                return;

            $product_meta =  get_post_meta( $postid );
            $is_raffle = $product_obj->get_meta( self::PRODUCT_CKB, true ) == 'yes';
            if( $is_raffle ){

                try {

                    $raffle_ticket_no = $product_obj->get_meta( self::PRODUCT_NO_NAME , true ) ;  

                    $default_raffle_name = $this->get_raffle_name(); 

                    if( $this->isRaffleTerminated() )
                        $default_raffle_name .= ' (T)';

                    $raffle_name = $this->db_raffle->raffleNamebyProduct( $default_raffle_name, $postid );
                    echo  "<span style='position: relative; top: -7px;' class='row-title'><b>". $raffle_ticket_no .
                        "</b><img style='position: relative; top:8px;' src='".RAFFLE_PLAY_WOO_URL."/images/icons/plugin-icon.png' alt='raffle' /> - " . $raffle_name . " </span>";  
                                        
                } catch (\Throwable $th) {
                    RafflePlayWoo_error_log('Issues displaying the raffle names in columns');
                }

            }else{
                echo ' ';
            }
        }   
    }

    //==============================================

    public function raffle_woo_item_endpoint(){
        add_rewrite_endpoint( self::RAFFLE_ITEM_ENDPOINT, EP_ROOT | EP_PAGES );
    }

    public function raffle_woo_item_query_vars( $vars ){
        $vars[] = self::RAFFLE_ITEM_ENDPOINT;
        return $vars;
    }

    public function raffle_woo_new_item_tab( $items ){
        $items[ self::RAFFLE_ITEM_ENDPOINT ] = 'Raffle';
        return $items;
    }

    public function raffle_woo_item_content(){
        $user = wp_get_current_user();
        $user_id = $user->ID;
        $orders_for_user = $this->db_obj->getOrdersForUser( $user_id );  
       
        
        if( $orders_for_user !== null ){
            echo "<div class='raffle-woo-acc-tab'>";
            foreach( $orders_for_user as $obj ){

                $order_id = (int) $obj['order_id'];
                echo esc_html__('Order', 'woocommerce')  . ' #' . $order_id;
                $this->drp_show_ticket_sq( $order_id, 'thank' );
            }

            echo "</div>";
            
        }

    }

    public function raffle_woo_edit_account_tab( $items ){
        //unset( $items[ self::RAFFLE_ITEM_ENDPOINT ] );
        return $items;
    }

    public function raffle_woo_reorder_account_menu( $items ){

        if( isset( $items[ self::RAFFLE_ITEM_ENDPOINT ] )){
            $new_array = array();
            unset( $items[ self::RAFFLE_ITEM_ENDPOINT ]);
            foreach( $items as $key=>$item ){
                if( $key == 'customer-logout'){
                    $new_array[ self::RAFFLE_ITEM_ENDPOINT ] = __('Raffle', 'raffle-play-woo');                    
                }
                $new_array[ $key ] = $item;
            }
            $items = $new_array;
        }

        return $items;
    }

    private function moveElement(&$array, $a, $b) {
        $out = array_splice($array, $a, 1);
        array_splice($array, $b, 0, $out);
    }


    public function drp_generateAndShowTicketsAtCheckout(){ 

        //check if any of the raffle have generate tickets at checkout, if yes continue, if not exit.
        $continue = $this->continue_generate_tickets_at_checkout();    

        if( $continue == false ){
            return;
        }
        
        $order_id = -1;

        $session_id = WC()->session->get_customer_id();
      
        $this->drp_generateTicketsAtCheckout( $order_id, $session_id );

        $this->show_tickets_at_checkout( $order_id, $session_id );  

    }

    private function continue_generate_tickets_at_checkout(){
        $raffles_gen        = $this->get_rafflesGenCheckout();
        $result = false;

        foreach( $raffles_gen as $key => $item ){
            if( $item == 'yes' ){
                $result = true;
                break;
            }
        }

        return $result;
    }

    public function drp_generateTicketsAtCheckout( $order_id, $session_id ){

        $cart_raffles       = $this->drp_getRaffleProductsInCart(); 
        $gen_checkout_set   = $this->get_genCheckoutSettings();
        $raffles_gen        = $this->get_rafflesGenCheckout();
        $time = $gen_checkout_set['time'];

        $this->db_obj->deleteSessionTicketsByTime( $time );
        
        WC()->session->set( self::SESSION_CHECKOUT_CYCLE_MSG, '' );          

        if( count( $cart_raffles ) == 0 ){
            WC()->session->set( self::SESSION_TICKETS_GEN, 'no' );
            $this->db_obj->deleteSessionTicketsByTime( $time );
            $this->db_obj->deleteTicketsBySessionId( $session_id );
            WC()->session->set( self::SESSION_DATA, '' );
            return;
        }   

        //check if the the raffle tickets are going to be generated.
        $cart_raffles_gen = array();
   
        foreach( $cart_raffles as $key => $r_prod ){
            $raffle_id = (int) $r_prod['raffle_id'];
            if(  isset( $raffles_gen[ $raffle_id ] ) && $raffles_gen[ $raffle_id ] == 'yes' ){
                $cart_raffles_gen[] = $r_prod;
            }
            
        }

        if( count( $cart_raffles_gen ) == 0){
            return;
        }

        $db_tickets = $this->db_obj->getTicketsBySessionIdAndTime( $session_id, $time );
        $db_tickets_b = ( is_array( $db_tickets ) && count( $db_tickets ) > 0) ? true : false;

       
        $session_data = WC()->session->get( self::SESSION_DATA, '' );
       
        if( $session_data != '' && ( $session_data != wp_json_encode( $cart_raffles_gen ) ) ){
            
            $this->db_obj->deleteTicketsBySessionId( $session_id ); 
            WC()->session->set( self::SESSION_TICKETS_GEN, 'no' ); 
          
        }
          
        $already_generated = WC()->session->get( self::SESSION_TICKETS_GEN, 'no' ) == 'no' ? false : true;

        //generated new tickets
        if( ! $already_generated ){       
            $this->create_raffleTickets( $order_id, $cart_raffles_gen, $session_id, 'checkout', 0 );
            WC()->session->set( self::SESSION_TICKETS_GEN, 'yes' );
            WC()->session->set( self::SESSION_DATA, json_encode( $cart_raffles_gen ) );
          
        }else if( $already_generated && $db_tickets_b ){
          
        }else if( $already_generated && ! $db_tickets_b ){            
            $this->db_obj->deleteTicketsBySessionId( $session_id );           
            WC()->session->set( self::SESSION_CHECKOUT_CYCLE_MSG, $gen_checkout_set['msg_removed'] );  

        }
 

    }

    public function drp_generated_tickets_add_jscript_checkout(){
        global $wp;
        if ( is_checkout() && empty( $wp->query_vars['order-pay'] ) && ! isset( $wp->query_vars['order-received'] ) ) {

            $nonce = wp_create_nonce("raffle_checkout_nonce");
	        $admin_url = admin_url('admin-ajax.php?action=drp_checkout_block_location&nonce='.$nonce);

            $gen_checkout_set = $this->get_genCheckoutSettings();
            $location_block = $gen_checkout_set['location_block'];

            echo "<script> 
                    const raffle_block_location = '$location_block';
                    const raffle_block_admin_url = '$admin_url';
                </script>
                <style>
                    .raffle-tickets-generated-checkout 
                    .raffle-tr-checkout > td{
                        padding: 0 !important;
                    }
                </style>
                
                ";
        
        }
    }

    public function drp_checkout_block_location(){
        if ( ! isset( $_GET['nonce'] ) ||
        ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['nonce'] ) ), 'raffle_checkout_nonce' ) ){

            echo 'not_verify';
        }else{

            ob_start();
            $this->drp_generateAndShowTicketsAtCheckout();
            $content = ob_get_contents();
            ob_end_clean();

            echo $content;            
        }

        die();
    }

    private function show_tickets_at_checkout( $order_id, $session_id ){

        $gen_checkout_set = $this->get_genCheckoutSettings();

        $res_time   = esc_html( $gen_checkout_set['time'] );
        $message    = esc_html( $gen_checkout_set['countdown_lbl'] );

        $message = esc_html( sprintf( $message, $res_time ) );

        $time = $this->db_obj->getCreatedTimeBySessionId( $session_id ); 

        if( ! $time ){

            $not_reserved = esc_html( WC()->session->get( self::SESSION_CHECKOUT_CYCLE_MSG, '' ) );  

                if( $not_reserved != '' ){  
                    echo  "<tr class='raffle-tr-checkout'> <td colspan='2'>";              
                        echo "<h2 class='wc-block-components-title wc-block-components-checkout-step__title raffle-tickets-not-reserved-msg'> $not_reserved </h2>";
                    echo "</td></tr>";
                }
            
            return;
        }

        echo  "<tr class='raffle-tr-checkout'> <td colspan='2'>";  
        
        if( $gen_checkout_set['countdown'] == 'yes'){    
            $counter_time = time() + ( 60 * 60 );
            $countdown = $this->get_countdown();
            $time_zone = (float) get_option( 'gmt_offset' );
            $hours = (int) $time_zone;

            if( is_array( $time ) && count( $time ) > 0 ){
                $time = $time[0]->created_at;
                $time = strtotime( $time .' + ' . $res_time . ' minute');
            }         

            echo do_shortcode('['. RafflePlayWoo_Countdown::$SHORTCODE_NAME .' 
                                datetime="'. (string)$time. '"
                                bgcolor="' . esc_html( $countdown['bg'] ) . '"
                                color="' . esc_html( $countdown['color'] ) . '"
                                days="' . esc_html( $countdown['days'] ) . '"
                                hours="' . esc_html( $countdown['hours'] ) . '"
                                minutes="' . esc_html( $countdown['mins'] ) . '"
                                seconds="' . esc_html( $countdown['secs'] ) . '"
                                header="' . esc_html( $message ) . '"
                                ]'
                            );

        }else{
            $timeout = (int) $res_time * 1000 * 60;
            echo "<script> setTimeout(()=>{ window.location.reload(); }, $timeout ); </script>";
            echo "<h3 class='raffle-checkout-header-text'> $message </h3>";
        }

        echo $this->drp_show_ticket_sq( $order_id, 'checkout', $session_id );

        echo "</td></tr>";
       
    }

    private function drp_getRaffleProductsInCart(){
        $cart_data = $this->get_cart_data();

        $raffle_products = array();

        try {
            foreach( $cart_data as $prod_id => $info ){

                if($info['is_raffle'] == 'yes' ){

                    $prod = array(
                        'product_id'    => $info['product_id'],
                        'var_id'        => $info['variation_id'],
                        'tickts'        => (int)$info['q'] * (int)$info['tickets'],
                        'raffle_id'     => $info['raffle_id'],
                        'quantity'      => $info['q'],
                        'line_total'    => $info['q'] * $info['price']
                    );

                    array_push( $raffle_products, $prod );
                }

            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $raffle_products;
    }

    private function get_cart_data( $new_cart_data = null ){

        $result = array();

        try {
                      
            if( $new_cart_data === null ){
                $cart = WC()->cart;

                if( $cart ==  null )
                    return $result;

                $cart_items = $cart->cart_contents;
            }else{
                $cart_items = $new_cart_data;
            }

            foreach( $cart_items as $item ){                

                $product_id = $item['product_id'];
                $variation_id = $item['variation_id'];

                $product      = wc_get_product( $product_id );
               
                $is_raffle_product  = strtolower( get_post_meta( $product_id, self::PRODUCT_CKB, true ) ) == 'yes';               
                $is_promo_product   = strtolower( get_post_meta( $product_id, self::PROMO_PROD_CKB, true ) ) == 'yes';  
                $raffle_id          = get_post_meta( $product_id, self::RAFFLE_TYPE, true );
                $cat_ids            =  $product->get_category_ids();

                if( $variation_id != 0 ){
                    $product_id = $variation_id;
                    $product      = wc_get_product( $product_id );
                }

                if( ! isset( $result[ $product_id ] )){
                    $result[ $product_id ] = array();
                    $result[ $product_id ]['q']  = $item['quantity'];
                }else{
                    $result[ $product_id ]['q'] += (int) $item['quantity']; 
                }
                 
                $result[ $product_id ]['product_id']   = $item['product_id'];
                $result[ $product_id ]['variation_id'] = $variation_id;
                $result[ $product_id ]['name']      = $product->get_name();           
                $result[ $product_id ]['cat']       = $cat_ids;
                $result[ $product_id ]['is_raffle'] = $is_raffle_product ? 'yes' : 'no';
                $result[ $product_id ]['is_promo']  = $is_promo_product ? 'yes' : 'no';
                $result[ $product_id ]['stock']     = $product->get_stock_quantity(); 
                $result[ $product_id ]['price']     = $product->get_price();
                $result[ $product_id ]['raffle_id'] = $raffle_id;
                $result[ $product_id ]['tickets']   = get_post_meta( $product_id, self::PRODUCT_NO_NAME, true );
                
            }

            
        } catch (\Throwable $th) {
            RafflePlayWoo_error_log( 'get_cart_data - ' . $th->getMessage());      
        }

        return $result;        

    }



    //-----------------------------------------------

    public function drp_woo_mark_deleted_order( $order_id ){       

        $order_exists = $this->db_obj->orderExists( $order_id );

        if( $order_exists ){
            //mark as deleted
            $order_exists = $this->db_obj->markOrderAsDeleted( $order_id );
        }else{
            // no action required
        }
    }

    public function drp_add_product_column( $columns ) {

        $columns['raffle_column'] = __( 'Raffle', 'raffle-play-woo' );   
        return $columns;
    }

    
    public function drp_order_email_instructions( $order, $sent_to_admin, $plain_text, $email ) {
        $sent_to_admin = false; 
        $order_id = $order->get_id();    
        $this->drp_show_ticket_sq( $order_id, 'email');
    }

    public function drp_order_email_instructions_after_customer(  $order, $sent_to_admin, $plain_text ){
        $sent_to_admin = false; 
        $order_id = $order->get_id();    
        $this->drp_show_ticket_sq( $order_id, 'email');
    }

    public function drp_display_order_data( $order_id ){  
        $this->drp_show_ticket_sq( $order_id, 'admin');
    }   

    public function drp_display_order_data_thank_you( $order_id ){
        $this->drp_show_ticket_sq( $order_id, 'thank');
    }

    private function drp_getDefaultRaffleProducts(){
   
        $products = array();

        $wp_products = wc_get_products(array(
            'limit'  => -1,
            'status' => 'publish',
        ));
       

        foreach( $wp_products as $prod ){
            $prod_id = $prod->get_id();            
            $is_default_raffle = get_post_meta( $prod_id, self::PRODUCT_CKB, true );
            $raffle_type = get_post_meta( $prod_id, self::RAFFLE_TYPE, true );
            if( $is_default_raffle == 'yes'){
                $raffle_type = get_post_meta( $prod_id, self::RAFFLE_TYPE, true );
                if( ($raffle_type == false ) || ($raffle_type == '0') )
                    array_push( $products,  $prod->get_title() );
            }
        }

        return $products;

    }

    private function drp_woo_process_order( $order_id ){ 

        $order_raffle_exists = $this->db_obj->orderExists( $order_id );
        if( $order_raffle_exists ){  
            //no point moving ahead, the order has being assigned raffle numbers already 
            //if deleted, make it live, as the order status, is either processing, or completed
            $this->db_obj->markOrderAsNotDeleted( $order_id );        
            return;
        }

        $this->create_raffleTickets( $order_id );
    
    }

    private function create_raffleTickets( $order_id, $arr_data = null, $session_id = '', $type = '', $deleted = 0 ){

       //process the products from the order
       $total_tickets_purchased = 0;
       $total_price = 0;      
       
       $last_ticket_no = '';
       $items = array();

       if( $order_id !== -1 ){

           try {
               $order = wc_get_order( $order_id );
           } catch (\Throwable $th) {
               RafflePlayWoo_error_log('Cannot process order ' . $th->getMessage() ); 
               return;
           }
           
           $customer_id = $order->get_customer_id();
           $items = $order->get_items();

       }else if( $arr_data !== null ){
           $items = $arr_data;
           $customer_id = -1;
       }

       if( $type != 'checkout'){
            try {  
                if( WC() !==  null && WC()->session !== null ){             
                    WC()->session->set( self::SESSION_CHECKOUT_CYCLE, 0 ); 
                    WC()->session->set( self::SESSION_DATA, '' ); 
                    WC()->session->set( self::SESSION_TICKETS_GEN, 'no' ); 
                }
            } catch (\Throwable $th) {
                RafflePlayWoo_error_log( $th->getMessage() );
            }

        }

       //get raffles settings for generated tickets 
       $raffles_gen_tickets_checkout = $this->get_rafflesGenCheckout();

        //process the products from the order
        $last_ticket_no = '';
        $updated_checkout_tickets       = array();      

        foreach( $items as $item ){

            $product_id = intval( $item['product_id'] );
            
            if( $product_id > -1 ){
                              
                $product_obj = wc_get_product( $product_id ); 
                
                if( $product_obj == null )
                    continue;

                $is_raffle_product = $product_obj->get_meta( self::PRODUCT_CKB, true ) == 'yes';                            

                if( $is_raffle_product ){   

                    $raffle_product_no = $product_obj->get_meta( self::PRODUCT_NO_NAME, true );     
                    //get the number of tickets from the products, and the number of products                 
                    $raffle_id = 0;  //default raffle
                    $raffle_obj = null;
                    $raffle_type = $product_obj->get_meta( self::RAFFLE_TYPE, true ); 

                    if( $raffle_type != '' ){     
                        $raffle_id = intval( $raffle_type );                       
                    }

                    //processing order for checkout tickets
                    if( $type != 'checkout' && isset( $raffles_gen_tickets_checkout[ $raffle_id ] ) && $raffles_gen_tickets_checkout[ $raffle_id ] == 'yes' ){   

                        if( WC() !==  null  && WC()->session !==  null ){

                            $sess_id = WC()->session->get_customer_id();

                            if( $order_id != -1 && $this->db_obj->session_hasTickets( $sess_id) ){                              
                                $updated_checkout_tickets[] = $raffle_id;                            
                                $this->update_ticketsFromCheckout( $order_id, $customer_id, $sess_id );
                                continue;
                            }

                            if( $order_id != -1 &&  in_array( $raffle_id, $updated_checkout_tickets ) ){                                                             
                                continue;  
                            }
                            
                        }
                    }

                    if( $type == 'checkout' &&                        
                        isset( $raffles_gen_tickets_checkout[ $raffle_id ] ) && $raffles_gen_tickets_checkout[ $raffle_id ] == 'no' ){
                            continue;
                    } 

                    //get raffle object
                    
                    $raffle_obj = $this->drp_loadRaffleById( $raffle_id );                 

                    //for multiple product raffle, the last raffle number needs to be taken from the table - raffle_products
                    $last_ticket_no = (int) $raffle_obj->get_last_purchased(); 
                    $tmp_last_ticket_no = $last_ticket_no + 1;

                    $no_of_tickets_product  = intval( $raffle_product_no );                  

                    if( $no_of_tickets_product > 0){
                        
                        $found_products = true;
                        $product = wc_get_product( $product_id );
                        $product_name = $product->get_title();
                        $product_price = $product->get_price();                    
                        
                        $purchased_quantity    = intval( $item['quantity'] );

                        $total_tickets_purchased += $no_of_tickets_product * $purchased_quantity;
                        $total_price             += floatval( $item['line_total'] );
                        $tickets_purchased       = $no_of_tickets_product * $purchased_quantity;

                        $is_live = $raffle_obj->is_live() ? 1 : 0;

                        $price_total = $product_price * $purchased_quantity;
                        $generated_tickets = array();
                                                
                        //catid_one used as raffle type
                        $record_main = array(
                            'orderid'       => $order_id,
                            'customerid'    => $customer_id,
                            'productid'     => $product_id,
                            'quantity'      => $purchased_quantity,                           
                            'ticketspurchased' => $tickets_purchased,
                            'ticketno'      => 0,
                            'ticketfrom'    => $last_ticket_no + 1,
                            'ticketto'      => 0,
                            'totalprice'    => $price_total,
                            'tickettxt'     => '',
                            'liveorder'     => $is_live,
                            'order_status'  => '',
                            'ticket'        => array(),
                            'catid_one'     => $raffle_id,
                            'session_id'    => $session_id,
                            'deleted'       => $deleted 
                        );            
                        
                        //test duplicates
                        //$tmp_last_ticket_no -= 2;
                        //end of test duplicates
                                                                       
                        $product_tickets = $tmp_last_ticket_no + ( $tickets_purchased - 1 );
                      
                        while( $tmp_last_ticket_no <= $product_tickets ){

                            $record_main['ticket'][] = $tmp_last_ticket_no;                                       
                            $generated_tickets[] = $tmp_last_ticket_no;
                            $tmp_last_ticket_no += 1; 

                        }                   

                        $this->db_obj->insertNewRecMain( $record_main ); 

                        if( $this->get_checkDuplicates() == 'yes'){

                            //check if any duplicates found after inserting
                            $duplicates = $this->db_obj->getDuplicatesForRaffle( $raffle_id );  

                            try {
                                if( count( $duplicates ) > 0 ){

                                    foreach( $duplicates as $dup ){
                                    
                                        $ticket_dup = (int)$dup->ticket;
    
                                        if( in_array( $ticket_dup, $generated_tickets ) ){
    
                                            $last_ticket_no = $raffle_obj->get_last_purchased( $raffle_obj->get_is_live() ); 
                                            $last_ticket_no += 1; //go to next
                                            $updated = $this->db_obj->changeTicket( $order_id, $raffle_id, $ticket_dup, $last_ticket_no );
    
                                            try { 
                                                RafflePlayWoo_error_log( sprintf('Duplicated Ticket Fixed: Raffle id %d, order id %d, duplicated ticket %d, changed to %d, updated %s',
                                                     $raffle_id, $order_id, $ticket_dup, $last_ticket_no, ( ($updated == 1 ) ? 'yes' : 'no' )
                                                ));
                                            } catch (\Throwable $th) {
                                                //throw $th;
                                            }
    
    
                                        }
    
                                    }
                                }
                            } catch (\Throwable $th) {
                                RafflePlayWoo_error_log( $th->getMessage() );
                                RafflePlayWoo_error_log( 'Could not fix duplicates');
                            }

                            
                        }
                        
                    }
                    
                }
            }
        }

    }

    private function update_ticketsFromCheckout( $order_id, $customer_id = '', $session_id = '' ){

        if( $order_id != -1 && $customer_id != '' && $session_id != '' ){
            try {
                $order = wc_get_order( $order_id );
            } catch (\Throwable $th) {
                RafflePlayWoo_error_log('Cannot process order (update_ticketsFromCheckout) ' . $th->getMessage() ); 
                return;
            }

            try {
                $customer_id = $order->get_customer_id();
                $session_id = WC()->session->get_customer_id();
    
                $this->db_obj->updateTicketsFromCheckout( $order_id, $customer_id, $session_id );
            } catch (\Throwable $th) {
                RafflePlayWoo_error_log('Cannot get customer info (update_ticketsFromCheckout) ' . $th->getMessage() ); 
                return;
            }


        }

        try {
            $this->db_obj->updateTicketsFromCheckout( $order_id, $customer_id, $session_id );
        } catch (\Throwable $th) {
            RafflePlayWoo_error_log('Cannot update tickets (update_ticketsFromCheckout) ' . $th->getMessage() ); 
        }

    }

    private function delete_generated_tickets_above_time(){

        $gen_checkout_set   = $this->get_genCheckoutSettings();    
        $time               = $gen_checkout_set['time'];

        $this->db_obj->deleteSessionTicketsByTime( $time );
    }

    public function drp_woo_process_checkout( $order_id){
        $this->drp_woo_process_order( $order_id );              
    }

    public function drp_woo_save_custom_fields( $post_id ){    
        
        $product = wc_get_product( $post_id );
        $custom_field_ckb = '';
        $raffle_type = 0;

        if( isset( $_POST[ self::PRODUCT_CKB ] ) ){
            $custom_field_ckb =  $_POST[ self::PRODUCT_CKB ];           
        }                                         

        $product->update_meta_data( self::PRODUCT_CKB , esc_attr( $custom_field_ckb ) );                    
     
      
        if( isset( $_POST[ self::PRODUCT_NO_NAME ] )  ){
            $custom_field_ticket_no = (int) $_POST[ self::PRODUCT_NO_NAME ];        
            $product->update_meta_data( self::PRODUCT_NO_NAME, esc_attr( $custom_field_ticket_no ) );
           
        }
        if( isset( $_POST[ self::RAFFLE_TYPE ] )  ){
            $raffle_type =  isset( $_POST[ self::RAFFLE_TYPE ] ) ?  $_POST[ self::RAFFLE_TYPE ] : '0';
            $product->update_meta_data( self::RAFFLE_TYPE , esc_attr( $raffle_type ) );
        }

        $product->save(); 
        
        //update raffle product
        $this->db_raffle->deleteProductRaffle( $post_id );
        if( $custom_field_ckb !== '' ){
            $this->db_raffle->insertProductRaffle( $raffle_type, $post_id );
        }
    }

    private function drp_get_main_settings(){
        $settings = [
            'raffle_name'               => $this->get_raffle_name(),
            self::COUNT_STARTS_AT_TXT   => $this->getCountStartsAt(),
            'started_orders'            => $this->hasStartedOrders(),
            'live_raffle'               => $this->isLiveRaffle(),
            'live_last_ticket'          => $this->db_raffle->getLastSoldTicket( 0 ), // $this->getLastTicketNo( true ),
            'test_start_ticket'         => $this->getDefaultDebugNo(),
            'test_last_ticket'          => $this->getLastTicketNo( false ),
            'ticket_prefix'             => $this->getTicketPrefix(),
            'end_date'                  => $this->getEndDate(),
            'end_time'                  => $this->getEndTime(),
            'email_header_lbl'          => $this->getEmailHeaderLbl(),
            'email_body_lbl'            => $this->getEmailBodyLbl(),         
            'db_health'                 => $this->isTablesCreated(),
            'is_limited'                => $this->isRaffleLimited(),
            'limit_no'                  => '',
            'start_date'                => '',
            'end_date'                  => '',
            'start_time'                => '',
            'end_time'                  => '',
            'email_extra'               => '',
            'email_pos'                 => $this->getEmailPos(),
            'terminated'                => $this->isRaffleTerminated(),          
            'live_tickets_purchased'    => $this->db_obj->getNoTicketRaffle( true, 0 ),
            'test_tickets_purchased'    => $this->db_obj->getNoTestTickets(),                     
            'msg_shortcode'             => self::DEFAULT_RAFFLE_SHORT,
            'products'                  => $this->drp_getDefaultRaffleProducts(),
            'inc_raffle_name'           => $this->get_inc_name(),
            'limit_order_per_raffle'    => false,
            'limit_order_per_raffle_txt'=> '',
            'msg_will_enddate'          => '',
            'ticket_image_raffles'      => $this->get_ticketImageRaffles(),
            'show_acc_tab'              => $this->get_showAccTabRaffle(),
            'check_duplicates'          => $this->get_checkDuplicates(),
            'show_orders_table'         => $this->get_showOrdersTable(),
            'gen_c_set'                 => $this->get_genCheckoutSettings(),
            'gen_checkout'              => $this->get_rafflesGenCheckout(),
            'order_status_gen'          => $this->get_orderStatusGenerateTickets()
        ];

        
        if( ! isset( $settings['ticket_image_raffles']['0'] ) ){
            $default_raffle_ticket_img = array(
                'show' => 'yes',
                'ticket_image' => 'blue',
                'ticket_image_url' => ''
            );
            $default_raffle_ticket_img = (object) $default_raffle_ticket_img;
            $settings['ticket_image_raffles']['0'] = $default_raffle_ticket_img;
        }
        

        return $settings;

    }

    public function drp_woo_custom_raffle_tab( $tabs ){

        $tabs['raffle_custom_tab'] = array(
            'label'     => esc_html__( 'Raffle Play Woo Settings', 'raffle-play-woo' ),
            'priority'  => 1200,
            'target'    => 'callback_raffle_custom_tab'
        );

        return $tabs;
    }

    public function drp_woo_custom_product_data_fields(){
        ?>
            <div id="callback_raffle_custom_tab" class="panel woocommerce_options_panel">
            <?php
                global $product_object;

                $value = $product_object->get_meta( self::PRODUCT_NO_NAME, true );     
            
                if ( ! $value ) 
                    $value = 1;
                
                $checkbox_raffle = array(
                    'label' => esc_html__('Raffle Play Product', 'raffle-play-woo'), // Text in Label
                    'class' => '',
                    'style' => '',
                    'wrapper_class' => '',       
                    'id' => self::PRODUCT_CKB, 
                    'name' => self::PRODUCT_CKB,     
                    'desc_tip' => '',
                    'custom_attributes' => '', 
                    'description' => 'Check if this is going to be a raffle product'
                );

                $no_of_tickets =array( 
                    'value'             =>  $value,
                    'id'                => self::PRODUCT_NO_NAME, 
                    'name'              => self::PRODUCT_NO_NAME,            
                    'label'             => esc_html__( 'Raffle Number of tickets', 'raffle-play-woo' ), 
                    'placeholder'       => '', 
                    'description'       => esc_html__( 'Enter the number or raffle tickets you want to generate for this product.', 'raffle-play-woo' ),
                    'type'              => 'number',             
                    'custom_attributes' => array(
                            'step' 	=> 'any',
                            'min'	=> '1'
                        ) 
                );
            
                $raffles = $this->get_simple_raffles();
                $raffle_type = array(
                    'id'            => self::RAFFLE_TYPE,
                    'name'          => self::RAFFLE_TYPE,
                    'label'         => esc_html__( 'Raffles List', 'raffle-play-woo' ), 
                    'options'       => $raffles,
                    'description'   => esc_html__( 'Select a raffle for this product', 'raffle-play-woo' ),                               
                );

                if( $product_object->get_type() == 'variable' ){
                    $checkbox_raffle['label'] = esc_html__('Raffle Play Product - Free Version only works with Simple Product', 'raffle-play-woo'); // Text in Label              
                    $checkbox_raffle['description'] = esc_html__('Free Version only works with Simple Product', 'raffle-play-woo'); // Text in Label              
                }

                woocommerce_wp_checkbox( $checkbox_raffle ); 
                woocommerce_wp_text_input( $no_of_tickets ); 
                woocommerce_wp_select( $raffle_type );    
            ?>
        </div>
        <?php
    }

    public function drp_table_shop_order_column( $columns ){
        
        $columns['raffle_play_woo'] = "<span><img style='position: relative; top:8px; margin-right: 5px;' 
                                        src='".RAFFLE_PLAY_WOO_URL."/images/icons/plugin-icon.png' alt='raffle' /></span>" . 
                                        esc_html__('Raffle Tickets', 'raffle-play-woo') .
                                        "<span><img style='position: relative; top:8px; margin-left: 5px;' 
                                        src='".RAFFLE_PLAY_WOO_URL."/images/icons/plugin-icon.png' alt='raffle' /></span>";

        return $columns;
    }

    public function drp_render_custom_column( $column_id, $order ){
        
        if( $column_id == 'raffle_play_woo'){
            $order_id = $order->get_id();
            $this->drp_show_ticket_sq_order_table( $order_id );      
        }
    }

    private function drp_show_ticket_sq_order_table( $order_id ){

        $rec_data       = $this->db_obj->getTicketsFromOrder( $order_id );   

        if( count( $rec_data ) == 0 ){
            return;
        }
        
        $def_raffle_name    = $this->get_raffle_name();    
       
        $header             = "<section class='woocommerce-order-details'>";
    
        $info_data = array();      
     
        foreach( $rec_data as $item ){
            $raffle_id = $item->raffle;     

            if( $item->raffle == 0  ){
                if( ! isset( $info_data[ $def_raffle_name] ) ){
                    $info_data[ $def_raffle_name]['tickets'] = array();
                }
                $ticket_no = $item->ticket;
                array_push( $info_data[ $def_raffle_name ]['tickets'], $ticket_no );               
            }
        }
       
        if( sizeof( $info_data ) > 0 ){
            echo $header;
        ?>
            <style>
                .div-ticket-wrapper{
                    background-repeat: no-repeat;
                    background-size: 100%;       
                    text-align: center; 
                    display: inline-block;     
                    margin-left: 2px;
                    height: 42px;  
                    width: 80px; 
                    line-height: 45px;   
                    transform: rotate( 0deg );  
                    margin-top: 4px;
                    margin-bottom: 4px;
                }

                .ticket-image-container{
                    color: #000;
                    font-size: 1rem;
                    font-weight: 600;
                }

                .wc-orders-list-table-shop_order
                #raffle_play_woo,
                .wc-orders-list-table-shop_order
                .column-raffle_play_woo{
                    text-align: center;
                    width: 230px;
                }
            </style>


            <table style="width: 100%; margin-bottom: 0; margin-left: -1px; font-weight: 600; border-collapse: collapse" 
                class="shop_table additional_info">
                <tbody>
                 
                        <?php 
                            foreach( $info_data as $raffle=>$tickets_row ){
                                $tickets_str = '';                                                      

                                if( is_array( $tickets_row['tickets'] )){
                                    $tickets_str = implode( ', ', $tickets_row['tickets'] );
                                }     
                                                               
                            ?>
                                <tr>
                                    <td style="color:#636363;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:center" >
                                        <?php echo esc_html( $tickets_str ); ?> 
                                    </td>                          
                                </tr>

                            <?php                                         
                            } 
                                                        
                            ?>   
                   
                </tbody>
            </table>
     
        <?php          
            echo '</section>';
        }
    }


    public function drp_woo_product_checkbox(){
        $checkbox_raffle = array(
            'label' => __('Raffle Play Product', 'raffle-play-woo'), // Text in Label
            'class' => '',
            'style' => '',
            'wrapper_class' => '',       
            'id' => self::PRODUCT_CKB, 
            'name' => self::PRODUCT_CKB,     
            'desc_tip' => '',
            'custom_attributes' => '', 
            'description' => ''
          );

        $no_of_tickets =array( 
            'id'                => self::PRODUCT_NO_NAME, 
            'name'              => self::PRODUCT_NO_NAME,
            'label'             => __( 'Raffle Number of tickets', 'raffle-play-woo' ), 
            'placeholder'       => '', 
            'description'       => __( '', 'raffle-play-woo' ),
            'type'              => 'number',             
            'custom_attributes' => array(
                    'step' 	=> 'any',
                    'min'	=> '0'
                ) 
        );

     
        $raffles = $this->get_simple_raffles();

        $raffle_type = array(
            'id'            => self::RAFFLE_TYPE,
            'name'          => self::RAFFLE_TYPE,
            'label'         => __( 'Raffle', 'raffle-play-woo' ), 
            'options'       => $raffles                                
        );
          
        woocommerce_wp_checkbox( $checkbox_raffle ); 
        woocommerce_wp_text_input( $no_of_tickets );               
        woocommerce_wp_select( $raffle_type );
    }

    private function drp_GetDuplicatedMessage(){
        $health_obj =  $this->db_obj->runHealthCheck();
        $result = array();
        if( $health_obj == null )
            return $result;
        else{
          
            foreach( $health_obj as $dup ){
                $raffle_name = $dup->r_name;
                if( $dup->catid_one == '0')
                    $raffle_name = $this->get_raffle_name();

                $line = "<p>" . sprintf( esc_html('%s- Order Id %d has ticket number %d', 
                'raffle-play-woo'), $raffle_name, $dup->order_id, $dup->ticket ) . "</p>";
                array_push( $result, $line ); 
            }
                     
        }

        return $result;
    }

    public function drp_settings(){   
       
        if( is_user_logged_in() && current_user_can( 'manage_options' ) && is_admin() ){
        
            $settings = $this->drp_get_main_settings();
            $settings['health'] = $this->drp_GetDuplicatedMessage();         

            W_RafflePlayWoo_MainPage::drp_MainPage( $settings );
        }
    }

    public function drp_view_page(){
        $settings = array(
            'live_raffle' => $this->isLiveRaffle(),
            'statuses' => wc_get_order_statuses(),         
            'saved_statuses' => explode( ',', $this->getFilterStatusView() ),
            'raffles' => $this->get_simple_raffles(),                    
        );
       
        W_RafflePlayWoo_ViewPage::drp_ViewPage( $settings );
    }

    public function drp_audit_page(){
        $settings = array();
        W_RafflePlayWoo_AuditPage::drp_AuditPage( $settings );
    }


    public function drp_reports_page(){

        if( is_user_logged_in() && current_user_can( 'manage_options' ) && is_admin() ){            

            $countries_obj   = new \WC_Countries();
            $countries       = $countries_obj->__get('countries');            

            $settings = array(
                'statuses' => wc_get_order_statuses(),
                'saved_statuses' => explode( ',', $this->getOption('saved_statuses', 'wc-processing,wc-completed') ),
                'custom_currency' => $this->getOption('custom_currency', ''),
                'custom_cols'    =>  stripslashes( $this->getOption('custom_cols', '[]') ),
                'custom_cols_ava' => stripslashes( $this->getOption('custom_cols_ava', '[]') ), 
                'countries'      => $countries,
                'base_country'   => $countries_obj->get_base_country(),
                'raffles'        => $this->get_simple_raffles(),                          
            );

            W_RafflePlayWoo_Reports\RafflePlayWoo_Front::drp_reports_html( $settings );
        } 
    }


    public function drp_update_order_customer_id( $order_id, $items ){    

        try {
            //code...

            if( $order_id ){

                if( isset( $items['customer_user'])  ){

                    $customer_id = 0;

                    if( $items['customer_user'] ){
                        $customer_id = (int)$items['customer_user'];
                    }
                
                    $this->db_obj->updateCustomerIdForOrder( (int)$order_id, $customer_id );
                }
            }

        } catch (\Throwable $th) {
            RafflePlayWoo_error_log( 'drp_update_order_customer_id - ' . $th->getMessage() );
        }
    }

    public function drp_save_settings(){
        //make sure user is logged in, and is administrator
        if( is_user_logged_in() && current_user_can( 'manage_options' ) && is_admin() ){
            if( isset( $_POST['data'] ) && isset( $_POST['action']) && ($_POST['action'] === 'drp_save_settings') ){

                if ( ! isset( $_POST['data']['raffle_woo_nonce_name'] ) ||
                        ! wp_verify_nonce( sanitize_text_field(  wp_unslash( $_POST['data']['raffle_woo_nonce_name'] ) ), 'raffle_woo_nonce_action' ) ){
                      
                    echo wp_json_encode(
                        array(
                            'error' => 'Page did no verify'
                        )
                    );
                    
                    die();
                    
                }
                
                $init_count_start_at = isset( $_POST['data'][ self::COUNT_STARTS_AT_TXT ] ) ? sanitize_text_field(  wp_unslash( $_POST['data'][ self::COUNT_STARTS_AT_TXT ] ) ) : '';
                $init_live_raffle    = '1'; 
                $email_header        = isset( $_POST['data'][ self::EMAIL_HEADER ] ) ? sanitize_text_field(  wp_unslash( $_POST['data'][ self::EMAIL_HEADER  ] ) ) : '';
                $email_body          = isset( $_POST['data'][ self::EMAIL_BODY ] ) ? sanitize_text_field(  wp_unslash( $_POST['data'][ self::EMAIL_BODY  ] )) : '';
                $ticket_prefix       = isset( $_POST['data'][ self::TICKET_PREFIX ] ) ? sanitize_text_field( wp_unslash( $_POST['data'][ self::TICKET_PREFIX  ] ) ) : '';  

                $email_pos           = '2'; 
                $is_terminated       = 'no';                
              
                $raffle_name         = isset( $_POST['data'][ self::RAFFLE_NAME ] ) ? sanitize_text_field(  wp_unslash( $_POST['data'][ self::RAFFLE_NAME  ] )) : '';
                $inc_name            = isset( $_POST['data'][ self::INC_NAME ] ) ? sanitize_text_field(  wp_unslash( $_POST['data'][ self::INC_NAME  ] ) ) : '0';
                
                $show_ticket_image          = isset( $_POST['data'][ self::SHOW_TICKET_IMAGE ] ) ? sanitize_text_field( wp_unslash( $_POST['data'][ self::SHOW_TICKET_IMAGE ] ) ) : 'no';
                $ticket_image               = isset( $_POST['data'][ self::TICKET_IMAGE ] ) ? sanitize_text_field( wp_unslash( $_POST['data'][ self::TICKET_IMAGE ] ) ) : 'blue';
                $ticket_image_url           = '';

                $show_acc_tab       = isset( $_POST['data'][ self::ACC_TAB_RAFFLE ] ) ? sanitize_text_field(  wp_unslash( $_POST['data'][ self::ACC_TAB_RAFFLE ]  ) ) : 'no';
                $check_duplicates   = isset( $_POST['data'][ self::CHECK_DUPLICATES ] ) ? sanitize_text_field(  wp_unslash( $_POST['data'][ self::CHECK_DUPLICATES ] ) ) : 'no';    
                $show_orders_table  = isset( $_POST['data'][ self::SHOW_ORDERS_TABLE ] ) ?
                                            sanitize_text_field(  wp_unslash( $_POST['data'][ self::SHOW_ORDERS_TABLE ] ) ) : 'no';          
                                            
                $gen_checkout               = isset( $_POST['data'][ self::GEN_CHECKOUT ] ) ? sanitize_text_field( $_POST['data'][ self::GEN_CHECKOUT ]  ) : 'no';
             

                $this->set_rafflesGenCheckout( $gen_checkout, 0 );

                $this->set_genCheckoutSettings(
                    array(
                        'time'            => sanitize_text_field( wp_unslash( $_POST['data'][ 'gen_c_set_time'] )),
                        'countdown'       => sanitize_text_field( wp_unslash( $_POST['data'][ 'gen_c_set_countdown'] )),
                        'location'        => sanitize_text_field( wp_unslash( $_POST['data'][ 'gen_c_set_location'] )),
                        'location_block'  => sanitize_text_field( wp_unslash( $_POST['data'][ 'gen_c_set_location_block'] )),
                        'countdown_lbl'   => sanitize_text_field( wp_unslash( $_POST['data'][ 'gen_c_set_countdown_lbl'] )), 
                        'remove_checkout' => sanitize_text_field( wp_unslash( $_POST['data'][ 'gen_c_set_remove_checkout'] )), 
                        'cycles'          => sanitize_text_field( wp_unslash( $_POST['data'][ 'gen_c_set_cycles'] )),    
                        'msg_removed'     => sanitize_text_field( wp_unslash( $_POST['data'][ 'gen_c_msg_removed'] )),                      
                    )   
                ); 
                
                $arr_order_status = array(
                    'woocommerce_order_status_processing' => sanitize_text_field( wp_unslash( $_POST['data'][ 'order_status_processing'] )),
                    'woocommerce_order_status_completed'  => sanitize_text_field( wp_unslash( $_POST['data'][ 'order_status_completed'] )),
                    'woocommerce_order_status_on-hold'    => sanitize_text_field( wp_unslash( $_POST['data'][ 'order_status_onhold'] )),
                );

                $this->set_orderStatusGenerateTickets( $arr_order_status );

                $this->set_showAccTabRaffle( $show_acc_tab );   
                $this->set_checkDuplicates( $check_duplicates );                            

                $ticket_image_raffle = array(
                    'show' => $show_ticket_image,
                    'ticket_image' => $ticket_image,
                    'ticket_image_url' => $ticket_image_url
                );  

                $this->set_showOrdersTable( $show_orders_table );

                $saved_ticket_image_raffles = $this->get_ticketImageRaffles();
             
                $saved_ticket_image_raffles['0'] = $ticket_image_raffle;                            
                
                $this->set_ticketImageRaffles( $saved_ticket_image_raffles );
                                 
                $this->updateRaffleLimited('no');

                $count_start_at  = intval( $init_count_start_at ) ;
                $old_count_at   =  intval( $this->getCountStartsAt() );
                $live_raffle_val = sanitize_text_field(  wp_unslash( $init_live_raffle ) );

                $this->set_raffle_name( $raffle_name );

                $this->setEmailPos( $email_pos );

                $this->setRaffleTerminated( $is_terminated );  
                               

                if( strlen( $ticket_prefix ) > 15 )
                    $ticket_prefix = substr( $ticket_prefix, 0, 15 );
                
                if( $count_start_at !== $old_count_at ){
                    
                    $this->updateCountStartsAt( $count_start_at );
                    $this->updateLastTicketNo( $count_start_at, true);
                }
                
                if( $live_raffle_val != '' )
                    $this->updateLiveRaffle( $live_raffle_val ); 
                  
                if(  isset( $_POST['data'][ self::EMAIL_HEADER ] ) )
                    $this->setEmailHeaderLbl( $email_header );
                
                if( isset( $_POST['data'][ self::EMAIL_BODY ] ) )
                    $this->setEmailBodyLbl( $email_body );

                if( isset( $_POST['data'][ self::TICKET_PREFIX ] ) )
                    $this->setTicketPrefix( $ticket_prefix );

                $this->delete_generated_tickets_above_time();
                

                $return = [
                    'live_raffle' => $this->isLiveRaffle(),
                    'count_start_at' => $this->getCountStartsAt(),
                    'last_live_ticket' => $this->db_raffle->getLastSoldTicket( 0 ),
                    'email_header'   => $email_header,
                    'email_body'     => $email_body,                                       
                ];
                echo wp_json_encode( $return );
                die();              
            }else{
                echo '0';
                die();
            }
        }else{
            echo '0';
            die();
        }

    }

    public function drp_get_data(){
        //make sure user is logged in, and is administrator
        if ( is_user_logged_in() && current_user_can( 'manage_options' ) && is_admin() ) {

            if( isset( $_POST['data'] ) ){

                if ( ! isset( $_POST['data']['raffle_woo_nonce_name'] ) ||
                    ! wp_verify_nonce( sanitize_text_field(  wp_unslash( $_POST['data']['raffle_woo_nonce_name'] )), 'raffle_woo_nonce_action' ) ){
                    
                    echo wp_json_encode(
                        array(
                            'error' => 'Page did not verify'
                        )
                    );
                    
                    die();
                    
                }
              
                if( isset( $_POST['data']['get_info'])  && ( ($_POST['data']['get_info'] =='filter_dates') || ($_POST['data']['get_info'] =='get_info') ) ){
                
                    $inc_deleted    = isset( $_POST['data']['inc_deleted']) ? (intval( sanitize_text_field(  wp_unslash( $_POST['data']['inc_deleted'] ))) == '1') : false; 
                    $liveData       = isset( $_POST['data']['live_data']) ? (intval( sanitize_text_field(  wp_unslash(  $_POST['data']['live_data'] ))) == '1') : false; 
                    $fromDate       = isset( $_POST['data']['dates']['from_date'] )  ?  sanitize_text_field(  wp_unslash( $_POST['data']['dates']['from_date'] )) : '';
                    $toDate         = isset( $_POST['data']['dates']['to_date'] )  ?  sanitize_text_field(  wp_unslash( $_POST['data']['dates']['to_date'] )) : '';
                    $raffle_id      = isset( $_POST['data']['raffle']) ? intval( sanitize_text_field(  wp_unslash( $_POST['data']['raffle'] )))  : 0; 

                    $is_pending         = isset( $_POST['data']['is_pending'] ) ?   intval( sanitize_text_field(  wp_unslash(  $_POST['data']['is_pending'] ))) : 0; 
                    $is_processing      = isset( $_POST['data']['is_processing'] ) ? intval( sanitize_text_field(  wp_unslash( $_POST['data']['is_processing'] ))) : 0; 
                    $is_on_hold         = isset( $_POST['data']['is_on_hold'] ) ? intval( sanitize_text_field(  wp_unslash( $_POST['data']['is_on_hold'] ))) : 0; 
                    $is_completed       = isset( $_POST['data']['is_completed'] ) ? intval(  sanitize_text_field(  wp_unslash( $_POST['data']['is_completed'] ))) : 0; 
                    $is_cancelled       = isset( $_POST['data']['is_cancelled'] ) ? intval( sanitize_text_field(  wp_unslash( $_POST['data']['is_cancelled'] ))) : 0; 
                    $is_refunded        = isset( $_POST['data']['is_refunded'] ) ? intval( sanitize_text_field(  wp_unslash( $_POST['data']['is_refunded'] ))) : 0; 
                    $is_failed          = isset( $_POST['data']['is_failed'] ) ? intval( sanitize_text_field(  wp_unslash( $_POST['data']['is_failed'] ))) : 0;  
                    
                    $order_status = array();
                    if( $is_pending === 1 ) array_push( $order_status, "'wc-pending'");
                    if( $is_processing === 1 ) array_push( $order_status, "'wc-processing'"); 
                    if( $is_on_hold === 1 ) array_push( $order_status, "'wc-on-hold'"); 
                    if( $is_completed === 1 ) array_push( $order_status, "'wc-completed'"); 
                    if( $is_cancelled === 1 ) array_push( $order_status, "'wc-cancelled'"); 
                    if( $is_refunded === 1 ) array_push( $order_status, "'wc-refunded'"); 
                    if( $is_failed === 1 ) array_push( $order_status, "'wc-failed'"); 

             
                    
                    $extraSettings  = array(
                       'from_date' => $fromDate,
                       'to_date'   => $toDate,
                       'raffle_id' => $raffle_id,
                       'order_status' => implode(',', $order_status )
                    );
                 
                    $tickets_data   = $this->db_obj->getLiveData( $liveData, $extraSettings, $inc_deleted );
                    echo wp_json_encode( $tickets_data );
                    die();

                }else if( isset( $_POST['data']['get_info']) && ($_POST['data']['get_info'] == 'get_order_link')){

                    if( isset( $_POST['data']['order_id'] ) ){

                        $order_id = intval( $_POST['data']['order_id'] );
                        $url_order = get_edit_post_link( $order_id );                    
                        echo urlencode( $url_order );
                        die();

                    }else{
                        echo '';
                        die();
                    }
                }else if ( isset( $_POST['data']['action_delete'] ) && ($_POST['data']['action_delete'] == 'drp_delete_tickets' )){
                    $raffle_id = intval( sanitize_text_field( wp_unslash( $_POST['data']['raffle_id'] ) ) );

                    $result = array();
                    echo $result;
                    die();
                }                
                else{
                    echo '0';
                    die();
                }    
            }else{
                echo '0';
                die();
            }
        }else{
            echo '0';
            die();
        }   
    }


    public function drp_fix_db(){
        if ( is_user_logged_in() && current_user_can( 'manage_options' ) && is_admin() ) {

            if ( ! isset( $_POST['raffle_woo_nonce_name'] ) ||
                ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['raffle_woo_nonce_name'] ) ), 'raffle_woo_nonce_action' ) ){
                
                echo wp_json_encode(
                    array(
                        'error' => 'Page did no verify'
                    )
                );
                
                die();
                
            }

            if( isset( $_POST['data']) && ( $_POST['data'] == 'fix_db') ){
                $this->setVersionSaved( wp_rand( 155, 1000) );
                echo 'changed';
                die();

            }else{
                die();
            }

        }
    }

    public function drp_raffles_page(){

        if( is_user_logged_in() && current_user_can( 'manage_options' ) && is_admin() ){

            $settings = array();         

            W_RafflePlayWoo_Raffles::drp_ProductPage( $settings );

        }
    }

    public function drp_releases_page(){

        if( is_user_logged_in() && current_user_can( 'manage_options' ) && is_admin() ){
     
            Releases::drp_ReleasesPage();
           
        }
    }

    private function get_simple_raffles(){
        if( $this->default_raffle == null )
            $this->drp_loadDefaultRaffle( 0 );

        $default_raffle_name = $this->default_raffle->get_name();

        if( $this->default_raffle->is_terminated() )
            $default_raffle_name .= ' (' . __('Terminated', 'raffle-play-woo' ) . ')';

        $options = array(        
            '0' => $default_raffle_name
        );
     
        $raffles = $this->db_raffle->rafflesAsArray( $options);

        return $raffles;
    }


    public function drp_winners_page(){
        if( is_user_logged_in() && current_user_can( 'manage_options' ) && is_admin() ){

            $settings = array(
            );

            W_RafflePlayWoo_Winners::drp_WinnersPage( $settings );
        }
    }

    public function drp_promotion_page(){

        if ( is_user_logged_in() && 
            ( current_user_can( 'manage_options' )  ) && 
                is_admin() ) {

                    $data = $this->get_promoSettings();                   
         
                    $raffles = $this->get_simple_raffles();

                    $args = array(
                        'parent' => '1'
                    );

                    $prod_cat =  get_terms( 'product_cat' );
        
                    $settings = array(
                        'data'          => $data,
                        'raffles'       => $raffles,                       
                        'currency'      => get_woocommerce_currency_symbol(),
                        'raffle_icon'   => RAFFLE_PLAY_WOO_URL.'/images/icons/plugin-icon.png',
                        'categories'    => $prod_cat
                    );

                Promotion::drp_promotionPage( $settings );            

        }

    }


    public function drp_info_page(){

        if ( is_user_logged_in() && current_user_can( 'manage_options' ) && is_admin() ) {

            if ( ! isset( $_POST['nonce_field_form_license'] ) ||
                 ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce_field_form_license'] )), 'nonce_field_form_license' ) ){
                  
              
            }
           
            $settings = array();
            W_RafflePlayWoo_Info::drp_InfoPage( $settings );
        }

    }

    public function drp_lucky_page(){

        if ( is_user_logged_in() && 
            current_user_can( 'manage_options'  ) && 
            is_admin() ) {
                
                $settings = array();

                Lucky::drp_luckyPage( $settings );  
                
        }
    }

    public function drp_logs_page(){
        if ( is_user_logged_in() && 
            current_user_can( 'manage_options' ) && 
            is_admin() ) {
                

            try {
                $logfilecontent = '';
                if( file_exists( RAFFLE_PLAY_WOO_LOG_FILE ) ){
                    $logfilecontent = substr( file_get_contents( RAFFLE_PLAY_WOO_LOG_FILE ), -30000 );
                    $logfilecontent = str_replace(PHP_EOL, 'new_line', $logfilecontent);
                }

            } catch (\Throwable $th) {
                RafflePlayWoo_error_log( $th->getMessage() );
            }

            try {
                $debug_log_content = '';
                $debug_file_loc = WP_CONTENT_DIR .'/debug.log';               
                if( file_exists( $debug_file_loc ) ){                
                    $debug_log_content = substr( file_get_contents( $debug_file_loc ), -30000 );
                    $debug_log_content = str_replace(PHP_EOL, 'new_line', $debug_log_content);
                }
            } catch (\Throwable $th) {
                RafflePlayWoo_error_log( $th->getMessage() );
            }

            $settings = array(
                'logfilecontent'    => esc_html( str_replace('\\', '/', $logfilecontent ) ),
                'debug_log_content' => esc_html( str_replace( '\\', '/', $debug_log_content ) )
            );
            
            Logs::drp_logsPage( $settings );  
        }
    }

}