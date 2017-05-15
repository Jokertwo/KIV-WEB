<?php


class select{

/**
 * vrati select box
 * @param array $prava pole se vsemi pravy
 * @return string vrati vytvoreny select box ulozeny ve stringu
 */
function prava($rule,$select){


	$vyber ='<select name="pravo" class="form-control">';

	foreach($rule as $p){
		if($select != null && $select == $p["idPrava"]){
		$vyber .= "<option value='".$p['idPrava']."'select>$p[Nazev]</option>";
		}
		else {
			$vyber .= "<option value ='".$p['idPrava']."'>$p[Nazev]</option>";
		}
	}
		
	$vyber .= "</select>";
	return $vyber;
}
}



?>