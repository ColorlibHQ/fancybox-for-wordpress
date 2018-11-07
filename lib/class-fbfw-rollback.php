<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * EPFW rollback class.
 *
 * EPFW rollback handler class is responsible for rolling back EPFW to
 * previous version.
 *
 * @since 1.0.0
 */
class FBFW_Rollback {

    /**
     * Package URL.
     *
     * Holds the package URL.
     *
     * @since 1.0.0
     * @access protected
     *
     * @var string Package URL.
     */
    protected $package_url;

    /**
     * Version.
     *
     * Holds the version.
     *
     * @since 1.0.0
     * @access protected
     *
     * @var string Package URL.
     */
    protected $version;

    /**
     * Plugin name.
     *
     * Holds the plugin name.
     *
     * @since 1.0.0
     * @access protected
     *
     * @var string Plugin name.
     */
    protected $plugin_name;

    /**
     * Plugin slug.
     *
     * Holds the plugin slug.
     *
     * @since 1.0.0
     * @access protected
     *
     * @var string Plugin slug.
     */
    protected $plugin_slug;

    /**
     * Rollback constructor.
     *
     * Initializing EPFW rollback.
     *
     * @since 1.0.0
     * @access public
     *
     * @param array $args Optional. Rollback arguments. Default is an empty array.
     */
    public function __construct( $args = array() ) {
        foreach ( $args as $key => $value ) {
            $this->{$key} = $value;
        }
    }

    /**
     * Print inline style.
     *
     * Add an inline CSS to the rollback page.
     *
     * @since 1.0.0
     * @access private
     */
    private function print_inline_style() {
        ?>
        <style>
            .wrap {
                overflow: hidden;
            }

            h1 {
                background: #9b0a46;
                text-align: center;
                color: #fff !important;
                padding: 70px !important;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            h1 img {
                max-width: 300px;
                display: block;
                margin: auto auto 50px;
            }
        </style>
        <?php
    }

    /**
     * Apply package.
     *
     * Change the plugin data when WordPress checks for updates. This method
     * modifies package data to update the plugin from a specific URL containing
     * the version package.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function apply_package() {
        $update_plugins = get_site_transient( 'update_plugins' );
        if ( ! is_object( $update_plugins ) ) {
            $update_plugins = new \stdClass();
        }

        $plugin_info              = new \stdClass();
        $plugin_info->new_version = $this->version;
        $plugin_info->slug        = $this->plugin_slug;
        $plugin_info->package     = $this->package_url;

        $update_plugins->response[ $this->plugin_name ] = $plugin_info;

        set_site_transient( 'update_plugins', $update_plugins );
    }

    /**
     * Upgrade.
     *
     * Run WordPress upgrade to rollback EPFW to previous version.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function upgrade() {
        require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );

        $logo_url = FBFW_URL . 'assets/images/icon.jpg';

        $upgrader_args = array(
            'url'    => 'update.php?action=upgrade-plugin&plugin=' . rawurlencode( $this->plugin_name ),
            'plugin' => $this->plugin_name,
            'nonce'  => 'upgrade-plugin_' . $this->plugin_name,
            'title'  => '<img src="' . $logo_url . '" alt="FBFW logo">' . __( 'Rollback to Previous Version', 'epfw' ),
        );

        $this->print_inline_style();

        $upgrader = new \Plugin_Upgrader( new \Plugin_Upgrader_Skin( $upgrader_args ) );
        $upgrader->upgrade( $this->plugin_name );
    }

    /**
     * Run.
     *
     * Rollback EPFW to previous versions.
     *
     * @since 1.0.0
     * @access public
     */
    public function run() {
        $this->apply_package();
        $this->upgrade();
    }
}
