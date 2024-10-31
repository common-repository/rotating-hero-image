=== Rotating Hero Image ===

Contributors: wsxplugindev
Donate link: https://www.webstix.com/payment
Plugin Name: Rotating Hero Image
Plugin URI:  https://www.webstix.com/wordpress-plugin-development
Tags: hero banner, hero image, rotating image, timer
Author URI: https://www.webstix.com/
Author: Webstix
Requires at least: 5.4
Tested up to: 6.1.1
Stable tag: 1.0.7
Version: 1.0.4 
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Hero images on websites are great, but having the same one appear all the time gets... really boring. And using a slideshow on a page can add too much bloat to your code, slowing things down way too much.

Here's a plugin that rotates multiple hero images automatically - with no code bloat. Images can change hourly if you like or set it to daily (24 hours) - or whatever you want.

This is a plugin made by a website design company. We use this plugin on our clients' sites all the time. Now you can, too.

Display a hero banner on a page using a background image, title, description, and action button.

Add a hero image to your website's home page or inside page of your website that automatically changes after a set amount of time. Using this plugin, the image will change, but no extra code is necessary on the front side.

You can also create a hero image on category pages. Change any of them on an hourly basis.

=== How to use shortcodes on your homepage or other page/post: ===

Use this shortcode in the editor shortcode block and it will rotate all hero images:

`[wsx_hero_image]`

Use this shortcode for a specific category using the category ID:

`[wsx_hero_image catid="1"]`

If you want to add this functionality to your template/PHP file, use the following code:

`<?php echo do_shortcode('[wsx_hero_image catid="1"]'); ?>`


== Installation ==

Option 1:

1. Install the plugin in the Dashboard => Plugins menu => Add New => Upload => Select the zip file => Install Now
2. Activate plugin in the Dashboard => Plugins menu
3. After activating the plugin, go to Hero Image menu, add New category and hero image and save setting.

Option 2:

1. Upload the 'rotating-hero-image' folder to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. After activating the plugin, go to Hero Image menu, add New category and hero image and save setting.

== Upgrade Notice ==

Upgrades will not affect the plugin

== Frequently Asked Questions ==

= After activating the plugin what should I do? =

1. Add a new category.
2. Add a new hero image to that category.
3. Modify the plugin settings to what you want.
4. Use the category shortcode wherever you want.


== Screenshots ==

1. screenshot-1.png
2. screenshot-2.png
3. screenshot-3.png
4. screenshot-4.png
5. screenshot-5.png


== Changelog ==

= 1.0.0 =
* Initial Release -- February 2022


= 1.0.1 =
* Setting link added in plugin page.

= 1.0.2 =
* Fixed loaded media file deleted issue.

= 1.0.3 =
* Updated the plugin to be compatible with 5.9.3

= 1.0.4 =
* Updated the plugin to be compatible with 6.0

= 1.0.5 =
* Updated the plugin to be compatible with 6.0.1

= 1.0.6 =
* Updated the plugin to be compatible with 6.0.2

= 1.0.7 =
* Updated the plugin to be compatible with 6.1.1
