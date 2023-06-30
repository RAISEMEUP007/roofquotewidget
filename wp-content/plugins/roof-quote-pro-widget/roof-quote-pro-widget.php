<?php

/* 
Plugin Name: Roof Quote PRO Widget
Description: A plugin to install the Roof Quote PRO widget.
Version: 1.0
Author: Creative Bull
*/

function roof_quote_pro_widget_settings_page()
{
    add_options_page('Roof Quote Pro', 'Roof Quote Pro', 'manage_options', 'RQO-plugin', 'roof_quote_pro_widget_render_plugin_settings_page');
}

add_action('admin_menu', 'roof_quote_pro_widget_settings_page');

?>
<?php
function roof_quote_pro_widget_render_plugin_settings_page()
{
?>
    <div class="wrap">
        <img src="<?php echo plugins_url( 'src/logo.png', __FILE__ ); ?>" alt="Roof Logo" width="300px">

        <form method="post" action="options.php">
            <?php settings_fields('roof-quote-pro-widget-settings'); ?>
            <?php do_settings_sections('roof-quote-pro-widget-settings'); ?>

            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

function roof_quote_pro_widget_settings_init()
{
    register_setting('roof-quote-pro-widget-settings', 'widget-id');
    register_setting('roof-quote-pro-widget-settings', 'sitewide');
    register_setting('roof-quote-pro-widget-settings', 'pages');
    add_settings_section('roof-quote-pro-widget-settings-section', '', '', 'roof-quote-pro-widget-settings');
    add_settings_field('widget-id', __('Widget ID:', 'roof-quote-pro-widget'), 'roof_quote_pro_widget_settings_widget_id_callback', 'roof-quote-pro-widget-settings', 'roof-quote-pro-widget-settings-section');
    add_settings_field('sitewide', __('Show slideout widget sitewide:', 'roof-quote-pro-widget'), 'roof_quote_pro_widget_settings_sitewide_callback', 'roof-quote-pro-widget-settings', 'roof-quote-pro-widget-settings-section');
    add_settings_field('pages', __('Show slideout widget on specific pages:', 'roof-quote-pro-widget'), 'roof_quote_pro_widget_settings_pages_callback', 'roof-quote-pro-widget-settings', 'roof-quote-pro-widget-settings-section');
}

add_action('admin_init', 'roof_quote_pro_widget_settings_init');

function roof_quote_pro_widget_settings_widget_id_callback()
{
    echo '<input type="text" id="widget-id" name="widget-id" value="' . esc_attr(get_option('widget-id')) . '">';
}

function roof_quote_pro_widget_settings_sitewide_callback()
{
    echo '<input type="checkbox" id="sitewide" name="sitewide" ' . checked(get_option(' sitewide'), 'on', false) . '>';
}

function roof_quote_pro_widget_settings_pages_callback()
{
    $pages = get_pages();
    $selected_pages = get_option('pages', array()); // Get the selected pages as an array

    echo '<select id="pages" name="pages[]" multiple>'; // Change to <> and add "multiple" attribute

    if(gettype($selected_pages) == 'string' ){
        foreach ($pages as $page) {
            echo '<option value="' . esc_attr($page->post_title) . '" '  . '>' . esc_html($page->post_title) . '</option>';
        }   
    }
    else {
        foreach ($pages as $page) {
            $selected = selected(true, in_array($page->post_title, $selected_pages)); // Check if page is selected
            echo '<option value="' . esc_attr($page->post_title) . '" ' . $selected . '>' . esc_html($page->post_title) . '</option>';
        }    
    }

    echo '</select>';

    // foreach ($pages as $page) {
    //     $selected = selected(true, in_array($page->post_title, $selected_pages)); // Check if page is selected
    //     echo  '>';
    // }

    // Enqueue the Select2 script and style from the CDN
    wp_enqueue_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), '4.1.0-rc.0', true);
    wp_enqueue_style('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), '4.1.0-rc.0');

    // Add JavaScript code to initialize Select2 on this select field
    echo '<style>#pages {
        width: 300px; /* Change the width of the select */
    }</style><script>
        jQuery(document).ready(function($) { 
            $("#pages").select2(); 
        });
    </script>';
}


function roof_quote_pro_widget_display_slideout_widget()
{
    $widget_id = get_option('widget-id');
    $sitewide = get_option('sitewide');

    if (!empty($widget_id)) {
        if ($sitewide == 'on') {
            echo '<script src="https://app.roofle.com/roof-quote-pro-widget.js?id=' . $widget_id . '" async></script>';
        } 
    }
}

add_action('wp_head', 'roof_quote_pro_widget_display_slideout_widget');

function roof_quote_pro_widget_display_slideout_special_widget()
{
  // echo 'Hello';

    $widget_id = get_option('widget-id');
    $sitewide = get_option('sitewide');

    if (!empty($widget_id)) {
        if ($sitewide != 'on') {
            global $post;
            $pages = get_option('pages', array());

            if (in_array(get_the_title($post->ID), $pages)) {
                echo '<script src="https://app.roofle.com/roof-quote-pro-widget.js?id=' . $widget_id . '" async></script>';
            }
        } 
    }
}

add_action('wp_footer', 'roof_quote_pro_widget_display_slideout_special_widget');

function roof_quote_pro_widget_shortcode($atts)
{
    $widget_id = get_option('widget-id');

    if (!empty($widget_id)) {
        return '<script src="https://app.roofle.com/roof-quote-pro-embedded-widget.js?id=' . $widget_id . '" async></script>';
    }
}

add_shortcode('roof-quote-pro-widget', 'roof_quote_pro_widget_shortcode');

function my_custom_block_enqueue_assets() {

    $widget_id = get_option('widget-id');

    wp_enqueue_script(
        'my-custom-block',
        plugins_url( 'dist/my-custom-block.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element' ),
        filemtime( plugin_dir_path( __FILE__ ) . 'dist/my-custom-block.js' )
    );

    wp_localize_script( 'my-custom-block', 'widgetId', $widget_id );
}

add_action( 'enqueue_block_editor_assets', 'my_custom_block_enqueue_assets' );