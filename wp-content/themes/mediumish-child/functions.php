<?php
// add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
// function my_theme_enqueue_styles() {
// 	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

// }

add_action('wp_enqueue_scripts', 'theme_enqueue_styles', PHP_INT_MAX);

function theme_enqueue_styles() {
	wp_enqueue_style('bootstrap4', get_template_directory_uri() . '/assets/css/bootstrap.min.css', false, null, 'all');

	$parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

	wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
	wp_enqueue_style('child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array($parent_style),
		wp_get_theme()->get('Version')
	);
}

function mediumish_postbox_child() {
	add_filter('the_title', 'limit_word_count');
	global $post;
	$featured_img_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));?>

    <?php if ($featured_img_url) {echo '<div class="card post highlighted"><a class="thumbimage" href="' . get_permalink() . '" style="background-image:url(' . $featured_img_url . ');"></a>';} else {echo '<div class="card post height262">';}

	echo '<div class="card-block">
    <h2 class="card-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
    <span class="card-text d-block">' . excerpt(12) . '</span>
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
// Post Card Tall
//-----------------------------------------------------
function mediumish_post_card_tall_child() {
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
                <h2 class="card-title"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                <span class="card-text d-block"><?php echo excerpt(12); ?></span>
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

function add_linebreak_shortcode() {
	return '<br />';
}
add_shortcode('br', 'add_linebreak_shortcode');

//-----------------------------------------------------
// Posts by Category
//-----------------------------------------------------
if (!function_exists('mediumish_function_postsbycategory_child')) {
	function mediumish_function_postsbycategory_child($category, $catstyle) {
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
					                    <?php echo mediumish_post_card_tall_child(); ?>
					                </div>
					                <?php endwhile;?>
            </div>
    </section>

<?php endif;
			wp_reset_query();}

	}
}
?>