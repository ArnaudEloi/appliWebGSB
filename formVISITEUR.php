<?php
require("lib/init.php");
require("entete.html");
require("sommaire.php");
if (!estVisiteurConnecte())
{
	header("Location: connexion.php");  
}
unset($_SESSION['VisAVoir']);

?>

<html>
<head>
<title>formulaire VISITEUR</title>

</head>
<div id="contenu">
<h2>Bienvenue sur l'intranet GSB</h2>
<iframe frameborder=0 src="FormVis.php" width=100% height=600 />
</div>
</html>
<?php
require("pied.html");
require("fin.php");
?>
