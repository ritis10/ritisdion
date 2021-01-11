<?php
	session_start();
	$name=$_SESSION['Name'];
	echo "<title> User Activation </title>";
	$db=mysqli_connect('localhost','root','','auction') or die("connection failed");
  $pid=$_POST['Active'];
  $_SESSION['member_to_active']=$pid;
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
        <li><a class="active"  href="Moderator_portal.php">ActiveUsers</a></li>
		<li><a href="DeleteUsers.php">DeleteUsers</a></li>
        <li><a href="index.php">Logout</a><li>
    </ul>
  	<form method="POST" action="landing_page.php">
     <center> <h3> Ενεργοποίηση Χρήστη </h3><center>
	 
        <?php
        $query="SELECT * FROM users where id=$pid;";
        mysqli_query($db,$query);
        $result=mysqli_query($db,$query);
        mysqli_close($db);
        ?>
        <button type='submit' name='submit' value='7'>Active</button>
 </body>
</html>	