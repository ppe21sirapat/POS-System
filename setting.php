<? 
    include("connect.php") ;
?>
<html>
<head>
	
	<title> Product Manage </title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="alert/sweetalert2.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"> </script>
    <script src="alert/sweetalert2.all.min.js"></script>


</head>

<body>
<div class="container">
        <div class="header">
			<div class="header-menu">
			<a href="index.php">
				<div class="header-img">
					<img src="image/system/home.png" width="30px" height="30px">
				</div> 
			</a>
            </div>
            <div class="header-menu">
			<a href="receipt.php">
				<div class="header-img">
					<img src="image/system/receipt.png" width="30px" height="30px">
				</div>
			</a>
            </div>
            <div class="header-menu" style="background-color: #87CEFA ;">
			<a href="setting.php">
				<div class="header-img">
					<img src="image/system/setting.png" width="30px" height="30px">
				</div>
			</a>
			</div>
		</div>

        <div class="menuarea">
          <!-- SETTING -->
            <script src="js/setting.js"> </script>
            <div id="setting" class="menu-content">
            <h1>Setting</h1>
            <button id="addproduct-btn"> + Add </button>
            <table class="display" id="table-product-manage">
                <thead style="background-color:#333a45 ; color: white ;">
                    <th> Product ID </th>
                    <th> Product Name </th>
                    <!-- <th> Product Price </th>
                    <th> Product Type </th> -->
                    <th> Edit </th>
                    <th> Delete </th>
                </thead>
                <tbody>
                <?
                    $sql_product = "SELECT * FROM product " ;
                    $query_product = mysql_query($sql_product) ;

                    while($data_product = mysql_fetch_array($query_product))
                    {
                        echo"
                        <tr>
                            <td style='text-align:center ;'> $data_product[id] </td>
                            <td style='text-align:center ;'> $data_product[product_name] </td>
                            <td style='text-align:center ;'> 
                                <input type='image' class='edit-btn' id='$data_product[id]' src='image/system/edit.png' width='20px' height='20px'>
                            </td>
                            <td style='text-align:center ;'>
                                <input type='image' class='delete-btn' id='$data_product[id]' src='image/system/delete.png' width='20px' height='20px'>
                            </td>
                        </tr>
                        ";
                    }
                ?>
                </tbody>
            </table>
            </div>
        </div>
        
        <!-- SETTING -->

        <!-- EDIT WINDOW -->
        <div class="edit-window" id="edit-window">
            <div class="edit-box">
                <div class="edit-header">
                    <span class="edit-close-btn"> &times; </span>
                    <h2 style="margin-top: 10px ;"> Edit Product </h2>
                </div>
                <div class="edit-body">
                    <table style="width:100% ;">
                        <form method="post" enctype="multipart/form-data">
                        <tr>
                            <td style="width:40% ; text-align:center ;"> Image </td>
                            <td style="width:60% ;"> <input type="file" id="edit-image"> </td>
                        </tr>
                        <tr>
                            <td style="padding:10px ; width:40% ; text-align:center ;"> Product Name </td>
                            <td style="padding:10px ; width:60% ;"> <input type="text" id="edit-product-name" value="<?echo"$data_editform[product_name]";?>"> </td>
                        </tr>
                        <tr>
                            <td style="padding:10px ; width:40% ; text-align:center ;"> Product Price </td>
                            <td style="padding:10px ; width:60% ;"> <input type="text" id="edit-product-price" value="<?echo"$data_editform[product_price]";?>"> </td>
                        </tr>
                        <tr>
                            <td style="padding:10px ; width:40% ; text-align:center ;"> Product Type </td>
                            <td style="padding:10px ; width:60% ;">
                            <select id="edit-product-type"> 
                                <option value="coffee"> Coffee  </option>
                                <option value="milk"> Milk </option>
                                <option value="tea"> Tea </option>
                                <option value="softdrink"> SoftDrink </option>
                                <option value="juice"> Juice </option>
                            </select>
                            </td>
                        </tr>
                        </form> 
                    </table>
                            <input type="hidden" id="ex-image">    
                            <input type="hidden" id="edit-id">
                            <button id="save-btn"> Save </button>
                            <button id="dontsave-btn"> Don't Save </button>
                </div>
            </div>
        </div>
        <!-- EDIT WINDOW -->

         <!-- ADD WINDOW -->
        <div class="add-window" id="add-window">
            <div class="add-box">
                <div class="add-header">
                    <span class="add-close-btn"> &times; </span>
                    <h2 style="margin-top: 10px ;"> Add Product </h2> 
                </div>
                <div class="add-body">
                    <table style="width:100% ;">
                        <tr>
                        <form method="post" enctype="multipart/form-data">
                            <td style="width:40% ; text-align:center ;"> Image </td>
                            <td style="width:60% ; text-align:center ;" > <input type="file" id="add-image">
                        </tr>
                         <tr>
                            <td style="padding:10px ; width:40% ; text-align:center ;"> Product Name </td>
                            <td style="padding:10px ; width:60% ;"> <input type="text" id="add-product-name" name="name"> </td>
                        </tr>
                        <tr>
                            <td style="padding:10px ; width:40% ; text-align:center ;"> Product Price </td>
                            <td style="padding:10px ; width:60%"> <input type="text" id="add-product-price" name="price"> </td>
                        </tr>
                        <tr>
                            <td style="padding:10px ; width:40% ; text-align:center ;"> Product Type </td>
                            <td style="padding:10px ; width:60% ;"> 
                            <select id="add-product-type" name="type">
                                <option value="coffee"> Coffee </option>
                                <option value="milk"> Milk </option>
                                <option value="tea"> Tea </option>
                                <option value="softdrink"> SoftDrink </option>
                                <option value="juice"> Juice </option>
                            </select>
                            </td>
                        </form>
                        </tr>
                    </table>
                    <button class="confirm-btn" style="margin-left:125px ; margin-top:10px ;"> Confirm </button>
                    <button class="cancel-btn"> Cancel </button>
                </div>
            </div>
        </div>
         <!-- ADD WINDOW -->

</div>

    <!-- <script>
        $(document).ready(function()
        {   
            $('#table-product-manage').on("click",".edit-btn",function()
            {
                var edit_id = $(this).attr("id") ;

                $.ajax
                ({
                    method:"POST",
                    url:"edit_window.php",
                    data: {
                            id:edit_id
                          },
                    success:function(data)
                          { 
                            $('.edit-box').animate
                            ({
                                top:'0px'
                            },400);
                            $('#edit-window').css("display","block") ;
                            $('.edit-body').html(data) ;
                          }
                })
            } );

            $('#addproduct-btn').click(function()
            {
                $.ajax
                ({
                    method:"POST",
                    url:"add_window.php",
                    success:function(data)
                            {
                                $('#add-window').css("display","block") ;
                                $('.add-body').html(data) ;
                            }
                })
            } );
        } );
    </script> -->

</body>

</html>