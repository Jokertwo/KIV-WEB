<?php

include_once 'model/database.mod.class.php';
include_once 'view/clanky.class.php';

//pripojeni k databazi
$con = new databaze();

$clanek = new clanky();

$vse = $con->zverejnenePrispevky();

if($vse != null){
	
	foreach ($vse as $i){
		$clanek->clanek($i["Nazev"], $i["Datum"], $i["Popis"],$i["idPrispevky"],$i["Jmeno"]);
	}
		
}

//odpojeni od databaze
$con->Disconnect();

//zabiti vytvorenych objektu
unset($clanek);
unset($con);
?>