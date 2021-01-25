<?php
	session_start();
    if($_SESSION["logged"]!="1")
    header("location: indexm.php");
	$name=$_SESSION['Name'];
	echo "<title> Welcome $name </title>";
  $db=mysqli_connect('localhost','root','','auction');
?>
<html>
  <head>
  	<style type="text/css">
  		<style>
      *{
        margin:4px;
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
			<li><a href="svp.php">ActiveUsers</a></li>
			<li><a href="svp_portaldisable.php">DisableUsers</a></li>
			<li><a href="svp_Seller_portal.php">Knockdown</a></li>
			<li><a class="active"  href="svp_Seller_orders.php">Orders</a></li>
			<li><a href="svp_Products.php">Products</a></li>
			<li><a href="index.php">Logout</a><li>
		</ul>
        <fieldset>
        <form method="post" action="Seller_orders.php">
        <select name='filter'>
         <option  value="ALL">All Orders</option>
         <option  value="Sat">Satisfied</option>
         <option  value="UnSat">Unsatisfied</option>
        </select>
        <input type="Submit" value='filter'>
        </form>
       </fieldset>
      <fieldset>
 			<form name='myorders' method="POST" action="Finalize.php" >
        <table>
        <tr>
          <th>OrderId</th>
					<th>Προϊόν</th>
          <th>Όνομα Αγοραστή</th>
          <th>Όνομα Πωλητή</th>
          <th>Ποσό τωρινής προσφοράς</th>

          <th>Δθνση Αγοραστή</th>
          <th>Address</th>
          <th>Status</th>
        </tr>
        <?php
        $filter="";
        if(isset($_POST['filter']))
          $filter=$_POST['filter'];

        if($filter=="ALL" || !isset($_POST['filter']))
          $query="SELECT * FROM orders where SellerUsr='$name';";

        else if($filter=="MY")
          $query="SELECT * FROM product where SellerUsr='$name';";

      else if($filter=="Sat"){
        $query="SELECT * FROM orders WHERE SellerUsr='$name' and status=1;";
      }

      else if($filter=="UnSat")
        $query="SELECT * FROM orders WHERE SellerUsr='$name' and status=0;";

        mysqli_query($db,$query) or die("Query Failed");
        $result=mysqli_query($db,$query);
        while($row=mysqli_fetch_array($result)){
          echo '<tr>';
          echo '<td>'.$row['OrderId'].'</td>';
          echo '<td>'.$row['auctionId'].'</td>';
          echo '<td>'.$row['BuyerUsr'].'</td>';
          echo '<td>'.$row['Amount'].'</td>';
          echo '<td>'.$row['Quantity'].'</td>';
          echo '<td>'.$row['Address'].'</td>';
          if ($row['status']==0)
            echo '<td> Not Sold </td>';
          else
            echo '<td> Sold </td>';
          echo "<td> <button type='submit' name='Final' value=".$row['OrderId'].">Finalize</button></td>";
          echo '</tr>';
        }
        echo '</table>';
        mysqli_close($db);
        ?>
      </form>
    </fieldset>
  	</body>
</html>
