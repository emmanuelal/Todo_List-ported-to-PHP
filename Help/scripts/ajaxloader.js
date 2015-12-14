xmlhttp = false;
try{
	 xmlhttp = ActiveXObject("Msxml2.XMLHTTP");
}catch(e){
	 xmlhttp = false;
}

if (!xmlhttp && typeof XMLHttpRequest !='undefined') {
     xmlhttp = new XMLHttpRequest();
}



function getData(Source, div ){
var obj = document.getElementById(div);
xmlhttp.open("GET", Source );
xmlhttp.onreadystatechange = function(){
 if(xmlhttp.readyState == 4 && xmlhttp.status == 200 ){
       obj.innerHTML = xmlhttp.responseText;
     }

   }//anonymous function
   xmlhttp.send(null);
}//function