<?php

session_start();
?>

<link href="../style/bootstrap.css" type="text/css" rel="stylesheet"/>
<h1>Bienvenue,  <?php echo $_SESSION['username']; ?> </h1>
</br>
<a href="?action=add">Ajouter un produit </a>
<a href="?action=modifyanddelete">Modifier / Supprimer un produit </a><br/><br/>

<a href="?action=add_category">Ajouter une categorie </a>
<a href="?action=modifyanddelete_category">Modifier / Supprimer une categorie </a><br/><br/>

<a href="?action=options">Options </a><br/><br/>

<?php
 try{
       $db = new PDO ('mysql:host=localhost;dbname=baseboutique','root','');
       $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); 
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
     }
    
    catch (Exception $e) {


 die ('une erreur est servenue');

 }

 
if(isset($_SESSION['username'])){
	if(isset($_GET['action'])){
   if ($_GET['action']=='add'){
  	if(isset($_POST['submit'])){

    $stock=$_POST['stock'];
  	$title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];

    $img=$_FILES['img']['name'];
    $img_tmp=$_FILES['img']['tmp_name'];

    if(!empty($img_tmp)){
     $image=explode('.',$img);
     $image_ext=end($image);
     if(in_array(strtolower($image_ext),array('png','jpg','jpeg'))===false){

      echo'veuillez rentrer une image ayant pour extension: png , jpg ou jpeg';

     }else{

      $image_size=getimagesize($img_tmp);
       if($image_size['mime']=='image/jpeg'){
        $image_src=imagecreatefromjpeg($img_tmp);

       }else if($image_size['mime']=='image/png'){
        $image_src=imagecreatefrompng($img_tmp);

     }else{
      $image_src=false;
      echo'veuillez rentrer une image valide';
     }
     if($image_src!==false){
      $image_width=100;
      if($image_size[0]=$image_width){
        $image_finale=$image_src;

      }else{
        $new_width[0]=$image_width;
        $new_heigt[1]=100;
        $image_finale=imagecreatetruecolor($new_width[0],$new_heigt[1]);
        imagecopyresampled($image_finale,$image_src,0,0,0,0,$new_width[0],$new_heigt[1],$image_size[0],$image_size[1]);
      }
      imagejpeg($image_finale,'imgs/'.$title.'.jpg');
     }
     }
    }else{

      echo'veuillez rentrer une image';
    }

if($title&&$description&&$price&&$stock){ 
      $category=$_POST['category'];
      $weight=$_POST['weight'];
      $select=$db->query("SELECT price FROM weights WHERE name='$weight'");
      $s=$select->fetch(PDO::FETCH_OBJ);

      $shipping=$s->price;

      $old_price=$price;

      $Final_price=$old_price + $shipping;

      $select=$db->query("SELECT tva FROM products");

      $s1=$select->fetch(PDO::FETCH_OBJ);

      $tva=$s1->tva;

      $final_price_1=$Final_price+$Final_price+$tva/100;

     $insert=$db->prepare("INSERT INTO products VALUES ('','$title','$description','$price','$category','$weight','$shipping','$tva','$final_price_1','$stock')"); 
     $insert->execute();

    }else{

      echo'veuillez remplir tous les champs';

    }
  }

?>
<form action="" method="post" enctype="multipart/form-data">
<h3>Titre de produit:</h3><input type="text" name="title"/> 
<h3>Description de produit:</h3><textarea name="description"></textarea>
<h3>Prix:</h3><input type="text" name="price"/><br/><br/>
<h3>Image:</h3>
<input type="file" name="img"/><br/><br/>
<h3>Categorie:</h3><select name="category">


  <?php

$select=$db->query("SELECT * FROM category");
while($s=$select->fetch(PDO::FETCH_OBJ)){

  ?>
<option><?php echo $s->name; ?></option>
  <?php

  }
  ?>

</select><br/><br/><br/>

<h3>Pois(moins de): </h3>
<select name="weight">
  
  <?php

$select=$db->query("SELECT * FROM weights");
while($s=$select->fetch(PDO::FETCH_OBJ)){

  ?>
<option><?php echo $s->name; ?></option>
  <?php

  }
  ?> 


</select><br/><br/><br/>
<h3>Stock: </h3><input type="text" name="stock"/><br/><br/>
<input type="submit" name="submit"/>
  
</form>

<?php
}else if($_GET['action']=='modifyanddelete'){

     $select =$db->prepare("SELECT * FROM products");
     $select->execute();

     while ($s=$select->fetch(PDO::FETCH_OBJ)) {
      echo $s->title;
      ?>

      <a href="?action=modify&amp;id=<?php echo $s->id; ?>">Modifier</a>
       <a href="?action=delete&amp;id=<?php echo $s->id; ?>">x</a></br></br>
      <?php
      
     }


  }else if($_GET['action']=='modify'){

    $id=$_GET['id'];
    $select=$db->prepare("SELECT * FROM products WHERE id=$id");
    $select->execute();
    $data=$select->fetch(PDO::FETCH_OBJ);
  ?>
<form action="" method="post">
<h3>Titre de produit:</h3><input value="<?php echo $data->title; ?>" type="text" name="title"/> 
<h3>Description de produit:</h3><textarea name="description"><?php echo $data->description; ?></textarea>
<h3>Prix:</h3><input value="<?php echo $data->price; ?>" type="text" name="price"/>
<h3>Stock: </h3><input type="text" value="<?php echo $data->stock; ?>" name="stock"/><br/><br/>
<input type="submit" name="submit" value="Modifier" />
  
</form>

  <?php

   if(isset($_POST['submit'])){
      
      $stock=$_POST['stock'];
      $title=$_POST['title'];
      $description=$_POST['description'];
      $price=$_POST['price'];

     $update=$db->prepare("UPDATE products SET title='$title',description='$description' ,price='$price' ,stock='$stock'  WHERE id=$id");
     $update->execute();
     header('location:admin.php?action=modifyanddelete');
     }


  }else if($_GET['action']=='delete') {

    $id=$_GET['id'];
      $delete =$db->prepare("DELETE * FROM products WHERE id=$id");
      $delete->execute();



  }else if ($_GET['action']=='add_category'){

     if (isset($_POST['submit'])){
       $name=$_POST['name'];

       if($name){

          $insert=$db->prepare("INSERT INTO category VALUES ('','$name')"); 
           $insert->execute();


       }else{
        echo'veuillez remplir tous les champs';
       }


     }
     ?>
     <form action="" method="post">
      <h3>Titre de la categorie: </h3><input type="test" name="name"/><br/><br/>
      <input type="submit" name="submit" value="Ajouter" />
     </form>  

     <?php

     }else if ($_GET['action']=='modifyanddelete_category'){

        $select =$db->prepare("SELECT * FROM category");
     $select->execute();

     while ($s=$select->fetch(PDO::FETCH_OBJ)) {
      echo $s->name;
      ?>

      <a href="?action=modify_category&amp;id=<?php echo $s->id; ?>">Modifier</a>
       <a href="?action=delete_category&amp;id=<?php echo $s->id; ?>">x</a></br></br>
      <?php
      
     }

     }else if ($_GET['action']=='modify_category'){

       $id=$_GET['id'];
    $select=$db->prepare("SELECT * FROM category WHERE id=$id");
    $select->execute();
    $data=$select->fetch(PDO::FETCH_OBJ);

  ?>
<form action="" method="post">
<h3>Titre de produit:</h3><input value="<?php echo $data->name; ?>" type="text" name="title"/> 

<input type="submit" name="submit" value="Modifier" />
  
</form>

  <?php

   if(isset($_POST['submit'])){
     
      $title=$_POST['title'];
      
     $update=$db->prepare("UPDATE category SET name='$title' WHERE id=$id");
     $update->execute();

     header('location:admin.php?action=modifyanddelete_category');
     }


     }else if ($_GET['action']=='delete_category'){

       $id=$_GET['id'];
      $delete =$db->prepare("DELETE * FROM category WHERE id=$id");
      $delete->execute();
      
      header('location: admin.php?action=modifyanddelete_category');

     }else if($_GET['action']=='options'){

      ?>

        <h2>Frais de ports: </h2><br/>
        <h3>Options de poids(Plus de)</h3>
      <?php
      $select=$db->query("SELECT * FROM weights");

       while($s=$select->fetch(PDO::FETCH_OBJ)){

           ?>
              <form action="" method="post">
              <input type="text" name="weight" value="<?php echo $s->name;?>"/><a href="?action=modify_weight&amp;name=<?php echo $s->name;?>">  Modifier</a>
              </form>

           <?php
       }
          $select=$db->query("SELECT tva FROM products ");
          $s=$select->fetch(PDO::FETCH_OBJ);

          if(isset($_POST['submit2'])){
             $tva=$_POST['tva'];

             if($tva){

                $update=$db->query("UPDATE products SET tva=$tva");

             }



          }
        ?>
              <h3>TVA: </h3>
              <form action="" method="post">
              <input type="text" name="tva" value="<?php echo $s->tva; ?>" />
              <input type="submit" name="submit2" value="Modifier"/>
              </form>
        <?php




     }else if($_GET['action']=='modify_weight'){

             $old_weight=$_GET['name'];
             $select=$db->query("SELECT * FROM weights WHERE name=$old_weight");
             $s=$select->fetch(PDO::FETCH_OBJ);

        if (isset($_POST['submit'])){

           $weight=$_POST['weight'];
           $price=$_POST['price'];

           if($weight&&$price){

             $update=$db->query("UPDATE weights SET name='$weight',price='$price' WHERE name=$old_weight");
           }

        }

        ?>
        <h2>Frais de ports: </h2><br/>
        <h3>Options de poids</h3><br/>

        <form action="" method="post">
          <h3>Poids(plus de) : </h3><input type="text" name="weight" value="<?php echo $_GET['name']; ?>"/><br/>
          <h3>Correspond a </h3><input type="text" name="price" value="<?php echo $s->price; ?>"/><h3>DZ</h3>
          <input type="submit" name="submit" value="modifier"/>

        </form>
        <?php


     }else{


     die('une erreur s\'est produite.');
    }


  }else{



  }  

 }else{
  header('location:../index.php');
}


?>



