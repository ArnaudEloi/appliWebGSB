<?php
require("lib/init.php");
if(isset($_POST['listeMedocs']))
{
	$_SESSION['medocChoisi']=$_POST['listeMedocs'];
}
?>
<html>
<head>
<link type="text/css" rel="stylesheet" href="styles/styles2.css"/>
</head>
<body>
<form name="formMEDOC" method="POST" action="#">
<h1> M&eacutedicaments </h1>Selectionnez un m&eacutedicament : 
<select name="listeMedocs" class="titre">
<?php 
$requette="select * from medicament";
$resultat=mysql_query($requette);
while($maLigne=mysql_fetch_array($resultat))
{
		$Depot=$maLigne['MED_DEPOTLEGAL'];
		$nom=$maLigne['MED_NOMCOMMERCIAL'];
		$famille=$maLigne['FAM_CODE'];
		$compo=$maLigne['MED_COMPOSITION'];
		$effets=$maLigne['MED_EFFETS'];
		$contre=$maLigne['MED_CONTREINDIC'];
		$prix=$maLigne['MED_PRIXECHANTILLON'];
	?><option
		value="<?php echo $Depot?>"  
		<?php
		if(isset($_SESSION['medocChoisi']))
		{
			if($Depot==$_SESSION['medocChoisi'])
			{

				?>
					selected="true"
					<?php
			}
		}
	?>
		><?php echo $nom ?></option>
<?php
}?>
</select>
<input type=submit name="action" />
</form>
</br>
		<?php

	$Depot=$_SESSION['medocChoisi'];
	$requette2="select * from medicament where MED_DEPOTLEGAL='$Depot'";
	$resultat2=mysql_query($requette2);
while($maLigne=mysql_fetch_array($resultat2))
	{
		$Depot=$maLigne['MED_DEPOTLEGAL'];
		$nom=$maLigne['MED_NOMCOMMERCIAL'];
		$famille=$maLigne['FAM_CODE'];
		$compo=$maLigne['MED_COMPOSITION'];
		$effets=$maLigne['MED_EFFETS'];
		$contre=$maLigne['MED_CONTREINDIC'];
		$prix=$maLigne['MED_PRIXECHANTILLON'];
	}
	?>
		<form name="formME" method="post" action="formMedoc.php">
		<input type="hidden" name="refMed" value="<?php echo $nbFois; ?>"/> 

<table>
<tr>
<th>Depot l&eacutegal</th>
<td><?php echo $Depot ?></td>
</tr>

<tr>
<th>Nom</th>
<td><?php echo $nom ?></td>
</tr>

<tr>
<th>Famille</th>
<td><?php echo $famille ?></td>
</tr>

<tr>
<th>Composition</th>
<td><?php echo $compo ?></td>
</tr>

<tr>
<th>Effets</th>
<td><?php echo $effets ?></td>
</tr>

<tr>
<th>Contre-indications</th>
<td><?php echo $contre ?></td>
</tr>

<tr>
<th>Prix de l'&eacutechantillon</th>
<td><?php
if($prix==null)
{
echo "Gratuit";
}
else
{
echo $prix;
}
?>
</td>
</tr>

</table>




</div>
</div>
		</form>
</body>
</html>
