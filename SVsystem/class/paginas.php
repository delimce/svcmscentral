<?php 


  /////funcion para paginar
  function paginas($total,$numero,$actual,$pagina){
   
   		$ttotal = ceil($total/$numero);
		
		if($ttotal>1){
   
			   if($actual!=0){
			   $sig = $actual-$numero;
			   echo "<a href=\"".$pagina."?cuenta=$numero&desde=$sig\">< </a> &nbsp;";
			   }
			  
			  for($i=0;$i<$ttotal;$i++){
			  
				$real = $i * $numero;
				$actual2 = $actual/$numero;
				$es = $i+1;
			   
			   echo '<span>';
			   
				  if($i==$actual2){
				  
				  echo $es.'&nbsp;';
				  
				  }else{
				  
				  echo "<a href=\"".$pagina."?cuenta=$numero&desde=$real\">$es</a>&nbsp;";
				  
				  }
				  
			   echo '</span>';  
				  
					   
			  
			  } 
			   
			   if($actual2<$ttotal-1){
			   $sig = $actual+$numero;
			   echo "&nbsp; <a href=\"".$pagina."?cuenta=$numero&desde=$sig\">></a>";
			   }
	   
	   }
   
  
   }	

?>
