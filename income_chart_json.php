<?
    header('Content-Type: application/json');
    include("connect.php") ;

    $date = date("d") ;
    $month = date("m") ;
    $year = date("Y") ;

    for($d=0 ; $d<=6 ; $d++)
    {
        $sql_income_chart = "SELECT * FROM receipt WHERE receipt_date = '$year-$month-$date' " ;
        $query_income_chart = mysql_query($sql_income_chart) ;
    
        $i = 0 ; 
        $total_array = array() ;

        while($data_income_chart = mysql_fetch_array($query_income_chart))
        {
            $total_array[$i] = $data_income_chart[receipt_total] ;
            $i++ ;
        }

        $income_data[$d] = array(
                                    'date' => $date.'-'.$month.'-'.$year,
                                    'total' => array_sum($total_array)
                                ) ;
        $date-- ;
    }
    
    echo json_encode($income_data) ;
?>