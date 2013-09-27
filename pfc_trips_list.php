<?php

/*
 * Template Name: PFC Trips Listing
 */
get_header();

global $wpdb;

$trips_array = get_projects();

$page_cats = get_page_by_path('homepage');
if( !empty($page_cats) && $page_cats != '' ) {
    $cpage_id = $page_cats->ID;
    $categories = get_field('trips', $cpage_id);
}

$page_topics = get_page_by_path('benefits');
if( !empty($page_topics) && $page_topics != '' ) {
    $bpage_id = $page_topics->ID;
    $services = get_field('social_causes', $bpage_id);
}

$loc_query = "SELECT m.meta_value
            FROM ".$wpdb->prefix."posts as p LEFT OUTER JOIN ".$wpdb->prefix."postmeta as m ON (p.ID = m.post_id)
            WHERE m.meta_key = 'project_trip_location' AND p.post_status = 'publish' AND p.post_type = 'trips'";
$locations = $wpdb->get_results($loc_query);

$trips_count = count($trips_array);
if( !empty($trips_array) && count($trips_array) > 0 ) {
    $i = 1;
    $even_array = $odd_array = array();
    foreach( $trips_array as $tr ) {
        if( $i <= $trips_count ) {
            if( $i % 2 == 0 ){
                $even_array[] = $tr->ID;
            }
            else{
                $odd_array[] = $tr->ID;
            }
        }
        
        $i++;
    }
}

