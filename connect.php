<?php

require_once('includes/header.php');





if(isset($_POST['submit'])){

	
	$email=$_POST['email'];
	$password=$_POST['password'];


	if($email&&$password){

		$select=$db->query("SELECT id FROM users WHERE email='$email'");

		if($select->fetchcolumn()){

			$select=$db->query("SELECT * FROM users WHERE email='$email'");
            $result=$select->fetch(PDO::FETCH_OBJ);
			$_SESSION['user_id'] = $result->id;
			$_SESSION['user_name'] = $result->username;
			$_SESSION['user_email'] = $result->email;
			$_SESSION['user_password'] = $result->password;


		}else{

           echo'<br/><h3 style="color:red;">Votre email ou mot de passe est incorrect.</h3>';

		}

         

	}else{

		echo'<br/><h3 style="color:red;">Veuillez remplir tous les champs</h3>';
	}
}

?>
<br/>
<h1>Se connecter</h1>

 <form action="" method="POST">
 	
 	
 	<h4>E-mail <input type="email" name="email"/></h4>
 	<h4>Mot-de-passe <input type="password" name="password"/></h4>
 	<br/>
    <input type="submit" name="submit"/>
 </form><br/>
 <a href="register.php">S'inscrire</a><br/>
<br/>
 <?php
echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
 require_once('includes/footer.php');

 ?>