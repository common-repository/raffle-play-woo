<?php
namespace RafflePlayWoo_MainTbl;

if( ! defined('ABSPATH') )
    die('No Access to this page');

include_once( WP_PLUGIN_DIR .'/woocommerce/src/Utilities/OrderUtil.php');

use Automattic\Woocommerce\Utilities\OrderUtil;

class RafflePlayWoo_MainTbl{
    private $main_tbl;
    private $audit_tbl;
    private $back_tbl;
    private $db;
    private $customer_tbl;
    private $order_stats_tbl;
    private $order_items_tbl;
    private $posts_table;
    private $posts_meta_table;
    private $raffle_tbl;
    private $product_tbl;
    private $winners_tbl;
    private $wc_orders;
    private $wc_order_addr;


    function __construct(){
        global $wpdb;
        $this->main_tbl         = $wpdb->prefix . 'raffleplaywoo_main';
        $this->audit_tbl        = $wpdb->prefix . 'raffleplaywoo_audit';
        $this->customer_tbl     = $wpdb->prefix . 'wc_customer_lookup';
        $this->order_stats_tbl  = $wpdb->prefix . 'wc_order_stats';
        $this->order_items_tbl  = $wpdb->prefix . 'woocommerce_order_items';   
        $this->posts_table      = $wpdb->prefix . 'posts';
        $this->posts_meta_table = $wpdb->prefix . 'postmeta';
        $this->back_tbl         = $wpdb->prefix . 'raffleplaywoo_main_bk';
        $this->raffle_tbl       = $wpdb->prefix . 'raffleplaywoo_raffle';
        $this->product_tbl      = $wpdb->prefix . 'raffleplaywoo_product';
        $this->winners_tbl      = $wpdb->prefix . 'raffleplaywoo_winners'; 
        $this->wc_orders        = $wpdb->prefix . 'wc_orders';  
        $this->wc_order_addr    = $wpdb->prefix . 'wc_order_addresses';   

        $this->db = $wpdb;
    }

    public function insertNewRecMain( $record ){  

        return $this->bulk_insert( $record );                                              
                                
    }

    private function bulk_insert( $record ){

        $order_id       = (int)sanitize_text_field( $record['orderid'] );
        $product_id     = (int)sanitize_text_field( $record['productid'] );  
        $quantity       = (int)sanitize_text_field( $record['quantity'] );     
        $customer_id    = (int)sanitize_text_field( $record['customerid'] );
        $ticket_no      = (int)sanitize_text_field( $record['ticketno'] );
        $ticket_from    = (int)sanitize_text_field( $record['ticketfrom'] );
        $ticket_to      = (int)sanitize_text_field( $record['ticketto'] );
        $total_price    = (float)sanitize_text_field( $record['totalprice'] );
        $live_order     = (int)sanitize_text_field( $record['liveorder']);
        $ticket_txt     = '';    
        $tickets_purchased = (int)sanitize_text_field( $record['ticketspurchased']);
        $order_status   = sanitize_text_field( $record['order_status']);
        $ticket         = (int)sanitize_text_field( $record['ticket']);
        $raffle_type    = (int) $record['catid_one'];
        $session_id     = sanitize_text_field( $record['session_id'] );
        $deleted        = (int) $record['deleted'];
        
        $values = $place_holders = array();
        
        if(count( $record ) > 0) {

            foreach( $record['ticket'] as $ticket ) {

                array_push( $values, 
                    $order_id, 
                    $product_id,
                    $ticket, 
                    $quantity, 
                    $customer_id, 
                    $tickets_purchased, 
                    $ticket_no, 
                    $ticket_from, 
                    $ticket_to, 
                    $total_price, 
                    $ticket_txt, 
                    $live_order, 
                    $order_status, 
                    $raffle_type, 
                    $session_id, 
                    $deleted
                );

                $place_holders[] = "(%d, %d, %d, %d, %d, %d, %d, %d, %d, %f, %s, %d, %s, %d, %s, %d)";                
            }            
        
            $this->do_insert( $place_holders, $values );
        }
    }

