<?php  
/** 
 * Script de contr�le et d'affichage du cas d'utilisation "Se d�connecter"
 * @package default
 * @todo  RAS
 */
  require("lib/init.php");
  
  deconnecterVisiteur() ;  
  header("Location:connexion.php");
  
?>