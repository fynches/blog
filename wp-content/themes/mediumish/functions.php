<?php

//-----------------------------------------------------
// Setup
//-----------------------------------------------------
if (!function_exists('mediumish_setup')):

	function mediumish_setup() {
		if (!isset($content_width)) {
			$content_width = 730; /* pixels */
		}
		load_theme_textdomain('mediumish', get_template_directory() . '/languages');
		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('woocommerce');
		set_post_thumbnail_size(825, 510, true);

		register_nav_menus(array(
			'primary' => __('Primary Menu', 'mediumish'),
		));
		add_theme_support('html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		));
	}
endif;
add_action('after_setup_theme', 'mediumish_setup');

//-----------------------------------------------------
// Scripts & Styles
//-----------------------------------------------------
if (!function_exists('mediumish_enqueue_scripts')):
	function mediumish_enqueue_scripts() {
		wp_enqueue_script('tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js', array('jquery'), null, true);
		wp_enqueue_script('bootstrap4', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), null, true);
		wp_enqueue_script('mediumish-ieviewportbugworkaround', get_template_directory_uri() . '/assets/js/ie10-viewport-bug-workaround.js', array('jquery'), null, true);
		wp_enqueue_script('mediumish-masonrypkgd', get_template_directory_uri() . '/assets/js/masonry.pkgd.min.js', array('jquery'), null, true);
		wp_enqueue_script('mediumish', get_template_directory_uri() . '/assets/js/mediumish.js', array('jquery'), null, true);

		wp_enqueue_style('bootstrap4', get_template_directory_uri() . '/assets/css/bootstrap.min.css', false, null, 'all');
		wp_enqueue_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, null, 'all');
		wp_enqueue_style('mediumish-style', get_stylesheet_uri());
		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
	add_action('wp_enqueue_scripts', 'mediumish_enqueue_scripts');
endif;

//----------------------------------------------------
// Register Widgets
//-----------------------------------------------------
if (!function_exists('mediumish_sidebar_widgets_init')):
	function _widgets_init() {
		register_sidebar(array(
			'name' => __('Sidebar WooCommerce Shop', 'mediumish'),
			'id' => 'sidebar-woocommerce',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="widget-title"><span>',
			'after_title' => '</span></h4>',
		));
		register_sidebar(array(
			'name' => __('Sidebar Posts', 'mediumish'),
			'id' => 'sidebar-posts',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h4 class="widget-title"><span>',
			'after_title' => '</span></h4>',
		));
	}
endif; // _widgets_init
add_action('widgets_init', '_widgets_init');

//-----------------------------------------------------
// Excerpt
//-----------------------------------------------------
function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt) >= $limit) {
		array_pop($excerpt);
		$excerpt = implode(" ", $excerpt) . '...';
	} else {
		$excerpt = implode(" ", $excerpt);
	}
	$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
	return $excerpt;
}

function content($limit) {
	$content = explode(' ', get_the_content(), $limit);
	if (count($content) >= $limit) {
		array_pop($content);
		$content = implode(" ", $content) . '...';
	} else {
		$content = implode(" ", $content);
	}
	$content = preg_replace('/\[.+\]/', '', $content);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}

//-----------------------------------------------------
// Reading Time
//-----------------------------------------------------
function mediumish_estimated_reading_time() {
	$post = get_post();
	$words = str_word_count(strip_tags($post->post_content));
	$minutes = floor($words / 280);
	$seconds = floor($words % 280 / (280 / 60));

	if (1 <= $minutes) {
		$estimated_time = $minutes . ' ' . esc_attr__('min read', 'mediumish');
	} else {
		$estimated_time = $seconds . ' ' . esc_attr__('sec read', 'mediumish');
	}
	return $estimated_time;
}

//-----------------------------------------------------
// Limit title characters
//-----------------------------------------------------
function limit_word_count($title) {
	$limitcharacterstitle = get_theme_mod('mediumish_limitcharacterstitle');
	if ($limitcharacterstitle) {
		$len = $limitcharacterstitle;
	} else {
		$len = 9;
	}
	return wp_trim_words($title, $len, '&hellip;');
}

