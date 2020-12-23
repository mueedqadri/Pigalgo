<?php
/**
 * @package   Essential_Grid
 * @author    ThemePunch <info@themepunch.com>
 * @link      http://www.themepunch.com/essential/
 * @copyright 2016 ThemePunch
 */

if( !defined( 'ABSPATH') ) exit();

?>
<h2 class="topheader"><?php echo esc_html(get_admin_page_title()); ?></h2>
<div id="global-settings-dialog-wrap">
	<?php
	$curPermission = Essential_Grid_Admin::getPluginPermissionValue();
	$output_protection = get_option('tp_eg_output_protection', 'none');
	$tooltips = get_option('tp_eg_tooltips', 'true');
	$wait_for_fonts = get_option('tp_eg_wait_for_fonts', 'true');
	$js_to_footer = get_option('tp_eg_js_to_footer', 'false');
	$use_cache = get_option('tp_eg_use_cache', 'false');
	$overwrite_gallery = get_option('tp_eg_overwrite_gallery', 'off');
	$query_type = get_option('tp_eg_query_type', 'wp_query');
	$enable_log = get_option('tp_eg_enable_log', 'false');
	$use_lightbox = get_option('tp_eg_use_lightbox', 'false');
	$hasposts = get_posts('post_type=essential_grid');
	$default_cpt = !empty ( $hasposts ) ? 'true' : 'false';
	$enable_custom_post_type = get_option('tp_eg_enable_custom_post_type', $default_cpt);
	$enable_media_filter = get_option('tp_eg_enable_media_filter', 'false');
	$enable_post_meta = get_option('tp_eg_enable_post_meta', 'true');
	$no_filter_match_message = get_option('tp_eg_no_filter_match_message', 'No Items for the Selected Filter');
	$global_default_img = get_option('tp_eg_global_default_img', '');
	$enable_fontello = get_option('tp_eg_global_enable_fontello', 'backfront');
	$enable_font_awesome = get_option('tp_eg_global_enable_font_awesome', 'false');
	$enable_pe7 = get_option('tp_eg_global_enable_pe7', 'false');
	$enable_youtube_nocookie = get_option('tp_eg_enable_youtube_nocookie', 'false');
	
	if(empty($global_default_img)) {
		$display_global_img = 'hidden';
		$global_default_src = '';
	}
	else {
		$display_global_img = 'block';
		$global_default_src = wp_get_attachment_image_src($global_default_img, 'large');
		$global_default_src = !empty($global_default_src) ? $global_default_src[0] : '';
	}

	$data = apply_filters('essgrid_globalSettingsDialog_data', array());
	
	if(Essential_Grid_Jackbox::jb_exists()) {
		$jb_active = true;
	}else{ //disable jackbox and reset to default if it was set until now
		if($use_lightbox == 'jackbox'){
			update_option('tp_eg_use_lightbox', 'false');
		}
		$jb_active = false;
	}
	
	if(Essential_Grid_Social_Gallery::sg_exists()) {
		$sg_active = true;
	}else{ //disable jackbox and reset to default if it was set until now
		if($use_lightbox == 'sg'){
			update_option('tp_eg_use_lightbox', 'false');
		}
		$sg_active = false;
	}
	?>
	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('View Plugin Permissions', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="plugin_permissions">
				<option <?php echo ($curPermission == Essential_Grid_Admin::ROLE_ADMIN) ?  'selected="selected" ' : '';?>value="admin"><?php _e('Admin', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($curPermission == Essential_Grid_Admin::ROLE_EDITOR) ? 'selected="selected" ' : '';?>value="editor"><?php _e('Editor, Admin', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($curPermission == Essential_Grid_Admin::ROLE_AUTHOR) ? 'selected="selected" ' : '';?>value="author"><?php _e('Author, Editor, Admin', EG_TEXTDOMAIN); ?></option>
			</select>
		</div>
		<div class="esg-gs-tc">
		</div>
	</div>
	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('Advanced Tooltips', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="plugin_tooltips">
				<option <?php echo ($tooltips == 'true') ?  'selected="selected" ' : '';?>value="true"><?php _e('On', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($tooltips == 'false') ? 'selected="selected" ' : '';?>value="false"><?php _e('Off', EG_TEXTDOMAIN); ?></option>
			</select>
		</div>
		<div class="esg-gs-tc">		
			<i style=""><?php echo _e('Show or Hide the Tooltips on Hover over the Settings in Essential Grid Backend. ', EG_TEXTDOMAIN); ?></i>
		</div>
	</div>
	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('Wait for Fonts', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="wait_for_fonts">
				<option <?php echo ($wait_for_fonts == 'true') ?  'selected="selected" ' : '';?>value="true"><?php _e('On', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($wait_for_fonts == 'false') ? 'selected="selected" ' : '';?>value="false"><?php _e('Off', EG_TEXTDOMAIN); ?></option>
			</select>
		</div>
		<div class="esg-gs-tc">		
			<i style=""><?php echo _e('In case Option is enabled, the Grid will always wait till the Google Fonts has been loaded, before the grid starts.', EG_TEXTDOMAIN); ?></i>
		</div>
	</div>
	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('Output Filter Protection', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="output_protection">
				<option <?php echo ($output_protection == 'none') ?  'selected="selected" ' : '';?>value="none"><?php _e('None', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($output_protection == 'compress') ? 'selected="selected" ' : '';?>value="compress"><?php _e('By Compressing Output', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($output_protection == 'echo') ? 'selected="selected" ' : '';?>value="echo"><?php _e('By Echo Output', EG_TEXTDOMAIN); ?></option>
			</select>
		</div>
		<div class="esg-gs-tc">		
			<i style=""><?php echo _e('The HTML Markup is printed in compressed form, or it is written through Echo instead of Return. In some cases Echo will move the full Grid to the top/bottom of the page ! ', EG_TEXTDOMAIN); ?></i>				
		</div>
	</div>
	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('JS To Footer', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="js_to_footer">
				<option <?php echo ($js_to_footer == 'true') ?  'selected="selected" ' : '';?>value="true"><?php _e('On', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($js_to_footer == 'false') ? 'selected="selected" ' : '';?>value="false"><?php _e('Off', EG_TEXTDOMAIN); ?></option>
			</select>
		</div>
		<div class="esg-gs-tc">		
			<i style=""><?php echo _e('Defines where the jQuery files should be loaded in the DOM.', EG_TEXTDOMAIN); ?></i>				
		</div>
	</div>
	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('Select LightBox Type', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="use_lightbox">
				<option <?php echo ($use_lightbox == 'false') ? 'selected="selected" ' : '';?>value="false"><?php _e('Default LightBox', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($use_lightbox == 'jackbox') ?  'selected="selected" ' : '';?>value="jackbox" <?php echo ($jb_active === true) ? '' : ' disabled="disabled"'; ?>><?php _e('JackBox', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($use_lightbox == 'sg') ?  'selected="selected" ' : '';?>value="sg" <?php echo ($sg_active === true) ? '' : ' disabled="disabled"'; ?>><?php _e('Social Gallery', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($use_lightbox == 'disabled') ?  'selected="selected" ' : '';?>value="disabled"><?php _e('Disable LightBox', EG_TEXTDOMAIN); ?></option>
			</select>
		</div>
		<div class="esg-gs-tc">		
			<i style=""><?php echo _e('Select the default LightBox to be used.<br>- The JackBox WordPress plugin is available <a href="http://codecanyon.net/item/jackbox-responsive-lightbox-wordpress-plugin/3357551" target="_blank">here</a>,<br>- The Social Gallery plugin can be found <a href="http://codecanyon.net/item/social-gallery-wordpress-photo-viewer-plugin/2665332" target="_blank">here</a>', EG_TEXTDOMAIN); ?></i>				
		</div>
	</div>
	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('Convert WP Galleries', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="overwrite_gallery">
				<option <?php selected( $overwrite_gallery, 'off' , true ); ?> value="off"><?php _e('Off', EG_TEXTDOMAIN); ?></option>
				<?php 
					$grids = new Essential_Grid(); 
					$arrGrids = $grids->get_essential_grids(); 
					foreach($arrGrids as $grid){
						echo '<option value="'.$grid->handle.'" '. selected( $overwrite_gallery, $grid->handle, false ) .'>'. $grid->name . '</option>';
					}
				?>
			</select>
		</div>
		<div class="esg-gs-tc">		
			<i style=""><?php echo _e('If selected <strong>all</strong> original WordPress Galleries in the content will be displayed with Essential Grid. Select a grid in each gallery setting individually. Galleries with no grid setting will use this default grid.', EG_TEXTDOMAIN); ?></i>								 
		</div>
	</div>
	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('Use Own Caching System', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="use_cache">
				<option <?php echo ($use_cache == 'true') ?  'selected="selected" ' : '';?>value="true"><?php _e('On', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($use_cache == 'false') ? 'selected="selected" ' : '';?>value="false"><?php _e('Off', EG_TEXTDOMAIN); ?></option>
			</select>
			<span id="ess-grid-delete-cache" class="button-primary revblue"><?php echo _e('delete cache', EG_TEXTDOMAIN); ?></span>
		</div>
		<div class="esg-gs-tc">	
			<i style=""><?php  _e('Essential Grid has two caching engines. Primary cache will precache Post Queries to give a quicker result of queries. The internal engine will allow to cache the whole grid\'s HTML markup which will provide an extreme quick output. Cache should always be deleted after changes! Only for advanced users.', EG_TEXTDOMAIN); ?></i>								 
		</div>
	</div>
	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('Set Query Type Used', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="query_type">
				<option <?php echo ($query_type == 'wp_query') ?  'selected="selected" ' : '';?>value="wp_query"><?php _e('WP_Query()', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($query_type == 'get_posts') ? 'selected="selected" ' : '';?>value="get_posts"><?php _e('get_posts()', EG_TEXTDOMAIN); ?></option>
			</select>
		</div>
		<div class="esg-gs-tc">	
			<i style=""><?php echo _e('If this is changed, caching of Essential Grid may be required to be deleted!', EG_TEXTDOMAIN); ?></i>
		</div>
	</div>

	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('Enable Media Filter', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="enable_media_filter">
				<option <?php echo ($enable_media_filter == 'true') ?  'selected="selected" ' : '';?>value="true"><?php _e('On', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($enable_media_filter == 'false') ? 'selected="selected" ' : '';?>value="false"><?php _e('Off', EG_TEXTDOMAIN); ?></option>
			</select>
		</div>
		<div class="esg-gs-tc">	
			<i style=""><?php echo _e('This enables the media filters in the backend.', EG_TEXTDOMAIN); ?></i>								 
		</div>
	</div>
	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('Enable Debug Log', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="enable_log">
				<option <?php echo ($enable_log == 'true') ?  'selected="selected" ' : '';?>value="true"><?php _e('On', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($enable_log == 'false') ? 'selected="selected" ' : '';?>value="false"><?php _e('Off', EG_TEXTDOMAIN); ?></option>
			</select>
		</div>
		<div class="esg-gs-tc">	
			<i style=""><?php echo _e('This enables console logs for debugging purposes.', EG_TEXTDOMAIN); ?></i>								 
		</div>
	</div>
	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('Enable Example Custom Post Type', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="enable_custom_post_type" style="margin-bottom: 4px">
				<option <?php echo ($enable_custom_post_type == 'true') ?  'selected="selected" ' : '';?>value="true"><?php _e('On', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($enable_custom_post_type == 'false') ? 'selected="selected" ' : '';?>value="false"><?php _e('Off', EG_TEXTDOMAIN); ?></option>
			</select>
			<a style="display: none; margin-left: 10px !important" href="javascript:void(0);" class="button-primary revblue" id="esg-import-demo-posts">Import Full Demo Data</a>
		</div>
		<div class="esg-gs-tc">	
			<i style=""><?php echo _e('This enables the Ess. Grid Example Custom Post Type.<br>Needs page reload to take action.', EG_TEXTDOMAIN); ?></i>
		</div>
	</div>
	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('Enable Page/Post Options', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="enable_post_meta">
				<option <?php echo ($enable_post_meta == 'true') ?  'selected="selected" ' : '';?>value="true"><?php _e('On', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($enable_post_meta == 'false') ? 'selected="selected" ' : '';?>value="false"><?php _e('Off', EG_TEXTDOMAIN); ?></option>
			</select>
		</div>
		<div class="esg-gs-tc">	
			<i style=""><?php echo _e('This enables the post and page meta box options beneath the WordPress content editor pages.', EG_TEXTDOMAIN); ?></i>								 
		</div>
	</div>
	
	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('Global Default Image', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<img id="global_default_img-img" class="image-holder-wrap-div" src="<?php echo $global_default_src; ?>" style="display: <?php echo $display_global_img; ?>">
			<a class="button-primary revblue eg-global-add-image" href="javascript:void(0);" data-setto="global_default_img">Choose Image</a>
			<a class="button-primary revred eg-global-image-clear" href="javascript:void(0);" data-setto="global_default_img">Remove Image</a>
			<input type="hidden" id="global_default_img" name="global_default_img" value="<?php echo $global_default_img; ?>">
		</div>
		<div class="esg-gs-tc">	
			<i style=""><?php echo _e('Set an optional default global image to avoid possible blank grid items', EG_TEXTDOMAIN); ?></i>								 
		</div>
	</div>

	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('No Filter Match Message', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<input type=text name="no_filter_match_message" id="no_filter_match_message" value="<?php echo $no_filter_match_message; ?>">
		</div>
		<div class="esg-gs-tc">	
			<i style=""><?php echo _e('Normally filter selections would always return a result, but if you are using multiple Filter Groups with "AND" set for the Category Relation
this custom message will be displayed to the user.', EG_TEXTDOMAIN); ?></i>								 
		</div>
	</div>

	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('Enable YouTube NoCookie', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="enable_youtube_nocookie">
				<option <?php echo ($enable_youtube_nocookie == 'true') ?  'selected="selected" ' : '';?>value="true"><?php _e('On', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($enable_youtube_nocookie == 'false') ? 'selected="selected" ' : '';?>value="false"><?php _e('Off', EG_TEXTDOMAIN); ?></option>
			</select>
		</div>
		<div class="esg-gs-tc">	
			<i style=""><?php echo _e('This enables changing all YouTube embeds to the youtube-nocookie.com url to save no cookies.', EG_TEXTDOMAIN); ?></i>								 
		</div>
	</div>

	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('Enable Fontello Icons (Standard)', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="enable_fontello">
				<!--option <?php echo ($enable_fontello == 'false') ? 'selected="selected" ' : '';?> value="false"><?php _e('Off', EG_TEXTDOMAIN); ?></option-->
				<option <?php echo ($enable_fontello == 'backfront') ?  'selected="selected" ' : '';?> value="backfront"><?php _e('Backend+Frontend', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($enable_fontello == 'back') ?  'selected="selected" ' : '';?> value="back"><?php _e('Only Backend', EG_TEXTDOMAIN); ?></option>
			</select>
		</div>
		<div class="esg-gs-tc">	
			<i style=""><?php echo _e('This enables Fontello Icons for your Frontend and Backend or only Backend (if the font is already loaded on the frontend).', EG_TEXTDOMAIN); ?></i>								 
		</div>
	</div>

	<div class="esg-global-setting">
		<div class="esg-gs-tc">
			<label><?php echo _e('Enable Font-Awesome Icons', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="enable_font_awesome">
				<option <?php echo ($enable_font_awesome == 'false') ? 'selected="selected" ' : '';?> value="false"><?php _e('Off', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($enable_font_awesome == 'backfront') ?  'selected="selected" ' : '';?> value="backfront"><?php _e('Backend+Frontend', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($enable_font_awesome == 'back') ?  'selected="selected" ' : '';?> value="back"><?php _e('Only Backend', EG_TEXTDOMAIN); ?></option>
			</select>
		</div>
		<div class="esg-gs-tc">	
			<i style=""><?php echo _e('This enables Font Awesome Icons for your Frontend and Backend or only Backend (if the font is already loaded on the frontend).', EG_TEXTDOMAIN); ?></i>								 
		</div>
	</div>

	<div class="esg-global-setting last-egs">
		<div class="esg-gs-tc">
			<label><?php echo _e('Enable Stroke 7 Icons', EG_TEXTDOMAIN); ?>:</label>
		</div>
		<div class="esg-gs-tc">
			<select name="enable_pe7">
				<option <?php echo ($enable_pe7 == 'false') ? 'selected="selected" ' : '';?> value="false"><?php _e('Off', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($enable_pe7 == 'backfront') ?  'selected="selected" ' : '';?> value="backfront"><?php _e('Backend+Frontend', EG_TEXTDOMAIN); ?></option>
				<option <?php echo ($enable_pe7 == 'back') ?  'selected="selected" ' : '';?> value="back"><?php _e('Only Backend', EG_TEXTDOMAIN); ?></option>
			</select>
		</div>
		<div class="esg-gs-tc">	
			<i style=""><?php echo _e('This enables Stroke 7 Icons for your Frontend and Backend or only Backend (if the font is already loaded on the frontend).', EG_TEXTDOMAIN); ?></i>								 
		</div>
	</div>
	
	<?php
	do_action('essgrid_globalSettingsDialog', $data);
	?>
</div>
<p>
	<a id="eg-btn-save-global-settings" href="javascript:void(0);" class="button-primary revgreen"><i class="eg-icon-cog"></i><?php _e('Save Settings', EG_TEXTDOMAIN); ?></a>
</p>

<script type="text/javascript">
	AdminEssentials.initGlobalSettings();
</script>