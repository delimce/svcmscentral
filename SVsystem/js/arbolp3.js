////funciones de visualizacion del arbol


function abrir_cat(id,nivel){
	
	  var objetox;
	  
	  if(nivel==1){ objetox = document.getElementById('catcon'+id); 
	  }else if(nivel==2){ objetox = document.getElementById('subcon'+id); 
	  }else{ objetox = document.getElementById('sub2con'+id);   }

   if(objetox.style.display=='none1'){
	   
	     objetox.style.display = 'inline';
		 
		 
		 
		oXML = AJAXCrearObjeto();
		oXML.open('post','workflowcont.php');
		oXML.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		oXML.onreadystatechange = function(){
			if (oXML.readyState == 4 && oXML.status == 200) {
				
				objetox.innerHTML = oXML.responseText;
				vaciar(oXML);

			}else{ ///mientras se esta cargando
			
				objetox.innerHTML = '<span class="td-texto1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;cargando...</span>'; 
			
			
			}
		
		
	 	}

	oXML.send('id='+id+'&nivel='+nivel); ///variables
	
	
	
	   
   }else{
	
		objetox.style.display = 'none';
	   
   }

}




	function borrar(id,nombre,nivel,id2,nivel2){
		
	  if (confirm("Esta seguro que desea borrar "+nombre+" y todo su contenido?")) {
	  
	  ajaxsend("post","borrar_prod.php","id="+id+"&tabla="+nivel);
	  
	  
		if(nivel2!=0){
		  
		  abrir_cat(id2,nivel2);
		  abrir_cat(id2,nivel2);
		  
		  }else{
			  
			  location.replace('productos.php');
		  
		  }
	  
	  
	  }else{
	  
	  
	  return false;
	  
	  }
	}
	
	
	
	function borrar_prod(id,nombre,nivel,cat){
	
	  if (confirm("Esta seguro que desea borrar el producto "+nombre+" ?")) {
	  
	  ajaxsend("post","borrar_prod2.php","id="+id+"&nivel="+nivel+"&cat="+cat);
	  
	  	abrir_cat(cat,nivel);
		abrir_cat(cat,nivel);
	  
	  
	  }else{
	  
	  
	  return false;
	  
	  }
	}
	
	
	
	function ordenar(orden,nivel,sentido,id,nivel2){
	
	  
	  ajaxsend("post","ordenar.php","orden="+orden+"&tabla="+nivel+"&se="+sentido);
	//  alert(nivel+" ordenada");
	
		if(nivel2!=0){
		
		abrir_cat(id,nivel2);
		abrir_cat(id,nivel2);
		
		}else{
			
	  		location.replace('productos2.php');
		
		}
	 
	}
	
	
	function ordenar_pro(orden,nivel,cat,sentido){
	
	  
	  ajaxsend("post","ordenar_prod.php","orden="+orden+"&nivel="+nivel+"&cat="+cat+"&se="+sentido);
	 // refresca la lista de articulos solamente
	 	abrir_cat(cat,nivel);
		abrir_cat(cat,nivel);

	  
	 
	}