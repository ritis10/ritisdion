<?php
	session_start();
    if($_SESSION["logged"]!="buyer")
    header("location: index.php");
	$name=$_SESSION['Name'];
	$auction = $_SESSION['auction'];
	echo "<title> Complete Your Order, $name </title>";
	$db=mysqli_connect('localhost','root','','auction') or die("connection failed");
  $pId=$_POST['NewBid'];
	$expire=0;

  //$time=$_SESSION['when_'];
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
      input, button, textarea{
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
  			<li><a class="active" href="Listings.php">Search Products</a></li>
  			<li><a href="userOrders.php">My Orders</a></li>
        <li><a href="index.php">Logout</a></li>
		</ul>
      <?php
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			$query="SELECT finished as \"expired\" FROM product";
			$expire=mysqli_query($db,$query) or die("query failed");
			$expire=mysqli_fetch_array($expire);
			//$expire=$expire['expire'];
			if ($expire == false)
			{
				echo '<td>Ο Χρόνος κατάθεσης προσφορών ΕΛΗΞΕ</td>';
				echo "<form action='Listings.php'><button action='Listings.php'>Go Back</button></form>";
			}
        else{
          ?>
  	<form method="get" action="newOrder.php">
      <table>
        <tr>
          <th>Όνομα Προϊόντος</th>
          <th>Τιμή εκκίνησης</th>
          <th>Τιμή Τελευταίου Χτυπήματος</th>
					<th>Βήμα Χτυπημάτων</th>
          <th>Περιγραφή</th>
          <th>Πωλητής</th>
          <th>Τύπος Δημοπρασίας</th>
        </tr>
        <?php

        $query="SELECT * FROM product where auctionId=$pId;";
        mysqli_query($db,$query);
        $result=mysqli_query($db,$query);
        while($row=mysqli_fetch_array($result))
				{
          echo '<tr>';
          echo '<td>'.$row['productName'].'</td>';

          echo '<td>'.$row['minbid'].'</td>';

          if($row['currBid']==0)
          	echo '<td>'.$row['minbid'].'</td>';
          else
          echo '<td>'.$row['currBid'].'</td>';
					$price=$row['currBid']+10;

					echo '<td>'.$row['price_step'].'</td>';

          echo '<td>'.$row['descp'].'</td>';

					echo '<td>'.$row['owner'].'</td>';

					if($row['type']==0)
          	echo '<td>ΠΛΕΙΟΔΟΤΙΚΗ</td>';
          else
          	echo '<td>ΜΕΙΟΔΟΤΙΚΗ</td>';

         }
          echo '</table>';
          echo "<br>";
          echo '</tr>';

        mysqli_close($db);
        ?>
      </form>
      <form method="POST" action="landing_page.php">
				<p>Εισάγεται την Προσφορά σας: <input type="number" min="<?php echo $price ?>" step="10" name="bid" id="bid" value="0"><br></p>
        Εισάγεται την Διευθυνση σας: <input type="text" name='addr' value=""><br>

        <p><button type='submit' name='submit' value='4'>Place Bid</button></p>
      </form>

      <?php
        /*$query="SELECT finished as \"expire\" FROM product";
				$expire=mysqli_query($db,$expire) or die("query failed");
				$expire=mysqli_fetch_array($expire);
				$expire=$expire['expire'];
				if ($expire == 0)
				{
					echo '<td>Ο Χρόνος κατάθεσης προσφορών ΕΛΗΞΕ</td>';
				}*/

}
      ?>



 </body>
</html>
