$(document).ready(function()
{
    $.post('status_sale_json.php',function(status_sale)
    {
        var unit_array = [] ;
        var sale_array = [] ;

        console.log(status_sale) ;
        for(let i in status_sale)
        {
            unit_array.push(status_sale[i].unit) ;
            sale_array.push(status_sale[i].sale) ;
        }

        $('#coffee-unit').text(unit_array[0]) ;
        $('#coffee-sale').text(sale_array[0]+' ฿') ;
        $('#milk-unit').text(unit_array[1]) ;
        $('#milk-sale').text(sale_array[1]+' ฿') ;
        $('#tea-unit').text(unit_array[2]) ;
        $('#tea-sale').text(sale_array[2]+' ฿') ;
        $('#soft-unit').text(unit_array[3]) ;
        $('#soft-sale').text(sale_array[3]+' ฿') ;
        $('#juice-unit').text(unit_array[4]) ;
        $('#juice-sale').text(sale_array[4]+' ฿') ;
    } );
} );