<?php

class publishing{
	
	
	/**
	 * vytvori tlacitko zamitni ktere
	 * dany prispevek zamitne
	 * @param integer $idClanku 
	 */
	function btnZamitni($idClanku){
		$pom = "";
		
		
		$pom .=	"<form action='' method='POST' id= 'dismiss'>";
		$pom .=		"<input type='hidden' name= 'dismiss' value = ". $idClanku.">";
		$pom .=		"<input type='submit' class='btn btn-danger btn-ms' name = 'action' value = 'Zamítnout'>";
		$pom .=	"</form>";
		
		return $pom;
	}
	/**
	 * vytvori tlacitka pro prijeti,odmitnuti clanku a pro vraceni napredchozi stranku
	 * idClanku
	 * zvyrazni pomoci activ tlacitko podle stavu clanku
	 * @param integer $idClanku
	 * @return string
	 */
	function btn($idClanku,$idStav){
		
		global $hodnoceni;
		
		$activSuc = "";
		$activDis = "";
		
		//zaktivovani tlacitka Schvaleno pokud
		//uz byl clanek schvalen
		if($idStav == $hodnoceni['schvaleno']){
			$activSuc = "active";
		}
		//zaktivovani tlacitka 'Zamitnout' pokud
		//uz byl clanek Zamitnut
		if($idStav == $hodnoceni['odmitnuto']){
			$activDis = "active";
		}
		
		$pom = "<div class='container'>";
		
		
		$pom .=	"<form action='' method='POST' id= 'success'>";
		$pom .= "<div class='row'>
    				<div class='col-lg-4 col-lg-offset-4'>
        				<div class='btn-group'>";
		$pom .=		"<input type='hidden' name= 'success' value = ". $idClanku.">";
		$pom .=		"<input type='submit' class='btn btn-success ".$activSuc."' name = 'action' value = 'Schválit'>";
		$pom .=		"<input type='hidden' name= 'dismiss' value = ". $idClanku.">";
		$pom .=		"<input type='submit' class='btn btn-danger  ".$activDis."' name = 'action' value = 'Zamítnout'>";
		$pom .=  	"<input type='submit' class='btn btn-info' name= 'active' value='Zpět'>";
		
		$pom .=	"</div></form></div></div></div>";
		
		return $pom;
		
	}
	
	function bthHodnoceni($idClanku){
		$pom = "";
		
		$pom .="<td>";
		$pom .=	"<form action='' method='POST' id= 'rating'>";
		$pom .=		"<input type='hidden' name= 'ratings' value = ". $idClanku.">";
		$pom .=		"<input type='submit' class='btn btn-info btn-ms' name = 'action' value = 'Hodnocení'>";
		$pom .=	"</form></td>";
		
		return $pom;
	}
	
	/**
	 * zobrazi chzbovou hlasku ze je vybran nedostatek autoru
	 * @return string
	 */
	function nedostatekAutoru(){
		$pom = "<div class='alert alert-warning'>
  		<strong>Varování</strong> Pro recenzi musí být vybráni tři recenzenti.
		</div>";
		return $pom;
		
	}
	
	
	/**
	 * vytvori select box kde lze priradit maximalne tri
	 * recenzenty na clanek
	 * 
	 * @param integer $idClanku
	 * @param array $recenzenti login plus idUzi vsech recenzentu
	 * @param integer $pom jen pomocna promena pro odliseni formularu
	 * @param string $disable pokud neni null zmenozni kliknuti na tlacitko
	 * @return string
	 */
	function selectRec($idClanku,$recenzenti,$pom,$disable){
		//globalni promena urcujici maximalni
		//pocet recenzentu
		global $pocetRecenzetu;
		
		$select = "<td><div class = 'btn-group'><form action='' method='POST' id= ". $pom .">";
		
		//hidden kde value ma hodnotu idPrispevku
		$select .= "<input type='hidden' name= 'select' value = ". $idClanku.">";
		//pridani tlacitka pro odeslani
		$select .= "<input type='submit' class = 'btn btn-primary btn-block' name='action' value='Přiřaď' ". $disable." >";
		//hranate zavorky jsou u name proto aby se to odeslalo jako formular
		$select .="<select name='vyber[]' class='form-control selectpicker' multiple data-max-options='".$pocetRecenzetu."'". $disable.">";
		
		
		
		
		//kontrola jestli pole neni null
		if(isset($recenzenti)){ 
			foreach ($recenzenti as $i){
			 	//jednotlive moznosti v select boxu
				$select .= "<option value= '".$i['idUzivatel']."'>".$i['Login']."</option>";
			}
		}
		
		$select .= "</select></form></div></td>";
		
		return $select;
		
	}
	
