 function popup(mylink, windowname,alto1,largo1)
	 {
	var alto = alto1;
	var largo = largo1;
	var winleft = (screen.width - largo) / 2;
	var winUp = (screen.height - alto) / 2;

//	if (! window.focus){ return true;}
	  var href;
	  if(typeof(mylink) == 'string')
		href=mylink;
	  else
		href=mylink.href;
		x=window.open(href, windowname, 'top='+winUp+',left='+winleft+'+,toolbar=0 status=0,resizable=0,Width='+largo+',height='+alto+',scrollbars=1');
	    x.focus();
	}


  function preload() {

   document.getElementById('hidepage').style.display = 'inline';
   document.getElementById('loader').style.display = 'none';

   }

function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}



function P7_MultiClass2() { //v1.0 by PVII
 var args=P7_MultiClass2.arguments;if(document.getElementById){
  for(var i=0;i<args.length;i+=2){if(document.getElementById(args[i])!=null){
  if(document.p7setdown){for(var k=0;k<p7dco.length-1;k+=2){
  if(args[i]==p7dco[k]){args[i+1]=p7dco[k+1];break;}}}
  document.getElementById(args[i]).className=args[i+1];}}}
}


   function clearText(thefield){
if (thefield.defaultValue==thefield.value)
thefield.value = ""
} 
