function updateSubtotal(obj){
    var quant = $(obj).val();
    if(quant <= 0){
        $(obj).val(1);
        quant = 1;
    }
    
    var price = $(obj).attr('data-price');
    var subtotal = quant * price;
    $(obj).closest('tr').find('.sub_total').html(' R$ '+subtotal);
    
    updateTotal();
}

function deleteProd(obj){
    $(obj).closest('tr').remove();
    updateTotal();
}

function updateTotal(){
    
    var total = 0;
    for(var q=0;q<$('.input_prod').length;q++){
        
        var quant = $('.input_prod').eq(q);
        var price = quant.attr('data-price');
        var subtotal = price * quant.val();
        
        total += subtotal;
        
    }
    
    $('input[name=total_price]').val(total);
    
}


function addProduct(obj){
    $('#add_prod').val('');
    var id = $(obj).attr('data-id');
    var price = $(obj).attr('data-price');
    var name = $(obj).attr('data-name');
    $('.search_results').hide();
    
    if($('input[name="quant['+id+']"]').length == 0){
    var tr = "<tr>"+
            "<td>"+name+"</td>"+
            "<td>"+
            "<input type='number' name='quant["+id+"]' class='input_prod' value='1' onchange='updateSubtotal(this)' data-price='"+price+"'/>"
            +"</td>"+
            "<td> R$ "+price+"</td>"+
            "<td class='sub_total'>R$ "+price+"</td>"+
            "<td><a href='javascript:;' onclick='deleteProd(this)' >Excluir</a></td>"
            +"</tr";
    
           $('#table_prod').append(tr);
           
    }  
    updateTotal();
    
}


$(function(){
       
   $('input[name=total_price]').mask('000.000.000.000.000,00', {reverse:true});  
    
   $('#add_prod').on('keyup', function(){
         
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
                   $('#add_prod').after('<div class="search_results"></div>');
                 }
                 $('.search_results').css('left', $('#add_prod').offset().left+'px');
                 $('.search_results').css('top', $('#add_prod').offset().top+$('#add_prod').height()+3+'px');
                 var html = '';
                 
                 for(var i in json){
                     html += '<div class="si"><a href="javascript:;" data-id="'+json[i].id+'" onclick="addProduct(this)" data-price="'+json[i].price_purchase+'" data-name="'+json[i].name+'" >'+json[i].name+' - R$ '+json[i].price_purchase+'</a></div>';
                 }
                 
                 $('.search_results').html(html);
                 $('.search_results').show();
             }
         });
     }
         
     }); 
     
    
});