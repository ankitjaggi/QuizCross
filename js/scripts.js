// JavaScript Document

$=jQuery.noConflict();
    
$(document).ready(function(){
	//add .hide class to all input field you want the watermark
	$(".hide").watermark();
	
	// Center vertically
	var div = $("#form-container");
	div.css("margin-top" , ( $(window).height() - div.height() ) / 2+$(window).scrollTop() + "px");
	
});

jQuery.fn.watermark = function(){
	$(this).focus(function() {
		$(this).filter(function() {
			// Check to see if we have a blank field or the default text
			return $(this).val() === "" || $(this).val() === $(this).attr("title") || $(this).val() === "Your message here...";
		}).val("")/*.css("color", "#808080")*/;
	});

		// When we click off of the field, we expect it to replace the watermark,
		// unless we have entered text
	$(this).blur(function() {
		$(this).filter(function() {
			// Check to see if the field is blank
			return $(this).val() === "";
		})/*.css("color", "#d0d0d0")*/.val($(this).attr("title"));
	});
}