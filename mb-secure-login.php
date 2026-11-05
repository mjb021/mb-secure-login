<?php
/**
 * Plugin Name: BLOM Website Login Lock
 * Description: Voegt een subtiel, zwevend inlogslotje toe (rechtsboven op desktop, rechtsonder op mobiel) met dynamische URL-bepaling.
 * Version: 1.0.0
 * Author: BLOM
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Beveiliging: voorkom directe toegang
}

/**
 * 1. Laad het externe CSS-bestand netjes in via de officiële WordPress enqueue-wachtrij
 */
function bll_enqueue_styles() {
    wp_enqueue_style(
        'blom-login-lock-style', 
        plugins_url( 'css/style.css', __FILE__ ), 
        array(), 
        '1.2.0'
    );
}
add_action( 'wp_enqueue_scripts', 'bll_enqueue_styles' );

/**
 * 2. Injecteer de HTML van het slotje met de dynamische WordPress login URL
 */
function bll_inject_lock_html() {
    // Haal de inlog-URL dynamisch op via de WordPress core settings
    $login_url = site_url( 'wp-login.php', 'login' );
    
    echo '<div class="extern-login-slot">';
    echo '  <a href="' . esc_url( $login_url ) . '">&#128274;</a>';
    echo '</div>';
}
add_action( 'wp_footer', 'bll_inject_lock_html' );
