<?php
initPanier();
$action = $_REQUEST['action'];
switch($action)
{
	/**
	 * Affiche la vue connexion et initialise le message à vide
	 */
	case'voirConnexion':{
		$message="";
		include("vues/v_connexion.php");
	break;
	}


	/**
	 * Récupère le login et le mot de passe saisie 
	 * retourne un administreur dans $admin
	 * puis récupère le login et le mot de passe de cet $admin
	 * 
	 * vérifie si les champs sont vide et que le mot de passe saisie correspond au mot de passe de l'admin
	 * si NON alors il y a aucune connexion retour à la page connexion 
	 * si OUI alors une session est ouverte et le redirige vers l'acceuil 
	 */
    case 'connexion':{
        
        $login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];
		

        $admin = $pdo->connexion($login);
        $mdpBDD = $admin['mdp'];
		$loginBDD = $admin['login'];
		
		$message="";
		
        if($mdp!=$mdpBDD||$login==''||$mdp=='')
        {
			$_SESSION['ok']='non';
			$message = "Mot de passe ou login invalide";
			include("vues/v_connexion.php");
        }else{
			$_SESSION['ok']='oui';
			$message = "Administrateur";
			include("vues/v_message.php");
			$lesCategories = $pdo->getLesCategories();
            Header("Location:index.php");
		}
        break;
	}
	

	/**
	 * Supprime le produit et le renvoie sur la liste des produits où il a supprimé le produit  
	 */
    case 'supprimerProduit' :
	{
		
        $idProduit = $_REQUEST['produit'];
		$lettreIdProduit = $pdo->getLettreId($idProduit);
		switch($lettreIdProduit){
			case 'BO':{
				$categorie = "bon";
			break;
			}

			case'CA':{
				$categorie = "car";
			break;
			}
			case'CH':{
				$categorie = "cho";
			break;
			}
		}
		
		$suppresion = $pdo->supprimerProduit($idProduit);
		if($suppresion==false){
			$message = "Il y a déjà une commande pour ce produit impossible de le supprimer";
		}else{
			$message="La suppression c'est bien effectuée";
		}


		$lesProduits = $pdo->getLesProduitsDeCategorie($categorie);
		$lesCategories = $pdo->getLesCategories();
		
		include("vues/v_message.php");
		include("vues/v_categories1.php");
		include("vues/v_produits1.php");
		break;
		
	}


	/**
	 * Affiche la vue Modification en récupérant les informations du produit sélèctionné
	 */
	case 'voirModification' :
	{
		
		$idProduit = $_REQUEST['produit'];
		$produit=$pdo->getLeProduit($idProduit);
		$description = $produit['descrip'];
		$prix = $produit['prix'];
		$qte= $produit['Qte'];
		
		include("vues/v_modif.php");
		break;
	}


/**
 * Modifie le produit, sa description, son prix, et sa quantité en stock et
 * le redirige vers la catégorie où il a modifié le produit
 */
	case 'validModification':
	{
		
		
		$description = $_REQUEST['description'];
		$prix = $_REQUEST['prix'];
		$idProduit = $_REQUEST['id'];
		$qte=$_REQUEST['qte'];

		$pdo->modifierProduit($idProduit,$description,$prix,$qte);
		
		
		$message="Modification effectuée";
		include("vues/v_message.php");
			

		$lettreIdProduit = $pdo->getLettreId($idProduit);
		
		switch($lettreIdProduit){
			case 'BO':{
				$categorie = "bon";
			break;
			}

			case'CA':{
				$categorie = "car";
			break;
			}
			case'CH':{
				$categorie = "cho";
			break;
			}
		}

		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categories1.php");
		$lesProduits = $pdo->getLesProduitsDeCategorie($categorie);
		include("vues/v_produits1.php");
		
		break;
	}
	

	/**
	 * Affiche la liste des produits
	 */
    case 'voirProduits' :
	{
		$lesCategories = $pdo->getLesCategories();
		include("vues/v_categories1.php");
  		$categorie = $_REQUEST['categorie'];
		$lesProduits = $pdo->getLesProduitsDeCategorie($categorie);
		include("vues/v_produits1.php");
		
		break;
	}



	/**
	 * Affiche la liste des catégories
	 */
	case 'voirCategories':
		{
			$lesCategories = $pdo->getLesCategories();
			include("vues/v_categories1.php");
			break;
		}


	/**
	 * Affiche le formulaire ajout d'un produit
	 */
	case'afficheAjout':{
		include("vues/v_ajoutProduit.php");
		break;	
	}	


	/**
	 * Ajoute un produit 
	 */
	case 'ajoutProduit' : 
		{
			$qte = $_REQUEST['qte'];
			$description = $_REQUEST['description'];
			$prix = $_REQUEST['prix'];
			$categorie=getCategorie($_REQUEST['categorie']);
			switch($categorie){
				case 'bon':{
					$image="images/bonbons/".$_REQUEST['img'].".png";
				break;
				}
				case 'car':{
					$image="images/caramels/".$_REQUEST['img'].".png";
				break;
				}
				case 'cho':{
					$image="images/chocolats/".$_REQUEST['img'].".png";
				break;
				}
			}
			$pdo->ajoutProduit($categorie,$description,$prix,$image);
			$message="Ajout effectué";
			include("vues/v_message.php");
			$lesCategories = $pdo->getLesCategories();
			include("vues/v_categories1.php");
			$lesProduits = $pdo->getLesProduitsDeCategorie($categorie);
			include("vues/v_produits1.php");
		break;
		}
	/**
	 * Déconnecion de l'utilisateur administrateur
	 */
	case 'deconnexion' : 
		{
			$_SESSION['ok']='non';
			Header("Location:index.php");
			break;
		}
}
?>