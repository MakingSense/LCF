<?php
/**
 * Adds custom items to Menus edit screen (nav-menus.php)
 *
 * @package splendid
 */

new ts_custom_menu();

class ts_custom_menu {

    /**
	 * Construct
	 */
    public function __construct() {

        add_action( 'wp_update_nav_menu_item', array( $this, 'save_custom_menu_items'), 10, 3 );
        add_filter( 'wp_edit_nav_menu_walker', array( $this, 'nav_menu_edit_walker'), 10, 2 );
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'read_custom_menu_items' ) );

    } // end constructor
    
	/**
	 * Read custom menu itesm
	 * @param object $menu_item
	 * @return type
	 */
    function read_custom_menu_items( $menu_item ) {
        $menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
        $menu_item->hide_navigation_label = get_post_meta( $menu_item->ID, '_menu_item_hide_navigation_label', true );
        $menu_item->remove_link = get_post_meta( $menu_item->ID, '_menu_item_remove_link', true );
        $menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
		$menu_item->image = get_post_meta( $menu_item->ID, '_menu_item_image', true );
        return $menu_item;
    }
	
	/**
	 * Save custom menu items
	 * @param int $menu_id
	 * @param int $menu_item_db_id
	 * @param array $args
	 */
    function save_custom_menu_items( $menu_id, $menu_item_db_id, $args ) {
		
		//megamenu
		if (!isset($_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id] = '';
        }
        $menu_mega_enabled_value = $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id];        
        update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $menu_mega_enabled_value );
		
		//hide_navigation_label
		if (!isset($_REQUEST['edit-menu-item-hide_navigation_label'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-hide_navigation_label'][$menu_item_db_id] = '';
        }
        $hide_navigation_label_enabled_value = $_REQUEST['edit-menu-item-hide_navigation_label'][$menu_item_db_id];        
        update_post_meta( $menu_item_db_id, '_menu_item_hide_navigation_label', $hide_navigation_label_enabled_value );
		
		//remove_link
		if (!isset($_REQUEST['edit-menu-item-remove_link'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-remove_link'][$menu_item_db_id] = '';
        }
        $remove_link_enabled_value = $_REQUEST['edit-menu-item-remove_link'][$menu_item_db_id];        
        update_post_meta( $menu_item_db_id, '_menu_item_remove_link', $remove_link_enabled_value );
		
		//icon
		if (!isset($_REQUEST['edit-menu-item-icon'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-icon'][$menu_item_db_id] = '';
        }
        $icon_value = $_REQUEST['edit-menu-item-icon'][$menu_item_db_id];        
        update_post_meta( $menu_item_db_id, '_menu_item_icon', $icon_value );
		
		//image
		if (!isset($_REQUEST['edit-menu-item-image'][$menu_item_db_id])) {
            $_REQUEST['edit-menu-item-image'][$menu_item_db_id] = '';
        }
        $image_value = $_REQUEST['edit-menu-item-image'][$menu_item_db_id];        
        update_post_meta( $menu_item_db_id, '_menu_item_image', $image_value );
    }
    
    /**
	 * Return walker name
	 * @return string
	 */
    function nav_menu_edit_walker() {
        return 'Walker_Nav_Menu_Edit_Custom';   
    }
}




/**
 * This is a copy of Walker_Nav_Menu_Edit class in core
 * 
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = $original_object->post_title;
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( esc_html__( '%s (Invalid)','splendid' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( esc_html__('%s (Pending)','splendid'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		?>
		<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo sanitize_html_classes(implode(' ', $classes )); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo (0 == $depth ? 'style="display: none;"' : ''); ?>><?php esc_html_e( 'sub item', 'splendid'); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up','splendid'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down','splendid'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e('Edit Menu Item','splendid'); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? esc_url( admin_url( 'nav-menus.php' ) ) : esc_url( add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ) );
						?>"><?php esc_html_e( 'Edit Menu Item','splendid' ); ?></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'URL','splendid'); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Navigation Label','splendid' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Title Attribute','splendid' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php esc_html_e( 'Open link in a new window/tab','splendid' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'CSS Classes (optional)','splendid' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Link Relationship (XFN)','splendid' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'Description','splendid' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.','splendid'); ?></span>
					</label>
				</p>

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php esc_html_e( 'Move','splendid' ); ?></span>
						<a href="#" class="menus-move-up"><?php esc_html_e( 'Up one','splendid' ); ?></a>
						<a href="#" class="menus-move-down"><?php esc_html_e( 'Down one','splendid' ); ?></a>
						<a href="#" class="menus-move-left"></a>
						<a href="#" class="menus-move-right"></a>
						<a href="#" class="menus-move-top"><?php esc_html_e( 'To the top','splendid' ); ?></a>
					</label>
				</p>

				<!-- Menu Icon item -->
				<?php
				$value = get_post_meta( $item->ID, '_menu_item_icon', true);
				?>
				<p>
				<div class="clearboth"></div>
                <div class="icon-menu-container">
					<p class="field-link-icon">
						<label for="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>">
							<div id="edit-menu-preview-icon-<?php echo esc_attr($item_id); ?>" class="edit-menu-preview-icon"><?php echo (!empty($value) ? '<i class="'.(strstr($value,'fa-') ? 'fa' : '').' '.esc_attr($value).'"></i>' : ''); ?></div>
							<div id="edit-menu-button-icon-<?php echo esc_attr($item_id); ?>" class="edit-menu-button-icon button button-primary button-large" data-id="<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Choose Icon','splendid'); ?></div>
							<div id="edit-menu-remove-icon-<?php echo esc_attr($item_id); ?>" class="edit-menu-remove-icon button button-large" data-id="<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Remove','splendid'); ?></div>
							
							<input type="hidden" value="<?php echo esc_attr($value); ?>" id="edit-menu-item-icon_<?php echo esc_attr($item_id); ?>" name="edit-menu-item-icon[<?php echo esc_attr($item_id); ?>]" /> 
						</label>
					</p>  
				</div>
				</p>
				<!-- /Menu Icon item -->
				
				<!-- Mega Menu item -->
				<?php
				$value = get_post_meta( $item->ID, '_menu_item_megamenu', true);
				?>
				<div class="clearboth"></div>
				<div class="mega-menu-container">
					<p class="field-link-mega">
						<label for="edit-menu-item-megamenu-<?php echo esc_attr($item_id); ?>">
							<input type="checkbox" value="enabled" class="mega-menu-chk" id="edit-menu-item-megamenu-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-megamenu[<?php echo esc_attr($item_id); ?>]" <?php echo ("enabled" == $value ? 'checked="checked"' : ''); ?> />
							<?php esc_html_e( 'Create Mega Menu for this item', 'splendid' ); ?>
						</label>
					</p>  
				</div>
				<!-- /Mega Menu item -->
				
				<!-- Hide Navigation Label -->
				<?php
				$value = get_post_meta( $item->ID, '_menu_item_hide_navigation_label', true);
				?>
				<div class="clearboth"></div>
                <div class="hide-navigation-label-container">
					<p class="field-link-hide-navigation-label">
						<label for="edit-menu-item-hide_navigation_label-<?php echo esc_attr($item_id); ?>">
							<input type="checkbox" value="enabled" class="mega-menu-chk" id="edit-menu-item-hide_navigation_label-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-hide_navigation_label[<?php echo esc_attr($item_id); ?>]" <?php echo ("enabled" == $value ? 'checked="checked"' : ''); ?> />
							<?php esc_html_e( 'Hide Navigation Label', 'splendid' ); ?>
						</label>
					</p>  
				</div>
				<!-- /Hide Navigation Label -->
				
				<!-- Remove Link -->
				<?php
				$value = get_post_meta( $item->ID, '_menu_item_remove_link', true);
				?>
				<div class="clearboth"></div>
                <div class="remove-link-container">
					<p class="field-link-remove-link">
						<label for="edit-menu-item-remove_link-<?php echo esc_attr($item_id); ?>">
							<input type="checkbox" value="enabled" class="remove-link-chk" id="edit-menu-item-remove_link-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-remove_link[<?php echo esc_attr($item_id); ?>]" <?php echo ("enabled" == $value ? 'checked="checked"' : ''); ?> />
							<?php esc_html_e( 'Remove Link', 'splendid' ); ?>
						</label>
					</p>  
				</div>
				<!-- /Remove Link -->
				
				<!-- Image Upload -->
				<?php
				$value = get_post_meta( $item->ID, '_menu_item_image', true);
				?>
				<div class="clearboth"></div>
                <div class="image-container">
					<div class="field-link-image">
						<label for="edit-menu-item-image-<?php echo esc_attr($item_id); ?>">
							<input type="text" class="upload form-control" id="edit-menu-item-remove_link-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-image[<?php echo esc_attr($item_id); ?>]"  value="<?php echo esc_url($value); ?>"/>
							<input class="nav_upload_button button button-primary button-large" type="button" value="<?php esc_html_e( 'Choose Image', 'yamen' ); ?>" />
							<br/>
							<i><?php esc_html_e('Image feature works with megamenu enabled only. Image is displayed instead of a text link.','yamen'); ?></i>
						</label>
						<div class="image-preview">
							<?php if (!empty($value)): ?>
								<img src="<?php echo esc_url($value); ?>" />
							<?php endif; ?>
						</div>
					</div>  
				</div>
				
				<!-- /Image Upload -->
				
				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( esc_html__('Original: %s','splendid'), '<a href="' . esc_url( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php esc_html_e( 'Remove','splendid'); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel','splendid'); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}
}

/**
 * Splendid Menu Widget Walker
 */
class splendid_menu_widget_walker_nav_menu extends Walker_Nav_Menu {
  
	/**
	 * Current item
	 * @var object 
	 */
	private $current_item;
	
	/**
	 * We need to know when menu is multi columns
	 * @var boolean 
	 */
	private $is_multi_columns = false;
	
	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		
		$class = 'mn-sub';
		
		if ($this -> is_multi_columns === true && $depth == 1) {
			$output .= "\n$indent<div class=\"menu-items\">\n";
		} else {
			if ($this -> is_multi_columns === true && $depth == 0) {
				$output .= '<div class="dropdown-inner">';
			}
			
			$output .= "\n$indent<ul class=\"".$class."\">\n";
		}
	}
	
	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		
		if ($this -> is_multi_columns === true && $depth == 1) {
			$output .= "$indent</div><!-- .menu-items -->\n";
		} else {
			
			$output .= "$indent</ul>\n";
			
			if ($this -> is_multi_columns === true && $depth == 0) {
				$output .= '</div>';
			}
		}
	}
  
	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		
		//set curret item to use in start_lvl
		$this -> current_item = $item; 
		
		//set if multi columns menu is enabled
		if ($item -> megamenu == 'enabled' && $depth == 0) {
			$this -> is_multi_columns = true;
		} else if ($depth == 0) {
			$this -> is_multi_columns = false;
		}
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		if ($this -> is_multi_columns === true && $depth == 0) {
			$classes[] = 'megamenu';
		}
		
		if ($this -> is_multi_columns && $depth == 0 && $item -> hasChildren) {
			$classes[] = 'megamenu-columns-'.intval($item -> childrenCounter);
		}
		
		/**
		 * Filter the CSS class(es) applied to a menu item's <li>.
		 *
		 * @since 3.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . sanitize_html_classes( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's <li>.
		 *
		 * @since 3.0.1
		 *
		 * @see wp_nav_menu()
		 *
		 * @param string $menu_id The ID that is applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		
		if ($this -> is_multi_columns === true && $depth == 2) {
			//don't display li element 
		} else {
			$output .= $indent . '<li' . $id . $class_names .'>';
		}
		
		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		$atts['class']	= ' ';

		//item is a title of the multi columns submenu
		if ($this -> is_multi_columns === true && $depth == 1) {
			//nothing to do right now $atts['class'] .= '';

		//item has children
		} else if ($this -> is_multi_columns !== true && $item -> hasChildren ||
			$this -> is_multi_columns === true && $depth == 0 && $item -> hasChildren
		) {
			//nothing to do right now $atts['class'] .= 'mn-has-sub ';
		}

		/**
		 * Filter the HTML attributes applied to a menu item's <a>.
		 *
		 * @since 3.6.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's <a>, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item The current menu item.
		 * @param array  $args An array of wp_nav_menu() arguments.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;

		if ($this -> is_multi_columns === true && $depth == 1) {
			$item_output .= '<p>';
		} 
		
		if ($item -> remove_link != 'enabled') {
			$item_output .= '<a'. $attributes .'>';
		}
		
		//show image instead of the link
		if ($this -> is_multi_columns === true && $depth == 2 && !empty($item -> image) && esc_url($item -> image)) {
			$item_output .= '<img src="'.esc_url($item -> image).'" alt="'.esc_attr(apply_filters( 'the_title', $item->title, $item->ID )).'"/>';
		} else {

			if (!empty($item -> icon)) {
				if (strstr($item -> icon,'fa fa-')) {
					$icon = $item -> icon;
				} else {
					$icon = 'fa '.$item -> icon;
				}

				$item_output .= '<i class="'. sanitize_html_classes($icon).' fa-sm"></i> ';
			}

			/** This filter is documented in wp-includes/post-template.php */
			$navigation_label = '';
			if ($item -> hide_navigation_label != 'enabled' || $depth != 0) {
				$navigation_label = apply_filters( 'the_title', $item->title, $item->ID );
			}

			$item_output .= $args->link_before . $navigation_label . $args->link_after;
		}
		
		if ($item -> remove_link != 'enabled') {
			$item_output .= '</a>';
		}

		if ($this -> is_multi_columns === true && $depth == 1) {
			$item_output .= '</p>';
		} 
	
		$item_output .= $args->after;
		
		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes $args->before, the opening <a>,
		 * the menu item's title, the closing </a>, and $args->after. Currently, there is
		 * no filter for modifying the opening and closing <li> for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @see wp_nav_menu()
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		
		if ($this -> is_multi_columns === true && $depth == 2) {
			//don't display li element 
		} else {
			$output .= "</li>\n";
		}
	}
	
	function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
		$element->hasChildren = false;
		$element->childrenCounter = 0;
		
		// check, whether there are children for the given ID and append it to the element with a (new) ID
        if (isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID])) {
			$element->hasChildren = true;
			$element->childrenCounter = count($children_elements[$element->ID]);
		}
		return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}