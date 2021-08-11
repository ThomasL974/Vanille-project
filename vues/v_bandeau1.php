<?php
if ($_SESSION['ok'] != 'oui') 
{
	include("vues/v_accueil.php");
}
?>
<div id="bandeau">
<!-- Images En-t�te -->
<img src="images/Vanille.png"	alt="Boutique en ligne Vanille" title="Boutique en ligne Vanille" width="100%" height="300" />
</div>
<!--  Menu haut-->
<h1>Administrateur</h1>
<ul id="menu">
	<li><a href="docVanille/html/class_pdo_vanille.html">Doc Vanille</a></li>
	<li><a href="index.php?uc=verifAdmin&action=voirCategories"> Voir le catalogue </a></li>
	<li><a href="index.php?uc=verifAdmin&action=deconnexion"> Deconnexion </a></li>
		
</ul>
