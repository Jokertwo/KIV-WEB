<?php


class recenzent{
	
	
	
	/**
	 * pomoci for each cyklu vola stale tu samou metodu ktera postupne vypisu
	 * je vsechny clanky
	 *
	 * @param unknown $clanky
	 */
	function vypis($clanky){
		//kontrola jestli promena neni null
		if(isset($clanky)){
			//pomocna promena pro idetifikaci formularu
			$pom = 1;
			foreach ($clanky as $i){
				echo $this->clanek($i["Nazev"], $i["Datum"], $i["Popis"],$i["idPrispevky"],$i["idStav"],
						$i["Zpracovani"],$i["Obsah"],$i["Styl"],$pom);
				$pom++;
			}
	
		}
	}
	
	/**
	 * vypise samotny clanek
	 * 
	 * @param unknown $nadpis nadpis clanku
	 * @param unknown $cas cak kdy bzl nahran
	 * @param unknown $abstrakt popis clanku
	 * @param unknown $id idClanku
	 */
	function clanek($nadpis,$cas,$abstrakt,$idClanku,$idStav,$Zpracovani,$obsah,$Styl,$pom){
		global $target_dir;
		
		?>
			<div class='container'>
			<div class= "row">
			<div class="col-sm-10">
					<h4><b><a href= <?php echo $target_dir.$idClanku?>><?php echo $nadpis?></a> </b></h4>
					<small><span class="glyphicon glyphicon-time"></span> Nahráno dne : <?php echo $cas ?></small>
					<?php $this->stavClanku($idStav)?>
					<p><?php echo $abstrakt?></p>
					<?php echo $this->hodnoceni($idStav,$idClanku,$Zpracovani,$obsah,$Styl,$pom) ?>
				</div>
			</div>
			</div>
			<br>
			
			
			
			<?php 
			
		}
	
	
	/**
	 * vytvori select box pro hodnoceni prispevku
	 */
	function hodnoceni($idStav,$idClanku,$Zpracovani,$obsah,$Styl,$pom){
		global $hodnoceni;
		$dis = "";
		
		//pokud je clanek zverejneny nebo zamitnuty
		//znemozni zmenit hodnoceni
		if($idStav != $hodnoceni["hodnoti se"]){
			$dis = "disabled";
		}
		
		?>		
				<div class = 'btn-group'><form action='' method='POST' id = '<?php $pom?>' >
				<select name='ohodnoceni[]' class="selectpicker" multiple   >
 	 		<optgroup label="Zpracování" data-max-options="1" <?php echo $dis?>>
 	 			<?php //vnitrek select boxu
						//vygenerovany cyklem
		 	 	 		echo $this->vytvorOption($Zpracovani);
		 	 	 	?>
	 		 </optgroup>
 	 		<optgroup label="Obsah" data-max-options="1" <?php echo $dis?> >
		 	 	<?php //vnitrek select boxu
						//vygenerovany cyklem
		 	 	 		echo $this->vytvorOption($obsah);
		 	 	 	?>
 		 	</optgroup>
 		 	<optgroup label="Styl" data-max-options="1" <?php echo $dis?>>
		 	 	<?php //vnitrek select boxu
						//vygenerovany cyklem
						echo $this->vytvorOption($Styl);
		 	 	 	?>
 		 	</optgroup>
 		 </select>
		<input type='hidden' name= 'select' value = '<?php echo $idClanku ?>'>
		<input type='submit' class = 'btn btn-primary' name='action' value='Ohonodnoť' <?php echo $dis?>>
		</form>
		</div>
				
				
				<?php 
		
	}
	/**
	 * vygeneruje vnitrek select boxu
	 * pokud uz nekdy bylo hodnoceni udeleno predvybere tuto moznost
	 * @param  $hod predesle hodnoceni
	 * @return string
	 */
	function vytvorOption($hod){
		//promena s maximalni znamkou
		global $maximalniHodnoceni;
	
		//retezec kde bude vytvoreny
		//vnitrek select boxu
	
		$option = "";
	
		//popisky pro nejlepsi a nejhorsi znamku
		$best  = "data-subtext='Nejlepší'";
		$worst = "data-subtext='Nejhorší'";
	
		for($n = 1; $n <= $maximalniHodnoceni ; $n++){
				
			//pokud uz bylo hodnoceni udeleno
			//bude predvybrano
			$selected = "";
			if($hod == $n){
				$selected = "selected";
			}
				
			//pridani popisku pro nejlepsi a nejhorsi znamku
			if($n == 1){
				//nejhorsi znamka
				$option .= "<option " . $selected ." ". $worst.">".$n."</option>";
			}
			else if($n == $maximalniHodnoceni){
				//nejlpsi znamka
				$option .= "<option " . $selected ." ". $best.">".$n."</option>";
			}
			else{
				//ostatni pripady
				$option .= "<option " . $selected . ">".$n."</option>";
			}
		}
		return $option;
	}
	
	/**
	 * vypise pouze informaci ye je clanek schvalen
	 */
	function schvaleno(){
		?>
		<h5><span class="label label-success"> Schváleno </span></h5>
		<?php 
	}
	/**
	 * vypise informaci o tom ze clanek byl administratorem zamitnut
	 */
	function zamitnuto(){
		?>
		<h5><span class="label label-danger"> Zamítnuto </span></h5>
		<?php
	}
	/**
	 * vypise informaci ze se jeste ceka na hodnoceni ostatnich
	 */
	function hodnoceno(){
		?>
		<h5><span class="label label-warning">Čeká se na hodnocení od všech recenzentů </span></h5>
		<?php
	}
	
	function stavClanku($idStav){
		//stav
		global $hodnoceni;
		
		switch ($idStav){
			
			case $hodnoceni["schvaleno"]: echo $this->schvaleno();
										break;
			case $hodnoceni["odmitnuto"]: echo $this->zamitnuto();
										break;
			case $hodnoceni["hodnoti se"]: echo $this->hodnoceno();
										break;
		}
	}
}


?>