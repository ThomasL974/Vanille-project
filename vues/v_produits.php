<div id="produits">
<?php
echo '    ClIQUEZ A DROITE DU PRODUIT POUR AJOUTER AU PANIER  ';
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
			 <td><a href=index.php?uc=voirProduits&categorie=<?=$categorie ?>&produit=<?=$id ?>&action=ajouterAuPanier> 
			 <i class="fas fa-shopping-cart" style="color : green;"></i></td></a>
			 
			
	</tr>
			
<?php			
}
?>
</table>
</div>
