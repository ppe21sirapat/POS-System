<?
    header('Content-Type: application/json');
    include("connect.php") ;

    $current_date = date("Y-m-d") ;

    $coffee_unit = 0 ;
    $tea_unit = 0 ;
    $milk_unit = 0 ;
    $soft_unit = 0 ;
    $juice_unit = 0 ;

    $type_data = array() ;

    $sql_type_chart = "SELECT * FROM payment WHERE payment_date = '$current_date' ";
    $query_type_chart = mysql_query($sql_type_chart) ;

    while($data_type_chart = mysql_fetch_array($query_type_chart))
    {
        if($data_type_chart[payment_type] == "coffee")
        {
            $coffee_unit = $data_type_chart[payment_quantity] + $coffee_unit ;
        }
        else if($data_type_chart[payment_type] == "tea")
        {
            $tea_unit = $data_type_chart[payment_quantity] + $tea_unit ;
        }
        else if($data_type_chart[payment_type] == "milk")
        {
            $milk_unit = $data_type_chart[payment_quantity] + $milk_unit ;
        }
        else if($data_type_chart[payment_type] == "softdrink")
        {
            $soft_unit = $data_type_chart[payment_quantity] + $soft_unit ;
        }
        else if($data_type_chart[payment_type] == "juice")
        {
            $juice_unit = $data_type_chart[payment_quantity] + $juice_unit ;
        }
    }

        $sum_unit = $coffee_unit + $tea_unit + $milk_unit + $soft_unit + $juice_unit ;


        $type_data[0] = array(
                                'type' => Coffee, 
                                'unit' => number_format(($coffee_unit/$sum_unit)*100,2) 
                             );
        $type_data[1] = array(
                                'type' => Milk,
                                'unit' => number_format(($milk_unit/$sum_unit)*100,2)
                             );
        $type_data[2] = array(
                                'type' => Tea,
                                'unit' => number_format(($tea_unit/$sum_unit)*100,2)
                             );
        $type_data[3] = array(
                                'type' => Softdrink,
                                'unit' => number_format(($soft_unit/$sum_unit)*100,2)
                             );
        $type_data[4] = array(
                                'type' => Juice,
                                'unit' => number_format(($juice_unit/$sum_unit)*100,2)
                             );

        

    echo json_encode($type_data) ;

?>