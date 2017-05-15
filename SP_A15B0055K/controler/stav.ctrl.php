<?php
include_once 'model/database.mod.class.php';
include_once 'view/stav.class.php';
include_once 'view/sec.class.php';


//pomocna promena pro oznameni uspesneho
//smazani clanku
$delete = -1;


//idprava pro ucet autor
global $pravaId;


//databaze
$con = new databaze();

// view s tabulkou clanku
$stav = new stavClanku();

//chybove hlasky
$sec = new secure();


////////zpracovani odeslanych formularu///////////
$action = @$_REQUEST["action"];
	
	if($action == "Delete"){
		$idClanku = $_REQUEST["idClanku"];
		$name = $_REQUEST["jmenoS"];
		
				
		//smazani z databaze
		if($con->smazClanek($idClanku)){
				$delete = 1;
				
		}
		
	}
	
	///////////upraveni zaznamu v databazi//////////
	//tlacitko update
	if($action == 'Update'){
		$nazev = $_REQUEST["nazev"];
		$popis = $_REQUEST["popis"];
		$idClanku = $_REQUEST["idClanku"];
		
		//provedeni zmen v databazi
		if($con->updateClanky($idClanku, $nazev, $popis)){
			
			//informovani o uspechu
			echo $stav->successEdit();
		}
			
		
	}
	


	
	
	
	////////update prispevku//////////
	//tlacitko edit
	if($action == 'Edit'){
		$idClanku = $_REQUEST["idClanku"];
		
		//ziska z databaze nazev a popis editovaneho clanku
		$clanek = $con->clankyEditAutor($_SESSION['user']['idUzivatel'], $idClanku);
		
		//zobrazi predvyplneny input text a textarea
		echo $stav->editUp($clanek[0]['Popis'], $clanek[0]['Nazev'],$idClanku);
		
			}
	/////////// konec zpracovani formularu////////////
	
	
	
	
	//////////vypis vse clanku autora///////////////		
	else{
							//kontrola jestli je uzivatel prihlasen
							if(isset($_SESSION["user"])){
								
								//uzivatel je prihlasen a na statut autora
								if($_SESSION['user']['idPrava'] == $pravaId['autor']){
								
										//oznameni o pripadne uspesnem smazani clanku
										if($delete > 0){
												$stav->successDelete();
											}
											//nacte z databaze vsechny clanky autora
											$clanky = $con->clankyAutora($_SESSION["user"]["idUzivatel"]);
										
												//zobrazi tabulku se vsemi clanky autora
													if ($clanky != null){
														echo $stav->autor($clanky);
													}
													else{
														//autor nema zatim zadne clanky
														echo $sec->zadnyClanek();
													}
									
											}
										else{
											//uzivatel neni autor
											echo $sec->notAdmin();
										}
									}
							else{
								//uzivatel neni prihlasen
								echo $sec->notLog();
							}
	
	}
	//odpojeni od databaze
$con->Disconnect();

	//zabiti vztvorenzch objektu
unset($con);
unset($sec);
unset($stav);

?>