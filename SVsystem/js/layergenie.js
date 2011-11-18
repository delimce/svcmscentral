//

function dmxFLG1(){//v1.07
// Copyright 2003, Marja Ribbers (FlevOOware.nl), George Petrov (DMXzone.com). All rights reserved.
var v1=arguments,v2=v1[0],v3=MM_findObj(v2),v4=document;top.LG9=(navigator.userAgent.toLowerCase().indexOf("mac")!=-1);if (!v3||dmxFLG11(v2)){return;}v3.LG27=v1[1];if (!top.LG15){top.LG15=new Array();}if (top.LG15[0]==null){top.LG15[0]=new Array();}if (dmxFLG7(v2,0)==false){top.LG15[0][top.LG15[0].length]=v2;}if (v3.LG27>0){var v5=v1[3];dmxFLG4(v2,v5);}var v6=v1[2];if (v6==1){if (v4.layers){v3.captureEvents(Event.MOUSEOUT,Event.MOUSEOVER);}v3.onmouseout=dmxFLG8;v3.onmouseover=dmxFLG9;v3.LG8=false;}v3.LG16=(v2.indexOf("?")>0)?v2.substring(v2.indexOf("?")+1):"";v3.LG13=v1[4];if (v1.length>19){var v7=(v1.length>22)?v1[22]:null;dmxFLG22(v2,v1[19],v1[20],v1[21],v7);}var v8=new flvS3(v2);if (v3.LG13==2){v3.LG38=v1[5];v3.LG35=v1[6];v3.LG37=v1[7];v3.LG36=v1[8];dmxFLG5(v3);}else {if (v3.LG11==null){v3.LG11=v8.x;v3.LG10=v8.y;}}v3.LG12=v8.w;v3.LG14=v8.h;v3.LG30=v1[9];if (v3.LG30!=0){if ((v3.LG30==1)||(v3.LG30==2)){v3.LG4=v1[10];v3.LG17=v1[11];}if (v3.LG30==1){dmxFLG14(v2,v1[12],v1[13]);}else if (v3.LG30==3){v3.LG1=v1[10];v3.LG2=v1[11];}}if (v1[14]==1){v3.LG32=v1[15]*1000;if (v3.LG2){v3.LG32+=v3.LG2*1000;}else if (v3.LG4){v3.LG32+=1000;}var v9="dmxFLG6('"+v2+"')";v3.LG24=setTimeout(v9,v3.LG32);}v3.LG21=v1[16];if (v3.LG21==2){v3.LG25=v1[17];v3.LG28=v1[18];}else if (v3.LG21==3){v3.LG22=v1[17];v3.LG23=v1[18];}var v10=v3.LG11,v11=v3.LG10;if (v3.LG13==1){var v12=(v3.LG16!="")?eval("parent."+v3.LG16):window,v13=new flvS6(v12);v10+=v13.x;v11+=v13.y;}var v14=(v4.layers)?v3:v3.style;if (v3.LG30==1){var v15=v3.LG20,v16=v3.LG19;if (v3.LG13==1){var v12=(v3.LG16!="")?eval("parent."+v3.LG16):window;var v13=new flvS6(v12);v15+=v13.x;v16+=v13.y;}flvS8(v3,v15,v16);v14.visibility='visible';dmxFLG15(v2,v10,v11,1);}else {flvS8(v3,v10,v11);if (v3.LG30==2){dmxFLG16(v2);}else if (v3.LG30==3){dmxFLG20(v2,v3.LG1,v3.LG2,1);}else {v14.visibility='visible';v3.LG3=1;}}if (window.onLGShow){onLGShow(v2);}}

