<?php
namespace RafflePlayWoo_OptionsManager;

if( ! defined('ABSPATH') )
    die('No Access to this page');

class RafflePlayWoo_OptionsManager {
    const COUNT_STARTS_AT       = 'ticket_count_starts_at';
    const LAST_TICKET_NO        = 'last_ticket_no';
    const LAST_ORDER_NO         = 'last_order_no';
    const STARTED_ORDERS        = 'started_orders';
    const DEFAULT_STARTS_AT     =  0;
    const LIVE_RAFFLE           = 'live_raffle';  
    const DEFAULT_DEBUG_NO      =  8888000; 
    const LAST_DEBUG_NO         = 'last_debug_no';
    const TICKET_PREFIX         = 'ticket_prefix'; 
    const START_DATE            = 'start_date';
    const START_TIME            = 'start_time';
    const END_DATE              = 'end_date';
    const END_TIME              = 'end_time';
    const EMAIL_HEADER          = 'email_header';
    const EMAIL_BODY            = 'email_body';
    const EMAIL_POS             = 'email_pos';
    const LIMIT_TICKETS         = 'limit_tickets';
    const LIMIT_TICKETS_NO      = 'limit_tickets_no';
    const FILTER_STATUS         = 'filter_status_view';
    const TABLES_CREATED        = 'tables_created'; 
    const RAFFLE_TERMINATE      = 'terminated';

    const DEFAULT_START_DATE    = '2010-01-01 00:00';
    const DEFAULT_END_DATE      = '2050-01-01 00:00'; 

    const NEW_VERSION           = 'new_version';
    const LAST_VERSION_CHECK    = 'last_version_check';

    const RAFFLE_NAME           = 'raffle_name';
    const INC_NAME              = 'inc_name';

    const SHORTCODE_MSG         = 'raffle'; 

    const SHOW_TICKET_IMAGE          = 'show_ticket_image';
    const TICKET_IMAGE               = 'ticket_image';
    const TICKET_IMAGE_URL           = 'ticket_image_url';

    const TICKET_IMAGE_RAFFLES       = 'ticket_image_raffles';
    const ACC_TAB_RAFFLE             = 'acc_tab_raffle';

    const CHECK_DUPLICATES           = 'check_duplicates';

    const SHOW_ORDERS_TABLE          = 'show_orders_table';

    const PROMO_SETTINGS             = 'promo_settings';

    const GEN_CHECKOUT               = 'gen_checkout';
    const GEN_CHECKOUT_SET           = 'gen_checkout_set';
    const RAFFLE_GEN_CHECKOUT        = 'raffle_gen_checkout';

    const ORDER_STATUS_GEN_TICKETS   = 'order_status_gen_tickets';

    // ----------------  gen checkout settings ---------------------------------------
    protected function get_genCheckoutSettings(){        
        $result = ( array )json_decode( $this->getOption( self::GEN_CHECKOUT_SET, '{}' ) );
        if( ! isset( $result['time'] ) ){
            $result[ 'time' ]           = 6;
            $result[ 'countdown' ]      = 'no';
            $result[ 'countdown_lbl']   = 'Raffle tickets are reserved for %d minutes at checkout';
            $result[ 'location']        = 'woocommerce_review_order_after_order_total';
            $result[ 'location_block']  = '.wc-block-components-panel__content';
            $result[ 'remove_checkout'] = 'no';
            $result[ 'cycles']          = 1;
            $result[ 'msg_removed']     = 'Tickets are not reserved anymore, but can be purchasable and will be generated after checkout';
            $result[ 'extra_one']   = '';
            $result[ 'extra_two']   = '';
            $result[ 'extra_three'] = '';
        }
        
        return $result;
    }

    protected function set_genCheckoutSettings( $value ){
        $value = wp_json_encode( $value );
        if( ! $this->updateOption( self::GEN_CHECKOUT_SET, $value ) )
            $this->addOption( self::GEN_CHECKOUT_SET, $value );
    }