//-----------------------------------------------------
// Share
//-----------------------------------------------------
if (!function_exists('mediumish_share_post')) {
	function mediumish_share_post() {
		global $post;
		$shareURL = urlencode(get_permalink());
		$shareTitle = str_replace(' ', '%20', get_the_title());
		$shareThumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
		$twitterURL = 'https://twitter.com/intent/tweet?text=' . $shareTitle . '&amp;url=' . $shareURL;
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . $shareURL;
		$pinterestURL = 'https://pinterest.com/pin/create/button/?url=' . $shareURL . '&amp;media=' . $shareThumbnail[0] . '&amp;description=' . $shareTitle;
		$linkedinURL = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $shareURL . '&amp;title=' . $shareTitle;
		$googleURL = 'https://plus.google.com/share?url=' . $shareURL;
		$disablesharetwitter = get_theme_mod('disable_share_twitter');
		$disablesharefb = get_theme_mod('disable_share_fb');
		$disablesharepinterest = get_theme_mod('disable_share_pinterest');
		$disablesharelinkedin = get_theme_mod('disable_share_linkedin');
		$disablesharegoogle = get_theme_mod('disable_share_google');

		echo '
<ul class="shareitnow">';
		if ($disablesharetwitter == 0) {
			echo
				'<li>
        <a target="_blank" href="' . $twitterURL . '">
        <i class="fa fa-twitter"></i>
        </a>
    </li>';}

		if ($disablesharefb == 0) {
			echo
				'<li>
        <a target="_blank" href="' . $facebookURL . '">
        <i class="fa fa-facebook"></i>
        </a>
    </li>';}

		if ($disablesharegoogle == 0) {
			echo
				'<li>
        <a target="_blank" href="' . $googleURL . '">
        <i class="fa fa-google"></i>
        </a>
    </li>';}

		if ($disablesharepinterest == 0) {
			echo
				'<li>
        <a target="_blank" href="' . $pinterestURL . '">
        <i class="fa fa-pinterest"></i>
        </a>
    </li>';}

		if ($disablesharelinkedin == 0) {
			echo
				'<li>
        <a target="_blank" href="' . $linkedinURL . '">
        <i class="fa fa-linkedin"></i>
        </a>
    </li>';}

		echo '</ul>';

	}
}

//-----------------------------------------------------
// Hide applause button plugin, it's already in theme
//-----------------------------------------------------
add_filter('wpli/autoadd', function () {return false;});

//-----------------------------------------------------
// Meta Tag
//-----------------------------------------------------
function mediumish_custom_get_meta_excerpt() {
	global $post;
	$temp = $post;
	$post = get_post();
	setup_postdata($post);
	$excerpt = esc_attr(strip_tags(get_the_excerpt()));
	wp_reset_postdata();
	$post = $temp;
	return $excerpt;
}

function mediumish_custom_add_meta_description_tag() {
	?>
<meta name="description" content="<?php if (is_single() || is_page()) {
		$excerpt = mediumish_custom_get_meta_excerpt(get_the_ID());
		echo $excerpt;
	} else {
		bloginfo('description');
	}
	?>" />
<?php
}
add_action('wp_head', 'mediumish_custom_add_meta_description_tag', 1);

//-----------------------------------------------------
// Comment Form
//-----------------------------------------------------
function my_update_comment_fields($fields) {
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$label = $req ? '*' : ' ' . __('(optional)', 'mediumish');
	$aria_req = $req ? "aria-required='true'" : '';
	$fields['author'] =
	'<div class="row"><p class="comment-form-author col-md-4">

			<input id="author" name="author" type="text" placeholder="' . esc_attr__("Name", "mediumish") . '" value="' . esc_attr($commenter['comment_author']) .
		'" size="30" ' . $aria_req . ' />
		</p>';
	$fields['email'] =
	'<p class="comment-form-email col-md-4">

			<input id="email" name="email" type="email" placeholder="' . esc_attr__("E-mail address", "mediumish") . '" value="' . esc_attr($commenter['comment_author_email']) .
		'" size="30" ' . $aria_req . ' />
		</p>';
	$fields['url'] =
	'<p class="comment-form-url col-md-4">

			<input id="url" name="url" type="url"  placeholder="' . esc_attr__("Website Link", "mediumish") . '" value="' . esc_attr($commenter['comment_author_url']) .
		'" size="30" />
			</p></div>';
	return $fields;
}
add_filter('comment_form_default_fields', 'my_update_comment_fields');

function my_update_comment_field($comment_field) {
	$comment_field =
	'<p class="comment-form-comment">
            <textarea required id="comment" name="comment" placeholder="' . esc_attr__("Write a response...", "mediumish") . '" cols="45" rows="8" aria-required="true"></textarea>
        </p>';
	return $comment_field;
}
add_filter('comment_form_field_comment', 'my_update_comment_field');

//-----------------------------------------------------
// Postbox
//-----------------------------------------------------
function mediumish_postbox() {
	add_filter('the_title', 'limit_word_count');
	global $post;
	$featured_img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));?>

    <?php if ($featured_img_url) {echo '<div class="card post highlighted"><a class="thumbimage" href="' . get_permalink() . '" style="background-image:url(' . $featured_img_url . ');"></a>';} else {echo '<div class="card post height262">';}

	echo '<div class="card-block">
    <h2 class="card-title"><a href="' . get_permalink() . '">' . substr(get_the_title(), 0, 200) . '</a></h2>
    <span class="card-text d-block">' . excerpt(25) . '</span>
    <div class="metafooter">
    <div class="wrapfooter">
    <span class="meta-footer-thumb">
    <a href="' . get_author_posts_url($post->post_author) . '">
    ' . get_avatar(get_the_author_meta('user_email'), '40', null, null, array('class' => array('author-thumb'))) . '
    </span>
    </a>
    <span class="author-meta">
        <span class="post-name"><a href="' . get_author_posts_url($post->post_author) . '">' . get_the_author_meta('display_name') . '</a></span><br>
        <span class="post-date">' . get_the_date('M j, Y') . '</span>
        <span class="dot"></span>
        <span class="readingtime">' . mediumish_estimated_reading_time() . '</span>
    </span>
    <span class="post-read-more">
    <a href="' . get_permalink() . '" title="Read Story">
    <svg class="svgIcon-use" width="25" height="25" viewBox="0 0 25 25">
        <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
    </svg>
    </a>
    </span>
    </div>
    </div>
    </div>
    </div>
    ';
}

//-----------------------------------------------------
// Author Postbox (from list all authors)
//-----------------------------------------------------
function mediumish_authorpostbox() {
	global $post;
	$featured_img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
	echo '
    <div class="card post authorpost">';
	if ($featured_img_url != ''): echo '
	    <a class="thumbimage" href="' . get_permalink() . '" style="background-image:url(' . $featured_img_url . ');"></a>';
	endif;
	echo '
    <div class="card-block">
    <h2 class="card-title"><a href="' . get_permalink() . '">' . substr(get_the_title(), 0, 200) . '</a></h2>
    <span class="card-text d-block">' . excerpt(25) . '</span>
    <div class="metafooter">
    <div class="wrapfooter">
    <span class="author-meta">
        <span class="post-date">' . get_the_date() . '</span>
        <span class="dot"></span>';
	?>
    <?php if (comments_open()) {echo '
        <span class="muted"><i class="fa fa-comments"></i> ' . get_comments_number() . '</span>
        <span class="dot"></span>';}?>
    <?php echo '<span class="readingtime">' . mediumish_estimated_reading_time() . '</span>
    </span>
    <span class="post-read-more">
    <a href="' . get_permalink() . '">
    <svg class="svgIcon-use" width="25" height="25" viewBox="0 0 25 25">
        <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
    </svg>
    </a>
    </span>
    </div>
    </div>
    </div>
    </div>
    ';
}

//-----------------------------------------------------
// Slider
//-----------------------------------------------------
if (!function_exists('mediumish_function_slider')) {
	function mediumish_function_slider($slidertag, $slidernumber) {
		add_filter('the_title', 'limit_word_count');
		global $post;
		?>
    <div id="main-slider" class="carousel slide margb-2" data-ride="carousel">
        <?php
$args = array(
			'tag__in' => $slidertag,
			'posts_per_page' => $slidernumber,
		);
		$slider = new WP_Query($args);
		$count = 0;

		if ($slider->have_posts()):
			$count = $slidernumber;
			?>
	            <ol class="carousel-indicators">
	            <?php for ($i = 0; $i < $count; $i++) {?>
	            <li data-target="#main-slider" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 0) ? 'active' : '' ?>"></li>
	            <?php }?>
	            </ol> <!--.carousel-indicators-->

	            <div class="carousel-inner" role="listbox">
	            <?php $i = 0;

			while ($slider->have_posts()): $slider->the_post();?>

		            <div class="carousel-item <?php echo ($i == 0) ? 'active' : '' ?>">
		                <a href="<?php echo esc_url(the_permalink()); ?>">
		                    <?php if (get_the_post_thumbnail(get_the_ID())) {
					the_post_thumbnail(
						'full',
						array(
							'class' => 'd-block',
							'data-no-lazy' => '1',
							'alt' => get_the_title(),
						)
					);
				} else {?>
		                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/default.jpg" data-no-lazy="1" alt="<?php the_title();?>" />
		                    <?php }?>

		                    <div class="carousel-caption d-flex h-100 align-items-center justify-content-center">
		                        <h3 class="carousel-excerpt d-block">
		                        <span class="title d-block"><?php the_title();?></span>
		                        <span class="fontlight d-block hidden-md-down"><?php echo excerpt(35); ?></span>
		                        <span class="btn btn-simple"><?php _e('Read More', 'mediumish');?></span>
		                        </h3>
		                    </div>
		                </a>
		            </div><!--.carousel-item-->

		            <?php $i++;endwhile;?>

	            </div> <!--.carouse-inner-->


	            <a href="#main-slider" class="carousel-control-prev" data-slide="prev">
	                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	            </a>
	            <a href="#main-slider" class="carousel-control-next" data-slide="next">
	                <span class="carousel-control-next-icon" aria-hidden="true"></span>
	            </a>

	         <?php endif;
		wp_reset_postdata();?>
      </div>
    <?php
}
}

//-----------------------------------------------------
// Post Card Highlight First in Row
//-----------------------------------------------------
function mediumish_post_card_highlight_first() {
	global $post;
	$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');?>
    <div class="card post <?php if ($featured_img_url) {echo 'highlighted';} else {echo 'height262';}?>">
            <?php if ($featured_img_url != ''): echo '
	            <a class="thumbimage" href="' . get_permalink() . '" style="background-image:url(' . $featured_img_url . ');"></a>';
	endif;
	?>
            <div class="card-block">
            <h2 class="card-title"><a href="<?php echo esc_url(the_permalink()); ?>"><?php the_title();?></a></h2>
            <span class="card-text d-block"><?php echo excerpt(29); ?></span>
            <div class="metafooter">
                <?php echo '<div class="wrapfooter">
                <span class="meta-footer-thumb">
                <a href="' . get_author_posts_url($post->post_author) . '">
                ' . get_avatar(get_the_author_meta('user_email'), '40', null, null, array('class' => array('author-thumb'))) . '
                </span>
                </a>
                <span class="author-meta">
                    <span class="post-name"><a href="' . get_author_posts_url($post->post_author) . '">' . get_the_author_meta('display_name') . '</a></span><br>
                    <span class="post-date">' . get_the_date('M j, Y') . '</span>
                    <span class="dot"></span>
                    <span class="readingtime">' . mediumish_estimated_reading_time() . '</span>
                </span>
                <span class="post-read-more">
                <a href="' . get_permalink() . '" title="Read Story">
                <svg class="svgIcon-use" width="25" height="25" viewBox="0 0 25 25">
                    <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
                </svg>
                </a>
                </span>
                </div>'; ?>
            </div>
            </div>
     </div>
<?php }

//-----------------------------------------------------
// Post Card After Highlight First in Row
//-----------------------------------------------------
function mediumish_post_card_after_highlight() {
	global $post;
	$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
	?>

<div class="card post height262">
<?php
if ($featured_img_url != '') {
		echo '<a class="thumbimage" href="' . get_permalink() . '" style="background-image:url(' . $featured_img_url . ');"></a>';
	}?>
<div class="card-block">
    <h2 class="card-title">
        <a href="<?php echo get_permalink(); ?>"><?php echo substr(get_the_title(), 0, 200); ?></a>
    </h2>
    <?php if ($featured_img_url == '') {echo '<span class="card-text d-block">' . excerpt(25) . '</span>';}?>
        <div class="metafooter">
            <div class="wrapfooter">
                <span class="meta-footer-thumb">
                    <a href="<?php echo get_author_posts_url($post->post_author); ?>">
                    <?php echo get_avatar(get_the_author_meta('user_email'), '40', null, null, array('class' => array('author-thumb'))); ?>
                    </a>
                </span>
                <?php echo '<span class="author-meta">
                    <span class="post-name">
                    <a href="' . get_author_posts_url($post->post_author) . '">' . get_the_author_meta('display_name') . '</a></span><br>
                    <span class="post-date">' . get_the_date('M j, Y') . '</span>
                    <span class="dot"></span>
                    <span class="readingtime">' . mediumish_estimated_reading_time() . '</span>
                </span>
                <span class="post-read-more">
                    <a href="' . get_permalink() . '" title="">
                    <svg class="svgIcon-use" width="25" height="25" viewBox="0 0 25 25">
                        <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
                    </svg>
                    </a>
                </span>'; ?>
            </div>
        </div>
    </div>
</div>
<?php }

//-----------------------------------------------------
// Post Card Tall
//-----------------------------------------------------
function mediumish_post_card_tall() {
	global $post;
	$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
	?>
<div class="card" id="post-<?php echo the_ID(); ?>">
    <div class="row">
        <?php if ($featured_img_url) {?>
        <div class="col-md-5 wrapthumbnail">
            <a href="<?php echo get_permalink(); ?>">
                <div class="thumbnail" style="background-image:url(<?php echo esc_url($featured_img_url); ?>);">
                </div>
            </a>
        </div>
        <?php }?>
        <div class="<?php if ($featured_img_url) {?> col-md-7 <?php } else {?> nothumbimage <?php }?>">
            <div class="card-block">
                <h2 class="card-title"><a href="<?php echo get_permalink(); ?>"><?php echo substr(get_the_title(), 0, 200); ?></a></h2>
                <span class="card-text d-block"><?php echo excerpt(20); ?></span>
                <div class="metafooter">
                    <div class="wrapfooter">
                        <span class="meta-footer-thumb">
                            <a href="<?php echo get_author_posts_url($post->post_author); ?>">
                            <?php echo get_avatar(get_the_author_meta('user_email'), '40', null, null, array('class' => array('author-thumb'))); ?>
                            </a>
                        </span>
                        <?php echo '<span class="author-meta">
                            <span class="post-name">
                            <a href="' . get_author_posts_url($post->post_author) . '">' . get_the_author_meta('display_name') . '</a></span><br>
                            <span class="post-date">' . get_the_date('M j, Y') . '</span>
                            <span class="dot"></span>
                            <span class="readingtime">' . mediumish_estimated_reading_time() . '</span>
                        </span>
                        <span class="post-read-more">
                            <a href="' . get_permalink() . '" title="">
                            <svg class="svgIcon-use" width="25" height="25" viewBox="0 0 25 25">
                                <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
                            </svg>
                            </a>
                        </span>'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }

//-----------------------------------------------------
// Posts by Category
//-----------------------------------------------------
if (!function_exists('mediumish_function_postsbycategory')) {
	function mediumish_function_postsbycategory($category, $catstyle) {
		add_filter('the_title', 'limit_word_count');
		global $post;
		$post_thumbnail_id = get_post_thumbnail_id($post);

		if ($catstyle == 'style-1') {
			$args = array(
				'category__in' => $category,
				'posts_per_page' => 5,
			);
			$the_query = new WP_Query($args);

			$firstpost = true;

			if ($the_query->have_posts()): ?>

        <div class="section-title">
            <h2>
                <span><?php echo get_cat_name($category); ?> &nbsp;</span>
                <a class="d-block pull-right morefromcategory" href="<?php echo esc_url(get_category_link($category)); ?>">
                    <?php _e('More', 'mediumish');?> &nbsp; <i class="fa fa-angle-right"></i>
                </a>
                <div class="clearfix"></div>
            </h2>
        </div>
        <div class="row listrecent">
            <?php
while ($the_query->have_posts()):
				$the_query->the_post();
				$post = $the_query->post;
				if ($firstpost): ?>
	            <div class="col-md-4 col-lg-4 col-sm-4 padr10" id="post-<?php echo the_ID(); ?>">
	                <?php echo mediumish_post_card_highlight_first(); ?>
	            </div>
	            <div class="col-md-8 col-lg-8 col-sm-8">
	                <div class="row skipfirst">
	                <?php $firstpost = false;endif;?>
                <div class="col-md-6 col-lg-6 col-sm-6 grid-item" id="post-<?php echo the_ID(); ?>">
                <?php echo mediumish_post_card_after_highlight(); ?>
                </div>
                <?php endwhile;?>
                </div>
            </div>
            <div class="clearfix"></div>

        </div>
        <?php

			endif;} else {

			global $post_ids;

			$args = array(
				'category__in' => $category,
				'posts_per_page' => 4,
			);
			$the_query = new WP_Query($args);
			if ($the_query->have_posts()):
			?>
    <div class="section-title">
        <h2>
            <span><?php echo get_cat_name($category); ?> &nbsp;</span>
            <a class="d-block pull-right morefromcategory" href="<?php echo esc_url(get_category_link($category)); ?>">
                <?php _e('More', 'mediumish');?> &nbsp; <i class="fa fa-angle-right"></i>
            </a>
            <div class="clearfix"></div>
        </h2>
    </div>
    <section class="featured-posts">
            <div class="row listfeaturedtag margneg10">
                <?php
while ($the_query->have_posts()):
				$the_query->the_post();
				$post = $the_query->post;
				?>
	                <div class="col-md-6 col-lg-6 col-sm-6 padlr10">
	                    <?php echo mediumish_post_card_tall(); ?>
	                </div>
	                <?php endwhile;?>
            </div>
    </section>

<?php endif;
			wp_reset_query();}

	}
}

//-----------------------------------------------------
// Related Posts
//-----------------------------------------------------
function mediumish_related_posts($args = array()) {
	global $post;
	add_filter('the_title', 'limit_word_count');

	// default args
	$args = wp_parse_args($args, array(
		'post_id' => !empty($post) ? $post->ID : '',
		'taxonomy' => 'category',
		'limit' => 3,
		'post_type' => !empty($post) ? $post->post_type : 'post',
		'orderby' => 'date',
		'order' => 'DESC',
	));

	// check taxonomy
	if (!taxonomy_exists($args['taxonomy'])) {
		return;
	}

	// post taxonomies
	$taxonomies = wp_get_post_terms($args['post_id'], $args['taxonomy'], array('fields' => 'ids'));

	if (empty($taxonomies)) {
		return;
	}

	// query
	$related_posts = get_posts(array(
		'post__not_in' => (array) $args['post_id'],
		'post_type' => $args['post_type'],
		'limit' => 3,
		'tax_query' => array(
			array(
				'taxonomy' => $args['taxonomy'],
				'field' => 'term_id',
				'terms' => $taxonomies,
			),
		),
		'posts_per_page' => $args['limit'],
		'orderby' => $args['orderby'],
		'order' => $args['order'],
	));

	if (!empty($related_posts)) {?>
    <div class="row justify-content-center listrecent listrelated">
        <?php
foreach ($related_posts as $post) {setup_postdata($post);?>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <?php echo mediumish_post_card_after_highlight(); ?>
        </div>
        <?php }?>
    </div>
    <div class="clearfix"></div>
    <?php
}

	wp_reset_postdata();
}

//-----------------------------------------------------
// Return an alternate title, without prefix, for every type used in the get_the_archive_title().
//-----------------------------------------------------
function mediumish_archive_title() {
	if (is_category()) {
		$title = single_cat_title('', false);
	} elseif (is_tag()) {
		$title = single_tag_title('', false);
	} elseif (is_author()) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif (is_year()) {
		$title = get_the_date('Y', 'yearly archives date format');
	} elseif (is_month()) {
		$title = get_the_date('F Y', 'monthly archives date format');
	} elseif (is_day()) {
		$title = get_the_date('F j, Y', 'daily archives date format');
	} elseif (is_post_type_archive()) {
		$title = post_type_archive_title('', false);
	} elseif (is_tax()) {
		$title = single_term_title('', false);
	} else {
		$title = _('Posts', 'mediumish');
	}
	return $title;
}
add_filter('get_the_archive_title', 'mediumish_archive_title');

//-----------------------------------------------------
// Add social fields to user profile
//-----------------------------------------------------
if (!function_exists('mediumish_user_fields')):

	function mediumish_user_fields($contactmethods) {
		$contactmethods['twitter'] = 'Twitter';
		$contactmethods['facebook'] = 'Facebook';
		$contactmethods['youtube'] = 'YouTube';
		$contactmethods['location'] = 'Location';

		return $contactmethods;
	}
	add_filter('user_contactmethods', 'mediumish_user_fields', 10, 1);

endif;

//-----------------------------------------------------
// Ad Blocks
//-----------------------------------------------------
if (!function_exists('wtn_ad_block_top_article')):
	function wtn_ad_block_top_article() {
		$toparticle = get_theme_mod('toparticle_sectionad');
		if (!empty($toparticle)) {
			echo '<div class="wtntopadarticle"><p>' . get_theme_mod('toparticle_sectionad') . '</p></div>';
		}
	}
endif;

if (!function_exists('wtn_ad_block_bottom_article')):
	function wtn_ad_block_bottom_article() {
		$bottomarticle = get_theme_mod('bottomarticle_sectionad');
		if (!empty($bottomarticle)) {
			echo '<div class="wtnbottomadarticle"><p>' . get_theme_mod('bottomarticle_sectionad') . '</p></div>';
		}
	}
endif;

//-----------------------------------------------------
// Require
//-----------------------------------------------------
require_once get_template_directory() . '/inc/bootstrap/wp_bootstrap_pagination.php';
require_once get_template_directory() . '/inc/bootstrap/wp_bootstrap_navwalker.php';
require_once get_template_directory() . '/inc/include-kirki.php';
require_once get_template_directory() . '/inc/kirki-fallback.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

//-----------------------------------------------------
// TGMPA
//-----------------------------------------------------
if (!function_exists('mediumish_required_plugins')) {
	function mediumish_required_plugins() {
		$config = array(
			'id' => 'mediumish',
			'default_path' => '',
			'menu' => 'tgmpa-install-plugins',
			'has_notices' => true,
			'dismissable' => true,
			'dismiss_msg' => '',
			'is_automatic' => false,
			'message' => '',
		);
		$plugins = array(
			array(
				'name' => esc_html__('Kirki', 'mediumish'),
				'slug' => 'kirki',
				'required' => true,
			),
			array(
				'name' => esc_html__('MailChimp for WordPress', 'mediumish'),
				'slug' => 'mailchimp-for-wp',
				'required' => false,
			),
			array(
				'name' => esc_html__('Featured Image Generator', 'mediumish'),
				'slug' => 'featured-image-generator',
				'required' => false,
			),
			array(
				'name' => esc_html__('WP Frontend Submit', 'mediumish'),
				'slug' => 'wp-frontend-submit',
				'required' => false,
			),
			array(
				'name' => esc_html__('Contact Form 7', 'mediumish'),
				'slug' => 'contact-form-7',
				'required' => false,
			),
			array(
				'name' => esc_html__('Wow Popup', 'mediumish'),
				'slug' => 'wowpopup',
				'source' => 'https://s3.amazonaws.com/wtnplugins/wowpopup.zip',
				'required' => false,
			),
			array(
				'name' => esc_html__('WP Applause Button', 'mediumish'),
				'slug' => 'wp-claps-applause',
				'source' => 'https://s3.amazonaws.com/wtnplugins/wp-claps-applause.zip',
				'required' => false,
			),

		);
		tgmpa($plugins, $config);
	}
	add_action('tgmpa_register', 'mediumish_required_plugins');
}

?>