/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function($){
        $('.accept').click(function(e){
            e.preventDefault();
            alert('accept');
           var user = $(this).attr('id');
           alert(user);
           $.ajax({
              url: "<?php get_stylesheet_directory_uri() ?>/pfc_admin.php",
              type: 'POST',
              data: {action:'accept', user:user},
              success: function(data){
                    //$(this).text('Accepted');
                    alert(data);
              }
           });
        });
        $('.reject').click(function(e){
            e.preventDefault();
           var user = $(this).attr('id');
           $.ajax({
              url: "<?php get_stylesheet_directory_uri() ?>/pfc_admin.php",
              type: 'POST',
              data: {action:'reject', user:user},
              success: function(){
                    $(this).text('Rejected');
              }
           });
        });
        });