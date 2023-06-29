<?php

/* 
Plugin Name: Roof Quote PRO Widget
Description: A plugin to install the Roof Quote PRO widget.
Version: 1.0
Author: Creative Bull
*/

function roof_quote_pro_widget_settings_page()
{
    add_options_page('Roof Quote Pro Widget', 'Roof Quote Pro Widget', 'manage_options', 'RQO-plugin', 'roof_quote_pro_widget_render_plugin_settings_page');
}

add_action('admin_menu', 'roof_quote_pro_widget_settings_page');

?>
<?php
function roof_quote_pro_widget_render_plugin_settings_page()
{
?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

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
    echo '<textarea id="pages" name="pages">' . esc_textarea(get_option('pages')) . '</textarea>';
}

// function roof_quote_pro_widget_enqueue_script()
// {
//     $widget_id = get_option('widget-id');

//     if (!empty($widget_id)) {
//         wp_enqueue_script('roof-quote-pro-widget', 'https://app.roofle.com/roof-quote-pro-widget.js?id=' . $widget_id, array(), null, false);
//     }
// }

// add_action('wp_enqueue_scripts', 'roof_quote_pro_widget_enqueue_script');

function roof_quote_pro_widget_display_slideout_widget()
{
    $widget_id = get_option('widget-id');
    $sitewide = get_option('sitewide');

    if (!empty($widget_id)) {
        if ($sitewide == 'on') {
            echo '<script src="https://app.roofle.com/roof-quote-pro-widget.js?id=' . $widget_id . '" async></script>';
        } 
        // else {
        //     global $post;
        //     $pages = get_option('pages');
        //     $pages_array = explode("\n", $pages);

        //     if (in_array($post->ID, $pages_array)) {
        //         echo '<script src="https://app.roofle.com/roof-quote-pro-widget.js?id=' . $widget_id . '" async></script>';
        //     }
        // }
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
            $pages = get_option('pages');

            $pages_array = explode("\n", $pages);

            if (in_array(get_the_title($post->ID), $pages_array)) {
                // echo 'Hello';
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
  wp_enqueue_script(
      'my-custom-block',
      plugins_url( 'dist/my-custom-block.js', __FILE__ ),
      array( 'wp-blocks', 'wp-element' ),
      filemtime( plugin_dir_path( __FILE__ ) . 'dist/my-custom-block.js' )
  );
}

add_action( 'enqueue_block_editor_assets', 'my_custom_block_enqueue_assets' );