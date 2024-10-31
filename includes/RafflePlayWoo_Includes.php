<?php

namespace RafflePlayWoo_Includes;

if( ! defined('ABSPATH') )
    die('No Access to this page');

class RafflePlayWoo_Includes {
    
    static function rpwoo_loading_screen(){
        ?>
        <div class="drp-loader-img" id="drpLoaderImg"></div>
        <?php
    }

    static function rpwoo_create_dropdown( $arr, $id ){
        $result =  "<select name='{$id}' id='{$id}'>";
        
        foreach( $arr as $key=>$value ){
                    
            $result .= "<option value='{$key}'> {$value} </option>";
        }

        $result .= "</select>";

        return $result;
    }

    static function rpwoo_premium_image(){
        echo  "<img class='rpwoo-premium-image' src='".  RAFFLE_PLAY_WOO_URL."/images/icons/premium-image-16.png' 
                data-toggle='tooltip' data-placement='right'  title='". esc_html__('Premium Feature', 'raffle-play-woo')."' />";
    }

    static function rpwoo_premium_link(){
        echo " <span style='font-size: 14px; float: right; white-space:nowrap;'><img class='rpwoo-premium-image' src='".RAFFLE_PLAY_WOO_URL ."/images/icons/premium-image-16.png' /> 
               <a href='https://tuskcode.com' target='_blank'>"  . esc_html__('Get Premium License', 'raffle-play-woo')." </a> 
               <img class='rpwoo-premium-image' src='". RAFFLE_PLAY_WOO_URL ."/images/icons/premium-image-16.png' /> </span> ";
    }


