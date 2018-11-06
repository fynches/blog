<?php
/**
 * mediumish Theme Customizer.
 *
 * @package mediumish
 */


 if ( class_exists( 'Kirki_Fonts_Google' ) ) {
	 Kirki_Fonts_Google::$force_load_all_variants = true;
 }

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mediumish_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'mediumish_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mediumish_customize_preview_js() {
	wp_enqueue_script( 'mediumish_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'mediumish_customize_preview_js' );

/**
 * Add the theme configuration
 */
Mediumish_Kirki::add_config( 'mediumish_theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );


Mediumish_Kirki::add_panel( 'mainthemepanel_mediumish', array(
    'priority'    => 10,
    'title'       => __( 'Mediumish Theme', 'mediumish' ),
    'description' => __( 'Mediumish Theme Options', 'mediumish' ),
) );

//-----------------------------------------------------
// SECTION: COLOR SCHEMES
//-----------------------------------------------------

Mediumish_Kirki::add_section( 'section_colorschemes', array(
    'title'      => esc_attr__( 'Color Scheme', 'mediumish' ),
    'priority'   => 2,
    'capability' => 'edit_theme_options',
    'panel'          => 'mainthemepanel_mediumish', // Not typically needed.
) );

/**
 * Slider Button Colour
 */

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_sliderbutton',
	'label'       => esc_attr__( 'Slider Button', 'mediumish' ),
	'section'     => 'section_colorschemes',
	'priority'    => 10,
	'default'     => '#1C9963',
    'output' => array(      
		array(
			'element'  => '.btn-simple',
			'property' => 'background-color',
		),
		array(
			'element'  => '.btn-simple',
			'property' => 'border-color',
		),
	),
) );

