<?
    session_start() ;
    include("connect.php") ;

    if(isset($_SESSION["shopping_cart"]))
    {
        $current_receipt_date = date("Y-m-d") ;
        $current_receipt_time = date("h:i:s") ;

        $sql_receipt = "INSERT INTO receipt (receipt_total,receipt_date,receipt_time) VALUES ('$_POST[total]','$current_receipt_date','$current_receipt_time') " ;
        $query_receipt = mysql_query($sql_receipt) ;

        $sql_receipt_id = "SELECT * FROM receipt ORDER BY receipt_id DESC LIMIT 1" ;
        $query_receipt_id = mysql_query($sql_receipt_id) ;
        $data_receipt_id = mysql_fetch_array($query_receipt_id) ;
       

        foreach($_SESSION["shopping_cart"] as $key => $value)
        {
            $payment_name = $value[item_name] ;
            $payment_quantity = $value[item_quantity] ;
            $payment_price = $value[item_price] ;
            $payment_type = $value[item_type] ;

            $sql_payment = "INSERT INTO payment (payment_name,payment_quantity,payment_price,payment_type,payment_date,receipt_id)
                            VALUES ('$payment_name','$payment_quantity','$payment_price','$payment_type','$current_receipt_date','$data_receipt_id[receipt_id]')" ;
            $query_payment = mysql_query($sql_payment) ;
        }
    } 
    
    session_destroy() ;
?>