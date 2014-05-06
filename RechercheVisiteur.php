<?
require("lib/init.php");
require("entete.html");
require("sommaire.php");
?>
<html>
<head>
	<title>Visiteurs</title>

<link rel="stylesheet" type="text/css" href="/styles/styles.css" media="all"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
<body>
<div name="gauche" style="float:left;width:18%; background-color:white; height:100%;">
	<h2>Outils</h2>
	<ul><li>Comptes-Rendus</li>
		<ul>
			<li><a href="formRAPPORT_VISITE.htm" >Nouveaux</a></li>
			<li>Consulter</li>
		</ul>
		<li>Consulter</li>
		<ul><li><a href="formMEDICAMENT.htm" >Médicaments</a></li>
			<li><a href="formPRATICIEN.htm" >Praticiens</a></li>

			<li><a href="formVISITEUR.htm" >Autres visiteurs</a></li>
		</ul>
	</ul>
</div>
<div id="contenu">
	<form name="formVISITEUR" method="post" action="recupVISITEUR.php">
		<h1> Visiteurs </h1>
        <div class="corpsForm" style="margin-top:130px; ">
		<select name="lstDept" class="titre"><option value="">Département</option><option value="01">Ain</option></select>
		<select name="lstVisiteur" class="zone"><option value="a131">Villechalane</option></select>
		<label class="titre">NOM :</label><input type="text" size="25" name="VIS_NOM" class="zone" />
		<label class="titre">PRENOM :</label><input type="text" size="50" name="Vis_PRENOM" class="zone" />
		<label class="titre">ADRESSE :</label><input type="text" size="50" name="VIS_ADRESSE" class="zone" />
		<label class="titre">CP :</label><input type="text" size="5" name="VIS_CP" class="zone" />

		<label class="titre">VILLE :</label><input type="text" size="30" name="VIS_VILLE" class="zone" />
		<label class="titre">SECTEUR :</label><input type="text" size="1" name="SEC_CODE" class="zone" />
		<label class="titre">&nbsp;</label><input class="zone"type="button" value="<"></input><input class="zone"type="button" value=">"></input>
	</form>
	</div>
</div>
</body>
</html>
<?php
  require("pied.html");
  require("fin.php");
?>
