<?php
	session_start();
	$db=mysqli_connect('localhost','root','','auction') or die('connection failed');
    if($_SESSION["logged"]!="seller")
    header("location: index.php");
	$name=$_SESSION['Name'];
	echo "<title> Welcome $name</title>";
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
      input,  textarea{
        background: #2196F3;
        border-width: 1px;
        color: #fff;
        border-radius:5px;
      }
			button
			{
				background-color: #f44336;
			  border: none;
			  color: white;
			  padding: 16px 32px;
			  text-align: center;
			  text-decoration: none;
			  display: inline-block;
			  font-size: 16px;
			  margin: 4px 2px;
			  transition-duration: 0.4s;
			  cursor: pointer;
				position:absolute;
				top: 30%;
				left: 9%;
			}
			.button1 {
  		background-color: white;
  		color: black;
  		border: 2px solid #f44336;
			}
			.button1:hover {
  		background-color: #f44336;
  		color: white;
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

		fieldset {
		margin-inline-start: 0;
		margin-inline-end: 0;
		padding-block-start: 0;
		padding-block-end: 0;
		padding-inline-start: 0;
		padding-inline-end: 0;
		border: none;
		min-inline-size: min-content;
		    }

		    .some-class {
		      float: left;
		      clear: none;
		    }

		    label {
		      float: left;
		      clear: none;
		      display: block;
		      padding: 0px 1em 0px 8px;
		    }

		    input[type=radio],
		    input.radio {
		      float: left;
		      clear: none;
		    }
     </style>
  </head>
 	<body>
 		<ul>
  			<li><a class="active" href="Seller_portal.php">Add Product</a></li>
  			<li><a href="Seller_orders.php">My Orders</a></li>
  			<li><a href="MyProducts.php">My Products</a></li>
        <li><a href="index.php">Logout</a><li>
		</ul>

 			<form name='add_product' method="POST" action="landing_page.php" >
 				<label>Όνομα του προϊόντος ή υπηρεσίας:</label> <input type="text" name="name" value=""><br>
 				<label>Αρχική Τιμή:</label> <input type="text" name="startbid" value=""><br>
 				<label>Περιγραφή του προϊόντος ή της υπρεσίας:</label> <textarea rows='4' columns='10' name='desc' value=""></textarea><br>
				<label>Τύπος Δημοπρασίας:</label>
				<fieldset>
				<div><input type="radio" class="radio" name="auctiontype" value="0" required>
				<label for="auctiontype0">Πλειοδοτική</label><br>
				<div><input type="radio" class="radio" name="auctiontype" value="1">
				<label for="auctiontype1">Μειοδοτική</label><br></div>
				</fieldset>
				<input type="checkbox" name="extensions" value="0" id="myCheck" onchange="myfunction(this);">
	  		<label for="extensions">Επιτρέπονται οι παρατάσεις?</label><br>

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
						}
					}
					</script>
					<label>Αριθμός Παρατάσεων:</label> <input type="number" min="1" name="extnum" id="extnum" value="0" disabled><br> <label>*Οι Παρατάσεις είναι των 5 λεπτών!</label>
	 				<button class="button button1" type="submit" name="submit" value=1>Έναρξη Δημoπρασίας</button>
	 			</form>
	  	</body>
	</html>
