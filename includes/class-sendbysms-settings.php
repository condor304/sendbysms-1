<?php

class SendBySMS_Settings {
	public static function init() {
		add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
		add_action( 'woocommerce_settings_tabs_sendbysms_tab', __CLASS__ . '::settings_tab' );
		add_action( 'woocommerce_update_options_sendbysms_tab', __CLASS__ . '::update_settings' );
	}

	/**
	 * Add a new settings tab to the WooCommerce settings tabs array.
	 *
	 * @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Subscription tab.
	 *
	 * @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Subscription tab.
	 */
	public static function add_settings_tab( $settings_tabs ) {
		$settings_tabs['sendbysms_tab'] = 'SendBySMS';

		return $settings_tabs;
	}


	/**
	 * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
	 *
	 * @uses woocommerce_admin_fields()
	 * @uses self::get_settings()
	 */
	public static function settings_tab() {
		woocommerce_admin_fields( self::get_settings() );
	}


	/**
	 * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
	 *
	 * @uses woocommerce_update_options()
	 * @uses self::get_settings()
	 */
	public static function update_settings() {
		woocommerce_update_options( self::get_settings() );
	}


	/**
	 * Get all the settings for this plugin for @return array Array of settings for @see woocommerce_admin_fields() function.
	 * @see woocommerce_admin_fields() function.
	 *
	 */
	public static function get_settings() {

		$settings = array(
			'section_title'            => array(
				'name' => __( 'Authentication', 'sendbysms' ),
				'type' => 'title',
				'desc' => '',
				'id'   => 'wc_settings_tab_sendbysms_authentication_title'
			),
			'apitoken'                 => array(
				'name' => __( 'API Token', 'sendbysms' ),
				'type' => 'password',
				'desc' => sprintf( __( 'You can find the token in %1$syour SendBySMS account%2$s.', 'sendbysms' ), '<a href="https://dashboard.sendbysms.app/developers" target="_blank">', '</a>' ),
				'id'   => 'wc_settings_tab_sendbysms_token'
			),
			'message_payment_complete' => array(
				'name' => __( 'Payment complete message', 'sendbysms' ),
				'type' => 'textarea',
				'desc' => __( 'The message to be sent to the customer when the payment is completed', 'sendbysms' ),
				'id'   => 'sendbysms_message_payment_complete',
			),
			'section_end'              => array(
				'type' => 'sectionend',
				'id'   => 'wc_settings_tab_sendbysms_section_end'
			)
		);

		return apply_filters( 'wc_sendbysms_settings', $settings );
	}
}

SendBySMS_Settings::init();
