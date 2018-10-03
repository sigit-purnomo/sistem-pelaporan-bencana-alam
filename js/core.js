[code="Javascript"]
//On load page, init the timer which check if the there are anchor changes each 300 ms
$().ready(function(){
	setInterval("checkAnchor()", 300);
});
var currentAnchor = null;
//Function which chek if there are anchor changes, if there are, sends the ajax petition
function checkAnchor(){
	//Check if it has changes
	if(currentAnchor != document.location.hash){
		currentAnchor = document.location.hash;
		//if there is not anchor, the loads the default section
		if(!currentAnchor)
			query = "section=home";
		else
		{
			//Creates the  string callback. This converts the url URL/#main&amp;id=2 in URL/?section=main&amp;id=2
			var splits = currentAnchor.substring(1).split('&amp;');
			//Get the section
			var section = splits[0];
			delete splits[0];
			//Create the params string
			var params = splits.join('&amp;');
			var query = "section=" + section + params;
		}
		//Send the petition
		$.get("callbacks.php",query, function(data){
			$("#content").html(data);
		});
	}
}
[/code]