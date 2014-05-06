<?php
  require("lib/init.php");
  require("enteteConnexion.html");
  $error=0;
  if(isset($_POST["action"]))
  {
		$login = lireDonneePost("txtLogin");
		$mdp = lireDonneePost("txtMdp");
		$jour=substr($mdp,0,-8);
		$mois=substr($mdp,3,-5);
		$annee=substr($mdp,6);
		$mdp=$annee.'-'.$mois.'-'.$jour;
		
		$requete = "SELECT * FROM visiteur WHERE VIS_MATRICULE='$login' AND VIS_DATEEMBAUCHE='$mdp'";
		$resultat=mysql_query($requete);
		while($maLigne=mysql_fetch_array($resultat))
		{
			$id=$maLigne['VIS_MATRICULE'];
		}
		if(mysql_num_rows($resultat)>0)
		{
					
						$_SESSION["Matricul"]=$id;
						affecterInfosConnecte($id, $login);
				        header("Location:index.php");

		}
		else
		{
			$error=1;
		}
		
	
  }
?>
<!-- Division pour le contenu principal -->
    <div id="contenuCx">
<center>
<div id="mideul">
      <h2>Identification utilisateur</h2>
<?php
		  if($error==1)
		  {
			echo "Login ou mot de passe incorect !";
			}
?>               
      <form id="frmConnexion" action="#" method="post">
      <div class="corpsFormCx">
        <input type="hidden" name="etape" id="etape" value="validerConnexion" />
      <p>
        <label for="txtLogin" accesskey="n">Login : </label>
        <input type="text" id="txtLogin" name="txtLogin" maxlength="20" size="15" value="" title="Entrez votre login" /> (matricule)
      </p>
      <p>
        <label for="txtMdp" accesskey="m">Date d'embauche : </label>
        <input type="text" id="txtMdp" name="txtMdp"> (jj/mm/aaaa)
      </p>
      </div>
      <div class="piedFormCx">
      <p>
        <input type=submit id="ok" name="action" value="Valider" />
        <input type="reset" id="annuler" value="Effacer" />
      </p> 
      </div>
      </form>
</div>
</center>
    </div>
<?php
  require("pied.html");
  require("fin.php");
?>
