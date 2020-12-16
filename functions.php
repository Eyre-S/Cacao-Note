<?php
	/**********************************************/
	/**                                          **/
	/**                Theme Meta                **/
	/**                                          **/
	/************************************************************/
	/**  !!!YOU SHOULD EDIT THE style.css AT THE SAME TIME!!!  **/
	/************************************************************/
	const CACAO_VERSION = '0.2.1';
	
	/**********************************************/
	/**                                          **/
	/**             Resources Loader             **/
	/**                                          **/
	/**********************************************/
	$css_list = array(
		"global",
		"global-function"
	);
	
	$js_list = array(
		"event"
	);
	
	function cacao_css (string $name) {
		global $css_list;
		array_push($css_list, $name);
	}
	
	function cacao_css_load () {
		global $css_list;
		foreach ($css_list as $i) {
			wp_enqueue_style($i, get_template_directory_uri()."/assets/css/$i.css");
		}
	}
	
	/** Unused Now **/
//	function cacao_js (string $name) {
//		global $js_list;
//		array_push($js_list, $name);
//	}
	
	function cacao_js_load () {
		global $js_list;
		foreach ($js_list as $i) {
			wp_enqueue_script($i, get_template_directory_uri()."/assets/js/$i.js");
		}
	}
	
	/**********************************************/
	/**                                          **/
	/**               Head & Title               **/
	/**                                          **/
	/**********************************************/
	///////////////////
	/// Home Title
	function cacao_customizer_register_home_title_vertical ($wp_customize) {
		$wp_customize->add_setting('cacao-home-title-vertical', array(
			'type' => 'theme_mod',
			'default' => false
		));
		$wp_customize->add_control('cacao-home-title-vertical', array(
			'label' => 'Show home page title vertically', // TODO lang
			'type' => 'checkbox',
			'priority' => 110,
			'section' => 'cacao-note'
		));
	}
	
	function cacao_is_home_title_vertical (): bool {
		return get_theme_mod('cacao-home-title-vertical');
	}
	
	function cacao_the_home_title () {
		echo "<h1>".get_bloginfo('name')."</h1>";
		echo "<p>".get_bloginfo('description')."</p>";
	}
	
	/**********************************************/
	/**                                          **/
	/**                  Footer                  **/
	/**                                          **/
	/**********************************************/
	function cacao_is_footer_null (): bool {
		return
			!cacao_copyright_exist() &&
			!cacao_is_display_footer_statement()
		;
	}
	
	///////////////////
	/// Copyright
	function cacao_customizer_register_copyright ($wp_customize) {
		$wp_customize->add_setting('cacao-footer', array(
			'type' => 'theme_mod',
			'default' => 'Cacao (C) Placeholder'
		));
		$wp_customize->add_control('cacao-footer', array(
			'label' => 'Footer Copyright', // TODO lang
			'type' => 'textarea',
			'priority' => 300,
			'section' => 'cacao-note'
		));
	}
	
	function cacao_get_the_copyright (): string {
		return get_theme_mod('cacao-footer', "Cacao (C) Placeholder");
	}
	
	function cacao_copyright_exist (): bool {
		if (cacao_get_the_copyright() == "") {
			return false;
		} else {
			return true;
		}
	}
	
	function cacao_the_copyright () {
		if (cacao_copyright_exist()) {
			echo '<p id="copyright" class="small-margin">'.cacao_get_the_copyright().'</p>';
		}
	}
	
	///////////////////
	/// Statement
	function cacao_customizer_register_footer_statement ($wp_customize) {
		$wp_customize->add_setting('cacao-footer-statement', array(
			'type' => 'theme_mod',
			'default' => true
		));
		$wp_customize->add_control('cacao-footer-statement', array(
			'label' => 'Display theme statement at the footer', // TODO lang
			'type' => 'checkbox',
			'priority' => 310,
			'section' => 'cacao-note'
		));
	}
	
	function cacao_is_display_footer_statement () {
		return get_theme_mod("cacao-footer-statement", true);
	}
	
	function cacao_the_footer_statement () {
		$CACAO_VERSION = CACAO_VERSION;
		echo "<p class=\"footer-statement small\">by theme Cacao Note - $CACAO_VERSION</p>";
	}
	
	/**********************************************/
	/**                                          **/
	/**                Post Type                 **/
	/**                                          **/
	/**********************************************/
	class CacaoPostType {
		const POST = 0;
		const NOTE_LIGHT = 1;
		const NOTE_DARK = 2;
		
		static function get_the_post_type (): int {
			$explode = explode(',', get_the_title());
			if ($explode[0] == "*note") {
				if ($explode[1] != null && $explode[1] == "dark") {
					return CacaoPostType::NOTE_DARK;
				} else {
					return CacaoPostType::NOTE_LIGHT;
				}
			} else {
				return CacaoPostType::POST;
			}
		}
		
		static function is_post (): bool {
			switch (self::get_the_post_type()) {
				case self::POST:
					return true;
				default:
					return false;
			}
		}
		
		static function is_note (): bool {
			switch (self::get_the_post_type()) {
				case self::NOTE_LIGHT:
				case self::NOTE_DARK:
					return true;
				default:
					return false;
			}
		}
		
		static function the_note_theme () {
			switch (self::get_the_post_type()) {
				case self::NOTE_LIGHT:
					echo "card-note-light";
					break;
				case self::NOTE_DARK:
					echo "card-note-dark";
					break;
				default:
					echo "card-note-unknown";
					break;
			}
		}
		
	}
	
	/**********************************************/
	/**                                          **/
	/**              Wordpress Hook              **/
	/**                                          **/
	/**********************************************/
	function cacao_customize_register($wp_customize) {
		$wp_customize->add_section( 'cacao-note', array(
			'title' => 'Cacao Note', // TODO lang
			'priority' => 90
		) );
		cacao_customizer_register_copyright($wp_customize);
		cacao_customizer_register_footer_statement($wp_customize);
		cacao_customizer_register_home_title_vertical($wp_customize);
	} add_action('customize_register', 'cacao_customize_register');
	