<?php
/********************************************************
* @author Madvic <http://www.madvic.net> <madvic@gmail.com>
* @copyright Copyright (c) 2008, Madvic
* @version : 1.0
*
* Date de dernière modification : 28/05/2008
* Description : Fichier index.php qui permet de lister tous les fichiers du répertoire et des sous répertoires
* 
* Paramètres : 
* 	$dir_icones : URL - Répertoire de stockage des icônes  ([extension].gif)
*	$list_dir :  boolean - Lister les dossiers
*	$list_file : boolean - Lister les fichiers
*	$nav_dir : boolean - Naviguer dans les répertoires
*
* @desc
* @example
* @filesource
* @license
* @link
* @name
* @package
* @param
* @return
* @see
* @since
* @subpackage
* @todo
* @tutorial
* @var
* @version
*
**/

class MadFile{

/**
* @desc Répertoire de stockage des icônes  ([extension].gif)
* @type texte / URL
**/
var $dir_icones = "http://madvic.free.fr/include/icones/";

/**
* @desc Lister les dossiers
* @type boolean
**/
var $list_dir = true;

/**
* @desc Lister les fichiers
* @type boolean
**/
var $list_file = true;

/**
* @desc Naviguer dans les répertoires
* @type boolean
**/
var $nav_dir = true;

/**
* @desc Affiche la taille récursive du dossier
* @type boolean
**/
var $dir_size = true;

/**
* @desc Précision de la taille des fichiers et dossiers
* @type int
**/
var $precision = 2;

/**
* @desc Renvoie l'extension d'un fichier
* @param string Chaine de caractère avec le fichier concerné
* @param boolean Renvoie l'extension en minuscule TRUE ou en majuscule FALSE
* @return string ou boolean Renvoie la chaine de caractère de l'extension ou false s'il n'y a pas d'extensions
*/
function get_ext($chaine,$minuscules=TRUE) {
	if(!is_string ($chaine) OR strpos($chaine,'.') === FALSE){
		return false;
	}

	$chaine=strrchr($chaine,'.');

	if($minuscules){
		return substr(strtolower($chaine),1);
	}
	else{
		return substr(strtoupper($chaine),1);
	} 
}


/**
* @desc Renvoie la taille récursive d'un répertoire
* @param string Adresse du répertoire
* @param boolean Taille ou récursive ou bien juste du contenu
* @return Renvioe la taille du répertoire
*/
function DirSize($path , $recursive=TRUE){ 
	$result = 0; 
	if(!is_dir($path) || !is_readable($path)) 
		return 0;
	$fd = dir($path); 
	while($file = $fd->read()){ 
		if(($file != ".") && ($file != "..")){ 
			if(@is_dir("$path$file/")) 
			$result += $recursive?DirSize("$path$file/"):0; 
		else  
			$result += filesize($path."/".$file); 
		} 
	} 
	$fd->close(); 
	return $result; 
} 



/**
* @desc Formatte la taille d'un fichier ou dossier et renvoie un tableau avec la valeur et l'unité de mesure
* @param $taille Taille en octet
* @return array Position 0 : Taille du fichier - Position 1 : unité de mesure (octet, Ko, Mo, Go)
*/
function tailleMemoire ($taille){

	if($taille <= 1000 ){
		return array(round($taille) , 'octet');
	}

	if($taille > 1000 && $taille <= 1000000 ){
		return array(round($taille / 1000, $this->precision) , 'Ko');    
	}

	if($taille > 1000000 && $taille <= 1000000000 ){
		return array(round($taille / 1000000, $this->precision) , 'Mo');    
	}

	if($taille > 1000000000){
		return array(round($taille / 1000000000, $this->precision) , 'Go');
	}

}

/**
* @desc 
* @param string 
* @param boolean 
* @return 
*/
function list_file($mydir) {

	$filelist = array();
	$dirlist = array();	
	
	if ($dir = opendir($mydir)){
		while (($file = readdir($dir)) !== false){
			if($file != "index.php" && substr(($file),0,1)!="." ){

				if(is_dir($mydir."/".$file) && $this->list_dir){
						 array_push($dirlist,$file);
				}
				if(is_file($mydir."/".$file) && $this->list_file){
						 array_push($filelist,$file);
				}
				if(!is_file($mydir."/".$file) && !is_dir($mydir."/".$file)){
				}
			}
		} 
		closedir($dir);
	}
	

    // Trie des tableaux des fichiers et répertoires
	if(sizeof($filelist) != '0') {
		sort($filelist);
		sort($dirlist);
	}
	else{
		sort($dirlist);
	}
    
    /**
    * Affichage du tableau des répertoires
    */
	for($i=0;$i < count($dirlist);$i++){
		$ext = "repertoire";
		echo "<tr valign=\"top\"><td>";
		echo "<img src=\"".$this->dir_icones.$ext.".gif\" >";
		if (!$nav_dir){
			echo "&nbsp;<a href=\"".$mydir."?dir=".rawurlencode($dirlist[$i])." \">".$dirlist[$i]."</a><br />\n";
		}
		else{
			echo "&nbsp;".$dirlist[$i]."<br />\n";
		}
		if(!$dir_size){
			$taille = $this->tailleMemoire($this->DirSize($dirlist[$i], true));
			echo "</td><td>&nbsp;&nbsp;&nbsp;".$taille[0]." ".$taille[1]."</td><td>&nbsp;</td>";
		}
		else{
			echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-</td><td>&nbsp;</td>";
		}
		echo "</td></tr>";
    }

    /**
    * Affichage du tableau des fichiers
    */
	for($i=0;$i < count($filelist);$i++){

			$ext = $this->get_ext($filelist[$i]);
			$lien = $mydir."/".$filelist[$i];
			$taille = $this->tailleMemoire(filesize($mydir."/".$filelist[$i]));
			
			echo "<tr><td>";
			if ($ext != "ico"){
				echo "<img src=\"".$this->dir_icones.$ext.".gif\"  width=\"16\" height=\"16\" >";          
			}
			else{
				echo "<img src=\"".$mydir.$filelist[$i]."\" width=\"16\" height=\"16\" />";            
			}

			echo "&nbsp;<a href=\"".$lien." \">".$filelist[$i]."</a><br />\n";
			echo "</td><td>&nbsp;&nbsp;&nbsp;".$taille[0]." ".$taille[1]."</td>";
			echo "<td>&nbsp;&nbsp;&nbsp;".date(  'd/m/Y H:i:s', filemtime($mydir."/".$filelist[$i]) )."</td></tr>";
	}
}

} //End of class MadFile
?>
<html>