    // ----------------  order status generate tickets ---------------------------------------
    protected function get_orderStatusGenerateTickets(){     
           
        $result = ( array )json_decode( $this->getOption( self::ORDER_STATUS_GEN_TICKETS, '{}' ) );

        if( ! isset( $result['woocommerce_order_status_processing'] ) ){
            $result[ 'woocommerce_order_status_processing' ]    = 'yes';
            $result[ 'woocommerce_order_status_completed' ]     = 'yes';
            $result[ 'woocommerce_order_status_on-hold']        = 'yes';
        }
        
        return $result;
    }

    protected function set_orderStatusGenerateTickets( $value ){
        $value = wp_json_encode( $value );
        if( ! $this->updateOption( self::ORDER_STATUS_GEN_TICKETS, $value ) )
            $this->addOption( self::ORDER_STATUS_GEN_TICKETS, $value );
    }


    // ---------------- raffle gen checkout  ---------------------------------------
    protected function get_rafflesGenCheckout(){        
        $result = ( array )json_decode( $this->getOption( self::RAFFLE_GEN_CHECKOUT, '{}' ) );
        return $result;
    }

    protected function set_rafflesGenCheckout( $value, $raffle_id ){
        
        $res = $this->get_rafflesGenCheckout();
        $res[ $raffle_id ] = $value;
        $value = wp_json_encode( $res );

        if( ! $this->updateOption( self::RAFFLE_GEN_CHECKOUT, $value ) )
            $this->addOption( self::RAFFLE_GEN_CHECKOUT, $value );
    }

    //-------------- promo settings -----------------------------
    protected function get_promoSettings(){
        $data = $this->getOption( self::PROMO_SETTINGS, '' );
        if( $data ){
            return json_decode( $data );
        }

        return '{}'; 
    }

    protected function set_promoSettings( $value ){

        if( ! $this->updateOption( self::PROMO_SETTINGS, $value ) )
            $this->addOption( self::PROMO_SETTINGS, $value );

    }

    //-------------- show ticket image -----------------------------
    protected function get_ticketImageRaffles(){

        $result =  ( array )json_decode( $this->getOption( self::TICKET_IMAGE_RAFFLES, 
                                    "{}")  );     
                                    
        if( ! isset( $result['0'] ) ){
            $default_raffle_ticket_img = array(
                'show' => true,
                'ticket_image' => 'blue',
                'ticket_image_url' => ''
            );
            $default_raffle_ticket_img = (object) $default_raffle_ticket_img;
            $result['0'] = $default_raffle_ticket_img;
        }

        return $result;
    }

    protected function set_ticketImageRaffles( $value ){
        $value = wp_json_encode( $value );
        if( ! $this->updateOption( self::TICKET_IMAGE_RAFFLES, $value ) )
            $this->addOption( self::TICKET_IMAGE_RAFFLES, $value );
    }

    // ------------------ Show Orders Table raffle tickets -----------------
    protected function get_showOrdersTable(){
        return  $this->getOption( self::SHOW_ORDERS_TABLE, 'yes' );
    }

    protected function set_showOrdersTable( $value ){
        if( ! $this->updateOption( self::SHOW_ORDERS_TABLE, $value ) )
            $this->addOption( self::SHOW_ORDERS_TABLE, $value );
    }

    //-------------- show Acc Tab Raffle -----------------------------
    protected function get_showAccTabRaffle(){
        return $this->getOption( self::ACC_TAB_RAFFLE, 'no' );
    }

    protected function set_showAccTabRaffle( $value ){    
        if( ! $this->updateOption( self::ACC_TAB_RAFFLE, $value ) )
            $this->addOption( self::ACC_TAB_RAFFLE, $value );
    }

    //-------------- check duplicates -----------------------------
    protected function get_checkDuplicates(){
        return  $this->getOption( self::CHECK_DUPLICATES, 'no' );
    }

    protected function set_checkDuplicates( $value ){
        if( ! $this->updateOption( self::CHECK_DUPLICATES, $value ) )
            $this->addOption( self::CHECK_DUPLICATES, $value );
    }


