<?php
require_once('includes/header.php');
echo'<br/>';


?>
<h1 style="font-family:Courier New; font-weight: bold; font-size:80px; text-decoration:overline;">Bienvenue Sur W&R BOUTIQUE</h1>





<?php

 $select =$db->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 0,3");
     $select->execute();

     while ($s=$select->fetch(PDO::FETCH_OBJ)) {

           $lenght=40;
     	   $description=$s->description;
     
           $new_description=substr($description,0,$lenght)."...";

           $description_finale=wordwrap($new_description,50,'<br />', false);


   ?>

   <div style="text-align:center;">
   <img height="300" width="300" src="admin/imgs/<?php echo $s->title; ?>.jpg"/>
   <h2 style="color:black;"><?php echo $s->title;?></h2>
   <h5 style="color:black;"><?php echo $description_finale;?></h5>
   <h4 style="color:black;"><?php echo $s->price;?> DZ</h4></div>
<br/><br/>

   <?php
    } 	


?>


<?php
echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
require_once('includes/footer.php');
?>






