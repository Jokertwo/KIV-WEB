
<?php


require_once ("view/konstanty.inc.php");
require_once 'model/database.mod.class.php';  
    
    class basic{
    	
    	//pole vsech nadpisu stranek
    	private $pages = array("uvod"=>"Úvod","clanky" => "Články","login" => "Login",
    			"reg" => "Registrace","ucty" => "Správa účtů","up"=>"Upload","stav"=>"Přehled","rec"=>"Recenze","manCl"=>"Správa článků");
    	
    	
    /**
     * funkce vracejici nadpis stranky
     * @param unknown $page
     * @return unknown|string
     */
    	function nadpis($page){
    		
    		
    		
    		$nadpis = "";
    		if ($this->pages != null)
    		foreach ($this->pages as $key => $title){
    			if($page == $key){
    				$nadpis = $title;
    			}
    		}
    		return $nadpis;
    	}
    	
    	
    	
    	/**
    	 * Vytvori navigacni menu
    	 * @param unknown $page
    	 * @return string
    	 */
    	
    	function menu($page){
    		
    		
    		$menu = "";
    		
    		
    		if ($this->pages != null)
    			foreach ($this->pages as $key => $title)
    			{
    				if ($page == $key) $active_pom = "class='active'";
    				
    				else $active_pom = "";
    				
    				$menu .= " <li ".$active_pom." ><a href='index.php?page=$key'>$title</a></li>";
					
    				
    			}
    		
    		return $menu;
    	}
    	/**
    	 * menu ktere se zobrati neprihlasenym
    	 * uzivatelum
    	 */
    	function notLogin(){
    		?>
    		<li><a href='index.php?page=uvod'>Úvod</a></li>
    		<li><a href='index.php?page=clanky'>Články</a></li>
    		<li><a href='index.php?page=reg'>Registrace</a></li>
    		<?php 
    	}
    	/**
    	 * menu ktere se zobrazi autorum
    	 */
    	function autor(){
    	?>
    	<li><a href='index.php?page=uvod'>Úvod</a></li>
    	<li><a href='index.php?page=clanky'>Články</a></li>
    	<li><a href='index.php?page=up'>Upload</a></li>
    	<li><a href='index.php?page=stav'>Přehled</a></li>
    	
    	<?php 
    	}
    	
    	/**
    	 * menu pro recenzenta
    	 */
    	function recenzent(){
    	?>
    	
    	<li><a href='index.php?page=uvod'>Úvod</a></li>
    	<li><a href='index.php?page=clanky'>Články</a></li>
    	<li><a href='index.php?page=rec'>Recenze</a></li>
    	
    	<?php 
    	}
    	
    	/**
    	 * menu pro admina
    	 */
    	function admin(){
    	?>
    	<li><a href='index.php?page=uvod'>Úvod</a></li>
    	<li><a href='index.php?page=clanky'>Články</a></li>
    	<li><a href='index.php?page=ucty'>Správa účtů</a></li>
    	<li><a href='index.php?page=manCl'>Správa článků</a></li>
    	
    	<?php 	
    	}
    	/**
    	 * zobrazi login a tlacitko pro odhlaseni
    	 */
    	function odhlasit($idRule){
    		?>
    		<li><a href='index.php?page=login'><span class="glyphicon glyphicon-log-out"></span> Odhlásit</a></li>
    		
    		<?php 
    	}
    	
    	
    	/**
    	 * Vytvori navigacni menu
    	 * @param unknown $page
    	 */
    	function menu2($page,$idRule){
    		
    			?>
		    		<nav class="navbar navbar-inverse">
		 <div class="container-fluid">
			<div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>                        
		      </button>
		     <a class="navbar-brand" href="javascript:window.location.reload(true)">Cestování</a>
		</div>
			<div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav">
		      			
		      		<?php 
		      		//neprihlaseny uzivatel
		      			if($idRule == null || $idRule == 0) 
		      			$this->notLogin();
		      		
		      		//autor
		      			if ($idRule == 3)
		      					$this->autor();
		      		//recenzent
		      			if ($idRule == 2)
		      					$this->recenzent();
		      		//admin
		      			if ($idRule == 1)
		      					$this->admin();
		      		//boss pouze pro testovani
		      			if ($idRule == 4)
		      					echo $this->menu($page);
		      			?>
		      		</ul>
		      		<ul class="nav navbar-nav navbar-right">
		      		<?php if ($idRule == null){?>
		      			<li><a href='index.php?page=login'><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		      			<?php 
		      			}
		      				else 
		      					$this->odhlasit($idRule)?>  
		      		</ul>
		      	</div>
		      	</div>
 </nav>
    		
    		
    		
    		
    		<?php 
    	}
    }
    
    
    
?>