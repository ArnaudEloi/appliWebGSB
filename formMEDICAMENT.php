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
<html>
<head>
<title>formulaire MEDICAMENT</title>

</head>
<div id="contenu"> 
<h2>Bienvenue sur l'intranet GSB</h2>
<iframe src="FormMedoc.php" frameborder=0 width=100% height=600 />
</div>
</html>

<?php
require("pied.html");
require("fin.php");
?>
