<?php
include_once ("/model/database.mod.class.php");
include_once ("/view/user-manegment.class.php");
include_once ("model/selectBox.mod.class.php");
include_once 'view/sec.class.php';




$con = new databaze();
$man = new manegment();
$sec = new secure();


//zpracovani odeslanych formularu
$action = @$_REQUEST["action"];

//akce zmeny prava
	if($action == "Update"){
		$pravo =  $_REQUEST["pravo"];
		$Uzivatel = $_REQUEST["update"];
		
			
		if($Uzivatel != null && $pravo != null){
			//zavolani metody jez dane zmeny projevi do databaze
			if($con->updateRule($Uzivatel,$pravo)){
				
			}
		}
		
		
	}
	
//akce smazani uzivatele	
	if($action == "Delete"){
		$idUzivatel = $_REQUEST["delete"];
		
		if($idUzivatel == null){
			echo "Chyba zadna hodnota";
		}
		else
		$con->smazUzivatele($idUzivatel);
	}


//pokud neni uzivatel prihlasen objevi se mu informace o tom
if(!isset($_SESSION['user'])){
	echo $sec->notLog();
	
}

//pokud je prihlasen ale neni to administrator
else if($_SESSION['user']['idPrava'] != 1 && $_SESSION['user']['idPrava'] != 4){
	echo $sec->notAdmin();
}

//pokud je prihlasen a je to administrator
else{
	$man->setSelectBoxRule($con->nactiPrava());
	
	echo $man->admin($con->vsechnyInformaceZDatabaze());
}

//odpojeni od databaze
$con->Disconnect();

//zabiti vytvorenych objektu
unset($con);
unset($sec);
unset($man);


?>