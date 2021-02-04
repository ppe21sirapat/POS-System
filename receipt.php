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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"> </script>
    <script src="alert/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

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
            <div class="header-menu" style="background-color: #87CEFA ;">
			<a href="receipt.php">
				<div class="header-img">
					<img src="image/system/receipt.png" width="30px" height="30px">
				</div>
			</a>
            </div>
            <div class="header-menu">
			<a href="setting.php">
				<div class="header-img">
					<img src="image/system/setting.png" width="30px" height="30px">
				</div>
			</a>
			</div>
        </div>
        
        <!-- SALE -->
        <div class="sale-area">
            <div class="type-box">
                <div class="test-box">

                </div>
                <div class="type-chart-box">
                    <canvas id="type-chart" style="width:400px ; height:250px ; margin-top:10% ;">
                        <!-- Type Chart -->
                        <script src="js/type_chart.js"> </script>
                    </canvas>
                </div>  
            </div>   

            <div class="status-box">
                    <script src="js/status_sale.js"> </script>

                    <div class="daily-total-frame" style="text-align:center ;">
                        <h1 style="margin-top:25% ; color:#5a9600 ;"> Daily Total <br> <span id=daily-total style="font-size:75px ;"> <!-- Total Value --> </span> </h1> 
                    </div>
                            
                    <table class="sale-status-table" cellpadding="10">
                        <tr>
                            <th>     </th>
                            <th style="text-align:center ;"> Unit </th>
                            <th style="text-align:center ;"> Sales </th>
                        </tr>
                        <tr> 
                            <td style="text-align:center ;"> Coffee </td>
                            <td style="text-align:center ;"> <p id="coffee-unit"> <!-- Coffee Unit --> </p> </td>
                            <td style="text-align:center ;"> <p id="coffee-sale"> <!-- Coffee Sale --> </p> </td>
                        </tr>   
                        <tr> 
                            <td style="text-align:center ;"> Milk </td>
                            <td style="text-align:center ;"> <p id="milk-unit"> <!-- Milk Unit --> </p> </td>
                            <td style="text-align:center ;"> <p id="milk-sale"> <!-- Milk Sale --> </p> </td>
                        </tr>
                        <tr> 
                            <td style="text-align:center ;"> Tea </td>
                            <td style="text-align:center ;"> <p id ="tea-unit"> <!-- Tea Unit --> </p> </td>
                            <td style="text-align:center ;"> <p id="tea-sale"> <!-- Tea Sale --> </p> </td>
                        </tr>
                        <tr> 
                            <td style="text-align:center ;"> Softdrink </td>
                            <td style="text-align:center ;"> <p id="soft-unit"> <!-- Soft Unit --> </p> </td>
                            <td style="text-align:center ;"> <p id="soft-sale"> <!-- Soft Sale --> </p> </td>
                        </tr>
                        <tr> 
                            <td style="text-align:center ;"> Juice </td>
                            <td style="text-align:center ;"> <p id="juice-unit"> <!-- Juice Unit --> </p> </td>
                            <td style="text-align:center ;"> <p id="juice-sale"> <!-- Juice Sale --> </p> </td>
                        </tr>
                    </table>  
            </div>

            <div class="income-chart-box">
                <div class="income-chart-bg">
                    <canvas id="income-chart" style="width:100% ; height:100% ;">
                        <!-- Income Chart -->
                        <script src="js/income_chart.js"> </script>
                    </canvas>
                </div>
            </div>
        </div>
        <!-- SALE -->

        <!-- RECEIPT -->
        <script src="js/receipt.js"> </script>
        <div class="receipt-area">
            <div class="receipt-content">
            <h1>Receipt History</h1>
                <table class="display" id="table-receipt">
                <thead style="background-color:#333a45 ; color: white ;">
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
                            <td style='text-align:center'> $data_receipt[receipt_date] </td>
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
        </div>
        <!-- RECEIPT -->
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
        } );
    </script>

</body>

</html>