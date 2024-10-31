<?php
namespace RafflePlayWoo_Raffles;

include_once( 'd/D_RafflePlayWoo_Main.php');

if( ! defined('ABSPATH') )
    die('No Access to this page');

use RafflePlayWoo_MainTbl\RafflePlayWoo_RaffleTbl as RafflePlayWoo_RaffleTbl;

class RafflePlayWoo_RaffleProduct{
    private $id;
    private $is_live;
    private $name;
    private $is_terminated;
    private $start_ticket;
    private $last_purchased;
    private $is_limit;
    private $limit_no;
    private $prefix;
    private $start_datetime;
    private $end_datetime;
    private $total_purchased;
    private $email_extra_line;
    private $extra_line_in;
    private $shortcode;
    private $deleted;
    private $products;
    private $start_time;
    private $end_time;

    private $extra_info;
    private $loaded_extra;

    private $email_line_one;
    private $email_line_two;
    private $email_pos;
    private $inc_name;

    private $msg_terminated;
    private $msg_not_started;
    private $msg_has_ended;
    private $msg_none_left;
    private $msg_add_ex;
    private $msg_update_ex;
    private $msg_will_enddate;  

    private $wp_date_format;
    private $wp_time_format;

    private $test_ticket;

    public function __construct(){
        $this->id               = null;
        $this->name             = '';
        $this->is_live          = true;
        $this->is_terminated    = false;
        $this->start_ticket     = 0;
        $this->last_purchased   = 0;
        $this->is_limit         = false;
        $this->limit_no         = 0;
        $this->prefix           = 'Ticket-';
        $this->start_datetime   = 0;        
        $this->end_datetime     = 0; //strtotime( '2099-01-01' );
        $this->total_purchased  = 0;
        $this->email_extra_line = '';
        $this->shortcode        = '';
        $this->deleted          = false;
        $this->products         = array();
        $this->extra_line_in    = false;

        $this->extra_info       = array();

        $this->loaded_extra     = false;
        $this->email_line_one   = '';
        $this->email_line_two   = '';
        $this->email_pos        = 2;
        
        $this->msg_terminated       = '';
        $this->msg_not_started      = '';
        $this->msg_has_ended        = '';
        $this->msg_none_left        = '';
        $this->msg_add_ex           = '';
        $this->msg_update_ex        = '';
        $this->msg_will_enddate     = '';

        $this->wp_date_format       = '';    
        $this->wp_time_format       = '';  

        $this->test_ticket          = 0;  
        
        $this->inc_name             = false;
    
    }