/**
 * Article Links Color
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_articlelinks_color',
	'label'       => esc_attr__( 'Article Links', 'mediumish' ),
	'section'     => 'section_colorschemes',
	'priority'    => 10,
	'default'     => '#1C9963',
    'output' => array(
        array(
			'element'  => '.prevnextlinks a, .article-post a, .post .btn.follow, .post .post-top-meta .author-description a, article.page a, .alertbar a',
			'property' => 'color',
		),
        array(
			'element'  => '.post .btn.follow, .alertbar input[type="submit"]',
			'property' => 'border-color',
		),
	),
) );

/**
 * Blockquotes Border Colour
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_blockquote_border_color',
	'label'       => esc_attr__( 'Blockquote Border', 'mediumish' ),
	'section'     => 'section_colorschemes',
	'priority'    => 10,
	'default'     => '#1C9963',
    'output' => array(
		array(
			'element'  => 'blockquote',
			'property' => 'border-color',
		),
	),
) );


/**
 * Button BG Color
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_submitbutton_color',
	'label'       => esc_attr__( 'Submit Button', 'mediumish' ),
	'section'     => 'section_colorschemes',
	'priority'    => 10,
	'default'     => '#1C9963',
    'output' => array(
        array(
			'element'  => '.entry-content input[type=submit], .alertbar input[type="submit"]',
			'property' => 'background-color',
		),
        array(
			'element'  => '.entry-content input[type=submit], .alertbar input[type="submit"]',
			'property' => 'border-color',
		),
	),
) );

/**
 * Button BG Color
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_submitbutton_color',
	'label'       => esc_attr__( 'Submit Button', 'mediumish' ),
	'section'     => 'section_colorschemes',
	'priority'    => 10,
	'default'     => '#1C9963',
    'output' => array(
        array(
			'element'  => '.entry-content input[type=submit], .alertbar input[type="submit"]',
			'property' => 'background-color',
		),
        array(
			'element'  => '.entry-content input[type=submit], .alertbar input[type="submit"]',
			'property' => 'border-color',
		),
	),
) );

/**
 * Social Title Color
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_share_color_title',
	'label'       => esc_attr__( 'Share Title', 'mediumish' ),
	'section'     => 'section_colorschemes',
	'priority'    => 10,
	'default'     => '#999999',
    'output' => array(        
        array(
			'element'  => 'p.sharecolour',
			'property' => 'color',
		),
	),
) );

/**
 * Social Icon Color
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_share_color',
	'label'       => esc_attr__( 'Share Icons', 'mediumish' ),
	'section'     => 'section_colorschemes',
	'priority'    => 10,
	'default'     => '#b3b3b3',
    'output' => array(
        array(
			'element'  => '.shareitnow ul li a svg, .shareitnow a',
			'property' => 'fill',
		),
        array(
			'element'  => '.shareitnow li a',
			'property' => 'color',
		),
	),
) );

/**
 * Social Icon Color
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_share_color_border',
	'label'       => esc_attr__( 'Share Icons Border', 'mediumish' ),
	'section'     => 'section_colorschemes',
	'priority'    => 10,
	'default'     => '#d2d2d2',
    'output' => array(
        array(
			'element'  => '.shareitnow li a',
			'property' => 'border-color',
		),
	),
) );

/**
 * Comment Accent Colour
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_comments_accentcolor',
	'label'       => esc_attr__( 'Comments Accent Color', 'mediumish' ),
	'section'     => 'section_colorschemes',
	'priority'    => 10,
	'default'     => '#1C9963',
    'output' => array(
        array(
			'element'  => '#comments a',
			'property' => 'color',
		),
		array(
			'element'  => '.comment-form input.submit',
			'property' => 'background-color',
		),
		array(
			'element'  => '.comment-form input.submit',
			'property' => 'border-color',
		),
	),
) );


/**
 * Footer Links Color
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_footerlinks_color',
	'label'       => esc_attr__( 'Footer Links', 'mediumish' ),
	'section'     => 'section_colorschemes',
	'priority'    => 10,
	'default'     => '#1C9963',
    'output' => array(
        array(
			'element'  => 'footer.footer a',
			'property' => 'color',
		),
	),
) );

/**
 * Instruction
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'custom',
	'settings'    => 'mediumish_instruction_colorschemes',
	'label'       => esc_attr__( 'More options', 'mediumish' ),
	'section'     => 'section_colorschemes',
	'priority'    => 10,
	'default'     => 'Navigate back and select Header & Logo Area section if you want to customize the header color.',    
) );

//-----------------------------------------------------
// SECTION: TYPOGRAPHY
//-----------------------------------------------------
Mediumish_Kirki::add_section( 'typography', array(
	'title'      => esc_attr__( 'Typography', 'mediumish' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
  'panel'          => 'mainthemepanel_mediumish', // Not typically needed.
) );

/**
 * Add the body-typography control
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'typography',
	'settings'    => 'body_typography',
	'label'       => esc_attr__( 'Body Typography', 'mediumish' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'PT Sans',
		'variant'        => '400',
		'font-size'      => '15px',
		'line-height'    => '1.5',
		'color'          => '#666666',
	),
	'output' => array(
		array(
			'element' => array('body', '.carousel-excerpt .fontlight'),
		),
	),
) );


/**
 * Header Typograf
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'typography',
	'settings'    => 'headers_typography',
	'label'       => esc_attr__( 'Headers', 'mediumish' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'PT Sans',
		'variant'        => '700',
		'color'          => '#111111',
	),
	'output' => array(
		array(
			'element' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.h1', '.h2', '.h3', '.h4', '.h5', '.h6' ),
		),
	),
) );


/**
 * Slider
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'typography',
	'settings'    => 'slidertitle_typography',
	'label'       => esc_attr__( 'Slider Title', 'mediumish' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'PT Sans',
		'variant'        => '700',
		'font-size'      => '30px',
		'color'          => '#ffffff',
        'text-transform' => 'none',
    'letter-spacing' => '0',
	),
	'output' => array(
		array(
			'element' => array( '.carousel-excerpt .title'),
		),
	),
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'typography',
	'settings'    => 'sliderdescription_typography',
	'label'       => esc_attr__( 'Slider Description', 'mediumish' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'variant'        => '400',
		'font-size'      => '18px',
		'color'          => '#ffffff',
    'letter-spacing' => '0',
	),
	'output' => array(
		array(
			'element' => array( '.carousel-excerpt .fontlight'),
		),
	),
) );


/**
 * Add the logo-typography control
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'typography',
	'settings'    => 'logo_typography',
	'label'       => esc_attr__( 'Logo', 'mediumish' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'Merriweather',
		'variant'        => '700',
		'font-size'      => '26px',
		'letter-spacing' => '0',
	),
	'output' => array(
		array(
			'element' => array( '.mediumnavigation .navbar-brand'),
		),
	),
) );


/**
 * Add the menu_typography control
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'typography',
	'settings'    => 'menu_typography',
	'label'       => esc_attr__( 'Menu', 'mediumish' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'PT Sans',
		'variant'        => '400',
	),
	'output' => array(
		array(
			'element' => array( '.navbar-toggleable-md .navbar-collapse' ),
		),
	),
) );


/**
 * Article Typography
 */
Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'typography',
	'settings'    => 'singlearticle_typography',
	'label'       => esc_attr__( 'Article', 'mediumish' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
        'font-family'    => 'Merriweather',
		'variant'        => '400',
		'line-height'    => '1.8',
		'color'          => '#222222',
        
	),
	'output' => array(
		array(
      	'element' => array( '.article-post'),
		),
	),
) );


