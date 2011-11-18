 function popup(mylink, windowname,alto1,largo1)
	 {
	var alto = alto1;
	var largo = largo1;
	var winleft = (screen.width - largo) / 2;
	var winUp = (screen.height - alto) / 2;


	if (! window.focus)return true;
	  var href;
	  if(typeof(mylink) == 'string')
		href=mylink;
	  else
		href=mylink.href;
		window.open(href, windowname, 'top='+winUp+',left='+winleft+'+,toolbar=0 status=0,resizable=0,Width='+largo+',height='+alto+',scrollbars=1');

	}


  function preload() {

   document.getElementById('hidepage').style.display = 'inline';
   document.getElementById('loader').style.display = 'none';

   }

function goHere(item,targ)  {
theChoice = item.selectedIndex;
theName=item.name;
item.selectedIndex = 0;
theURL=item.options[theChoice].value;

if (theChoice != 0) window.open(theURL,targ);
}