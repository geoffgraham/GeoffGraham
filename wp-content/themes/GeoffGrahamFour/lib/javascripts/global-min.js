function moveProgressBar(){console.log("moveProgressBar");var t=$(".progress-wrap").data("progress-percent")/100,e=$(".progress-wrap").width(),i=t*e,n=1500;$(".progress-bar").stop().animate({left:i},n)}$(document).ready(function(){$("body").addClass("js");var t=$("#menu"),e=$(".menu-icon");e.click(function(){return e.toggleClass("active"),t.toggleClass("active"),!1})}),jQuery(document).ready(function(){var t=220,e=500;jQuery(window).scroll(function(){jQuery(this).scrollTop()>t?jQuery(".back-to-top").fadeIn(e):jQuery(".back-to-top").fadeOut(e)}),jQuery(".back-to-top").click(function(t){return t.preventDefault(),jQuery("html, body").animate({scrollTop:0},e),!1})}),$(document).ready(function(){$(".chart .teal").mouseenter(function(){$(this).animate({height:"35%"},800)}),$(".chart .teal").mouseleave(function(){$(this).animate({height:"95%"},800)}),$(".chart .salmon").mouseenter(function(){$(this).animate({height:"35%"},800)}),$(".chart .salmon").mouseleave(function(){$(this).animate({height:"90%"},800)}),$(".chart .peach").mouseenter(function(){$(this).animate({height:"35%"},800)}),$(".chart .peach").mouseleave(function(){$(this).animate({height:"80%"},800)}),$(".chart .lime").mouseenter(function(){$(this).animate({height:"35%"},800)}),$(".chart .lime").mouseleave(function(){$(this).animate({height:"75%"},800)}),$(".chart .grape").mouseenter(function(){$(this).animate({height:"35%"},800)}),$(".chart .grape").mouseleave(function(){$(this).animate({height:"60%"},800)})}),moveProgressBar(),$(window).resize(function(){moveProgressBar()}),$(document).ready(function(){$(".content").fitVids()}),function(t){t.fn.fitText=function(e,i){var n=e||1,a=t.extend({minFontSize:Number.NEGATIVE_INFINITY,maxFontSize:Number.POSITIVE_INFINITY},i);return this.each(function(){var e=t(this),i=function(){e.css("font-size",Math.max(Math.min(e.width()/(10*n),parseFloat(a.maxFontSize)),parseFloat(a.minFontSize)))};i(),t(window).on("resize.fittext orientationchange.fittext",i)})}}(jQuery),function(t){function e(e,i,n,a){var r=e.text().split(i),o="";r.length&&(t(r).each(function(t,e){o+='<span class="'+n+(t+1)+'">'+e+"</span>"+a}),e.empty().append(o))}var i={init:function(){return this.each(function(){e(t(this),"","char","")})},words:function(){return this.each(function(){e(t(this)," ","word"," ")})},lines:function(){return this.each(function(){var i="eefec303079ad17405c889e092e105b0";e(t(this).children("br").replaceWith(i).end(),i,"line","")})}};t.fn.lettering=function(e){return e&&i[e]?i[e].apply(this,[].slice.call(arguments,1)):"letters"!==e&&e?(t.error("Method "+e+" does not exist on jQuery.lettering"),this):i.init.apply(this,[].slice.call(arguments,0))}}(jQuery),function(t){"use strict";t.fn.fitVids=function(e){var i={customSelector:null};if(!document.getElementById("fit-vids-style")){var n=document.head||document.getElementsByTagName("head")[0],a=".fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}",r=document.createElement("div");r.innerHTML='<p>x</p><style id="fit-vids-style">'+a+"</style>",n.appendChild(r.childNodes[1])}return e&&t.extend(i,e),this.each(function(){var e=["iframe[src*='player.vimeo.com']","iframe[src*='youtube.com']","iframe[src*='youtube-nocookie.com']","iframe[src*='kickstarter.com'][src*='video.html']","object","embed"];i.customSelector&&e.push(i.customSelector);var n=t(this).find(e.join(","));n=n.not("object object"),n.each(function(){var e=t(this);if(!("embed"===this.tagName.toLowerCase()&&e.parent("object").length||e.parent(".fluid-width-video-wrapper").length)){var i="object"===this.tagName.toLowerCase()||e.attr("height")&&!isNaN(parseInt(e.attr("height"),10))?parseInt(e.attr("height"),10):e.height(),n=isNaN(parseInt(e.attr("width"),10))?e.width():parseInt(e.attr("width"),10),a=i/n;if(!e.attr("id")){var r="fitvid"+Math.floor(999999*Math.random());e.attr("id",r)}e.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",100*a+"%"),e.removeAttr("height").removeAttr("width")}})})}}(window.jQuery||window.Zepto);