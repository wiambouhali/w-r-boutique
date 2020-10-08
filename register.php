<?php

require_once('includes/header.php');



if(isset($_POST['submit'])){

	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$repeatpassword=$_POST['repeatpassword'];

	if($username&&$email&&$password&&$repeatpassword){

		if($password==$repeatpassword){

         $db->query("INSERT INTO users VALUES('', '$username', '$email', '$password')");
             
              echo'<br/><h3 style="color:green;">Vous avez créer votre compte,vous pouvez maintenat vous <a href="connect.php"> connecter</a>.</h3>';

		}else{

			echo'<br/><h3 style="color:red;">Les mot des passes ne sont pas identiques</h3>';
		}

	}else{

		echo'<br/><h3 style="color:red;">Veuillez remplir tous les champs</h3>';
	}
}

?>
<br/>
<h1>S'enregister</h1>

 <form action="" method="POST">
 	
 	<h4>Pseudo <input type="text" name="username"/></h4>
 	<h4>E-mail <input type="email" name="email"/></h4>
 	<h4>Mot-de-passe <input type="password" name="password"/></h4>
 	<h4>Confirmer votre mot-de-passe <input type="password" name="repeatpassword"/></h4><br/>
    <input type="submit" name="submit"/>
 </form><br/>
 <a href="connect.php">Se connecter</a><br/>
<br/>
 <?php
echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';

 require_once('includes/footer.php');

 ?>