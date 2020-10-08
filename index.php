<?php
session_start();

   
$user ='wimaissa';
$password_per ='123456789';


if(isset($_POST['submit'])){
	$username = $_POST['username'];
    $password = $_POST['password'];
    if(($username) && ($password)){

          if ($username == $user && $password == $password_per){
          	    $_SESSION['username']= $username;
                header('location: admin.php');
              
          }else{
          	echo'votre nom ou mot de passe est incorrect';


          }
    }else{

    	echo'Veuillez remplir tous les champs !';
    }

}


?>


<h1>Administation - Connexion</h1>
<form action="" method="POST">
   <h3>Nom:</h3>	<input type="text" name="username"/><br/><br/>
   <h3>Mot-de-passe:</h3>	<input type="password" name="password"/><br/><br/>
	<input type="submit" name="submit"/><br/><br/>

</form>