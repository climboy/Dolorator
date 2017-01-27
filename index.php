<?php

function explore()
{
	$dir = '../';
	$dh  = scandir($dir);

	for ($i=0; $i<count($dh) ; $i++) 
	{ 	
	 
	 echo '<a href=>'.$dh[$i].'</a><br>';
	}
}
explore();


?>