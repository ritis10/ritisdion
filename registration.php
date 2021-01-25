<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
<style>
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
  <title>ΕΓΓΡΑΦΗ ΧΡΗΣΤΗ</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <ul>
      <li><a href="guest.php">Προϊόντα</a></li>
      <li><a href="contactus.php">Επικοινωνία</a></li>
      <li><a class="active" href="registration.php">Register </a></li>
      <li><a href="index.php">Επιστροφή στο αρχικό μενού</a><li>
  </ul>
  <center>
  <form id = "register" method="post" action="registration.php">
    <p class="title"><b>ΕΓΓΡΑΦΗ ΧΡΗΣΤΗ</b></p>
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Όνομα Χρήστη</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Κωδικός</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Επιβεβαιώση Κωδικού</label>
  	  <input type="password" name="password_2">
  	</div>
    <div class="input-group">
      <label>Όνομα</label>
      <input type="text" name="name" value="<?php echo $name; ?>">
    </div>
    <div class="input-group">
      <label>Επώνυμο</label>
      <input type="text" name="lastname" value="<?php echo $lastname; ?>">
    </div>
    <div class="input-group">
      <label>Διέυθυνση Κατοικίας</label>
      <input type="text" name="address" value="<?php echo $address; ?>">
    </div>
    <div class="input-group">
      <label>Ημερομηνία Γέννησης</label>
      <input type="date" name="date" value="<?php echo $date; ?>">
    </div>
    <div class="input-group">
        <label><b><u>Επιλέξτε Κατηγορία user</u></b></label>
    <p>
        Eνδιαφερόμενος (Buyer) <input type="radio" name='category' value="buyer">
    </p>
    <p>
        Δημοπράτης (Seller)  <input type="radio" name='category' value="seller">
    </p>
    </div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user" id = "reg">Εγγραφή</button>
  	</div>
  	<p><i>
  	 	 Είσαστε ήδη εγγεγραμμένος;
  	</i></p>
    <p>
       <a href="index.php">Είσοδος σαν μέλος</a>
    </p>
  </form>
  </center>
</body>
</html>
