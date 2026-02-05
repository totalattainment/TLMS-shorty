<?php
/**
 * Plugin Name: Tutor LMS Divi Shortcodes
 * Description: Provides a full Tutor LMS shortcode set with matching Divi modules.
 * Version: 1.0.0
 * Author: OpenAI Codex
 * License: GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit;
}

define('TDS_VERSION', '1.0.0');

define('TDS_PLUGIN_FILE', __FILE__);

define('TDS_PLUGIN_PATH', plugin_dir_path(__FILE__));

define('TDS_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once TDS_PLUGIN_PATH . 'includes/class-tds-shortcodes.php';
require_once TDS_PLUGIN_PATH . 'includes/class-tds-divi-modules.php';

function tds_bootstrap() {
    $shortcodes = new TDS_Shortcodes();
    $shortcodes->register_shortcodes();

    $modules = new TDS_Divi_Modules($shortcodes);
    $modules->register_hooks();
}

add_action('plugins_loaded', 'tds_bootstrap');
