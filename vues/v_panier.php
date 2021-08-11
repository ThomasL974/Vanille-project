
<?php

foreach( $lesProduitsDuPanier as $unProduit) 
{
	$id = $unProduit['PDT_id'];
	$description = $unProduit['descrip'];
	$image = $unProduit['image'];
	$prix = $unProduit['prix'];
  ?>
	<p>
	<img src="<?=$image ?>" alt=image width=100	height=100 />
	<?php
		echo	$description."($prix Euros)";
	 ?>	
	<a href="index.php?uc=gererPanier&produit=<?=$id ?>&action=supprimerUnProduit"
       onclick="return confirm('Voulez-vous vraiment retirer ce produit?');">
       <img src="images/RetirerPanier.png" TITLE="Retirer du Panier"></a>	
	</p>
	<?php
}
?>
<br>

<ul id="menu">

        <li>
		<a href=index.php?uc=gererPanier&action=passerCommande>Passer commande</a>
		</li>
		
	
</ul>