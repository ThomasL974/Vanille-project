<div class="login-page">
  <div class="log">
    <form class="login-form" method="POST" action=index.php?uc=verifAdmin&action=connexion>
      <h4>Connexion administrateur</h4>
      <input type="text" placeholder="login" name="login" required=""/>
      <input type="password" placeholder="mot de passe" name="mdp" required=""/>
      <input type="submit" name="valider" value="Connexion" class="boutton">
      <h4><?=$message?><h4>
    </form>
    
  </div>
</div>