?>
   <div class="pro-list-container">

       <div class="list-head-cont">
           <div class="row-fluid list-head pfc-wrap">
               <div class="span6">
                   <h2>volunteer abroad trips</h2>
               </div>
               <div class="span6">
                 <ul class="fil_list">
                   
                 </ul>
               </div>
           </div>
       </div>
       <div class="row-fluid pfc-wrap">
           <div class="span4 col-1">
           <div class="row-fluid">
             <div class="span12">
               <form method="post" action="javascript:void(0)">
               <div class="filter">
                   <h2>filter projects</h2>
                   <div class="group active">
                       <h3><span class="grp-sym1"></span>category<span class="acc-sign"></span></h3>
                       <div class="filter-form" id="filter-form1">
                       <?php 
                            if( !empty( $categories ) && count($categories) > 0 ) {
                                foreach( $categories as $c ) {
                                    echo '<input type="checkbox" class="category" name="adventtrips" value="'.$c['trip_name'].'" id="'.$c['trip_name'].'"/>';
                                    echo '<label for="'.$c['trip_name'].'"><span></span>'.$c['trip_name'].'</label>';
                                }
                            }
                       ?>
                       </div>  
                   </div>
                   <div class="group">
                       <h3><span class="grp-sym2"></span>Location<span class="acc-sign"></span></h3>
                       <div class="filter-form" id="filter-form2">
                           <?php
                                if( !empty( $locations ) && count($locations) > 0 ) {
                                    foreach( $locations as $l ) {
                                        echo '<input type="checkbox" class="location" name="adventtrips" value="'.$l->meta_value.'" id="'.$l->meta_value.'"/>';
                                        echo '<label for="'.$l->meta_value.'"><span></span>'.$l->meta_value.'</label>';
                                        //echo '<input type="checkbox" class="location" name="location[]" value="'.$l->meta_value.'">'.$l->meta_value.'<br/>';
                                    }
                                }
                           ?>
                       </div>  
                   </div>
                   <div class="group">
                       <h3><span class="grp-sym3"></span>Area of Focus<span class="acc-sign"></span></h3>
                       <div class="filter-form" id="filter-form3">
                           <?php
                                if( !empty( $services ) && count($services) > 0 ) {
                                    foreach( $services as $s ) {
                                        echo '<input type="checkbox" class="services" value="'.$s['social_title'].'" name="adventtrips" id="'.$s['social_title'].'"/>';
                                        echo '<label for="'.$s['social_title'].'"><span></span>'.$s['social_title'].'</label>';
                                        //echo '<input type="checkbox" class="services" name="services[]" value="'.$s['social_title'].'">'.$s['social_title'].'<br/>';
                                    }
                                }
                           ?>
                       </div>  
                   </div>
                   <div class="group">
                       <h3><span class="grp-sym4"></span>Time of the Year<span class="acc-sign"></span></h3>
                       <div class="filter-form" id="filter-form4">
                           <input type="checkbox" class="timeofyear" name="timeofyear" value="Jan-Mar" id="Jan-Mar"/>
                           <label for="Jan-Mar"><span></span>Jan - Mar</label>
                           <input type="checkbox" class="timeofyear" name="timeofyear" value="Apr-Jun" id="Apr-Jun"/>
                           <label for="Apr-Jun"><span></span>Apr - Jun</label>
                           <input type="checkbox" class="timeofyear" name="timeofyear" value="Jul-Sep" id="Jul-Sep"/>
                           <label for="Jul-Sep"><span></span>Jul - Sep</label>
                           <input type="checkbox" class="timeofyear" name="timeofyear" value="Oct-Dec" id="Oct-Dec"/>
                           <label for="Oct-Dec"><span></span>Oct - Dec</label>
                       </div>  
                   </div>
                   <div class="group">
                       <h3><span class="grp-sym5"></span>Group Size<span class="acc-sign"></span></h3>
                       <div class="filter-form" id="filter-form5">
                           <input type="checkbox" class="groupsize" name="groupsize" value="Individual" id="Individual"/>
                           <label for="Individual"><span></span>Individual</label>
                           <input type="checkbox" class="groupsize" name="groupsize" value="2-5" id="2-5"/>
                           <label for="2-5"><span></span>2 - 5</label>
                           <input type="checkbox" class="groupsize" name="groupsize" value="5-10" id="5-10"/>
                           <label for="5-10"><span></span>5 - 10</label>
                       </div>  
                   </div>
               </div>
               </form>
             </div>
           </div>
               
           </div>
           
               <?php
                $str .= '<div class="span6 col-2">';
                    if( !empty( $odd_array ) && count($odd_array) > 0 ) {
                        foreach( $odd_array as $od ) {
                            $trip_id = $od;
                            $trip_post = get_post($trip_id);
                            $trip_title = $trip_post->post_title;
                            $trip_short_desc = get_field( 'project_short_description', $trip_id );
                            $trip_location = get_field( 'project_trip_location', $trip_id );
                            $trip_video_link = get_field( 'project_video_link', $trip_id );
                            $trip_cost = get_field( 'project_trip_cost', $trip_id );
                            $trip_duration = get_field( 'project_trip_duration', $trip_id );
                            $trip_type = get_field( 'project_trip_type', $trip_id );
                            if( $trip_type == 'Adventure' ){
                                $class_color = 'advent';
                            }
                            elseif( $trip_type == 'Urban' ){
                                $class_color = 'learn';
                            }
                            elseif( $trip_type == 'Rural' ){
                                $class_color = 'rural';
                            }
                            elseif( $trip_type == 'Learning' ){
                                $class_color = 'learn';
                            }
                            elseif( $trip_type == 'Customized' ){
                                $class_color = 'advent';
                            }
                            $trip_image = get_field( 'project_trip_featured_image', $trip_id );
                            $permalink_trip = get_permalink($trip_id);
                            $str .= '<div class="'.$class_color.'">';
                                $str .= '<a href="'.$permalink_trip.'"><img src="'.$trip_image.'"></a>';
                                $str .= '<div class="pro-list-item-ctn">';
                                    $str .= '<h3><a href="'.$permalink_trip.'">'.$trip_title.'</a></h3>';
                                    $str .= '<h6><span class="pin-loc"></span>'.$trip_location.'</h6>';
                                    $str .= '<p class="desp">'.$trip_short_desc.'</p>';
                                    $str .= '<a href="'.$trip_video_link.'" class="swipe-video"><div class="wtch-vd"><span>watch</span><span class="play"></span><span>video</span></div></a>';
                                    $str .= '<div class="advnt-btn">';
                                        $str .= '<div class="btn-1"><span class="dlr"></span>$'.$trip_cost.'</div>';
                                        $str .= '<div class="btn-2"><span class="clk"></span>'.$trip_duration.'</div>';
                                        $str .= '<p class="rd-mre"><a href="'.$permalink_trip.'">read more</a><span class="rm-arrw"></span></p>';
                                    $str .= '</div>';
                                    $str .= '<p class="adv-rib">'.$trip_type.' Trips</p>';
                                $str .= '</div>';
                            $str .= '</div>';
                        }
                    }
                    $str .= '</div>';
               
                    $str .=  '<div class="span6 col-3">';
                    if( !empty( $even_array ) && count($even_array) > 0 ) {
                        foreach( $even_array as $ed ) {
                            $trip_id_e = $ed;
                            $trip_post_e = get_post($trip_id_e);
                            $trip_title_e = $trip_post_e->post_title;
                            $trip_short_desc_e = get_field( 'project_short_description', $trip_id_e );
                            $trip_location_e = get_field( 'project_trip_location', $trip_id_e );
                            $trip_video_link_e = get_field( 'project_video_link', $trip_id_e );
                            $trip_cost_e = get_field( 'project_trip_cost', $trip_id_e );
                            $trip_duration_e = get_field( 'project_trip_duration', $trip_id_e );
                            $trip_type_e = get_field( 'project_trip_type', $trip_id_e );
                            $trip_image_e = get_field( 'project_trip_featured_image', $trip_id_e );
                            $permalink_trip_e = get_permalink($trip_id_e);
                            if( $trip_type_e == 'Adventure' ){
                                $class_color_e = 'advent';
                            }
                            elseif( $trip_type_e == 'Urban' ){
                                $class_color_e = 'learn';
                            }
                            elseif( $trip_type_e == 'Rural' ){
                                $class_color_e = 'rural';
                            }
                            elseif( $trip_type_e == 'Learning' ){
                                $class_color_e = 'learn';
                            }
                            elseif( $trip_type_e == 'Customized' ){
                                $class_color_e = 'advent';
                            }
                            
                            $str .= '<div class="'.$class_color_e.'">';
                                $str .= '<a href="'.$permalink_trip_e.'"><img src="'.$trip_image_e.'"></a>';
                                $str .= '<div class="pro-list-item-ctn">';
                                    $str .= '<h3><a href="'.$permalink_trip_e.'">'.$trip_title_e.'</a></h3>';
                                    $str .= '<h6><span class="pin-loc"></span>'.$trip_location_e.'</h6>';
                                    $str .= '<p class="desp">'.$trip_short_desc_e.'</p>';
                                    $str .= '<a href="'.$trip_video_link_e.'" class="swipe-video"><div class="wtch-vd"><span>watch</span><span class="play"></span><span>video</span></div></a>';
                                    $str .= '<div class="advnt-btn">';
                                        $str .= '<div class="btn-1"><span class="dlr"></span>$'.$trip_cost_e.'</div>';
                                        $str .= '<div class="btn-2"><span class="clk"></span>'.$trip_duration_e.'</div>';
                                        $str .= '<p class="rd-mre"><a href="'.$permalink_trip_e.'">read more</a><span class="rm-arrw"></span></p>';
                                    $str .= '</div>';
                                    $str .= '<p class="adv-rib">'.$trip_type_e.' Trips</p>';
                                $str .= '</div>';
                            $str .= '</div>';
                        }
                    }
                    else{
                        $str .= "No Results Found.";
                    }
                    $str .= '</div>';
               ?>
          <div class="span8">
            <div class="display row-fluid">
               <?php echo $str; ?>
           </div>
          </div>
           
       </div>
   </div>
   
      
        
