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
    <script src="https://www.gstatic.com/charts/loader.js"></script>


</head>

<body>
    <div class="container">
        <div class="header">
			<div class="header-menu">
			<a href="index.php">
				<div class="header-img">
					<img src="image/home.png" width="30px" height="30px">
				</div> 
			</a>
            </div>
            <div class="header-menu" style="background-color: dodgerblue ;">
			<a href="menu.php">
				<div class="header-img">
					<img src="image/receipt.png" width="30px" height="30px">
				</div>
			</a>
            </div>
		</div>

        <div class="menuarea">
            <table class="table-menu">
                <tr>
                   <td width="33%"> <button class="menu-list" onclick="SelectMenu(event, 'history')" id="defaultOpen">Receipt History</button> </td>
                   <td width="33%"> <button class="menu-list" onclick="SelectMenu(event, 'sales')">Sales</button> </td>
                   <td width="33%"> <button class="menu-list" onclick="SelectMenu(event, 'setting')">Setting</button> </td>
                </tr>
            </table>
       
            <!-- RECEIPT -->
            <div id="history" class="menu-content">
            <h1>Receipt History</h1>
                <table class="display" id="table-receipt">
                <thead>
                    <th> Receipt ID </th>
                    <th> Receipt Date </th>
                    <th> Total </th>
                    <th> Info </th>
                </thead>
                <tbody>
                <?
                    $sql_receipt = "SELECT * FROM receipt" ;
                    $query_receipt = mysql_query($sql_receipt) ;
                    
                    while($data_receipt = mysql_fetch_array($query_receipt))
                    {   
                        echo"
                        <tr>
                            <td style='text-align:center ; width:10% ;'>  $data_receipt[receipt_id] </td>
                            <td> $data_receipt[receipt_date] </td>
                            <td style='text-align:center ;'> $data_receipt[receipt_total] ฿ </td>
                            <td style='text-align:center'> <button class='info-btn' id='$data_receipt[receipt_id]'> Info </button> </td>
                        </tr>
                        " ;
                    }
                ?>
                </tbody>
                </table>

            <!-- RECEIPT WINDOW -->
            <div class="receipt-window" id="receipt-window">
                <div class="receipt-box">
                    <div class="receipt-header">
                        <span class="receipt-close-btn">&times;</span>
                        <h2> Receipt No. </h2>
                    </div>

                    <div class="receipt-body">

                    </div>
                </div>
            </div>
            <script>
                var receipt_window = document.getElementById("receipt-window") ;
                var receipt_close_btn = document.getElementsByClassName("receipt-close-btn")[0] ;

                receipt_close_btn.onclick = function()
                {
                    receipt_window.style.display = "none" ;
                }

                window.onclick = function(event)
                {
                    if(event.target == receipt_window)
                    {
                        receipt_window.style.display = "none" ;
                    }
                }
            </script>
          <!-- RECEIPT WINDOW -->
            </div>
          <!-- RECEIPT -->
         
          <!-- SALE -->
            <div id="sales" class="menu-content">
                <h1>Sales</h1>
                <div class="type-chart">
                    <script>
                        $(document).ready(function()
                        {
                            $('.type-chart').load("sell_type_chart.php") ;
                        } );
                    </script>
                </div>
            </div>
          <!-- SALE -->
          <!-- SETTING -->
            <div id="setting" class="menu-content">
            <? require("edit_window.php") ; ?>
            <h1>Setting</h1>
            <table class="display" id="table-product-manage">
                <thead>
                    <th> Product ID </th>
                    <th> Product Name </th>
                    <th> Product Price </th>
                    <th> Product Type </th>
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
                            <td style='text-align:center ;'> $data_product[product_price] </td>
                            <td style='text-align:center ;'> $data_product[product_type] </td>
                            <td style='text-align:center ;'> 
                                <input type='image' class='edit-btn' id='$data_product[id]' src='image/edit.png' width='20px' height='20px'>
                            </td>
                            <td style='text-align:center ;'>
                                <input type='image' class='delete-btn' id='$data_product[id]' src='image/delete.png' width='20px' height='20px'>
                            </td>
                        </tr>
                        ";
                    }
                ?>
                </tbody>
            </table>
                <input type="text" id="input-product-name">
                <input type="text" id="input-product-price">
                <select id="input-product-type">
                    <option value="coffee"> Coffee  </option>
                    <option value="milk"> Milk </option>
                    <option value="tea"> Tea </option>
                    <option value="softdrink"> SoftDrink </option>
                    <option value="juice"> Juice </option>
                </select>
                <button id=addproduct-btn> Add Product </button>
            </div>
        </div>
        
        <!-- SETTING -->
    <script>
        function SelectMenu(event, MenuName) 
        {
            var i ;
            var menu_list ;
            var menu_content ;
            menu_content = document.getElementsByClassName("menu-content");
            for (i = 0; i < menu_content.length; i++)
            {
                menu_content[i].style.display = "none";
            }

            menu_list = document.getElementsByClassName("menu-list");
            for (i = 0; i < menu_list.length; i++)
            {
                menu_list[i].className = menu_list[i].className.replace(" active", "");
            }
            
            document.getElementById(MenuName).style.display = "block";
            event.currentTarget.className += " active";
        }

        document.getElementById("defaultOpen").click();
    </script>
</div>

    <script>
        $(document).ready(function()
        {   
            $('#table-receipt').DataTable() ;

            $('#table-receipt').on("click",".info-btn",function()
            {
                var rec_id = $(this).attr("id") ;
 
                $.ajax
                ({
                    method:"POST",
                    url:"receipt_info.php",
                    data: {
                            id:rec_id
                          },
                    success:function(data)
                          { 
                            $('.receipt-body').html(data) ;
                            $('.receipt-window').css("display","block") ;
                          }
                })
            } );

            $('#table-product-manage').DataTable() ;
            $('#addproduct-btn').click(function()
            {   
                var product_name = $('#input-product-name').val() ;
                var product_price = $('#input-product-price').val() ;
                var product_type = $('#input-product-type').val() ;

                $.ajax
                ({
                    method:"POST",
                    url:"manage_product_sql.php",
                    data: {
                            action:"add",
                            name:product_name,
                            price:product_price,
                            type:product_type
                          },
                    success:function(data)
                          {
                            const Toast = Swal.mixin
                            ({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => 
                                {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire
                            ({
                                icon: 'success',
                                title: 'Product has been added'
                            })
                          }
                })
            } );

            $('#table-product-manage').on("click",".delete-btn",function()
            {
               var delete_id = $(this).attr("id") ;

                Swal.fire({
                            title: 'Are you sure?',
                            text: "to delete this product ",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                         }).then((result) => {
                                if (result.isConfirmed) 
                                {   
                                    $.ajax
                                    ({
                                        method:"POST",
                                        url:"manage_product_sql.php",
                                        data: {
                                                action:"delete",
                                                id:delete_id
                                              }
                                    })
                                    Swal.fire(
                                                'Deleted!',
                                                'Your product has been deleted.',
                                                'error'
                                             )
                                }
                            })             
            } );

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
                            $('.edit-id').html(data) ;
                            $('#edit-window').css("display","block") ;
                          }
                })
            } );
  
        } );
    </script>

</body>

</html>