    private function do_insert($place_holders, $values) {

        global $wpdb;
    
        $query           = "INSERT  INTO {$this->main_tbl}
                                (order_id, product_id, ticket, quantity, customer_id, tickets_purchased, ticket_no, 
                                ticket_from, ticket_to, total_price, ticket_txt, live_order, 
                                order_status, catid_one, woo_session_id, deleted) VALUES ";
        $query           .= implode( ', ', $place_holders );

        $sql             = $wpdb->prepare( "$query ", $values );
    
        if ( $wpdb->query( $sql ) ) {
            return true;
        } else {
            return false;
        }
    
    }

    public function insertNewRecMain_old( $record ){     
        $order_id       = (int)sanitize_text_field( $record['orderid'] );
        $product_id     = (int)sanitize_text_field( $record['productid'] );  
        $quantity       = (int)sanitize_text_field( $record['quantity'] );     
        $customer_id    = (int)sanitize_text_field( $record['customerid'] );
        $ticket_no      = (int)sanitize_text_field( $record['ticketno'] );
        $ticket_from    = (int)sanitize_text_field( $record['ticketfrom'] );
        $ticket_to      = (int)sanitize_text_field( $record['ticketto'] );
        $total_price    = (float)sanitize_text_field( $record['totalprice'] );
        $live_order     = (int)sanitize_text_field( $record['liveorder']);
        $ticket_txt     = sanitize_text_field( $record['tickettxt'] );     
        $tickets_purchased = (int)sanitize_text_field( $record['ticketspurchased']);
        $order_status   = sanitize_text_field( $record['order_status']);
        $ticket         = (int)sanitize_text_field( $record['ticket']);
        $raffle_type    = (int) $record['catid_one'];
        $session_id     = sanitize_text_field( $record['session_id'] );
        $deleted        = (int) $record['deleted'];

        try{
            $result = $this->db->query( $this->db->prepare("INSERT  INTO {$this->main_tbl}
                                            (order_id, product_id, ticket, quantity, customer_id, tickets_purchased, ticket_no, ticket_from, ticket_to,
                                            total_price, ticket_txt, live_order, order_status, catid_one, woo_session_id, deleted)
                                    VALUES(%d, %d, %d, %d, %d, %d, %d, %d, %d, %f, %d, %d, %s, %d, %s, %d)", 
                                    $order_id, $product_id, $ticket, $quantity, $customer_id, $tickets_purchased, $ticket_no, $ticket_from, $ticket_to, 
                                    $total_price, $ticket_txt, $live_order, $order_status, $raffle_type, $session_id, $deleted ));
        }catch( Exception $e ){

        }
        return $result;                                                
                                
    }

