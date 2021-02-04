<? 
	session_start() ;
	include("connect.php") ;
?>
<html>
<head>
	
	<title> Product Manage </title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="alert/sweetalert2.css">
	<script src="alert/sweetalert2.all.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>

<body>
	<div class="container">
		<div class="header">
			<div class="header-menu" style="background-color: #5996be ;">
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
			<div class="header-menu">
			<a href="setting.php">
				<div class="header-img">
					<img src="image/system/setting.png" width="30px" height="30px">
				</div>
			</a>
			</div>
				<div class="cart-box">
					<div class="cart-count"> 
						<!-- CART COUNT -->
						<script>
						$(document).ready(function()
						{	
							$('.cart-count').load("cart_count.php") ;
						} );
						</script>
					</div>
					<div id="cart-btn"> <img src="image/system/cart.png" width="30px" height="30px"> </div>
				</div>
		</div>
		
		<div class="leftarea">
			<?
				if(!isset($_SESSION["shopping_cart"]))
				{
					echo"<div class='no-record'> <h1> Your Cart Is Empty </h1> </div>" ;
				}
			?>
		</div>

		<div class="rightarea">
			<div class="product-type" id="product-type">
				<button class="type-btn active-type" id="coffee"> Coffee </button>
				<button class="type-btn" id="milk"> Milk </button>
				<button class="type-btn" id="tea"> Tea </button>
				<button class="type-btn" id="softdrink"> Soft Drink </button>
				<button class="type-btn" id="juice"> Juice </button>
				<script>
					var type_box = document.getElementById("product-type") ;
    				var type_btn = type_box.getElementsByClassName("type-btn") ;
    
    				for(var i = 0 ; i < type_btn.length ; i++)
    				{
    					type_btn[i].addEventListener("click",function()
        				{
        					var current_type = document.getElementsByClassName("active-type") ;
            				current_type[0].className = current_type[0].className.replace(" active-type","") ;
            				this.className += " active-type" ;
        				} );
    				}

					$(document).ready(function()
					{
						$('.type-btn').click(function()
						{
							var product_type = $(this).attr("id") ;
						
							$.ajax
							({
								method:"POST",
								url:"product_list.php",
								data: {
										type:product_type
								  	  },
								success:function(data)
								  	{
										$('.product-area').html(data) ;
								  	}	
							})
							
							$.ajax
							({
								method:"POST",
								url:"product_pagination.php",
								data: {
										type:product_type
									  },
								success:function(data)
									  {
										$('.page-select').html(data) ;
									  }
							})
						} );
					} );
				</script> 
			</div>
			<div class="product-area">
				<script>
			  		$('.product-area').load("product_list.php") ;
				</script>
			</div>
			
			<div class="page-select" id="page-select">
				<!-- <button class='page-btn active-page' id='1'> 1 </button>
				<button class='page-btn' id='2'> 2 </button>
				<button class='page-btn' id='3'> 3 </button>
				<button class='page-btn' id='4'> 4 </button>
				<button class='page-btn' id='5'> 5 </button> -->
				<script>
					$('.page-select').load("product_pagination.php") ;
				</script>
        	</div>
		</div>

		<!-- <? echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>' ; ?>  -->

	</div>

</body>


</html>