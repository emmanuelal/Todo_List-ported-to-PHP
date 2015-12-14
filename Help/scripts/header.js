

$(document).ready(function(){
	 var scroll = $(window).scrollTop();
	 if(scroll > 0 ){
	 	 $(".nav").addClass("fixed");
	 }else{
	 	 $(".nav").removeClass("fixed");
	 }
});