//-----------------------------------------------------
// SECTION: Logo & Header Area
//-----------------------------------------------------

/**
 * sectionlogonav Logo
 */

Mediumish_Kirki::add_section( 'sectionlogonav', array(
	'title'      => esc_attr__( 'Logo & Header Area', 'mediumish' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
    'panel'          => 'mainthemepanel_mediumish', // Not typically needed.
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'image',
	'settings'    => 'logo_sectionlogonav',
	'label'       => esc_html__( 'Logo', 'mediumish' ),
  'description'     => 'Maximum recommended px size: 200x60',
	'section'     => 'sectionlogonav',
	'priority'    => 10,
  'transport' => 'auto',
	'default'     => '',
) );

/**
 * sectionlogonav Header Bg Color
 */

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'bg_navbgcolor',
	'label'       => esc_attr__( 'Header Background Color', 'mediumish' ),
	'section'     => 'sectionlogonav',
	'priority'    => 10,
	'default'     => 'rgba(255,255,255,.97)',
    'output' => array(
		          array(
                     'element'  => '.mediumnavigation, .dropdown-menu, .dropdown-item',
			         'property' => 'background-color',
		          ),
                array(
                     'element'  => '.navbar-collapse',
			         'property' => 'background-color',
                     'media_query'=> '@media (max-width: 767px)',
		          ),

        ),
) );



Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_headertextcolor',
	'label'       => esc_attr__( 'Header Text Color', 'mediumish' ),
	'section'     => 'sectionlogonav',
	'priority'    => 10,
	'default'     => '#999999',
    'output' => array(
		          array(
                     'element'  => '.mediumnavigation, .mediumnavigation a, .navbar-light .navbar-nav .nav-link',
			         'property' => 'color',
		          ),

        ),
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_logotextcolor',
	'label'       => esc_attr__( 'Site Title Text Color', 'mediumish' ),
    'description' => esc_attr__( 'If you don\'t use a logo', 'mediumish' ),
	'section'     => 'sectionlogonav',
	'priority'    => 10,
	'default'     => '#111111',
    'output' => array(
		          array(
                     'element'  => '.navbar-light .navbar-brand',
			         'property' => 'color',
		          ),
        ),
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_logohovercolor',
	'label'       => esc_attr__( 'Site title Hover Color', 'mediumish' ),
    'description' => esc_attr__( 'If you don\'t use a logo', 'mediumish' ),
	'section'     => 'sectionlogonav',
	'priority'    => 10,
	'default'     => '#02b875',
    'output' => array(
		          array(
                     'element'  => '.navbar-light .navbar-brand:hover',
			         'property' => 'color',
		          ),
        ),
) );

