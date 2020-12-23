<?php
/**
 * Theme customizer: Custom controls
 *
 * @package WordPress
 * @subpackage HOVEREX
 * @since HOVEREX 1.0.31
 */


// 'info' field
//--------------------------------------------------------------------
class Hoverex_Customize_Info_Control extends WP_Customize_Control {
	public $type = 'info';

	public function render_content() {
		?><div class="customize-control-wrap"><?php
		if (!empty($this->label)) {
			?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
		}
		if (!empty($this->description)) {
			?><span class="customize-control-description description"><?php hoverex_show_layout( $this->description ); ?></span><?php
		}
		?></div><?php
	}
}


// 'hidden' field
//--------------------------------------------------------------------
class Hoverex_Customize_Hidden_Control extends WP_Customize_Control {
	public $type = 'hidden';

	public function render_content() {
		?><input type="hidden" name="_customize-hidden-<?php echo esc_attr($this->id); ?>" <?php $this->link(); ?> value=""><?php
		// We need to fire action 'admin_print_footer_scripts' if this is a last option
		if ($this->id=='last_option' && hoverex_storage_get('need_footer_scripts', false)) {
			hoverex_storage_set('need_footer_scripts', false);
			do_action( 'admin_print_footer_scripts' );
		}
	}
}


// 'button' field
//--------------------------------------------------------------------
class Hoverex_Customize_Button_Control extends WP_Customize_Control {
	public $type = 'button';

	public function render_content() {
		?><div class="customize-control-wrap"><?php
		if (!empty($this->label)) {
			?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
		}
		if (!empty($this->description)) {
			?><span class="customize-control-description description"><?php hoverex_show_layout( $this->description ); ?></span><?php
		}
		if (!empty($this->input_attrs['link'])) {
			?><a href="<?php echo esc_url($this->input_attrs['link']); ?>" target="_blank"<?php
				if (!empty($this->input_attrs['class'])) {
					echo ' class="'.esc_attr($this->input_attrs['class']).'"';
				}
			?>><?php
				echo esc_html($this->input_attrs['caption']);
			?></a><?php
		} else if (!empty($this->input_attrs['action'])) {
			?><input type="button" class="<?php
				if (!empty($this->input_attrs['class'])) {
					echo ' '.esc_attr($this->input_attrs['class']);
				}
				?>" 
				name="_customize-button-<?php echo esc_attr($this->id); ?>" 
				value="<?php echo esc_attr($this->input_attrs['caption']); ?>"
				data-action="<?php echo esc_attr($this->input_attrs['action']); ?>"><?php
		}
		?></div><?php
	}
}


// 'switch' field
//--------------------------------------------------------------------
class Hoverex_Customize_Switch_Control extends WP_Customize_Control {
	public $type = 'switch';

	public function render_content() {
		?><div class="customize-control-wrap"><?php
		if (!empty($this->label)) {
			?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
		}
		if (!empty($this->description)) {
			?><span class="customize-control-description description"><?php hoverex_show_layout( $this->description ); ?></span><?php
		}
		if (is_array($this->choices) && count($this->choices)>0) {
			foreach ($this->choices as $k=>$v) {
				?><label><input type="radio" name="_customize-radio-<?php echo esc_attr($this->id); ?>" <?php
								$this->link();
								if ($k == $this->input_attrs['value']) echo ' checked="checked"';
								?> value="<?php echo esc_attr($k); ?>">
				<?php echo esc_html($v); ?></label><?php
			}
		}
		?></div><?php
	}
}


// 'icon' field
//--------------------------------------------------------------------
class Hoverex_Customize_Icon_Control extends WP_Customize_Control {
	public $type = 'icon';