    function get_id(){ return $this->id; }
    function set_id( $id ){ $this->id = $id; }
    function get_is_live(){ return $this->is_live; }
    function set_is_live( $value ){ $this->is_live = ( $value === 1 ) || ( $value == true ); }
    function get_name(){ return $this->name; }
    function set_name( $value ){ $this->name = $value;}
    function get_is_terminated(){ return $this->is_terminated; }
    function set_is_terminated( $value ){ $this->is_terminated = ( $value === 1 ) || ( $value == true ); }
    function get_start_ticket(){ return $this->start_ticket;}
    function set_start_ticket( $value ){ $this->start_ticket = $value; }
    function get_test_ticket(){ return $this->test_ticket;}
    function set_test_ticket( $value ){ $this->test_ticket = intval( $value ); }
    function set_last_purchased( $value ){ $this->last_purchased = intval( $value ); }
    function get_is_limit(){ return $this->is_limit; }
    function set_is_limit( $value ){ $this->is_limit = ($value === 1) || ( $value == true ); }
    function get_limit_no(){ return $this->limit_no; }
    function set_limit_no( $value ){ $this->limit_no = $value; }
    function get_prefix(){ return $this->prefix; }
    function set_prefix( $value ){ $this->prefix = $value;}    
    function get_start_datetime(){ return $this->start_datetime; }
    function set_startDateTime($new_value ){ $this->start_datetime = $new_value; }
    function set_start_datetime( $start_date, $time ){ 
        if( $time == '' )
            $time = '00:00';

        if( $start_date != '' ){
            $start_date = $start_date . ' ' . $time;
            $date_b = \DateTime::createFromFormat('d-m-Y H:i', $start_date )->format('Y-m-d H:i');   
            $start_date = strtotime( $start_date );        
        }else{
            $start_date = 0;
        } 

        $this->start_datetime = $start_date;     
    }
    function get_startTimeAsString(){
        if( ($this->start_datetime == 0) || ($this->start_datetime == '') )
            return '';
        else{
            $date = date('H:i', $this->start_datetime );
            return $date;
        }
    }
    function get_end_datetime(){ return $this->end_datetime; }
    function set_endDateTime( $new_value ){ $this->end_datetime = $new_value; }
    function set_end_datetime( $end_date, $time ){
        if( $time == '' )
            $time = '23:59';

        if( $end_date != '' ){
            $end_date .= ' ' . $time;
            $date_b = \DateTime::createFromFormat('d-m-Y H:i', $end_date )->format('Y-m-d H:i');   
            $end_date = strtotime( $date_b );
        }else{
            $end_date = 0;
        }
        
        $this->end_datetime = $end_date;
    }
    function get_endTimeAsString(){
        if( ($this->end_datetime == 0) || ($this->end_datetime == '') )
            return '';
        else{
            $date = date( 'H:i', $this->end_datetime );
            return  $date;
        }
    }
    function get_total_purchased(){ return $this->total_purchased; }
    function set_total_purchased( $value ){ $this->total_purchased = $value; }
    function get_email_extra_line(){ return $this->email_extra_line; }
    function set_email_extra_line( $value ){ $this->email_extra_line = $value;} 
    function get_extra_line_in(){ return $this->extra_line_in; }
    function set_extra_line_in( $value ){ $this->extra_line_in = ( $value === 1 ) || ( $value == true );}  
    function get_shortcode(){ return $this->shortcode; }
    function set_shortcode(){
         $this->shortcode = "[raffle name='msg' id='{$this->id}']";
    }  
    function get_deleted(){ return $this->deleted; }
    function set_deleted( $value ){ $this->deleted = ($value === 1) || ( $value == true); }
    function add_product( $value ){$this->products = $value;}
    function get_extra_info(){ return $this->extra_info; }
    function set_extra_info( $value ){ $this->extra_info = $value; }
    function add_item_extra( $value ){ array_push( $this->extra_info, $value ); }

    function loaded_extra(){return $this->loaded_extra; }
    function get_msg_email_line_one(){ return $this->email_line_one; }
    function get_msg_email_line_two(){ return $this->email_line_two; }
    function get_email_pos(){ return $this->email_pos; }

    function get_msg_terminated(){ return $this->msg_terminated; }
    function get_msg_not_started(){ return $this->msg_not_started; }
    function get_msg_has_ended(){ return $this->msg_has_ended; }
    function get_msg_none_left(){ return $this->msg_none_left; }
    function get_msg_will_enddate(){ return $this->msg_will_enddate; }

    function get_inc_name(){ return $this->inc_name;}
    function set_inc_name( $value ){ $this->inc_name = $value; }

    function is_live(){
        return $this->is_live;
    }

    function is_limited(){
        return $this->is_limit;
    }

    function get_last_purchased(){
        if( ! $this->is_live ){
            return $this->test_ticket;
        }else{
            $db_obj = new RafflePlayWoo_RaffleTbl();
            $last_sold = $db_obj->getLastSoldTicket( $this->id );
            //get the max ticket 
            $max_ticket = max( $last_sold, $this->last_purchased, $this->start_ticket );
            return $max_ticket;
        }
    }

    function is_terminated( &$msg = '' ){
        if( $this->is_terminated ){
            $msg = $this->msg_terminated;
            return true;
        }else{
            return false;
        }
    }

    function load_extra( $extra = array() ){

        if( ! $this->loaded_extra ){ //load the extra

            $this->loaded_extra = true;

            $this->email_line_one       = $extra['email_line_one'];
            $this->email_line_two       = $extra['email_line_two'];
            $this->email_pos            = $extra['email_pos'];
            $this->msg_terminated       = $extra['msg_terminated'];
            $this->msg_not_started      = $extra['msg_not_started'];
            $this->msg_has_ended        = $extra['msg_has_ended'];
            $this->msg_none_left        = $extra['msg_none_left'];
            $this->msg_add_ex           = $extra['msg_add_ex'];
            $this->msg_update_ex        = $extra['msg_update_ex'];
            $this->wp_date_format       = $extra['wp_date_format'];
            $this->wp_time_format       = $extra['wp_time_format']; 
            $this->inc_name             = $extra['inc_name'];  
            $this->msg_will_enddate     = $extra['msg_will_enddate'];     

            $this->extra_info           = $extra;            
        }
    }

}