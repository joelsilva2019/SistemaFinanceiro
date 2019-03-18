$(function () {

    $('.tab_item').on('click', function () {

        $('.action_tab').removeClass('action_tab');
        $(this).addClass('action_tab');

        var item = $('.action_tab').index();
        $('.tab_body').hide();
        $('.tab_body').eq(item).show();
    });

    $('#search').on('focus', function () {
        $(this).animate({
            width: '300px'
        }), 'fast';

    });

    $('#search').on('blur', function () {
        if ($(this).val() == '') {
            $(this).animate({
                width: '100px'

            }), 'fast';
            
            setTimeOut(function(){
               $('.search_results').hide(); 
            }, 500)
            
        }  

    });

     $('#search').on('keyup', function(){
         
         var dataType = $(this).attr('data-type');
         var q = $(this).val();
         if(dataType != ''){
         $.ajax({
             url:BASE_URL+'Ajax/'+dataType,
             type:'GET',
             data:{q:q},
             dataType:'json',
             success:function(json){
                 
                 if($('.search_results').length == 0){
                   $('#search').after('<div class="search_results"></div>');
                 }
                 $('.search_results').css('left', $('#search').offset().left+'px');
                 $('.search_results').css('top', $('#search').offset().top+$('#search').height()+3+'px');
                 var html = '';
                 
                 for(var i in json){
                     html += '<div class="si"><a href="'+json[i].link+'">'+json[i].name+'</a></div>';
                 }
                 
                 $('.search_results').html(html);
                 $('.search_results').show();
             }
         });
     }
         
     }); 

});


