$(function(){
    
    $('.issuer_cnpj').on('blur', function(){
        
        var cnpj = $(this).val();
        if(cnpj != ''){
        $.ajax({
            url:"https://www.receitaws.com.br/v1/cnpj/"+cnpj,
            type: 'GET',
            crossDomain: true, 
            dataType: 'jsonp', 
            success: function(data){ 
                
                if(data.cnpj.length > 0){
                    $('input[name=issuer_social_reason]').val(data.nome);
                    $('input[name=issuer_trading_name]').val(data.fantasia);
                    $('input[name=issuer_cnpj]').val(data.cnpj);
                    $('input[name=issuer_zipcode]').val(data.cep);
                    $('input[name=issuer_address]').val(data.logradouro);
                    $('input[name=issuer_number]').val(data.numero);
                    $('input[name=issuer_neighbor]').val(data.bairro);
                    $('input[name=issuer_city]').val(data.municipio);
                    $('input[name=issuer_state]').val(data.uf);
                    $('input[name=issuer_phone]').val(data.telefone);
                    $('input[name=issuer_email]').val(data.email);
                    $('input[name=issuer_register]').val(data.email);
                }
                
            }, 
            error: function(e) { 
                console.error(e); 
            }
            });
     
         }
    });
    
});