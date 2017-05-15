<?php




class stavClanku{
	
	
	
	/**
	 * vztvori tlacitko v tabulce ktere po stisknuti vymaze clanek uzivate z databaze
	 * 
	 * $pristup pokud neni null ma hodnotu
	 * disabled diky ktere nepujde tlacitko stisknout
	 * pokud uz je clanek predany recenzentum k hodnoceni 
	 * 
	 * @param string $name jmeno pod kterym je ulozen clanek 
	 * @param integer $item idClanku
	 * @param String $pristup  
	 * @return string vraci cele tlacitko
	 */
	function btnDelete($item,$pristup,$name){
		
		global $hodnoceni;
		$dis = "";
		
		//znemoznení smazani zverejneného případně recenzovaného clanku
		if($pristup != $hodnoceni["zpracovava"] && $pristup != $hodnoceni["odmitnuto"] ){
			$dis= "disabled='disabled'";
		}
		
		
		$pom = "<td>";
		$pom .="<form action = '' method = 'POST' id= delete>";
		$pom .=		"<input type = 'hidden' name = 'jmenoS' value = " .$name .">";
		$pom .=		"<input type = 'hidden' name = 'idClanku' value= " . $item.">";
		$pom .= 	"<input type = 'submit' class='btn btn-danger btn-ms ' ".$dis." name = 'action' value = 'Delete'>";
		$pom .="</form></td>";
		
		return $pom;
	}
	
	function successDelete(){
		?>
		<div class="alert alert-success">
  		<strong>Úspěch</strong> Příspěvek byl smazán.
		</div>
		<?php 
	}
	
	/**
	 * informuje o uspesne editaci
	 * prispevku
	 */
	function successEdit(){
		?>
		<div class="container">
			<div class="alert alert-success">
			  	<strong>Úspěch</strong> Příspěvek byl úspěšně editován.
			</div>
		</div>
		<?php
		}
		
		
	
		
	/**
	 * vytvori textareu a input text pole
	 * ktere je predvzplneno textem predanym v argumentech
	 * 
	 * @param string $text puvodni text clanku
	 * @param string $nazev puvodni nazev clanku 
	 */
	function editUp($text,$nazev,$idClanku){
		?>
			<div class="container">
			<form class="form-horizontal" action ='' method='post'  enctype='multipart/form-data'>
			<div class="form-group">
				<label class="control-label col-sm-2" for="nazev">Název</label>
					<div class="col-sm-2">
						<input type = 'text' name ='nazev' maxlength="39" value = " <?php echo $nazev ?>" class='form-control' required >
					</div>
				</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="popis">Stručný popis příspěvku</label>
					<div class="col-sm-5">
						<textarea class="form-control" maxlength="395" name="popis" required> <?php echo $text ?> </textarea>
					</div>
				</div>
			<div class="form-group">        
      			<div class="col-sm-offset-2 col-sm-10">
      				<input type = 'hidden' name = idClanku value = "<?php echo $idClanku ?>"> 
    				<input type='submit' class="btn btn-success"  value='Update' name='action'>
					<input type='submit' class="btn btn-info"  value='Back' name='back'>
				</div>
			</div>
			</form>
			</div>
			
		
		<?php 
		}
	
		
	
	
	/**
	 * tlacitko pro editaci popisu a nadpisu clanku
	 * v parametru $pristup je Disabled nebo null podle toho jeslti ma jit na tlacitko kliknout nebo ne
	 * $number pouze cislo pro identifikaci
	 * $item predavam IdClanku abych vedel po kliknuti ktery upravuji clanek
	 * 
	 * @param unknown $item  idClanku
	 * @param String $pristup idStav ur4uje jestli bude talcitko disabled nebo ne
	 * @param integer $number identifikacni
	 * @return string
	 */
	function btnEdit($item,$pristup,$number){
		global $hodnoceni;
		
		$dis = "";
		
		//znemoznení upraveni zverejneného případně recenzovaného clanku, zamitnuteho
		if($pristup != $hodnoceni["zpracovava"]){
			$dis= "disabled='disabled'";
		}
		
		$pom = "";
		$pom .="<td>";
		$pom .="	<form action='' method ='POST' id='$number' >";
		$pom .="		<input type='hidden' name = 'idClanku' value = ".$item.">";
		$pom .="	<input type='submit' class='btn btn-info btn-ms' ".$dis." name = 'action' value = 'Edit'>";
		$pom .="	</form></td>";
		
		return $pom;
	}
	
	/**
	 * vztvori tabulku z clanku autora
	 * pomoci foreach cyklu
	 * $clanky je pole obsahujici vsechny clanky konkretniho 
	 * autora
	 * 
	 * @param array $clanky asociativni pole z databaze
	 * @return string vraci celou tabulku
	 */
	function autor($clanky){
		global  $target_dir;
		$form = "<div class='container'>";
		$form .= "<table class ='table table-striped table-hover table-responsive'>";
		$form .="<thead><tr> <th>Nazev</th>  <th>Datum</th>  <th>Popis</th>
					<th>Stav</th>  <th>Edit</th>   <th>Delete</th> </tr></thead><tbody>";
		
		//pouze pomocna promena abych od sebe oddelil jednotlive formulare
		$pom = 1;
		
		if(isset($clanky))
			foreach ($clanky as $i){
				
				
				//udela z nazvu odkaz na stahnuti
				$form .= "<tr><td><a href=" .$target_dir.$i["NazevSouboru"].">" .$i['Nazev']."</a></td>  <td><small>".$i["Datum"]."</small></td>";
				$form .= "<td>".$i['Popis']."</td>  <td>".$i["Stav"]."</td>";
				
				
				
				
				//tlacitko pro edit clanku
				$form .= $this->btnEdit($i['idPrispevky'], $i['idStav'], $pom);
				
				//tlacitko pro smazani clanku
				$form .= $this->btnDelete($i['idPrispevky'], $i['idStav'], $i['NazevSouboru']);
				

				//zvyseni pomocne promene
				$pom++;
				
				$form .= "</tr>";
			}
	$form .= "</tbody></table></div>";
	return $form;
	}
	
	
	
}


?>