<script type="text/javascript">
   
        $(".swipe-video").swipebox();

       

     
        $(window).load(function(){
        $(".group h3").on('click',function(){
            if($(this).closest(".group").hasClass("active")){
                $(this).closest(".group").removeClass("active");
                 fil_hei=$(".filter").outerHeight(true);
            }
            else{
                $(".group").removeClass("active");
                     $(this).closest(".group").addClass("active");
                     fil_hei=$(".filter").outerHeight(true);
            }
        });
     
          
        
     $(".filter-form input").click(function(){
           var checked_id=$(this).attr("id");
          
           if($(this).prop("checked")){
    
            $(".fil_list").append("<li class="+checked_id+"><span></span>"+checked_id+"</li>");
           }
            if(!$(this).prop("checked"))
           {
             $("."+checked_id).remove();
            
           }
            
           
     });
     var win_width=$(window).width();
      var foo_off=$("#pfc-contact").offset().top;
       var fil_wid=$(".filter").width();
       var fm_off=$(".filter").offset().top;
       var fil_hei=$(".filter").outerHeight(true);
       $(window).resize(function(){
       fil_wid=$(".filter").width();
          fixFil();
       });
   if (win_width>640) {
       fixFil(foo_off);
      
     function fixFil(){
     $(window).scroll(function(){
       foo_off=$("#pfc-contact").offset().top;
        var m_off=$(".filter").offset().top;
        var win_scroll=$(window).scrollTop(); 
      if(win_scroll>=m_off && win_scroll<foo_off-fil_hei){        
        $(".filter").css({"position":"fixed","top":"0px","width":fil_wid});
      }
      if(win_scroll<foo_off-fil_hei){        
        $(".filter").css({"position":"fixed","top":"0px","width":fil_wid});
      }
      if(win_scroll<fm_off){
         $(".filter").css({"position":"relative","top":"0px"});
      }
     if(win_scroll>foo_off-fil_hei){
        
        $(".filter").css({"position":"relative","top":foo_off-fil_hei-fm_off});
      }

        });
     }
     
       
     };                                                  
      
     $(document).on("click",".fil_list li",function(){
          var list_class=$(this).attr("class");
          $("#"+list_class).click();
         });
    
       var obj = {};
       $('.category').click(function(){
           var category = [];
           $('.category:checked').each(function(){
              category.push($(this).val());
           });
           obj['category'] = category;
           call_ajax(obj);
           //alert(obj.category);
        });
        $('.location').click(function(){
           var location = [];
           $('.location:checked').each(function(){
              location.push($(this).val());
           });
           obj['location'] = location;
           call_ajax(obj);
           //alert(obj.category);
        });
        $('.services').click(function(){
           var services = [];
           $('.services:checked').each(function(){
              services.push($(this).val());
           });
           obj['services'] = services;
           call_ajax(obj);
           //alert(obj.category);
        });
        $('.timeofyear').click(function(){
           var timeofyear = [];
           $('.timeofyear:checked').each(function(){
              timeofyear.push($(this).val());
           });
           obj['timeofyear'] = timeofyear;
           call_ajax(obj);
           //alert(obj.category);
        });
        $('.groupsize').click(function(){
           var groupsize = [];
           $('.groupsize:checked').each(function(){
              groupsize.push($(this).val());
           });
           obj['groupsize'] = groupsize;
           call_ajax(obj);
           //alert(obj.category);
        });
    
    function call_ajax(obj) {
        $.ajax({
           url: "<?php echo get_stylesheet_directory_uri() ?>/pfc_ajax.php",
           type: "POST",
           data: {data:obj},
           success: function(data){
                $('.display').html(data);
                 foo_off=$("#pfc-contact").offset().top;
                 fixFil(foo_off);
            }
        });
    }
    });
</script>    
<?php get_footer(); ?>
