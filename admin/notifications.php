<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @file
 *
 * Notifications API
 */
if ( ! class_exists( 'wp_admin_notifications' ) ) {
	class wp_admin_notifications {

		/**
		 * Register a new notification
		 *
		 * @param $id
		 * @param $msg
		 * @param $type
		 * @param $pages
		 * @param $include
		 */
		static function register_notification( $id, $msg = '', $type = 'warning', $pages = array(), $include = true ) {
			$notifications = get_option( 'wp_admin_notifications', array() );

			$notification = array(
				'id'      => $id,
				'msg'     => $msg,
				'type'    => $type,
				'pages'   => $pages,
				'include' => $include,
				'active'  => false,
			);

			$notifications[ $id ] = $notification;
			update_option( 'wp_admin_notifications', $notifications );
		}

		/**
		 * Display a notification
		 *
		 * @param $id
		 */
		static function display_notification( $id ) {
			$notifications = get_option( 'wp_admin_notifications', array() );
			$notification  = $notifications[ $id ];
			echo '<div id="notification-' . $notification['id'] . '" class="wp-admin-notification ' . $notification['type'] . '">' . $notification['msg'] . '</div>';
		}

		/**
		 * Display all enabled notifications
		 */
		static function display_notifications() {

			$notifications = get_option( 'wp_admin_notifications', array() );

			foreach ( $notifications as $notification ) {
				if ( $notification['active'] ) {
					self::display_notification( $notification['id'] );
				}
			}
		}

		/**
		 * Enable a notification
		 *
		 * @param $id
		 */
		static function enable_notification( $id ) {
			$notifications = get_option( 'wp_admin_notifications', array() );
			$notification  = $notifications[ $id ];

			// Activate the notification
			$notification['active'] = true;

			$notifications[ $id ] = $notification;
			update_option( 'wp_admin_notifications', $notifications );
		}

		/**
		 * Disable a notification
		 *
		 * @param $id
		 */
		static function disable_notification( $id ) {
			$notifications = get_option( 'wp_admin_notifications', array() );
			$notification  = $notifications[ $id ];

			// Activate the notification
			$notification['active'] = false;

			$notifications[ $id ] = $notification;
			update_option( 'wp_admin_notifications', $notifications );
		}

		/**
		 * Remove a notification
		 *
		 * @param $id
		 */
		static function remove_notification( $id ) {
			$notifications = get_option( 'wp_admin_notifications', array() );
			unset( $notifications[ $id ] );
			update_option( 'wp_admin_notifications', $notifications );
		}

		/**
		 * Load the notification API
		 */
		static function load() {
			add_action( 'admin_notices', 'wp_admin_notifications::display_notifications' );
		}
	}
}
