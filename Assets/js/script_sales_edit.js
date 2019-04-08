function startAdvances() {
    setTimeout(getAdvances, 2000);
}

$(function(){
   
        $('input[name=client_advance]').mask('000.000.000.000.000,00', {reverse: true});
    
});

function delAdvance(obj) {

    var id = $(obj).closest('tr').attr('data-id');

    $.ajax({
        url: 'http://localhost/ContaAzul/Ajax/del_advance',
        type: 'POST',
        data: {id: id}
    });

    $(obj).closest('tr').remove();
}


function getAdvances() {

    var id = $('#table_advance').attr('data-id');

    $.ajax({

        url: 'http://localhost/ContaAzul/Ajax/getAdvances',
        type: 'POST',
        data: {id: id},
        dataType: 'json',
        success: function (json) {
            resetAdvances();
            if (json.advances.length > 0) {
                for (var i in json.advances) {
                    $('#table_advance').append('<tr class="advance-item" data-id="' + json.advances[i].id + '"><td>R$ ' + json.advances[i].advance + '</td><td>' + json.advances[i].date_advance + '</td><td><button class="button" onclick="delAdvance(this)">Excluir</button></td></tr>');
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

    $('.advance').on('click', function (e) {
        e.preventDefault();

        var advance = $('input[name=client_advance]').val();
        var idSale = $('input[name=client_advance]').attr('data-id');
        var idClient = $('input[name=client_advance]').attr('data-client');

        $.ajax({
            url: BASE_URL + 'Ajax/add_advance',
            type: 'POST',
            data: {advance: advance, idSale: idSale, idClient: idClient}
        });



        $('input[name=client_advance]').val('');

        return false;

    });
    

    function addProduct(obj) {

        $('#add_prod').val('');
        var id = $(obj).attr('data-id');
        var id_sale = $('#table_prod').attr('data-sale');
        var price = $(obj).attr('data-price');
        var name = $(obj).attr('data-name');
        $('.search_results').hide();

        if ($('input[name="quant[' + id + ']"]').length == 0) {
            var tr = "<tr>" +
                    "<td>" + name + "</td>" +
                    "<td>" +
                    "<input type='number' name='quant[" + id + "]' class='input_prod' value='1' onchange='updateSubtotal(this)' data-price='" + price + "'/>"
                    + "</td>" +
                    "<td> R$ " + price + "</td>" +
                    "<td class='sub_total'>R$ " + price + "</td>" +
                    "<td><a href='"+BASE_URL+"Sales/delete_prod/"+id+"/"+id_sale+"' class='button button_small'>Excluir</a></td>"
                    + "</tr";

            $('#table_prod').append(tr);
        }

    }


    $('#add_prod').on('keyup', function () {

        var dataType = $(this).attr('data-type');
        var q = $(this).val();
        if (dataType != '') {
            $.ajax({
                url: BASE_URL + 'Ajax/' + dataType,
                type: 'GET',
                data: {q: q},
                dataType: 'json',
                success: function (json) {

                    if ($('.search_results').length == 0) {
                        $('#add_prod').after('<div class="search_results"></div>');
                    }
                    $('.search_results').css('left', $('#add_prod').offset().left + 'px');
                    $('.search_results').css('top', $('#add_prod').offset().top + $('#add_prod').height() + 3 + 'px');
                    var html = '';

                    for (var i in json) {
                        html += '<div class="si"><a href="javascript:;" data-id="' + json[i].id + '" onclick="addProduct(this)" data-price="' + json[i].price + '" data-name="' + json[i].name + '" >' + json[i].name + ' - R$ ' + json[i].price + '</a></div>';
                    }

                    $('.search_results').html(html);
                    $('.search_results').show();
                }
            });
        }

    });


