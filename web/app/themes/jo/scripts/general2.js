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
          var pageTracker = _gat._getTracker("UA-1165903-11");
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
 * Icons for links
*/
$(document).ready(function() {
    // Add pdf icons to pdf links
    $("a[href$='.pdf']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Please note: This is a link to an PDF document  and will open a new browser window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();       
    });
    $("a[href$='.PDF']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Please note: This is a link to an PDF document  and will open a new browser window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();      
    });  
    // Add doc icons to doc links
    $("a[href$='.doc']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Please note: This is a link to a Word document and will open a new browser window");
       var $parent = $(this).parent().get(0).tagName.toLowerCase();
    });
    $("a[href$='.DOC']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Please note: This is a link to a Word document and will open a new browser window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();
    });    
    
	// Add dot icons to dot links
    $("a[href$='.dot']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Please note: This is a link to a Word template and will open a new browser window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();
    });
    $("a[href$='.DOT']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Please note: This is a link to a Word template and will open a new browser window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();     
    });    
    // Add ppt icons to ppt links
    $("a[href$='.ppt']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Please note: This is a link to a Powerpoint presentation and will open a new browser window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();      
    });
    $("a[href$='.PPT']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Please note: This is a link to a Powerpoint presentation and will open a new browser window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();       
    });    
    // Add xls icons to xls links
    $("a[href$='.xls']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Please note: This is a link to an Excel spreadsheet  and will open a new browser window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();       
    });
    $("a[href$='.XLS']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Please note: This is a link to an Excel spreadsheet  and will open a new browser window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();      
    });    
    // Add email icons to email links
    $("a[href^='mailto:']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Send email");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();     
    });
    // Add html icons to http links
	$("a[href^='http:'], #right a[href^='http:']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Please note: This is an external link and will open a new browser window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();  
    });
    // Add html icons to https links
    $("a[href^='https:'], #right a[href^='https:']").each(function (i) {
        $(this).attr("title", $(this).attr("title") + "Please note: This is a link to an external link and will open a new browser window");
        var $parent = $(this).parent().get(0).tagName.toLowerCase();    
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