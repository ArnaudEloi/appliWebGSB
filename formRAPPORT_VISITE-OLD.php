<?php
require("lib/init.php");
require("entete.html");
require("sommaire.php");
$visiteur=$_SESSION["Matricul"];

if (!estVisiteurConnecte())
{
	header("Location: connexion.php");  
}

if(isset($_POST['action']))
{
	$visiteur=$_SESSION["Matricul"];
	$praticienName=$_POST['NAME'];
	$date=$_POST['DATE'];
	$coeff=$_POST['COEFF'];
	$motif=$_POST['MOTIF']; if($motif=="autre"){$motif=$_POST["AutreMotif"];}
	$bilan=$_POST['BILAN'];
	$produit1=$_POST['produit1'];
	$produit2=$_POST['produit2'];

	$nbEch=0;

	$remplace="Non";
	if(isset($_POST['remplace']))
	{
		$remplace="Oui";
	}
	$nbEcha=1;
	if(isset($_POST['PasEch']))
	{
		$nbEcha=0;
	}
	for($noProd=1;$noProd<11;$noProd++)
	{
		if(isset($_POST['PRA_ECH'.$noProd]))
		{
			$echantillon[$noProd]=$_POST['PRA_ECH'.$noProd];
			$qte[$noProd]=$_POST['PRA_QTE'.$noProd];
			$nbEch++;
		}
	}
	$req1="insert into rapport_visite values('$visiteur','null','$praticienName','$date','$bilan','$motif','$coeff','$remplace',null,null)";
	$res1=mysql_query($req1);

	$reqAnnexe='select * from rapport_visite';
	$resAnnexe=mysql_query($reqAnnexe);
	while($maligne=mysql_fetch_array($resAnnexe))
	{
		$rapcode=$maligne['RAP_CODE'];
	}
	$req2="insert into presentation values('null','','$visiteur','$rapcode','$produit1');";
	$req3="insert into presentation values('null','','$visiteur','$rapcode','$produit2');";
	$res2=mysql_query($req2);
	$res3=mysql_query($req3);
	if($nbEcha==1)
	{
		for($noProd=1;$noProd<$nbEch+1;$noProd++)
		{
			$req4="insert into offrir values('$visiteur','$rapcode','$echantillon[$noProd]','$qte[$noProd]');";
			$res4=mysql_query($req4);
		}
	}
}
?>
<!-- Division principale -->
<html><head>
<title>formulaire RAPPORT_VISITE</title>

<script language="javascript">
function selectionne(pValeur, pSelection, pObjet) {
	if (pSelection==pValeur) 
	{ formRAPPORT_VISITE.elements[pObjet].disabled=false; }
	else { formRAPPORT_VISITE.elements[pObjet].disabled=true; }
}
</script>
<script language="javascript">
function ajoutLigne( pNumero){//ajoute une ligne de produits/qté à la div "lignes"     
	//masque le bouton en cours
	document.getElementById("but"+pNumero).setAttribute("hidden","true");	
	pNumero++;			//incrémente le numéro de ligne
	var laDiv=document.getElementById("lignes");	//récupère l'objet DOM qui contient les données
	var titre = document.createElement("label") ;	//crée un label
	laDiv.appendChild(titre) ;						//l'ajoute à la DIV
	titre.setAttribute("class","titre") ;			//définit les propriétés
	titre.innerHTML= "   Produit : ";
	var liste = document.createElement("select");	//ajoute une liste pour proposer les produits
	laDiv.appendChild(liste) ;
	liste.setAttribute("name","PRA_ECH"+pNumero) ;
	liste.setAttribute("class","zone");
	//remplit la liste avec les valeurs de la première liste construite en PHP à partir de la base
	liste.innerHTML=formRAPPORT_VISITE.elements["PRA_ECH1"].innerHTML;
	var qte = document.createElement("input");
	laDiv.appendChild(qte);
	qte.setAttribute("name","PRA_QTE"+pNumero);
	qte.setAttribute("size","2"); 
	qte.setAttribute("class","zone");
	qte.setAttribute("type","text");
	var bouton = document.createElement("input");
	laDiv.appendChild(bouton);

	//ajoute une gestion évenementielle en faisant évoluer le numéro de la ligne
	bouton.setAttribute("onClick","ajoutLigne("+ pNumero +");");
	bouton.setAttribute("type","button");
	bouton.setAttribute("value","+");
	bouton.setAttribute("class","zone");	
	bouton.setAttribute("id","but"+ pNumero);				
}
</script>
</head>
<div id="contenu">
<h2>Bienvenue sur l'intranet GSB</h2>
<form name="formRAPPORT_VISITE" method="POST" action="#">
<h1> Rapport de visite </h1>

