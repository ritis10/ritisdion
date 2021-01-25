<?php
	session_start();
  if($_SESSION["logged"]!="")
  header("location: index.php");
  	echo "<title> Welcome Guest </title>";
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
     <li><a class="active" href="guest.php">Προϊόντα</a></li>
     <li><a href="contactus.php">Επικοινωνία</a></li>
     <li><a href="registration.php">Register </a></li>
     <li><a href="index.php">Επιστροφή στο αρχικό μενού</a><li>
 </ul>
 <table>
	 <tr>
		 <th>Auction Id</th>
		 <th>Product Name</th>
		 <th>Minimum Bid</th>
		 <th>owner of auction</th>
		 <th>description</th>
		 <th>current Bid</th>
		 <th>price_step</th>
		 <th>time left</th>
		 <th> </th>
		 <th>extensions</th>
		 <!--<th>numberofextensions</th>!-->
		 <!--<th>Time of Extensions</th>!-->
		 <!--<th>crucial_time</th>!-->
		 <th>type</th>
		 <!--<th>last_extension</th>!-->
		 <th>finished</th>

	 </tr>
	 <?php
	$query="SELECT * FROM product inner JOIN auction_types on a_type_id=type inner JOIN users on owner=id;";
	 mysqli_query($db,$query);
	 $result=mysqli_query($db,$query);
	 while($row=mysqli_fetch_array($result)){
		 echo '<tr>';
		 echo '<td>'.$row['auctionId'].'</td>';
		 echo '<td>'.$row['productName'].'</td>';
		 echo '<td>'.$row['minbid'].'</td>';
		 echo '<td>'.$row['username'].'</td>';
		 echo '<td>'.$row['descp'].'</td>';
		 echo '<td>'.$row['currBid'].'</td>';
		 echo '<td>'.$row['price_step'].'</td>';
		 $d1=date_create($row['expiry']);
		 $d2=date_create(date('d-m-Y'));

		 $diff=date_diff($d2,$d1);

		 if($diff->format("%R%a")<0){
			 echo '<td>Expired<td>';
			 $row['auctionId']=-1;
		 }
		 else if($diff->format("%R%a")==0)
			 echo '<td>Last Day<td>';
		 else
			 echo '<td>'.$diff->format("%a").' days left<td>';
		 //echo '<td>'.$row['extensions'].'</td>';
		 if ($row['extensions']==0)
			 echo '<td> Δεν δώθηκαν παρατάσεις </td>';
		 else
			 echo '<td> Υπάρχουν παρατάσεις </td>';
		 //echo '<td>'.$row['Num_of_Extensions'].'</td>';
		 //echo '<td>'.$row['Time_of_Extensions'].'</td>';
		 //echo '<td>'.$row['crucial_time'].'</td>';
		 echo '<td>'.$row['a_type_descr'].'</td>';
		 //echo '<td>'.$row['last_extension'].'</td>';
		 if ($row['finished']==0)
			 echo '<td> Δεν ολοκληρώθηκε </td>';
		 else
			 echo '<td> Ολοκληρώθηκε </td>';
		 echo '</tr>';
	 }
	 echo '</table>';
	 mysqli_close($db);
	 ?>
</body>
</html>
