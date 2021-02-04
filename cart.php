<?
	session_start() ;
	include("connect.php") ;
	
	$id = $_POST['id'] ;

    if($_POST["action"] == "order")
	{
		$sql_productByID = "SELECT * FROM product WHERE id = '$id' " ;
		$query_productByID = mysql_query($sql_productByID) ;
		$data_productByID = mysql_fetch_array($query_productByID) ;

		foreach($_SESSION["shopping_cart"] as $key => $value)
		{
			if($value["item_id"] == $id )
			{
				$sum_quantity = $value['item_quantity'] ;
				unset($_SESSION["shopping_cart"][$key]) ;
				$item_array = array(
					'item_id' => $id,
					'item_name' => $data_productByID["product_name"],
					'item_price' => $data_productByID["product_price"],
					'item_quantity' => $_POST["quantity"] + $sum_quantity,
					'item_type' => $data_productByID["product_type"]
				    );
			    $_SESSION["shopping_cart"][$key] = $item_array ;
			}
		}

			if(isset($_SESSION["shopping_cart"]))
			{ 
				$item_array = array_column($_SESSION["shopping_cart"], "item_id") ;
				if(!in_array($id, $item_array))
			    {
				    $count = count($_SESSION["shopping_cart"]) ;
				    $item_array = array(
					'item_id' => $id,
					'item_name' => $data_productByID["product_name"],
					'item_price' => $data_productByID["product_price"],
					'item_quantity' => $_POST["quantity"],
					'item_type' => $data_productByID["product_type"]
				    );
				    $_SESSION["shopping_cart"][$count] = $item_array ; 
			    }
			} 
			   else
			   {			
				 $item_array = array(
					   'item_id' => $id,
					   'item_name' => $data_productByID["product_name"],
					   'item_price' => $data_productByID["product_price"],
					   'item_quantity' => $_POST["quantity"],
					   'item_type' => $data_productByID["product_type"]
				 );
				 $_SESSION["shopping_cart"][0] = $item_array ;
			   }
			}
	else if($_POST["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $key => $value)
		{
			if($value["item_id"] == $id)
			{
				unset($_SESSION["shopping_cart"][$key]);
			}
			if(empty($_SESSION["shopping_cart"]))
			{
				unset($_SESSION["shopping_cart"]) ;
			}
		}
	}
	else if($_POST["action"] == "clear")
	{
		unset($_SESSION["shopping_cart"]) ;
	}
?>


 <!-- CART WINDOW -->
<? 
		$total_price = 0 ;
		$sum_price = 0 ; 
		$cart_count = 0 ;
?>	

	<div class ='cart-window' id='cart-window'>
	<table class='tablecart' cellpadding='10'>
	<tr>
		<td> <button class='clear-btn'> Clear </button> </td>
		<td colspan='3'> <button class='payment-btn' id='payment-btn'> Payment </button> </td>
	</tr>
	<tr>
		<th width='60%'> Name </th>
		<th> Quantity </th>
		<th> Price </th>
		<th>  </th>
	</tr>	

<?
	foreach($_SESSION["shopping_cart"] as $key => $value)
	{	
		$sum_price = $value["item_price"] * $value["item_quantity"] ;
		echo"
			<tr>
				<td style='text-align:center'>  $value[item_name]  </td>
				<td style='text-align:center'>  $value[item_quantity]  </td>
				<td style='text-align:center'>  $sum_price  </td>
				<td style='text-align:center'> <input type='image' class='delete-btn' id='$value[item_id]' src='image/system/delete.png' width='20px' height='20px'>
			 </tr>
			 " ;
			  $total_price =  $total_price + $sum_price ;
			  $cart_count = $cart_count + $value["item_quantity"] ;
	} 
		if(!isset($_SESSION["shopping_cart"]))
		{
			echo"<td colspan='4'> <div class='no-record'> <h1> Your Cart Is Empty </h1> </div> </td>" ;
		}
		echo" 
		<tfoot style='text-align:right ;'>
		<tr>
			<td colspan='4'> <h2> Total : $total_price ฿ </h2> </td>
		</tr>
		</tfoot>
		
			" ; 

?> 
	</table>
 <!-- CART WINDOW -->
 <? require "payment_window.php" ?>
<script>
$(document).ready(function()
{
	$('.delete-btn').click(function()
	{
		var product_id = $(this).attr("id") ;
		$.ajax
		({
			method:"POST",
			url:"cart.php",
			data: {
					id:product_id,
					action:"delete"
				  },
			success:function(data)
				  {
					$('.leftarea').html(data) ;
					$('.cart-count').load("cart_count.php") ;
				  }
		})
	} );

	$('.clear-btn').click(function()
	{
		$.ajax
		({
			method:"POST",
			url:"cart.php",
			data: {
					action:"clear"
				  },
				  success:function(data)
				  {
					$('.leftarea').html(data) ;
					$('.cart-count').load("cart_count.php") ;
				  }			
		})
	} );

} );
 </script>

