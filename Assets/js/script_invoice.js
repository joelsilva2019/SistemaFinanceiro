$(function(){
    
    $('.issuer_cnpj').on('blur', function(){
        
        var cnpj = $(this).val();
        if(cnpj != ''){
        $.ajax({
            url:'https://www.receitaws.com.br/v1/cnpj/'+cnpj,
            type:'GET',
            crossDomain: true,
            dataType:'json',
            success:function(json){
                
                console.log(json);
                
                
            }
            
        });
        
        }
    });
    
});