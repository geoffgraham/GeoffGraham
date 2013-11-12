—F}R<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":24:{s:2:"ID";i:1690;s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2013-08-27 19:00:15";s:13:"post_date_gmt";s:19:"2013-08-27 19:00:15";s:12:"post_content";s:3212:"<p class="subhead">There is a very clever technique in SASS that allows you to randomly assign values in your code. The effect essentially lets your code do some of the design work for you, creating random patterns that would be a pain in the ass to do yourself.</p>

Let's say you are creating a background of differently colored tiled squares. Typically, I would have approached this by creating a container div to hold my tiles, a second div for the tiles themselves, then probably used the nth-child pseudo element to assign color values to each tile. 

That might've looked something like the following.

<pre class="prettyprint language-css"><code>.container { 
  height: 800px;
  width: 800px;
}

.tile {
  float: left;
  height: 0;
  padding-bottom: 5%;
  width: 5%;
}

.tile:nth-child(1) { background-color: #2e3e5c; }

...

.tile:nth-child(10) { background-color: #ff9e2c }

/* And so on... */
</code>
</pre>

Yeah, it's doable. But it's also a lot of repeating lines, which is neither efficient or maintainable.

JavaScript is able to do the heavy lifting for us, but wouldn't it be nicer if CSS could do this instead? Well, it's our lucky day, because SASS does just that with the random() function. That same code above is reduced to the following.

<pre class="prettyprint language-scss"><code>.tile {
  float: left;
  height: 0;
  padding-bottom: 5%;
  width: 5%;
}

$s-min: 20;
$s-max: 70;
$l-min: 30;
$l-max: 90;

@for $i from 1 through 1000 {
  .square:nth-child(#{$i}) {
    background-color: hsl(random(360),$s-min+random($s-max+-$s-min),$l-min+random($l-max+-$l-min));
  }
}

body {
  margin: 0;
  overflow: hidden;
}
</code>
</pre>

What's the difference? Instead of having to writing a new line for every nth-child of the .tile element, we have created a function that takes care of it for us and loops it 1,000 times. Not only that, but we've created random colors by applying random() to the Hue, Saturation and Lightness (HSL)  values in the background-color.

Notice the number above the function? They're simply variables we've created to specify minimum and maximum values for HSL.

To get the full benefit of random(), I've seen others using HAML as an HTML preprocessor to output a loop for repeating element rather than typing them out by hand. HAML is new to me and it's orobably one of those things I should know, but here's how it could be used for this tile example.

<pre class="prettyprint language-haml"><code>
- (1..1000).each do
    .tile
</code>
</pre>

This is basically telling our code to output 1,000 copies of the .tile element. Much easier than tying that out 1,000 times ourselves!

OK, so what is this good for? I honestly don't know yet. I like the novelty of having a different design each time my code is rendered, but it's not exactly a functional benefit. If nothing else, it saves time and what's better than that?

There are a ton of more complicated and interesting examples floating around CodePen, but this illustrates the concept. I'm interested in diving deeper into this to see how it can be used in production.

[CodePen height=300 show=result href=LwHhF user=geoffgraham ]";s:10:"post_title";s:14:"Randomize SASS";s:12:"post_excerpt";s:198:"I recently discovered the random() function in SASS and think it's swell. This post is a quick walk-through of what it is with a very basic example of how it works and makes our CSS more efficient. ";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:14:"randomize-sass";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2013-09-13 15:41:29";s:17:"post_modified_gmt";s:19:"2013-09-13 15:41:29";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";i:0;s:4:"guid";s:29:"http://localhost:8888/?p=1690";s:10:"menu_order";i:0;s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";s:6:"filter";s:3:"raw";}}