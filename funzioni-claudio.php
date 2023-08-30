<?php
/*
Plugin Name: Funzioni Claudio
Description: Plugin per le funzioni integrabili su wordpress.
Version: 1.0
Author: Claudio D'Onofrio
*/

//creazione tabelle necessarie
//include(plugin_dir_path(__FILE__) . 'model/model.php');

//inclusione funzioni
include(plugin_dir_path(__FILE__) . 'functions/functions.php');

//inclusioni pagina impostazioni
include(plugin_dir_path(__FILE__) . 'view/pagina_impostazioni.php');

//inclusione logica attivatori
include(plugin_dir_path(__FILE__) . 'activators/activators.php');