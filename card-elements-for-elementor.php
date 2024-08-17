<?php
/**
 * Plugin Name: Card Elements for Elementor
 * Description: Showcase useful card elements like display team profiles, testimonials and post with card style for Elementor page builder.
 * Plugin URI: https://profiles.wordpress.org/bhavinp311/
 * Author: Bhavin Patel
 * Version: 1.2.3
 * Author URI: https://profiles.wordpress.org/bhavinp311/
 * Elementor tested up to: 3.22.3
 * Elementor Pro tested up to: 3.22.1
 *
 * Text Domain: card-elements-for-elementor
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Define Plugin URL and Directory Path
 */
define('CARD_ELEMENTS_ELEMENTOR_URL', plugins_url('/', __FILE__));  // Define Plugin URL
define('CARD_ELEMENTS_ELEMENTOR_PATH', plugin_dir_path(__FILE__));  // Define Plugin Directory Path
define('CEE_DOMAIN', 'card-elements-for-elementor');

/*
 * Load the plugin Category
 */
require_once CARD_ELEMENTS_ELEMENTOR_PATH . 'widgets/elementor-helper.php';

/*
 * Register the widgets file in elementor widgets.
 */
if (!function_exists('card_elements_widget_register')) {

    function card_elements_widget_register() {
        require_once CARD_ELEMENTS_ELEMENTOR_PATH . 'widgets/profile-card-widget.php';
        require_once CARD_ELEMENTS_ELEMENTOR_PATH . 'widgets/testimonial-card-widget.php';
        require_once CARD_ELEMENTS_ELEMENTOR_PATH . 'widgets/post-card-widget.php';
        require_once CARD_ELEMENTS_ELEMENTOR_PATH . 'include/post-card/functions-post-card.php';
    }

}
add_action('elementor/widgets/widgets_registered', 'card_elements_widget_register');

/*
 * Load profile card scripts and styles
 * @since v1.0.0
 */
if (!function_exists('card_elements_widget_script_register')) {

    function card_elements_widget_script_register() {
        wp_register_style('cee-common-card-style', CARD_ELEMENTS_ELEMENTOR_URL . 'assets/css/common-card-style.css', array(), '1.0', false);
        wp_enqueue_style('cee-common-card-style');

        wp_register_style('cee-profile-card-style', CARD_ELEMENTS_ELEMENTOR_URL . 'assets/css/profile-card-style.css', array(), '1.0', false);
        wp_enqueue_style('cee-profile-card-style');

        wp_register_style('cee-testimonial-card-style', CARD_ELEMENTS_ELEMENTOR_URL . 'assets/css/testimonial-card-style.css',array(), '1.0', false);
        wp_enqueue_style('cee-testimonial-card-style');

        wp_register_style('cee-post-card-style', CARD_ELEMENTS_ELEMENTOR_URL . 'assets/css/post-card-style.css', array(), '1.0', false);
        wp_enqueue_style('cee-post-card-style');

        // Register and call font awesome style
        wp_register_style('cee-font-awesome', CARD_ELEMENTS_ELEMENTOR_URL . 'assets/css/font-awesome.css', array(), 1.0);
        wp_enqueue_style('cee-font-awesome');

        if (!wp_style_is('font-awesome-5-all-css', 'enqueued')) {
            wp_register_style('font-awesome-5-all-css', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.min.css', array());
            wp_enqueue_style('font-awesome-5-all-css');
        }
        
        if (!wp_style_is('elementor-frontend-css', 'enqueued')) {
            wp_enqueue_style( 'elementor-frontend-css', ELEMENTOR_ASSETS_URL . 'css/frontend.min.css', array() );
            wp_enqueue_style('elementor-frontend-css');
        }
    }

}
add_action('wp_enqueue_scripts', 'card_elements_widget_script_register');

/*
* Load elementor editor script and styles
*/
if (!function_exists('cee_elements_widget_script_backend')) {

    function cee_elements_widget_script_backend() {
        wp_register_style('cee-font-awesome', CARD_ELEMENTS_ELEMENTOR_URL . 'assets/css/font-awesome.css', array(), 1.0);
        wp_enqueue_style('cee-font-awesome');

        if (!wp_style_is('font-awesome-5-all-css', 'enqueued')) {
            wp_register_style('font-awesome-5-all-css', ELEMENTOR_ASSETS_URL . 'lib/font-awesome/css/all.min.css', array());
            wp_enqueue_style('font-awesome-5-all-css');
        }
        
        if (!wp_style_is('elementor-frontend-css', 'enqueued')) {
            wp_enqueue_style( 'elementor-frontend-css', ELEMENTOR_ASSETS_URL . 'css/frontend.min.css', array() );
            wp_enqueue_style('elementor-frontend-css');
        }
    }

}
add_action('elementor/editor/after_enqueue_styles', 'cee_elements_widget_script_backend');

/**
 * Check current version of Elementor
 */
if (!function_exists('card_elements_plugin_load')) {

    function card_elements_plugin_load() {
        // Load plugin textdomain
        load_plugin_textdomain('card-elements-for-elementor', false, dirname(plugin_basename(__FILE__)) . '/languages');

        // Add image size for post card
        add_image_size('post_card_thumb', 680, 460, true);

        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', 'card_elements_widget_fail_load');
            return;
        }
        $elementor_version_required = '1.1.2';
        if (!version_compare(ELEMENTOR_VERSION, $elementor_version_required, '>=')) {
            add_action('admin_notices', 'card_elements_elementor_update_notice');
            return;
        }
    }

}
add_action('plugins_loaded', 'card_elements_plugin_load');

