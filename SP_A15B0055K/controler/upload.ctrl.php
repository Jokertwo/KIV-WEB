<?php

include_once 'view/upload.class.php';
include_once 'model/upload.mod.class.php';
include_once 'model/database.mod.class.php';
include_once 'view/sec.class.php';

global $pravaId;
//tlacika pro upload
$up = new UploadView();

//samotny model zajistujici upload
$mod = new UploadModel();

//databaze
$con = new databaze();

//nepoveleny pristup
$sec = new secure();

//zpracovani odeslaneho formulare
$action  = @$_REQUEST["submit"];

//kontrolni promena pomoci ktere
//kontroluji jestli je navstevnik prihlaseny
$prihlasen = @$_SESSION['user'];

//pokud je prihlasen a ma spravna prava
if($prihlasen != null && $_SESSION['user']['idPrava'] == $pravaId["autor"]){

		//zobrazeni tlacika pro nahrani souboru
		if($action == null || $action == "Back"){
		//zobrazi formular pro upload
			$up->formUp();
		}
		
		 else if($action == "Upload Image" && $prihlasen != null){
			global $target_dir;
			
				$file = $_FILES["fileToUpload"];
					
		///////////////ulozeni souboru////////////////////
				
				//nejdrive skontroluji jestli je to pdf
				if($mod->checkPDF($file)){
					
					//pouze pro TESTOVANI
					//print_r($file);
					
					
					//vlozeni zaznamu do databaze a ziskani posledniho ID
					$posledniID =$con->upload($_REQUEST["nazev"], $_REQUEST["popis"], $mod->pripona);
						
					//kontroluji jestli se to povedlo vlozit do databaze
					if($posledniID > 0){
						
						//zjistim jestli se povedlo ulozit soubor
						if($mod->saveUpload($file,$posledniID)){
							
							//informuji o uspesnem uploadu
							$up->successUpload();
						}
						else{
							//vypisi chybu pro se nepovedlo ulozit zaznam na server
							$up->alerts($mod->getChyba());
						}
						
						
					}
					//neuspesny pokus o vlozeni do databaze
					else{
						echo "Nepodařilo se uložit záznam do databaze.";
					}
				
					
					
						
						
						//tlaciko pro navrat na dalsi upload
						$up->nextUpload();
						
					}
					else{
						//pokud soubor nema povolenou koncovku
						$up->alerts($mod->getChyba());
						$up->nextUpload();
					}
		 	}
		
	
}
//pokud uzivatel nema dostatecna opravneni
else{
	echo $sec->notAdmin();
}
	

		//odpojeni od databaze
		$con->Disconnect();

		//zabiti vytvorenych objektu
		unset($con);
		unset($sec);
		unset($mod);
		unset($up);

?>