function flvS3(v1){//v1.5
var v2=MM_findObj(v1);if (!v2){this.x=this.y=this.h=this.w=0;return;}var v3,v4,v5,v6,v7=(document.layers)?v2:v2.style,v8=document,v9=navigator.appVersion;v3=isNaN(parseInt(v7.left))?v2.offsetLeft:parseInt(v7.left);v4=isNaN(parseInt(v7.top))?v2.offsetTop:parseInt(v7.top);if (v9.indexOf("MSIE 5")>-1&&v9.indexOf("Mac")>-1){if (v2.parentElement.tagName=="BODY"){v3+=parseInt(v8.body.leftMargin);v4+=parseInt(v8.body.topMargin);}}if (v2.offsetHeight){v5=v2.offsetHeight;v6=v2.offsetWidth;}else if (document.layers){v5=v7.clip.height;v6=v7.clip.width;}else {v5=v6=0;}this.x=parseInt(v3);this.y=parseInt(v4);this.h=parseInt(v5);this.w=parseInt(v6);}

function flvS8(v1,v2,v3){//v1.0
var v4=(document.layers)?v1:v1.style;var v5=flvS5();eval("v4.left='"+v2+v5+"'");eval("v4.top='"+v3+v5+"'");}

function flvS5(){//v1.0
var v1=((parseInt(navigator.appVersion)>4||navigator.userAgent.indexOf("MSIE")>-1)&&(!window.opera))?"px":"";return v1;}

function dmxFLG7(){//v1.07
var v1=arguments,v2=v1[0],v3=v1[1],v4=false;if (top.LG15&&top.LG15[v3]){for (var v5=0;v5<top.LG15[v3].length;v5++){if (top.LG15[v3][v5]==v2){v4=true;break;}}}return v4;}

function dmxFLG11(){//v1.07
var v1=MM_findObj(arguments[0]);return ((v1.LG3!=null)&&(v1.LG3!=0));}

function dmxFLG20(){//v1.07
var v1=arguments,v2=v1[0],v3=v1[1],v4=v1[2],v5=v1[3],v6=MM_findObj(v2),v7=document,v8=(v7.layers)?v6:v6.style;v6.LG3=2;if ((v3==0)&&v7.getElementById&&!v7.all&&!window.opera&&!top.LG9){dmxFLG21(v2,v4,v5);return;}else if (!v7.all||window.opera||top.LG9){v8.visibility=(v5==0)?"hidden":"visible";}else {var v9=v8.filter,v10,v11,v12=(v5==0)?"hidden":"visible";if (v8.visibility!=v12){if (v6.filters[0]&&v6.filters[0].status==2){v6.filters[0].Stop();}if (v3==0){v11="blendTrans";v10=v11+"(Duration="+v4+")";}else {v11="revealTrans";v10=v11+"(Duration="+v4+",Transition="+(v3-1)+")";}var v13=v11+"([^)]*)",v14=new RegExp(v13,"gi"),v15=v9.match(v14);if (v15){v9=v9.replace(v14,v10);}else {v9=v10+" "+v9;}v8.filter=v9;v6.filters[0].Apply();v8.visibility=v12;v6.filters[0].Play();}}v6.LG3=v5;}

function dmxFLG21(){//v1.07
var v1=arguments,v2=v1[0],v3=v1[1],v4=v1[2],v5=MM_findObj(v2),v6,v7,v8=v5.style,v9=50;if (v5.LG29!=null){clearTimeout(v5.LG29);}if (v8.MozOpacity==""||parseFloat(v8.MozOpacity)>1){if (v4==1){v6=0;v8.MozOpacity=0;v8.visibility="visible";}else {v6=100;v8.MozOpacity=1;}}else {v6=parseFloat(v8.MozOpacity)*100;}if (!v4&&v6<=0){v8.visibility="hidden";v8.MozOpacity=1.01;v5.LG3=0;return;}else if (v4==1&&v6>=100){v8.MozOpacity=1.01;v5.LG3=1;return;}v7=(v4==0)?-1:1;var v10=1000/v9;var v11=(100/(v10*v3))*v7;v6+=v11;v8.MozOpacity=v6/100;var v12="dmxFLG21('"+v2+"',"+v3+","+v4+")";v5.LG29=setTimeout(v12,v9);}