    public static function raffle_add_feedback_form() {
        ?>
            <style>
                .raffle-feedback-header{
                    background-color: #00bda5;
                    background-image: linear-gradient(-303deg, #7b7b7b, #00afb2 56%, #00bda5);
                    position: absolute;
                    top: 0px;
                    left: 0px;
                    width: 100%;
                    align-items: center;
                    min-height: 80px;
                }

                .raffle-feedback-header h2{
                    color: white;                        
                    padding-left: 15px;
                    font-size: 1.5rem;
                    padding-top: 5px;
                }

                #raffle_feedback_wrapper{
                    background: #000;
                    opacity: 0.7;
                    filter: alpha(opacity=70);
                    position: fixed;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    left: 0;
                    z-index: 1000050;
                }
                #raffle_feedback_container{
                    display: block;
                    position: fixed;
                    top: 0px;
                    z-index: 1000051;
                    background-color: white;
                    left: 30%;
                    margin: 20px;
                    padding: 20px;
                    margin-top: 50px;                      
                    left: 50%;
                    width: 450px;
                    transform: translateX(-50%);
                }
                #raffle_modal_close{
                    width: 16px;
                    height: 16px;
                    float: right;
                    cursor: pointer;
                    margin-top: -35px;
                    margin-right: 20px;
                    color: white;
                }

                .raffle-close-path{
                    fill: currentcolor;
                    stroke: currentcolor;
                    stroke-width: 2;
                }
                #raffle_close_svg{
                    display: block;
                    -webkit-box-flex: 1;
                    flex-grow: 1;
                }
                .raffle-radio-input-container{
                    padding: 5px;
                }
                .raffle-feedback-body{
                    margin-top: 90px;
                }
                #raffle_feedback_textarea{
                    margin-bottom: 10px;
                    text-align: left;
                    vertical-align: middle;
                    transition-property: all;
                    transition-duration: 0.15s;
                    transition-timing-function: ease-out;
                    transition-delay: 0s;
                    border-radius: 3px;
                    border: 1px solid #cbd6e2;
                    background-color: #f5f8fa;
                    margin-top: 10px;
                    padding: 9px 10px;
                    width: 100%;
                }
                .raffle-radio-input-container{
                    font-size: 1rem;
                }
                #raffle_email_input{
                    border-radius: 3px;
                    border: 1px solid #cbd6e2;
                    background-color: #f5f8fa;
                    margin-top: 10px;
                    padding: 9px 10px;
                    width: 100%; 
                    margin-bottom: 20px;
                }
                .raffle-req-sel{
                    text-decoration: underline;
                }

            </style>
            <div id="raffle_feedback_wrapper" style="display: none"> </div>
                <div id="raffle_feedback_container" style="display: none;">
                    <div class="raffle-feedback-header">
                            <h2><?php echo esc_html( __( "We're sorry to see you go", 'raffle-play-woo' ) ); ?></h2>
                            <div id="raffle_modal_close" >
                                <svg id="raffle_close_svg" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                                    <path class="raffle-close-path" d="M14.5,1.5l-13,13m0-13,13,13" transform="translate(-1 -1)"></path>
                                </svg>
                            </div>
                    </div>
                    <div class="raffle-feedback-body">
                        <div>
                            <strong>
                                <h3> <?php echo esc_html( __( "If you have a moment, please let us know why you're deactivating the plugin.", 'raffle-play-woo' ) ); ?> </h3>
                            </strong>
                        </div>
                        <form id='raffle_deactivate_form' class="raffle-deactivate-form">
                            <?php

                            $radio_buttons = array(
                                esc_html__( "Lack of functionality", 'raffle-play-woo' ),
                                esc_html__( "Too difficult to use", 'raffle-play-woo' ),
                                esc_html__( "The plugin isn't working", 'raffle-play-woo' ),
                                esc_html__( "The plugin isn't useful", 'raffle-play-woo' ),
                                esc_html__( 'Temporarily disabling or troubleshooting', 'raffle-play-woo' ),
                                esc_html__( 'Other', 'raffle-play-woo' )                                       
                            );

                            $buttons_count = count( $radio_buttons );
                            for ( $i = 0; $i < $buttons_count; $i++ ) {
                                ?>
                                    <div class="raffle-radio-input-container">
                                        <input
                                            type="radio"
                                            id="raffle_Feedback<?php echo esc_attr( $i ); ?>"
                                            name="bmpfeedback"
                                            value="<?php echo esc_attr( $i ); ?>"
                                            class="raffle-feedback-radio"
                                            required
                                        />
                                        <label for="raffle_Feedback<?php echo esc_attr( $i ); ?>">
                                            <?php echo esc_html( $radio_buttons[ $i ] ); ?>
                                        </label>
                                    </div>
                                <?php
                            }
                            ?>

                            <textarea name="details" id="raffle_feedback_textarea" class="raffle-feedback-text-area raffle-feedback-text-control"
                                placeholder="<?php echo esc_html( __( 'Extra Feedback...', 'raffle-play-woo' ) ); ?>"></textarea>
                            
                            <p>
                                <label for="raffle_include_email" style='font-size: 0.9rem; font-weight: bold;' >
                                    <input type="checkbox" id='raffle_include_email' />
                                    <?php esc_html_e('Include my email. I want to be contacted by the developer.', 'raffle-play-woo'); ?>
                                </label>
                            </p>

                            <hr/>

                            <div>
                                <strong>
                                    <h3> <?php echo esc_html( __( "Thank you for your feedback. Much appreciated.", 'raffle-play-woo' ) ); ?> </h3>
                                </strong>
                            </div>

                            <div class="raffle-button-container">
                                <button type="submit" id="raffle_btn_feedback_submit" class="button button-primary">
                                    <div class="raffle-loader-button-content">
                                        <?php echo esc_html( __( 'Submit & deactivate', 'raffle-play-woo' ) ); ?>
                                    </div>                                       
                                </button>
                                <button type="button" id="raffle_btn_feedback_skip" class="button action">
                                    <?php echo esc_html( __( 'Skip & deactivate', 'raffle-play-woo' ) ); ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    (function(){

                        var raffle_btn_feedback_close  = document.getElementById('raffle_modal_close');
                        var raffle_btn_uninstall       = document.querySelector('[data-slug="raffle-play-woo"] .deactivate a');
                        var raffle_btn_uninstall_href  = '';
                        
                        if( raffle_btn_uninstall  !== null )
                            raffle_btn_uninstall_href = raffle_btn_uninstall.getAttribute('href');    

                        var raffle_feedback_wrapper    = document.getElementById('raffle_feedback_wrapper');   
                        var raffle_feedback_container  = document.getElementById('raffle_feedback_container');                 
                        var raffle_btn_feedback_submit = document.getElementById('raffle_btn_feedback_submit');
                        var raffle_btn_feedback_skip   = document.getElementById('raffle_btn_feedback_skip');

                        if( raffle_btn_feedback_close !== null ){
                            raffle_btn_feedback_close.addEventListener('click', function( e ){                               
                                raffle_feedback_wrapper.style.display = 'none';
                                raffle_feedback_container.style.display = 'none';
                            });
                        }

                        if( raffle_btn_uninstall !== null ){
                            raffle_btn_uninstall.addEventListener('click', function( e ){
                                if( raffle_feedback_wrapper !== null && raffle_feedback_container !== null ){

                                    e.preventDefault();
                                    raffle_feedback_wrapper.style.display = 'block';
                                    raffle_feedback_container.style.display = 'block';
                                    return false;
                                }                                   
                            });
                        }

                        if( raffle_btn_feedback_skip !== null ){
                            raffle_btn_feedback_skip.addEventListener( 'click', function( e ){
                                window.location.href = raffle_btn_uninstall_href;
                            });                               
                        }

                        if( raffle_btn_feedback_submit !== null && raffle_btn_uninstall !== null ){
                            raffle_btn_feedback_submit.addEventListener( 'click', function( e ){
                                e.preventDefault();
                                let raffle_option_val, raffle_other_val, raffle_email_val = '';
                                let raffle_option = document.querySelector("input[name='bmpfeedback']:checked");
                                let raffle_other  = document.getElementById('raffle_feedback_textarea');
                                let raffle_email  = document.getElementById('raffle_include_email');

                                if( raffle_option == null || typeof raffle_option === 'undefined'){
                                    document.querySelectorAll('.raffle-radio-input-container').forEach( function( item ){
                                        item.classList.add('raffle-req-sel');
                                    });
                                    return;
                                }
                                                            
                                try{

                                    if( raffle_option )
                                        raffle_option_val = raffle_option.value;
                                    if( raffle_other )
                                        raffle_other_val = raffle_other.value;
                                    if( raffle_email )
                                        raffle_email_val = raffle_email.checked ? 'yes' : 'no';
                          
                                    raffle_option_val  = encodeURI( raffle_option_val );
                                    raffle_other_val   = encodeURI( raffle_other_val );
                                    raffle_email_val   = encodeURI( raffle_email_val );
                                }catch( e ){
                                    console.error('wrong value for uri encoding');
                                }
                                
                                let raffle_append_url = '&feedback=true&option=' + raffle_option_val + '&other=' + raffle_other_val + '&email=' + raffle_email_val;
                                let raffle_new_href = raffle_btn_uninstall_href.concat( raffle_append_url );
                                
                                window.location.href = raffle_new_href;                                  
                            });
                        }

                    }() );
                </script>               
        <?php
 
    }
}