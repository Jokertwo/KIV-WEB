<?php



include_once ("/model/database.mod.class.php");
include_once ("/view/user-registration.class.php");


global $pravaId;

// naÄŤtenĂ­ souboru s funkcemi
//pripoji se k databazi
$connection = new databaze();

//nacte do promene pole s pravama
$prava = $connection->nactiPrava();

//model registrace
$reg = new registrace();

//pokud neni login unikatni obejevi se 
//chybova hlaska
$alert = true;

//pokud si hesla neodpovdaji informuje o tom
$spatneHeslo = true;

		$action = @$_REQUEST["potvrzeni"];
			
		if($action == "Registrovat"){
			$heslo2 = $_REQUEST["heslo2"];
			$heslo = $_REQUEST["heslo"];
			//kontrola ze jsou obe zadana hesla stejna
				if($heslo == $heslo2){
					$login = $_REQUEST["login"];
					$jmeno = $_REQUEST["jmeno"];
					$email = $_REQUEST["email"];
					$pravo = $pravaId['autor'];
				
		//kontrola jestli uz neexistuje uzivatel s takovymto loginem
			if($connection->kontrolaLoginu($login)){
			//pridani uzivatele do databaze
			$connection->novyUzivatel($login, $jmeno, $heslo, $email, $pravo);
		
			//prihlaseni prave zaregistrovaneho uzivatele
			$connection->prihlaseni($login, $heslo);
			}
				// login jiz existuje
				else{
					$alert = false;
				}
			}
			//hesla nejsou stejna
			else{
				$spatneHeslo = false;
			}
		}
		
		//kontrola jestli existuje nejak uzivatel
		//v session
		if(!isset($_SESSION["user"])){
			
			
			//vytvori registracni formular	
			$reg->RegForm($alert,$spatneHeslo);
		}
		else{
            //presmerovani na uvodni stranku
			header("Location: http://localhost/workspaceE/SP_A15B0055K/index.php");
		}
		//odpojeni od databaze
		$connection->Disconnect();

		
		//zabiti vytvorenych objektu
		unset($connection);
		unset($reg);
		
?>


