<?php
if ($_SESSION['ok'] != 'oui') 
{
	include("vues/v_accueil.php");
}
?>
<div class="login-page">
    <div class="log">
        <form method="POST" action="index.php?uc=verifAdmin&action=ajoutProduit" class="login-form">
    
        
            <h4>Ajout d'un produit<h4>
            <h5>Description du produit</h5>
            <input id="description" type="text" name="description" placeholder="ex : Bonbons caramel 4 kg" required="">
            
            
            <h5>Prix du produit</h5>
            <input id="prix" type="number" name="prix" required="" placeholder="ex : 20"required="">
            
            <h5>Quantité en stock</h5>
            <input id="prix" type="number" name="qte" required="" placeholder="ex : 2"required="">


            <h5>Catégorie du produit</h5>
            <select name="categorie" required="" style="margin-bottom:10px;">
                <option value="">Choisissez votre categorie</option>
                <option value="bonbons">bonbons</option>
                <option value="caramels">caramels</option>
                <option value="chocolats">chocolats</option>
            </select>
            
            
            <h5>Image du produit</h5>
            <input id="img" type="numeric" name="img" required="" placeholder="ex : caramel7" required="">

            
            <input type="submit" name="valider" value="Validez la modification" class="boutton">
           
        </form>
    </div>
</div>