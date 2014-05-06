<?php
  require("lib/init.php");
  $req="select * from medicament order by MED_NOMCOMMERCIAL desc";
  $rep=mysql_query($req);
  
  $nbLigne=mysql_num_rows($rep)-1;
  $noLigne=0;
  if(isset($_POST['refMedoc']) and (isset($_POST["go"])))
  {
	$nbFois=$_POST['refMedoc'];
	$nbFois++;
	if($nbFois==$nbLigne+1)
	{
		$nbFois=0;
	}
	
  }
   else
  {
  $nbFois=0;
  
  }
  if(isset($_POST['refMedoc']) and (isset($_POST["retour"])))
  {
	$nbFois=$_POST['refMedoc'];
	$nbFois--;
	if($nbFois==-1)
	{
		$nbFois=$nbLigne;
	}
	
  }
  
  while($maLigne=mysql_fetch_array($rep))
  {
	
		if($noLigne==$nbLigne-$nbFois)
		{
		
		$Depot=$maLigne['MED_DEPOTLEGAL'];
		$nom=$maLigne['MED_NOMCOMMERCIAL'];
		$famille=$maLigne['FAM_CODE'];
		$compo=$maLigne['MED_COMPOSITION'];
		$effets=$maLigne['MED_EFFETS'];
		$contre=$maLigne['MED_CONTREINDIC'];
		$prix=$maLigne['MED_PRIXECHANTILLON'];
		}
		$noLigne++;
  }
  
  ?>
 <html>
<head>
		<link type="text/css" rel="stylesheet" href="styles/styles2.css"/>

</head>
  <!-- Division principale -->


	<form name="formMEDICAMENT" method="post" action="FormMedoc.php">
		<h1> Pharmacopee </h1>
		<input type="hidden" name="refMedoc" value="<?php echo $nbFois; ?>"/> 
		<label class="titre">DEPOT LEGAL :</label><input type="text" size="10" name="MED_DEPOTLEGAL" class="zone" value="<?php echo $Depot ?>"/></br>
		<label class="titre">NOM COMMERCIAL :</label><input type="text" size="25" name="MED_NOMCOMMERCIAL" class="zone" value="<?php echo $nom ?>"/></br>
		<label class="titre">FAMILLE :</label><input type="text" size="3" name="FAM_CODE" class="zone" value="<?php echo $famille ?>"/></br>
		<label class="titre">COMPOSITION :</br></label><textarea rows="5" cols="50" name="MED_COMPOSITION" class="zone" ><?php echo $compo ?></textarea></br>
		<label class="titre">EFFETS :</br></label><textarea rows="5" cols="50" name="MED_EFFETS" class="zone" ><?php echo $effets ?></textarea></br>
		<label class="titre">CONTRE INDIC. :</br></label><textarea rows="5" cols="50" name="MED_CONTREINDIC" class="zone" ><?php echo $contre ?></textarea></br>
<!--		<label class="titre">PRIX ECHANTILLON :</label><input type="text" size="7" name="MED_PRIXECHANTILLON" class="zone" value="<?php echo $prix ?>"/></br> -->
		<label class="titre">&nbsp;</label><input class="zone" name="retour" type="submit" value="<"></input><input name="go" class="zone" type="submit" value=">"></input>
	</form>

</html>
