function startAdvances() {
    setTimeout(getAdvances, 2000);
}



function getAdvances() {
    
    var id = $('#table_advance').attr('data-id');

    $.ajax({

        url: 'http://localhost/ContaAzul/Ajax/getAdvances',
        type:'POST',
        data:{id:id},
        dataType: 'json',
        success: function (json) {
            resetAdvances();
            if (json.advances.length > 0) {
                
                for (var i in json.advances) { 
                  $('#table_advance').append('<tr class="advance-item"><td>R$ ' + json.advances[i].advance + '</td><td>' + json.advances[i].date_advance + '</td></tr>');
                }
            }
            setTimeout(getAdvances, 2000);
        }, error: function () {
            setTimeout(getAdvances, 2000);
        }

    });

}

function resetAdvances() {
    $('.advance-item').remove();
}



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


