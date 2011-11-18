<?
function includeCommonClass($className){
	if (!class_exists($className)) {
		includeCommon('SVsystem/class/'.$className);
	}
}

function includeWidget($className){
	$path=substr($className, 0,strpos($className, "."));
	$name=substr($className, strpos($className, ".")+1,strlen($className));
	if (!class_exists($name)) {
		includeCommon('SVwidgets/'.$path.'/'.$name);
	}
}

function includeCommon($url){
	$url = "http://common.svcmscentral.com/".$url.".inc";
	$ch = curl_init();
	$timeout = 0;
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$contenido = curl_exec($ch);
	if (strpos($contenido, '<?php')>=0){
		$contenido = substr($contenido, strpos($contenido, '<?php')+5,strpos($contenido, "?>")-5);
	}else if (strpos($contenido, '<?')>=0){
		$contenido = substr($contenido, strpos($contenido, '<?')+2,strpos($contenido, "?>")-2);
	}
	curl_close($ch);
	eval($contenido);
}

function includeInnerElementInit($file,$tag,$datos){
	$contenido = file_get_contents($file, true);
	if (strpos($contenido, $tag)>=0){
		$contenido = substr($contenido, 0,strpos($contenido, $tag));
	}
	$contenido = '?>'.$contenido;
	eval($contenido);
}

function includeInnerElementEnd ($file, $tag,$datos){
	$contenido = file_get_contents($file, true);
	if (strpos($contenido, $tag)>=0){
		$contenido = substr($contenido, strpos($contenido, $tag)+strlen($tag));
	}
	$contenido = '?>'.$contenido;
	eval($contenido);
}


?>