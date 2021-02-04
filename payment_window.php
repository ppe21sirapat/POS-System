<!-- PAYMENT WINDOW -->
<div class="payment-window" id="payment-window">
<div class="payment-box">
    <div class="payment-header">
    	<span class="close-btn">&times;</span>
     	<h2>Payment Order</h2>
  	</div>
   	<div class="payment-body">
      	<table class="payment-table" cellpadding="10">
		<tr>
			<th> Name </th>
			<th> Quantity </th>
			<th> Price </th>
		</tr>
				<?
				foreach($_SESSION["shopping_cart"] as $key => $value)
					{
					echo"
					<tr>
						<td style='text-align:center'>  $value[item_name]  </td>
						<td style='text-align:center'>  $value[item_quantity]  </td>
						<td style='text-align:center'>  $value[item_price]  </td>
					</tr>
					" ;
					} 
				?>
		</table>
	</div>
	<div class="payment-footer">
		<? echo"<h2 class='total_price' id='$total_price'> Total : $total_price ฿ </h2> " ?>
	</div>
	<div class="payment-confirm">
		<button class="cancel-btn"> Cancel </button>
		<button class="confirm-btn" id="confirm-btn"> Confirm </button>
	</div>
</div> 
</div>

<script>
$(document).ready(function()
{
	var payment_window = document.getElementById("payment-window") ;
	var payment_btn = document.getElementById("payment-btn") ;
	var close_btn = document.getElementsByClassName("close-btn")[0] ;
	var cancel_btn = document.getElementsByClassName("cancel-btn")[0] ;
	
	payment_btn.onclick = function() 
	{
  		payment_window.style.display = "block" ;
    }

	close_btn.onclick = function() 
	{
		payment_window.style.display = "none" ;
	}

	cancel_btn.onclick = function()
	{
		payment_window.style.display = "none" ;
	}

	window.onclick = function(event) 
	{
  		if(event.target == payment_window) 
		{
   		    payment_window.style.display = "none" ;
 		}
	}

// CONFIRM PAYMENT
	var confirm_btn = document.getElementById("confirm-btn") ;
	var total_price = $('.total_price').attr("id") ;

	confirm_btn.onclick = function()
	{
		$.ajax
		({
			method:"POST",
			url:"payment_sql.php",
			data: {
					total:total_price
				  }
		})

		{
			Swal.fire
            ({
  			    icon: "success",
  			    title: "Payment Success",
  			    text: "ทำรายการสำเร็จ",
			    confirmButtonColor: "#0077ff"
		    })
				payment_window.style.display = "none" ;
		}
	}
} );
// CONFIRM PAYMENT
</script>
<!-- PAYMENT WINDOW -->
