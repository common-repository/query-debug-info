jQuery(document).ready(function(){
	jQuery(".trigger").click(function(){
            var test = jQuery(this).attr('class').split(' ').slice(0);
            jQuery("div." + test + "").toggle("fast");
		jQuery(this).toggleClass("active");
		return false;
	});
});