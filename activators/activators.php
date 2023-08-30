<?php 
// Funzione per modificare il layout in base alle opzioni
function impostazioni_funzioni_modify_funzioni() {
    $hide_header = get_option('custom_layout_hide_header', false);
    $hide_footer = get_option('custom_layout_hide_footer', false);
    $salva_mail_asporto = get_option('funzioni_claudio_salva_mail_asporto', false);
    
    if ($hide_header) {
        add_action('wp_head', 'hide_header', 1);
    }
    
    if ($hide_footer) {
        add_action('wp_footer', 'hide_footer', 1);
    }

    if ($salva_mail_asporto) {
        add_action( 'wpcf7_mail_sent', 'save_email_to_asporto_db' );
    }

}

// Funzione per modificare il layout in base alle opzioni
function impostazioni_funzioni_backend_modify_funzioni() {

    $salva_mail_asporto = get_option('funzioni_claudio_salva_mail_asporto', false);
    
    if ($salva_mail_asporto) {
        add_action( 'admin_menu', 'add_asporto_menu_item' );
        add_action( 'wp_ajax_download_emails_csv', 'download_emails_csv' );
        add_action( 'wp_ajax_nopriv_download_emails_csv', 'download_emails_csv' );
    }
}
