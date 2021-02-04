<?
    include("connect.php") ;

    if($_POST["action"] == "add")
    {   
        if($_POST["file"] == "undefined")
        {
            $newfilename = "" ;
        }
        else
        {
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
        }

        $product_name = $_POST['name'] ;
        $product_price = $_POST['price'] ;
        $product_type = $_POST['type'] ;

        $sql_addproduct = "INSERT INTO product (product_name,product_price,product_type,product_img)
                           VALUES ('$product_name','$product_price','$product_type','$newfilename') " ;
        $query_addproduct = mysql_query($sql_addproduct) ;
    }

    if($_POST["action"] == "delete")
    {
        $product_id = $_POST['id'] ;

        $sql_deleteimage = "SELECT * FROM product WHERE id = '$product_id' " ;
        $query_deleteimage = mysql_query($sql_deleteimage) ;
        $data_deleteimage = mysql_fetch_array($query_deleteimage) ;
        
        unlink('image/product/'.$data_deleteimage[product_img]) ;

        $sql_deleteproduct = "DELETE FROM product WHERE id = '$product_id' " ;
        $query_deleteproduct = mysql_query($sql_deleteproduct) ;
    }

    if($_POST["action"] == "edit")
    {
        if($_POST["file"] == "undefined")
        {
            $newfilename = $_POST['ex-image'] ;
        }
        else
        {
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

            $ex_image = $_POST['ex-image'] ;
            unlink('image/product/'.$ex_image) ;

        }

        $product_id = $_POST['id'] ;
        $product_name = $_POST['name'] ;
        $product_price = $_POST['price'] ;
        $product_type = $_POST['type'] ;

        $sql_editproduct = "UPDATE product 
                            SET product_name='$product_name', product_price='$product_price', product_type='$product_type', product_img='$newfilename'
                            WHERE id = $product_id " ;
        $query_editproduct = mysql_query($sql_editproduct) ;

    }
?>

