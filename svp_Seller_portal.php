<?php
	session_start();
    if($_SESSION["logged"]!="1")
    header("location: indexm.php");
	$name=$_SESSION['Name'];
	echo "<title> Welcome $name </title>";
?>
<html>
  <head>
<style type="text/css">
      <style>
      *{
        margin:0px;
      }
      body{
        margin: 70px;
        font-family:sans-serif;
        background-color: powderblue;
      }
      table{
        border-collapse: collapse;
      }
      tr,td,th{
        border-style:solid;
      }
      input, button, textarea{
        background: #2196F3;
        border-width: 1px;
        color: #fff;
        border-radius:5px;
      }
      ul{
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
      position: fixed;
      top: 0;
      width: 100%;
    }

  li{
      float: left;
  }

    li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
 }

   li a:hover:not(.active) {
    background-color: #111;
 }

   .active {
    background-color: #4CAF50;
 }
    label{
      display: inline-block;
      width: 260px;
      float:left;
      text-align: left;
    }
     </style>
  </head>
 	<body>
 		<ul>
			<li><a href="svp.php">ActiveUsers</a></li>
			<li><a href="svp_portaldisable.php">DisableUsers</a></li>
			<li><a class="active" href="svp_Seller_portal.php">Knockdown</a></li>
			<li><a href="svp_Seller_orders.php">Orders</a></li>
			<li><a href="svp_Products.php">Products</a></li>
			<li><a href="index.php">Logout</a><li>
		</ul>

 			<form name='add_product' method="POST" action="landing_page.php" >
 				<label>Enter the Name of your Product </label> <input type="text" name="name" value=""><br>
 				<label>Enter the Minimum Bid</label> <input type="text" name="minbid" value=""><br>
 				<label>Enter the Maximum Bid </label><input type="text" name="maxbid" value=""><br>
 				<label>Enter the Quantity Available</label> <input type="text" name="qty" value=""><br><br>
 				<label>Enter Item Description</label> <textarea rows='4' columns='10' name='desc' value=""></textarea><br>
 				<label>Enter the Expiry </label><input type="date" name="expiry" value=""></br>
				<input type="checkbox" name="extensions" value=0 id="myCheck" onchange="myfunction(this);">
	  			<label for="extensions">Allow Extensions?</label><br>
					<script>
					document.getElementById("myCheck").onclick = function()
					{
						if (this.checked)
						{
							document.getElementById("extnum").disabled = false;
							document.getElementById("dayext").disabled = false;
						}
						else
						{
							document.getElementById("extnum").disabled = true;
							document.getElementById("extnum").value = 0;
							document.getElementById("dayext").disabled = true;
							document.getElementById("dayext").value = 0;
						}
					}
					</script>
					<label>Enter the Number of Extensions</label> <input type="number" name="extnum" id="extnum" value="" disabled><br>
					<label>Enter the Time of Extensions (days)</label> <input type="number" name="dayext" id="dayext" value="" disabled><br>
	 				<button type="submit" name="submit" value=1> Add Product </button>
	 			</form>
	  	</body>
	</html>