	/**
	 * tabulka pro spravu prispevku pro administratora
	 * 
	 * je tu moznost zamitnou prispevek, schvalit a tim i zverejnit
	 * prispevek
	 * 
	 * @param unknown $data
	 * @param unknown $recenzenti
	 * @return string
	 */
	function form($data,$recenzenti){
		global $target_dir,$hodnoceni;
		$form = "<div class='container'>";
		$form .= "<table class ='table table-striped table-hover table-responsive'>";
		$form .="<thead><tr>  <th>Název</th>    <th>Popis</th> <th>Stav</th> 
				<th>Přiřaď recenzentům</th><th>Hodnocení</th></tr></thead><tbody>";
		
		
		
		//pomocna promena pro identifikaci
		//jednotlivych formularu
		$pom = 1;
		if(isset($data)){
		foreach ($data as $i){
			//promena pro znemozneni kliknuti na tlacitko
			//pokud je to treba
			$disable = "";
			if($i['idStav'] != $hodnoceni['zpracovava']){
				$disable = "disabled";
			}
			
			
			$form .= "<tr><td><a href= " .$target_dir.$i['NazevSouboru'].">". $i['Nazev'] ."</a></td><td>"
							.$i['Popis']."</td><td  " . $this->stavClanku($i['idStav'])." >".$i['Stav']."</td>";
			
			$form .= $this->selectRec($i['idPrispevky'], $recenzenti, $pom,$disable);
			$form .=$this->bthHodnoceni($i['idPrispevky']);
			$form .= "</tr>";
			
			$pom++;
		}
		}
		$form .= "</tbody></table></div>";
		
		return $form;
	}
	
	/**
	 * metoda vytvori tabulku s hodnocenim prispevku
	 * v poslednim radku je soucet vsech hodnoceni
	 * 
	 * @param array $rating informace z databaze
	 * @param unknown $idClanku id konkretniho clanku
	 * @return string
	 */
	function ratings($rating,$idClanku){
		$form = "<div class='container'>";
		$form .="<h3>".$rating[0]['Nazev']."</h3>";
		$form .= "<table class ='table table-striped table-hover table-responsive'>";
		$form .="<thead><tr>  <th>Login</th>  <th>Zpracovaní</th> <th>Obsah</th>
				<th>Styl</th> <th>Celkem</th></thead><tbody>";
		
		//promene pro celkove hodnoceni
		$ZpracovaniCelk = 0;
		$ObsahCelk = 0;
		$StylCelk = 0;
		$bodyCelk = 0;
		
		if(isset($rating)){
			foreach ($rating as $i){
				$form .= "<tr><td>".$i['Login']."</td><td>". $i['Zpracovani'] ."</td><td>"
							.$i['Obsah']."</td><td>".$i['Styl']."</td>";
				//secteni bodu za zpracovani
				$ZpracovaniCelk = $ZpracovaniCelk +  $i['Zpracovani'];
				//secteni bodu za Obsah
				$ObsahCelk =  $ObsahCelk + $i['Obsah'];
				//secteni bodu Styl
				$StylCelk = $StylCelk + $i['Styl'];
				
				$bodyCelk = $StylCelk + $ObsahCelk + $ZpracovaniCelk;
				
				$pom = $i['Zpracovani'] + $i['Obsah'] + $i['Styl'];
				$form .="<td>". $pom . "</td></tr>";
			}
		}
		//pridani radku s celkovymi body
		$form .="<tr><td><b>Celkem</td></b><td><b>".$ZpracovaniCelk."</b></td><td><b>".$ObsahCelk."</b></td><td><b>"
				.$StylCelk."</td><td><b>".$bodyCelk. "</b></td>";
		$form .= "</tbody></table>";
		$form .="</div>";
		$form .= $this->btn($idClanku,$rating[0]['idStav']);
				
				
		
		return $form;
	}
	
	
		/**
		 * na zaklade stavu clanku obarvy bunku tabulky
		 * @param unknown $idStav
		 */
		function stavClanku($idStav){
			//stav
			global $hodnoceni;
			
			$resolut = "";
			switch ($idStav){
				
				case $hodnoceni["schvaleno"]:$resolut  = " class='success' ";
											break;
				case $hodnoceni["odmitnuto"]:$resolut  = " class='danger' ";
											break;
				case $hodnoceni["hodnoti se"]:$resolut  = " class='warning' ";
											break;
				case $hodnoceni["zpracovava"]:$resolut  = " class='info' ";
											break;
			}
			return $resolut;
		}
}