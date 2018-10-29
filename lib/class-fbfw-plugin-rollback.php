<?php

class FBFW_Plugin_RollBack {

    public function __construct() {

        /**
         * $_POST action hook
         *
         * @see: https://codex.wordpress.org/Plugin_API/Action_Reference/admin_post_(action)
         *
         */
        add_action( 'admin_post_fbfw_rollback', array( $this, 'post_fbfw_rollback' ) );

        /**
         * Hook responsible for loading our Rollback JS script
         */
        add_action( 'admin_enqueue_scripts', array( $this, 'rollback_scripts' ) );

    }

    /**
     * FBFW version rollback.
     *
     * Rollback to previous {plugin} version.
     *
     * Fired by `admin_post_epfw_rollback` action.
     *
     * @since  1.5.0
     * @access public
     */
    public function post_fbfw_rollback() {

        check_admin_referer( 'fbfw_rollback' );

        $plugin_slug = basename( FBFW_FILE_, '.php' );

        // check for const defines
        if ( ! defined( 'FBFW_PREVIOUS_PLUGIN_VERSION' ) || ! defined( 'FBFW_PLUGIN_BASE' ) ) {
            wp_die(
                new WP_Error( 'broke', esc_html__( 'Previous plugin version or plugin basename CONST aren\'t defined.', 'epfw' ) )
            );
        }

        if ( class_exists( 'FBFW_Rollback' ) ) {
            $rollback = new FBFW_Rollback(
                [
                    'version'     => FBFW_PREVIOUS_PLUGIN_VERSION,
                    'plugin_name' => FBFW_PLUGIN_BASE,
                    'plugin_slug' => $plugin_slug,
                    'package_url' => sprintf( 'https://downloads.wordpress.org/plugin/%s.%s.zip', PLUGIN_NAME, FBFW_PREVIOUS_PLUGIN_VERSION ),
                ]
            );
            $rollback->run();
        }

        wp_die(
            '', __( 'Rollback to Previous Version', 'mfbfw' ), [
                'response' => 200,
            ]
        );
    }

    public function rollback_scripts() {
        wp_enqueue_script('rollback-script', FBFW_URL . 'assets/js/rollback.js', FBFW_VERSION); // Load Rollback script
        wp_enqueue_script( 'rollback-script' );

    }

}

new FBFW_Plugin_Rollback();
