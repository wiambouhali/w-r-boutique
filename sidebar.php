<div class="sidebar">
<h4 style="color:black;">Derniers Articles</h4>

<?php
 $select =$db->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 0,3");
     $select->execute();

     while ($s=$select->fetch(PDO::FETCH_OBJ)) {

           $lenght=35;
     	   $description=$s->description;
     
           $new_description=substr($description,0,$lenght)."...";

           $description_finale=wordwrap($new_description,50,'<br />', false);


   ?>

   <div style="text-align:center;">
   <img height="200" width="200" src="admin/imgs/<?php echo $s->title; ?>.jpg"/>
   <h2 style="color:white;"><?php echo $s->title;?></h2>
   <h5 style="color:white;"><?php echo $description_finale;?></h5>
   <h4 style="color:white;"><?php echo $s->price;?> DZ</h4></div>
<br/><br/>

   <?php
    } 	


?>

</div>