<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Dolorator</title>
  </head>
  <body>
    <a href="home.php"><img class="home" src="./css/house.png"></a>
    <h1>Dolorator</h1>
    
    <div class="container">
      <?php
      
      if(isset($_REQUEST["variable"])){/* condition permettant de vérifier si la variable "variable" existe.*/
         $chemin="c:/xampp/htdocs/".$_REQUEST['variable'];
         $path=$_REQUEST["variable"];
        
      }
      else{
        $chemin="c:/xampp/htdocs/";/* variable donnant le chemin du dossier  de base ou l'on se trouve*/
          
          $path="";
      }
      
      if (is_file($chemin)) {
      OpenFile($chemin,$path);
      }
      else {
        $return=scandir($chemin);/* variable qui permet de scanner le dossier*/
        function decoupe($str){
            $i=0;
            $tmp=0;
            while ($i <strlen($str)){
            if ($str[$i]=='/')
                $tmp=$i;
                $i++;
            }
            $retour = substr($str, 0, $tmp);
            return $retour;
        }
?>
        <img class="explo"src="./css/explore.png">
        <?php

       /* lister les dossiers*/
        foreach($return as $list){ /* boucle foreach cherche 1 par 1 les éléments de la variable return pour pouvoir les utiliser sous le nom de list*/
  if ($list == '.') {
    echo "";
  }
            else if ($list == '..') {
                $tmp = decoupe($path);
             
            }
            else if (is_dir($chemin."/".$list)) {

               echo "<div class='col-md-4'><a class='soul' href=?variable=".$path."/".$list."> <img src='./css/dossier.png'>$list</a> </div>";/* affiche la liste des éléments*/
            }
            else{
                echo "<div class='col-md-4'><a class='soul' href=\"?variable=".$path."/".$list."\"> <img src='./css/fichier.png'> </a>$list <a class='soul' href=?variable='$list'></a></div>";/* affiche la liste des éléments*/
            }
        }
      }

     function OpenFile($chemin,$path){ 

     $doc = verifFile($path);
      if($doc[1] == "png" || $doc[1] == "ico"  || $doc[1] == "jpg")
    {
      echo "<img src='$path'>";
    }
    else
    {
      
      echo htmlentities(highlight_string(file_get_contents($chemin)));
    }        

 }   
    function verifFile($doc)
  {
    $tableau = [];
    $tableau[0] = strripos($doc, ".");
    $tableau[1] = substr($doc, $tableau[0] + 1);
    return $tableau;
  }

     ?>
      </div>

   
   
    <a id="return" class="col-md-6 col-md-offset-3" href="?path=$parent"><img src="./css/return.png" alt=""></a>
 
  </body>
</html>