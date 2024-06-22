function ffalse()
{
return false;
}
function ftrue()
{
return true;
}
document.onselect = new Function ("return false");
document.onselectstart = new Function ("return false");
document.oncontextmenu = new Function ("return false");
document.ondrag = new Function ("return false");
document.ondragend = new Function ("return false");
document.ondragenter = new Function ("return false");
document.ondragleave = new Function ("return false");
document.ondragover = new Function ("return false");
document.ondrop = new Function ("return false");
document.ondragstart = new Function ("return false");
document.ondragdrop = new Function ("return false");
document.oncopy = new Function ("return false");
document.onbeforecopy = new Function ("return false");
document.onpaste = new Function ("return false");
document.onbeforepaste = new Function ("return false");
document.oncut = new Function ("return false");
document.onbeforecut = new Function ("return false");
document.ondblclick = new Function ("return false");
document.onhelp = new Function ("return false");
if(window.sidebar)
{
document.onmousedown = ffalse;
document.onclick = ftrue;
}

function Disable(objEvent) 
{
try {
var sKey;
if(window.event){sKey = window.event.keyCode;} else if(objEvent){sKey = objEvent.which;}   
var objEvent = objEvent || window.event; 
if(sKey == 16 && objEvent.ctrlKey){return false;} //ctrl + majuscule
if(sKey == 27 && objEvent.ctrlKey){return false;} //ctrl + esc
if(sKey == 45 && objEvent.ctrlKey){return false;} //ctrl + ins
if(sKey == 65 && objEvent.ctrlKey){return false;} //ctrl + a
if(sKey == 66 && objEvent.ctrlKey){return false;} //ctrl + b
if(sKey == 67 && objEvent.ctrlKey){return false;} //ctrl + c
if(sKey == 68 && objEvent.ctrlKey){return false;} //ctrl + d
if(sKey == 69 && objEvent.ctrlKey){return false;} //ctrl + e
if(sKey == 70 && objEvent.ctrlKey){return false;} //ctrl + f
if(sKey == 71 && objEvent.ctrlKey){return false;} //ctrl + g
if(sKey == 72 && objEvent.ctrlKey){return false;} //ctrl + h
if(sKey == 73 && objEvent.ctrlKey){return false;} //ctrl + i
if(sKey == 75 && objEvent.ctrlKey){return false;} //ctrl + k
if(sKey == 77 && objEvent.ctrlKey){return false;} //ctrl + m
if(sKey == 78 && objEvent.ctrlKey){return false;} //ctrl + n
if(sKey == 80 && objEvent.ctrlKey){return false;} //ctrl + p
if(sKey == 82 && objEvent.ctrlKey){return false;} //ctrl + r
if(sKey == 83 && objEvent.ctrlKey){return false;} //ctrl + s
if(sKey == 84 && objEvent.ctrlKey){return false;} //ctrl + t
if(sKey == 85 && objEvent.ctrlKey){return false;} //ctrl + u
if(sKey == 86 && objEvent.ctrlKey){return false;} //ctrl + v
if(sKey == 89 && objEvent.ctrlKey){return false;} //ctrl + y
if(sKey == 90 && objEvent.ctrlKey){return false;} //ctrl + z
if(sKey == 91 && objEvent.ctrlKey){return false;} //ctrl + windows
}
catch(ex) {
alert(ex.toString());
}
}
document.onkeydown = Disable;
