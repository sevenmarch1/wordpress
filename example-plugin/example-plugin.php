<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Example plugin
 * Description:       Example plugin.
 */

require_once __DIR__ . '/vendor/autoload.php';

define('PLUGIN_NAME_VERSION', '1.0.0');
if (!defined('WPACT_POST_TYPE_EXAMPLE_ONE')) {
    define('WPACT_POST_TYPE_EXAMPLE_ONE', 'example_one');
}
if (!defined('WPACT_POST_TYPE_EXAMPLE_TWO')) {
    define('WPACT_POST_TYPE_EXAMPLE_TWO', 'example_two');
}

function run_example()
{
    $plugin = new Example\Main\ExampleMain();
}

run_example();

//use other plugins (ACF admin columns https://wordpress.org/plugins/admin-columns-for-acf-fields/)
require_once plugin_dir_path(__FILE__) . 'admin-columns-for-acf-fields/acf_admin_columns.php';

function run_acf_admin_columns()
{
    if (is_admin()) {
        FleiACFAdminColumns::get_instance();
    }
}

run_acf_admin_columns();