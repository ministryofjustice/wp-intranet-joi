/* JavaScript Document */
/**
 * [File : general.js]
 *
 * Project:         Ministry of Justice Intranet
 * Version:         1.0.
 * Last change:     22/10/09
 * Assigned to:     Geoff Anscombe, Harjinder Virk MOJ
 *
 *
 *
 * [Table of contents]
 *
 *  Google code
 *  Temp jquery
 *  Smooth scrolling anchors
 *  Icons for links
 *  Content fader functions
 *    Slider function with pagination
 *    Lightbox prettyphoto
 *    Accordian function
 *    Set your intranet function
*/
/*
$(document).ready(function(){
      $('#mainContent table').tableHover();
});      
*/
/*------------------------------------------------------------------
 * Google code
*/
$(document).ready(function(){
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    $.getScript(gaJsHost + "google-analytics.com/ga.js", function(){
        try {
          var pageTracker = _gat._getTracker("UA-6767316-1");
              pageTracker._setSessionTimeout("900");  
              pageTracker._setDomainName("none");
            pageTracker._trackPageview();            
        } catch(err) {}
        
        // Track downloads, http and mailto's
        var filetypes = /\.(zip|exe|pdf|ppt|doc*|xls*|ppt*|mp3)$/i;
        $('a').each(function(){
            var href = $(this).attr('href');
            if ((href.match(/^https?\:/i)) && (!href.match(document.domain))){
                $(this).click(function() {
                    var extLink = href.replace(/^https?\:\/\//i, '');
                    var extLink = 'ext:' + extLink;
                    pageTracker._trackPageview(extLink);
                });
            }
            else if (href.match(/^mailto\:/i)){
                $(this).click(function() {
                    var mailLink = href;
                    pageTracker._trackPageview(mailLink);
                });
            }
            else if (href.match(filetypes)){
                $(this).click(function(event) {
                    var source = event.target.href;
                    pageTracker._trackPageview(source);
                });
            }
        });
        
        
        /* Track adverts
        $('.ads a').each(function(){
            var href = $(this).attr('href');
            var title = $(this).attr('title');
            $(this).click(function() {
                var adslink = href;
                var adstitle = title;
                // pageTracker._trackPageview(adslink);
                
                pageTracker._trackEvent('Adverts', title, filename, 1);
            });
        });
        */
        
        /*********   rate me    ********/
        /* check to see if cookies are enabled*/
        if($.cookie('cookie_check')){
            // show rate-me-panel
            $("#rate-me-panel").show();
            // hide more/less results
            $("#more").hide();
            $("#less").hide();        
            // Get all cookies available function
            function get_cookies_array() {
                var cookies = { };
                if (document.cookie && document.cookie != '') {
                    var split = document.cookie.split(';');
                    for (var i = 0; i < split.length; i++) {
                        var name_value = split[i].split("=");
                        name_value[0] = name_value[0].replace(/^ /, '');
                        cookies[decodeURIComponent(name_value[0])] = decodeURIComponent(name_value[1]);
                    }
                }
                return cookies;
            }
            // invoke get all cookie function
            var cookies = get_cookies_array();
            // loop through all cookies
            for(var name in cookies) {
                // get current url filename only
                var urlname = window.location.href.substr(window.location.href.lastIndexOf("/"));
                // if a cookie matches current url add hide rate-me div and show correct results div
                if(cookies[name] == urlname + 'like'){
                    $("div#rate-me").hide();
                    $("#more").show();
                    var matchFound = true; 
                }
                if(cookies[name] == urlname + 'hate'){
                    $("div#rate-me").hide();
                    $("#less").show();
                    var matchFound = true; 
                }        
            }
            // if a cookie did not match the current url show rate-me div
            if(!matchFound){
                $("div#rate-me").show();
                var $mojozineTitle = $("#mainContent h2").text();
                var filename = urlname + ' - ' + $mojozineTitle;
            }
            // rate me hyperlinks function (shows and hides div containers and creates cookie using current url filename ie /index.htm and add like or hate to the end
            $('#rate-me a').click(function() {
                var $rate_title = $(this).attr("title");
                // if more is clicked
                if ($rate_title == 'more'){
                    $("div#rate-me").hide();
                    $("div#more").show();
                    $.cookie(urlname, urlname + 'like', {expires:365});
                    pageTracker._trackEvent('MoJozine','More', filename, 1);
                    pageTracker._trackPageview('/votes/mojozine-more');
                    return false;
                }
                // if less is clicked
                if ($rate_title == 'less'){
                    $("div#rate-me").hide();
                    $("div#less").show();
                    $.cookie(urlname, urlname + 'hate', {expires:365});
                    pageTracker._trackEvent('MoJozine','Less', filename, 1);
                    pageTracker._trackPageview('/votes/mojozine-less');
                    return false;
                }
            });
            // undo hyperlinks function (shows and hides div containers and deletes cookie for current page
            $('a.undo').click(function() {
                var $rate_title = $(this).attr("title");
                if ($rate_title == 'more-undo'){
                    $("div#rate-me").show();
                    $("div#more").hide();
                    $.cookie(urlname, '');
                    pageTracker._trackEvent('MoJozine','More', filename, -1);
                    pageTracker._trackPageview('/votes/mojozine-more-undo');
                    return false;
                }
                if ($rate_title == 'less-undo'){
                    $("div#rate-me").show();
                    $("div#less").hide();
                    $.cookie(urlname, '');
                    pageTracker._trackEvent('MoJozine','Less', filename, -1);
                    pageTracker._trackPageview('/votes/mojozine-less-undo');
                    return false;
                }
            });
        }
    });
});
/*------------------------------------------------------------------
 * Temp jquery
*/
$(document).ready(function() {  
    $('.landing-box h2 a').append(' &raquo;');
});    
/*------------------------------------------------------------------
 * Smooth scrolling anchors
*/
/* 
$(document).ready(function() {  
    $('.anchors').localScroll({
        duration:400
    });
    $('.back-to-top').localScroll({
        duration:400
    });    
});     
*/
/*------------------------------------------------------------------
 * Icons for links
*/
$(document).ready(function() {
    // Add pdf icons to pdf links
    $("a[href$='.pdf']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "PDF, opens in a new window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();
        if ($parent == "li") {
            $(this).parent().addClass("pdf");
        } else {
            $(this).addClass("pdf");
        }
        $(this).click(function(){
            window.open(this.href);
            return false;
        });
    });
    $("a[href$='.PDF']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "PDF, opens in a new window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();
        if ($parent == "li") {
            $(this).parent().addClass("pdf");
        } else {
            $(this).addClass("pdf");
        }
        $(this).click(function(){
            window.open(this.href);
            return false;
        });
    });    
    // Add doc icons to doc links
    $("a[href$='.doc']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "MS Word, opens in a new window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();
        if ($parent == "li") {
            $(this).parent().addClass("doc");
        } else {
            $(this).addClass("doc");
        }
        $(this).click(function(){
            window.open(this.href);
            return false;
        });
    });
    $("a[href$='.DOC']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "MS Word, opens in a new window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();
        if ($parent == "li") {
            $(this).parent().addClass("doc");
        } else {
            $(this).addClass("doc");
        }
        $(this).click(function(){
            window.open(this.href);
            return false;
        });
    });    
    // Add dot icons to dot links
    $("a[href$='.dot']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "MS Word template, opens in a new window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();
        if ($parent == "li") {
            $(this).parent().addClass("dot");
        } else {
            $(this).addClass("dot");
        }
        $(this).click(function(){
            window.open(this.href);
            return false;
        });
    });
    $("a[href$='.DOT']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "MS Word template, opens in a new window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();
        if ($parent == "li") {
            $(this).parent().addClass("dot");
        } else {
            $(this).addClass("dot");
        }
        $(this).click(function(){
            window.open(this.href);
            return false;
        });
    });    
    // Add ppt icons to ppt links
    $("a[href$='.ppt']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Powerpoint, opens in a new window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();
        if ($parent == "li") {
            $(this).parent().addClass("ppt_icon");
        } else {
            $(this).addClass("ppt_icon");
        }
        $(this).click(function(){
            window.open(this.href);
            return false;
        });
    });
    $("a[href$='.PPT']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Powerpoint, opens in a new window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();
        if ($parent == "li") {
            $(this).parent().addClass("ppt_icon");
        } else {
            $(this).addClass("ppt_icon");
        }
        $(this).click(function(){
            window.open(this.href);
            return false;
        });
    });    
    // Add xls icons to xls links
    $("a[href$='.xls']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Excel, opens in a new window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();
        if ($parent == "li") {
            $(this).parent().addClass("xls");
        } else {
            $(this).addClass("xls");
        }
        $(this).click(function(){
            window.open(this.href);
            return false;
        });
    });
    $("a[href$='.XLS']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Excel, opens in a new window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();
        if ($parent == "li") {
            $(this).parent().addClass("xls");
        } else {
            $(this).addClass("xls");
        }
        $(this).click(function(){
            window.open(this.href);
            return false;
        });
    });    
    // Add email icons to email links
    $("a[href^='mailto:']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Send email");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();
        if ($parent == "li") {
            $(this).parent().addClass("email");
        } else {
            $(this).addClass("email");
        }
        $(this).click(function(){
            window.open(this.href);
            return false;
        });
    });
    // Add html icons to http links
    $("#mainContent a[href^='http:'], #rightColumn a[href^='http:']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "External website, opens in a new window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();
        if ($parent == "li") {
            $(this).parent().addClass("http");
        } else {
            $(this).addClass("http");
        }
        $(this).click(function(){
            window.open(this.href);
            return false;
        });
    });
    // Add html icons to https links
    $("#mainContent a[href^='https:'], #rightColumn a[href^='https:']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "External website, opens in a new window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();
        if ($parent == "li") {
            $(this).parent().addClass("http");
        } else {
            $(this).addClass("http");
        }
        $(this).click(function(){
            window.open(this.href);
            return false;
        });
    });    
    
});
/*------------------------------------------------------------------
 * Content fader functions
*/
$(document).ready(function() {    
    // turn tabs on
    $("body.section1 .content-switcher-newspanel1 #tabs").show();
    // mojozine + latest news + media summaries + insight + announcements
    $('body.section1 .content-switcher-newspanel1').tabs(2,{ fxFade: true, fxSpeed: 'slow' });    
    $('.content-switcher-newspanel1 h2').addClass('offset');
    
    $("body.section1 .static-panel #tabs").show();
    // mojozine + latest news + media summaries + insight + announcements
    
    /* $('body.section1 .offlinepanel #panel_offline').fadeIn('slow');*/
    
    $('.static-panel h2').addClass('offset');
    
    
});
/*------------------------------------------------------------------
 * Slider function with pagination
*/
$(document).ready(function() {    
    $("#slider").easySlider({
        auto: true,
        continuous: true,
        numeric: true,
        speed: 1200,
        pause: 9000,
        numericId: 'controls'
    });
});
/*------------------------------------------------------------------
 * Lightbox prettyphoto
*/
$(document).ready(function() {    
                           
    $("a[rel^='prettyphoto']").prettyphoto({
        animationSpeed: 'fast',
        padding: 40,
        opacity: 0.85,
        showTitle: true,
        allowresize: true,
        
        theme: 'dark_square',
        callback: function(){} 
    
    });
});
/*------------------------------------------------------------------
 * Accordian function
*/
$(document).ready(function() {
    $('div.accordian> div').hide().addClass('offset');
    $('div.accordian> div.default').show().removeClass('offset');
    $('div.accordian> p.accordian-heading').click(function() {
        var $text = $(this).text().replace(/ /g,'');
        if($text == 'Open'){
            $(this).text('Close');
            $(this).removeClass('open');
            $(this).addClass('close');
        } else if ($text == 'Close') {
            $(this).text('Open');
            $(this).removeClass('close');
            $(this).addClass('open');
        }
        var $nextDiv = $(this).next();
        var $visibleSiblings = $nextDiv.siblings('div:visible');
            if ($visibleSiblings.length ) {
                $visibleSiblings.slideUp('slow', function() {
                    $visibleSiblings.addClass('offset');
                    $nextDiv.removeClass('offset');
                    $nextDiv.slideDown('slow');
                });
            } else {
                $nextDiv.removeClass('offset');
                $nextDiv.slideToggle('slow');
            }
    });
});

