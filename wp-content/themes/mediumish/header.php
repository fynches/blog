<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    
<?php wp_head(); ?>
<?php echo get_theme_mod( 'head_sectiontracking'); ?>
</head> 
    
<body <?php body_class(); ?>> 
        
<?php 
global $post;
global $post_ids;
    
$mediumish_headertwitterlink = get_theme_mod( 'mediumish_headertwitterlink'); 
$headersociallinks = get_theme_mod( 'mediumish_headersociallink' );
$mediumish_headersearchlink = get_theme_mod( 'mediumish_headersearch_active' );
$disableauthorbox = get_theme_mod( 'disable_authorbox_sectionarticles_card'); 
$disablereadingtime = get_theme_mod( 'disable_readingtime_sectionarticles_card'); 
$disabledate = get_theme_mod( 'disable_date_sectionarticles_card'); 
$disabledot = get_theme_mod( 'disable_dot_sectionarticles_card'); 
?>
<style>
    <?php 
    if ($disableauthorbox == 1) { ?> .author-thumb, span.post-name {display:none;} <?php }
    if ($disablereadingtime == 1) { ?> span.readingtime {display:none;} <?php }
    if ($disabledate == 1) { ?> span.post-date {display:none;} <?php }
    if ($disabledot == 1) { ?> span.author-meta span.dot {display:none;} <?php }
    ?>
</style>

        
<header class="navbar-light bg-white fixed-top mediumnavigation">

    <div class="container">

        <!-- Begin Logo --> 
        <div class="row justify-content-center align-items-center brandrow">
            
            <div class="col-lg-4 col-md-4 col-xs-12 hidden-xs-down customarea">

            <?php if ( $mediumish_headertwitterlink ) { ?>
                <a class="btn follow" href="<?php echo esc_url($mediumish_headertwitterlink); ?>" target="blank"><i class="fa fa-twitter"></i> Follow</a>
            <?php } ?>


            <?php if (is_array($headersociallinks) || is_object($headersociallinks)) {                
                foreach( $headersociallinks as $headersociallink ) : ?>
                <a target="_blank" href="<?php echo $headersociallink['social_url']; ?>"> <i class="fa fa-<?php echo $headersociallink['social_icon']; ?> social"></i></a>
            <?php endforeach; } ?>

            </div>

            <div class="col-lg-4 col-md-4  col-xs-12 text-center logoarea">
                 <?php if ( get_theme_mod( 'logo_sectionlogonav' ) ) { ?>
                    <a class="blog-logo" href='<?php echo esc_url( home_url( '/' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'logo_sectionlogonav' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
                    <?php } else { ?>
                    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                <?php } ?>
            </div>

            <div class="col-lg-4 col-md-4 mr-auto col-xs-12 text-right searcharea">
                <?php if ( $mediumish_headersearchlink == 0) { ?>                        
                        <?php get_search_form (); ?>                        
                <?php } ?>
            </div>
                    
        </div>
        <!-- End Logo --> 

        <div class="navarea">
       
        <nav class="navbar navbar-toggleable-sm">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#bs4navbar" aria-controls="bs4navbar" aria-expanded="false" aria-label="Toggle navigation"> 
                <span class="navbar-toggler-icon"></span> 
            </button>  
                <?php
                   wp_nav_menu([
                     'menu'            => 'primary',
                     'theme_location'  => 'primary',
                     'container'       => 'div',
                     'container_id'    => 'bs4navbar',
                     'container_class' => 'collapse navbar-collapse',
                     'menu_id'         => false,
                     'menu_class'      => 'navbar-nav col-md-12 justify-content-center',
                     'depth'           => 2,
                     'fallback_cb'     => 'bs4navwalker::fallback',
                     'walker'          => new bs4navwalker()
                   ]);
                   ?>
        </nav>
        
        </div>
            
    </div>

</header>
        
       
        <!-- Begin site-content
		================================================== -->         
        <div class="site-content">