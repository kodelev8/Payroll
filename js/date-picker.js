/***********************************************
* Drop Down Date select script- by JavaScriptKit.com
* This notice MUST stay intact for use
* Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and more
***********************************************/

var monthtext=['January','February','March','April','May','June','July','August','September','October','November','December'];
var monthno=['01','02','03','04','05','06','07','08','09','10','11','12'];
function populatedropdown( monthfield, yearfield){
var today=new Date()
var monthfield=document.getElementById(monthfield)
var yearfield=document.getElementById(yearfield)
for ( m=0; m<12; m++)
monthfield.options[m]=new Option(monthtext[m], monthno[m])
//monthfield.options[today.getMonth()]=new Option(monthtext[today.getMonth()], monthno[today.getMonth()], true, true) //select today's month
var thisyear=today.getFullYear()
for (var y=0; y<10; y++){
yearfield.options[y]=new Option(thisyear, thisyear)
thisyear-=1
}
//yearfield.options[0]=new Option(today.getFullYear(), today.getFullYear(), true, true) //select today's year
}


