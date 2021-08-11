<?php
/** 
 * Classe d'accès aux données. 
 * Utilise les services de la classe PDO
 * pour l'application Vanille
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoVanille qui contiendra l'unique instance de la classe
 *
 * @package default
 * @author slam5
 * @version    1.0

 */

class PdoVanille
{   		
      	private static $monPdo;
		private static $monPdoVanille = null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct()
	{
    		PdoVanille::$monPdo = new PDO('mysql:host=localhost;dbname=vanille;charset=utf8', 'root', 'root');
	}
	public function _destruct(){
		PdoVanille::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 *
 * Appel : $instancePdoVanille = PdoVanille::getPdoVanille();
 * @return l'unique objet de la classe PdoVanille
 */
	public  static function getPdoVanille()
	{
		if(PdoVanille::$monPdoVanille == null)
		{
			PdoVanille::$monPdoVanille= new PdoVanille();
		}
		return PdoVanille::$monPdoVanille;  
	}
/**
 * Retourne toutes les catégories sous forme d'un tableau associatif
 *
 * @return le tableau associatif des catégories 
*/
	public function getLesCategories()
	{
		$req = "SELECT * from categorie";
		$res = PdoVanille::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

/**
 * Retourne sous forme d'un tableau associatif tous les produits de la
 * catégorie passée en argument
 * 
 * @param $idCategorie 
 * @return un tableau associatif  
*/

	public function getLesProduitsDeCategorie($idCategorie)
	{
	    $req="SELECT * from produit where idCategorie = '$idCategorie'";
		$res = PdoVanille::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes; 
	}
/**
 * Retourne les produits concernés par le tableau des idProduits passés en argument
 *
 * @param $desIdProduit tableau d'idProduits
 * @return un tableau associatif 
*/
	public function getLesProduitsDuTableau($desIdProduit)
	{
		$nbProduits = count($desIdProduit);
		$lesProduits=array();
		if($nbProduits != 0)
		{
			foreach($desIdProduit as $unIdProduit)
			{
				$req = "SELECT * from produit where PDT_id = '$unIdProduit'";
				$res = PdoVanille::$monPdo->query($req);
				$unProduit = $res->fetch();
				$lesProduits[] = $unProduit;
			}
		}
		return $lesProduits;
	}

/**
 * Retourne le produit concernée par l'idProduit passé en paramètre
 * 
 * @param $idProduit id du produit
 * @return un Produit
 */
	public function getLeProduit($idProduit){
		$req="SELECT * from produit where  PDT_id= '$idProduit';";
		$res = PdoVanille::$monPdo->query($req);
		$laLignes = $res->fetch();
		return $laLignes;

	}
/**
 * Création d'une commande 
 *
 * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
 * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
 * tableau d'idProduit passé en paramètre
 * @param $nom 
 * @param $rue
 * @param $cp
 * @param $ville
 * @param $mail
 * @param $lesIdProduit
 
*/
	public function creerCommande($nom,$rue,$cp, $lesIdProduit,$ville,$mail )
	{
		$req = "SELECT max(CDE_id) as maxi from commande";
		$res = PdoVanille::$monPdo->query($req);
		$laLigne = $res->fetch();
		$maxi = $laLigne['maxi'] ;
		$maxi++;
		$idCommande = $maxi;
		echo $idCommande."<br>";
		$date = date('Y/m/d');
		$req = "INSERT into commande values ('$idCommande','$date','$nom','$rue','$cp','$ville','$mail')";
		echo $req."<br>";
		$res = PdoVanille::$monPdo->exec($req);
		/** A RAJOUTER  INSERTION DANS LA TABLE CONTENIR
		 
		 balayage du tableau des produits
		*/	
		foreach($lesIdProduit as $idProduit)
		{
			$req_contenir = "INSERT into contenir value('$idCommande','$idProduit')";
			echo $req_contenir."</br>";
			$res_contenir = PdoVanille::$monPdo->exec($req_contenir);
			$req_update = "UPDATE produit set Qte=(Qte-1) where PDT_id='$idProduit'";
			echo $req_update."</br>";
			$res_update= PdoVanille::$monPdo->query($req_update);
		}

		
	}
/**
 * Suppresion d'un produit
 * 
 * Supprime un produit en fonction de l'idProduit passé en paramètre, vérifie si une commande existe 
 * pour un produit en comptant le nombre de commande, si pas de commande supprime le produit
 * 
 * @param $idProduit
 * @return un boolean $verif
 */
	public function supprimerProduit($idProduit)
	{
		$verif = true;
		//Compte le nombre de commande
        $req_verif = "SELECT count(CDE_id) as total from commande, contenir where commande.CDE_id = contenir.idcommande and contenir.idProduit = '$idProduit' group by CDE_id";
        $res_verif = PdoVanille::$monPdo->query($req_verif);
		$nbProdCommande = $res_verif->fetch()['total'];
		
		//Vérification du nombre de commande
		if($nbProdCommande>0){
			$verif=false;
		}
		else
		{
			//Suppression du produit
			$req_delete_produit = "DELETE FROM produit where PDT_id='$idProduit';";
			$res = PdoVanille::$monPdo->exec($req_delete_produit);
			
		}
		return $verif;
	}
/**
 * Modification du produit
 * 
 * Modifie un produit($idProduit), en fonction de sa desciption, son prix, et sa quantité au stock passé en paramètre
 * 
 * @param $idProduit
 * @param $description
 * @param $prix
 * @param $qte
 */
	public function modifierProduit($idProduit,$description,$prix,$qte)
	{
		$req="UPDATE produit set descrip='$description', prix='$prix', Qte='$qte' where PDT_id='$idProduit';";
		echo $req;
		$res = PdoVanille::$monPdo->exec($req);
	}
/**
 * Connexion administrateur
 * 
 * Return un administrateur en fonction du login passé en paramètre
 * 
 * @param $login 
 * @return un administrateur
 */
	public function connexion($login){
		$req="SELECT * from administrateur where login = '$login'";
		echo $req;
		$res = PdoVanille::$monPdo->query($req);
		$lignes=$res->fetch();
		return $lignes;
	}
/**
 * Ajout d'un produit
 * 
 * Dans un premier temps récupère le numéro max de l'identifiant du produit en fonction de l'$idCategorie passé en paramètre
 * Dans un deuxième temps récupère les lettres de l'identifiant du produit en fonction de l'$idCategorie passé en paramètre
 * Effectue une vérifiction si le nombre max est au-dessus de 10 ou non, en fonction de la vérifiction, si le nombre max est
 * au-dessus de 10, effectue une concatenation à un 0 sinon codifie normalement l'identifiant.
 * 
 * à la suite le produit est ajouté en fonction de sa categorie, de sa description, de son prix, et de l'image passé en paramètre  
 * 
 * @param $idCategorie
 * @param $description
 * @param $prix
 * @param $image
 */
	public function ajoutProduit($idCategorie,$description,$prix,$image){
		//Récupération du nombre max
		$req_nb_idProduit = "SELECT substring(max(PDT_id),3) as total from produit where idCategorie='$idCategorie';";
		$res_id = PdoVanille::$monPdo->query($req_nb_idProduit);
		$ligneProduit = $res_id->fetch();
		$nbIdProduit = $ligneProduit['total'];
		
		//Récupération des lettres
		$req_lt_produit = "SELECT distinct substring(PDT_id,1,2) as lettre from produit where idCategorie='$idCategorie'";
		$res_lt = PdoVanille::$monPdo->query($req_lt_produit);
		$ligneLtProduit = $res_lt->fetch();
		$lettreProduit=$ligneLtProduit['lettre'];
		
		//Ajout +1 au nombre max
		$code_NbProduit = $nbIdProduit+1;

		//Vérification du nombre max
		if($code_NbProduit<10){
			$code = $lettreProduit.'0'.$code_NbProduit;
		}else{
			$code = $lettreProduit.$code_NbProduit;
		}
		echo($code);

		//Ajout du produit
		$req = "INSERT INTO produit 
		value 
		('$code',
		'$description',
		 $prix,
		'$image',
		'$idCategorie',
		 10)";
		 $res = PdoVanille::$monPdo->exec($req) or die ("un problème est survenu à la requete suivante : ".$req);
	}

/**
 * Récupération des lettres de l'identifiant du produit en fonction de l'idProduit passé en paramètre
 * 
 * @param $idProduit
 * @return les 2 premières lettre de l'id du produit
 */
	public function getLettreId($idProduit){
		$req= "SELECT distinct substring(PDT_id,1,2) as lettre from produit where PDT_id='$idProduit'";
		$res = PdoVanille::$monPdo->query($req);
		$ligneLtProduit = $res->fetch();
		$lettreProduit=$ligneLtProduit['lettre'];
		return $lettreProduit;

	}
}
?>