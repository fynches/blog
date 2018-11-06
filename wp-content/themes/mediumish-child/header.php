<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<meta charset="<?php bloginfo('charset');?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="pingback" href="<?php bloginfo('pingback_url');?>">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

<?php wp_head();?>
<?php echo get_theme_mod('head_sectiontracking'); ?>
</head>

<body <?php body_class();?>>

<?php
global $post;
global $post_ids;

$mediumish_headertwitterlink = get_theme_mod('mediumish_headertwitterlink');
$headersociallinks = get_theme_mod('mediumish_headersociallink');
$mediumish_headersearchlink = get_theme_mod('mediumish_headersearch_active');
$disableauthorbox = get_theme_mod('disable_authorbox_sectionarticles_card');
$disablereadingtime = get_theme_mod('disable_readingtime_sectionarticles_card');
$disabledate = get_theme_mod('disable_date_sectionarticles_card');
$disabledot = get_theme_mod('disable_dot_sectionarticles_card');
?>
<style>
    <?php
if ($disableauthorbox == 1) {?> .author-thumb, span.post-name {display:none;} <?php }
if ($disablereadingtime == 1) {?> span.readingtime {display:none;} <?php }
if ($disabledate == 1) {?> span.post-date {display:none;} <?php }
if ($disabledot == 1) {?> span.author-meta span.dot {display:none;} <?php }
?>
</style>


<!-- Header Sec -->
<header>
	<nav class="navbar navbar-expand-lg navbar-default">
      <div class="container">
        <a class="navbar-brand" href="/">
          <img src="/blog/wp-content/uploads/2018/05/Fynches_Logo_Teal.png" width="150" height="30" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">ABOUT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/blog">BLOG</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">SIGN IN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">GET STARTED</a>
            </li>
          </ul>
         <form>
              <a class="src-img" href="javascript:void(0);"><i class="fa fa-search" aria-hidden="true"></i></a>
              <input class="search expandright" name="searchtext" placeholder="Search" required="" type="search">
         </form>
        </div>
      </div>
    </nav>
</header>
<!-- End -->



<!-- Begin site-content
================================================== -->
<div class="site-content">

