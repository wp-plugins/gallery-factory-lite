<?php
/**
 * @package   Gallery_Factory_Lite
 * @author    Vilyon Studio <vilyonstudio@gmail.com>
 * @link      http://galleryfactory.vilyon.net
 * @copyright 2015 Vilyon Studio
 *
 * Class contains admin-related functionality.
 */

if (!class_exists("VLS_Gallery_Factory_Admin")) {
    class VLS_Gallery_Factory_Admin
    {

        private static $_instance = null;

        /**
         * Constructor of the class. Registering hooks here.
         */
        private function __construct()
        {

            // admin_init hook
            add_action('admin_init', array($this, 'init'));

            // admin_menu hook
            add_action('admin_menu', array($this, 'create_menu'));

            // admin_enqueue_scripts hook
            add_action('admin_enqueue_scripts', array($this, 'load_scripts'));
            add_action('admin_enqueue_scripts', array($this, 'load_stylesheets'));

            // admin_footer hook
            add_action('admin_footer', array($this, 'print_admin_footer'));
        }

        /**
         * Cloning instances of this class is forbidden.
         */
        private function __clone()
        {
        }

        /**
         * Deserialisation of this class is forbidden.
         */
        private function __wakeup()
        {
        }

        public static function instance()
        {
            if (self::$_instance == null) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        /**
         * Function is attached to 'init' hook
         */
        public function init()
        {

            add_filter('upload_dir', array($this, 'filter_upload_dir'));
            register_setting('vls-gallery-factory', 'vls_gf_display_image_info_on_hover');


            //adding hooks on update of some global options, with require album view cache reset
            //TODO: find a way to fire cache clear just once if multiple options are changed
            add_action("update_option_vls_gf_display_image_info_on_hover", array($this, 'clear_all_albums_view_cache'));

            add_action('admin_notices', array($this, 'system_check_admin_notice'));
            add_action('admin_post_vls_gf_import_wp_media', array($this, 'do_import_wp_media'));
        }

        /**
         * Creates main menu item and settings menu item
         */
        public function create_menu()
        {
            $minimumCapability = 'edit_pages'; //'read'

            // Top level menu item
            add_menu_page('Gallery Manager', 'Gallery Factory', $minimumCapability, 'vls_gf_gallery_manager', array(
                $this,
                'display_page_gallery_manager'
            ), 'dashicons-format-gallery', '21.84');

            add_options_page('Gallery Factory Options', 'Gallery Factory', 'manage_options', 'vls_gf_options', array(
                $this,
                'display_page_settings'
            ));

            add_management_page('Gallery Factory Tools', 'Gallery Factory', 'import', 'vls_gf_tools', array(
                $this,
                'display_page_tools'
            ));

        }

        /**
         * Loads admin scripts
         */
        public function load_scripts()
        {

            $screen = get_current_screen();

            //registering scripts only for Gallery Manager page
            if ('toplevel_page_vls_gf_gallery_manager' == $screen->id) {

                wp_register_script(
                    'jquery-ui-plupload',
                    VLS_GF_PLUGIN_URL . 'lib/jquery-ui-plupload/jquery.ui.plupload' . (WP_DEBUG ? '' : '.min') . '.js',
                    array('jquery', 'plupload', 'jquery-ui-widget', 'jquery-ui-button', 'jquery-ui-progressbar', 'jquery-ui-sortable'),
                    false, true);

                wp_register_script(
                    'vls-gf-gallery-manager',
                    VLS_GF_PLUGIN_URL . 'admin/js/gallery-manager' . (WP_DEBUG ? '' : '.min') . '.js',
                    array('jquery', 'jquery-touch-punch', 'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-resizable', 'jquery-ui-plupload', 'post'),
                    VLS_GF_VERSION, true);

                $data = array(
                    'nonce' => wp_create_nonce("vls-gf-nonce"),
                    'l10n' => array(
                        'btnSave' => __('Save', 'vls_gallery_factory'),
                        'btnCancel' => __('Cancel', 'vls_gallery_factory'),
                        'strImageDetails' => __('Image Details', 'vls_gallery_factory')
                    )
                );
                wp_localize_script('vls-gf-gallery-manager', 'vlsGfGalleryAdminData', $data);

                wp_enqueue_script('vls-gf-gallery-manager');

                //activating quick tour if not disabled
                if (!get_user_option('vls_gf_no_tour')) {
                    wp_enqueue_script(
                        'vls-gf-gallery-manager-tour',
                        VLS_GF_PLUGIN_URL . 'admin/js/gallery-manager-tour' . (WP_DEBUG ? '' : '.min') . '.js',
                        array('jquery', 'vls-gf-gallery-manager'),
                        VLS_GF_VERSION, true);
                }

            }

        }

        /**
         * Loads admin stylesheets
         */
        public function load_stylesheets()
        {

            $screen = get_current_screen();

            //loading GF stylesheets for Gallery Manager page only
            if ('toplevel_page_vls_gf_gallery_manager' == $screen->id) {

                wp_enqueue_style('vls-gf-plupload-style', VLS_GF_PLUGIN_URL . 'admin/css/plupload.css');

                wp_enqueue_style('vls-gf-admin-style', VLS_GF_PLUGIN_URL . 'admin/css/style.css');

                //activating quick tour style if not disabled
                if (!get_user_option('vls_gf_no_tour')) {
                    wp_enqueue_style('vls-gf-admin-style-tour', VLS_GF_PLUGIN_URL . 'admin/css/style-tour.css');
                }

                //here we rely on wp function to guess touch-enabled device and attach css with touch optimizations //TODO: consider using custom function
                if (wp_is_mobile()) {
                    wp_enqueue_style('vls-gf-admin-style-touch', VLS_GF_PLUGIN_URL . 'admin/css/style-touch.css', array('vls-gf-admin-style'));
                }
            }
        }

        /**
         * Prints admin footer
         */
        public function print_admin_footer()
        {
        }

        /**
         * Performs system checks and notifies the admin if any problem is found
         */
        public function system_check_admin_notice()
        {

            //display notice only in Gallery Manager
            $screen = get_current_screen();
            if ('toplevel_page_vls_gf_gallery_manager' != $screen->id) {
                return;
            }

            //if check is already done, bail out
            if (get_option('vls_gf_check_ok')) {
                return;
            }

            $check_ok = false;

            //check if WP has the right to create all needed folders
            $path = WP_CONTENT_DIR . VLS_GF_UPLOADS_DIR;

            if (!is_dir($path)) {
                if (is_writable(WP_CONTENT_DIR)) {
                    mkdir($path, 0777, true);
                }
            }

            if (is_dir($path) && is_writable($path)) {
                if (mkdir($path . '/test', 0777, true)) {
                    if (is_dir($path . '/test')) {
                        rmdir($path . '/test');
                        $check_ok = true;
                    }
                }
            }


            if ($check_ok) {
                update_option('vls_gf_check_ok', 1);
            } else {
                //display the notice
                $class = "error";
                $message = 'Gallery Factory could not create the folder "gf-uploads" in the "wp-content" folder or create its subfolders. Please check the permissions and reload this page to check if the notice remains.';
                echo "<div class=\"$class\"> <p>$message</p></div>";
            }


        }

        ###############################################################
        ## Pages (functions for rendering and processing admin pages ##
        ###############################################################


        /**
         * Displays settings page
         */
        public function display_page_settings()
        {

            ob_start();
            require(VLS_GF_PLUGIN_DIR . 'admin/templates/tmpl-settings.php');
            echo ob_get_clean();

        }

        /**
         * Displays tools page
         */
        public function display_page_tools()
        {

            wp_enqueue_script('jquery');

            ob_start();
            require(VLS_GF_PLUGIN_DIR . 'admin/templates/tmpl-tools.php');
            echo ob_get_clean();

        }


        /**
         * Displays gallery manager page
         */
        public function display_page_gallery_manager()
        {

            require(VLS_GF_PLUGIN_DIR . 'admin/templates/tmpl-gallery-manager.php');

        }

        ###############################################################
        ## Filters                                                   ##
        ###############################################################

        /**
         * Attached to 'upload_dir' filter. Sets upload directory for GF uploads.
         * @param $dir_options
         * @return mixed
         */
        public function filter_upload_dir($dir_options)
        {

            //TODO: consider adding user-defined option here instead of hardcoded path
            if (isset($_REQUEST['action']) && 'vls_gf_async_upload' == $_REQUEST['action']) {
                $subdir = $dir_options['subdir'];
                $dir_options['subdir'] = $subdir;
                $dir_options['basedir'] = WP_CONTENT_DIR . VLS_GF_UPLOADS_DIR;
                $dir_options['path'] = $dir_options['basedir'] . $subdir;
                $dir_options['baseurl'] = WP_CONTENT_URL . VLS_GF_UPLOADS_DIR;
                $dir_options['url'] = $dir_options['baseurl'] . $subdir;
            }

            return $dir_options;

        }

        ###############################################################
        ## Other                                                     ##
        ###############################################################


        /**
         * Clears the album view cache. Attached to the update_option_ hook.
         */
        public function clear_all_albums_view_cache()
        {

            global $wpdb;

            $albums = $wpdb->get_results(
                $wpdb->prepare("
                    SELECT album.ID as ID
                    FROM $wpdb->posts album
                    WHERE album.post_type=%s",
                    VLS_GF_POST_TYPE_ALBUM
                )
            );

            foreach ($albums as $album) {
                VLS_Gallery_Factory_Admin_Utils::clear_view_cache_by_album($album->ID);
            }
        }

        public function do_import_wp_media()
        {


            global $wpdb;

            $wp_upload_dir = wp_upload_dir();
            $gf_upload_dir = WP_CONTENT_DIR . VLS_GF_UPLOADS_DIR;


            $posts = $wpdb->get_results(
                $wpdb->prepare("
                        SELECT p.ID, p.post_title as title, p.post_excerpt as caption,
                          p.post_content as description, p.post_mime_type as mime_type,
                          m1.meta_value as attached_file, IFNULL(m2.meta_value, '') as alt_text
                        FROM $wpdb->posts p
                        INNER JOIN $wpdb->postmeta m1
                        ON
                          p.ID = m1.post_id
                          AND p.post_type = %s
                          AND p.post_mime_type IN (%s, %s, %s)
                          AND m1.meta_key = %s
                        LEFT JOIN $wpdb->postmeta m2
                        ON
                          p.ID = m2.post_id
                          AND m2.meta_key = %s
                          ",
                    'attachment',
                    'image/jpeg', 'image/gif', 'image/tiff',
                    '_wp_attached_file',
                    '_wp_attachment_image_alt'
                )
            );


            foreach ($posts as $media_post) {

                //getting WP media file info
                $media_file = VLS_Gallery_Factory_Admin_Utils::pathinfo($media_post->attached_file);

                //creating the folder if not exists
                $gf_upload_subdir = $gf_upload_dir . '/' . $media_file['dirname'];
                if (!file_exists($gf_upload_subdir)) {
                    mkdir($gf_upload_subdir, 0777, true);
                }

                //finding the unoccupied name for the file (incrementing postfix until success)
                $run = true;
                $a = 0;
                $gf_filename = '';
                while ($run) {
                    $gf_filename = $media_file['filename'] . ($a > 0 ? '_' . $a : '') . '.' . $media_file['extension'];
                    if (!file_exists($gf_upload_subdir . '/' . $gf_filename)) {
                        $run = false;
                    }
                    $a++;
                }

                //copying the file to GF uploads
                $gf_file_path = $gf_upload_subdir . '/' . $gf_filename;

                copy($wp_upload_dir['basedir'] . '/' . $media_post->attached_file, $gf_file_path);

                $file = array(
                    'url' => content_url(VLS_GF_UPLOADS_DIR . '/' . $media_file['dirname'] . '/' . $gf_filename),
                    'file' => $gf_file_path,
                    'type' => $media_post->mime_type,
                    'title' => $media_post->title,
                    'caption' => $media_post->caption,
                    'description' => $media_post->description,
                    'alt_text' => $media_post->alt_text
                );

                //attaching the file to GF
                VLS_Gallery_Factory_Admin_Utils::addImageFile($file);

            }


//
//            foreach (new DirectoryIterator($wp_upload_dir['basedir']) as $fileInfo) {
//                if($fileInfo->isDot()) continue;
//                if ($fileInfo->isFile()) {
//                    $bn = $fileInfo->getBasename();
//                    $fn = $fileInfo->getFilename();
//                }
//                //echo $fileInfo->getFilename() . '<br>\n';
//            }


            wp_redirect('tools.php?page=vls_gf_tools&status=done');
            exit;

        }

    }
}

return VLS_Gallery_Factory_Admin::instance();