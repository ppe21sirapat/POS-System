<?
    header('Content-Type: application/json') ;
    include("connect.php") ;

    $current_date = date("Y-m-d") ;

    // Unit
    $coffee_unit = 0 ;
    $milk_unit = 0 ;
    $tea_unit = 0 ;
    $soft_unit = 0 ;
    $juice_unit = 0 ;

    // Sale
    $coffee_sale = 0 ;
    $milk_sale = 0 ;
    $tea_sale = 0 ;
    $soft_sale = 0 ;
    $juice_sale = 0 ;

    $sql_status_sale = "SELECT * FROM payment WHERE payment_date = '$current_date' " ;
    $query_status_sale = mysql_query($sql_status_sale) ;

    while($data_status_sale = mysql_fetch_array($query_status_sale))
    {
        if($data_status_sale[payment_type] == "coffee")
        {
            $coffee_unit = $data_status_sale[payment_quantity] + $coffee_unit ;
            $coffee_sale = ($data_status_sale[payment_price] * $data_status_sale[payment_quantity]) + $coffee_sale ;
        }
        else if($data_status_sale[payment_type] == "milk")
        {
            $milk_unit = $data_status_sale[payment_quantity] + $milk_unit ;
            $milk_sale = ($data_status_sale[payment_price] * $data_status_sale[payment_quantity]) + $milk_sale ;
        }
        else if($data_status_sale[payment_type] == "tea")
        {
            $tea_unit = $data_status_sale[payment_quantity] + $tea_unit ;
            $tea_sale = ($data_status_sale[payment_price] * $data_status_sale[payment_quantity]) + $tea_sale ;
        }
        else if($data_status_sale[payment_type] == "softdrink")
        {
            $soft_unit = $data_status_sale[payment_quantity] + $soft_unit ;
            $soft_sale = $data_status_sale[payment_price] + $soft_sale ;
        }
        else if($data_status_sale[payment_type] == "juice")
        {
            $juice_unit = $data_status_sale[payment_quantity] + $juice_unit ;
            $juice_sale = $data_status_sale[payment_price] + $juice_sale ;
        }
    }

    $status_array = array() ;

    $status_array[0] = array(
                                'unit' => $coffee_unit,
                                'sale' => $coffee_sale
                            );
    $status_array[1] = array(
                                'unit' => $milk_unit,
                                'sale' => $milk_sale
                            );
    $status_array[2] = array(
                                'unit' => $tea_unit,
                                'sale' => $tea_sale
                            );
    $status_array[3] = array(
                                'unit' => $soft_unit,
                                'sale' => $soft_sale
                            );
    $status_array[4] = array(
                                'unit' => $juice_unit,
                                'sale' => $juice_sale
                            );

    echo json_encode($status_array) ;
?>