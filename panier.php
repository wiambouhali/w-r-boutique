<?php
 
 require_once('includes/header.php');
 
 require_once('includes/functions_panier.php');
 require_once('includes/paypal.php');

 $erreur=false;

 $action=(isset($_POST['action'])?$_POST['action']:(isset($_GET['action'])?$_GET['action']:null));

  if($action!==null){

  	if(!in_array($action,array('ajout','suppression','refresh')))

  		$erreur=true;
  		 $l=(isset($_POST['l'])?$_POST['l']:(isset($_GET['l'])?$_GET['l']:null));
  		  $q=(isset($_POST['q'])?$_POST['q']:(isset($_GET['q'])?$_GET['q']:null));
  		   $p=(isset($_POST['p'])?$_POST['p']:(isset($_GET['p'])?$_GET['p']:null));

  		   $l=preg_replace('#\v#' , '' , $l);

  		   $p=floatval($p);

  		   if(is_array($q)){

  		   	$qteArticle=array();

  		   	$i=0;

  		   	foreach ($q as $contenu) {

  		   		$qteArticle[$i++] = intval($contenu);
  		   		
  		   	}

  		   }else{

  		   	  $q=intval($q);
  		   }
  	


  }

  if(!$erreur){

  	switch ($action){

  		 case "ajout":

  		   ajouterArticle($l,$q,$p);

  		 break;

  		 case "suppression":

  		   supprimerArticle($l);

  		 break;

  		 case "refresh":

  		   for ($i=0; $i<count($qteArticle);$i++){

  		   	 ModifierQteArticle($_SESSION['panier']['libelleProduit'][$i], round($qteArticle[$i]));

  		   }

  		 break;

  		 Default:

  		 break;
  	}
  }

 ?>

   <form method="post" action="">
   	  <table width="400">
   	  	<tr>
   	  		<td colspan="4">Votre panier</td>
   	  	</tr>
   	  	<tr>
   	  		<td>Libellé produit</td>
   	  		<td>Prix unitaire</td>
   	  		<td>Quantité</td>
   	  		<td>TVA</td>
   	  		
   	  	</tr>

   	  	 <?php

   	  	     if(isset($_GET['deletepanier']) && $_GET['deletepanier'] == true){

   	  	     	supprimerPanier();
   	  	     }

   	  	    if(creationPanier()){
   	  	   

   	  	    $nbProduits = count($_SESSION['panier']['libelleProduit']);

   	  	     if($nbProduits<=0){

   	  	     	echo'<br/><p style="font-size:20px; color:red;">Oops, panier vide !</p>';

   	  	     }else{

              

   	  	     	 for ($i=0; $i < $nbProduits; $i++) {
   	  	     		
   	  	     		?>

   	  	     		  <tr>
   	  	     		  	<td><br/><?php echo $_SESSION['panier']['libelleProduit'][$i]; ?></td>
   	  	     		  	
   	  	     		  	<td><br/><?php echo $_SESSION['panier']['prixProduit'][$i]; ?></td>
   	  	     		  	<td><br/><input name="q[]" value="<?php echo $_SESSION['panier']['qteProduit'][$i]; ?>" size="5"/></td>
   	  	     		  	<td><br/><?php echo $_SESSION['panier']['tva']." %"; ?></td>
   	  	     	        <td><a href="panier.php?action=suppression&amp;l=<?php echo rawurlencode($_SESSION['panier']['libelleProduit'][$i]); ?>"></a></td>

   	  	     		  </tr>

   	  	     		<?php } ?>
   	  	     		  <tr>
   	  	     		  	<td colspan="2"><br/>

                              <p>Total: <?php echo montantGlobal()." DZ"; ?></p><br/>
                              <p>Total avec TVA : <?php echo montantGlobalTVA()." DZ"; ?></p><br/>
                              <p>Calcul des frais de port: <?php echo CalculFraisPorts()." DZ"; ?></p>
                              <a href="#">Payer la commande</a>
   	  	     		  	</td>
   	  	     		  </tr>
   	  	     		  <tr>
   	  	     		  	<td colspan="4">
   	  	     		  		<input type="submit" value="rafraichir"/>
   	  	     		  		<input type="hidden" name="action" value="refresh" />
   	  	     		  		<a href="?deletepanier=true">Supprimer le panier</a>
   	  	     		  	</td>
   	  	     		  </tr>
   	  	     		<?php
   	  	     	

   	  	   
   	  	     }

   	  	 }

   	  	 ?>

   	  </table>

   </form>
 <?php
 echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';

 require_once('includes/footer.php');




?>