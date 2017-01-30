<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="utf-8">
    <title>Dolorator</title>
  </head>
  <body>
    <h1>Dolorator</h1>
    <div class="container">
<a href="list.php">Librairy</a>

<?php
$chemin="../";/* variable donnant le chemin du dossier  de base ou l'on se trouve*/
if(isset($_REQUEST["variable"])){/* condition permettant de vérifier si la variable "variable" existe.*/
    $path=$_REQUEST["variable"];
}
else{
    $path="";
}
$chemin=$chemin.$path;
echo ($path);
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
    if ($list == '..') {
        $tmp = decoupe($path);
        echo "<a href='?variable=".$tmp."'>$list</a><br>";
    }
    else if (is_dir($chemin."/".$list)) {
        echo "<img src='./css/dossier.png'><br>";
        echo "<a href=?variable=".$path."/".$list.">$list</a></br>";/* affiche la liste des éléments*/
    }
    else{
        echo "<img src='./css/fichier.png'><br>";
        echo "$list</br>";/* affiche la liste des éléments*/
    }
}
?>
</div>
  </body>
</html>
