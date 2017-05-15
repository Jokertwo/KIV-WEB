<?php





class UploadModel{
	
	
	//soubor jez se ma ulozit
	public $target_file;
	//jaka chyba nastala
	public $chyba;
	//cilova slozka
	public $target_dir;
	//maximalni velikost souboru
	public $file_size;
	//pole pripustnych pripon
	public  $koncovka;
	//promena pro databazi
	public $pripona;
	/**
	 * konstruktor v nemz se nastavi cilova slozka na servru
	 * jez je jako globlni promena ulozena 
	 * v konstanty.inc.php
	 */
	function __construct(){
		global $target_dir,$file_size,$koncovka;
		$this->target_dir = $target_dir;
		$this->file_size = $file_size;
		$this->koncovka = $koncovka;
		$this->chyba = "";
	}
	
	/**
	 * smaze soubor ulozeny na disku
	 * 
	 * @param string $name jmeno souboru
	 * @return boolean true pokud se to povede
	 */
	function deleteFile($name){
		$file = $this->target_dir . $name;
		if(!unlink($file))
			return false;
		else 
			return true;
	}
	
	
	
	
	/**
	 * zkontroluje jestli neni soubor prilis
	 * velky podle hodnoty nastavene v konstanty.inc.php 
	 * ulozi do $this->chyba index chybove hlasky
	 * @return boolean vraci true kdy je
	 */
	function sizeCheck(){
		if($this->target_file == null){
			if($this->target_file["size"] > $this->file_size ){
				
				return false;
			}
			$this->chyba = "null";
			return false;
		}
		
		return true;
	}
	
	
	/**
	 * zjisti jestli nahodou uz soubor neni nahrany
	 * @return boolean vraci true pokud jeste neni nahrany
	 */
	function exist($jmeno){
		
		if(file_exists($this->target_dir.basename($jmeno))){
			$this->chyba = "exist";
			return false;
		}
		
		return true;
	}
	
	
	
	/**
	 * funkce ktera hlida koncovky souboru
	 * v pripade ze souhlasi s promenou uvedenou v 
	 * konstanty.inc.php vrati true
	 * jinak false 
	 */
	function checkPDF($file){
		$pom = $this->target_dir . basename($file["name"]);
		$checkEnd = pathinfo($pom,PATHINFO_EXTENSION);
		
		foreach ($this->koncovka as $i){
			if($i == $checkEnd){
				$this->pripona = $i;
				return true;
			}
		}
		$this->chyba = "pdf";
		return false;
	}
	/**
	 * vrati index chybove hlasky
	 * @return string obsahujici indexx pro asociativni pole
	 * 
	 */
	function getChyba(){
		global $chybove_Hlasky_upload;
		foreach ($chybove_Hlasky_upload as $i => $title){
			if($this->chyba == $i){
				
				return $title;
			}
			
		}
		
		return "Doposud neobevena chyba :)";
	}
	
	/**
	 * pokud jsou splneny vsechny podminky
	 * ulozi 
	 * 
	 * @param $_FILE $item odeslany z formulare
	 */
	function saveUpload($item,$jmeno){
		
		
		$this->target_file = $item;
		//cilova slozka
		$pom = $this->target_dir . basename($jmeno);
				
							
				if($this->sizeCheck() === true){
					
					move_uploaded_file($this->target_file["tmp_name"], $pom);
					$this->chyba = "ok";
					return true;
				
			}
		
		
		return false;
	}
}



?>
