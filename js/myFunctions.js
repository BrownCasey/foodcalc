var total = 0;

function add(e, f){
    var justString = e;
    justString = justString.substr(0, justString.lastIndexOf(" ")+1);
    
    var item = "<li class='list-group-item' onclick='subtract(" + f + ");remove();'> <span class='glyphicon glyphicon-minus-sign'></span> " + justString + " <span class='badge'>" + f + "</span></li>";
    $("#ate").append(item);
    total += f;
    $("#total").html(total);
}

function subtract(e){
    total -= e;
    $("#total").html(total);    
}

function ajaxFunction(){
	var ajaxRequest;
	
	try{
		// Opera, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} 
	catch (e){
		// IE Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} 
		catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} 
			catch (e){
				alert("Your browser does not support Ajax");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById('results');
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	var food = document.getElementById('searchbox').value;
	ajaxRequest.open("GET", "query.php?searchbox=" + food, true);
	ajaxRequest.send(null);

    // Close the autocomplete box so it does not cover results	
	$("#searchbox").autocomplete("close");
}