    //-------------- license -----------------------------
    protected function get_newVersion(){
        return $this->getOption( self::NEW_VERSION, RAFFLE_PLAY_WOO_VERSION );
    }

    protected function set_newVersion( $value ){
        if( ! $this->updateOption( self::NEW_VERSION, $value ) )
            $this->addOption( self::NEW_VERSION, $value );
    }


    //-------------- version -----------------------------
    protected function get_lastVersionCheck(){
        $now_time = current_time( 'timestamp' );
        return $this->getOption( self::LAST_VERSION_CHECK, $now_time);
    }

    protected function set_lastVersionCheck( $value ){
        if( ! $this->updateOption( self::LAST_VERSION_CHECK, $value ) )
            $this->addOption( self::LAST_VERSION_CHECK, $value );
    }

    //-------------- raffle_name -----------------------------
    protected function get_raffle_name(){
        return stripslashes( esc_html__( $this->getOption( self::RAFFLE_NAME, 'Raffle') ) );
    }

    protected function set_raffle_name( $value ){
        if( ! $this->updateOption( self::RAFFLE_NAME, $value ) )
            $this->addOption( self::RAFFLE_NAME, $value );
    }

    //-------------- Include Raffle Name-----------------------------
    protected function get_inc_name(){
        return $this->getOption( self::INC_NAME, '0') == '1';
    }

    protected function set_inc_name( $value ){
        if( ! $this->updateOption( self::INC_NAME, $value ) )
            $this->addOption( self::INC_NAME, $value );
    }


    //================================================

    protected function updateLastTicketNo( $ticket_no, $isLiveRaffle ){

        if( $isLiveRaffle ){
            if( ! $this->updateOption( self::LAST_TICKET_NO, $ticket_no ) ){
                $this->addOption( self::LAST_TICKET_NO, $ticket_no );
            }
        }else{
            if( ! $this->updateOption( self::LAST_DEBUG_NO, $ticket_no ) ){
                $this->addOption( self::LAST_DEBUG_NO, $ticket_no );
            }
        }
    }

    protected function getDefaultDebugNo(){
        return self::DEFAULT_DEBUG_NO; 
    }

    protected function getLastTicketNo( $isLiveRaffle ){
        $ticket_start_at    = (int)$this->getOption( self::COUNT_STARTS_AT, self::DEFAULT_STARTS_AT ); 
        $last_ticket_no     = (int)$this->getOption( self::LAST_TICKET_NO, $ticket_start_at );           
        $last_debug_no      = (int)$this->getOption( self::LAST_DEBUG_NO, self::DEFAULT_DEBUG_NO );  

        if( $isLiveRaffle )
            return $last_ticket_no;
        else
            return $last_debug_no;        
    }

    protected function getTicketPrefix(){
        return ( $this->getOption( self::TICKET_PREFIX, 'T-') );
    }

    protected function setTicketPrefix( $ticket_prefix ){
        if( ! $this->updateOption( self::TICKET_PREFIX, $ticket_prefix ) )
            $this->addOption( self::TICKET_PREFIX, $ticket_prefix );
    }

    protected function isTablesCreated(){
        return ( $this->getOption( self::TABLES_CREATED, 'yes') === 'yes' );
    }

    protected function setTablesCreated( $value ){
        if( ! $this->updateOption( self::TABLES_CREATED, $value ) )
            $this->addOption( self::TABLES_CREATED, $value );
    }

    protected function getFilterStatusView(){
        return ( $this->getOption( self::FILTER_STATUS, 'wc-processing,wc-completed,wc-on-hold' ) );
    }

    protected function setFilterStatusView( $new_status ){
        if( ! $this->updateOption( self::FILTER_STATUS, $new_status ) )
            $this->addOption( self::FILTER_STATUS, $new_status );
    }

    protected function isRaffleLimited(){
        return ( $this->getOption( self::LIMIT_TICKETS, 'no') === 'yes' );
    }

