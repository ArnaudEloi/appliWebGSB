<?php
require("lib/init.php");
require("entete.html");
require("sommaire.php");
unset($_SESSION['sector']);
if (!estVisiteurConnecte())
{
	header("Location: connexion.php");  
}
if((isset($_POST['VIS_NUM']))and(isset( $_POST['action1'])))
{
	$_SESSION['VisAVoir']=$_POST['VIS_NUM'];
}
?>
<html><head>
<title>formulaire RAPPORT_VISITE</title>
</head>
<body>
<div id="contenu">
<h2>Bienvenue sur l'intranet GSB</h2>
<form name="formCONSULT_VISITE1" method="post" action="#">
Rapports de <?php
$matrix=$_SESSION['Matricul'];
$requete = "SELECT * FROM visiteur WHERE VIS_MATRICULE='$matrix'";
$resultat=mysql_query($requete);
while($maLigne=mysql_fetch_array($resultat))
{
	$nom=$maLigne['VIS_NOM'];
	$prenom=$maLigne['VIS_PRENOM'];
}
echo $nom." ".$prenom.", ";
?>
</select>
<form name="formCONSULT_VISITE2" method="post" action="#">
s&eacutelectionnez une date de visite :
<select  name="DATE_NUM" >
<?php
//liste des date du praticien enregistré
$req="select RAP_DATE from rapport_visite where VIS_MATRICULE='$matrix';";
$res=mysql_query($req);
while($ligne=mysql_fetch_array($res))
{
	$date=$ligne['RAP_DATE'];

	?>
		<option 
		<?php
		if(isset($_POST['DATE_NUM']))
		{

			if($date==$_POST['DATE_NUM'])
			{
				?>
					selected="true"
					<?php
			}
		}
	?>

		><?php echo $date?></option>

		<?php
}
?>

</select>
<input type=submit name="action2">
<?php
if(isset($_POST['action2']))
{
	$date = $_POST['DATE_NUM'];
	$jour=substr($date,8);
	$mois=substr($date,5,-3);
	$annee=substr($date,0,-6);
	$datePropre=$jour.'/'.$mois.'/'.$annee;
	?>
		<p>Rapport de la visite r&eacutealis&eacutee le  <?php echo $datePropre?></p>
<link type="text/css" rel="stylesheet" href="styles/styles2.css"/>

		<table>
		<?php
		$mat=$_SESSION['Matricul'];
	$date=$_POST['DATE_NUM'];
	$requette="select * from rapport_visite where VIS_MATRICULE='$mat' and RAP_DATE='$date';";

	$resultat=mysql_query($requette);
	while($ligne=mysql_fetch_array($resultat))
	{
		$num=$ligne['RAP_CODE'];
		$pra=$ligne['PRA_CODE'];
		$remplace=$ligne['remplace'];
		$coeff=$ligne['COEFF_CONFIANCE'];
		$motif=$ligne['RAP_MOTIF'];
		$bilan=$ligne['RAP_BILAN'];
	}
	$requetteA="select * from praticien where PRA_CODE='$pra';";
	$resultatA=mysql_query($requetteA);
	while($ligne=mysql_fetch_array($resultatA))
	{
		$pr=$ligne['PRA_NOM'];
		$aticien=$ligne['PRA_PRENOM'];	
	}
	?>
		<tr>
		<th>Num&eacutero</th>
		<td><?php echo $num ?></td>
		</tr>
		<tr>
		<th>Praticien</th>
		<td><?php echo $pr." ".$aticien?></td>
		</tr>
		<tr>
		<th>Remplac&eacute</th>
		<td><?php echo $remplace ?></td>
		</tr>
		<tr>
		<th>Coefficiant</th>
		<td><?php echo $coeff?></td>
		</tr>
		<tr>
		<th>Motif</th>
		<td><?php echo $motif?></td>
		</tr>
		<tr>
		<th>Bilan</th>
		<td><?php echo $bilan?></td>
		</tr>
		<table>
		<p>Produits pr&eacutesent&eacutes lors de la visite : </p>

		<?php
		$mat2=$_SESSION['Matricul'];
	$date2=$_POST['DATE_NUM'];
	$requette2="select * from presentation where RAP_CODE='$num';";
$i=0;
	$resultat2=mysql_query($requette2);
	while($ligne2=mysql_fetch_array($resultat2))
	{
	$i++;
		$codeMed=$ligne2['MED_DEPOTLEGAL'];
		$requette3="select * from medicament where MED_DEPOTLEGAL='$codeMed';";

		$resultat3=mysql_query($requette3);
		while($ligne3=mysql_fetch_array($resultat3))
		{
			$mnom=$ligne3['MED_NOMCOMMERCIAL'];
			$mcompo=$ligne3['MED_COMPOSITION'];
			$meffets=$ligne3['MED_EFFETS'];
			$mcontrind=$ligne3['MED_CONTREINDIC'];
		}
		?>
		<tr>
		<tr><th class="num">Produit <?echo $i?></th></tr>
		<th>Nom</th>
			<td><?php echo $mnom?></td>
			</tr>
			<tr>
		<th>Composition</th>
			<td><?php echo $mcompo?></td>
			</tr>
			<tr>
		<th>Effets</th>
			<td><?php echo $meffets?></td>
			</tr>
			<tr>
		<th>Contre indications</th>
			<td><?php echo $mcontrind?></td>	
			</tr>
			<?php
	}
	?>
		</table>
		</br>
		</br>
		<p>Echantillons offerts : </p>
		<?
		$requete = "SELECT * FROM offrir WHERE RAP_CODE='$num'";
	$resultat=mysql_query($requete);
	while($maLigne=mysql_fetch_array($resultat))
	{
		$qte=$maLigne['OFF_QTE'];
	}
	if($qte!=0){
		?>
			<table>

			<?php
			$date4=$_POST['DATE_NUM'];
		$requette4="select * from offrir where RAP_CODE='$num';";

		$resultat4=mysql_query($requette4);
		while($ligne4=mysql_fetch_array($resultat4))
		{
			$codeMed=$ligne4['MED_DEPOTLEGAL'];
			$qte=$ligne4['OFF_QTE'];
			$requette5="select * from medicament where MED_DEPOTLEGAL='$codeMed';";

			$resultat5=mysql_query($requette5);
			while($ligne5=mysql_fetch_array($resultat5))
			{
				$mnom=$ligne5['MED_NOMCOMMERCIAL'];
				$mcompo=$ligne5['MED_COMPOSITION'];
				$meffets=$ligne5['MED_EFFETS'];
				$mcontrind=$ligne5['MED_CONTREINDIC'];
			}

			?>
			
				<tr>
			<th>Nom</th>
				<td><?php echo $mnom?></td>
				</tr>
				<tr>
			<th>Quantite</th>
				<td><?php echo $qte?></td>
				</tr>
				<tr>
			<th>Composition</th>
				<td><?php echo $mcompo?></td>
				</tr>
				<tr>
			<th>Effets</th>
				<td><?php echo $meffets?></td>
				</tr>
				<tr>
			<th>Contre indications</th>
				<td><?php echo $mcontrind?></td>
				</tr>
				<?php
		}
	}
	else echo "aucun &eacutechantillons offerts !";

	?>
		</tbody>
		</table>

		<?php
}
?>
</form>
</div>
</body>
</html>
<?php
require("pied.html");
require("fin.php");
?>
