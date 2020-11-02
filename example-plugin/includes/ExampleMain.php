<?php
namespace Example\Main;

use Example\Post\PostTypes;

class ExampleMain
{
    protected $plugin_name;

    protected $version;

    public function __construct()
    {
        if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
            $this->version = PLUGIN_NAME_VERSION;
        } else {
            $this->version = '1.0.0';
        }

        $this->plugin_name = 'example-plugin';

        add_action( 'init', [$this, 'example_init']);
    }

    public function example_init()
    {
        $post_types = new PostTypes();
        $post_types->register_all();

        add_filter( 'get_user_option_admin_color', [$this, 'update_user_option_admin_color'], 5 );

    }

    public function get_plugin_name() {
        return $this->plugin_name;
    }

    public function get_version() {
        return $this->version;
    }


    function update_user_option_admin_color( $color_scheme ) {
        $color_scheme = 'sunrise';
        return $color_scheme;
    }

}