<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('splendid_Redux_Framework_config')) {

    class splendid_Redux_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            //$this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));
			
			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => esc_html__('Section via hook', 'splendid'),
                'desc' => wp_kses_data(__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'splendid')),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            $args['dev_mode'] = false;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(esc_html__('Customize &#8220;%s&#8221;', 'splendid'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'splendid'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'splendid'); ?>" />
                <?php endif; ?>

                <?php echo '<h4>'.$this->theme->display('Name').'</h4>'; ?>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(esc_html__('By %s', 'splendid'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(esc_html__('Version %s', 'splendid'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . esc_html__('Tags', 'splendid') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <?php echo '<p class="theme-description">'.$this->theme->display('Description').'</p>'; ?>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . wp_kses_data(__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'splendid') ) . '</p>', esc_url(esc_html__('http://codex.wordpress.org/Child_Themes', 'splendid')), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();
	
            /**
             * Loading different option tabs
             */
            require get_template_directory() . '/admin/options/general.php';
            require get_template_directory() . '/admin/options/layout.php';
            require get_template_directory() . '/admin/options/preheader.php';
            require get_template_directory() . '/admin/options/header.php';
            require get_template_directory() . '/admin/options/title-wrapper.php';
            require get_template_directory() . '/admin/options/footer.php';
            require get_template_directory() . '/admin/options/custom_code.php';
            require get_template_directory() . '/admin/options/pages.php';
            require get_template_directory() . '/admin/options/shop.php';
            require get_template_directory() . '/admin/options/favicon.php';
            require get_template_directory() . '/admin/options/maintenance.php';	
            require get_template_directory() . '/admin/options/customizer.php';
            require get_template_directory() . '/admin/options/advanced.php';
            require get_template_directory() . '/admin/options/export.php';
			
//             require get_template_directory() . '/admin/options/_test.php';
            
            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . wp_kses_data(__('<strong>Theme URL:</strong> ', 'splendid') ) . '<a href="' . esc_url($this->theme->get('ThemeURI')) . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . wp_kses_data(__('<strong>Author:</strong> ', 'splendid') ) . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . wp_kses_data(__('<strong>Version:</strong> ', 'splendid') ) . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . wp_kses_data(__('<strong>Tags:</strong> ', 'splendid') ) . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            $this->sections[] = array(
                'type' => 'divide',
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => esc_html__('Theme Information', 'splendid'),
                'desc'      => wp_kses_data(__('<p class="description">More about our theme.</p>', 'splendid')),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );

        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => esc_html__('Theme Information 1', 'splendid'),
                'content'   => wp_kses_data(__('<p>This is the tab content, HTML is allowed.</p>', 'splendid'))
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => esc_html__('Theme Information 2', 'splendid'),
                'content'   => wp_kses_data(__('<p>This is the tab content, HTML is allowed.</p>', 'splendid'))
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = wp_kses_data(__('<p>This is the sidebar content, HTML is allowed.</p>', 'splendid'));
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name' => REDUX_OPT_NAME,
				'dev_mode' => false,
                'page_slug' => '_options',
                'page_title' => 'Options',
                'update_notice' => true,
                'intro_text' => '<p>Theme Options Panel</p>',
                'footer_text' => '<p></p>',
                'admin_bar' => true,
                'menu_type' => 'submenu',
                'menu_title' => 'Theme Options',
                'allow_sub_menu' => true,
                'page_parent_post_type' => 'your_post_type',
                'customizer' => true,
                'default_mark' => '*',
                'hints' => 
                array(
                  'icon' => 'el-icon-question-sign',
                  'icon_position' => 'right',
                  'icon_size' => 'normal',
                  'tip_style' => 
                  array(
                    'color' => 'light',
                  ),
                  'tip_position' => 
                  array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                  ),
                  'tip_effect' => 
                  array(
                    'show' => 
                    array(
                      'duration' => '500',
                      'event' => 'mouseover',
                    ),
                    'hide' => 
                    array(
                      'duration' => '500',
                      'event' => 'mouseleave unfocus',
                    ),
                  ),
                ),
                'output' => true,
                'output_tag' => true,
                'compiler' => true,
                'page_icon' => 'icon-themes',
                'page_permissions' => 'manage_options',
                'save_defaults' => true,
                'show_import_export' => false,
                'transient_time' => '3600',
                'network_sites' => true,
              );

            $theme = wp_get_theme(); // For use with some settings. Not necessary.
            $this->args["display_name"] = $theme->get("Name");
            $this->args["display_version"] = $theme->get("Version");

//SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
//             $this->args['share_icons'][] = array(
//                 'url'   => '',
//                 'title' => 'Visit us on GitHub',
//                 'icon'  => 'el-icon-github'
//                 //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
//             );
//             $this->args['share_icons'][] = array(
//                 'url'   => '',
//                 'title' => 'Like us on Facebook',
//                 'icon'  => 'el-icon-facebook'
//             );
//             $this->args['share_icons'][] = array(
//                 'url'   => '',
//                 'title' => 'Follow us on Twitter',
//                 'icon'  => 'el-icon-twitter'
//             );
//             $this->args['share_icons'][] = array(
//                 'url'   => '',
//                 'title' => 'Find us on LinkedIn',
//                 'icon'  => 'el-icon-linkedin'
//             );

        }

    }
    
	global $reduxConfig;
	$reduxConfig = new splendid_Redux_Framework_config();
}