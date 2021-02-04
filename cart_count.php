<?
    session_start() ;
    
	$cart_count = 0 ;
	foreach($_SESSION["shopping_cart"] as $key => $value)
	{	
		$cart_count = $cart_count + $value["item_quantity"] ;
	}
	
	if($cart_count > 99)
	{
		echo"99+" ;
	}
	else
	{
		echo"$cart_count" ; 
	}
?> 

<script>
$(document).ready(function()
{
	if($(window).width() <= 1024)
	{	
		$('.cart-box').click(function()
		{
			$('.leftarea').css("display","block") ;
			$('.rightarea').css("display","none") ;
			$('.leftarea').load("cart.php") ;
		} );
	}
} );
</script>