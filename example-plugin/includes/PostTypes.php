<?php
namespace Example\Post;

class PostTypes
{
    public function register_all()
    {
        $this->example_one_type();
        $this->example_two_type();
    }

    private function example_one_type()
    {
        $this->register(
            WPACT_POST_TYPE_EXAMPLE_ONE,
            'Example One',
            'Example One',
            30,
            'dashicons-admin-multisite');

        add_action('post_submitbox_misc_actions', [$this, 'add_button'], 10, 1);
    }

    private function example_two_type()
    {
        $this->register(
            WPACT_POST_TYPE_EXAMPLE_TWO,
            'Example Two',
            'Example Two',
            31,
            'dashicons-store');
    }


    private function register($post_type, $name, $plural, $position, $icon, $labels = [], $args = [], $supports = [])
    {
        $labels = array_merge([
            'name' => _x($plural, 'post type general name'),
            'singular_name' => _x($name, 'post type singular name'),
            'add_new' => __('Add ' . $name),
            'add_new_item' => __('Add ' . $name),
            'edit_item' => __('Edit ' . $name),
            'new_item' => __('New ' . $name),
            'all_items' => __('All ' . $plural),
            'view_item' => __('View ' . $name),
            'search_items' => __('Search', $plural),
            'not_found' => __('No ' . strtolower($plural) . ' found'),
            'not_found_in_trash' => __('No ' . strtolower($plural) . ' found in Trash'),
            'parent_item_colon' => '',
            'menu_name' => $plural,
        ], $labels);

        $args = array_merge([
            'labels' => $labels,
            'public' => false,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capabilities_type' => 'post',
            'map_meta_cap' => true,
            'has_archive' => false,
            'hierarchical' => false,
            'menu_position' => $position,
            'menu_icon' => $icon,
            'supports' => $supports = array_merge(['title', 'revisions'], $supports),
            'rewrite' => false,
        ], $args);

        return register_post_type($post_type, $args);
    }

    public function add_button($post)
    {
        if (!$post
            || 'publish' !== $post->post_status
            || WPACT_POST_TYPE_EXAMPLE_ONE !== $post->post_type) {
            return;
        }
        global $wp;
        $url = $wp->request;
        $html = '<div id="major-publishing-actions" style="overflow:hidden">';
        $html .= '<div id="publishing-action">';
        $html .= '<a href = "' . $url . '">';
        $html .= '<input type="button" accesskey="p" tabindex="5" value="' . __('Refresh') . '" class="button-primary" 
                id="submitbox-custom-button" name="refresh">';
        $html .= '</a>';
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }
}