$(document).ready(function(){
    var win_width=$(window).width();
  $(window).resize(function(){
    win_width=$(window).width();
  });
  console.log(win_width);
$(".ride>li:first-child").clone().attr('id','#hack-one').insertAfter("#custom");
   $(".ride>li:last-child").clone().attr('id','#hack-two').insertBefore("#adventure");
    
             if (win_width>1024) {
       
                $(".ride").css('right','1482px');
              }
            else if(win_width<=1024 && win_width>768){
                 $(".ride").css('right','995px');  
            }
            else if(win_width<=768 && win_width>640)
            {
             $(".ride").css('right','790px');
            }
             else if(win_width<=640 && win_width>400)
            {
              $(".ride").css('right','539px');
            }
            else{
              $(".ride").css('right','310px');
            }
        $(".flex-nav li a").on('click',function(event){
           
          var $anchor=$(this);
          event.preventDefault();
            $(".flex-nav li a").removeClass("active");
            $anchor.addClass("active");
           var le_pos=$($anchor.attr('href')).offset().left;
          function moveTo(){
             function setPos(li_width){
              if($anchor.attr('href')=="#adventure"){
                   $(".color-pfc").stop().animate({backgroundColor:"rgba(248,126,28,.9)"},3000,'easeOutBack');
                    return li_width-5;
                 }
             else if($anchor.attr('href')=="#urban"){
                   $(".color-pfc").stop().animate({backgroundColor:"rgba(144,165,96,.9)"},3000,'easeOutBack');
                    return (li_width-5)*2;
                 }
                 else if($anchor.attr('href')=="#rural"){

                   $(".color-pfc").stop().animate({backgroundColor:"rgba(81,186,169,.9)"},3000,'easeOutBack');
                  if (win_width<=768 && win_width>640) {
                  return li_width*3; 
                }else{
                  return (li_width-5)*3;
                } 
                 }
                  else if($anchor.attr('href')=="#learning"){
                    $(".color-pfc").stop().animate({backgroundColor:"rgba(255,220,25,.9)"},3000,'easeOutBack');
                    if (win_width<=768 && win_width>640) {
                  return li_width*4; 
                }else{
                  return (li_width+5)*4;
                }
                 }
                 else{
                  $(".color-pfc").stop().animate({backgroundColor:"rgba(138,56,126,.9)"},3000,'easeOutBack');
                   if (win_width<=768 && win_width>640) {
                  return li_width*5; 
                }else{
                  return (li_width-5)*5;
                }
                 }
             }
             var li_width=$(".trips-li").width();
          
                return setPos(li_width);
          }
        $(".ride").stop().animate({
         right:moveTo()
        },1000,'easeInBack');
        
        event.preventDefault();
       });
      
});
        
   