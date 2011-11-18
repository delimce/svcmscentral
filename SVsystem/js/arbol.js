////funciones de visualizacion del arbol

function abrir_cat(id,nivel){
 	abrir_cat2(id,nivel,'');
}

function abrir_cat2(id,nivel,extraVars){
	  var objetox;

	  if(nivel==1){ objetox = document.getElementById('catcon'+id);
	  }else if(nivel==2){ objetox = document.getElementById('subcon'+id);
	  }else{ objetox = document.getElementById('sub2con'+id);   }

   if(objetox.style.display=='none'){

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
	oXML.send('id='+id+'&nivel='+nivel+extraVars); ///variables

   }else{

		objetox.style.display = 'none';

   }

}



//////////////////////funciones internas


<!--
function estatus(id,nivel){

					 var estado,estatus;

						  estado = document.getElementById("escom_"+id+"_"+nivel).value;
						  if(Number(estado)==1){ estatus = 'No alimentable' }else{ estatus = 'Alimentable' }

						  if (confirm("desea cambiar a "+estatus+" ?")) {

						  oXML = AJAXCrearObjeto();
						  oXML.open('get', 'alimenta.php?id='+id+'&nivel='+nivel);
						  var estado = document.getElementById("estado_"+id+"_"+nivel);


							oXML.onreadystatechange = function(){

								if (oXML.readyState == 4 && oXML.status == 200) {

									if(oXML.responseText==0){

									estado.innerHTML = '<img border="0" src="../icon/icon-flag_red.gif" title="No Alimentable">';
									document.getElementById("escom_"+id+"_"+nivel).value = 0;
									}else{

									estado.innerHTML = '<img border="0" src="../icon/icon-flag_green.gif" title="Alimentable">';
									document.getElementById("escom_"+id+"_"+nivel).value = 1;
									}

								   vaciar(oXML);
								}
							}


						  oXML.send(null);

						  }else{


						  return false;

						  }

					}




			//////////publicado



				function activo1(id){

					 var estado1,estatus1;

						  estado1 = document.getElementById("escoma_"+id).value;
						  if(Number(estado1)==1){ estatus1 = 'inactivo' }else{ estatus1 = 'activo' }

						  if (confirm("desea cambiar a "+estatus1+" ?")) {

						  oXML = AJAXCrearObjeto();
						  oXML.open('get', 'activado.php?id='+id);
						  var estado1 = document.getElementById("est_"+id);


							oXML.onreadystatechange = function(){

								if (oXML.readyState == 4 && oXML.status == 200) {

									if(oXML.responseText==0){

									estado1.innerHTML = '<img border="0" src="../icon/icon-ojo-cerrao.gif" title="No Activado">';
									document.getElementById("escoma_"+id).value = 0;
									}else{

									estado1.innerHTML = '<img border="0" src="../icon/icon-ojo-pelao.gif" title="Activado">';
									document.getElementById("escoma_"+id).value = 1;
									}

								   vaciar(oXML);
								}
							}


						  oXML.send(null);

						  }else{


						  return false;

						  }

					}



			//////////revisado



				function revisado(id){

					 var estado2,estatus2;

						  estado2 = document.getElementById("escomar_"+id).value;
						  if(Number(estado2)==1){ estatus2 = 'Nuevo' }else{ estatus2 = 'Revisado' }

						  if (confirm("desea cambiar a "+estatus2+" ?")) {

						  oXML = AJAXCrearObjeto();
						  oXML.open('get', 'revisado.php?id='+id);
						  var estado2 = document.getElementById("rev_"+id);


							oXML.onreadystatechange = function(){

								if (oXML.readyState == 4 && oXML.status == 200) {

									if(oXML.responseText==0){

									estado2.innerHTML = '<img border="0" src="../icon/icon-nuevo.gif" title="NUEVO artículo agregado por usuario, usted no lo ha revisado todavia">';
									document.getElementById("escomar_"+id).value = 0;
									}else{

									estado2.innerHTML = '<img border="0" src="../icon/icon-usuario-verde.gif" title="artículo agregado por usuario, usted ya lo revisó">';
									document.getElementById("escomar_"+id).value = 1;
									}

								   vaciar(oXML);
								}
							}


						  oXML.send(null);

						  }else{


						  return false;

						  }

					}



	/////////////////////////////////////

	function borrar(id,nombre,nivel,id2,nivel2){

	  if (confirm("Esta seguro que desea borrar "+nombre+" y todo su contenido?")) {

	  ajaxsend("post","borrar_cont.php","id="+id+"&tabla="+nivel);


		if(nivel2!=0){

		  abrir_cat(id2,nivel2);
		  abrir_cat(id2,nivel2);

		  }else{

			 alert('Categoria de Nivel 1 borrada con éxito');
			 location.replace('arbol.php');

		  }


	  }else{


	  return false;

	  }
	}



	function borrar_art(id,nombre,nivel,cat){

	  if (confirm("Esta seguro que desea borrar el Articulo "+nombre+" ?")) {

	  ajaxsend("post","borrar_cont2.php","id="+id+"&nivel="+nivel+"&cat="+cat);

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

	  		location.replace('arbol.php');

		}

	}

	function ordenar_articulo(orden,nivel,cat,id,sentido){
//	  ajaxsend("post","ordenar_art2.php","orden="+orden+"&nivel="+nivel+"&cat="+cat+"&idMyself="+id+"&se="+sentido);
		extraVars = "&orden="+orden+"&nivel="+nivel+"&cat="+cat+"&idMyself="+id+"&se="+sentido;
          	abrir_cat(cat,nivel);
          	abrir_cat2(cat,nivel,extraVars);
	}
