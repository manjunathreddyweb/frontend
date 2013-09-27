 
 $(".tour-pack-items").bind("contextmenu", function(e) {
    vanish();
        return false;
    });

var pro_he=$(".pro-pack-wrap").outerHeight(true);
   var win_width=$(window).width();
   var win_hei=$(window).height();
var tour_off=$(".tp-cont").offset().top;
      
       $(".chs-add").on("click",function(){
           $("html,body").stop().animate({
                scrollTop:tour_off-pro_he+50
            },1000);
            event.preventDefault(); 
        });



if(win_width>1100){
  var pro_off=$(".pro-pack-wrap").offset().top;
      $(window).scroll(function(){

        var m_off=$(".pro-pack-wrap").offset().top;
        var win_scroll=$(window).scrollTop();
  
      if(win_scroll>=m_off){
                
        $(".pro-pack-wrap").css({"position":"fixed","top":"0px"});
      } 
     if(win_scroll<pro_off){

        $(".pro-pack-wrap").css({"position":"relative","top":"0px"});
      } 

   });
}





// custom
 function vanish(){
       	$(".packages").removeClass("active");
       	 $(".invi-div").css("display","none");
    }

   $(".packages").click(function(){
   	    vanish();
   	$(this).addClass("active"); 
       var invi_data=$(this).data("id");
       var invi_id="#"+invi_data;
       var invi_html=$(invi_id).html();
  	$(".invi-div").html(invi_html).css("display","block");
   });
     var pack_width=$(".packages").outerWidth(true);
     var ele_count=$(".tour-pack-items>div").size();
     var tot_tpw=pack_width*(ele_count+1);
      $(".tour-pack-items").css("width",tot_tpw);
      var tour_pack_width=$(".tour-pack-items").outerWidth(true);
    
      var dist=0;
      function cal_dist(sign){
     	 function travel(){
       if (win_width>980) {
           if(sign=="plus" && dist<(tour_pack_width)-(pack_width*(ele_count)) && ele_count>3){
     		dist+=pack_width*3+12;
     	
     		return dist;
     		}
     		if(sign=="minus" && !dist<=0){
     			return dist-=pack_width*3+12;
     		}
      };
      if(win_width<980){
    
        if(sign=="plus" && dist<(tour_pack_width)-(pack_width*2) && ele_count>2){
        dist+=pack_width+4;
      
        return dist;
        }
        if(sign=="minus" && !dist<=0){
          return dist-=pack_width+4;
        }
      }
     	};
        $(".tour-pack-items").stop().animate({
        	right: travel()
        },500,"easeOutBack",function(){
          vanish();
        });
     }
     $(".next").click(function(){
     	vanish();
     	cal_dist("plus");
     });
     $(".pre").click(function(){
     	vanish();
     	cal_dist("minus")
     });
     
      $(".tour-pack-items").swipe({
        swipeRight:function(){
             vanish();
             cal_dist("minus");
      },swipeLeft:function(){
             vanish();
             cal_dist("plus");
           }  
    });
    $(".invi-div").swipe({
       swipeRight:function(){
             vanish();
             cal_dist("minus");
      },swipeLeft:function(){
             vanish();
             cal_dist("plus");
           }
    });

