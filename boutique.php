<?php
require_once('includes/header.php');

require_once('includes/sidebar.php');


if (isset($_GET['show'])){

     $product=$_GET['show'];
     
	 $select =$db->prepare("SELECT * FROM products WHERE title='$product'");
     $select->execute();

     $s=$select->fetch(PDO::FETCH_OBJ);
 
     $description=$s->description;
     $description_finale=wordwrap($description,100,'<br/>',false);


  ?>
  <br/><div style="text-align: center;">
   <img height="250" width="250" src="admin/imgs/<?php echo $s->title; ?>.jpg"/>
   <h1><?php echo $s->title; ?> </h1>
   <h5><?php echo $description_finale; ?> </h5>
   <h5>Stock: <?php echo $s->stock; ?></h5>
   <?php

        if ($s->stock!=0) {?><a href="panier.php?action=ajout&amp;l=<?php echo $s->title; ?>&amp;q=1&amp;p=<?php echo $s->price; ?>">Ajouter au panier</a><?php }else{echo'<h5 style="color:red;">Stock épuisé !</h5>';} ?>
   </div><br/>
  <?php


}else{

 if(isset($_GET['category'])){
     
     $category=$_GET['category'];
     $select =$db->prepare("SELECT * FROM products WHERE category='$category'");
     $select->execute();

     while ($s=$select->fetch(PDO::FETCH_OBJ)) {


     	   $lenght=75;

           $description=$s->description;
     
           $new_description=substr($description,0,$lenght)."...";

           $description_finale=wordwrap($new_description,50,'<br />', false);
    
      ?>
      <br/>
      <a href="?show=<?php echo $s->title; ?>"><img height="400" width="500" src="admin/imgs/<?php echo $s->title; ?>.jpg"/></a>
      <a href="?show=<?php echo $s->title; ?>"><h2><?php echo $s->title;?></h2></a>
      <h5><?php echo $new_description;?></h5>
      <h4><?php echo $s->price;?> DZ</h4>
      <h5>Stock: <?php echo $s->stock ?></h5>

      <?php

        if ($s->stock!=0) {?><a href="panier.php?action=ajout&amp;l=<?php echo $s->title; ?>&amp;q=1&amp;p=<?php echo $s->price; ?>">Ajouter au panier</a><?php }else{echo'<h5 style="color:red;">Stock épuisé !</h5>';} ?>
      <br/><br/>

       <?php
    } 	
?>
<br/><br/><br/><br/>

<?php

 }else{

$select =$db->query("SELECT * FROM category");

  while ($s=$select->fetch(PDO::FETCH_OBJ)){
   
   ?>
   
   <a href="?category=<?php echo $s->name;?>"><h3><?php echo $s->name ?></h3></a>
  

   <?php

  }

}
}
echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
require_once('includes/footer.php');


  
       
     
     
?>