    protected function updateRaffleLimited ( $new_value ){
        if( ! $this->updateOption( self::LIMIT_TICKETS, $new_value ) )
            $this->addOption( self::LIMIT_TICKETS, $new_value );
    }


    protected function getEmailHeaderLbl(){
        return  stripslashes( esc_html( ( $this->getOption( self::EMAIL_HEADER, esc_html__('Raffle', 'raffle-play-woo') ) ) ) );
    }
    
    protected function setEmailHeaderLbl( $email_header){
        if( ! $this->updateOption( self::EMAIL_HEADER, $email_header ) )
            $this->addOption( self::EMAIL_HEADER, $email_header );
    }

    protected function getEmailBodyLbl(){
        return stripslashes( esc_html( $this->getOption( self::EMAIL_BODY, esc_html__('Tickets', 'raffle-play-woo') ) ) );
    }
    
    protected function setEmailBodyLbl( $email_body){
        if( ! $this->updateOption( self::EMAIL_BODY, $email_body ) )
            $this->addOption( self::EMAIL_BODY, $email_body );
    }

    protected function getEmailPos(){
        return ( $this->getOption( self::EMAIL_POS, '2') );
    }
    
    protected function setEmailPos( $email_pos ){
        if( ! $this->updateOption( self::EMAIL_POS, $email_pos ) )
            $this->addOption( self::EMAIL_POS , $email_pos );
    }

    protected function getStartDate(){
        return  ( trim( $this->getOption( self::START_DATE, '') ) );
    }

    protected function setStartDate( $start_date ){
        if( ! $this->updateOption( self::START_DATE, $start_date ) )
            $this->addOption( self::START_DATE, $start_date );
    }

    protected function getStartTime(){
        return ( trim( $this->getOption( self::START_TIME, '') ) );
    }

    protected function setStartTime( $start_time ){
        if( ! $this->updateOption( self::START_TIME, $start_time ) )
            $this->addOption( self::START_TIME, $start_time );
    }

    protected function getNowTime(){
        return current_time( 'timestamp');
    }


    protected function isRaffleTerminated(){
        return ( $this->getOption( self::RAFFLE_TERMINATE, 'no') === 'yes' );
    }

    protected function setRaffleTerminated( $new_value){
        if( ! $this->updateOption( self::RAFFLE_TERMINATE, $new_value ) )
            $this->addOption( self::RAFFLE_TERMINATE, $new_value );
    }

    protected function getLimitNo(){
        return  intval( ( $this->getOption( self::LIMIT_TICKETS_NO, '0') ) );
    }

    protected function setLimitNo( $limit_no ){
        if( ! $this->updateOption( self::LIMIT_TICKETS_NO, $limit_no ) )
            $this->addOption( self::LIMIT_TICKETS_NO, $limit_no );
    }

    protected function getEndDate(){
        return ( trim( $this->getOption( self::END_DATE, '') ) );
    }

    protected function setEndDate( $end_date ){
        if( ! $this->updateOption( self::END_DATE, $end_date ) )
            $this->addOption( self::END_DATE, $end_date );
    }

    protected function getEndTime(){
        return ( trim( $this->getOption( self::END_TIME, '') ) );
    }

    protected function setEndTime( $end_time ){
        if( ! $this->updateOption( self::END_TIME, $end_time ) )
            $this->addOption( self::END_TIME, $end_time );
    }

    protected function updateLastOrderId( $order_id ){
        if( ! $this->updateOption( self::LAST_ORDER_NO, $order_id ) )
            $this->addOption( self::LAST_ORDER_NO, $order_id );
    }

    protected function getLastOrderId( $default ){
        return (int)$this->getOption( self::LAST_ORDER_NO, $default );
    }

    protected function isLiveRaffle(){
        return ($this->getOption( self::LIVE_RAFFLE, '1' ) === '1'); 
    }

    protected function updateLiveRaffle( $value ){
        $return = true;
        if( ! $this->updateOption( self::LIVE_RAFFLE, $value ) )
            $return = $this->addOption( self::LIVE_RAFFLE, $value );

        return $return;  
    }

