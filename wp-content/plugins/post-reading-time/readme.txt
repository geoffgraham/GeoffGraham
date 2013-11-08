=== Plugin Name ===
Contributors: ZeroCool51
Donate link: http://wpplugz.is-leet.com/
Tags: reading plugin, reading time, reading time minutes, average reading time, reading plug, wordpress reading plugin, wordpress reading time plugin, reading time plugin
Requires at least: 2.0.2
Tested up to: 3.4.1
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple wordpress plugin that estimates the time a reader will need to go through the article.

== Description ==

This is a simple wordpress plugin that estimates the time a reader will need to go through the article.

An average man reads 250 - 300 words for minute, so you can change the default settings any way you like, the default here is 200 words per minute.

What this plugin offers:

*   Show the time in minutes or minutes and seconds
*   Select the prefix and suffix before the time shows
*   Customize the words per minute number
*   Widget support.

== Installation ==

1. Upload the plugin directory to to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place `<?php post_read_time(); ?>` in your templates or add the widget to your theme

== Frequently Asked Questions ==

None at the moment.

== Screenshots ==

1. An example of how the plugin functions and works (left part of screenshot, reading time)
2. The admin area of the plugin
3. The widget in action.

== Changelog ==

= 1.1 =

* [Fix] Fixed a feature bug, if showing post read time on main page and using excerpts, the whole post content was not used.

= 1.0 =

* Marked release as final and stable.

= 0.3 =

* Added widget support
* Security update in the admin area (check if user is admin).

= 0.2 =

* Some cosmetic surgery in the admin area.

= 0.11 =

* Minimal changes, updated the website of the plugin.

= 0.1 =
* The initial version of the plugin.

== Upgrade Notice ==

= 0.3 =
There is a slight security issue in the admin area (checking if user is admin), please upgrade.

== Homepage ==

Visit the [homepage](http://wpplugz.is-leet.com "homepage of post reading time") of the plugin.
