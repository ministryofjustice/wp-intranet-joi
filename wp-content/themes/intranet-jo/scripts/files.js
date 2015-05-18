// JQuery find file ending and adding class 
// files.js
// Word 
 
$(function() {
 $("a[href$='.doc']").addClass("doc");
});	 
 
$(function() {
 $("li [href$='.doc']").removeClass("doc").closest('li').addClass("doc");
});	

// PDF 

$(function() {
 $("a[href$='.pdf']").addClass("pdf");
});	

$(function() {
 $("li [href$='.pdf']").removeClass("pdf").closest('li').addClass("pdf");
});	

// Excel

$(function() {
 $("a[href$='.xls']").addClass("xls");
});	

$(function() {
 $("li [href$='.xls']").removeClass("xls").closest('li').addClass("xls");
});	

// Email

$(function() {
 $("a[href^='mailto']").addClass("email");
});	

$(function() {
 $("li [href^='mailto']").removeClass("email").closest('li').addClass("email");
});


// External

$(function() {
 $("a[href^='http://']").addClass("external");
});	

$(function() {
 $("li [href^='http://']").removeClass("external").closest('li').addClass("external");
});



$(function() {
 $("#footer a[href^='http://']").removeClass("external");
});	

// This removes the background image from li's that contain a ul and ol

$(function() {
 $("ul li ul").closest('li').addClass("ul-li-ul");
});

$(function() {
 $("ol li ol").closest('li').addClass("ol-li-ol");
});

$(function() {
 $("#imga a[href^='http://']").removeClass("external");
});	