    public function getRecByOrderId( $order_id ){
        $order_id = intval( $order_id );

        $result = $this->db->get_results( $this->db->prepare( "SELECT * FROM {$this->main_tbl}
                                                               WHERE order_id = %d;", $order_id ));
        return $result;                                                                   
    }

    public function getOrdersForUser( $user_id ){
        $user_id = (int) $user_id;

        $result = $this->db->get_results( $this->db->prepare(   "SELECT order_id FROM {$this->main_tbl}
                                                                WHERE customer_id = %d
                                                                GROUP BY order_id;", $user_id ), ARRAY_A);

        return $result;    
    }

    public function deleteSessionTicketsByTime( $minutes ){

        return $this->db->query( $this->db->prepare("DELETE FROM {$this->main_tbl} 
                                                       WHERE    ( order_id = -1 ) and
                                                                ( woo_session_id <> '') and
                                                                ( created_at < (NOW() - INTERVAL %d MINUTE) );", $minutes ));

    }

    public function updateCustomerIdForOrder( $order_id, $customer_id ){
        return $this->db->query( $this->db->prepare(" 
                    UPDATE {$this->main_tbl}
                    SET customer_id = %d
                    WHERE order_id = %d", $customer_id, $order_id
                ));
    }

    public function deleteTicketsBySessionId( $session_id, $inc_time_limit = false ){

        return $this->db->query( $this->db->prepare("DELETE FROM {$this->main_tbl} 
                                                       WHERE woo_session_id = %s;", $session_id ));

    }

    public function updateTicketsFromCheckout( $order_id, $customer_id, $session_id ){
        $order_id = intval( $order_id );
        $query = $this->db->query( $this->db->prepare("UPDATE {$this->main_tbl}
                                                       SET order_id = %d,
                                                            customer_id = %d,
                                                            woo_session_id = ''
                                                       WHERE woo_session_id = %s", 
                                                       $order_id, $customer_id, $session_id ));
        return $query; 
    }

    public function session_hasTickets( $session_id ){
        $result = false;

        if( $session_id != '' ){
            $query = $this->db->get_col( 
                            $this->db->prepare("SELECT order_id 
                                                FROM {$this->main_tbl} 
                                                WHERE woo_session_id = %s", $session_id ) );
            if( $query && ( $query != null) && count( $query ) > 0 ){
                $result = true;
            }                                                
        }   

        return $result;
    }


    public function getTicketsBySessionId( $session_id, $inc_time_limit = false ){

        return $this->db->get_results( $this->db->prepare("SELECT * FROM {$this->main_tbl} 
                                                       WHERE woo_session_id = %s;", $session_id ));

    }

    public function getCreatedTimeBySessionId( $session_id ){

        return $this->db->get_results( $this->db->prepare("SELECT created_at FROM {$this->main_tbl} 
                                                       WHERE woo_session_id = %s
                                                       LIMIT 1;", $session_id ));

    }

    public function getTicketsBySessionIdAndTime( $session_id, $time ){

        return $this->db->get_results( $this->db->prepare("SELECT * FROM {$this->main_tbl} 
                                                                WHERE
                                                                ( woo_session_id = %s) and
                                                                ( created_at > (NOW() - INTERVAL %d MINUTE) );", $session_id, $time));

    }

    public function getTicketsFromOrder( $order_id ){
        $order_id = intval( $order_id );

        $result = $this->db->get_results( $this->db->prepare( " SELECT ticket, catid_one as raffle, r_name as raffle_name, raffle_tbl.prefix as prefix, extra_email
                                                                FROM {$this->main_tbl} as ticket_tbl 
                                                                LEFT OUTER JOIN {$this->raffle_tbl} as raffle_tbl ON
                                                                ticket_tbl.catid_one = raffle_tbl.raffle_id
                                                                WHERE ((order_id = %d) AND ( ticket_tbl.deleted = 0) )
                                                                GROUP BY ticket
                                                                ORDER BY ticket ASC;", $order_id ));
        return $result;   
    }

    public function getTicketsFromSession( $session_id ){

        $result = $this->db->get_results( $this->db->prepare( " SELECT ticket, 
                                                                catid_one as raffle, 
                                                                r_name as raffle_name, 
                                                                raffle_tbl.prefix as prefix, 
                                                                extra_email,
                                                                raffle_tbl.shrt_extra as extra_settings
                                                                FROM {$this->main_tbl} as ticket_tbl 
                                                                LEFT OUTER JOIN {$this->raffle_tbl} as raffle_tbl ON
                                                                ticket_tbl.catid_one = raffle_tbl.raffle_id
                                                                WHERE ((woo_session_id = %s) AND ( ticket_tbl.deleted = 0) )
                                                                GROUP BY ticket, catid_one, ticket_tbl.id
                                                                ORDER BY ticket ASC;", $session_id ));
        return $result;  
    }

    public function getTicketsFromCustomer( $customer_id ){
        $customer_id = intval( $customer_id );

        $result = $this->db->get_results( $this->db->prepare( " SELECT ticket, catid_one as raffle, r_name as raffle_name, 
                                                                raffle_tbl.prefix as prefix, extra_email, customer_id,
																raffle_tbl.shrt_extra as extra_settings
                                                                FROM {$this->main_tbl} as ticket_tbl 
                                                                LEFT OUTER JOIN {$this->raffle_tbl} as raffle_tbl ON
                                                                ticket_tbl.catid_one = raffle_tbl.raffle_id
                                                                WHERE ((customer_id = %d) AND ( ticket_tbl.deleted = 0) )
                                                                GROUP BY ticket, catid_one
                                                                ORDER BY ticket ASC;", $customer_id ));
        return $result;  
    }

    public function getDuplicatesForRaffle( $raffle_id ){
        return $this->db->get_results( $this->db->prepare(
            "SELECT COUNT(ticket) as cnt, ticket FROM {$this->main_tbl}
             WHERE catid_one = %d 
             GROUP BY ticket, catid_one 
             HAVING COUNT(ticket) > 1;", $raffle_id 
        ));

    }

    public function changeTicket( $order_id, $raffle_id, $old_ticket, $new_ticket ){
        return $this->db->query( $this->db->prepare(" 
                    UPDATE {$this->main_tbl}
                    SET ticket = %d
                    WHERE (catid_one = %d AND order_id = %d AND ticket = %d)", 
                    $new_ticket, $raffle_id, $order_id, $old_ticket
                ));        
    }

    public function orderExists( $order_id ){
        $order_id = intval( $order_id );

        $result = $this->db->get_results( $this->db->prepare( "SELECT * FROM {$this->main_tbl}
                                                               WHERE order_id = %d;", $order_id ));

        return count( $result ) > 0 ;
    }

    public function updateTicketsRange( $order_id, $tickets_obj ){
   
        $order_id = intval( $order_id );
        $ticket_from = intval( $tickets_obj['from']);
        $ticket_to   = intval( $tickets_obj['to']);
        $ticket_txt  = $tickets_obj['txt'];
        $ticket_no   = intval( $tickets_obj['total']);
        $total_price =  $tickets_obj['totalprice'];

        $query = $this->db->query( $this->db->prepare("UPDATE {$this->main_tbl}
                                                       SET ticket_from = %d, ticket_to = %d, ticket_txt = %s, ticket_no = %d, total_price = %f
                                                       WHERE order_id = %d;", $ticket_from, $ticket_to, $ticket_txt, $ticket_no, $total_price,  $order_id ));

        return $query;                                                       
    }

    public function getLastOrderTicketNo( $live_order = true ){
      
        $live_order = $live_order ? 1 : 0;        
        $query = $this->db->get_results( $this->db->prepare("SELECT * FROM {$this->main_tbl}
                                                   WHERE live_order = %d
                                                   ORDER by order_id DESC                                                    
                                                   LIMIT 1;", $live_order ));
                                                          
        if( count( $query ) > 0 ){
            return $query[0]->ticket_to;            
        }else{
            return null;                                                                                                                            
        }
    }

    public function getLiveData( $live_order, $other_settings = array(), $inc_deleted = false ){

        $live_order  = (int)$live_order;
        $from_date   = isset( $other_settings['from_date']) ? sanitize_text_field( $other_settings['from_date'] ) : '2000-01-01';
        $to_date     = isset( $other_settings['to_date']) ? sanitize_text_field( $other_settings['to_date'] ) : '2099-01-01';
        $from_time   = isset( $other_settings['from_time']) ? ( sanitize_text_field( $other_settings['from_time'] ).':00') : '00:00:00';
        $to_time     = isset( $other_settings['to_time']) ? ( sanitize_text_field( $other_settings['to_time'] ).':59') : '23:59:59';
        $inc_deleted = (int)$inc_deleted;
        $raffle_id   = $other_settings['raffle_id'];

        $extra_query = '';

        if( trim( $from_date) == '')
            $from_date = '2000-01-01';

        if( trim( $to_date ) == '')
            $to_date = '2100-01-01';

        $status_text = $other_settings['order_status'];

        $statuses = " AND ( posts.post_status IN ( {$status_text} )) ";
        if( $inc_deleted == 1  ){
            $statuses = " ";
        }   
        
        if( $status_text == '')
            $statuses = " ";

        //get data from posts and post meta tables
        //legacy way
        if( ! OrderUtil::custom_orders_table_usage_is_enabled() ){

            $result = $this->db->get_results(
                  $this->db->prepare(   "SELECT tickets.tickets_purchased as ticket_no, tickets.ticket as raffle_ticket,
                                        tickets.tickets_purchased  as tickets_total, tickets.ticket_from, tickets.ticket_to, tickets.catid_one as raffle_id,
                                        posts.ID AS order_id, 
                                        posts.post_status AS order_status,                                                
                                        DATE_FORMAT( posts.post_date, '%%d-%%m-%%Y %%H:%%i' ) as created_at,
                                        ( SELECT post_title FROM {$this->posts_table} where id = tickets.product_id ) as product_name,
                                        MAX(CASE WHEN meta_key='_billing_first_name' THEN meta_value END)  AS first_name,
                                        MAX(CASE WHEN meta_key='_billing_last_name' THEN meta_value END) AS last_name,
                                        MAX(CASE WHEN meta_key='_billing_address_1' THEN meta_value END) AS address_one,
                                        MAX(CASE WHEN meta_key='_billing_address_2' THEN meta_value END) AS address_two,
                                        MAX(CASE WHEN meta_key='_billing_city' THEN meta_value END) AS city,
                                        MAX(CASE WHEN meta_key='_billing_postcode' THEN meta_value END) AS post_code,
                                        MAX(CASE WHEN meta_key='_billing_country' THEN meta_value END) AS country,
                                        MAX(CASE WHEN meta_key='_billing_state' THEN meta_value END) AS county,
                                        MAX(CASE WHEN meta_key='_billing_email' THEN meta_value END) AS email,
                                        MAX(CASE WHEN meta_key='_billing_phone' THEN meta_value END) AS phone,                                               
                                        MAX(CASE WHEN meta.meta_key='_order_total' THEN meta.meta_value END ) AS price
                                        FROM {$this->main_tbl} as tickets
                                        INNER JOIN  {$this->posts_table}  as posts                                               
                                        ON tickets.order_id = posts.id
                                        INNER join {$this->posts_meta_table} as meta
                                        ON posts.id = meta.post_id
                                        WHERE ( (posts.post_type = 'shop_order')  {$statuses}  AND 
                                        ( Date( posts.post_date ) BETWEEN %s AND %s )  AND (tickets.live_order = %d) 
                                        AND ( tickets.catid_one = %d ) )  
                                        GROUP BY tickets.ticket, tickets.id ORDER BY tickets.id DESC;", 
                                        $from_date, $to_date,  $live_order, $raffle_id ));
                                    
        }else{          
            //fast loading pages woocommerce 
            //get data from woocommerce tabels
            $statuses = " AND ( orders.status IN ( {$status_text} )) ";

            if( $inc_deleted == 1  ){
                $statuses = " ";
            }   
            
            if( $status_text == '')
                $statuses = " ";
        
            $result = $this->db->get_results( 
                  $this->db->prepare( "SELECT tickets.tickets_purchased as ticket_no, 
                                        tickets.ticket as raffle_ticket,
                                        tickets.tickets_purchased  as tickets_total, 
                                        tickets.ticket_from, 
                                        tickets.ticket_to, 
                                        tickets.catid_one as raffle_id,
                                        tickets.order_id AS order_id, 
                                        orders.status AS order_status,  
                                        orders.billing_email as email,  
                                        TRUNCATE( orders.total_amount, 3 ) as price,                                           
                                        DATE_FORMAT( orders.date_created_gmt, '%%d-%%m-%%Y %%H:%%i' ) as created_at,
                                        ( SELECT post_title FROM {$this->posts_table} where id = tickets.product_id ) as product_name,
                                        order_addr.first_name as first_name,
                                        order_addr.last_name as last_name,
                                        order_addr.address_1 as address_one,
                                        order_addr.address_2 as address_two,
                                        order_addr.city as city,
                                        order_addr.postcode as post_code,
                                        order_addr.country as country,
                                        order_addr.state as county,
                                        order_addr.phone as phone                                              
                                        FROM {$this->main_tbl} as tickets
                                        INNER JOIN  {$this->wc_orders}  as orders                                               
                                        ON tickets.order_id = orders.id
                                        INNER join {$this->wc_order_addr} as order_addr
                                        ON orders.id = order_addr.order_id
                                        WHERE ( (orders.type = 'shop_order')  
                                                {$statuses} AND 
                                                ( Date( orders.date_created_gmt ) BETWEEN %s AND %s ) AND
                                                ( tickets.live_order = %d ) AND
                                                ( tickets.catid_one = %d ) 
                                            )  
                                        GROUP BY tickets.ticket, tickets.id ORDER BY tickets.id DESC;", 
                                        $from_date, $to_date,  $live_order, $raffle_id ));

        }

        return $result;                                                           
    }



    public function getCustomerId( $order_id ){
        $order_id = intval( $order_id );
        $query = $this->db->query( $this->db->prepare("SELECT customer_id FROM {$this->order_stats_tbl} 
                                                       WHERE order_id = %d;", $order_id ));
        return $query;
    }  

    public function getNoTicketRaffle( $live_raffle, $raffle_id ){
        $live_raffle = $live_raffle ? 1 : 0;
        $raffle_id = intval( $raffle_id );
     
        $query = $this->db->get_results( $this->db->prepare("SELECT COUNT(ticket) as count_no FROM {$this->main_tbl} 
                                                       WHERE ((live_order = %d) AND (deleted = 0) AND (catid_one = %d));", $live_raffle, $raffle_id ));

        $result = 0;

        if( sizeof( $query ) > 0 ){
            $result = intval( $query[0]->count_no );
        }
                                                            
        return $result;
    }

    public function getNoTestTickets(){
        $live_raffle = 0;
     
        $query = $this->db->get_results( $this->db->prepare("SELECT COUNT(ticket) as count_no FROM {$this->main_tbl} 
                                                       WHERE ((live_order = %d) AND (deleted = 0))", $live_raffle ));

        $result = 0;

        if( sizeof( $query ) > 0 ){
            $result = intval( $query[0]->count_no );
        }
                                                            
        return $result;
    }
    
    public function markOrderAsDeleted( $order_id ){
        $order_id = intval( $order_id );
        $query = $this->db->query( $this->db->prepare("UPDATE {$this->main_tbl}
                                                       SET deleted = 1
                                                       WHERE order_id = %d;", $order_id ));
        return $query; 
    }

    public function markOrderAsNotDeleted( $order_id ){
        $order_id = intval( $order_id );
        $query = $this->db->query( $this->db->prepare("UPDATE {$this->main_tbl}
                                                       SET deleted = 0
                                                       WHERE order_id = %d;", $order_id ));
        return $query;   
    }

    private function getDuplicatedTickets(){
        $query = $this->db->get_results( "SELECT order_id, 
                                          ticket, 
                                          catid_one                                                                            
                                          FROM {$this->main_tbl} 
                                          WHERE live_order = 1                                         
                                          GROUP BY ticket, catid_one HAVING count( ticket) > 1;");
      
        $tickets_duplicated = array();
        foreach( $query as $row ){
            array_push( $tickets_duplicated, $row->ticket );            
        }

        return $tickets_duplicated;
      
       
    }

    public function runHealthCheck(){

        $tickets_duplicated = $this->getDuplicatedTickets();  

        $result = null;

        if( sizeof( $tickets_duplicated ) > 0 ){
      
            $tickets_impl = implode( ',', $tickets_duplicated ); 
            $result = $this->db->get_results( "SELECT order_id, ticket, r_name, catid_one
                                                FROM {$this->main_tbl} as main
                                                LEFT OUTER JOIN {$this->raffle_tbl} as raffle
                                                ON main.catid_one = raffle.raffle_id
                                                WHERE ticket IN ( {$tickets_impl} )
                                                ");         
                                                       
        }

        return $result;
    }

    //Audit table actions

    public function auditAction( $action, $message, $old_value='', $new_value='' ){
        $action     = sanitize_text_field( $action );
        $message    = sanitize_text_field( $message );
        $old_value  = sanitize_text_field( $old_value );
        $new_value  = sanitize_text_field( $new_value );

        $query = $this->db->query( $this->db->prepare( "INSERT INTO {$this->audit_tbl} (action_type, action_txt, old_value, new_value ) 
                                                                    VALUES( %s, %s, %s, %s);", $action, $message, $old_value, $new_value ));

    }

    public function checkDbHealth(){

        $result = true;

        $query_main         = $this->db->get_results( "SHOW COLUMNS FROM {$this->main_tbl}"); 
        $query_audit        = $this->db->get_results( "SHOW COLUMNS FROM {$this->audit_tbl}"); 
        $query_backup       = $this->db->get_results( "SHOW COLUMNS FROM {$this->back_tbl}"); 
        $query_raffle       = $this->db->get_results( "SHOW COLUMNS FROM {$this->raffle_tbl}"); 
        $query_product      = $this->db->get_results( "SHOW COLUMNS FROM {$this->product_tbl}"); 
        $query_winners      = $this->db->get_results( "SHOW COLUMNS FROM {$this->winners_tbl}"); 

        if( ! $this->hasColumn( $query_main, 'id' ) ){
            $result = false;
        }

        if( ! $this->hasColumn( $query_audit, 'id' ) ){
            $result = false;
        }

        if( ! $this->hasColumn( $query_backup, 'id' ) ){
            $result = false;
        }

        if( ! $this->hasColumn( $query_raffle, 'raffle_id' ) ){
            $result = false;
        }

        if( ! $this->hasColumn( $query_product, 'id' ) ){
            $result = false;
        }

        if( ! $this->hasColumn( $query_winners, 'id' ) ){
            $result = false;
        }

        return ($result ? 'yes' : 'no');
    }

    private function hasColumn( $arrColumns, $colName ){
        if( is_array( $arrColumns ) ){
            foreach( $arrColumns as $column ){
                if( $column->Field == $colName ){
                    return true;                
                }
            }
        }
        return false;
    }

    public function saveWinner( $arr_info ){
        $query = $this->db->query( $this->db->prepare( "INSERT INTO {$this->winners_tbl} (prize, ticket, raffle_id, extra_text ) 
                                                        VALUES( %s, %d, %d, %s);", 
                                                        $arr_info['prize'], $arr_info['ticket'], $arr_info['raffle_id'], $arr_info['extra_info'] ));
    }

    public function deleteWinner( $id ){
      
        $query = $this->db->query( $this->db->prepare( "DELETE FROM {$this->winners_tbl}
                                                        WHERE id = %d", $id ));  
    }

    public function ticketExists( $raffle_id, $ticket ){
        $query = $this->db->get_results( $this->db->prepare( "SELECT order_id, ticket
                                                                FROM {$this->main_tbl}
                                                                WHERE ( (catid_one = %d) and (ticket= %d) ) ", $raffle_id, $ticket ));

        $result = false;

        if( sizeof( $query ) > 0 )
            $result = true;

        return $result;
    }

    

}


class RafflePlayWoo_RaffleTbl{
    private $raffle_tbl;
    private $db;
    private $product_tbl;
    private $main_tbl;

    function __construct(){
        global $wpdb;
        $this->raffle_tbl   = $wpdb->prefix . 'raffleplaywoo_raffle';
        $this->product_tbl  = $wpdb->prefix . 'raffleplaywoo_product';
        $this->main_tbl     = $wpdb->prefix . 'raffleplaywoo_main';
        $this->db           = $wpdb;
    }

    public function loadData(){
        $query = $this->db->get_results( "SELECT * FROM {$this->raffle_tbl} ORDER BY raffle_id DESC ");

        return $query;
    }

    public function loadRaffleProducts(){
        $query = $this->db->get_result( "SELECT * FROM {$this->product_tbl} GROUP BY raffle_id, product_id");
        
        return $query;
    }

    public function loadProductsByRaffleId( $raffle_id ){
        $raffle_id = intval( $raffle_id );

        $query = $this->db->get_results( $this->db->prepare(
                                                            "SELECT * FROM {$this->product_tbl}
                                                             WHERE raffle_id = %d 
                                                             GROUP BY raffle_id, product_id", $raffle_id ));
        
        return $query; 
    }

    public function loadProductsByRaffleProductId( $raffle_id, $product_id ){
        $raffle_id = intval( $raffle_id );
        $product_id = intval( $product_id);

        $query = $this->db->get_results( $this->db->prepare(
                                                            "SELECT * FROM {$this->product_tbl}
                                                             WHERE (raffle_id = %d  AND product_id = %d)
                                                             GROUP BY raffle_id, product_id", $raffle_id, $product_id ));
        
        return $query; 
    }

    public function getRaffleById( $raffle_id ){
        $raffle_id = intval( $raffle_id );

        $query = $this->db->get_results( $this->db->prepare(
                                                            "SELECT * FROM {$this->raffle_tbl}
                                                             WHERE raffle_id = %d 
                                                             ", $raffle_id ));
        if( sizeof( $query) == 0 )
            $query = null;  
        else{
            $query = $query[0];
        }                                                           
        
        return $query; 
    }


    public function saveNewRaffle( $raffle ){           
        $query = $this->db->query( $this->db->prepare( "INSERT INTO {$this->raffle_tbl}
                                                        (r_name, is_live, is_terminated, start_ticket, is_limit, prefix, start_datetime, 
                                                        end_datetime, extra_email, extra_email_in, limit_no )
                                                        VALUES ( %s, %d, %d, %d, %d, %s, %d, %d, %s, %d, %d )
                                                        ", $raffle['name'], $raffle['is_live'], $raffle['is_terminated'], $raffle['start_ticket'],
                                                        $raffle['is_limit'], $raffle['prefix'], $raffle['start_datetime'], $raffle['end_datetime'],
                                                        $raffle['email_extra_line'], $raffle['extra_line_in'], $raffle['limit_no'] ));
        return $query;                                                        
    }

    public function getRaffleSoldTickets( $raffle_id ){
        $live_raffle = 1;
     
        $query = $this->db->get_results( $this->db->prepare("SELECT COUNT(ticket) as count_no FROM {$this->main_tbl} 
                                                       WHERE ((live_order = %d) AND (deleted = 0) AND ( catid_one = %d ) );", $live_raffle, $raffle_id ));

        $result = 0;

        if( sizeof( $query ) > 0 ){
            $result = intval( $query[0]->count_no );
        }
                                                            
        return $result;
    }

    public function getLastSoldTicket( $raffle_id ){
        $live_raffle = 1;
        $query = $this->db->get_results( $this->db->prepare("SELECT ticket FROM {$this->main_tbl} 
                                                            WHERE ((live_order = %d) AND ( catid_one = %d ) )
                                                            ORDER BY ticket DESC
                                                            LIMIT 1;", $live_raffle, $raffle_id ));

        $result = 0;

        if( sizeof( $query ) > 0 ){
            $result = intval( $query[0]->ticket );
        }
          
        return intval( $result );
    }

    public function updateRaffle( $raffle ){
        $query = $this->db->query( $this->db->prepare( "UPDATE {$this->raffle_tbl} 
                                                        SET r_name = %s,
                                                        is_live = %d,
                                                        is_terminated = %d,
                                                        start_ticket = %d,
                                                        is_limit = %d,
                                                        prefix = %s,
                                                        start_datetime = %d,
                                                        end_datetime = %d,
                                                        extra_email = %s,
                                                        extra_email_in = %d,
                                                        limit_no = %d
                                                        WHERE raffle_id = %d;                                                        
                                                        ", $raffle['name'], $raffle['is_live'], $raffle['is_terminated'], $raffle['start_ticket'],
                                                        $raffle['is_limit'], $raffle['prefix'], $raffle['start_datetime'], $raffle['end_datetime'],
                                                        $raffle['email_extra_line'], $raffle['extra_line_in'], $raffle['limit_no'], $raffle['id']  ));
        return $query;                                                        
    }

    public function insertProductRaffle( $raffle_id, $product_id ){
        $raffle_id = intval( $raffle_id );
        $product_id = intval( $product_id );

        $can_insert = $this->loadProductsByRaffleProductId( $raffle_id, $product_id );      

        if( sizeof( $can_insert ) == 0 ){

            $query = $this->db->query( $this->db->prepare( "INSERT INTO {$this->product_tbl}
                                                            (raffle_id, product_id) 
                                                            VALUES( %d, %d)", $raffle_id, $product_id ));
        }
    }

    public function deleteProductRaffle( $product_id ){

        $product_id = intval( $product_id );
        return $this->db->query( $this->db->prepare( "DELETE FROM {$this->product_tbl}
                                                        WHERE product_id = %d", $product_id ));  

    }

    public function rafflesAsArray( $result ){
      
        $terminated = __('(Terminated)', 'raffle-play-woo');
        $deleted    = __('(Deleted)', 'raffle-play-woo' );

        $query = $this->db->get_results( "SELECT * FROM {$this->raffle_tbl}");       

        foreach( $query as $raffle ){

            if( $raffle->is_terminated )
                $result[ $raffle->raffle_id ] = $raffle->r_name . ' ' . $terminated;
            else if ( $raffle->deleted )
                $result[ $raffle->raffle_id ] = $raffle->r_name . ' ' . $deleted;
            else
                $result[ $raffle->raffle_id ] = $raffle->r_name;

        }

        return $result;
    }

    public function raffleNamebyProduct( $default_raffle_name, $product_id ){
        $product_id = intval( $product_id );
        $result     = $default_raffle_name;
        $terminated = __('(T)', 'raffle-play-woo');
        $deleted    = __('(D)', 'raffle-play-woo' );
        

        $query = $this->db->get_results( $this->db->prepare(
                                         "SELECT * FROM {$this->raffle_tbl} as raffles 
                                          INNER JOIN {$this->product_tbl} as products
                                          ON raffles.raffle_id = products.raffle_id
                                          WHERE products.product_id = %d", $product_id ));                                           

        //should have a size of 1
        foreach( $query as $raffle ){
           
            if( $raffle->is_terminated )
                $result = $raffle->r_name . ' ' . $terminated;
            else if ( $raffle->deleted )
                $result = $raffle->r_name . ' ' . $deleted;
            else
          
            $result = $raffle->r_name;

        }

        return $result;
    }

    
}