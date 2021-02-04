<?
    include("connect.php") ;

    $image_folder = "image/product/" ;
    $file_name = $_FILES[file][name] ;
    $ext = pathinfo($file_name,PATHINFO_EXTENSION) ;
    $file_data = $_FILES[file][tmp_name] ;
    $newfilename = date("YmdHis")."."."$ext" ;
    $valid_ext = array("jpg","jpeg","png") ;

    if(in_array(strtolower($ext), $valid_ext))
    {
        move_uploaded_file($file_data,$image_folder.$newfilename) ;
    }
?>
