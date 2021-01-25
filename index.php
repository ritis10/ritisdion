<!DOCTYPE html>
<?php
  session_start();
  $_SESSION["logged"]="";
  $_SESSION["Name"]="";
  $db=mysqli_connect('localhost','root','','auction') or die("Δεν έγινε επιτυχής πρόσβαση στη Βάση Δεδομένων");
  if (isset($_GET["err"]) and $_GET["err"]==1)
      echo "Please Login";
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>ΕΙΣΟΔΟΣ ΧΡΗΣΤΗ</title>
    <link rel=stylesheet type="text/css" href=style.css>
  </head>
  <body>
  	<center><h2><span>Καλως ήρθατε στο site xrisimos.gr για πλειστηριασμούς</span></h2><center>
	  <center><h4><span>Συμπληρώστε username και password για Είσοδο</span></h4><center>
    <?php
      if($_SERVER["REQUEST_METHOD"]=="POST")
      {
        $usr=$_POST['usr'];
        $pass=$_POST['passwd'];
        if(isset($_POST['category']))
        	$cat=$_POST['category'];

        $query="select username from users where username='$usr' and pass='$pass' and role='$cat'and status='3';";
        $result=mysqli_query($db,$query) or die("Η σύνδεση απέτυχε");
        $count=mysqli_num_rows($result);
		      if($count!=1)
          {
            $error="Λάθος Username \n ή password \n ή category ή ο λογ/σμος δεν είναι ενεργοποιημένος";
            $query="select username from users where username='$usr' and pass='$pass' and role='$cat'and status='temporarily disabled'or'finally disabled';";
            $result=mysqli_query($db,$query) or die("Η σύνδεση απέτυχε");
            $count=mysqli_num_rows($result);
              if($count==1)
              {
                  echo '<tr>';
                  echo '<td>' ."Ο λογαριασμός σας έχει απενεργοποιηθεί".'</td>';
                  echo '<td>' ."\t Επικοινωνήστε με το διαχ/στη του συστήματος για ενεργοποίηση".'</td>';
                  echo '</tr>';
              }
          }
          else
          {
            $_SESSION["logged"]=$cat;
            $_SESSION["Name"]=$usr;
            if($cat=="buyer")
          	   header("location: Listings.php");
            else if($cat=="seller")
          	   header("location: Seller_portal.php");
            else
              echo "Δεν έχετε επιλέξει κατηγορία user";

        /*  	header("location: svp.php");
	        else if($cat=="Moderator")
          	header("location: Moderator_portal.php");
          else
          	header("location: guest.php");
        */
           }
      }
     ?>

    <center>
    <form id="login" method="post" action="">
    <p class="title"><b>Είσοδος Χρήστη</b></p>

    <input type="text" placeholder="Username" id='usr' name='usr'  required/>
    <input type="password" placeholder="Password" id='passwd' name='passwd' required/>

    <label><b><u>Επιλέξτε Κατηγορία user</u></b></label>
    <p>
      Eνδιαφερόμενος (Buyer) <input type="radio" name='category' value="buyer">
    </p>
    <p>
      Δημοπράτης (Seller)  <input type="radio" name='category' value="seller">
    </p>
    <!--<input type="radio" name='category' value="svp">(Service Provider)Πάροχος!-->
	  <!--<input type="radio" name='category' value="Moderator">Διαμεσολαβητής!-->

    <?php
        if(isset($error) && !empty($error))
        {
          echo "<p id='error'> $error </p>";
        }
        mysqli_close($db);
    ?>
    <button type="submit" id='lgin'>
      Log In
    </button>
    <p>
       Δεν είσαστε μέλος; <a href="registration.php">Εγγραφή</a>
   </p>
    </form>
    <p>
    <a href="guest.php"><span>Για είσοδο σαν επισκέπτης</span></a>
    </p>
    <p>
    <a href="contactus.php"><span>Για επικοινωνία</span></a>
    </p>
    <p>
    <a href="indexm.php"><span>Service Providers or Moderators</span></a>
    </p>
  </center>
  </body>
   </html>