/**
 * sectionlogonav Header social
 */

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'url',
	'settings'    => 'mediumish_headertwitterlink',
	'label'       => esc_attr__( 'Twitter Link', 'mediumish' ),
    'description' => __( 'Leave blank to disable', 'mediumish' ),
	'section'     => 'sectionlogonav',
	'priority'    => 10,
	'default'     => 'https://twitter.com/wowthemesnet',
    
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_headertwittercolor',
	'label'       => esc_attr__( 'Twitter Button Color', 'mediumish' ),
	'section'     => 'sectionlogonav',
	'priority'    => 10,
	'default'     => '#02B875',
    'output' => array(
		array(
			'element'  => '.customarea .btn.follow',
			'property' => 'border-color',
		),
		array(
			'element'  => '.customarea .btn.follow',
			'property' => 'color',
		),
	),
    
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'repeater',
	'label'       => esc_attr__( 'Custom social link', 'mediumish' ),
	'section'     => 'sectionlogonav',
	'priority'    => 10,
	'row_label' => array(
		'type' => 'text',
		'value' => esc_attr__('Social Link', 'mediumish' ),
	),
	'settings'    => 'mediumish_headersociallink',
    'default'     => array(
        array(
            'social_icon' => esc_attr__( 'youtube', 'mediumish' ),
            'social_url'  => 'https://www.youtube.com/',
        ),
        array(
            'social_icon' => esc_attr__( 'facebook', 'mediumish' ),
            'social_url'  => 'https://facebook.com/wowthemesnet/',
        ),
    ),
    'fields' => array(
        'social_icon' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Social Icon Keyword', 'mediumish' ),
            'description' => esc_attr__( 'Enter Font Awesome keywords for social icons such as facebook, youtube etc. For more social keywords see the Font Awesome icon list.', 'mediumish' ),
            'default'     => '',
        ),
        'social_url' => array(
            'type'        => 'text',
            'label'       => esc_attr__( 'Social Link URL', 'mediumish' ),
            'description' => esc_attr__( 'Enter the corresponding Link URL. Link opens in new tab.', 'mediumish' ),
            'default'     => '',
        ),
    )
) );


/**
 * sectionlogonav Header Search
 */

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
    'settings'    => 'mediumish_headersearch_active',
    'label'       => esc_attr__( 'Disable search in header', 'mediumish' ),
    'section'     => 'sectionlogonav',
    'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_headersearchcolor',
	'label'       => esc_attr__( 'Search Button Color', 'mediumish' ),
	'section'     => 'sectionlogonav',
	'priority'    => 10,
	'default'     => '#02B875',
    'output' => array(
		array(
			'element'  => '.search-form .search-submit',
			'property' => 'background-color',
		),
	),
    'active_callback' => [['setting' => 'mediumish_headersearch_active','operator' => '==','value' => 0]],
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_headersearchcolor_border',
	'label'       => esc_attr__( 'Search Border Color', 'mediumish' ),
	'section'     => 'sectionlogonav',
	'priority'    => 10,
	'default'     => '#f9f9f9',
    'output' => array(
		array(
			'element'  => '.search-form .search-field',
			'property' => 'border-color',
		),
	),
    'active_callback' => [['setting' => 'mediumish_headersearch_active','operator' => '==','value' => 0]],
) );


Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_headersearchcolor_icon',
	'label'       => esc_attr__( 'Search Button Icon Color', 'mediumish' ),
	'section'     => 'sectionlogonav',
	'priority'    => 10,
	'default'     => '#ffffff',
    'output' => array(
		array(
			'element'  => '.search-form .search-submit .fa',
			'property' => 'color',
		),
	),
    'active_callback' => [['setting' => 'mediumish_headersearch_active','operator' => '==','value' => 0]],
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'mediumish_headersearchcolor_placeholder',
	'label'       => esc_attr__( 'Search Placeholder Color', 'mediumish' ),
	'section'     => 'sectionlogonav',
	'priority'    => 10,
	'default'     => '#b2b2b2',
    'output' => array(
		array(
			'element'  => '.search-form .search-field, .search-form .search-field::placeholder',
			'property' => 'color',
		),
	),
    'active_callback' => [['setting' => 'mediumish_headersearch_active','operator' => '==','value' => 0]],
) );


