</div><!-- /.site-content -->
        <div _ngcontent-c3="" class="blue-bg"></div>
        <div class="container">
            <!-- <footer class="footer">
                <p class=""> <?php echo get_theme_mod('footer_textleft', '&copy; Website Name. All rights reserved.'); ?> </p>
                <p > <?php echo get_theme_mod('footer_textright', 'Mediumish Theme by WowThemesNet.'); ?> </p>
                <div class="clearfix"></div>
                <a href="" class="back-to-top hidden-md-down">
                <i class="fa fa-angle-up"></i>
                </a>
            </footer> -->

            <!-- Footer Start -->
            <footer class="cm-ftr">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"><a href="/" class="logo"><img src="/blog/wp-content/uploads/2018/05/Fynches_Logo_Teal.png" alt="" title=""></a></div>
                </div>
                <div class="row pt-3 pb-3">
                    <div class="col-md-12 col-lg-10">
                        <!-- <ul class="list-unstyled">
                            <li><a href="javascript:void(0)">Create Experience</a></li>
                            <li><a href="javascript:void(0)">Find Event</a></li>
                            <li><a href="javascript:void(0)">Testimonials</a></li>
                            <li><a href="javascript:void(0)">About</a></li>
                            <li><a href="javascript:void(0)">Help</a></li>
                            <li><a href="javascript:void(0)">Contact</a></li>
                            <li><a href="javascript:void(0)">Sign In</a></li>
                            <li><a href="javascript:void(0)">Let us know how we're doing</a></li>
                        </ul> -->
                        <ul class="list-unstyled copyright">
                            <li>&copy; 2018 All Right Reserved</li>
                            <li><a href="javascript:void(0)">Term &amp; Conditions</a></li>
                            <li><a href="javascript:void(0)">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-md-12 col-lg-2">
                        <div class="social-sec">
                            <a href="https://twitter.com/fynches" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="https://www.facebook.com/fynchescom" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="https://www.instagram.com/fynches/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-sm-12">
                        <ul class="list-unstyled copyright">
                            <li>&copy; 2018 All Right Reserved</li>
                            <li><a href="javascript:void(0)">Term &amp; Conditions</a></li>
                            <li><a href="javascript:void(0)">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </footer>
        <!-- End -->
        </div>
        <?php wp_footer();?>
        <?php echo get_theme_mod('footer_sectiontracking'); ?>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $("header form").focusin(function(){
                    $(".src-img").addClass("searched-icon");
                });
                $("header form").focusout(function(){
                    $(".src-img").removeClass("searched-icon");
                });
            });
        </script>
    </body>
</html>
