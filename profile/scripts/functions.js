function submitform (theform, serverPage, objID, valfunc){
var file = serverPage;
var str = getformvalues(theform,valfunc);
//If the validation is ok.
if (aok == true){
obj = document.getElementById(objID);
processajax (serverPage, obj, "post", str);
  }
}
window.onload = function()
{
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time_zone_p').innerHTML = h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
 }
 startTime();
}