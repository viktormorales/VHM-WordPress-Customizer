<?php
class theme_Customize
{
	public static $panels;
	
	public function panels()
	{
		self::$panels = array(
			'about' => __('About', TEXTDOMAIN),
			'services' => __('Services', TEXTDOMAIN),
			'contact' => __('Contact', TEXTDOMAIN)
		);
		return self::$panels;
	}
	
	public static function register( $wp_customize )
	{
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
		
		// Add panels with sections, settings and controls
		foreach (self::panels() as $k => $v)
		{
			// Add panels
			$wp_customize->add_panel( $k . '_panel', array(
				'priority' => 100,
				'capability' => 'edit_theme_options',
				'theme_supports' => '',
				'title' => $v,
				'description' => __('Section settings', TEXTDOMAIN),
			));
			
		/**
		 * ADD DEFAULT BACKGROUND SECTION CONTROLS TO EACH PANEL
		 *
		 */
			$wp_customize->add_section($k . '_background', array(
				'priority' => 100,
				'title'    => __('Background', TEXTDOMAIN),
				'description' => __('Section settings', TEXTDOMAIN),
				'panel' => $k . '_panel'
			));
			
			// Section background color
			$wp_customize->add_setting($k . '_background_color', array(
				'sanitize_callback' => 'sanitize_hex_color',
				'transport' => 'postMessage'
			));
			$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, $k . '_background_color_control', array(
				'label'    => __('Background color', TEXTDOMAIN),
				'section'  => $k . '_background',
				'settings' => $k . '_background_color',
			)));
			
