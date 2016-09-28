/* 
 * Extension scripts
 */

jQuery(document).ready(function($) {
	
	var $ts_refresh_it = 0;
	var $ts_import_completed = false;
	var $ts_import_error = false;
	var $ts_stop_refreshing = false;
	
	var ts_import_log = function(msg) {
		$('#import-sample-data-log').append(msg);
		$('#import-sample-data-log').animate({"scrollTop": $('#import-sample-data-log')[0].scrollHeight}, "fast");
	}
	
	/**
	 * Refresh import log
	 */
	var ts_refresh_import_log = function() {
		
		$ts_refresh_it++;
		
		if ($ts_stop_refreshing) {
			return;
		}
		
		//finish refreshing log window after 600 seconds
		if ($ts_refresh_it > 600) {
			ts_import_log('Import doesn\'t respond.');
			return;
		}
		
		$.ajax({
			url: ajaxurl,
			data: {
				action : 'refresh_import_log'
			},
			success:function(data) {
				
				if (data.search("ERROR") != -1) {
					$ts_import_error = true;
				}
								
				$('#import-sample-data-log').html(data);
				$('#import-sample-data-log').animate({"scrollTop": $('#import-sample-data-log')[0].scrollHeight}, "fast");
				
				if ($ts_import_error) {
					$ts_stop_refreshing = true;
					ts_import_log('Import error!');
					return;
				}
				
				if ($ts_import_completed) {
					$ts_stop_refreshing = true;
					ts_import_log('Import successful!');
					return;
				}
			},
			error: function(errorThrown) {
				console.log(errorThrown);
			}
		}).done( function() { 
			
			setTimeout(ts_refresh_import_log, 1000) 
		} );
	}
	
	var $import_sample_data_initialized = false;
	
	//Import sample data
	$('#import-sample-data').click( function() {
		
		if ($import_sample_data_initialized) {
			return;
		}
		
		$import_sample_data_initialized = true;
		
		if (confirm( $('#import-sample-data-confirm').html() )) {
			
			$('#import-sample-data-log').slideDown();
			
			$.ajax({
				url: import_url,
				data: {
					template : $('#opt-import-template-select').val(),
				},
				success:function(data) {
					
					if (data) { //data is not empty only if php error occured
						console.dir(data);
					}
					//nothing to do
				},
				error: function(errorThrown) {
					console.log(errorThrown);
				}
			}).done(function() { $ts_import_completed = true });
			
			setTimeout(ts_refresh_import_log, 1000);
		}
	});
	
	$('#reset-importer-status').click( function() {
		if (confirm( $('#reset-importer-status-confirm').html() )) {
			$this = $(this);
			
			$.ajax({
				url: ajaxurl,
				data: {
					action : 'reset_importer_status'
				},
				success:function(data) {
					$this.html( $('#reset-importer-status-done').html() );
					setTimeout(function() { $this.remove() },1000);	
				},
				error: function(errorThrown) {
					console.log(errorThrown);
				}
			});
		}
	});
	
	//switch gallery post options for portfolio items, 
	//Redux supports hidding metaboxes depends on post format only for POSTS, not for custom post types
	var ts_switch_gallery_options_on_portfolio = function(val) {
		
		if ( $('#post_type').val() == 'portfolio') {
			
			$('#redux-gourmet_theme_options-metabox-ts-gallery-post-options').hide();
			
			if (val == true) {
				$('#redux-gourmet_theme_options-metabox-ts-gallery-post-options').show();
			}
		}
	}
	
	//Open popup window with icons dropdown, used in Appearance>Menus
	$("#update-nav-menu").on("click", ".edit-menu-button-icon", function(event) {
		$nav_item_id = $(this).attr('data-id');
		tb_show("Insert Icon", admin_ajax_url + "?action=insert_icon&width=630&nav_item_id=" + $nav_item_id);
	});
	
	//Clear icon for menu item, used in Appearance>Menus
	$("#update-nav-menu").on("click", ".edit-menu-remove-icon", function(event) {
		$nav_item_id = $(this).attr('data-id');
		jQuery('#edit-menu-item-icon_' + $nav_item_id).val('');
		jQuery('#edit-menu-preview-icon-' + $nav_item_id).html('');
	});
		
	/**
	 * Menus media uploader
	 * 
	 */
	
	var nav_media_uploader = null;

	var open_media_uploader_image = function(button)
	{
		nav_media_uploader = wp.media({
			multiple: false,
		});

		nav_media_uploader.on("select", function(){
			var json = nav_media_uploader.state().get("selection").first().toJSON();

			var image_url = json.url;
			var image_caption = json.caption;
			var image_title = json.title;
			
			$(button).closest('.field-link-image').find('.upload').val(image_url);
			
			$(button).closest('.field-link-image').find('.image-preview').html('<img src=' + image_url + ' />');
		});

		nav_media_uploader.open();
	}
	
	$('#menu-to-edit').on('click', '.nav_upload_button', function() {
		
		open_media_uploader_image(this);
	});
});


