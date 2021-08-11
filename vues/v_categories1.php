<?php
if ($_SESSION['ok'] != 'oui') 
{
	include("vues/v_accueil.php");
}
?>
<ul id="categories">

<?php

foreach( $lesCategories as $uneCategorie) 
{
	$idCategorie = $uneCategorie['CAT_id'];
	$libCategorie = $uneCategorie['libelle'];
  ?>
	<li>
		<a href=index.php?uc=verifAdmin&categorie=<?=$idCategorie ?>&action=voirProduits><?=$libCategorie ?></a>
		
	</li>
	
<?php
}
?>
<li style ="border : 1px solid black; border-radius : 2px;"><a href=index.php?uc=verifAdmin&action=afficheAjout><i class="fas fa-plus-circle"></i>Ajouter</a></li>
</ul>
