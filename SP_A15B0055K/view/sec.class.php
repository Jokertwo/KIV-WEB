<?php

class secure{
/**
 * vypise hlasku o tom ze je uzivatel neprihlaseny
 */
function notLog(){
	$pom = "<div class = 'container'><b> Tato stránka je dostupná pouze přihlášeným uživatelům </b></div>";
	return $pom;
}



/**
 * vypise hlasku ze uzivatel nema dostatecna pro vstup na stranku
 * @return string
 */
function notAdmin(){
	$pom = "<b> <div class = 'container'>Nemáte dostatečná oprávnění pro vstup</div>";
	return $pom;
}

/**
 * pokud autor nema zadny clanek
 * @return string
 */
function zadnyClanek(){
	$pom = "<b><div class = 'container'> Nemáte žádný upladovaný článek </b></div>";
	return $pom;
}




}
?>