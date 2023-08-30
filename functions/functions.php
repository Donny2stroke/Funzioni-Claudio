<?php 
// Funzione per nascondere l'header
function hide_header() {
    echo '<style type="text/css">.whb-header { display: none; }</style>';
}

// Funzione per nascondere il footer
function hide_footer() {
    echo '<style type="text/css">footer { display: none; }</style>';
}


// Aggiungi l'hook per salvare l'email nel database
function save_email_to_asporto_db( $cf7 ) {
    if ( $cf7->id() == '12' ) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'asporto';
        $email = sanitize_email( $_POST['your-email'] );

        $wpdb->insert(
            $table_name,
            array(
                'email' => $email,
            )
        );
    }
}

function add_asporto_menu_item() {


      // Crea il contenuto da scrivere nel file
      $file_content = "Ciaooo3";

      // Specifica il percorso del file nella stessa cartella del plugin
      $file_path = plugin_dir_path( __DIR__ ) . 'debug_log.txt';
  
      // Scrivi il contenuto nel file
      file_put_contents( $file_path, $file_content, FILE_APPEND );


    add_menu_page(
        'Asporto email',
        'Asporto',
        'manage_options',
        'asporto-emails',
        'display_asporto_emails'
    );
}

// Funzione per visualizzare le email nella pagina del menu "Asporto"
function display_asporto_emails() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'asporto';
    $emails = $wpdb->get_results( "SELECT email FROM $table_name" );

    echo '<div class="wrap">';
    echo '<h1>Asporto Emails</h1>';

    // Aggiungi il link per scaricare il CSV
    echo '<a href="' . admin_url( 'admin-ajax.php' ) . '?action=download_emails_csv" class="button">Scarica CSV</a>';
    
    if ( ! empty( $emails ) ) {
        echo '<ul>';
        foreach ( $emails as $email ) {
            echo '<li>' . esc_html( $email->email ) . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No emails found.</p>';
    }

    echo '</div>';
}

function download_emails_csv() {
    header( 'Content-Type: text/csv' );
    header( 'Content-Disposition: attachment; filename="asporto_emails.csv"' );

    global $wpdb;
    $table_name = $wpdb->prefix . 'asporto';
    $emails = $wpdb->get_results( "SELECT email FROM $table_name" );

    $output = fopen( 'php://output', 'w' );
    fputcsv( $output, array( 'Email' ) );

    foreach ( $emails as $email ) {
        fputcsv( $output, array( $email->email ) );
    }

    fclose( $output );
    die();
}