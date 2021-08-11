<?php
if ($_SESSION['ok'] != 'oui') 
{
	include("vues/v_accueil.php");
}
?>
<div class="login-page">
    <div class="log">
        <form method="POST" action="index.php?uc=verifAdmin&action=validModification" class="login-form">
            
                <h4>Modification du produit</h4>
                <input id="id" type="text" name="id" value="<?=$idProduit; ?>" readonly="readonly">
            
            
                <h5>Description du produit</h5>
                <input id="description" type="text" name="description" value="<?=$description; ?>" placeholder="Descripiton" required="">
            
            
                <h5>Prix du produit</h5>
                <input id="prix" type="number" name="prix" value="<?=$prix;  ?>" placeholder="Prix" required="">
                <h5>Quantité en stock</h5>
                <input id="qte" type="number" name="qte" value="<?=$qte;  ?>" placeholder="Quantité" required="">
            
            
                <input type="submit" name="valider" value="Validez la modification" class="boutton">
            

        </form>
    </div>
</div>
