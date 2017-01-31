<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Dolorator</title>
  </head>
  <body>
    <h1>Dolorator</h1>
    <div class="container">
      <?php
      $chemin="c:/xampp/htdocs/";/* variable donnant le chemin du dossier  de base ou l'on se trouve*/
      if(isset($_REQUEST["variable"])){/* condition permettant de vérifier si la variable "variable" existe.*/
          $path=$_REQUEST["variable"];
      }
      else{
          $path="";
      }
      $chemin=$chemin.$path;
      echo ($path);
      if (is_file($chemin)) {
    OpenFile($chemin);
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

     function OpenFile($list=''){
      
      $descFic = fopen ($list, "r");
      while ($ligne = fread($descFic, filesize($list)))
{
  print $ligne."";
}
      fclose ($descFic);
    }

     ?>
      </div>

   </div>
    <a id="return" class="col-md-6 col-md-offset-3" href="list.php"><img src="./css/return.png" alt="">Return</a>
  </body>
</html>