<?php

// soubor se zakladnim nastavenim
include  ("model/menu.mod.class.php");

//wrapper
require_once ("model/phpWrapper.mod.class.php");

// trida s wrapprem
$wrapper = new wrapper();
$basic = new basic();



// parametr stranky
$page = @$_REQUEST["page"];


// default je uvod
if ($page == "")
	$page = "uvod";
	
	
	
	
	// volba obsahu dle parametru = volba skriptu, ktery zpracuje stranku
	switch ($page){
		
		
		case "uvod":$filename = $web_pages[0];
					break;
		case "clanky":$filename = $web_pages[1];
					break;
		case "login":$filename = $web_pages[3];
					break;
		case "reg":$filename = $web_pages[4];
					break;
		case "ucty":$filename = $web_pages[5];
					break;
		case "up" :$filename = $web_pages[6];
					break;
		case "stav":$filename = $web_pages[7];
					break;
		case "rec" :$filename = $web_pages[8];
					break;
		case "manCl":$filename = $web_pages[9];
					break;
					
					
				//stranka se 404 chybou
			default:$filename = $web_pages[2];
					break;		
	}
	
	//wrapper
	$obsah = $wrapper->phpWrapperFromFile($filename);
				
		
		
				
	// menu
	$prava = @$_SESSION["user"]["idPrava"];
	
	$meny = $basic->menu2($page,$prava);
	
	
	//nadpis
	$nadpis = $basic->nadpis($page);
				
				
				// nacist twig - kopie z dokumentace
				require_once 'twig-master/lib/Twig/Autoloader.php';
				Twig_Autoloader::register();
				
				// cesta k adresari se sablonama - od index.php
				$loader = new Twig_Loader_Filesystem('sablony');
				$twig = new Twig_Environment($loader); // takhle je to bez cache
				
				
				// nacist danou sablonu z adresare
				$template = $twig->loadTemplate('sablona1.html');
				
				
				
				// render vrati data pro vypis nebo display je vypise
				// v poli jsou data pro vlozeni do sablony
				$template_params = array();
				$template_params["menicko"] = $meny;
				$template_params["obsah"] = $obsah;
				$template_params["nadpis1"] = $nadpis;
				echo $template->render($template_params);
	
	//zniceni vytvorenych objektu
	unset($basic);
	unset($wrapper);
				
	?>