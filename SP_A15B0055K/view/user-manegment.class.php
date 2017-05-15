<?php



class manegment{
	

	
	
	private $selectBoxRule;
	
	function setSelectBoxRule($rule){
		$this->selectBoxRule = $rule;
	}
	
	
	
	
	/**
	 * vytvori tlacitko smaz po jehoz stisknuti se vymaze
	 * cely uzivatel z databaze 
	 * @param unknown $item idUzivatele z databaze
	 */
	function btnDelete($item){
		
		$pom = "";
		
		$pom .="<td>";
		$pom .=	"<form action='' method='POST' id= 'delete'>";
		$pom .=		"<input type='hidden' name= 'delete' value = ". $item.">";
		$pom .=		"<input type='submit' class='btn btn-danger btn-ms' name = 'action' value = 'Delete'>";
		$pom .=	"</form></td>";
		
		return $pom;
		 
	}
	
	
	/**
	 * vytvori tlacitko jez po stisknuti zmeni prava u konkretniho
	 * profilu
	 *  @param int $number pomocna promena k identifikaci
	 * @param $item idUzivatele z databaze
	 */
	function btnUpdateRule($item,$number){
		
		
		$pom = "";
		$pom .="<td>";
		$pom .="	<form action='' method ='POST' id='$number' >";
		$pom .="		<input type='hidden' name = 'update' value = ".$item.">";
		$pom .="	<input type='submit' class='btn btn-info btn-ms' name = 'action' value = 'Update'>";
		$pom .="	</form></td>";
		
		return $pom;
	
	}
	
	/**
 *  Vytvori selectbox s pravi uzivatelu.
 *  @param array $rights    Vsechna dostupna prava.
 *  @param integer $selected    Zvolena polozka nebo null.
 *  @param int $number pomocna promena k identifikaci
 *  @return string          Vytvoreny selectbox.
 */
function prava($rights,$selected,$number ){
	
    $res = "<select  name='pravo' class='form-control' form='$number'>";
    if($rights != null){
    foreach($rights as $r){
    	//kontrola session
    	if(isset($_SESSION["user"])){
    		
    		//kontrola jestli je boss
    			if($_SESSION["user"]["idPrava"] == 4){
    	
			        if($selected!=null && $selected==$r['idPrava']){ // toto bylo ve stupu
			           
			        	$res .= "<option value='".$r['idPrava']."' selected>$r[Nazev]</option>";    
			        } 
			        else
			        { // nemam vstup
			            $res .= "<option value='".$r['idPrava']."'>$r[Nazev]</option>";    
			        		}  
	    			}
	    	//vygeneruje select box ale bez prava boss
	    		else{
	    			if($r["idPrava"] != 4){
	    				if($selected!=null && $selected==$r['idPrava']){ // toto bylo ve stupu
	    				
	    					$res .= "<option value='".$r['idPrava']."' selected>$r[Nazev]</option>";
	    				}
	    				else
	    				{ // nemam vstup
	    				$res .= "<option value='".$r['idPrava']."'>$r[Nazev]</option>";
	    				}
	    				
	    			}
	    		}
    	}
    }
    $res .= "</select>";
    
    return $res;
    }
}
	
	
	
	
	
	/**
	 * vypise admistratorovi tabulku se vsemi uzivately a zaroven
	 * s moznosti zmenit prava pripadne smazat celeho uzivatele
	 * 
	 * 
	
	 * @param unknown $databaze pole vsech uzivatelu z databaze
	 */
	function admin($databaze){
		
		
		$form = "<div class='container'>";
		$form .= "<table class ='table table-striped table-hover table-responsive'>";
		$form .="<thead><tr>  <th>ID</th>  <th>Login</th>  <th>Jméno</th>  <th>E-mail</th>
				<th>Aktuální práva</th>  <th>Změn práva</th>   <th>Update</th> <th>Smaž</th>   </tr></thead><tbody>";
		
		//pouze pomocna promena abych od sebe oddelil jednotlive formulare
		$pom = 1;
		//vypise do tabulky vsechny uzivatele
		foreach ($databaze as $i){
			
			
			
			//zajisti ze prihlaseny uzivatel se nevypise do tabulky
			//aby nemoho napr smazat sam sebe
			//zaroven nevypise bosse
			//podminka vlastne preskoci jednu iteraci
			if($i['idUzivatel'] !=$_SESSION['user']['idUzivatel'] && $i["idPrava"] != 4 ){
				
				$form .= "<tr><td>".$i['idUzivatel']."</td>  <td>".$i["Login"]."</td>";
				$form .= "<td>". $i["Jmeno"]."</td>  <td>".$i["Email"]."</td>  <td>".$i["Nazev"]."</td>";
			
				//pripojeni select boxu s aktualnim pravem
				$form .= "<td>".$this->prava($this->selectBoxRule, $i["idPrava"],$pom)."</td>";
				
				//pripojeni tlacitka pro update prav
				$form .= $this->btnUpdateRule($i['idUzivatel'],$pom);
				
				//pripojeni tlacitka pro smazani uctu
				$form .= $this->btnDelete($i['idUzivatel']);
								
				
				//zvyseni pomocne promene
				$pom++;
				
				 $form .= "</tr>";
			}
		}
		
		$form .= "</tbody></table></div>";
		
		
		return $form;
	}
	
}


?>





















