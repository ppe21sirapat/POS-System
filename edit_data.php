<?
    include("connect.php") ;

    $edit_id = $_POST['id'] ;

    $sql_editform = "SELECT * FROM product WHERE id = '$edit_id' " ;
    $query_editform = mysql_query($sql_editform) ;
    $data_editform = mysql_fetch_array($query_editform) ;

    echo json_encode($data_editform) ;
?>

