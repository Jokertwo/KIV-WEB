<?php
include_once ("/model/database.mod.class.php");
include_once 'view/sec.class.php';
include_once 'view/recenze.class.php';


//databaze
$con = new databaze();

//nepoveleny pristup
$sec = new secure();

//vypsani clanku pridelenych recenentovi
$rec = new recenzent();




/////////zpracovani odeslaneho ohodnoceni///////////
$action = @$_REQUEST['action'];
if(isset($action)){
	
	$idClanku = $_REQUEST['select'];
	$ohodnoceni = @$_REQUEST['ohodnoceni'];
	
	//jeslti nahodou nebylo stisknuto tlacitko jine nez
	//kde bylo vybrano hodnoceni
	if(isset($ohodnoceni)){
		
		//vlozeni hodnoceni do databaze
		if($con->updateHodnoceni($_SESSION['user']['idUzivatel'], $idClanku, $ohodnoceni)){
		}	
	}
}
global $pravaId;
//neprihlaseny uzivatel/////
	if(!isset($_SESSION["user"])){
		echo $sec->notLog();
	}
		////neni recenzent/////
		else if($_SESSION['user']['idPrava'] != $pravaId['recenzent']){
			echo $sec->notAdmin();
		}
			/////samotny vypis clanku pro recenzety/////////////
			else{
			 echo $rec->vypis($con->clankyRecenzent($_SESSION["user"]["idUzivatel"]));
			}
//odpojeni od databaze
$con->Disconnect();

//zabiti vytvorenych objektu
unset($con);
unset($sec);
?>