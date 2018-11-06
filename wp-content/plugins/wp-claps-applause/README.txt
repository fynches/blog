=== WP Applause Button ===
Contributors: WowThemesNet
Donate link: https://www.paypal.me/wowthemes/
Tags: applause, clap, claps, like, rate, like it, rating, like count, rating count
Requires at least: 3.0.1
Tested up to: 4.9.4
Stable tag: 1.0
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html



== Description ==
This plugin enables you to add an ajax Applause button to your WordPress post. Just activate it and it works, no options. It also includes a shortcode to let you manually add the button to the post.

Plugin homepage: [WP Applause Button - Plugin  Homepage](https://www.wowthemes.net/wowplugins/wp-applause-button/)

= Features =

*   AJAX applause without refreshing the page
*   Cookies support to prevent repeatedly click the button
*   Automatically add the button on bottom of post content
*	Shortcode included to add the button
*	Number of applauses

= Support =

We will do our best to provide support through the WordPress forums. However, all plugin support is provided [here](https://www.wowthemes.net/support/).

= Feedback =
If you like this plugin, then please leave us a good rating and review. Consider following us on [Twitter](https://twitter.com/wowthemesnet), [Facebook](https://www.facebook.com/wowthemesnet/), [Github](https://github.com/wowthemesnet).

== Installation ==

1. Upload `wp-claps-applause.zip` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How can I display the button at the top of post? =

By default the button will automatically appear on bottom of post. You can also change the position to the top of post by using filter 'wpli/position'. Put following codes to your 'functions.php'.

    add_filter( 'wpli/position', function() {return 'top';} );

= How can I use the shortcode? =
 
One thing you should pay attention to is that if you want to manually add the button by using the shortcode, you should disable the automatically adding functionality otherwise the button may appear multiple times. Put following codes to your theme's  functions.php'.

    add_filter( 'wpli/autoadd', function() {return false;} );

Then you can use the shortcode `[wp_claps_applause]`. **The shortcode should be used in the loop.**

== Screenshots ==

![enter image description here](screenshot.jpg)

== Changelog ==

= 1.0 =
* First Release - February 14, 2018

== Upgrade Notice ==
None