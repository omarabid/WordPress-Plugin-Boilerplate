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
    /**
     * Prefix (namespace) of the notices.
     *
     * @var string
     */
    private $prefix = '';

    /**
     * An array of all notices.
     *
     * @var array
     */
    private $notices = array();

    /**
     * An array of active notices.
     *
     * @var array
     */
    private $active = array();

    /**
     * Creates a new instance of the Notifications class.
     *
     * You should specify the namespace (prefix) of your notices. All your notices will be saved
     * and loaded with that prefix.
     *
     * @param string $prefix
     * @return void
     */
    public function __construct( $prefix = 'std' ) {
        // Set the prefix of the notices
        $this->prefix = $prefix;

        // Load the notices into the Class
        $this->load_notices();

        // Display the notices
        add_action( 'admin_notices', array( &$this, 'display_notices') );

        // Load Notifications Resources
        add_action( 'admin_enqueue_scripts', array( &$this, 'notices_resources' ) );
    }

    public function notices_resources() {
        wp_enqueue_script( 'notify-script', plugin_dir_url( __FILE__ ) . 'assets/js/notify.js' );
        wp_register_style( 'notify-style', plugin_dir_url( __FILE__ ) . 'assets/css/notify.css' );        
    }

    /**
     * Callback to handle dismiss button AJAX request
     *
     * @return void
     */
    public function callback_dismiss_notification() {
        if ( isset( $_POST['namespace'] ) || isset( $_POST['id'] ) ) {
            $namespace = $_POST['namespace'];
            $id = $_POST['id'];

            $notify = new BP_Utils_Notify( $namespace );
            $notify->hide_notification( $id );
        }
        exit;
    }

    /**
     * Load all notices into the class.
     *
     * @return void
     */
    private function load_notices() {
        $notices = get_option( 'wp_easy_notify_' . $this->prefix, array() );
        $this->notices = $notices;

        $active = get_option( 'wp_easy_notify_active_' . $this->prefix, array() );
        $this->active = $active;
    }

    /**
     * Display the notices.
     *
     * @return void
     */
    public function display_notices() {
        // Go through all notices
        foreach( $this->active as $id=>$count ) {

            // If there is a call-able function, execute it
            if ( is_callable( $this->notices[$id]['cond_func'] ) ) {
                $cond = call_user_func( $this->notices[$id]['cond_func'] );
            } else {
                $cond = true;
            }

            // Print the notification
            if ( $cond ) {
                $this->print_notification( $this->notices[$id] );
            }

            // If only 1 count is available, unset the notice
            if ( $count === 1 ) {
                unset( $this->active[$id] );
            }

            // Decrease the notice counts
            if ( $count > 1 ) {
                $this->active[$id] = $count - 1;
            }
        }

        $this->save();
    }

    /**
     * Print a notification to the current Page.
     *
     * @param array $notice
     * @return void
     */
    private function print_notification( $notice ) {
        add_action( 'admin_enqueue_scripts', array( &$this, 'aa' ) );
        do_action( 'easy_notifications_before_notice', $notice ); 

        echo '<div class="updated '.$notice['type'].'">
            ' . $notice['content'] . ' 
            </div>';

        do_action( 'easy_notifications_after_notice', $notice );
    } 

    /**
     * Save the class data to Database.
     *
     * @return void
     */
    private function save() {
        update_option( 'wp_easy_notify_' . $this->prefix, $this->notices );
        update_option( 'wp_easy_notify_active_' . $this->prefix, $this->active );
    }

    /**
     * Add a notification to the notices namespace.
     *
     * @param string $id
     * @param string $content
     * @param string $type
     * @param bool $hide_button
     *
     * @return void|bool
     */
    public function add_notification( $id, $content, $type = null, $hide_button = null, $cond_func = null ) {
        if ( isset( $this->notices[$id] ) ) {
            return false;
        }

        if ( !$type ) {
            $type = 'success';
        }

        if ( !$hide_button ) {
            $hide_button = true;
        }

        if ( !$cond_func ) {
            $cond_func = false;
        }

        $this->notices[$id] = array(
            'id' => $id,
            'content' => $content,
            'type' => $type,
            'hide_button' => $hide_button,
            'cond_func' => $cond_func,
        );

        $this->save();
    }

    /**
     * Update a notification configuration.
     *
     * @param string $id
     * @param string $content
     * @param string $type
     * @param bool $hide_button
     *
     * @return void
     */
    public function update_notification( $id, $content = null, $type = null, $hide_button = null, $cond_func = null ) {
        if ( ! isset( $this->notices[$id] ) ) {
            $this->add_notification( $id, $content, $type, $hide_button, $cond_func );	
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

        if ( $cond_func ) {
            $this->notices[$id]['cond_func'] = $cond_func;
        }

        $this->save();
    }

    /**
     * Set notification display to true.
     *
     * @param string $id
     * @param int $life_count
     *
     * @return void
     */
    public function display_notification( $id, $life_count ) {
        $this->active[$id] = $life_count;	

        $this->save();
    }

    /**
     * Set notification display to false.
     *
     * @param string $id
     *
     * @return void
     */
    public function hide_notification( $id ) {
        unset( $this->active[$id] );

        $this->save();
    }

    /**
     * Remove a notification from the namespace/database.
     *
     * @param string $id
     *
     * @return void
     */
    public function delete_notification( $id ) {
        unset( $this->notices[$id] );

        $this->save();
    }

    /**
     * Set all notifications display to false.
     *
     * @return void
     */
    public function hide_all_notifications() {
        $this->active = array();

        $this->save();
    }

    /**
     * Remove all the notifications from the namespace/database.
     *
     * @return void
     */
    public function delete_all_notifications() {
        $this->notices = array();

        $this->save();
    }
}
