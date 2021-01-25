<?php
	session_start();
    if($_SESSION["logged"]!="buyer")
    header("location: Listings.php");
	$name=$_SESSION['Name'];
	echo "<title> Welcome $name </title>";
	$db=mysqli_connect('localhost','root','','auction') or die("connection failed");
?>
<html>
  <head>
  	<style type="text/css">
  		<style>
      *{
        margin:4px;
      }
      body{
      	margin:70px;
        font-family:sans-serif;
        background-color: powderblue;
      }
      table{
        border-collapse: collapse;
      }
      tr,td,th{
        border-style:solid;
      }
      input, button{
        background: #2196F3;
        border: none;
        left: 0;
        color: #fff;
        bottom: 0;
        border: 0px solid rgba(0, 0, 0, 0.1);
        border-radius:5px;
        transform: rotateZ(0deg);
        transition: all 0.1s ease-out;
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
  	</style>
  </head>
  <body>
  	 	<ul>
  			<li><a href="Listings.php">Search Products</a></li>
  			<li><a class="active" href="userOrders.php">My Orders</a></li>
        <li><a href="index.php">Logout</a><li>
		</ul>
		<fieldset>
  	<form method="POST" action="Listings.php">
      <table>
        <tr>
          <th>Κωδικός Παραγγελίας</th>
          <th>Προϊόν</th>
          <th>Πωλητής</th>
          <th>Τωρινή Προσφορά</th>
					<th>Πελάτης</th>
					<th>Χρόνος παραγγελίας</th>
          <th>Διεύθυνση Πελάτη</th>
          <th>Κατάσταση Παραγγελίας</th>
        </tr>
        <?php
        $query="SELECT * FROM orders inner Join users on WhoDoes=id
																		inner Join product on productId=auctionId
																	  where username='$name';";
        mysqli_query($db,$query) or die("Query Failed");
        $result=mysqli_query($db,$query);
        while($row=mysqli_fetch_array($result)){
          echo '<tr>';
          echo '<td>'.$row['OrderId'].'</td>';
          echo '<td>'.$row['productName'].'</td>';
          echo '<td>'.$row['SellerUsr'].'</td>';
          echo '<td>'.$row['Amount'].'</td>';
					echo '<td>'.$row['first_name'].' '.$row['last_name'].'</td>';
					echo '<td>'.$row['when_'].'</td>';
					echo '<td>'.$row['Address'].'</td>';
          if ($row['status_del']==0)
            echo '<td> Δεν επιβεβαιώθηκε από πωλητή </td>';
          else
            echo '<td> Επιβεβαιώθηκε απο πωλητή </td>';
          echo '</tr>';
        }
        echo '</table>';
        mysqli_close($db);
        echo "<form action='Listings.php'><button action='Listings.php'>Go Back</button></form>";
        ?>
      </form>
	</fieldset>		
 </body>
</html>
