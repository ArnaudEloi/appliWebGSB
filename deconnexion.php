<?php  
/** 
 * Script de contrôle et d'affichage du cas d'utilisation "Se déconnecter"
 * @package default
 * @todo  RAS
 */
  require("lib/init.php");
  
  deconnecterVisiteur() ;  
  header("Location:connexion.php");
  
?>