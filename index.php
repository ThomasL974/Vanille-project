<?php
//Controleur Principal du site Vanille 2019
session_start();

require_once("util/fonctions.inc.php");
require_once("util/class.pdoVanille.inc.php");
include("vues/v_entete.php");
//Vérification de l'accés administrateur ou client
if(!isset($_SESSION['ok'])||$_SESSION['ok']!='oui'){
	include("vues/v_bandeau.php");
	
}else{
	include("vues/v_bandeau1.php");
}
//Initialisation du controleur
if(!isset($_REQUEST['uc']))
    $uc = 'accueil';
else
	$uc = $_REQUEST['uc'];
/* Cr�ation d'une instance d'acc�s � la base de donn�es */
$pdo = PdoVanille::getPdoVanille();	 
switch($uc)
{
	//Direction vers accueil
	case 'accueil':
		{include("vues/v_accueil.php");break;}
	//Direction vers le controleur produits
	case 'voirProduits' :
		{include("controleurs/c_voirProduits.php");break;}
	//Direction vers le controleur de la gestion du panier
	case 'gererPanier' :
		{ include("controleurs/c_gestionPanier.php");break;}
	//Direction vers le controleur de la verification de l'administrateur
	case 'verifAdmin' : 
		{include("controleurs/c_verifAdmin.php");break;}
}
include("vues/v_pied.php") ;
?>

