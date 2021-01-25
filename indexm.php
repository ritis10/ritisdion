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
    <title>ΕΙΣΟΔΟΣ SVP OR MOD</title>
    <link rel=stylesheet type="text/css" href=style.css>
  </head>
  <body>
  	<center><h2><span>Καλως ήρθατε στο site xrisimos.gr για πλειστηριασμούς</span></h2><center>
	  <center><h4><span>Είσοδος Service Provider or Moderator</span></h4><center>
    <?php
      if($_SERVER["REQUEST_METHOD"]=="POST")
      {
        $usr=$_POST['usr'];
        $pass=$_POST['passwd'];
        if(isset($_POST['category']))
        	$cat=$_POST['category'];

        $query="select username from providerormoderator where username='$usr' and password='$pass';";
        $result=mysqli_query($db,$query) or die("Η σύνδεση απέτυχε");
        $count=mysqli_num_rows($result);
		      if($count!=1)
          {
            $error="Λάθος Username \n ή password \n ή category";
            $query="select username from users where username='$usr' and password='$pass' and Is_Provider='$cat'";
            $result=mysqli_query($db,$query) or die("Η σύνδεση απέτυχε");
            $count=mysqli_num_rows($result);
              if($count==1)
              {
                  echo '<tr>';
                  echo '<td>' ."Ο λογαριασμός σας δεν ισχύει".'</td>';
                  //echo '<td>' ."\t Επικοινωνήστε με το διαχ/στή του συστήματος για ενεργοποίηση".'</td>';
                  echo '</tr>';
              }
          }
          else
          {
            $_SESSION["logged"]=$cat;
            $_SESSION["Name"]=$usr;
            if($cat=="1")
          	   header("location: svp.php");
            else if($cat=="0")
          	   header("location: Moderator_portal.php");
            else
              echo "Δεν έχετε εισάγει την κατηγορία admin";
           }
      }
     ?>

    <center>
    <form id="login" method="post" action="">
    <p class="title"><b>Είσοδος Admin</b></p>

    <input type="text" placeholder="Username" id='usr' name='usr'  required/>
    <input type="password" placeholder="Password" id='passwd' name='passwd' required/>
    <p>
      (Service Provider)Πάροχος<input type="radio" name='category' value="1">
    </p>
    <p>
      (Moderator)Διαμεσολαβητής<input type="radio" name='category' value="0">
    </p>
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
    </form>
  </center>
  </body>
   </html>
