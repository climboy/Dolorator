<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Liste des Dossiers</title>
  </head>
  <body>
    <h1>Liste des Dossiers</h1>
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
<<<<<<< HEAD
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


               echo "<a href='?variable=".$tmp."'><img src='./css/return.png'>$list</a>";
            }
            else if (is_dir($chemin."/".$list)) {

                echo "<a href=?variable=".$path."/".$list."><img src='./css/dossier.png'>$list</a>";/* affiche la liste des éléments*/
            }
            else{
                echo "<a href=\"?variable=".$path."/".$list."\"><img src='./css/fichier.png'></a><br>";
                echo "$list <a href=?variable='$list'></a>";/* affiche la liste des éléments*/
            }
        }
=======
       
      
      /* lister les dossiers*/
      foreach($return as $list){ /* boucle foreach cherche 1 par 1 les éléments de la variable return pour pouvoir les utiliser sous le nom de list*/
if ($list == '.') {
  echo "";
}
          else if ($list == '..') {
              $tmp = decoupe($path);
            

             echo "<a href='?variable=".$tmp."'><img src='./css/return.png'>$list</a>";
          }
          else if (is_dir($chemin."/".$list)) {

              echo "<a href=?variable=".$path."/".$list."><img src='./css/dossier.png'>$list</a>";/* affiche la liste des éléments*/
          }
          else{
              echo "<img src='./css/fichier.png'><br>";
              echo "$list";/* affiche la liste des éléments*/
          }
>>>>>>> origin/master
      }

      function OpenFile($list=''){
      $descFic = fopen ($list, "r");
      while ($ligne = fread ($descFic, filesize($list)))
{
  print $ligne."";
}
      fclose ($descFic);
    }

      ?>
      </div>

    </div>
  </body>
</html>
