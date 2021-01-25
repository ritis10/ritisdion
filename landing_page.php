<?php
session_start();
$name=$_SESSION['Name'];
$Err=0;
$idee=$_POST['submit'];
$db=mysqli_connect('localhost','root','','auction') or die('connection failed');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if ($idee==1)
{
$pname=$descp='';
$extensions=$startbid=$extnum=$auctiontype=0;
$Date = date("Y-m-d H:i:s", strtotime('+1 hour'));
$descp=$_POST['desc'];
if ($_POST['name']!="")
	$pname=$_POST['name'];
else{
	echo "Παρακαλώ εισάγεται το όνομα του προϊόντος ή της υπηρεσίας<br>";
	$Err++;
}

if (isset($_POST['extnum']))
{
	$extnum=$_POST['extnum'];
}
	else
	{
		$extnum = null;
	}

if ($_POST['startbid']!=""){
	if (is_numeric($_POST['startbid']))
		$startbid=$_POST['startbid'];
	else{
		echo "Εισάγεται αριθμό<br>";
		$Err++;
	}
}
else{
	echo "Παρακαλώ εισάγεται την τιμή εκκίνησης<br>";
	$Err++;
}

if (isset($_POST['extensions']))
	{
		$extensions = 1;
	}
	else
	{
		$extensions = 0;
	}

	$answer = $_POST['auctiontype'];
	if ($answer == "0")
		{
			$auctiontype = 0;
		}
		else
		{
			$auctiontype = 1;
		}

if($Err==0){
	$max="SELECT MAX(auctionId) as \"lastId\" from product ";
	$max=mysqli_query($db,$max) or die("query failed");
	$max=mysqli_fetch_array($max);
	$max=$max['lastId']+1;
	$seller="SELECT id as sellerId from users where username='$name'";
	$seller=mysqli_query($db,$seller) or die("query failed");
	$seller=mysqli_fetch_array($seller);
	$sellerId = $seller['sellerId'];
	$query="INSERT into product VALUES('$max','$pname', '$startbid','$sellerId','$descp','0','10', '$Date', '$extensions' ,'$extnum', '15', '30', '$auctiontype', '0', '0');";
		$result=mysqli_query($db,$query) or die("could not add");
		if($result){
			echo "<title> Successfully Added Product</title>";
			echo "Successfully Added Product";
		}
	}
	else{
		echo "<title> Failed to Add Product</title>";
		echo "Failed to Add Product . Try Again";
	}
		echo "<form action='Seller_portal.php'><button action='Seller_portal.php'>Go Back</button></form>";
	}



	if ($idee==4){
		if (isset($_POST['bid']))
		{
			$Bid=$_POST['bid'];
		}
			else
			{
				$Bid = null;
			}

		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		$whodoes = "SELECT id as whodoes from users where username='$name'";
		$whodoes = mysqli_query($db,$whodoes) or die("query failed");
		$whodoes = mysqli_fetch_array($whodoes);
		$whodoesit = $whodoes['whodoes'];

		$address=$_POST['addr'];

		$myDate = date("Y-m-d H:i:s", strtotime('+1 hour'));

			$max="SELECT MAX(OrderId) as \"lastId\" from orders ";
			$max=mysqli_query($db,$max) or die("query failed");
			$max=mysqli_fetch_array($max);
			$max=$max['lastId']+1;
			$auction = $_SESSION['auction'];

			$query="INSERT into orders VALUES('$max' , '$whodoesit' , '' , '$Bid' , '$address' , '$auction' , '0', '$myDate');";
			$result=mysqli_query($db,$query) or die("could not add");

			$expires="SELECT expiry as \"ex\" from product WHERE auctionId='$auction'";
			$Mdate=mysqli_query($db,$expires) or die("query failed");
			$Mdate=mysqli_fetch_array($Mdate);
			$Mdate=date_create($Mdate['ex']);
			$Mdate->modify('+5 hours');

			$date = DateTime::createFromFormat('Y-m-d H:i:s', $myDate);

			$diff=date_diff($date,$Mdate);

			if($diff->format("%R%a")<0)
			{
				echo "Η περίοδος προσφορών έκλεισε";
				echo "<form action='Listings.php'><button action='Listings.php'>Go Back</button></form>";
			}
			/*elseif($date<$Mdate)
			{
				echo "Η περίοδος προσφορών έκλεισε";
				echo "<form action='Listings.php'><button action='Listings.php'>Go Back</button></form>";
			}*/
			else {

			$updateQ="UPDATE product set currBid='$Bid' WHERE auctionId='$auction'";
			$result2=mysqli_query($db,$updateQ) or die('Could not update');
			if($result && $result2){
				echo "<title> Successfully</title>";
				echo "Η προσφορά σου έγινε";
				echo "<form action='Listings.php'><button action='Listings.php'>Go Back</button></form>";
			}
		}
	}

		else{
			echo "<title> Failed to Bid</title>";
			echo "Failed to Bid . Try Again";
			echo "<form action='Listings.php'><button action='Listings.php'>Go Back</button></form>";
		}

	if($idee==5){
		$PID=$_SESSION['Product_to_delete'];
		$query="DELETE from product where productId=$PID;";
		$result=mysqli_query($db,$query) or die("Delete Failed");
		$query="DELETE from orders where productId=$PID;";
		$result2=mysqli_query($db,$query) or die("Delete Failed");
		if($result && $result2){
			echo "<title> Deleted Product !</title>";
			echo "Deleted Successfully";
		}
			echo "<form action='Seller_portal.php'><button action='Seller_portal.php'>Go Back</button></form>";
	}

	if ($idee==6){
		$PID=$_SESSION["Product_to_finalize"];
		$Stat=$_SESSION["Sale_status"];
		$OID=$_SESSION["Order_to_finalize"];
		if ($Stat==1){
			echo "Order Already Completed<br>";
			echo "<title> Please Try Again !</title>";
		}
		else {
			$query="SELECT amount,quantity from orders where OrderId=$OID";
			$result=mysqli_query($db,$query) or die('No fetch Data');
			while($row=mysqli_fetch_array($result)){
				$qty=$row['quantity'];
				$amt=$row['amount'];
			}

			$query="UPDATE orders set status_del=1 where OrderId=$OID";
			$result=mysqli_query($db,$query) or die('Could not sell');

			$query="UPDATE product set minbid=maxbid, maxbid=maxbid+$amt, currBid=0 where productId=$PID;";
			$result2=mysqli_query($db,$query) or die('Could not Update');
			if($result2 && $result){
				echo "<title> Success !</title>";
				echo "Successfully Sold and Updated";
			}
			}
				echo "<form action='Seller_orders.php'><button action='Seller_orders.php'>Go Back</button></form>";

	}
	if ($idee==7){
		//$PID=$_SESSION["user_to_active"];
		$Stat=$_SESSION["user_status"];
		$OID=$_SESSION["user_to_active"];
		if ($Stat=='3'){
			echo "Member is already activated<br>";
			echo "<title> Please Try Again !</title>";
		}
		else if($Stat=='2'){
			echo "Η επαναφορά από οριστική απενεργοποίηση γίνεται μόνο από τον PROVIDER!!!";
		}
		else {
			$query="UPDATE users set status='3' where id=$OID";
			$result=mysqli_query($db,$query) or die('Could not change');
			$query1="UPDATE users set approval_date=curdate() where id=$OID";
			$result1=mysqli_query($db,$query1) or die('λαθος ημερομηνία');
		  if($result){
				echo "<title> Success !</title>";
				echo "Ο λογαριασμός χρήστη με κωδικό : $OID ενεργοποιήθηκε επιτυχώς";
		  }
		}
				echo "<form action='Moderator_portal.php'><button action='Moderator_portal.php'>Go Back</button></form>";

	}
	if ($idee==8){
		//$PID=$_SESSION["user_to_active"];
		$Stat=$_SESSION["user_status"];
		$OID=$_SESSION["user_to_disable"];
		if ($Stat=='1'){
			echo "Member is already disabled<br>";
			echo "<title> Please Try Again !</title>";
		}
		else {
			$query="UPDATE users set status='1' where id=$OID";
			$result=mysqli_query($db,$query) or die('Could not change');
			$query1="UPDATE users set approval_date=curdate() where id=$OID";
			$result1=mysqli_query($db,$query1) or die('λαθος ημερομηνία');
		  if($result){
				echo "<title> Success !</title>";
				echo "Ο λογαριασμός χρήστη με κωδικό : $OID απεργοποιήθηκε προσωρινά";
		  }
		}
				echo "<form action='Moderator_portal.php'><button action='Moderator_portal.php'>Go Back</button></form>";

	}
	if ($idee==9){
		//$PID=$_SESSION["user_to_active"];
		$Stat=$_SESSION["user_status"];
		$OID=$_SESSION["user_to_disable"];
		if ($Stat=='2'){
			echo "Member is already finally disabled<br>";
			echo "<title> Please Try Again !</title>";
		}
		else {
			$query="UPDATE users set status='2' where id=$OID";
			$result=mysqli_query($db,$query) or die('Could not change');
			$query1="UPDATE users set approval_date=curdate() where id=$OID";
			$result1=mysqli_query($db,$query1) or die('λαθος ημερομηνία');
		  if($result){
				echo "<title> Success !</title>";
				echo "Ο λογαριασμός χρήστη με κωδικό : $OID απεργοποιήθηκε οριστικά";
		  }
		}
				echo "<form action='Moderator_portal.php'><button action='Moderator_portal.php'>Go Back</button></form>";

	}
	if ($idee==10){
		//$PID=$_SESSION["user_to_active"];
		$Stat=$_SESSION["user_status"];
		$OID=$_SESSION["user_to_active"];
		if ($Stat=='3'){
			echo "Member is already activated<br>";
			echo "<title> Please Try Again !</title>";
		}
		else {
			$query="UPDATE users set status='3' where id=$OID";
			$result=mysqli_query($db,$query) or die('Could not change');
			$query1="UPDATE users set approval_date=curdate() where id=$OID";
			$result1=mysqli_query($db,$query1) or die('λαθος ημερομηνία');
		  if($result){
				echo "<title> Success !</title>";
				echo "Ο λογαριασμός χρήστη με κωδικό : $OID ενεργοποιήθηκε επιτυχώς";
		  }
		}
				echo "<form action='svp.php'><button action='svp.php'>Go Back</button></form>";
	}

	if ($idee==11){
		//$PID=$_SESSION["user_to_active"];
		$Stat=$_SESSION["user_status"];
		$OID=$_SESSION["user_to_disable"];
		if ($Stat=='1'){
			echo "Member is already disabled<br>";
			echo "<title> Please Try Again !</title>";
		}
		else {
			$query="UPDATE users set status='1' where id=$OID";
			$result=mysqli_query($db,$query) or die('Could not change');
			$query1="UPDATE users set approval_date=curdate() where id=$OID";
			$result1=mysqli_query($db,$query1) or die('λαθος ημερομηνία');
		  if($result){
				echo "<title> Success !</title>";
				echo "Ο λογαριασμός χρήστη με κωδικό : $OID απεργοποιήθηκε προσωρινά";
		  }
		}
				echo "<form action='svp.php'><button action='svp.php'>Go Back</button></form>";

	}
	if ($idee==12){
		//$PID=$_SESSION["user_to_active"];
		$Stat=$_SESSION["user_status"];
		$OID=$_SESSION["user_to_disable"];
		if ($Stat=='2'){
			echo "Member is already finally disabled<br>";
			echo "<title> Please Try Again !</title>";
		}
		else {
			$query="UPDATE users set status='2' where id=$OID";
			$result=mysqli_query($db,$query) or die('Could not change');
			$query1="UPDATE users set approval_date=curdate() where id=$OID";
			$result1=mysqli_query($db,$query1) or die('λαθος ημερομηνία');
		  if($result){
				echo "<title> Success !</title>";
				echo "Ο λογαριασμός χρήστη με κωδικό : $OID απενεργοποιήθηκε οριστικά";
		  }
		}
				echo "<form action='svp.php'><button action='svp.php'>Go Back</button></form>";

	}
	if($idee==13){
		$PID=$_SESSION['Auction_to_delete'];
		$query="DELETE from orders where productId=$PID;";
		$result2=mysqli_query($db,$query) or die("Delete Failed");
		$query="DELETE from product where auctionId=$PID;";
		$result=mysqli_query($db,$query) or die("Delete Failed");
		if($result && $result2){
			echo "<title> H Δημοπρασία ακυρώθηκε!</title>";
			echo "H Δημοπρασία με κωδικο :$PID ακυρώθηκε!";
		}
			echo "<form action='svp.php'><button action='svp.php'>Go Back</button></form>";
	}
  ?>
