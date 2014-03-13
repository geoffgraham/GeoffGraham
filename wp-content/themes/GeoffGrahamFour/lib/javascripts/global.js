// GLOBAL JAVASCRIPTS
// ------------------

// Main Menu Toggle
$(document).ready(function() {
  $('body').addClass('js');
  var $menu = $('#menu'),
    $menulink = $('.menu-icon');
  
  // On clock, add .active
  $menulink.click(function() {
    $menulink.toggleClass('active');
    $menu.toggleClass('active');
    return false;
  });

});

// Back to Top with smooth scroll
jQuery(document).ready(function() {
  var offset = 220;
  var duration = 500;
  jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > offset) {
      jQuery('.back-to-top').fadeIn(duration);
    } else {
      jQuery('.back-to-top').fadeOut(duration);
    }
});
  
  jQuery('.back-to-top').click(function(event) {
      event.preventDefault();
      jQuery('html, body').animate({scrollTop: 0}, duration);
      return false;
  });
});

// Animate Bar Chart
$(document).ready(function(){
  $(".chart .teal").mouseenter(function(){
    $(this).animate({height:'35%'},800);
  });
  $(".chart .teal").mouseleave(function(){
    $(this).animate({height:'95%'},800);
  });
  $(".chart .salmon").mouseenter(function(){
    $(this).animate({height:'35%'},800);
  });
  $(".chart .salmon").mouseleave(function(){
    $(this).animate({height:'90%'},800);
  });
  $(".chart .peach").mouseenter(function(){
    $(this).animate({height:'35%'},800);
  });
  $(".chart .peach").mouseleave(function(){
    $(this).animate({height:'80%'},800);
  });
  $(".chart .lime").mouseenter(function(){
    $(this).animate({height:'35%'},800);
  });
  $(".chart .lime").mouseleave(function(){
    $(this).animate({height:'75%'},800);
  });
  $(".chart .grape").mouseenter(function(){
    $(this).animate({height:'35%'},800);
  });
  $(".chart .grape").mouseleave(function(){
    $(this).animate({height:'60%'},800);
  });
});

// Horizontal Bar Chart
moveProgressBar();
// on browser resize...
$(window).resize(function() {
  moveProgressBar();
});
// Signature progress
function moveProgressBar() {
    console.log("moveProgressBar");
    var getPercent = ($('.progress-wrap').data('progress-percent') / 100);
    var getProgressWrapWidth = $('.progress-wrap').width();
    var progressTotal = getPercent * getProgressWrapWidth;
    var animationLength = 1500;
    // on page load, animate percentage bar to data percentage length
    // .stop() used to prevent animation queueing
    $('.progress-bar').stop().animate({
        left: progressTotal
  }, animationLength);
}

// FitVids
$(document).ready(function(){
    $(".content").fitVids();
  });