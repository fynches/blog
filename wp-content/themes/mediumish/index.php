<?php
/**
 * Index
 */
get_header(); 
$mediumish_homeslider_active = get_theme_mod( 'mediumish_homeslider_active');
$mediumish_option_homeslider_recentposts = get_theme_mod( 'mediumish_option_homeslider_recentposts');
$slidertag = get_theme_mod( 'mediumish_option_homeslider'); 
if ( $mediumish_option_homeslider_recentposts == 1 ) { $slidertag = ''; }
$slidernumber = get_theme_mod( 'mediumish_option_homeslider_numberposts');
$mediumish_postsbycategory_active = get_theme_mod( 'mediumish_postsbycategory_active'); 
$postcategories = get_theme_mod( 'mediumish_option_postsbycategory'); 
$mediumish_homecategorycloud_active = get_theme_mod( 'mediumish_homecategorycloud_active');
$mediumish_homecategorycloud_bg = get_theme_mod( 'mediumish_homecategorycloud_bg');

?>

<div class="container">
    
    
<?php 

if (is_home()) :

    if (is_paged()) {  } else {

        if ( $mediumish_homeslider_active == 0 ) { echo mediumish_function_slider($slidertag, $slidernumber); }

        if ( $mediumish_postsbycategory_active == 0 ) :
		
			if (!empty($postcategories)) : 

				foreach( $postcategories as $postcategory ) :  
					 
					$category = $postcategory['categoryfield'];

					$styleoption = $postcategory['categorystyle']; 

					if ($styleoption=="style-1") { $catstyle = "style-1";  } else { $catstyle = "style-2"; }

					echo mediumish_function_postsbycategory($category, $catstyle);        
				   
				endforeach; 
			
			endif;
        
         endif;       
    }
    
endif;
?>
    
<div class="clearfix"></div> 
    
<!-- blog posts -->
<section class="recent-posts"> 
    
    <div class="section-title"> 
        <h2>
            <?php 
            if (is_search()) {
                echo 'Search results for: <span>'.get_query_var('s').'</span>';
            } else if ( is_archive() ) {            
                echo '<span>'. mediumish_archive_title() .'</span>';
            } else { ?>
            <span><?php _e( 'All Stories', 'mediumish' ); ?></span>
                <?php } ?>
        </h2> 
    </div>
    
 
    <?php if ( have_posts() ) : ?>
    
    <!-- begin loop -->
    <div class="masonrygrid row listrecent">
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="col-lg-4 col-md-4 col-sm-6 grid-item" id="post-<?php echo the_ID(); ?>">
                <?php echo mediumish_postbox(); ?>
            </div>
        <?php endwhile; ?>    
    </div>
    <!-- end loop -->
    
    <!-- pagination -->                     
    <div class="bottompagination">
        <?php wp_bootstrap_pagination( array(
                'previous_string' => '<i class="fa fa-angle-double-left"></i>',
                'next_string' => '<i class="fa fa-angle-double-right"></i>',
                'before_output' => '<span class="navigation">',
                'after_output' => '</span>'
        ) ); ?> 
    </div> 
       

    <?php else : ?>

        <p><?php _e( 'Sorry, no posts matched your criteria.', 'mediumish' ); ?></p>

    <?php endif; ?>

</section> 
    

   
<?php if ( $mediumish_homecategorycloud_active == 0 ) : ?>    
        <div class="jumbotron fortags mt-4" <?php if ($mediumish_homecategorycloud_bg) { ?> style="background-image:url(<?php echo $mediumish_homecategorycloud_bg; ?>);" <?php } ?> >
            <div class="row">
                <div class="col-md-4 align-self-center text-center">
                    <h2 class="hidden-sm-down text-white"><?php _e( 'Explore', 'mediumish' ); ?> &rarr;</h2>
                </div>
                <div class="col-md-8 align-self-center text-center">
                 <?php wp_tag_cloud( array( 'taxonomy' => 'category' ) ); ?>
                </div>
            </div>
        </div>    
<?php endif; ?>
    
</div>
<!-- /.container --> 

<?php get_footer(); ?>