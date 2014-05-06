<?php
require("lib/init.php");
if(isset($_POST['listeVisiteurs']))
{
	$_SESSION['visiteurChoisi']=$_POST['listeVisiteurs'];
}
?>
<html>
<head>
<link type="text/css" rel="stylesheet" href="styles/styles2.css"/>
</head>
<body>
<form name="formVISITEUR" method="POST" action="#">
<h1> Visiteurs </h1>Selectionnez un visiteur : 
<select name="listeVisiteurs" class="titre">
<?php 
$requette="select * from visiteur";
$resultat=mysql_query($requette);
while($ligne=mysql_fetch_array($resultat))
{
	$nom=$ligne['VIS_NOM'];
	$prenom=$ligne['VIS_PRENOM'];
	$matric=$ligne['VIS_MATRICULE'];
	?><option
		value="<?php echo $matric?>"  
		<?php
		if(isset($_SESSION['visiteurChoisi']))
		{
			if($matric==$_SESSION['visiteurChoisi'])
			{

				?>
					selected="true"
					<?php
			}
		}
	?>
		><?php echo $nom." ".$prenom ?></option>
<?php
}?>
</select>
<input type=submit name="action" />
</form>
</br>
		<?php

	$matric=$_SESSION['visiteurChoisi'];
	$requette2="select * from visiteur where VIS_MATRICULE='$matric'";
	$resultat2=mysql_query($requette2);
while($maLigne=mysql_fetch_array($resultat2))
	{
			$nom=$maLigne['VIS_NOM'];
			$prenom=$maLigne['VIS_PRENOM'];
			$adresse=$maLigne['VIS_ADRESSE'];
			$cp=$maLigne['VIS_CP'];
			$ville=$maLigne['VIS_VILLE'];
			$sec=$maLigne['SEC_CODE'];
	}
	?>
		<form name="formVI" method="post" action="formVIS.php">
		<input type="hidden" name="refVis" value="<?php echo $nbFois; ?>"/> 



<table>
<tr>
<th>Nom</th>
<td><?php echo $nom ?></td>
</tr>

<tr>
<th>Pr&eacutenom</th>
<td><?php echo $prenom ?></td>
</tr>

<tr>
<th>Adresse</th>
<td><?php echo $adresse ?></td>
</tr>

<tr>
<th>Code postal</th>
<td><?php echo $cp ?></td>
</tr>

<tr>
<th>Ville</th>
<td><?php echo $ville ?></td>
</tr>

<tr>
<th>Secteur</th>
<td><?php echo $sec ?></td>
</tr>
</table>


</div>
</div>
		</form>
</body>
</html>