    protected function startedOrders(){
        if( ! $this->updateOption( self::STARTED_ORDERS, '1' ) )
            $this->addOption( self::STARTED_ORDERS, '1' ); 
    }

    protected function hasStartedOrders(){
        return ( $this->getOption( self::STARTED_ORDERS, '0' ) === '0' );
    }

    protected function getCountStartsAt(){
        return $this->getOption( self::COUNT_STARTS_AT, self::DEFAULT_STARTS_AT );
    }

    protected function updateCountStartsAt( $value ){
        $return = true;
        if( ! $this->updateOption( self::COUNT_STARTS_AT, $value ) )
            $return = $this->addOption( self::COUNT_STARTS_AT, $value );

        return $return;
    }

    public function getOptionNamePrefix() {
        return 'RafflePlayWoo_';
    }

    public function getOptionMetaData() {
        return array();
    }


    public function getOptionNames() {
        return array_keys($this->getOptionMetaData());
    }


    protected function initOptions() {
    }


    protected function deleteSavedOptions() {
        $optionMetaData = $this->getOptionMetaData();
        if (is_array($optionMetaData)) {
            foreach ($optionMetaData as $aOptionKey => $aOptionMeta) {
                $prefixedOptionName = $this->prefix($aOptionKey); // how it is stored in DB
                delete_option($prefixedOptionName);
            }
        }
    }


    public function getPluginDisplayName() {
        return get_class($this);
    }


    public function prefix($name) {
        $optionNamePrefix = $this->getOptionNamePrefix();
        if (strpos($name, $optionNamePrefix) === 0) { // 0 but not false
            return $name; // already prefixed
        }
        return $optionNamePrefix . $name;
    }



    public function getOption($optionName, $default = null) {
        $prefixedOptionName = $this->prefix($optionName); // how it is stored in DB       
        $retVal = get_option($prefixedOptionName);
        if (!$retVal && $default) {
            $retVal = $default;
        }
        return $retVal;
    }


    public function deleteOption($optionName) {
        $prefixedOptionName = $this->prefix($optionName); // how it is stored in DB
        return delete_option($prefixedOptionName);
    }


    public function addOption($optionName, $value) {
        $prefixedOptionName = $this->prefix($optionName); // how it is stored in DB
        return add_option($prefixedOptionName, $value);
    }

    public function updateOption($optionName, $value) {
        $prefixedOptionName = $this->prefix($optionName); // how it is stored in DB
        return update_option($prefixedOptionName, $value);
    }

    public function getRoleOption($optionName) {
        $roleAllowed = $this->getOption($optionName);
        if (!$roleAllowed || $roleAllowed == '') {
            $roleAllowed = 'Administrator';
        }
        return $roleAllowed;
    }

    public function isUserRoleEqualOrBetterThan($roleName) {
        if ('Anyone' == $roleName) {
            return true;
        }
        $capability = $this->roleToCapability($roleName);
        return current_user_can($capability);
    }

    public function canUserDoRoleOption($optionName) {
        $roleAllowed = $this->getRoleOption($optionName);
        if ('Anyone' == $roleAllowed) {
            return true;
        }
        return $this->isUserRoleEqualOrBetterThan($roleAllowed);
    }

    public function registerSettings() {
        $settingsGroup = get_class($this) . '-settings-group';
        $optionMetaData = $this->getOptionMetaData();
        foreach ($optionMetaData as $aOptionKey => $aOptionMeta) {
            register_setting($settingsGroup, $aOptionMeta);
        }
    }
 

    protected function getMySqlVersion() {
        global $wpdb;
        $rows = $wpdb->get_results('select version() as mysqlversion');
        if (!empty($rows)) {
             return $rows[0]->mysqlversion;
        }
        return false;
    }

 
    public function getEmailDomain() {
        // Get the site domain and get rid of www.
        $sitename = strtolower($_SERVER['SERVER_NAME']);
        if (substr($sitename, 0, 4) == 'www.') {
            $sitename = substr($sitename, 4);
        }
        return $sitename;
    }

}