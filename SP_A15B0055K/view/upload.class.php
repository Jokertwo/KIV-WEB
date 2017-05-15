<?php



class UploadView{
	
	/**
	 * fomular pro upload souboru
	 * s polem pro nadpis
	 * textarea=ou po popis souboru a filechoser
	 * plus tlacitko pro odeslani
	 * 
	 */
	function formUp(){
		?>
		
		<div class="container">
		<form class="form-horizontal" action ='' method='post'  enctype='multipart/form-data'>
		<div class="form-group">
		   <label class="control-label col-sm-2" for="nazev">Název</label>
		   	<div class="col-sm-7">
		 		<input type = 'text' name ='nazev' maxlength="39" class='form-control' required >
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="popis">Stručný popis příspěvku</label>
				<div class="col-sm-7">
				<textarea class="form-control" maxlength="395" name="popis" required rows="10"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="fileToUpload"><b>Vyber soubor:</b></label>
				<div class="col-sm-3">
				<input type='file'  name='fileToUpload'  id='fileToUpload' required><br>
			</div>
		</div>
		<div class="form-group">        
      		<div class="col-sm-offset-2 col-sm-10"> 
    			<input type='submit' class="btn btn-info"  value='Upload Image' name='submit'>
			</div>
		</div>
		</form>
		</div>
				
			
		<?php 
		 
	}
	
	
	/**
	 * informuje o uspesnem nahrani na server
	 */
	function successUpload(){
		?>		
		<div class="container">
				<div class="alert alert-success">
		  		<strong>Úspěch</strong> Příspěvek byl nahrán.
				</div>
			</div>
				<?php 
	}
	
	
	
	/**
	 * informuje o chybach behem uploadu
	 * @param string $text
	 */
	function alerts($text){
		?>
		<div class="container">
					<div class="alert alert-warning">
			  		<strong>Chyba!!</strong> <?php echo $text?>
					</div>
				</div>
					<?php 
		}
	
	/**
	 * zobrazi dalsi tlacitko pro dalsi upload
	 * a nebo navrat zpet navrat zpet
	 * nema zadnou obsluhu takze se stranka nacte 
	 * v puvodni verzi
	 */
	function nextUpload(){
		?>
		<div class="container">
		<form action ='' method='post'>
		
		<input type="hidden" name = "submit" value= "back" >
		<input type="submit" class="btn btn-info" name="submit" value= "Back">
		
		</form>
		</div>
		
		<?php 
	}
	
	
}


?>