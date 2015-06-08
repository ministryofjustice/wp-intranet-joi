// Searchbox for headers
$(document).ready(function() {
	$('#pf').hide();
	});
$(document).ready(function() {
	$('#people').click(function() {
		$('#int').hide();
		$('#pf').show();
		$('#intranet').attr('checked', 'checked');	
	});
	
	$('#intranet1').click(function() {
		$('#int').show();
		$('#pf').hide();
		$('#people1').attr('checked', 'checked');
	});	
});

/*
var browserType;

if (document.layers) {browserType = "nn4"}
if (document.all) {browserType = "ie"}
if (window.navigator.userAgent.toLowerCase().match("gecko")) {
   browserType= "gecko";
}

function mpf() {
  if (browserType == "gecko" )
     document.poppedLayer = 
         eval('document.getElementById("int")');
  else if (browserType == "ie")
     document.poppedLayer = 
        eval('document.getElementById("int")');
  else
     document.poppedLayer =   
        eval('document.layers["int"]');
  document.poppedLayer.style.display = "none";
  if (browserType == "gecko" )
     document.poppedLayer = 
         eval('document.getElementById("pf")');
  else if (browserType == "ie")
     document.poppedLayer = 
        eval('document.getElementById("pf")');
  else
     document.poppedLayer = 
         eval('document.layers["pf"]');
  document.poppedLayer.style.display = "block";
  
if (browserType == "gecko" )
     document.poppedLayer = 
         eval('document.getElementById("people1")');
  else if (browserType == "ie")
     document.poppedLayer = 
        eval('document.getElementById("people1")');
  else
     document.poppedLayer = 
         eval('document.layers["people1"]');
  document.poppedLayer.checked = "checked";  
}



function mint() {
  if (browserType == "gecko" )
     document.poppedLayer = 
         eval('document.getElementById("int")');
  else if (browserType == "ie")
     document.poppedLayer = 
        eval('document.getElementById("int")');
  else
     document.poppedLayer =   
        eval('document.layers["int"]');
  document.poppedLayer.style.display = "block";
  if (browserType == "gecko" )
     document.poppedLayer = 
         eval('document.getElementById("pf")');
  else if (browserType == "ie")
     document.poppedLayer = 
        eval('document.getElementById("pf")');
  else
     document.poppedLayer = 
         eval('document.layers["pf"]');
  document.poppedLayer.style.display = "none";

if (browserType == "gecko" )
     document.poppedLayer = 
         eval('document.getElementById("intranet")');
  else if (browserType == "ie")
     document.poppedLayer = 
        eval('document.getElementById("intranet")');
  else
     document.poppedLayer = 
         eval('document.layers["intranet"]');
  document.poppedLayer.checked = "checked";
}
*/

// Ends Searchbox for headers