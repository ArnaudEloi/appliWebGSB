<div id="menuGauche">
<div id="infosUtil">
<?php

if(estVisiteurConnecte())
{
	$idUser = obtenirIdUserConnecte() ;
	$lgUser = obtenirDetailVisiteur($idConnexion, $idUser);
	$nom = $lgUser['nom'];
	$prenom = $lgUser['prenom'];
	$type = $lgUser['type'];
	?>
		<h2>
		<?php
		echo $nom . " " . $prenom ;
	?>
		</h2>       
		<?php
?>  
</div>


		<div name="gauche">
		<h2>Outils</h2>
		<ul><li>Comptes-Rendus</li>
		<ul>
		<li><a href="formRAPPORT_VISITE.php" >Nouveaux</a></li>
		<li><a href="formCONSULT_VISITE.php" >Consulter</a></li>
		</ul>
		<li>Consulter</li>
		<ul><li><a href="formMEDICAMENT.php" >Médicaments</a></li>
		<li><a href="formPRATICIEN.php" >Praticiens</a></li>
		<li><a href="formVISITEUR.php" >Autres visiteurs</a></li>
		</ul>

		</ul>
		<ul>
		<li><a href="deconnexion.php">Se déconnecter</a></li>
		</ul>
		</div>
		<?php
}?>
</div>

