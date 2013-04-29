<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * @file
 *
 * The Admin Panel and related tasks are handled in this file.
 */
if (!class_exists('wp_pb_admin')) {
    class wp_pb_admin
    {
        /**
         * Creates the admin panel
         */
        public function __construct()
        {
            //
            // 1. Admin Menu
            //
            add_action('admin_menu', array(&$this, 'admin_menu'));

            //
            // 2. Load Scripts and Styles
            //
            if (isset($_GET['page']) && ($_GET['page'] === 'page-id-1' || $_GET['page'] === 'page-id-2')) {
                add_action('admin_print_scripts', array(&$this, 'load_scripts'));
                add_action('admin_print_styles', array(&$this, 'load_styles'));
            }

            //
            // 3. Generate Settings and template forms
            //
            add_action('admin_init', array(&$this, 'settings_form'));

            //
            // 4. Execute any action
            //
            $this->action_hook();

            //
            // 5. Contextual help
            //
            add_filter('contextual_help', array(&$this, 'showhelp'));
        }

        /**
         * This function inserts the plug-in menu to the WordPress menu
         */
        public function admin_menu()
        {
            global $page1;
            global $page2;
            // Create a top menu page
            add_menu_page('WordPress Plugin BoilerPlate', 'Plugin', 'manage_options', 'page-id-1', array(&$this, 'menu_hook'));

            // Create Submenus
            $page1 = add_submenu_page('page-id-1', 'WordPress Plugin BoilerPlate', 'Page 1', 'manage_options', 'page-id-1', array(&$this, 'menu_hook'));
            $page2 = add_submenu_page('page-id-1', 'WordPress Plugin BoilerPlate', 'Page 2', 'manage_options', 'page-id-2', array(&$this, 'menu_hook'));
        }

        /**
         * This function routes the different admin pages
         */
        public function menu_hook()
        {
            switch ($_GET['page']) {
                default:
                case 'page-id-1':
                    echo 'Page 1';
                    break;
                case 'page-id-2':
                    echo 'Page 2';
                    break;
            }
        }

        /**
         * This function load the scripts used by the Admin Panel
         */
        public function load_scripts()
        {

        }

        /**
         * This function load the styles used by the Admin Panel
         */
        public function load_styles()
        {

        }

        /**
         * This function declares the different forms, sections and fields.
         */
        public function settings_form()
        {

        }

        /**
         * This functions validate the submitted user input.
         * @param array $var
         * @return array
         */
        public function validate($var)
        {
            return $var;
        }

        /**
         * Use this function to execute actions
         */
        public function action_hook()
        {
            if (!isset($_GET['action'])) {
                return;
            }
            switch ($_GET['action']) {

            }
        }


        /**
         * This function displays the top bar scrollable help for each page
         */
        public function showhelp()
        {
            global $page1;
            global $page2;
            $screen = get_current_screen();
            switch ($screen->id) {
                case $page1:
                    $screen->add_help_tab(array(
                        'id' => 'my_help_tab',
                        'title' => 'Help',
                        'content' => "Page 1 Help"));
                    break;
                case $page2:
                    $screen->add_help_tab(array(
                        'id' => 'my_help_tab',
                        'title' => 'Help',
                        'content' => "Page 2 Help"));
                   break;
            }
        }
    }
}

$pb_admin = new wp_pb_admin();