<?php

namespace Codelight\GDPR\Admin;

/**
 * Handles general admin functionality
 *
 * Class WordpressAdmin
 *
 * @package Codelight\GDPR\Admin
 */
class WordpressAdmin
{
    public function __construct(WordpressAdminPage $adminPage)
    {
        $this->adminPage = $adminPage;

        // Register the AdminTabGeneral class in our container
        gdpr()->bind(AdminTabGeneral::class);

        // Allow turning off helpers
        if (apply_filters('gdpr/admin/helpers/enabled', true)) {
            gdpr()->make(AdminHelper::class);
        }

        $this->setup();

    }

    /**
     * Set up hooks
     */
    protected function setup()
    {
        // Register the main GDPR options page
        add_action('admin_menu', [$this, 'registerGDPROptionsPage']);

        // Register General admin tab
        add_filter('gdpr/admin/tabs', [$this, 'registerAdminTabGeneral'], 0);

        // Enqueue assets
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);

        // Register post states
        add_filter('display_post_states', [$this, 'registerPostStates'], 10, 2);

        // Show help notice
        add_action('current_screen', [$this, 'maybeShowHelpNotice'], 999);

        //
        add_action( 'delete_user', [$this, 'gdprf_delete_userlogs']);
    }


    public function maybeShowHelpNotice()
    {
        if ('tools_page_privacy' === get_current_screen()->base) {
            //gdpr('admin-notice')->add('admin/notices/help');
        }
    }

    /**
     * Register the GDPR options page in WP admin
     */
    public function registerGDPROptionsPage()
    {
        add_management_page(
            _x('Privacy & GDPR Settings', '(Admin)', 'gdpr-framework'),
            _x('Data443 GDPR', '(Admin)', 'gdpr-framework'),
            'manage_options',
            'privacy',
            [$this->adminPage, 'renderPage']
        );
    }

    /**
     * Register General admin tab
     *
     * @param $tabs
     * @return array
     */
    public function registerAdminTabGeneral($tabs)
    {
        $tabs['general'] = gdpr(AdminTabGeneral::class);

        return $tabs;
    }

    /**
     * Enqueue all admin scripts and styles
     */
    public function enqueue()
    {
        /**
         * General admin styles
         */
        wp_enqueue_style(
            'gdpr-admin',
            gdpr('config')->get('plugin.url') . 'assets/gdpr-admin.css'
        );
        
        
        $screen = get_current_screen();
        if($screen->base=='tools_page_privacy'){
                    
            /**
             * jQuery UI dialog for modals
             */
            wp_enqueue_style('wp-jquery-ui-dialog');
            wp_enqueue_script(
                'gdpr-admin',
                gdpr('config')->get('plugin.url') . 'assets/gdpr-admin.js',
                ['jquery-ui-dialog']
            );

            /**
             * jQuery Repeater
             */
            wp_enqueue_script(
                'jquery-repeater',
                gdpr('config')->get('plugin.url') . 'assets/jquery.repeater.min.js',
                ['jquery']
            );
            
            /**
             * Select2
             */

            wp_dequeue_script( 'select2css' );
            wp_dequeue_script( 'select2' );

            wp_enqueue_style(
                'select2css',
                gdpr('config')->get('plugin.url') . 'assets/select2-4.0.5.css'
            );
    
            wp_enqueue_script(
                'select2',
                gdpr('config')->get('plugin.url') . 'assets/select2-4.0.3.js',
                ['jquery']
            );
            
            wp_enqueue_script(
                'conditional-show',
                gdpr('config')->get('plugin.url') . 'assets/conditional-show.js',
                ['jquery']
            );
            /**
             * Color Picker
             */
            wp_enqueue_script( 'iris',gdpr('config')->get('plugin.url') .'assets/iris.min.js' );
            wp_enqueue_script( 'iris-init',gdpr('config')->get('plugin.url') .'assets/iris-init.js' );
        
            if(gdpr('options')->get('classidocs_integration')){
            /**
             * datatable in plugin
             */
                //wp_enqueue_script( 'gdprdataTables-js', gdpr('config')->get('plugin.url') .'assets/jquery.dataTables.min.js' );
				//wp_enqueue_style( 'datatables-css',gdpr('config')->get('plugin.url') .'assets/jquery.dataTables.min.css');
				wp_enqueue_script( 'lgpddataTables-js', '//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js' );
				wp_enqueue_script( 'lgpddataTables-js-init', gdpr( 'config' )->get( 'plugin.url' ) . 'assets/js/initdatatable.js', true );
				wp_enqueue_style( 'datatables-css', '//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css' );
            }
        }
    }

    /**
     * Add a new Post State for our super important system pages
     */
    public function registerPostStates($postStates, $post)
    {
        if (gdpr('options')->get('policy_page') == $post->ID) {
            $postStates['gdpr_policy_page'] = _x('Privacy Policy Page', '(Admin)', 'gdpr-framework');
        }

        if (gdpr('options')->get('tools_page') == $post->ID) {
            $postStates['gdpr_tools_page'] = _x('Privacy Tools Page', '(Admin)', 'gdpr-framework');
        }

        return $postStates;
    }
    //Delete userlogs if user deleted from admin panel.
    public function gdprf_delete_userlogs($user_id)
    {
        global $wpdb;

        $this->logtableName = $wpdb->prefix . 'gdpr_userlogs';

        return $wpdb->delete(
            $this->logtableName,
            [
                'user_id'   => $user_id,
            ]
        );
    }
    
}