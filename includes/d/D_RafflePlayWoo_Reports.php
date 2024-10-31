<?php
namespace RafflePlayWoo_Reports;

if( ! defined('ABSPATH') )
    die('No Access to this page');

class RafflePlayWoo_Reports{

    private $db;
    private $tickets_tbl;
    private $customer_table;
    private $order_stats_table;
    private $future_date;
    private $past_date;
    private $intern;
    private $posts_table;
    private $posts_meta_table;
    private $currency;
    private $order_status;
    private $order_status_query;
    private $date_format;
    private $raffle_id;
    
    function __construct(){
        global $wpdb;

        $this->db = $wpdb;
        $this->tickets_tbl         = $wpdb->prefix . 'raffleplaywoo_main';
        $this->customer_table       = $wpdb->prefix . 'wc_customer_lookup';
        $this->order_stats_table    = $wpdb->prefix . 'wc_order_stats';
        $this->posts_table          = $wpdb->prefix . 'posts';
        $this->posts_meta_table     = $wpdb->prefix . 'postmeta';
        $this->future_date          = '2100-12-12 00:00:00';
        $this->past_date            = '1990-01-01 00:00:00';
        $this->order_status_query   = array();
        $this->date_format          = array( 
                                        '%d/%m/%Y',
                                        '%Y/%m/%d',
                                        '%d-%m-%Y',   
                                        '%Y-%m-%d',
                                        '%d/%m/%y',
                                        '%d-%m-%y',
                                        '%y/%m/%d',
                                        '%y-%m-%d',
                                        );
        $this->raffle_id            = 0;                                        
    }

    function get_report( $from, $to, $type, $extra ){

    }


    
}