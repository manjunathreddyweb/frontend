jQuery(document).ready(function(){

	// active link
		$(".ben-menu li a").click(function(){
             var sec_id=$(this).attr("href");
             var sec_pos=$(sec_id).offset().top-60;
             $("body").stop().animate({
                 scrollTop:sec_pos
             },1000);
             event.preventDefault();
		});
     
    // accordion
		
   $(".pfc-accord h3").on('click',function(){
     if($(this).closest(".pfc-accord").hasClass("active")){
      $(this).closest(".pfc-accord").removeClass("active");
     }
     else{
      
        $(".pfc-accord").removeClass("active");
             $(this).closest(".pfc-accord").addClass("active");
     }
        
        });
  
    // single page menu
		var fm_off=$(".ben-nav").offset().top;
      $(window).scroll(function(){

      	var m_off=$(".ben-nav").offset().top;
      	var win_scroll=$(window).scrollTop();
       	console.log(win_scroll,m_off); 
      if(win_scroll>=m_off){
      	      	
      	$(".ben-nav").css({"position":"fixed","top":"0px"});
      }
     if(win_scroll<fm_off){

      	$(".ben-nav").css({"position":"relative","top":"0px"});
      }
      var secpos=new Array();
		var secheight=new Array();
		var arr = $('.ben-menu li a').map(function() {
                 var sechref=this.href;
                 var secname=sechref.split("#");
                 return secname[1];
            }).toArray();
		for(var i=0;i<arr.length;i++){
			secpos[i]=$("#"+arr[i]).offset().top-100;
            secheight[i]=$("#"+arr[i]).outerHeight();
		}
      for(var i=0;i<secpos.length;i++){
			if(win_scroll>=secpos[i] && win_scroll<(secpos[i]+secheight[i])){
               	$(".ben-menu li.active").removeClass("active")
            	$(".ben-menu li a[href*="+arr[i]+"]").parent().addClass("active");
			}
		  }
      
  });
	});