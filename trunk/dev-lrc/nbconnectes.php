<?php 
//---------------------------------------------------------------------------------------------------
//			

//1) MISE A JOUR DU COMPTEUR ET AFFICHAGE DU NOMBRE DE CONNECTES
//Insérez le code Javascript suivant dans toutes votre page (en adaptant l'adresse du script) :	
//<SCRIPT language="Javascript" src="http://www.votresite.com/nbconnectes.php3?action=show"></SCRIPT>
//
//2) MISE A JOUR DU COMPTEUR SANS AFFICHER LE NOMBRE DE CONNECTES
//Insérez le code Javascript suivant dans votre page (en adaptant l'adresse du script) :	
//<SCRIPT language="Javascript" src="http://www.votresite.com/nbconnectes.php3?action=hide"></SCRIPT>
//
//3) VISUALISATION DE VOTRE RECORD
//Saisissez l'url suivante dans votre naviguateur (en adaptant l'adresse du script) :
//http://www.votresite.com/nbconnectes.php3?action=admin
//Ce qui affichera par exemple :
//"Votre record est : 12 visiteurs simultanés le 21/08/2000 à 12h05".
				
//	WebJeff - NbConnectes v1.1
//	
//	Auteur : Jean-François GAZET
//	Site web : http://www.webjeff.org
//	Email : webmaster@webjeff.org	
//
//---------------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------------------
// 	VARIABLES PARAMETRABLES
//---------------------------------------------------------------------------------------------------

// laps de temps en secondes où un visiteur est considéré comme connecté
// Time in seconds while a visitor is considered as connected
$laps=300;

// Nom du repertoire contenant les fichiers de stats (ip.txt et record.txt)
// Name of the data directory
$repstats="data";


//----------------------------------------------------------------------------------------------------
//	FONCTIONS
//----------------------------------------------------------------------------------------------------

// Erreur
function erreur($code)
	{
	global $repstats;
	switch($code)
		{
		case 1;
		echo "document.write(\"Erreur de creation du r&eacute;pertoire <b>$repstats</b><br>Error : Impossible to create directory <b>$repstats</b>\");";
		break;

		case 2;
		echo "document.write(\"Erreur de creation des fichiers TXT dans <b>$repstats</b><br>Error : Impossible to create TXT files into <b>$repstats</b>\");";
		break;
		}
	exit;
	}


//---------------------------------------------------------------------------------------------------
//	PROGRAMME
//---------------------------------------------------------------------------------------------------

//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
//header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//header("Cache-Control: no-cache, must-revalidate");
//header("Pragma: no-cache");

// Temps actuel en secondes
$now=time();

// Creation du repertoire $repstats s'il n'existe pas
if(!is_dir("$repstats")) 
	{
	if(!@mkdir("$repstats",0755)) {erreur(1);}
	}
	
// Mise a jour du fichier du visiteur dans le cas [hide|show]	
if ($action=="show"||$action=="hide")
	{
	// Nom du fichier du visiteur encours
	$fichier="$repstats/$REMOTE_ADDR.txt";
	
	// Mise a jour (date de modification du fichier utilisee) ou creation du fichier du visiteur
	$fp=@fopen("$fichier","w");
	if(!$fp) {erreur(2);}
	fputs($fp,"");
	fclose($fp);		
	
	// Suppresion des fichiers et comptage du nombre de fichiers
	$nb=0;
	$handle=opendir("$repstats");
	while ($tmp = readdir($handle))
		{
		if($tmp!="." && $tmp!=".." && $tmp!="record.txt") 
			{
			if(filemtime("$repstats/$tmp")+$laps<$now) {@unlink("$repstats/$tmp");} 
			else {$nb++;}
			}
		}
	closedir($handle);
	
	// Affichage du nombre de connectes
	if($action=="show") {echo "document.write(\"$nb\");";}
	}

?>