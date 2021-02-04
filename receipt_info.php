<?
    include("connect.php") ;
    
    $id = $_POST['id'] ;

    $sql_receipt_info = "SELECT * FROM payment WHERE receipt_id = '$id' " ;
    $query_receipt_info = mysql_query($sql_receipt_info) ;

    $sql_total = "SELECT * FROM receipt WHERE receipt_id = '$id' " ;
    $query_total = mysql_query($sql_total) ;
    $data_total = mysql_fetch_array($query_total) ;
?>

<table class="table-receipt-info">
    <tr>
        <td> <? echo"Date : $data_total[receipt_date]" ?> </td>
    </tr>
    <tr>
        <th> Product </th>
        <th> Quantity </th>
        <th> Price </th>
    </tr>
    <?
        while($data_receipt_info = mysql_fetch_array($query_receipt_info))
        {
            echo"
            <tr>
                <td style='text-align:center';> $data_receipt_info[payment_name] </td>
                <td style='text-align:center';> $data_receipt_info[payment_quantity] </td>
                <td style='text-align:center';> $data_receipt_info[payment_price] </td>
            </tr>
            ";
        }
    ?>
    <tr>
        <td colspan="3" style="text-align:right ; background-color:lightgray"> 
        <b style="font-size:20px ;"> <? echo"Total : $data_total[receipt_total] ฿ " ?> </b>
        </td>
    </tr>
</table>