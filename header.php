<?php
session_start();
try 
     {
       $db = new PDO ('mysql:host=localhost;dbname=baseboutique','root','');
       $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); 
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
     }
    
    catch (Exception $e) {


 die ('une erreur est servenue');

 }
     
?>
<!DOCTYPE html>
<html>

   <head>
       <meta charset="utf-8">
	     <link href="style/bootstrap.css" type="text/css" rel="stylesheet"/>
   </head>

    <header>
    	<br/><h1>    W&R BOUTIQUE</h1><br/>
    	<ul class="menu">
    		<li><a href="index.php">Accueil</a></li>
    		<li><a href="boutique.php">Boutique</a></li>
    		<li><a href="panier.php">Panier</a></li>
        <li><a href="register.php">S'inscrire</a></li>
    		<li><a href="connect.php">Se connecter</a></li>
    		

    	</ul>
    </header>


</html>
<!DOCTYPE html>
<html lang="fr">
<head>
  
  <style>
    #my-hour{
      font-size: 35px;
      border-radius: 10px;
      border: solid 5px grey;
      display: inline;
            padding: 1px;
      margin-left:1050px;
    }
  </style>
</head>
<body>
  <h1 id="my-hour"></h1>
  <script>
    function getTime () { 
      var date = new Date(); 
      var hours = date.getHours(); 
      var minutes = date.getMinutes(); 
      var seconds = date.getSeconds(); 
      hours = ((hours < 10) ? " 0" : " ") + hours;
      minutes = ((minutes < 10) ? ":0" : ":") + minutes; 
      seconds = ((seconds < 10) ? ":0" : ":") + seconds; 
      var myHour = document.getElementById("my-hour");
      myHour.textContent = hours + minutes + seconds;
      setTimeout("getTime()",1000); 
      
    }
    getTime();
  </script>
</body>
</html>

<!DOCTYPE html> 
<html> 
<head>
 
  <style type="text/css"> 
  body { background-color:white; } 
#contcalendar{ width:200px;  margin:auto; margin-left:1000px; margin-top:5px; background-color:white; -webkit-box-shadow: 20px 20px 10px #212121; filter:progid:DXImageTransform.Microsoft.Shadow(color=#333333,direction=120,strength=5); box-shadow: 10px 10px 10px #212121; border:1px ridge #aaa; border-radius:10px; } 
#contcalendar table{ margin:auto; text-align:center; font-size:13px; font-weight:bold; line-height:20px; text-shadow: 10px 10px 10px #232711; filter:progid:DXImageTransform.Microsoft.Shadow(color=#333333,direction=120,strength=7);     } 
</style> 
<script> 
  function calendar() {   var monthNames= ['Jan','Fev','Mar','Avr','Mai','Jui','Juil','Aou','Sep','Oct','Nov','Dec'];   var jours= ['Lun','Mar','Mer','Jeu','Ven','Sam','Dim'];   
  var monthDays= [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];  
  var today= new Date();  
  var thisDay= today.getDate();   
  var year= today.getYear();  year <= 200 ? year += 1900 : null;  if (((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0)){     monthDays[1] = 29;  }   
  var nDays= monthDays[today.getMonth()];   
  var firstDay= today;  firstDay.setDate(0);  firstDay.getDate() == 2 ? firstDay.setDate(0) : null;     
  var startDay = firstDay.getDay();     
  var tb= document.createElement('table');    
  var tbr= tb.insertRow(-1);  
  var tbh= document.createElement("th");  tbh.setAttribute('colspan','7');  
  var tbhtxt= document.createTextNode(monthNames[today.getMonth()+1]+'.'+year);   tbh.appendChild(tbhtxt);  tbr.appendChild(tbh);   
  var tbr=tb.insertRow(-1);   
  for(var i=0 ;i<jours.length ; i++){     
    tbr.insertCell(-1).appendChild(document.createTextNode(jours[i]));  }   var tbr= document.createElement("tr");  var column= 0;  for (var i= 0; i < startDay; i++) {     tbr.insertCell(0);    column++;   }   for (var i = 1; i <= nDays; i++) 
    {       
      var tdd= tbr.insertCell(-1);    
      i == thisDay ? tdd.style.color="#FF0000" : null;    
      tdd.appendChild(document.createTextNode(i));    
      column++;     
      if (column == 7) {      
        tb.appendChild(tbr);      
        var tbr=document.createElement("tr");       
        column = 0;     }     
        i == nDays ? tb.appendChild(tbr) : null;  }   
        document.getElementById('contcalendar').appendChild(tb); } typeof window.addEventListener == 'undefined' ? window.attachEvent("onload",calendar) : addEventListener('load',calendar,false); 
</script> 
</head> 
<body> 
<div id='contcalendar'></div> </body> </html>