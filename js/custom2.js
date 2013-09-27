

$(document).ready(function(){
$(".hom_nav_arw").click(function(event){
	event.preventDefault();
	alert("hi");
   $("html,body").animate({
scrollTop:$("#pfc_nav").offset().top;
   },1000,"swing");
});
});