/**
 * This notice will appear if Elementor is not installed or activated or both
 */
if (!function_exists('card_elements_widget_fail_load')) {

    function card_elements_widget_fail_load() {
        $screen = get_current_screen();
        if (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) {
            return;
        }

        $plugin = 'elementor/elementor.php';

        if (card_elements_elementor_installed()) {
            if (!current_user_can('activate_plugins')) {
                return;
            }
            $activation_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin);

            $message = '<p><strong>' . esc_html__('Card Elements for Elementor', 'card-elements-for-elementor') . '</strong>' . esc_html__(' widgets not working because you need to activate the Elementor plugin.', 'card-elements-for-elementor') . '</p>';
            $message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__('Activate Elementor Now', 'card-elements-for-elementor')) . '</p>';
        } else {
            if (!current_user_can('install_plugins')) {
                return;
            }

            $install_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');

            $message = '<p><strong>' . esc_html__('Card Elements', 'card-elements-for-elementor') . '</strong>' . esc_html__('widgets are not working because you need to install the Elementor plugin', 'card-elements-for-elementor') . '</p>';
            $message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__('Install Elementor Now', 'card-elements-for-elementor')) . '</p>';
        }

        echo '<div class="error"><p>' . wp_kses_post($message) . '</p></div>';
    }

}

/**
 * Display admin notice for Elementor update if Elementor version is old
 */
if (!function_exists('card_elements_elementor_update_notice')) {

    function card_elements_elementor_update_notice() {
        if (!current_user_can('update_plugins')) {
            return;
        }

        $file_path = 'elementor/elementor.php';

        $upgrade_link = wp_nonce_url(self_admin_url('update.php?action=upgrade-plugin&plugin=') . $file_path, 'upgrade-plugin_' . $file_path);
        $message = '<p><strong>' . esc_html__('Card Elements', 'card-elements-for-elementor') . '</strong>' . esc_html__('widgets are not working because you are using an old version of Elementor.', 'card-elements-for-elementor') . '</p>';
        $message .= '<p>' . sprintf('<a href="%s" class="button-primary">%s</a>', $upgrade_link, esc_html__('Update Elementor Now', 'card-elements-for-elementor')) . '</p>';
        echo '<div class="error">' . wp_kses_post($message) . '</div>';
    }

}

/**
 * Action when plugin installed
 */
if (!function_exists('card_elements_elementor_installed')) {

    function card_elements_elementor_installed() {

        $file_path = 'elementor/elementor.php';
        $installed_plugins = get_plugins();

        return isset($installed_plugins[$file_path]);
    }

}

/**
 * Add reviews metadata  on plugin activation
 */
if (!function_exists('card_elements_plugin_activation')) {

    function card_elements_plugin_activation() {
        $notices = get_option('card_elements_reviews', array());
        $notices[] = '<p>Hi, you are now using <strong>Card Elements</strong> plugin. I would really appreciate it if you could give me the five star to our plugin. </p><p><a href="https://wordpress.org/support/plugin/card-elements-for-elementor/reviews/?filter=5#new-post" target="_blank" class="rating-link"><strong> Okay, you deserve it </strong></a></p>';
        update_option('card_elements_reviews', $notices);

        // Deactivate card elements for elementor (Pro) plugin than activate card elements free for elementor plugin
        deactivate_plugins('card-elements-pro-for-elementor/card-elements-pro-for-elementor.php');
    }

}
register_activation_hook(__FILE__, 'card_elements_plugin_activation');

/**
 * Display admin notice on Card Elements activation for ratings
 */
if (!function_exists('card_elements_reviews_notices')) {

    function card_elements_reviews_notices() {
        if ($notices = get_option('card_elements_reviews')) {
            foreach ($notices as $notice) {
                echo "<div class='notice notice-success is-dismissible'><p>" . wp_kses_post($notice) . "</p></div>";
            }
            delete_option('card_elements_reviews');
        }
    }

    add_action('admin_notices', 'card_elements_reviews_notices');
}

/**
 * Remove reviews metadata on plugin deactivation.
 */
if (!function_exists('card_elements_plugin_deactivation')) {

    function card_elements_plugin_deactivation() {
        delete_option('card_elements_reviews');
    }

}
register_deactivation_hook(__FILE__, 'card_elements_plugin_deactivation');
