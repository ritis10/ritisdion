<?php
	session_start();
  if($_SESSION["logged"]!="0")
	//if($_SESSION["logged"]!="Moderator")
	header("location: indexm.php");
	$name=$_SESSION['Name'];
	echo "<title> User Disable </title>";
	$db=mysqli_connect('localhost','root','','auction') or die("connection failed");
  $oid=$_POST['Disable'];
  $_SESSION['member_to_disable']=$oid;
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
			h2{
				color:red
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
			button{
	      background: #FF0006;
	      border: none;
	      left: 0;
	      color: black;
	      bottom: 0;
	      border: 0px solid rgba(0, 0, 0, 0.1);
	      border-radius:5px;
	      transform: rotateZ(0deg);
	      transition: all 0.1s ease-out;;
        border: none;
        left: 0;
        color: black;
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
    	overflow: adjust;
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
        <li><a href="Moderator_portal.php">ActiveUsers</a></li>
		    <li><a class="active"  href="Moderator_portaldisable.php">DisableUsers</a></li>
				<li><a href="mod_Products.php">Auctions</a></li>
        <li><a href="index.php">Logout</a><li>
    </ul>
  	<form method="POST" action="landing_page.php">
     <center> <h1> Προσωρινή ή Οριστική απενεργοποίηση Χρήστη </h1><center>
			 <table>
			 <tr>
				 <th>UserName</th>
				 <th>id</th>
				 <th>pass</th>
				 <th>first_name</th>
				 <th>last_name</th>
				 <th>role</th>
				 <th>dateofbirth</th>
				 <th>address</th>
				 <th>email</th>
				 <th>Approval Date</th>
				 <th>Approval Pom</th>
				 <th>Status</th>

			 </tr>
			 <?php
			 $query="SELECT * FROM users inner JOIN user_status on status=u_status_id where $oid=id;";
			 mysqli_query($db,$query);
			 $result=mysqli_query($db,$query);
			 while($row=mysqli_fetch_array($result)){
				 echo '<tr>';
				 echo '<td>'.$row['username'].'</td>';
				 echo '<td>'.$row['id'].'</td>';
				 echo '<td>'.$row['pass'].'</td>';
				 echo '<td>'.$row['first_name'].'</td>';
				 echo '<td>'.$row['last_name'].'</td>';
				 echo '<td>'.$row['role'].'</td>';
				 echo '<td>'.$row['dob'].'</td>';
				 echo '<td>'.$row['address'].'</td>';
				 echo '<td>'.$row['email'].'</td>';
				 echo '<td>'.$row['approval_date'].'</td>';
				 echo '<td>'.$row['approval_pom'].'</td>';
				 echo '<td>'.$row['u_status_descr'].'</td>';
           echo '</tr>';
           $_SESSION["user_status"]=$row['status'];
           $_SESSION["user_to_disable"]=$row['id'];
         }
         echo '</table>';
         mysqli_close($db);
         ?>
        <button type='submit' name='submit' value='8'>Temporarily Disabled</button>
        <button type='submit' name='submit' value='9'>Finally Disabled</button>
				<h2>Η επαναφορά από οριστική απενεργοποίηση γίνεται μόνο από τον PROVIDER!!!</h2>
 </body>
</html>
