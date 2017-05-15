<?php




class clanky{
	
	
	
	/**
	 * usporadani nadpisu clanku plus
	 * jeho abstrakt
	 * 
	 * 
	 * 
	 * 
	 * @param unknown $nadpis
	 * @param unknown $cas
	 * @param unknown $abstrakt
	 */
	function clanek($nadpis,$cas,$abstrakt,$id,$autor){
		global $target_dir;
		?>
		<div class='container'>
		<div class= "row">
		<div class="col-sm-10">
				<h4><b><a href= <?php echo $target_dir.$id?>><?php echo $nadpis?></a> </b></h4>
				<small><span class="glyphicon glyphicon-time"></span> Nahráno dne : <?php echo $cas ?></small>
				<h5> Autor :  <span class="label label-success"><?php echo $autor ?></span></h5>
				<p><?php echo $abstrakt?></p>
			</div>
		</div>
		</div>
		<br>
		
		
		
		<?php 
		
	}
	
	
	
}
?>