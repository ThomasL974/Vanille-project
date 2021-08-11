<?php
if ($_SESSION['ok'] != 'oui') 
{
	include("vues/v_accueil.php");
}
?>
<div id="produits">
<?php
echo '    ClIQUEZ A DROITE DU PRODUIT POUR MODIFIER OU SUPPRIMER LE PRODUIT';

foreach( $lesProduits as $unProduit) 
{
	$id = $unProduit['PDT_id'];
	$description = $unProduit['descrip'];
	$prix=$unProduit['prix'];
	$image = $unProduit['image'];
  ?>
<table  cellpadding=10 cellspacing=10>  
	<tr> 
			<td><img src="<?=$image ?>" alt=image /></td>
			<td><?=$description ?></td>
			 <td><?=$prix." Euros" ?></td>
			 <td><a href=index.php?uc=verifAdmin&produit=<?=$id?>&action=voirModification><i class="fas fa-marker" style="color : green;" value="Modifier"></i></a></td>
			 <td><a href=index.php?uc=verifAdmin&produit=<?=$id?>&action=supprimerProduit ><i class="fas fa-trash-alt" style="color : red;" value="Supprimer"></i></a></td>
			
	</tr>
	
			
<?php			
}
?>
</table>
</div>
