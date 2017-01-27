<?php
// choix du répertoire et ouverture
$chemin = '../';
$repertoire = opendir($chemin);
// Boucle pour lire le répertoire ligne par ligne
while($element = readdir($repertoire)) {
	$liste[] = $element; }
// Tri des éléments et réindexation du tableau selon le nouvel ordre
natsort($liste);
$liste = array_values($liste);
// Comptage du nombre d'éléments
$nombre = count($liste);
?>
<table border-color="#666" border="1px"  cellpadding="2" cellspacing="0" class="normal">
<tr align="center" bgcolor="#CCCCCC">
<td><b>Répertoires</b></td>
<td><b>Fichiers</b></td>
</tr>
<?php
// Boucle pour lire et afficher les répertoires
for ($i=1; $i<=$nombre; $i++) {
	if ($liste[$i] != "." && $liste[$i] != "..") {
		echo '<tr align="center"><td>';
		if (is_dir($chemin.$liste[$i])) echo $liste[$i].'</td><td> ';
		else echo ' </td><td>'.$liste[$i];
		echo '</td></tr>'; } }
echo'</table>';
?>