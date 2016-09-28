<?php
/*
  Plugin Name: Splendid Addons
  Plugin URI: http://www.medialayout.com
  Description: A part of Splendid theme
  Version: 1.1
  Author: Medialayout Team
  Author URI: http://www.medialayout.com
  Text Domain: splendid-addons
 */

// Define Constants
defined('RS_ROOT') or define('RS_ROOT', plugin_dir_path(__FILE__));

/**
 * Shortcodes
 */
if (!class_exists('RS_Shortcode')) {

	/**
	 * Main plugin class
	 */
	class RS_Shortcode {

		private $assets_css;
		private $assets_js;

		/**
		 * Construct
		 */
		public function __construct() {
			add_action('init', array($this, 'rs_init'), 50);
			add_action('setup_theme', array($this, 'rs_load_custom_post_types'), 40);
			add_action('widgets_init', array($this, 'rs_load_widgets'), 50);
			add_action('plugins_loaded', array($this, 'load_textdomain'));
		}

		/**
		 * Plugin activation
		 */
		public static function activate() {
			flush_rewrite_rules();
		}

		/**
		 * Plugin deactivation
		 */
		public static function deactivate() {
			flush_rewrite_rules();
		}

		/**
		 * Load plugin textdomain.
		 *
		 * @since 1.0.0
		 */
		function load_textdomain() {

			load_plugin_textdomain('splendid-addons', false, plugin_basename(dirname(__FILE__)) . '/languages');
		}

		/**
		 * Init
		 */
		public function rs_init() {

			if (!defined('SPLENDID_THEME_ACTIVATED') || SPLENDID_THEME_ACTIVATED !== true) {
				add_action('admin_notices', array($this, 'rs_activate_theme_notice'));
			} else {

				require_once(RS_ROOT . '/extras/extras.php');

				$this->assets_css = plugins_url('/composer/assets/css', __FILE__);
				$this->assets_js = plugins_url('/composer/assets/js', __FILE__);
				add_action('admin_print_scripts-post.php', array($this, 'rs_load_vc_scripts'), 99);
				add_action('admin_print_scripts-post-new.php', array($this, 'rs_load_vc_scripts'), 99);
				add_action('admin_print_scripts-widgets.php', array($this, 'rs_load_widget_scripts'), 99);
				add_action('vc_load_default_params', array($this, 'rs_reload_vc_js'));
				if (class_exists('Vc_Manager')) {
					$this->rs_vc_load_shortcodes();
					$this->rs_init_vc();
					$this->rs_vc_integration();
				}
			}
		}

		/**
		 * Print theme notice
		 */
		function rs_activate_theme_notice() {
			?>
			<div class="updated">
				<p><strong><?php esc_html_e('Please activate the Splendid theme to use Splendid Addons plugin.', 'splendid-addons'); ?></strong></p>
			<?php
			$screen = get_current_screen();
			if ($screen->base != 'themes'):
				?>
					<p><a href="<?php echo esc_url(admin_url('themes.php')); ?>"><?php esc_html_e('Activate theme', 'splendid-addons'); ?></a></p>
				<?php endif; ?>
			</div>
			<?php
			}

			/**
			 * Init VC integration
			 * @global type $vc_manager
			 */
			public function rs_init_vc() {
				global $vc_manager;
				$vc_manager->setIsAsTheme();
				$vc_manager->disableUpdater();
				$list = array('page', 'post', 'portfolio', 'special-content');
				$vc_manager->setEditorDefaultPostTypes($list);
				$vc_manager->setEditorPostTypes($list); //this is required after VC update (probably from vc 4.5 version)
				//$vc_manager->frontendEditor()->disableInline(); // enable/disable vc frontend editior
				$vc_manager->automapper()->setDisabled();
			}

			/**
			 * Load custom post types
			 */
			public function rs_load_custom_post_types() {
				require_once(RS_ROOT . '/custom-posts/social-site.php');
				require_once(RS_ROOT . '/custom-posts/team.php');
				require_once(RS_ROOT . '/custom-posts/testimonial.php');
				require_once(RS_ROOT . '/custom-posts/portfolio.php');
				require_once(RS_ROOT . '/custom-posts/special-content.php');
			}

			/**
			 * Load widgets
			 */
			public function rs_load_widgets() {
				if (!defined('SPLENDID_THEME_ACTIVATED') || SPLENDID_THEME_ACTIVATED !== true) {
					return false;
				}
				$widgets = array(
					'WP_Alternative_Custom_Menu_Widget',
					'WP_Contact_Details_Widget',
					'WP_Latest_Posts_Widget',
					'WP_Popular_Posts_Widget',
					'WP_Latest_Tweets_Widget',
					'WP_Quatro_Ads_Widget',
					'WP_Social_Icons_Widget',
				);
				foreach ($widgets as $widget) {
					if (file_exists(RS_ROOT . '/widgets/' . $widget . '.class.php')) {
						require_once(RS_ROOT . '/widgets/' . $widget . '.class.php');
						register_widget('splendid_' . $widget);
					}
				}
			}

			/**
			 * Load shortcodes
			 */
			public function rs_vc_load_shortcodes() {
				require_once(RS_ROOT . '/' . 'shortcodes/vc_column.php');
				require_once(RS_ROOT . '/' . 'shortcodes/vc_column_text.php');
				require_once(RS_ROOT . '/' . 'shortcodes/vc_row.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_content_box.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_content_box_2.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_counter.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_chart.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_progress_bar.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_buttons.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_divider.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_tab.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_accordion.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_msg_box.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_gallery_slider.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_grid_gallery.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_pricing_table.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_process_box.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_newsletter.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_dropcap.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_promo_box.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_promo_box_border.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_section_title.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_image_block.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_blockquote.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_play_box.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_image_frame.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_banner.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_banner_slider.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_team.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_counter_2.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_testimonial.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_google_map.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_contact_form.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_social_share.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_contact_details.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_latest_works.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_latest_news.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_tooltip.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_highlights.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_checklist.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_space.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_modal.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_special_text.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_clients.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_link_box.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_faq.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_audio_player.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_iframe.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_toggle.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_sortable_toggle.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_shop_box.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_portfolio.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_portfolio_details.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_woo_featured_products.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_woo_best_seller.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_woo_products.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_coming_soon_counter.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_blog_magazine.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_blog_magazine_alt.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_blog_magazine_trending.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_blog_magazine_popular.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_portfolio_masonry_full_width.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_feature_box.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_portfolio_grid.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_parallax_container.php');
				require_once(RS_ROOT . '/' . 'shortcodes/rs_portfolio_related.php');
			}

			/**
			 * Visual composer integration
			 */
			public function rs_vc_integration() {
				require_once( RS_ROOT . '/' . 'composer/map.php' );
			}

			/**
			 * Loand vc scripts
			 */
			public function rs_load_vc_scripts() {
				wp_enqueue_style('rs-vc-custom', $this->assets_css . '/vc-style.css');
				wp_enqueue_style('rs-etline', $this->assets_css . '/et-line.css');
				wp_enqueue_style('rs-chosen', $this->assets_css . '/chosen.css');
				wp_enqueue_script('vc-script', $this->assets_js . '/vc-script.js', array('jquery'), '1.0.0', true);
				wp_enqueue_script('vc-chosen', $this->assets_js . '/jquery.chosen.js', array('jquery'), '1.0.0', true);
			}

			/**
			 * Load widget scripts
			 */
			public function rs_load_widget_scripts() {
				wp_enqueue_script('rs-widgets', $this->assets_js . '/widgets.js', array('jquery', 'select2'), '1.0.0', true);
				wp_enqueue_media();


				wp_enqueue_script('media-upload');
				wp_enqueue_script('thickbox');
				wp_enqueue_style('thickbox');
			}

			/**
			 * Reload JS
			 */
			public function rs_reload_vc_js() {
				echo '<script type="text/javascript">(function($){ jQuery(document).ready( function($){ $.reloadPlugins(); }); })(jQuery);</script>';
			}

		}

		// end of class

		new RS_Shortcode;

		register_activation_hook(__FILE__, array('RS_Shortcode', 'activate'));
		register_deactivation_hook(__FILE__, array('RS_Shortcode', 'deactivate'));
	} // end of class_exists


