<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if class is already defined
if ( class_exists( 'BP_Utils_Notify' ) ) {
	return;
}

/**
 * WordPress Easy Notifications
 *
 * @class BP_Utils_Notify
 * @version 1.0.0
 * @package Inc
 * @subpackage Utils
 * @author Abid Omar
 */
class BP_Utils_Notify {

	private $prefix = '';

	private $notices = array();

	private $active = array();

	public function __construct( $prefix = 'std' ) {
		$this->prefix = $prefix;

		$this->load_notices();

		add_action( 'admin_notices', array( &$this, 'display_notices') );
	}

	private function load_notices() {
		$notices = get_option( 'wp_easy_notify_' . $this->prefix, array() );
		$this->notices = $notices;

		$active = get_option( 'wp_easy_notify_active_' . $this->prefix, array() );
		$this->active = $active;
	}

	public function display_notices() {
		foreach( $this->active as $id=>$count ) {
			$this->display_notice( $this->notices[$id] );
			if ( $count === 1 ) {
				unset( $this->active[$id] );
			}
			if ( $count > 1 ) {
				$this->active[$id] = $count - 1;
			}
		}

		$this->save();
	}

	private function display_notice( $notice ) {
		echo '<div class="updated '.$notice['type'].'">
      		'.$notice['content'].' 
    </div>';
	}

	private function save() {
		update_option( 'wp_easy_notify_' . $this->prefix, $this->notices );
		update_option( 'wp_easy_notify_active_' . $this->prefix, $this->active );
	}

	public function add_notification( $id, $content, $type = null, $hide_button = null ) {
		if ( isset( $this->notices[$id] ) ) {
			return false;
		}

		if ( !$type ) {
			$type = 'success';
		}

		if ( !$hide_button ) {
			$hide_button = true;
		}

		$this->notices[$id] = array(
			'id' => $id,
			'content' => $content,
			'type' => $type,
			'hide_button' => $hide_button,
		);

		$this->save();
	}

	public function update_notification( $id, $content = null, $type = null, $hide_button = null ) {
		if ( ! isset( $this->notices[$id] ) ) {
			$this->add_notification( $id, $content, $type, $hide_button );	
		}	

		if ( $content ) {
			$this->notices[$id]['content'] = $content;
		}

		if ( $type ) {
			$this->notices[$id]['type'] = $type;
		}

		if ( $hide_button ) {
			$this->notices[$id]['hide_button'] = $hide_button;
		}

		$this->save();
	}

	public function display_notification( $id, $life_count ) {
		$this->active[$id] = $life_count;	

		$this->save();
	}

	public function hide_notification( $id ) {
		unset( $this->active[$id] );

		$this->save();
	}

	public function delete_notification( $id ) {
		unset( $this->notices[$id] );

		$this->save();
	}

	public function hide_all_notifications() {

	}

	public function delete_all_notifications() {
		$this->notices = array();

		$this->save();
	}
}
