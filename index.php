<!DOCTYPE html>

<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Chatbox</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<body>
	<section class="chatbox">
		<section id="chat" class="chat-window">
		<!--<div id="chat"> -->
			<article class="msg-container msg-remote" id="msg-0">
				<div class="msg-box">
					<img class="user-img" id="user-0" src="//gravatar.com/avatar/00034587632094500000000000000000?d=retro" />
					<div class="flr">
						<div class="messages">
							<p class="msg" id="msg-0">
								Welcome! Describe the kind of drink you're looking for and I will make a suggestion. 😀
							</p>
						</div>
						<span class="timestamp"><span class="username">DrinkBot</span>&bull;<span class="posttime">Just Now</span></span>
					</div>
				</div>
			</article>
			<!--</div>-->
		</section>
		<form class="chat-input" onsubmit="submitForm(); return false;">
			<input type="text" id="userInput" autocomplete="on" placeholder="Type a message" />
			<button id="sendButton" type="button" onclick="postMessage()">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="rgba(0,0,0,.38)" d="M17,12L12,17V14H8V10H12V7L17,12M21,16.5C21,16.88 20.79,17.21 20.47,17.38L12.57,21.82C12.41,21.94 12.21,22 12,22C11.79,22 11.59,21.94 11.43,21.82L3.53,17.38C3.21,17.21 3,16.88 3,16.5V7.5C3,7.12 3.21,6.79 3.53,6.62L11.43,2.18C11.59,2.06 11.79,2 12,2C12.21,2 12.41,2.06 12.57,2.18L20.47,6.62C20.79,6.79 21,7.12 21,7.5V16.5M12,4.15L5,8.09V15.91L12,19.85L19,15.91V8.09L12,4.15Z" /></svg>
                </button>
		</form>
	</section>
</body>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="./script.js"></script>
  <script>
  
    setInterval(updateTstamps, 60000);
	
	function updateTstamps() {
		var d = new Date();
		var hr = d.getHours() * 60;
		var mn = d.getMinutes();
		var ts = hr + mn;
		var msgtime = 0;
		var tdiff = 0;
		
		const messages = document.getElementsByClassName("posttime");
		for (let i = 0; i < messages.length; i++) {
			msgtime = parseInt(messages[i].id);
			tdiff = ts - msgtime;
			if (tdiff == 0){
				messages[i].innerHTML = "Just Now";
			}
			else if (tdiff == 1) {
				messages[i].innerHTML = tdiff.toString() + " minute ago";
			}
			else if (tdiff > 1) {
				messages[i].innerHTML = tdiff.toString() + " minutes ago";
			}
			else {
				messages[i].innerHTML = d;
			}
			
		}
		
	}
  
	function postMessage() {
		var input = document.getElementById('userInput').value;
		if(input == "") {
			return;
		}
		else {
			document.getElementById('userInput').value = '';
			var newMessageHTML = getMessageHTML(input, 'user');
			document.getElementById("chat").innerHTML += newMessageHTML;
			var chatWindow = document.getElementById('chat');
			chatWindow.scrollTop = chatWindow.scrollHeight;
			setTimeout(() => {
				var responseMessage = generateResponse(input);
				document.getElementById("chat").innerHTML += getMessageHTML(responseMessage, 'bot');
				chatWindow.scrollTop = chatWindow.scrollHeight;
				}, 3000)
			return;
		}
	}
	
	
	function getMessageHTML(input, messageType) {
		var msgHTML = "";
		var d = new Date();
		var hr = d.getHours() * 60;
		var mn = d.getMinutes();
		var ts = hr + mn;
		if(messageType == 'user') {
			msgHTML += '<article class="msg-container msg-self" id="msg-0">';
			msgHTML += '<div class="msg-box">';
			msgHTML += '<div class="flr">';
			msgHTML += '<div class="messages">';
			msgHTML += '<p class="msg" id="msg-1">';
			msgHTML += input;
			msgHTML += '</p>';
			msgHTML += '</div>';
			msgHTML += '<span class="timestamp"><span class="username">User</span>&bull;<span class="posttime" id="' + ts.toString() + '">Just Now</span></span>';
			msgHTML += '</div>';
			msgHTML += '<img class="user-img" id="user-0" src="//gravatar.com/avatar/56234674574535734573000000000001?d=retro" />';
			msgHTML += '</div>';
			msgHTML += '</article>';
		}
		if(messageType == 'bot') {
			msgHTML += '<article class="msg-container msg-remote" id="msg-0">';
			msgHTML += '<div class="msg-box">';
			msgHTML += '<img class="user-img" id="user-0" src="//gravatar.com/avatar/00034587632094500000000000000000?d=retro" />';
			msgHTML += '<div class="flr">';
			msgHTML += '<div class="messages">';
			msgHTML += '<p class="msg" id="msg-0">';
			msgHTML += input;
			msgHTML += '</p>';
			msgHTML += '</div>';
			msgHTML += '<span class="timestamp"><span class="username">DrinkBot</span>&bull;<span class="posttime" id="' + ts.toString() + '">Just Now</span></span>';
			msgHTML += '</div>';
			msgHTML += '</div>';
			msgHTML += '</article>';
		}
		return msgHTML;
	}
	
	function submitForm() {
		document.getElementById('sendButton').click();
	}


	function generateResponse(input) {
		var response = '';
		
		
		var oReq = new XMLHttpRequest();
		oReq.onreadystatechange=function() {
			if (this.readyState==4 && this.status==200) {
			response=this.responseText;
			console.log(this.responseText);
			}
		}
		oReq.open("GET", "getResponse.php?var="+input, false);
		oReq.send();
		console.log(response);
		return(response);
		/*
		input = input.toLowerCase();
		var response = '';
		if (input.includes('whiskey') || input.includes('whisky')) {
			response = "Try whiskey!";
			return response;
		}
		else if (input.includes('tequila')) {
			response = "Try tequila!";
			return response;
		}
		else if (input.includes('rum')) {
			response = "Try rum!";
			return response;
		}
		else if (input.includes('beer')) {
			response = "Try beer!";
			return response;
		}
		else if (input.includes('wine')) {
			response = "Try wine!";
			return response;
		}
		else {
			response = "Try other stuff!";
			return response;
		}
		*/
	}
	
  </script>
</body>
</html>