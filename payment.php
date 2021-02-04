<?
    session_start() ;
    include("connect.php") ;


    foreach($_SESSION["shopping_cart"] as $key => $value)
    {
        echo"$value[item_name]
             $value[item_quantity]
             $value[item_price]
        <br>
        
        " ;
    }
?>
