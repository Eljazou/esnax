<?php 
$data=array();
$i=0;
foreach($visites as $visite)
{
	$data[$i]["vm"]=$visite["User"]["name"];
	$data[$i]["commentaire"]=$visite["Visite"]["commentaire"];
	$data[$i]["client"]=$visite["Client"]["nom"]." ".$visite["Client"]["prenom"];
	$data[$i]["potentialite"]=$visite["Client"]["potentialite"];
	$data[$i]["longitude"]=$visite["Client"]["longitude"];
	$data[$i]["latitude"]=$visite["Client"]["latitude"];
	$data[$i]["activite"]=$visite["Client"]["activite"];
	$data[$i]["exercice"]=$visite["Client"]["exercice"];
	$data[$i]["type"]=$types[$visite["Client"]["type_id"]];
	$data[$i]["category"]=$categories[$visite["Client"]["category_id"]];
	$i++;
}
debug($data,0,0);
 ?>