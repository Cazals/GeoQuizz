var JSONstring=
'[{"run":"2012121118","day":"20121212","status":"complete"},{"run":"2012121106","day":"20121212","status":"complete"},{"run":"2012121018","day":"20121211","status":"complete"},{"run":"2012121006","day":"20121211","status":"complete"},{"run":"2012120918","day":"20121210","status":"complete"},{"run":"2012120906","day":"20121210","status":"complete"}]';

var JSONTab = JSON.parse(JSONstring);

var obj;

for(var i=0;i<JSONTab.length;i++){
	obj = JSONTab[i];
	console.log(obj.run + '-' + obj.status);
}






