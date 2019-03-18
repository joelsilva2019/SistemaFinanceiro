$(function(){
    
    $('input[name=client_advance]').mask('000.000.000.000.000,00', {reverse:true}); 
    
$('.advance').on('click', function(e){
        e.preventDefault();
        
       var advance = $('input[name=client_advance]').val();
       var idSale = $('input[name=client_advance]').attr('data-id');  
       var idClient = $('input[name=client_advance]').attr('data-client');
       
                $.ajax({
                    url:BASE_URL+'Ajax/add_advance',
                    type:'POST',
                    data:{advance:advance,idSale:idSale,idClient:idClient}
                });
                
                
                
            $('input[name=client_advance]').val('');
            
               return false;   
           
    });

});