//-----------------------------------------------------
// SECTION: Home
//-----------------------------------------------------

/**
 * sectionhome Slider
 */

Mediumish_Kirki::add_section( 'sectionhome', array(
	'title'      => esc_attr__( 'Home', 'mediumish' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
    'panel'          => 'mainthemepanel_mediumish', // Not typically needed.
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
    'settings'    => 'mediumish_homeslider_active',
    'label'       => esc_attr__( 'Disable home slider', 'mediumish' ),
    'section'     => 'sectionhome',
    'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'select',
	'settings'    => 'mediumish_option_homeslider',
	'label'       => esc_attr__( 'Slider by tag', 'mediumish' ),
    'description' => __( 'Select a tag if you want the slider to display posts assigned to this specific tag.', 'mediumish' ),
	'section'     => 'sectionhome',
	'priority'    => 10,
    'choices'	  => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_terms( array('taxonomy' => 'post_tag') ) : array(),
    'active_callback' => [['setting' => 'mediumish_homeslider_active','operator' => '==','value' => 0]],
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'mediumish_option_homeslider_recentposts',
	'label'       => esc_attr__( 'Slider by recent posts', 'mediumish' ),
    'description' => __( 'Check this box if you want the slider to display recent posts instead. This will override the "Slider by tag" setting above.', 'mediumish' ),
	'section'     => 'sectionhome',
	'priority'    => 10,
    'default'	  => '0',
    'active_callback' => [['setting' => 'mediumish_homeslider_active','operator' => '==','value' => 0]],
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'text',
	'settings'    => 'mediumish_option_homeslider_numberposts',
	'label'       => esc_attr__( 'Enter number of slides', 'mediumish' ),
    'description' => __( 'Number of posts in slider. Make sure you don\'t exceed the number of actual posts you currently have in the selected tag.', 'mediumish' ),
	'section'     => 'sectionhome',
	'priority'    => 10,
    'default'     => '1',
    'active_callback' => [['setting' => 'mediumish_homeslider_active','operator' => '==','value' => 0]],
) );


Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
    'settings'    => 'mediumish_postsbycategory_active',
    'label'       => esc_attr__( 'Disable home posts by category', 'mediumish' ),
    'section'     => 'sectionhome',
    'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'repeater',		
	'section'     => 'sectionhome',
 	'priority'    => 10,
    'active_callback' => [['setting' => 'mediumish_postsbycategory_active','operator' => '==','value' => 0]],
    'row_label' => array(
		'type' => 'text',
		'value' => esc_attr__('Posts by Category Section', 'mediumish' ),
	),
    'settings'    => 'mediumish_option_postsbycategory',
    'default'     => array(
        array(          
            'categoryfield'  => '',
            'categorystyle'  => '',
        ),        
    ),
        'fields'     => array(
            'categoryfield' => array(
                'type'        => 'select',
                'label'       => esc_attr__( 'Select Category', 'mediumish' ),
                'choices'	  => ( class_exists( 'Kirki_Helper' ) ) ? Kirki_Helper::get_terms( array('taxonomy' => 'category') ) : array(),
                
            ),
            'categorystyle' => array(
                'type'        => 'select',
                'label'       => esc_attr__( 'Select Style', 'mediumish' ),
                'choices'     => array(
                        'style-1' => esc_attr__( 'Style 1', 'mediumish' ),
                        'style-2' => esc_attr__( 'Style 2', 'mediumish' ),
                    ),
            ),
        )
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
    'settings'    => 'mediumish_homecategorycloud_active',
    'label'       => esc_attr__( 'Disable category cloud', 'mediumish' ),
    'section'     => 'sectionhome',
    'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'image',
	'settings'    => 'mediumish_homecategorycloud_bg',
	'label'       => esc_attr__( 'Background Image', 'mediumish' ),
    'description' => __( 'Upload an image for background category cloud', 'mediumish' ),
	'section'     => 'sectionhome',
	'priority'    => 10,
    'active_callback' => [['setting' => 'mediumish_homecategorycloud_active','operator' => '==','value' => 0]],
) );



