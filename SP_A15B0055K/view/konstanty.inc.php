<?php




// soubor obsahujici zakladni nastaveni
global $db_server, $db_name, $db_user, $db_pass;
global $web_pagesExtension, $web_pages;
global $target_dir,$file_size,$koncovka,$chybove_Hlasky_upload,$pravaId;
global $hodnoceni,$pocetRecenzetu,$maximalniHodnoceni,$edit;


// databaze
$db_server = "localhost";
$db_name = "sp";
$db_user = "root";
$db_pass = "";


// stranky webu (ostatni nebudou dostupne)

$web_pages[0] = "controler/uvod.ctrl.php";
$web_pages[1] = "controler/clanky.ctrl.php";
$web_pages[2] = "view/404.php";
$web_pages[3] = "controler/login.ctrl.php";
$web_pages[4] = "controler/registration.ctrl.php";
$web_pages[5] = "controler/managment.ctrl.php";
$web_pages[6] = "controler/upload.ctrl.php";
$web_pages[7] = "controler/stav.ctrl.php";
$web_pages[8] = "controler/recenze.ctrl.php";
$web_pages[9] = "controler/zverejnovani.ctrl.php";

//cilova slozka pro upload
$target_dir = "file/";

//maximalni velikost nahraneho souboru
$file_size = 500000;

//typ souboru povoleny k nahravani na server
$koncovka[0] = "pdf";


//chybove hlasky ktere se vypisou pri uploadu
$chybove_Hlasky_upload = array(
				"ok" => "Upload proběhl v pořádku",
				"pdf"=> "Soubor neni pdf. Nahrávat lze pouze soubory v pdf.",
				"exist"=> "Nahrávaný soubor už existuje",
				"null" => "Nepredany argument",
				"size" => "Soubor je příliš veliký"

);

//prava pole
$pravaId = array(
		"admin" => 1,
		"recenzent" => 2,
		"autor" => 3,
		"boss" => 4
		);

//stav
$hodnoceni = array(
		"schvaleno" => 1,
		"odmitnuto" => 2,
		"hodnoti se"=> 3,
		"zpracovava"=> 4
);

//maximalni pocet recenzentu
$pocetRecenzetu = 3;

//maximalni rozsah hodnoceni
$maximalniHodnoceni = 5;

//hotnota zapsana ve sloupecku Smazano v tabulce Prispevky
//"smazani" prispevku
//prispevek se nesmaze jen se nebude uz zobrazovat
$edit = array(
	"smazano" => 1,
	"default" => 0,
);
?>