<style>
	body{
		margin:				20px;
		font-family:		arial, "lucida console", sans-serif;
	}
	table{
		width:				100%;
		border-collapse:	collapse;
	}
	tr{
		vertical-align:		top;
		border-bottom: 1px;
		border-color:		black;
	}
	th,td{
		border-width:		0px;
		/*border-top:			0;
		border-right:		0;
		border-left:		0;*/
		border-bottom:		1px;
		text-align:			left;
		border-style:		solid; 
		border-color:		#F0F0F0;
		padding:			1.5px;

	}
	th{
		border-color:		black;
	}
	a{
		text-decoration: 	none;
	}
	a:hover{
		text-decoration: 	underline;
		color:				red;	
	}
	img{
	border : 0px;
	}
</style>
<body>
	<table>
		<tr>
			<th>&nbsp;&nbsp;&nbsp;Nom</th>
			<th>&nbsp;&nbsp;&nbsp;Taille</th>
			<th>&nbsp;&nbsp;&nbsp;Date de modification</th>
		</tr>  
		<!-- liste des fichiers -->
		<?php

			/* répertoire initial à lister */
			$dir = @$_GET['../dir'];
			$liste = new MadFile();

			if(!@$dir) {
			  $dir = ".";
			}
			else{
				echo "<tr><td>";
				echo "<a href=\"".$dir."/../\"><img src=\"".$liste->dir_icones."repertoire.gif\" />";
				echo "&nbsp;..</a><br />\n";
				echo "</td><td></td><td></td></tr>";
			}
			$liste->list_file(rawurldecode($dir)); 
 
		?>
	</table>
</body>
</html>