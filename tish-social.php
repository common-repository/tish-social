<?php
/*
Plugin Name: Tish Social
Plugin URI: https://tishonator.com/plugins/tish-social
Description: Display latest Instagram images from ANY public Instagram account (without Access Token) by inserting a shortcode [instagram username="instagram_username"].
Author: tishonator
Version: 1.0.0
Author URI: http://tishonator.com/
Contributors: tishonator
Text Domain: tish-social
*/

if ( ! function_exists( 'tish_social_display_shortcode' ) ) :

    function tish_social_display_shortcode($atts) {

        $username = array_key_exists('username', $atts) ? $atts['username'] : null;
        if ( ! $username ) {
            return __('Please insert Instagram username', 'tish-social');
        }

        wp_register_style('tish-social-css', plugins_url('css/tish-social.css', __FILE__),
            true );

        wp_enqueue_style('tish-social-css', plugins_url('css/tish-social.css', __FILE__),
            array() );

        wp_register_script('tish-social-js', plugins_url('js/tish-social.js', __FILE__),
            array('jquery'));

        wp_enqueue_script('tish-social-js',
            plugins_url('js/tish-social.js', __FILE__),
            array('jquery') );

        return '<div class="tish-social" id="tish-social-' . esc_attr($username) . '" data-username="' . esc_attr($username) . '"></div>';
    }

endif; // tish_social_display_shortcode

if ( ! function_exists( 'tish_social_register_shortcode' ) ) :

    function tish_social_register_shortcode() {

        add_shortcode( 'instagram', 'tish_social_display_shortcode' );
    }

endif; // tish_social_register_shortcode

if ( ! function_exists( 'tish_social_init' ) ) :

    function tish_social_init() {

        add_action( 'init', 'tish_social_register_shortcode' );
    }

endif; // tish_social_init

add_action('plugins_loaded', 'tish_social_init', 10);
