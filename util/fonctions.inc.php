<?php
/**
 * Initialise le panier de commande Vanille
 * Crée une variable de type session dans le cas
 * où elle n'existe pas 
*/
function initPanier()
{
	if(!isset($_SESSION['produits']))
	{
		$_SESSION['produits']= array();
	}
}
/**
 * Supprime le panier
 * Supprime la variable de type session 
 */
function supprimerPanier()
{
	unset($_SESSION['produits']);
}
/**
 * Ajoute un produit au panier
 *
 * Teste si l'identifiant du produit est déjà dans la variable session 
 * ajoute l'identifiant à la variable de type session dans le cas où
 * où l'identifiant du produit n'a pas été trouvé
 * @param $idProduit : identifiant de produit
 * @return vrai si le produit n'était pas dans la variable, faux sinon 
*/
function ajouterAuPanier($idProduit)
{
	
	$ok = true;
	if(in_array($idProduit,$_SESSION['produits']))
	{
		$ok = false;
		
	}
	else
	{
		$_SESSION['produits'][]= $idProduit;
		
	}
	return $ok;
}
/**
 * Retourne les produits du panier Vanille
 *
 * Retourne le tableau des identifiants de produit
 * @return : le tableau
*/
function getLesIdProduitsDuPanier()
{
	var_dump ($_SESSION['produits']);
	return $_SESSION['produits'];
	

}
/**
 * Retourne le nombre de produits du panier
 *
 * Teste si la variable de session existe
 * et retourne le nombre d'éléments de la variable session
 * @return : le nombre 
*/
function nbProduitsDuPanier()
{
	$n = 0;
	if(isset($_SESSION['produits']))
	{
	$n = count($_SESSION['produits']);
	}
	return $n;
}
/**
 * Retire un  produit du panier
 * Recherche l'index de l'idProduit dans la variable session
 * et détruit la valeur à ce rang
 * @param $idProduit : identifiant de produit
 */
function retirerDuPanier($idProduit)
  {
  /* recherche de l'index dans le tableau panier */
	 $index= array_search($idProduit,$_SESSION['produits']);
	 echo $index;
   
    // on supprime le produit dans le tableau panier avec la valeur index trouvée
    unset($_SESSION['produits'][$index]);
  }

/**
 * teste si une chaîne a un format de code postal
 *
 * Teste le nombre de caractères de la chaîne et le type entier (composé de chiffres)
 * @param $codePostal : la chaîne testée
 * @return : vrai ou faux
*/
function estUnCp($codePostal)
{
   
   return strlen($codePostal)== 5 && estEntier($codePostal);
}
/**
 * teste si une chaîne est un entier
 *
 * Teste si la chaîne ne contient que des chiffres
 * @param $valeur : la chaîne testée
 * @return : vrai ou faux
*/

function estEntier($valeur) 
{
	return preg_match("/[^0-9]/", $valeur) == 0;
}



/** Retourne un tableau d'erreurs de saisie pour une commande
 *
 * Ici uniquement pour le code postal mais pourrait etre utile
 * si autres controles plus specifiques
 * @param $cp : chaîne
 * @return : un tableau de chaînes d'erreurs
*/
function getErreursSaisieCommande($cp)
{
	$lesErreurs = array();
	if(!estUnCp($cp))
		{
			$lesErreurs[]= "erreur de code postal";
		}
return $lesErreurs;
}

function getCategorie($idCate){
	$categorie="";
	switch($idCate){
		case 'chocolats':{
			$categorie="cho";
		break;
		}
		case 'caramels':{
			$categorie="car";
		break;
		}
		case 'bonbons':{
			$categorie="bon";
		break;
		}
	}
	return $categorie;
}
?>
