<?
    include("connect.php") ;

			if(isset($_POST["page"]))
			{
				$page = $_POST["page"] ;
			}
			else
			{
				$page = 1 ;
			}

			$max_record = 6 ;
			$start_product = ($page - 1) * $max_record ;

			if(isset($_POST["type"]))
			{
				$type = $_POST["type"] ;
				$page = 1 ;
			}
			else
			{
				$type = "coffee" ;
			}
 				
			$sql_productlist = "SELECT * FROM product WHERE product_type = '$type' ORDER BY id ASC LIMIT $start_product,$max_record " ;
			$query_productlist = mysql_query($sql_productlist) ;
			
			while($data_productlist = mysql_fetch_array($query_productlist))
			{
				echo"
					<div class='product-box'>
					" ;
					if($data_productlist[product_img] == '')
					{	
						echo" 
						<div class='product-img'>	
						<img src='https://via.placeholder.com/150'>
						</div>
						" ;
					}
					else
					{
						echo"
						<div class='product-img'>
						<img src='image/product/$data_productlist[product_img]'>
						</div>
						" ;
					}
				echo"
						<div class='product-title'>
							$data_productlist[product_name] 
						</div>
						<div class='product-price'>
							<h2> $data_productlist[product_price] ฿ </h2>
						</div>
						<div class='product-order'>
							<input type='text' class='quantity' id='quantity$data_productlist[id]' name='quantity' value='1' placeholder='1' size='5' required>
							<button class='order-btn' id='$data_productlist[id]'> Order </button>
						</div> 
					</div>
				" ; 
			}

?>

<script>
$(document).ready(function()
{
	$('.order-btn').click(function()
	{ 
		var product_id = $(this).attr("id") ;
		var product_quantity = $('#quantity'+product_id).val() ;
			
		$.ajax
		({
			method:"POST",
			url:"cart.php",
			data: {
					id:product_id,
					action:"order",
					quantity:product_quantity
				  },
			success:function(data)
					{
					  $('.no-record').css({display:"none"}) ;
					  $('.cart-count').load("cart_count.php") ;
					  $('.leftarea').html(data) ;
					  $('.cart-count').animate
					  ({
						 width:'20px',
						 height:'20px',
						 fontSize:'15px'
					  },200) ;
					  $('.cart-count').animate
					  ({
						  width:'15px',
						  height:'15px',
						  fontSize:'10px'
					  },200) ;
					}
		}) 
	} );		

} );
</script>