	public function render_content() {
		?><div class="customize-control-wrap"><?php
		if (!empty($this->label)) {
			?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
		}
		if (!empty($this->description)) {
			?><span class="customize-control-description description"><?php hoverex_show_layout( $this->description ); ?></span><?php
		}
		?><span class="customize-control-field-wrap"><input type="text" <?php $this->link(); ?> /><?php
		hoverex_show_layout(hoverex_show_custom_field('_customize-icon-selector-'.esc_attr($this->id),
													array(
														'type'	 => 'icons',
														'button' => true,
														'icons'	 => true
													),
													$this->input_attrs['value']
													)
							);
		?></span></div><?php
	}
}


// 'checklist' field
//--------------------------------------------------------------------
class Hoverex_Customize_Checklist_Control extends WP_Customize_Control {
	public $type = 'checklist';

	public function render_content() {
		?><div class="customize-control-wrap"><?php
		if (!empty($this->label)) {
			?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
		}
		if (!empty($this->description)) {
			?><span class="customize-control-description description"><?php hoverex_show_layout( $this->description ); ?></span><?php
		}
		?><span class="customize-control-field-wrap"><input type="hidden" <?php $this->link(); ?> /><?php
		hoverex_show_layout(hoverex_show_custom_field('_customize-checklist-'.esc_attr($this->id),
													array_merge($this->input_attrs, array(
														'options' => $this->choices,
													)),
													$this->input_attrs['value']
													)
							);
		?></span></div><?php
	}
}


// 'scheme_editor' field
//--------------------------------------------------------------------
class Hoverex_Customize_Scheme_Editor_Control extends WP_Customize_Control {
	public $type = 'scheme_editor';

	public function render_content() {
		?><div class="customize-control-wrap"><?php
		if (!empty($this->label)) {
			?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
		}
		if (!empty($this->description)) {
			?><span class="customize-control-description description"><?php hoverex_show_layout( $this->description ); ?></span><?php
		}
		?><span class="customize-control-field-wrap"><input type="hidden" <?php $this->link(); ?> /><?php
		hoverex_show_layout(hoverex_show_custom_field('_customize-scheme-editor-'.esc_attr($this->id),
													$this->input_attrs,
													hoverex_unserialize($this->input_attrs['value'])
													)
							);
		?></span></div><?php
	}
}


// 'text_editor' field
//--------------------------------------------------------------------
class Hoverex_Customize_Text_Editor_Control extends WP_Customize_Control {
	public $type = 'text_editor';

	public function render_content() {
		?><div class="customize-control-wrap"><?php
		if (!empty($this->label)) {
			?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
		}
		if (!empty($this->description)) {
			?><span class="customize-control-description description"><?php hoverex_show_layout( $this->description ); ?></span><?php
		}
		?><span class="customize-control-field-wrap"><?php
		?><input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea($this->value()); ?>" /><?php
		hoverex_show_layout(hoverex_show_custom_field('_customize-text-editor-'.esc_attr($this->id),
			$this->input_attrs,
			$this->input_attrs['value']
			)
		);
		?></span></div><?php
		// We need to fire action 'admin_print_footer_scripts' when the last option is render
		hoverex_storage_set('need_footer_scripts', true);
	}
}



// 'range' field
//--------------------------------------------------------------------
class HoverexCustomize_Range_Control extends WP_Customize_Control {
	public $type = 'range';

	public function render_content() {
		$show_value = !isset($this->input_attrs['show_value']) || $this->input_attrs['show_value'];
		?><div class="customize-control-wrap"><?php
		if (!empty($this->label)) {
			?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
		}
		if (!empty($this->description)) {
			?><span class="customize-control-description description"><?php hoverex_show_layout( $this->description ); ?></span><?php
		}
		?><span class="customize-control-field-wrap"><input type="<?php echo !$show_value ? 'hidden' : 'text'; ?>" <?php 
			$this->link();
			if ($show_value) echo ' class="hoverex_range_slider_value"';
		?> /><?php
		hoverex_show_layout(hoverex_show_custom_field('_customize-range-'.esc_attr($this->id),
													$this->input_attrs,
													$this->input_attrs['value']
													)
							);
		?></span></div><?php
	}
}
?>