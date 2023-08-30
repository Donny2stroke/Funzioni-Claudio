<?php

// Aggiungi il menu di opzioni al backend
function pagina_impostazioni_funzioni() {
    add_menu_page(
        'Funzioni Claudio',
        'Funzioni integrabili',
        'manage_options',
        'funzioni-claudio-settings',
        'funzioni_claudio_settings_page'
    );
}

// Pagina di opzioni nel backend
function funzioni_claudio_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    if (isset($_POST['update_settings'])) {
        $hide_header = isset($_POST['hide_header']) ? true : false;
        $hide_footer = isset($_POST['hide_footer']) ? true : false;

        $salva_mail_asporto = isset($_POST['salva_mail_asporto']) ? true : false;
        
        update_option('custom_layout_hide_header', $hide_header);
        update_option('custom_layout_hide_footer', $hide_footer);

        update_option('funzioni_claudio_salva_mail_asporto', $salva_mail_asporto);
    }
    
    $hide_header = get_option('custom_layout_hide_header', false);
    $hide_footer = get_option('custom_layout_hide_footer', false);

    $salva_mail_asporto = get_option('funzioni_claudio_salva_mail_asporto', false);

   
    
    ?>
    <div class="wrap">
        <h1>Pagina integrazioni wordpress</h1>
        <form method="post" action="">
            <label>
                <input type="checkbox" name="hide_header" <?php checked($hide_header, true); ?>>
                Hide Header
            </label>
            <br>
            <label>
                <input type="checkbox" name="hide_footer" <?php checked($hide_footer, true); ?>>
                Hide Footer
            </label>
            <br>
            <br>
            <label>
                <input type="checkbox" name="salva_mail_asporto" <?php checked($salva_mail_asporto, true); ?>>
                Salva email asporto
            </label>
            <br>
            <input type="submit" name="update_settings" class="button button-primary" value="Save Settings">
        </form>
    </div>
    <?php
}

// Aggiungi azioni e filtri
add_action('admin_menu', 'pagina_impostazioni_funzioni');
add_action('wp', 'impostazioni_funzioni_modify_funzioni');
add_action('admin_init', 'impostazioni_funzioni_backend_modify_funzioni');