<form name="formAffiche" method="POST" action="">
<label class="titre">PRATICIEN :</label><select  name="NAME" class="zone" >
<?php
$req="select * from praticien order by PRA_NOM";
$res=mysql_query($req);
while($ligne=mysql_fetch_array($res))
{
	$nom=$ligne['PRA_NOM'];
	$prenom=$ligne['PRA_PRENOM'];
	$code=$ligne['PRA_CODE'];


	if(isset($_POST['afficheTout']))
	{
$code=$_POST['NAME'];
$req="select * from praticien where PRA_CODE=$code";
$res=mysql_query($req);
while($ligne=mysql_fetch_array($res))
{
	$coeffOut=$ligne['PRA_COEFNOTORIETE'];
	$nom=$ligne['PRA_NOM'];
	$prenom=$ligne['PRA_PRENOM'];
	$code=$ligne['PRA_CODE'];
}
	}
			?>
		<option value="<?php echo $code ?>"><?php echo $nom." ".$prenom ?></option>
		<?php

}
?>
<input type="submit" value="selectionn&eacute" name="afficheTout"/>
</form>
</select>
REMPLAC&Eacute : <input type="checkbox" name="remplace" value="remplacent" class="zone" onClick="selectionne('remplacent',this.value);"/></br>
<label class="titre">DATE :</label><input type="date" size="19" name="DATE" class="zone" /></br>

<?
// l'affichage de tout
	if(isset($_POST['afficheTout']))
	{
$code=$_POST['NAME'];
$req="select * from praticien where PRA_CODE=$code";
$res=mysql_query($req);
while($ligne=mysql_fetch_array($res))
{
	$coeffOut=$ligne['PRA_COEFNOTORIETE'];}
?>

<label class="titre">COEFFICIENT :</label><input disabled="disabled" type="text" size="6" name="COEFF" class="zone" value='<?echo $coeffOut?>'/>
<?
}
?>

</br>
<label class="titre">MOTIF :</label><select  name="MOTIF" class="zone" onClick="selectionne('autre',this.value,'AutreMotif');">
<option>P&eacuteriodicit&eacute</option>
<option >Actualisation</option>
<option >Relance</option>
<option >Sollicitation praticien</option>
<option value="autre">Autre</option>
</select><input type="text" name="AutreMotif" class="zone" disabled="disabled" /></br>
<label class="titre">BILAN :</label></br><textarea rows="5" cols="50" name="BILAN" class="zone" ></textarea>
<label class="titre" ><h3> El&eacutements pr&eacutesent&eacutes </h3></label>
<label class="titre" >Produit pr&eacutesent&eacute 1 : </label><select name="produit1" class="zone">
<?php
$req="select * from medicament order by MED_NOMCOMMERCIAL;";
$res=mysql_query($req);
while($ligne=mysql_fetch_array($res))
{
	$nom1=$ligne['MED_NOMCOMMERCIAL'];
	$code1=$ligne['MED_DEPOTLEGAL'];
	?>
		<option value="<?php echo $code1 ?>"><?php echo $nom1 ?></option>
		<?php
}
?>
</select>
<label class="titre" >Produit pr&eacutesent&eacute 2 : </label><select name="produit2" class="zone">
<?php
$req="select * from medicament order by MED_NOMCOMMERCIAL;";
$res=mysql_query($req);
while($ligne=mysql_fetch_array($res))
{
	$nom2=$ligne['MED_NOMCOMMERCIAL'];
	$code2=$ligne['MED_DEPOTLEGAL'];
	?>
		<option value="<?php echo $code2 ?>"><?php echo $nom2 ?></option>
		<?php
}
?>
</select>
<label class="titre"><h3>Echantillons</h3></label>
<div class="titre" id="lignes">
</br><label class="titre" >Produit : </label>
<select name="PRA_ECH1" class="zone">
<?php
$req="select * from medicament order by MED_NOMCOMMERCIAL;";
$res=mysql_query($req);
while($ligne=mysql_fetch_array($res))
{
	$nom3=$ligne['MED_NOMCOMMERCIAL'];
	$code3=$ligne['MED_DEPOTLEGAL'];
	?>
		<option value="<?php echo $code3 ?>"><?php echo $nom3 ?></option>
		<?php
}
?>
</select>Qte offerte : <input type="text" name="PRA_QTE1" size="2" class="zone"/>
<input type="button" id="but1" value="+" onclick="ajoutLigne(1);" class="zone" />			
</div>		
<label class="titre"></label><div class="zone"><input type="reset" value="annuler"></input><input type="submit" name="action"></input>
</form>
</div>
<?php
require("pied.html");
require("fin.php");
?>