			// Section background image
			$wp_customize->add_setting($k . '_background_image', array(
				'default' => '',
				'transport' => 'postMessage'
			));
			$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, $k . '_background_image_control', array(
				'label'    => __('Background image', TEXTDOMAIN),
				'section'  => $k . '_background',
				'settings' => $k . '_background_image',
			)));
			
			// Section background image repeat
			$wp_customize->add_setting($k . '_background_repeat', array(
				'default' => 'no-repeat',
				'transport' => 'postMessage'
			));
			$wp_customize->add_control($k . '_background_repeat_control', array(
				'label'      => __('Background repeat', TEXTDOMAIN),
				'section'    => $k . '_background',
				'settings'   => $k . '_background_repeat',
				'type'       => 'radio',
				'choices'    => array(
					'no-repeat' => __('No repeat', TEXTDOMAIN),
					'repeat' => __('Repeat', TEXTDOMAIN),
					'repeat-x' => __('Vertical', TEXTDOMAIN),
					'repeat-y' => __('Horizontal', TEXTDOMAIN),
				),
			));
			
			// Section background image position
			$wp_customize->add_setting($k . '_background_position', array(
				'default'        => 'left',
				'transport' => 'postMessage'
			));
			$wp_customize->add_control($k . '_background_position_control', array(
				'label'      => __('Background position', TEXTDOMAIN),
				'section'    => $k . '_background',
				'settings'   => $k . '_background_position',
				'type'       => 'radio',
				'choices'    => array(
					'left' => __('Left', TEXTDOMAIN),
					'center' => __('Center', TEXTDOMAIN),
					'right' => __('Right', TEXTDOMAIN)
				),
			));
			
			// Section background image attachment
			$wp_customize->add_setting($k . '_background_attachment', array(
				'default'        => 'scroll',
				'transport' => 'postMessage'
			));
			$wp_customize->add_control($k . '_background_attachment_control', array(
				'label'      => __('Background attachment', TEXTDOMAIN),
				'section'    => $k . '_background',
				'settings'   => $k . '_background_attachment',
				'type'       => 'radio',
				'choices'    => array(
					'scroll' => __('Scroll', TEXTDOMAIN),
					'fixed' => __('Fixed', TEXTDOMAIN)
				),
			));
			
			// Section background image size
			$wp_customize->add_setting($k . '_background_cover', array(
			));
			$wp_customize->add_control($k . '_background_cover_control', array(
				'settings' => $k . '_background_cover',
				'label'    => __('Cover?', TEXTDOMAIN),
				'section'  => $k . '_background',
				'type'     => 'checkbox',
			));
			
		/**
		 * ADD DEFAULT CONTENT SECTION CONTROLS TO EACH PANELS
		 *
		 */
			$wp_customize->add_section($k . '_content', array(
				'priority' => 100,
				'title'    => __('Content', TEXTDOMAIN),
				'description' => 'Section settings',
				'panel' => $k . '_panel'
			));
			
			// Main title
			$wp_customize->add_setting($k . '_main_title', array(
				'default' => $v,
				'transport' => 'postMessage'
			));
			$wp_customize->add_control($k . '_main_title_control', array(
				'label'      => __('Main title', TEXTDOMAIN),
				'section'    => $k . '_content',
				'settings'   => $k . '_main_title',
			));
			// Text color
			$wp_customize->add_setting($k . '_text_color', array(
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'	 => 'postMessage'
			));
			$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, $k . '_text_color_control', array(
				'label'    => __('Text color', TEXTDOMAIN),
				'section'  => $k . '_content',
				'settings' => $k . '_text_color',
			)));
			
			$wp_customize->add_setting($k . '_template', array(
				'transport' => 'postMessage'
			));
			$wp_customize->add_control($k . '_template_control', array(
				'label' => __('Template', TEXTDOMAIN),
				'description' => __('HTML code allowed', TEXTDOMAIN),
				'section' => $k . '_content',
				'settings' => $k . '_template',
				'type' => 'textarea'
			));
		}
		
	/**
	 * COLORS SECTION
	 *
	 */
		// Home background color
		$wp_customize->add_setting('home_background_color', array(
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage'
		));
		$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'home_background_color_control', array(
			'label'    => __('Home background color', TEXTDOMAIN),
			'section'  => 'colors',
			'settings' => 'home_background_color',
		)));
		
	/**
	 * BACKGROUND IMAGE SECTION
	 */
		// Home background image
		$wp_customize->add_setting('home_background_image', array(
			'default' => ''
		));
		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'home_background_image_control', array(
			'label'    => __('Home background image', TEXTDOMAIN),
			'section'  => 'background_image',
			'settings' => 'home_background_image',
		)));
		if (get_theme_mod('home_background_image'))
		{
			// Home background image repeat
			$wp_customize->add_setting('home_background_repeat', array(
				'default' => 'no-repeat'
			));
			$wp_customize->add_control('home_background_repeat_control', array(
				'label'      => __('Background repeat', TEXTDOMAIN),
				'section'    => 'background_image',
				'settings'   => 'home_background_repeat',
				'type'       => 'radio',
				'choices'    => array(
					'no-repeat' => __('No repeat', TEXTDOMAIN),
					'repeat' => __('Repeat', TEXTDOMAIN),
					'repeat-x' => __('Vertical', TEXTDOMAIN),
					'repeat-y' => __('Horizontal', TEXTDOMAIN),
				),
			));
			// Home background image position
			$wp_customize->add_setting('home_background_position', array(
				'default'        => 'left',
			));
			$wp_customize->add_control('home_background_position_control', array(
				'label'      => __('Background position', TEXTDOMAIN),
				'section'    => 'background_image',
				'settings'   => 'home_background_position',
				'type'       => 'radio',
				'choices'    => array(
					'left' => __('Left', TEXTDOMAIN),
					'center' => __('Center', TEXTDOMAIN),
					'right' => __('Right', TEXTDOMAIN)
				),
			));
			// Home background image attachment
			$wp_customize->add_setting('home_background_attachment', array(
				'default'        => 'scroll'
			));
			$wp_customize->add_control('home_background_attachment_control', array(
				'label'      => __('Background attachment', TEXTDOMAIN),
				'section'    => 'background_image',
				'settings'   => 'home_background_attachment',
				'type'       => 'radio',
				'choices'    => array(
					'scroll' => __('Scroll', TEXTDOMAIN),
					'fixed' => __('Fixed', TEXTDOMAIN)
				),
			));
			// Home background image size
			$wp_customize->add_setting('home_background_cover', array(
			));
			$wp_customize->add_control('home_background_cover_control', array(
				'settings' => 'home_background_cover',
				'label'    => __('Cover?', TEXTDOMAIN),
				'section'  => 'background_image',
				'type'     => 'checkbox',
			));
		}
	}
	
	public static function live_preview()
	{
		wp_enqueue_script('theme-customizer',get_template_directory_uri() . '/js/theme-customizer.js',array( 'jquery','customize-preview' ), mktime(), true );
		wp_localize_script( 'theme-customizer', 'customizer_var', array(
			'panels' => self::panels(),
			)
		);
	}
	
	public function wp_head()
	{
		global $head_panels;
		echo '<style type="text/css">';
		echo 'body.home {';
		self::generate_css('background-color:', 'home_background_color');
		echo '}';
		echo '#primary {';
		self::generate_css('color:#', 'header_textcolor');
		echo '}';
		
		foreach (self::panels() as $k => $v)
		{			
			echo 'section#' . $k . '{';
			self::generate_css('background-color:', $k . '_background_color');
			self::generate_css('background-image:url(', $k . '_background_image', ');');
			self::generate_css('background-position:top ', $k . '_background_position');
			self::generate_css('background-attachment:', $k . '_background_attachment');
			self::generate_css('color:', $k . '_text_color');
			echo '}';
		}
		echo '</style>';
	}
	
	public static function generate_css( $prefix, $mod_name, $postfix=';', $echo=true ) {
		$return = '';
		$mod = get_theme_mod($mod_name);
		if ( ! empty( $mod ) ) {
			$return = sprintf('%s', $prefix.$mod.$postfix );
			if ( $echo ) {
				echo $return;
			}
		}
		return $return;
	}
}

add_action( 'customize_register', array('theme_Customize', 'register') );
add_action('wp_head', array('theme_Customize', 'wp_head') );
add_action( 'customize_preview_init', array('theme_Customize', 'live_preview') );