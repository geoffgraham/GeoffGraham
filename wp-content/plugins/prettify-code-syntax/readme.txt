=== Prettify Code Syntax ===
Contributors: jesucarr
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LEJAVTJUGWE3E
Tags: syntax, highlighter, prettify, code, markup
Requires at least: 3.0.1
Tested up to: 3.5.1
Stable tag: 1.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Code syntax highlighter using Google Prettify, supporting the HTML5 recommendation, and caching plugins.

== Description ==

The main reason for the development of this plugin was the lack of options supporting the **HTML5 recommendation**, where the code snippets should be tagged with `pre` followed by `code`, and optionally a class starting with `language-` and then our language.

You can use the plugin like this:

`<pre class="prettyprint"><code class="language-php">
// my code
</code></pre>`

Also very important is that although this plugin loads different files depending on your configuration, it fully **supports caching** scripts ([W3 Total Cache](http://wordpress.org/extend/plugins/w3-total-cache/)) to concatenate and compress all the css and js, so the impact in performance will be minimum.

= Languages =

This syntax highlighter is based on [Google Code Prettify](http://google-code-prettify.googlecode.com/svn/trunk/README.html) and should work on a number of languages including **C** and friends, **Java**, **Python**, **Bash**, **SQL**, **HTML**, **XML**, **Javascript**, **Makefiles**, and Rust. It works passably on **Ruby**, **PHP**, **VB**, and **Awk** and a decent subset of **Perl** and **Ruby**, but, because of commenting conventions, doesn't work on Smalltalk.

Other languages are supported via an extension (plugin options):  **CSS**, **SQL**, **YAML**, **Visual Basic**, **Clojure**, **Scala**, **Latek (TeX, LaTeX)**, **WikiText**, **Erlang**, **Go**, **Haskell**, **Lua**, **OCAML**, **SML**, **F#**, **Nemerle**, **Protocol Buffers**, **CHDL (VHDL)**, **XQ (XQuery)**, **Lisp, Scheme**, **Dart**, **Llvm**, **Mumps**, **Pascal**, **R, S**, **RD**, **TCL**

= Styles =

**Four** different styles are provided, and they can be previewed in the plugin options. They are modified to make sure they don't clash with any other styles in your theme.

You have also the option to include your **custom style**.

If you have a style that would like to see included in the option list, just [contact me](http://www.frontendmatters.com/contact/), or [fork me](https://github.com/jesucarr/wordpress-prettify-code-syntax).

= Notes =

* Plugin options are at Settings > Prettify Code Syntax. Have a look at the Screenshots tab to see how it looks like.

* If you don't care too much about the HTML5 recommendation, you can skip the `language-` class. The code always gets detected automatically.

* It will also work if you only use a `pre` tag without the `code` tag (but long lines will be wrapped instead of get horizontal scroll), or if you only use a `code` tag with the `prettyprint` class (but if you don't use `pre` your spaces/returns won't be maintained.)

* Be careful using the Visual Editor tab when inserting code, as some HTML tags will be modified or removed.

* Using a chaching plugin like W3 Total Cache is highly recommended.

= Demo = 

You can find a [front end demo](http://www.frontendmatters.com/open-source/wordpress-plugins/prettify-code-syntax/) here a the bottom.

== Installation ==

In your Wordpress installation go to Plugins > Add New, and search for "prettify code syntax" to find and install it automatically.

You can also install it manually:

1. Download the plugin and upload the contents to the `/wp-content/plugins/` directory, using FTP or the Upload tab in Plugins > Add New.
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Change settings if neccessary at Settings > Prettify Code Syntax

== Frequently Asked Questions ==

= I want to add the tags `</code>` or `</pre>` to my code, how can I do it without breaking the snippet? =

You can add a space before the closing `>`, like this `</code >`

= I found a bug, or have some code improvements, or have something to ask about the plugin. How do I contact you? =

Best thing with anything related to code would be to [fork me or open an issue](https://github.com/jesucarr/wordpress-prettify-code-syntax). For anything else you can [post a comment](http://www.frontendmatters.com/open-source/wordpress-plugins/prettify-code-syntax/) or [contact me](http://www.frontendmatters.com/contact/).

== Screenshots ==

1. Language options
2. Style options

== Changelog ==

= 1.2 =
* Add Twitter Bootstrap style
* Isolate default style. Every style now is independent
* Fix bug where all languages were loaded
* Code refactoring

= 1.1 =
* Add new languages
* Several fixes and code refactoring

= 1.0 =
* First release
