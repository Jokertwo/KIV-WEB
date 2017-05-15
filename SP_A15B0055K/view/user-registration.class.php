





    

<?php



class registrace{
   
		   
				
   
	/**
	 * vytvori registracni formular
	 */
	function RegForm($item,$spatneHeslo){
		?>
		<div class="container">
		<?php if($item != true){?>
		<div class="alert alert-danger">
  				<strong>Stejný login</strong> Uživatel s tímto loginem už existuje.
			</div>
			<?php }?>
		<?php if($spatneHeslo != true){?>
		<div class="alert alert-danger">
  				<strong>Špatné heslo</strong> Hesla musí být stejná.
			</div>
			<?php }?>
		<h3>Registrační formulář</h3>
		<form class="form-horizontal" action="" method="POST" oninput="x.value=(pas1.value==pas2.value)?'OK':'Nestejná hesla'">
		
        
        <div class="form-group">
            <label class="control-label col-sm-2" for="Login"> Login:</label>
                <div class="col-sm-3">
                	<input type="text" class="form-control" name="login" required>
                	</div>
                </div>
        <div class="form-group">
        	<label class="control-label col-sm-2" for="Heslo 1">Heslo 1:</label>
        		<div class="col-sm-3">
                	<input type="password" class="form-control" name="heslo" id="pas1" required>
                </div>
               </div>
         <div class="form-group">
        	<label class="control-label col-sm-2" for="Heslo 2">Heslo 2:</label>
                <div class="col-sm-3">
                <input type="password" class="form-control" name="heslo2" id="pas2" required>
               </div>
              </div>
         <div class="form-group">
        	<label class="control-label col-sm-2" for="Ověření hesla">Ověření hesla:</label>
                <div class="col-sm-3">
                <output name="x" for="pas1 pas2"></output>
               </div>
              </div>
        <div class="form-group">
        	<label class="control-label col-sm-2" for="Jméno">Jméno:</label>
                <div class="col-sm-3">
                <input type="text" class="form-control" name="jmeno" required>
               </div>
              </div>
        <div class="form-group">
        	<label class="control-label col-sm-2" for="E-mail">E-mail:</label>
                <div class="col-sm-3">
                <input type="email" class="form-control" name="email" required>
               </div>
              </div>
          
       <div class="form-group">        
      		<div class="col-sm-offset-2 col-sm-10">    
            	<input type="submit" class="btn btn-success" name="potvrzeni" value="Registrovat" data-target="#myModal">
            </div>
           </div>
        </form>
        </div>
        <?php 
		

	}
	
	/**
	 * zobrazi se prihlasenym uzivatelum
	 */
		function inSys(){
			?>
        <b>Pihlášený uživatel se nemůže znovu registrovat.</b>
        
	<?php 
   }
 		
   	
   		
}
 ?>
             