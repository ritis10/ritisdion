<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>ΕΓΓΡΑΦΗ ΧΡΗΣΤΗ</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <center>
  <form id = "register" method="post" action="registration.php">
    <p class="title">ΕΓΓΡΑΦΗ ΧΡΗΣΤΗ</p>
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
        <label>Επιλέξτε Κατηγορία</label>
      <input type="radio" name='category' value="buyer">Eνδιαφερόμενος (Buyer)
      <input type="radio" name='category' value="seller">Δημοπράτης (Seller)
    </div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user" id = "reg">Εγγραφή</button>
  	</div>
  	<p>
  		Already a member? <a href="index.php">Sign in</a>
  	</p>
  </form>
  </center>
</body>
</html>
