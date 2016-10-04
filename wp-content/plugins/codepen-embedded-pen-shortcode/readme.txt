 === Plugin Name ===

Plugin Name: CodePen Embedded Pens Shortcode
Description: Enables shortcode to embed Pens.
Version: 0.7.1
License: GPL
Author: Chris Coyier / CodePen
Author URI: http://codepen.io
Requires at least: 2.6
Tested up to: 4.5.3
Stable tag: 0.7.1

Allows the use of a special shortcode [codepen_embed] for embedding Pens from CodePen.

== Description ==

Allows the use of a special shortcode `[codepen_embed]` for embedding Pens from [CodePen](http://codepen.io).

You can learn more about CodePen [here](http://codepen.io/hello) and about this plugin [here](http://blog.codepen.io/documentation/features/wordpress-plugin/).

### Basic Usage

    [codepen_embed height=300 theme_id=1 slug_hash='jwGBh' user='arasdesign' default_tab='html' animations='run']
      See the Pen <a href='http://codepen.io/arasdesign/pen/jwGBh'>Flat minion</a> by Amin Poursaied (<a href='http://codepen.io/arasdesign'>@arasdesign</a>) on <a href='http://codepen.io'>CodePen</a>
    [/codepen_embed]

### The Point

1. You can use shortcodes in the "Visual" editor. CodePen Embeds are copy-and-paste HTML that don't work when using the editor that way. If you ever use the Visual editor in WordPress, you'll probably want to use this plugin.

1. You can set a default theme, or override any theme set via Shortcode attribute.

1. Hopefully eventually this plugin will have more functionality. Like have a fancy UI for picking Pens to embed and more control over the HTML output.

== Installation ==

For old school manual installation people: copy the folder "codepen_embed" into the /wp-content/plugins/ folder. Then go to the Plugins area of the Admin and activate. Otherwise, search for "CodePen Embed" from the admin area of your WordPress site in Plugins > Add New.

== Screenshots ==

1. An Embedded Pen
2. Settings Page
3. Editor with Shortcode

== Changelog ==

- 0.1 - Beta
- 0.2 - Adding line_numbers attribute
- 0.3 - Default for `data_animations` is now `run`, as documented.
- 0.4 - Added `preview` attribute. Removed line numbers attribute.
- 0.5 - Defaulting to v2 of Embeds by default
- 0.6 - Make sure `theme_id="light"` and `theme_id="dark"` work.
- 0.7 - Making sure `data_edtiable` support editable embeds.
  - 0.7.1 - Fixing naming thing

== Frequently Asked Questions ==

**What is CodePen?**

[CodePen](http://codepen.io) is a web app that allows anyone to create things with HTML, CSS, and JavaScript.

**Why is this useful?**

Shortcodes are clean! You can already copy and paste JavaScript or iframe code to embed a Pen onto a WordPress page, but you need to make sure to be in the "HTML" tab of the writing area. If a user is in the "Visual" (default) tab, the embed code will not work. Short codes will work either way.

You can also manage the default theme of the embeds with this plugin.