//-----------------------------------------------------
// SECTION: Articles
//-----------------------------------------------------
Mediumish_Kirki::add_section( 'sectionarticles', array(
	'title'      => esc_attr__( 'Articles', 'mediumish' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
  'panel'          => 'mainthemepanel_mediumish', // Not typically needed.
) );


Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_authorbox_sectionarticles',
	'label'       => esc_html__( 'Disable Author Box in Articles', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_authorbox_sectionarticles_card',
	'label'       => esc_html__( 'Disable Author in Post Cards', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_readingtime_sectionarticles',
	'label'       => esc_html__( 'Disable Reading Time in Articles', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_readingtime_sectionarticles_card',
	'label'       => esc_html__( 'Disable Reading Time in Post Cards', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );


Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_date_sectionarticles',
	'label'       => esc_html__( 'Disable Meta Date in Articles', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_date_sectionarticles_card',
	'label'       => esc_html__( 'Disable Meta Date in Post Cards', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_dot_sectionarticles_card',
	'label'       => esc_html__( 'Remove the dot in Post Cards', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_share_twitter',
	'label'       => esc_html__( 'Disable Twitter Share in Articles', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_share_fb',
	'label'       => esc_html__( 'Disable Facebook Share in Articles', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_share_pinterest',
	'label'       => esc_html__( 'Disable Pinterest Share in Articles', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_share_linkedin',
	'label'       => esc_html__( 'Disable Linkedin Share in Articles', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_share_google',
	'label'       => esc_html__( 'Disable Google+ Share in Articles', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_share_sectionarticles',
	'label'       => esc_html__( 'Disable All Social Share in Articles', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_cats_sectionarticles',
	'label'       => esc_html__( 'Disable Categories in Articles', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_tags_sectionarticles',
	'label'       => esc_html__( 'Disable Tags in Articles', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_rp_sectionarticles',
	'label'       => esc_html__( 'Disable Related Posts in Articles', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'disable_bottomalert_sectionarticles',
	'label'       => esc_html__( 'Disable Bottom Alert Bar in Articles', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
	'default'     => '0',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'textarea',
	'settings'    => 'mediumish_bottomalert',
	'label'       => esc_attr__( 'Bottom Alert Bar', 'mediumish' ),
    'description' => __( 'If you want to display a MailChimp form, make sure you have Mailchimp for WP installed and paste the generated shortcode. The code should be similar to: [mc4wp_form id="xxxx"]', 'mediumish' ),
	'section'     => 'sectionarticles',
	'priority'    => 10,
    'active_callback' => [['setting' => 'disable_bottomalert_sectionarticles','operator' => '==','value' => 0]],
) );


//-----------------------------------------------------
// SECTION: Footer
//-----------------------------------------------------
Mediumish_Kirki::add_section( 'sectionfooter', array(
	'title'      => esc_attr__( 'Footer', 'mediumish' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
  'panel'          => 'mainthemepanel_mediumish', // Not typically needed.
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'textarea',
	'settings'    => 'footer_textleft',
	'label'       => esc_attr__( 'Footer Text Left', 'mediumish' ),
	'section'     => 'sectionfooter',
	'priority'    => 10,
	'default'     => '&copy; Copyright Your Website Name',
) );


Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'textarea',
	'settings'    => 'footer_textright',
	'label'       => esc_attr__( 'Footer Text Right', 'mediumish' ),
	'section'     => 'sectionfooter',
	'priority'    => 10,
	'default'     => 'Mediumish Theme by <a target="_blank" href="https://www.wowthemes.net">WowThemesNet</a>',
) );

//-----------------------------------------------------
// SECTION: Ad Blocks
//-----------------------------------------------------
Mediumish_Kirki::add_section( 'sectionad', array(
	'title'      => esc_attr__( 'Banners', 'mediumish' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
    'panel'      => 'mainthemepanel_mediumish', // Not typically needed.
) );


Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'textarea',
	'settings'    => 'toparticle_sectionad',
	'label'       => esc_attr__( 'Top article banner', 'mediumish' ),
    'description' => 'Enter your ad/banner code here to appear at the beginning of an article.',
	'section'     => 'sectionad',
	'priority'    => 10,
	'default'     => '',
) );


Mediumish_Kirki::add_field( 'mediumish_theme', array(
    'type'        => 'textarea',
    'settings'    => 'bottomarticle_sectionad',
    'label'       => esc_attr__( 'Bottom Article Banner', 'mediumish' ),
    'description'     => 'Enter your ad/banner code here to appear at the end of an article.',
    'section'     => 'sectionad',
    'priority'    => 10,
    'default'     => '',
) );



//-----------------------------------------------------
// SECTION: Tracking Codes
//-----------------------------------------------------
Mediumish_Kirki::add_section( 'sectiontracking', array(
	'title'      => esc_attr__( 'Tracking Codes', 'mediumish' ),
	'priority'   => 2,
	'capability' => 'edit_theme_options',
  'panel'          => 'mainthemepanel_mediumish', // Not typically needed.
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'code',
	'settings'    => 'head_sectiontracking',
	'label'       => esc_attr__( 'Header Area', 'mediumish' ),
  'description'     => 'Right before "head" ends. Do not forget to save after closing the editor. Ignore warnings.',
	'section'     => 'sectiontracking',
	'priority'    => 10,
	'default'     => '',
	'choices'     => array(
		'language' => 'javascript',
	),
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
	'type'        => 'code',
	'settings'    => 'footer_sectiontracking',
	'label'       => esc_attr__( 'Footer Area', 'mediumish' ),
  'description'     => 'Right before "body" ends. Do not forget to save after closing the editor. Ignore warnings.',
	'section'     => 'sectiontracking',
	'priority'    => 10,
	'default'     => '',
	'choices'     => array(
		'language' => 'javascript',
	),
) );



//-----------------------------------------------------
// SECTION: Other
//-----------------------------------------------------
Mediumish_Kirki::add_section( 'section_misc', array(
    'title'      => esc_attr__( 'Misc', 'mediumish' ),
    'priority'   => 2,
    'capability' => 'edit_theme_options',
    'panel'          => 'mainthemepanel_mediumish', // Not typically needed.
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
    'type'        => 'image',
    'settings'    => 'bg_authorpage',
    'label'       => esc_html__( 'Author Page Header', 'mediumish' ),
    'section'     => 'section_misc',
    'priority'    => 10,
    'transport' => 'auto',
    'default'     => '',
) );

Mediumish_Kirki::add_field( 'mediumish_theme', array(
    'type'        => 'number',
    'settings'    => 'mediumish_limitcharacterstitle',
    'label'       => esc_html__( 'Limit Title Words in Cards and Slider', 'mediumish' ),
    'section'     => 'section_misc',
    'priority'    => 10,
    'default'     => '9',
) );