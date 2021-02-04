<?
    include("connect.php") ;

    if(isset($_POST["type"]))
    {
		$type = $_POST["type"] ; 
    }
    else
    {
		$type = "coffee" ;  
    }

    $sql_product = "SELECT * FROM product WHERE product_type = '$type'" ;
	$query_product = mysql_query($sql_product) ;
	$item_count = 1 ;
	$number_page = 1 ; 
?>
    <?
		while($data_product = mysql_fetch_array($query_product))
		{	
			if($item_count == 1)
			{
				echo"
					<button class='page-btn active-page' id='$number_page'> $number_page </button>
					";
			}		
			else if($item_count%7 == 0)
			{
				$number_page++ ;
				echo"<button class='page-btn' id='$number_page'> $number_page </button>" ;
			}
			$item_count++ ;
		}
    ?>

    <script>
	$(document).ready(function()
	{
        var page_select = document.getElementById("page-select") ; 
		var page_button = page_select.getElementsByClassName("page-btn") ;

		for (var i = 0 ; i < page_button.length ; i++)
			{
	  		    page_button[i].addEventListener("click", function()
	  			{
					var current_page = document.getElementsByClassName("active-page") ;
					current_page[0].className = current_page[0].className.replace(" active-page", "") ;
					this.className += " active-page" ;
	  			} );
			}

        $('.page-btn').click(function()
	    {
		    var page_number = $(this).attr("id") ;
		    var current_type = $('.active-type').attr("id") ;
		    $.ajax
		    ({
			    method:"POST",
			    url:"product_list.php",
			    data: {
					    page:page_number,
					    type:current_type
				      },
			    success:function(data)
				    {
					    $('.product-area').html(data) ;
				    }
		    })
	    } );
	} );
    </script>