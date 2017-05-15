<?php

include_once ("/model/database.mod.class.php");
include_once 'view/zverejnovani.class.php';
include_once 'view/sec.class.php';

//globalni promena s idStavy
//je to associativni pole
global $hodnoceni,$pocetRecenzetu,$pravaId;

//pripojeni k databazi
$con = new databaze();

//zverejneni
$pop = new publishing();

//neopravneny pristup
$sec = new secure();

//////zpracovani formularu////////////
$action = @$_REQUEST["action"];

//zamitnou clanek
if($action == 'Zamítnout'){
	$dismiss = $_REQUEST['dismiss'];
	$con->updatePublic($dismiss, $hodnoceni['odmitnuto']);
}
//zverejnit clanek
if($action == 'Schválit'){
	$success = $_REQUEST['success'];
	$con->updatePublic($success, $hodnoceni['schvaleno']);
	
}
//pridelit clanek recenzentum
if($action == 'Přiřaď'){
	//idClanku
	$idClanku = $_REQUEST['select'];
	//id vybranych autoru
	//zavinac je tu pro potlaceni chyby kdyz by n2kdo nevybral nic a stiskl tlacitko
	$vyber = @$_REQUEST['vyber'];
	
	//TEST
	//echo count($vyber);
	
	//spocitani recenzentu
	$pocetRec = count($vyber);
	//je nutne aby byly tri
	// lze nastavit v globalni promene
	
	if($pocetRec == $pocetRecenzetu){
		//prirazeni recenzentum
		if($con->clankyRecenzentum($idClanku, $vyber))
			//zmena stavu clanku
			$con->updatePublic($idClanku, $hodnoceni["hodnoti se"]);
	}
	else{
		echo $pop->nedostatekAutoru();
	}
	
}
//akce po stisknuti tlacitka hodnoceni
if($action == 'Hodnocení'){
	//idClanku
	$idClanku = $_REQUEST['ratings'];
	//ulozi do promene vsechny informace o hodnoceni konkretniho clanku
	$hodnoceniClanku=$con->hodnoceniPrispevkuAdmin($idClanku);
	///spocteni prvku v poli
	///poklud je vyssi nez 0 nekdo uz clanek hodnotil
	$pocet = count($hodnoceniClanku);
}
/////////konec zpracovani formularu///////

	//////neprihlaseny uzivatel////////
	if(!isset($_SESSION['user'])){
				echo $sec->notLog();
			}
				/////////jiny uzivatel nez recezent/////////////
					else if($_SESSION['user']['idPrava'] != $pravaId['admin']){
							echo $sec->notAdmin();
						}
						/////// vse v poradku//////////////
							else{
						
							/////zobrazi hodnoceni konkretniho prispevku////////////////
							//zavinac je tu pro potlaceni vypisu chyby
								if(@$pocet > 0){
									echo $pop->ratings($hodnoceniClanku, $idClanku);
								}
									else{
								/////////////tabulka se vsemi prispevky////////////////
								echo $pop->form($con->clankyAdmin(),$con->recenzenti());
									}
							}

//odpojeni od databaze
$con->Disconnect();

//zabiti vytvorenych objektu
unset($sec);
unset($pop);
unset($con);
?>