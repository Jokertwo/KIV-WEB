<?php


include_once ("model/database.mod.class.php");
include_once ("view/login.class.php");

    // na�ten� souboru s funkcemi
	$databaze = new databaze();
	
	$log = new login();
   
	// zpracovani odeslanych formularu
	$action = @$_REQUEST["action"];

	
	//pokud neni true obejevi se
	//chybova hlaska
	$alert = true;
	
	
	//prihlaseni
	if($action == "login"){
	 
		$login = $_REQUEST["login"];
		$pwd = $_REQUEST["heslo"];
		if(!$databaze->prihlaseni($login, $pwd)){
			$alert = false;
		}
			
	}

	
	//odhlaseni
		if($action == "logout"){
			$databaze->odhlaseni();
			$alert = true;
		}
    
   
		if(!isset($_SESSION["user"])){
			$log->log($alert);
		}
		
		
		else{
			$log->User();
			
		}
	
//odpojeni od databaze
$databaze->Disconnect();
	
//zabiti vytvorenych objektu
unset($databaze);
unset($login);
?>