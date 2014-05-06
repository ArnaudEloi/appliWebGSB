<?php
  require("lib/init.php");
  require("entete.html");
  require("sommaire.php");
  if (!estVisiteurConnecte())//Si visiteur non connecté
  {
        header("Location: connexion.php");  
  }
  unset($_SESSION['VisAVoir']);
 unset($_SESSION['sector']);
?>
  <!-- Division principale -->
  <div id="contenu">
      <h2>Bienvenue sur l'intranet GSB</h2>
  </div>
<?php
  require("pied.html");
  require("fin.php");
?>