/*------------------------------------------------------------------
 * Set your intranet function
*/
$(document).ready(function() {
    /* check to see if cookies are enabled */
    $.cookie('cookie_check', 'cookie test');
    if($.cookie('cookie_check')){
        // if javascript is turned on enter these values */
        $('.set-your-intranet-header').replaceWith('<div class="heading set-your-intranet-header">Add an intranet link</div>');
        $('.set-your-intranet .accordian p.accordian-heading').show();
        // add the reset button to the bottom of the list */
        $("div.set-your-intranet ul").append('<li><a href="/index.htm" title="Reset">Reset</a></li>');
        // if a intranet choice is made do this */
        $('div.set-your-intranet a').click(function() {
            // set href values to variables */
            var $intranet_link = $(this).attr("href");
            // set title values to variables*/
            var $intranet_name = $(this).attr("title");
            // set title values to variables after lowercasing and removing whitespace*/
            var $intranet_img = $(this).attr("title").toLowerCase().replace(/ /g,'');
            // create and set cookies from above variables */
            $.cookie('the_cookie_link', $intranet_link, {expires:365});
            $.cookie('the_cookie_name', $intranet_name, {expires:365});
            $.cookie('the_cookie_img', $intranet_img, {expires:365});
            // get cookies values and assign to variables */
            var $cookie_link_value = $.cookie('the_cookie_link');
            var $cookie_image_value = $.cookie('the_cookie_img');
            var $cookie_name_value = $.cookie('the_cookie_name');
            var $image_displayed = $("div.set-your-intranet> .image").attr("style").toLowerCase().slice(0, 13);
            // show and replace image and link */
            if($cookie_image_value == 'reset'){
                $('div.set-your-intranet> .image').slideUp('slow');
                $('.set-your-intranet-header').replaceWith('<div class="heading set-your-intranet-header">Add an intranet link</div>');
            }
            else if($image_displayed == 'display: none') {
                $('.set-your-intranet-header').replaceWith('<div class="heading set-your-intranet-header">' + $cookie_name_value + '</div>');
                $('div.set-your-intranet> .image').replaceWith("<div class='image' style='display: none;'><a href=" + $cookie_link_value + "><img src='images/set-intranet/" + $cookie_image_value + ".gif' /></a></div>");
                $('div.set-your-intranet> .image').slideToggle();
            }
            else {
                $('.set-your-intranet-header').replaceWith('<div class="heading set-your-intranet-header">' + $cookie_name_value + '</div>');
                $('div.set-your-intranet> .image').fadeOut('slow');
                $('div.set-your-intranet> .image').replaceWith("<div class='image'><a href=" + $cookie_link_value + "><img src='images/set-intranet/" + $cookie_image_value + ".gif' /></a></div>");
                $('div.set-your-intranet> .image').hide();
                $('div.set-your-intranet> .image').fadeIn('slow');
            }
            $('div.set-your-intranet div.accordian> div').slideToggle('slow');
            $.cookie('cookie_do_not_display', 'Do not display', {expires:365});
            setTimeout(function() { $('.one-click-message').animate({opacity: "hide", top: "-50px"}, "slow"); }, 500);
            setTimeout(function() { $('.open-message').slideUp('slow'); }, 1000);
            return false;
        });
        // if cookie is set show and assign values */
        if ($.cookie('the_cookie_link')) {
            var $cookie_link_value = $.cookie('the_cookie_link');
            var $cookie_image_value = $.cookie('the_cookie_img');
            var $cookie_name_value = $.cookie('the_cookie_name');
            // if cookie is reset then hide otherwise show image and link */
            if($cookie_image_value == 'reset'){
                $('div.set-your-intranet> .image').hide();
            } else {
                $('div.set-your-intranet> .image').show();
                $('.set-your-intranet-header').replaceWith('<div class="heading set-your-intranet-header">' + $cookie_name_value + '</div>');
                $('div.set-your-intranet> .image').replaceWith("<div class='image'><a href=" + $cookie_link_value + "><img src='images/set-intranet/" + $cookie_image_value + ".gif' /></a></div>");
            }
        } else {
            $('div.set-your-intranet> .image').hide();
            $('.set-your-intranet-header').replaceWith('<div class="heading set-your-intranet-header">Add an intranet link</div>');
        }
    } else {
        $('div.set-your-intranet div.accordian> p.accordian-heading').hide();
        $('div.set-your-intranet div.accordian> div').show();
    }
});
/* on-click-message */
$(document).ready(function () {
    //$.cookie('cookie_do_not_display', '', { expires: -1 }); // delete cookie
    var $cookie_do_not_display = $.cookie('cookie_do_not_display');
    if (!$cookie_do_not_display) {
            setTimeout(function() { $('.open-message').slideDown('slow'); }, 1000);
            setTimeout(function() {
                $('.one-click-message').animate({opacity: "show", top: "-10px"}, "slow");
                return false;
            }, 2000);
    }
    $('.one-click-message a').click(function() {
        $.cookie('cookie_do_not_display', 'Do not display', {expires:365});
        setTimeout(function() { $('.one-click-message').animate({opacity: "hide", top: "-50px"}, "slow"); }, 500);
        setTimeout(function() { $('.open-message').slideUp('slow'); }, 1000);
    });
});
/* cute time thing */
$(document).ready(function () {
    // both lines assign cuteTime controller to all 'timetamp' class objectes
    $('.timestamp_move').cuteTime();
    // returns a cuter string of the passed in datetime
    $('.predetermined').text(" -> "+$.cuteTime('2009/10/16 22:11:19'));
    my_cutetime = $('.timestamp').cuteTime({ refresh: 10000 });
});