<?php
	/**********************************************/
	/**                                          **/
	/**                Theme Meta                **/
	/**                                          **/
	/************************************************************/
	/**  !!!YOU SHOULD EDIT THE style.css AT THE SAME TIME!!!  **/
	/************************************************************/
	/** CACAO NOTE 主题版本号 */
	const CACAO_VERSION = '0.4';
	const CACAO_DOMAIN = 'cacaonote';
	
	/**********************************************/
	/**                                          **/
	/**                Site Meta                 **/
	/**                                          **/
	/**********************************************/
	///////////////////
	/// Site Meta Info
	/**
	 * 获取“wp>>设置>>常规“中设置的站点标题
	 * @return string wp站点标题
	 */
	function cacao_blog_name (): string {
		return get_bloginfo('name');
	}
	
	/**
	 * 获取“wp>>设置>>常规“中设置的站点副标题
	 * @return string wp站点副标题
	 */
	function cacao_blog_description (): string {
		return get_bloginfo('description');
	}
	
	///////////////////
	/// HTML title
	/** 显示在浏览器标签页(或许是地址栏)的全标题 */
	$html_title = "N/A";
	
	/**
	 * 输出浏览器标签页全标题
	 * 标题格式将为 "{$title} {$connector} {$site_name}"
	 *     例如："404 - CacaoNote"
	 * 如果{$title}为空则浏览器标题只有"{$site_name}"
	 */
	function cacao_the_html_title () {
		global $html_title;
		echo $html_title;
	}
	
	/**
	 * 设置浏览器标签页标题的前半部分(也即为页面标题部分)
	 * 标题格式将为 "{$title} {$connector} {$site_name}"
	 *     例如："404 - CacaoNote"
	 * 如果{$title}为空则浏览器标题只有"{$site_name}"
	 * @param string $title
	 */
	function cacao_set_html_title (string $title = "") {
		global $html_title;
		if ($title == "") {
			$html_title = cacao_blog_name();
		} else {
			$html_title = $title." ".cacao_get_the_html_title_connector()." " . cacao_blog_name();
		}
	}
	
	/**
	 * 获取浏览器标签页的连接符{$connector}
	 * @return string $connector
	 */
	function cacao_get_the_html_title_connector (): string {
		return '-'; // TODO customize
	}
	
	/**********************************************/
	/**                                          **/
	/**             Resources Loader             **/
	/**                                          **/
	/**********************************************/
	/** Cacao Note Theme 需要加载的css列表 */
	$css_list = array(
		"global",
		"global-function"
	);
	
	/** Cacao Note Theme 需要加载的js列表 */
	$js_list = array(
		"event"
	);
	
	/**
	 * 将一个css文件添加到加载队列中
	 * 添加的文件将为"{$THEME_ROOT}/assets/css/{$name}.css"
	 * @param string $name css文件名
	 */
	function cacao_css (string $name) {
		global $css_list;
		array_push($css_list, $name);
	}
	
	/**
	 * 排队加载所有的 Cacao Note Theme 列表中的css文件
	 */
	function cacao_css_load () {
		global $css_list;
		foreach ($css_list as $i) {
			wp_enqueue_style($i, get_template_directory_uri()."/assets/css/$i.css");
		}
	}
	
	/**
	 * 将一个css文件添加到加载队列中
	 * 添加的文件将为"{$THEME_ROOT}/assets/js/{$name}.css"
	 * @param string $name js文件名
	 */
	function cacao_js (string $name) {
		global $js_list;
		array_push($js_list, $name);
	}
	
	/**
	 * 排队加载所有的 Cacao Note Theme 列表中的js文件
	 */
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
	/// Front Page Title
	/**
	 * 注册主页标题类的自定义选项
	 *  * `cacao-note-title-vertical` [xo] 决定首页标题是否以垂直模式书写显示
	 * @param $wp_customize WP_Customize_Manager Wordpress自定义对象
	 */
	function cacao_customizer_register_home_title_vertical (WP_Customize_Manager $wp_customize) {
		$wp_customize->add_setting('cacao-home-title-vertical', array(
			'type' => 'theme_mod',
			'default' => false
		));
		$wp_customize->add_control('cacao-home-title-vertical', array(
			'label' => __("Show home page title vertically", CACAO_DOMAIN),
			'type' => 'checkbox',
			'priority' => 110,
			'section' => 'cacao-note'
		));
	}
	
	/**
	 * 返回首页标题的书写模式
	 *  false 则横向(水平)书写
	 *  true 则竖向(垂直)书写
	 * @return bool 是否以垂直模式书写显示
	 */
	function cacao_is_home_title_vertical (): bool {
		return get_theme_mod('cacao-home-title-vertical');
	}
	
	/**
	 * 输出首页标题内容：
	 * <h1>{$site_name}</h1>
	 * <p>{$site_description}</p>
	 */
	function cacao_the_home_title () {
		echo "<h1>" .cacao_blog_name() . "</h1>";
		echo "<p>" .cacao_blog_description() . "</p>";
	}
	
	/**********************************************/
	/**                                          **/
	/**                  Footer                  **/
	/**                                          **/
	/**********************************************/
	/**
	 * 返回 footer 是否为空（没有内容），true则为空
	 * @return bool footer是否为空
	 */
	function cacao_is_footer_null (): bool {
		return
			!cacao_copyright_exist() &&
			!cacao_is_display_footer_statement()
		;
	}
	
	///////////////////
	/// Copyright
	/**
	 * 注册页脚版权位置文字的自定义选项
	 *  * `cacao-footer` [message_area] 页脚版权声明区域显示的内容文字
	 * @param $wp_customize WP_Customize_Manager Wordpress自定义对象
	 */
	function cacao_customizer_register_copyright (WP_Customize_Manager $wp_customize) {
		$wp_customize->add_setting('cacao-footer', array(
			'type' => 'theme_mod',
			'default' => 'Cacao (C) Placeholder'
		));
		$wp_customize->add_control('cacao-footer', array(
			'label' => __("Footer Copyright", CACAO_DOMAIN),
			'type' => 'textarea',
			'priority' => 300,
			'section' => 'cacao-note'
		));
	}
	
	/**
	 * 返回页脚版权声明文字
	 * @return string 页脚版权声明文字
	 */
	function cacao_get_the_copyright (): string {
		return get_theme_mod('cacao-footer', "Cacao (C) Placeholder");
	}
	
	/**
	 * @return bool 定义的页脚版权声明文字是否为空
	 */
	function cacao_copyright_exist (): bool {
		if (cacao_get_the_copyright() == "") {
			return false;
		} else {
			return true;
		}
	}
	
	/**
	 * 输出页脚版权声明文字段落
	 */
	function cacao_the_copyright () {
		if (cacao_copyright_exist()) {
			echo '<p id="copyright" class="small-margin">'.cacao_get_the_copyright().'</p>';
		}
	}
	
	///////////////////
	/// Statement
	/**
	 * 注册页脚主题状态的自定义选项
	 *  * `cacao-footer-statement` [xo] 决定页脚是否显示主题状态声明
	 * @param $wp_customize WP_Customize_Manager Wordpress自定义对象
	 */
	function cacao_customizer_register_footer_statement (WP_Customize_Manager $wp_customize) {
		$wp_customize->add_setting('cacao-footer-statement', array(
			'type' => 'theme_mod',
			'default' => true
		));
		$wp_customize->add_control('cacao-footer-statement', array(
			'label' => __("Display theme statement at the footer", CACAO_DOMAIN),
			'type' => 'checkbox',
			'priority' => 310,
			'section' => 'cacao-note'
		));
	}
	
	/**
	 * @return bool 是否显示页脚主题状态声明
	 */
	function cacao_is_display_footer_statement (): bool {
		return get_theme_mod("cacao-footer-statement", true);
	}
	
	/**
	 * 输出页脚主题状态声明
	 */
	function cacao_the_footer_statement () {
		$CACAO_VERSION = CACAO_VERSION;
		printf("<p class=\"footer-statement small\">".__("by theme Cacao Note - %s", CACAO_DOMAIN)."</p>", $CACAO_VERSION);
	}
	
	/**********************************************/
	/**                                          **/
	/**                Post Type                 **/
	/**                                          **/
	/**********************************************/
	/**
	 * Cacao自定义文章类型
	 *
	 * 用于从基础文章类型中分理出特殊的，
	 * 以`title`作为标识符的，Cacao Note 特殊类型文章：`note`
	 */
	class CacaoPostType {
		
		/** @var int 普通的文章 */
		const POST = 0;
		/** @var int 亮色note */
		const NOTE_LIGHT = 1;
		/** @var int 暗色note */
		const NOTE_DARK = 2;
		
		/**
		 * 获取当前文章的文章类型
		 * @return int 文章类型
		 */
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
		
		/**
		 * @return bool 当前是否为普通文章
		 */
		static function is_post (): bool {
			switch (self::get_the_post_type()) {
				case self::POST:
					return true;
				default:
					return false;
			}
		}
		
		/**
		 * @return bool 当前是否为 Cacao `note`
		 */
		static function is_note (): bool {
			switch (self::get_the_post_type()) {
				case self::NOTE_LIGHT:
				case self::NOTE_DARK:
					return true;
				default:
					return false;
			}
		}
		
		/**
		 * 输出 `note` 应该使用的配色模式css类
		 */
		static function the_note_theme () {
			switch (self::get_the_post_type()) {
				case self::NOTE_LIGHT:
					echo "light";
					break;
				case self::NOTE_DARK:
					echo "dark";
					break;
				default:
					echo "unknown";
					break;
			}
		}
		
	}
	
	/**********************************************/
	/**                                          **/
	/**             Cacao Page Part              **/
	/**                                          **/
	/**********************************************/
	function cacao_the_listing_card_post () {
		get_template_part("templates/listing-card-post");
	}
	
	function cacao_the_listing_card_note () {
		get_template_part("templates/listing-card-note");
	}
	
	function cacao_the_listing_card_unknown () {
		get_template_part("templates/listing-card-unknown");
	}
	
	/**
	 * 输出 WIP 模板
	 */
	function cacao_the_wip () {
		get_template_part('templates/wip');
	}
	
	/**********************************************/
	/**                                          **/
	/**              Wordpress Hook              **/
	/**                                          **/
	/**********************************************/
	/**
	 * 在此管理全部的 Cacao Note 所使用的自定义组件的注册
	 * @param WP_Customize_Manager $wp_customize Wordpress自定义对象
	 */
	function cacao_customize_register(WP_Customize_Manager $wp_customize) {
		$wp_customize->add_section( 'cacao-note', array(
			'title' => __("Cacao Note", CACAO_DOMAIN),
			'priority' => 90
		) );
		cacao_customizer_register_copyright($wp_customize);
		cacao_customizer_register_footer_statement($wp_customize);
		cacao_customizer_register_home_title_vertical($wp_customize);
	} add_action('customize_register', 'cacao_customize_register');
	
	/**
	 * 加载 Cacao Note 主题包自带的本地化文件
	 */
	function cacao_load_languages() {
		load_theme_textdomain(CACAO_DOMAIN, get_template_directory() . '/languages' );
	} add_action( 'after_setup_theme', 'cacao_load_languages' );
	